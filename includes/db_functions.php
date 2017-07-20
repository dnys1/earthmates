<?php
session_start();
declare(strict_types = 1);

$link = connectToDB();

function connectToDB()
{
	try{
			// Create a new connection.
			// You'll probably want to replace hostname with localhost in the first parameter.
			// Note how we declare the charset to be utf8mb4.  This alerts the connection that we'll be passing UTF-8 data.  This may not be required depending on your configuration, but it'll save you headaches down the road if you're trying to store Unicode strings in your database.  See "Gotchas".
			// The PDO options we pass do the following:
			// \PDO::ATTR_ERRMODE enables exceptions for errors.  This is optional but can be handy.
			// \PDO::ATTR_PERSISTENT disables persistent connections, which can cause concurrency issues in certain cases.  See "Gotchas".
			$link = new \PDO(   'mysql:host=localhost;dbname=id2197103_users;charset=utf8mb4',
													'id2197103_usersroot',
													'usersroot',
													array(
															\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
															\PDO::ATTR_PERSISTENT => false
													)
											);
			
			return $link;
	}
	catch(\PDOException $ex){
			print($ex->getMessage());
			return NULL;
	}
}

function getAllCompetencies()
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT * FROM Competencies');
		$handle->execute();
		
		$competencies = $handle->fetchAll();
		return $competencies;
	} 
	catch (\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

function getCompetency($id)
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT Competency FROM Competencies WHERE ID = ?');
		$handle->bindValue(1, $id);
		$handle->execute();
		
		$row = $handle->fetch();
		return $row['Competency'];
	}
	catch (\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

function isEmptyCompetencyIndex($userID) : bool
{
	global $link;
		
	try {
		$handle = $link->prepare('SELECT * FROM CompetencyIndex WHERE UserID = ?');
		$handle->bindValue(1, $userID, \PDO::PARAM_INT);
		$handle->execute();
		
		if(empty($handle->fetchAll())) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return TRUE;
	}
}

function updateQuizComplete($userID, $boolVal) : bool
{
	global $link;
	
	try {
		$handle = $link->prepare('UPDATE Users SET QuizComplete = ? WHERE UserID = ?');
		$handle->bindValue(1, $boolVal);
		$handle->bindValue(2, $userID, \PDO::PARAM_INT);
		
		$handle->execute();
		$_SESSION['quizComplete'] = true;
		
		return true;
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return false;
	}
}

function getCompetencyIndex($userID, $competencyID)
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT * FROM CompetencyIndex WHERE UserID = ? AND CompetencyID = ?');
		$handle->bindValue(1, $userID, PDO::PARAM_INT);
		$handle->bindValue(2, $competencyID, PDO::PARAM_INT);
		$handle->execute();
		
		return $handle->fetchAll();
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

function getAverageCompetencyScore($userID, $competencyID) : float
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT AVG(Level) AS "CompetencyScore" FROM CompetencyIndex WHERE UserID = ? AND CompetencyID = ?');
		$handle->bindValue(1, $userID, \PDO::PARAM_INT);
		$handle->bindValue(2, $competencyID, \PDO::PARAM_INT);
		$handle->execute();
		
		$row = $handle->fetch();
		return floatval($row['CompetencyScore']);
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

function getUserName($userID) : string
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT * FROM Users Where ID = ?');
		$handle->bindValue(1, $userID, \PDO::PARAM_INT);
		$handle->execute();
		
		$row = $handle->fetch();
		$name = $row['FirstName'] . " " . $row['LastName'];
		return $name;
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

// Get the userID and followerID from
// the FollowerLinks database
function getTokenInfo($token)
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT UserID, FollowerID FROM FollowerLinks WHERE Token = ?');
		$handle->bindValue(1, $token);
		$handle->execute();
		
		$row = $handle->fetch();
		if(!empty($row))
		{
			return array('UserID' => $row['UserID'], 'FollowerID' => $row['FollowerID']);
		}
		else
		{
			return NULL;
		}
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

// Remove token from database so it can
// no longer be used
function invalidateToken($token) : bool
{
	global $link;
	
	try {
		$handle = $link->prepare('DELETE FROM FollowerLinks WHERE Token = ?');
		$handle->bindValue(1, $token);
		
		$handle->execute();
		unset($_SESSION['token']);
		
		return true;
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return false;
	}
}

function createUser($firstName, $lastName, $email, $passwordHash = NULL)
{
	global $link;
	
	try {
		$handle = $link->prepare('INSERT INTO Users (FirstName, LastName, Email, PasswordHash) VALUES (?, ?, ?, ?)');
		$handle->bindValue(1, $firstName);
		$handle->bindValue(2, $lastName);
		$handle->bindValue(3, $email);
		$handle->bindValue(4, $passwordHash);
		$handle->execute();
		
		$handle = $link->prepare('SELECT ID FROM Users WHERE Email = ?');
		$handle->bindValue(1, $email);
		$handle->execute();
		
		$row = $handle->fetch();
		$userID = $row['ID'];
		
		return $userID;
	}
	// User already exists in database
	// Get the user's ID and return it
	catch(\PDOException $e)
	{		
		try {
			$handle = $link->prepare('SELECT ID FROM Users WHERE Email = ?');
			$handle->bindValue(1, $email);
			$handle->execute();
			
			$row = $handle->fetch();
			$userID = $row['ID'];
			
			return $userID;
		}
		catch(\PDOException $e)
		{
			print($e->getMessage());
			return NULL;
		}
	}
}

function createFollowerLink($userID, $followerID) : string
{
	global $link;
	
	// Create unique token
	$length = 16;
	$token = bin2hex(random_bytes($length));
	
	// Create expiration timestamp
	$currentDateTime = new DateTime();
	$tokenExpiration = $currentDateTime->add(new DateInterval('P1D'));
	$tokenExpiration = $tokenExpiration->format('Y-m-d H:i:s');
	
	try {
		$handle = $link->prepare('INSERT INTO FollowerLinks (UserID, FollowerID, Token, TokenExpiration) VALUES (?, ?, ?, ?)');
		$handle->bindValue(1, $userID, \PDO::PARAM_INT);
		$handle->bindValue(2, $followerID, \PDO::PARAM_INT);
		$handle->bindValue(3, $token);
		$handle->bindValue(4, $tokenExpiration);
		$handle->execute();
		
		return $token;
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

function getNumberOfQuestions() : int
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT COUNT(ID) FROM Questions');
		$handle->execute();
		
		return intval(($handle->fetch()[0]));
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

function loadQuestionSet()
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT * FROM Questions');
		$handle->execute();
		
		return $handle->fetchAll();
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

function loadQuestion($q)
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT * FROM Questions WHERE ID = ?');
		$handle->bindValue(1, $q, \PDO::PARAM_INT);
		$handle->execute();
		
		return $handle->fetch();
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

function postValue($userID, $followerID, $competencyID, $level) : bool
{
	global $link;
	
	try {
		$handle = $link->prepare('INSERT INTO CompetencyIndex (UserID, FollowerID, CompetencyID, Level) VALUES (?, ?, ?, ?)');
		$handle->bindValue(1, $userID, \PDO::PARAM_INT);
		$handle->bindValue(2, $followerID, \PDO::PARAM_INT);
		$handle->bindValue(3, $competencyID, \PDO::PARAM_INT);
		$handle->bindValue(4, $level, \PDO::PARAM_INT);
		
		return $handle->execute();
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return false;
	}
}

function test($test)
{
	global $link;
	
	try {
		
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
	}
}
?>