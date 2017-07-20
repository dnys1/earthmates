<?php
	require_once('session_start.php');
	require_once('db_functions.php');
	
	$competencyID = $_REQUEST['id'];

	try {
		$handle = $link->prepare('SELECT * FROM ResourceDescriptions WHERE CompetencyID = ?');
		$handle->bindValue(1, $competencyID, \PDO::PARAM_INT);
		$handle->execute();
		
		$descriptionArray = $handle->fetchAll();
	}
	catch(\PDOException $e)
	{
		$descriptionArray = NULL;
	}
	
	echo json_encode($descriptionArray);
?>