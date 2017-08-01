<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	require_once('includes/timezones.php');
	require_once('includes/alerts.php');
	/****************************/
	
	ensure_user_logged_in();
	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if(isset($_GET['signup']) && intval($_GET['signup']) == 1) {
			$alert['success'] = "Success! Welcome to your profile. Click on your name in the upper right-hand corner to get started.";
		}
	}
	
	if (isset($_SESSION['quizComplete']))
		$quizComplete = $_SESSION['quizComplete'];
	else
		$quizComplete = false;
	
	require_once('pages/profile_page.php');
	?>