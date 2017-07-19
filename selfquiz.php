<?php
	session_start();
	
	/********* INCLUDES **********/
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	include('includes/ensure_login.php');
	/****************************/
	
	$userID = $_SESSION['userID'];
	
	/* Process quiz data */
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		redirect_to('profile.php');
	}
	/* Load quiz questions */
	else
	{
		
	}
	
	include('pages/selfquiz_page.php');
?>

