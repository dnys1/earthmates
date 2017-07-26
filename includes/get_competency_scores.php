<?php
	require_once('session_start.php');
	require_once('db_functions.php');
	
	if(isset($_GET["other"]))
	{
		if($_GET["other"] == "true") $other = true;
		if($_GET["other"] == "false") $other = false;
	
		try {
			if($other)
				$handle = $link->prepare('SELECT AVG(Level) AS "CompetencyScore", CompetencyID FROM CompetencyIndex WHERE UserID = ? AND FollowerID <> ? GROUP BY CompetencyID');
			else
				$handle = $link->prepare('SELECT AVG(Level) AS "CompetencyScore", CompetencyID FROM CompetencyIndex WHERE UserID = ? AND FollowerID = ? GROUP BY CompetencyID');

			$handle->bindValue(1, $_SESSION['userID'], \PDO::PARAM_INT);
			$handle->bindValue(2, $_SESSION['userID'], \PDO::PARAM_INT);
			$handle->execute();
			
			echo json_encode($handle->fetchAll());
		}
		catch(\PDOException $e)
		{
			print($e->getMessage());
		}
	}
?>