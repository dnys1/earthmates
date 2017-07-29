<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	require_once('includes/timezones.php');
	/****************************/
	
	ensure_user_logged_in();

	$message = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if(isset($_GET['signup']) && intval($_GET['signup']) == 1) {
			$message .= '<div class="alert alert-success" role="alert">' . "\n";
			$message .= "Success! Welcome to your profile.\n";
			$message .= "</div>\n";
		}
	}
	
	if (isset($_SESSION['quizComplete']))
		$quizComplete = $_SESSION['quizComplete'];
	else
		$quizComplete = false;
	
	require_once('pages/profile_page.php');
	?>