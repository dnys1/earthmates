<?php
	require_once('db_functions.php');
	
	try {
		$handle = $link->prepare('SELECT * FROM Competencies ORDER BY ListOrder');
		$handle->execute();
		
		$competencies = $handle->fetchAll();
		echo json_encode($competencies);
	} 
	catch (\PDOException $e)
	{
		print($e->getMessage());
		return NULL;
	}
?>