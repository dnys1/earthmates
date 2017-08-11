<?php
	require_once(__DIR__ . '/../../includes/db_functions.php');
	
	try {
		$handle = $link->prepare('SELECT * FROM Types');
		$handle->execute();
		echo json_encode($handle->fetchAll());
	}
	catch(PDOException $e)
	{
		print($e->getMessage());
	}