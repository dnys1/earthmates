<?php
	require_once('db_functions.php');

	$q = $_REQUEST["q"];
	
	echo json_encode(loadQuestion($q));
?>