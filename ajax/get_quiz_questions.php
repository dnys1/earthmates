<?php
	require_once(__DIR__ . '/../../includes/session_start.php');
	require_once(__DIR__ . '/../../includes/db_functions.php');
	
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