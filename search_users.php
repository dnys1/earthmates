<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	require_once('includes/form_functions.php');
	/****************************/
	
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if(isset($_GET["q"]))
		{
			$query = test_input($_GET['q']);
			$query = explode(" ", $query);
			$results = getSearchResults($query);
			
			echo json_encode($results);
		}
	}
	
	include('pages/search_users_page.php');
?>