<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	/****************************/
	
	ensure_user_logged_in();
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (isset($_POST['visibleGlobally']))
		{
			$visibleGlobally = $_POST["visibleGlobally"];
			if ($visibleGlobally == "on")
			{
				echo "<h2>Update Profile</h2>";
			}
		}
		else 
		{
			echo "<h2>Don't update.</h2>";
		}
	}
	
	require_once('pages/settings_page.php');
?>