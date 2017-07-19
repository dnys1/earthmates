<?php
function redirect_to($site)
{
	header('Location: ' . $site);
	exit();
}

function checkIfNotLoggedIn()
{
	if (!isset($_SESSION['userID']) || empty($_SESSION['userID'])) {
		header('Location: login.php');
		exit();
	}
}
?>