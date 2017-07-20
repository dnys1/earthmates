<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	require_once('includes/form_functions.php');
	/****************************/

	$err = "";
	$firstName = $lastName = $email = $inputPassword = $retypePassword = $passwordHash = "";
	$message = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// Check first name field
		// First, is it empty?
		// Then, does it contain only letters?
		if(empty($_POST["firstName"])) {
			$err .= "<li>First name is required.</li>\n";
		} 
		else
		{
			$firstName = test_input($_POST["firstName"]);
			if (!preg_match("/^[a-zA-Z]*$/", $firstName))
			{
				$err .= "<li>Only letters allowed in name fields.</li>\n";
			}
		}
		
		// Check last name field
		// First, is it empty?
		// Then, does it contain only letters?
		if(empty($_POST["lastName"])) {
			$err .= "<li>Last Name is required.</li>\n";
		} 
		else
		{
			$lastName = test_input($_POST['lastName']);
			if (!preg_match("/^[a-zA-Z]*$/", $lastName))
			{
				$err .= "<li>Only letters allowed in name fields.</li>\n";
			}
		}
		
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
		
		// Collect the Passwords
		if(empty($_POST['inputPassword'])) {
			$err .= "<li>Password is required.</li>";
		}
		else
		{
			$inputPassword = $_POST['inputPassword'];
			if(!empty($_POST['retypePassword'])) {
				$retypePassword = $_POST['retypePassword'];
			}
		}
		
		// Check passwords
		// Empty password field?
		// Do they match?				
		if(strcmp($inputPassword,$retypePassword) != 0) {
			$err .= "<li>Passwords do not match.</li>\n";
		}
		else
		{
			// Hash the passwords then erase the password for security
			$passwordHash = password_hash($inputPassword, PASSWORD_DEFAULT);
			$inputPassword = $retypePassword = "";
		}
		
		if (empty($err)) {		
			try {
				// Check if email is already in database
				$handle = $link->prepare('SELECT * FROM Users WHERE Email = ?');
				$handle->bindValue(1, $email);
				$handle->execute();
				
				$emailExists = !empty($handle->fetch());
				
				if ($emailExists)
				{
					$err .= "<li>That email is already in use.</li>\n";
				}
				// If not, try to add it (should work?)
				else
				{
					$handle = $link->prepare('INSERT INTO Users (FirstName, LastName, Email, PasswordHash) VALUES(?, ?, ?, ?)');
				
					$handle->bindValue(1, $firstName);
					$handle->bindValue(2, $lastName);
					$handle->bindValue(3, $email);
					$handle->bindValue(4, $passwordHash);
					
					if($handle->execute()) {
						// Get back the userID that was just created
						$handle = $link->prepare('SELECT * FROM Users WHERE Email = ?');
						
						$handle->bindValue(1, $email);
						$handle->execute();
						
						// Set Session vars
						// Redirect to Profile
						$_SESSION['userID'] = $handle->fetchColumn();
						$_SESSION['userName'] = $firstName . ' ' . $lastName;
						
						redirect_to('profile.php?signup=1');
					}
				}
			}
			catch (PDOException $ex)
			{
				print($ex->getMessage());
			}
		}
	}

	include('pages/signup_page.php');
?>