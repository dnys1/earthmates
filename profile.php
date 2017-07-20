<?php
	session_start();
	
	/********* INCLUDES **********/
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
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
		
		if(isset($_GET['success']) && intval($_GET['success']) == 1) {
			$message .= '<div class="alert alert-success" role="alert">' . "\n";
			$message .= "Thanks for taking the quiz! Your answers have been recorded.\n";
			$message .= "</div>\n";
		}
	}
	
	$quizComplete = $_SESSION['quizComplete'];
	
	require_once('pages/profile_page.php');
	?>