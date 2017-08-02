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
			$alert['success'] = 'Success! Welcome to your profile. Click <a id="tourLink" href="#">here</a> to take a short, guided tour of EarthMates.';
		}
		
		if(isset($_GET['completed']) && intval($_GET['completed']) == 1) {
			$alert['error'] = "You've already completed the quiz.";
		}
	}
	
	if (isset($_SESSION['quizComplete']))
		$quizComplete = $_SESSION['quizComplete'];
	else
		$quizComplete = false;
	
	require_once('pages/profile_page.php');
	?>