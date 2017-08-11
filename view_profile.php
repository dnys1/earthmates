<?php
	/********* INCLUDES **********/
	require_once('../includes/session_start.php');
	require_once('../includes/db_functions.php');
	require_once('../includes/redirect.php');
	require_once('../includes/form_functions.php');
	require_once('../includes/alerts.php');
	/****************************/
	
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if(isset($_GET["id"]))
		{
			$id = test_input($_GET['id']);
			$profile = getProfile($id);
			
			if(!empty($profile))
				$userName = $profile['FirstName'] . " " . $profile['LastName'];
			
			// Make sure profile is global
			if(!intval($profile['GlobalProfile'])) 
				$profile = NULL;
		}
	}
	
	include('../pages/view_profile_page.php');
?>