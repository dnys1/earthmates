<?php
require_once('pdo_connect.php');

try {
	$handle = $link->prepare('SELECT * FROM Competencies');
	$handle->execute();
	
	$competencies = $handle->fetchAll();
} 
catch (PDOException $e)
{
	print($e->getMessage());
}
?>