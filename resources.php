<?php
	/********* INCLUDES **********/
	require_once('../includes/session_start.php');
	require_once('../includes/db_functions.php');
	require_once('../includes/redirect.php');
	/****************************/
	
	ensure_user_logged_in();
	
	require_once('../pages/resources_page.php');
?>