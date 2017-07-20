<?php
function redirect_to($site)
{
	header('Location: ' . $site);
	exit();
}

function ensure_user_logged_in()
{
	if (!isset($_SESSION['userID']) || empty($_SESSION['userID'])) {
		header('Location: login.php');
		exit();
	}
}

function check_if_logged_in() 
{
	return isset($_SESSION['userID']) && !empty($_SESSION['userID']);
}
?>