<?php
	require_once('session_start.php');
	require_once('db_functions.php');
	
	try {
		$handle = $link->prepare('SELECT * FROM Questions');
		$handle->execute();
		
		$questionSet = $handle->fetchAll();
	}
	catch(\PDOException $e)
	{
		print($e->getMessage());
		echo NULL;
		return;
	}
	
	echo json_encode($questionSet);
?>