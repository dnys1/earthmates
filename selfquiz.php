<?php
	session_start();
	
	/********* INCLUDES **********/
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	/****************************/
	
	checkIfNotLoggedIn();
	
	$userID = $_SESSION['userID'];
	
	/* Process quiz data */
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// JSON array of answers
		$answers = $_POST['answers'];
		
		// redirect_to('profile.php');
	}
	else
	{
		
	}
	
	include('pages/selfquiz_page.php');
?>

