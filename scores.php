<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	/****************************/
	
	ensure_user_logged_in();
	
	$message = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if(isset($_GET['success']) && intval($_GET['success']) == 1) {
			$message .= '<div class="alert alert-success" role="alert">' . "\n";
			$message .= "Thanks for taking the quiz! Your answers have been recorded.\n";
			$message .= "</div>\n";
		}
	}
	
	if(!$_SESSION['quizComplete'] || !$_SESSION['receivedFeedback'])
		redirect_to('profile.php');
	
	require_once('pages/scores_page.php');
?>