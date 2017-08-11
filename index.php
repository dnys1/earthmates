<?php
	require_once('../includes/session_start.php');
	require_once('../includes/alerts.php');
	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if (isset($_GET["success"]) && intval($_GET['success']) == 1)
		{
			$alert['success'] = "Thanks for taking the quiz! Your answers have been recorded and the recipient will be notified.";
		}
		
		if (isset($_GET["token-invalid"]) && intval($_GET['token-invalid']) == 1)
		{
			$alert['error'] = "That quiz is no longer available.";
		}
	}
	
	require_once('../pages/index_page.php');
?>