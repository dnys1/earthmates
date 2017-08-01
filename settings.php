<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	require_once('includes/alerts.php');
	require_once('includes/timezones.php');
	/****************************/
	
	ensure_user_logged_in();
	
	// Get privacy setting
	$visibleGlobally = isGlobalProfile($_SESSION['userID']);
	// Get timezone on file
	$currentTimezone = getTimezone($_SESSION['userID']);
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (isset($_POST['visibleGlobally']))
		{
			if(!$visibleGlobally)
			{
				setGlobalProfile($_SESSION['userID'], true);
				$visibleGlobally = true;
			}
		}
		else if ($visibleGlobally)
		{
			setGlobalProfile($_SESSION['userID'], false);
			$visibleGlobally = false;
		}
		
		if($_POST['timezone'] != $currentTimezone)
		{
			updateTimezone($_SESSION['userID'], $_POST['timezone']);
			$currentTimezone = $_POST['timezone'];
		}
	}
	
	require_once('pages/settings_page.php');
?>