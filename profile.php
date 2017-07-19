<?php
	session_start();
	
	/********* INCLUDES **********/
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	include('includes/ensure_login.php');
	/****************************/

	$message = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if(isset($_GET['signup']) && intval($_GET['signup']) == 1) {
			$message .= '<div class="alert alert-success" role="alert">' . "\n";
			$message .= "Success! Welcome to your profile.\n";
			$message .= "</div>\n";
		}
	}
	
	$empty = isEmptyCompetencyIndex($_SESSION['userID']);
	
	require_once('pages/profile_page.php');
	?>