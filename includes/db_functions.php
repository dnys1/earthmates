<?php
/* Declare strict return types */
declare(strict_types = 1);

/* Ensure the session has started, i.e. load vars */
require_once('session_start.php');
/* Sensitive login data */
require_once('db_login.php');
/* Get timezone values */
require_once('timezones.php');

$link = connectToDB();

function getAllCompetencies()
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT * FROM Competencies ORDER BY ListOrder');
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

function getTimezone($userID)
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT Timezone FROM Users WHERE ID = ?');
		$handle->bindValue(1, $userID);
		$handle->execute();
		
		$row = $handle->fetch();
		return $row['Timezone'];
	}
	catch (\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

function updateTimezone($userID, $timezone)
{
	global $link;
	
	try {
		$handle = $link->prepare('UPDATE Users SET Timezone = ? WHERE ID = ?');
		$handle->bindValue(1, $timezone, PDO::PARAM_BOOL);
		$handle->bindValue(2, $userID, PDO::PARAM_INT);
		
		return $handle->execute();;
	}
	catch (\PDOException $e)
	{
		print($e->getMessage());
		return false;
	}
}

function isGlobalProfile($userID)
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT GlobalProfile FROM Users WHERE ID = ?');
		$handle->bindValue(1, $userID, PDO::PARAM_INT);
		$handle->execute();
		
		$row = $handle->fetch();
		return $row['GlobalProfile'];
	}
	catch (\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

function setGlobalProfile($userID, $boolVal) : bool
{
	global $link;
	
	try {
		$handle = $link->prepare('UPDATE Users SET GlobalProfile = ? WHERE ID = ?');
		$handle->bindValue(1, $boolVal, PDO::PARAM_BOOL);
		$handle->bindValue(2, $userID, PDO::PARAM_INT);
		
		return $handle->execute();;
	}
	catch (\PDOException $e)
	{
		print($e->getMessage());
		return false;
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
		$handle = $link->prepare('SELECT * FROM CompetencyIndex WHERE UserID = ? AND FollowerID <> ?');
		$handle->bindValue(1, $userID, \PDO::PARAM_INT);
		$handle->bindValue(2, $userID, \PDO::PARAM_INT);
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

function updateQuizComplete($tokenOrUserID, $token = false) : bool
{
	global $link;
	
	if(!$token)
	{
		try {
			$handle = $link->prepare('UPDATE Users SET QuizComplete = 1, QuizResume = NULL WHERE ID = ?');
			$handle->bindValue(1, $tokenOrUserID, \PDO::PARAM_INT);
			
			$handle->execute();
			
			// Update SESSION vars
			$_SESSION['quizComplete'] = true;
			if(isset($_SESSION['quizResume'])) unset($_SESSION['quizResume']);
			
			return true;
		}
		catch(\PDOException $e)
		{
			print($e->getMessage());
			return false;
		}
	}
	else 
	{
		try {
			$handle = $link->prepare('UPDATE FollowerLinks SET TokenResume = NULL WHERE Token = ?');
			$handle->bindValue(1, $tokenOrUserID, \PDO::PARAM_INT);
			
			$handle->execute();
			
			// Update SESSION vars
			if(isset($_SESSION['quizResume'])) unset($_SESSION['quizResume']);
			
			return true;
		}
		catch(\PDOException $e)
		{
			print($e->getMessage());
			return false;
		}
	}

}

function getCompetencyIndex($userID, $competencyID)
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT * FROM CompetencyIndex WHERE UserID = ? AND CompetencyID = ?');
		$handle->bindValue(1, $userID, \PDO::PARAM_INT);
		$handle->bindValue(2, $competencyID, \PDO::PARAM_INT);
		$handle->execute();
		
		return $handle->fetchAll();
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
}

function getAverageSelfCompetencyScore($userID, $competencyID) : float
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

function getAverageOtherCompetencyScore($userID, $competencyID) : float
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT AVG(Level) AS "CompetencyScore" FROM CompetencyIndex WHERE UserID = ? AND CompetencyID = ? AND FollowerID <> ?');
		$handle->bindValue(1, $userID, \PDO::PARAM_INT);
		$handle->bindValue(2, $competencyID, \PDO::PARAM_INT);
		$handle->bindValue(3, $userID, \PDO::PARAM_INT);
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

function getFirstName($userID) : string
{
	global $link;
	
	try {
		$handle = $link->prepare('SELECT * FROM Users Where ID = ?');
		$handle->bindValue(1, $userID, \PDO::PARAM_INT);
		$handle->execute();
		
		$row = $handle->fetch();
		$firstName = $row['FirstName'];
		return $firstName;
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
		
		return $handle->execute();
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		return false;
	}
}

function createUser($firstName, $lastName, $email, $passwordHash = NULL) : int
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
		
		return intval($userID);
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
			
			return intval($userID);
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

function saveIncompleteQuestions($tokenOrUserID, $questionString, $token = false) : bool
{
	global $link;
	
	if($token)
	{
		try {
			$handle = $link->prepare('UPDATE FollowerLinks SET TokenResume = ? WHERE Token = ?');
			$handle->bindValue(1, $questionString, PDO::PARAM_STR);
			$handle->bindValue(2, $tokenOrUserID, PDO::PARAM_STR);
			
			return $handle->execute();
		}
		catch(PDOException $e)
		{
			print($e->getMessage());
		}
	}
	else
	{
		try {
			$handle = $link->prepare('UPDATE Users SET QuizResume = ? WHERE ID = ?');
			$handle->bindValue(1, $questionString);
			$handle->bindValue(2, $tokenOrUserID, \PDO::PARAM_INT);
			
			return $handle->execute();
		}
		catch(\PDOException $e)
		{
			print($e->getMessage());
		}
	}
}

function getIncompleteQuestions($userID, $token = NULL)
{
	global $link;
	
	if(empty($token))
	{
		try {
			$handle = $link->prepare('SELECT QuizResume FROM Users WHERE ID = ?');
			$handle->bindValue(1, $userID, PDO::PARAM_INT);
			$handle->execute();
			
			$row = $handle->fetch();
			return $row['QuizResume'];
		}
		catch (PDOException $e)
		{
			print($e->getMessage());
		}
	}
	else
	{
		try {
			$handle = $link->prepare('SELECT TokenResume FROM FollowerLinks WHERE Token = ?');
			$handle->bindValue(1, $token);
			$handle->execute();
			
			$row = $handle->fetch();
			
			return $row['TokenResume'];
		}
		catch(PDOException $e)
		{
			print($e->getMessage());
		}
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