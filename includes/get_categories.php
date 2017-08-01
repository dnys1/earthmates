<?php
	require_once('db_functions.php');
	
	$handle = $link->prepare('SELECT * FROM Categories');
	$handle->execute();
	
	$categories = $handle->fetchAll();
	
	foreach ($categories as $key => $category)
	{
		$handle = $link->prepare('SELECT * FROM Subcategories WHERE Category = ?');
		$handle->bindValue(1, $category['ID'], PDO::PARAM_INT);
		$handle->execute();
		
		$result = $handle->fetch();
		
		$categories[$key]['Subcategories'] = $result;
	}
	
	echo json_encode($categories);
?>