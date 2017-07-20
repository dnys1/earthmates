<?php
	require_once('session_start.php');
	require_once('db_functions.php');

	try {
		$handle = $link->prepare('SELECT * FROM Resources');
		$handle->execute();
		
		$resourceArray = $handle->fetchAll();
	}
	catch(\PDOException $e)
	{
		$resourceArray = NULL;
	}
	
	echo json_encode($resourceArray);
?>