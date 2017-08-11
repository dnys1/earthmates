<?php
	require_once('../includes/session_start.php');
	require_once('../includes/form_functions.php');
	require_once('../includes/db_functions.php');
	
	if(isset($_GET['id']))
	{
		$userID = test_input($_GET['id']);
		$filename = getProfilePicture($userID);
		
		header('Content-type: image/jpeg');
		if(!empty($filename))
		{
			readfile('../uploads/'.$userID.'/'.$filename);
		}
		else
		{
			readfile('img/anonymous.png');
		}
	} else 
	{
		if(isset($_SESSION['profileImage']) && !empty($_SESSION['profileImage']))
		{
			readfile('../uploads/'.$_SESSION['userID'].'/'.$_SESSION['profileImage']);
		} 
		else
		{
			readfile('img/anonymous.png');
		}
	}
?>