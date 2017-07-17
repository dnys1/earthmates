<?php
session_start();

$err = "";
$email = $inputPassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	// Check email field
	// Is it in the proper format?
	if(empty($_POST["inputEmail"])) {
		$err .= "<li>Email is required.</li>\n";
	}
	else 
	{
		$email = test_input($_POST["inputEmail"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$err .= "<li>Invalid email format.</li>\n";
		}
	}
	
	// Collect the password
	if(empty($_POST['inputPassword'])) {
		$err .= "<li>Password is required.</li>";
	}
	else
	{
		$inputPassword = $_POST['inputPassword'];
	}
	
	// Connect to MySQL database
	// Reuse this code and do it only once
	require_once('includes/pdo_connect.php');
	
	try {
		$handle = $link->prepare('SELECT * FROM Users WHERE Email = ?');
		
		$handle->bindValue(1, $email);					
		$handle->execute();
		
		$resultArray = $handle->fetch();
		
		// Database structure
		// 0 - ID
		// 1 - FirstName
		// 2 - LastName
		// 3 - Email
		// 4 - PasswordHash
		$savedHash = $resultArray[4];
		if (password_verify($inputPassword, $savedHash)) {
			$_SESSION['userID'] = $resultArray[0];
			$_SESSION['userName'] = $resultArray[1] . " " . $resultArray[2];
			redirect_to('profile.php');
		} 
		else
		{
			$err .= "<li>Email/password combination does not exist.</li>";
		}
	}
	catch (PDOException $ex)
	{
		print($ex->getMessage());
	}
}

include('includes/login_page.php');

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function redirect_to($site)
{
	header('Location: ' . $site);
	exit();
}
?>