<?php
	require_once('includes/session_start.php');
	
	header('Content-type: image/jpeg');
	readfile('../uploads/'.$_SESSION['userID'].'/'.$_SESSION['profileImage']);
	}
?>