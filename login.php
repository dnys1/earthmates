<?php
	/********* INCLUDES **********/
	require_once('../includes/session_start.php');
	require_once('../includes/db_functions.php');
	require_once('../includes/form_functions.php');
	require_once('../includes/redirect.php');
	require_once('../includes/alerts.php');
	/****************************/

	$email = $inputPassword = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// Check email field
		// Is it in the proper format?
		if(empty($_POST["inputEmail"])) {
			$alert['multerror'] .= "<li>Email is required.</li>\n";
		}
		else 
		{
			$email = test_input($_POST["inputEmail"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$alert['multerror'] .= "<li>Invalid email format.</li>\n";
			}
		}
		
		// Collect the password
		if(empty($_POST['inputPassword'])) {
			$alert['multerror'] .= "<li>Password is required.</li>";
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
			
			$savedHash = $resultArray['PasswordHash'];
			if (password_verify($inputPassword, $savedHash)) {
				$_SESSION['userID'] = $resultArray['ID'];
				$_SESSION['userName'] = $resultArray['FirstName'] . " " . $resultArray['LastName'];
				$_SESSION['userEmail'] = $resultArray['Email'];
				$_SESSION['quizComplete'] = $resultArray['QuizComplete'];
				if(!empty($resultArray['QuizResume'])) $_SESSION['quizResume'] = $resultArray['QuizResume'];
				$_SESSION['receivedFeedback'] = !isEmptyCompetencyIndex($resultArray['ID']);
				$_SESSION['showInfoMessage'] = $resultArray['ShowInfoMessage'];
				$_SESSION['profileImage'] = $resultArray['ProfileImage'];
				redirect_to('profile.php');
			} 
			else
			{
				$alert['multerror'] .= "<li>Email/password combination does not exist.</li>";
			}
		}
		catch (PDOException $ex)
		{
			print($ex->getMessage());
		}
	}

	include('../pages/login_page.php');
?>