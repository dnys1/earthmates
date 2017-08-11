<?php
	require_once(__DIR__ . '/../../includes/db_functions.php');
	
	$handle = $link->prepare('SELECT * FROM Categories');
	$handle->execute();
	
	$categories = $handle->fetchAll();
	
	foreach ($categories as $key => $category)
	{
		$handle = $link->prepare('SELECT * FROM Subcategories WHERE CategoryID = ?');
		$handle->bindValue(1, $category['ID'], PDO::PARAM_INT);
		$handle->execute();
		
		$result = $handle->fetchAll();
		
		$categories[$key]['Subcategories'] = (array) $result;
	}
	
	echo json_encode($categories);
?>