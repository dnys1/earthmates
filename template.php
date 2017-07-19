<?php
	session_start();
	
	/********* INCLUDES **********/
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	include('includes/ensure_login.php');
	/****************************/
	
	/** PAGE CODE **/
	
	include('pages/template_page.php');
?>