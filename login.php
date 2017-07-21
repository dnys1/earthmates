<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/form_functions.php');
	require_once('includes/redirect.php');
	/****************************/

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
			// 5 - QuizComplete
			$savedHash = $resultArray[4];
			if (password_verify($inputPassword, $savedHash)) {
				$_SESSION['userID'] = $resultArray[0];
				$_SESSION['userName'] = $resultArray[1] . " " . $resultArray[2];
				$_SESSION['userEmail'] = $resultArray[3];
				$_SESSION['quizComplete'] = $resultArray[5];
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

	include('pages/login_page.php');
?>