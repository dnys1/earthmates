<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	require_once('includes/alerts.php');
	/****************************/
	
	ensure_user_logged_in();
	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if(isset($_GET['success']) && intval($_GET['success']) == 1) {
			$alert['success'] = "Thanks for taking the quiz! Your answers have been recorded.";
		}
	}
	
	if(!$_SESSION['quizComplete'] || !$_SESSION['receivedFeedback'])
		redirect_to('profile.php');
	
	require_once('pages/dashboard_page.php');
?>