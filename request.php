<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	require_once('includes/form_functions.php');
	require_once('includes/PHPMailer/PHPMailerAutoload.php');
	/****************************/

	ensure_user_logged_in();

	$err = "";
	$firstName = $lastName = $email = "";
	$message = "";

	/* Process form data */
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
			if (!strcmp($email, $_SESSION['userEmail']))
			{
				$err .= "<li>You cannot request feedback from yourself.</li>";
			}
		}
		
		if (empty($err)) 
		{
			$userID = $_SESSION['userID'];
			$followerID = createUser($firstName, $lastName, $email);
			
			// Returns the token to access the follower link
			$token = createFollowerLink($userID, $followerID);
			
			// Create the stable link
			// Email to follower
			// Generate success message at profile page
			$followerLink = "https://earthmates.000webhostapp.com/quiz.php?token=" . $token;
			
			$body = $_SESSION['userName'] . " is requesting feedback for his EarthMates profile. To provide them feedback, follow the link below.<br><br>";
			$body .= '<a href="' . $followerLink . '">Link to form</a>';
			
			$obj = new PHPMailer();
			$obj->From      = 'dnys1@asu.edu';
			$obj->FromName  = 'Dillon Nys';
			$obj->Subject   = 'EarthMates Invitation for Feedback';
			$obj->Body      = $body;
			$obj->AddAddress( $email );
			$obj->isHTML(true);

			$obj->Send();
			
			redirect_to('request.php?success=1');
		}
	} 
	else if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if(isset($_GET['success']) && intval($_GET['success']) == 1)
		{
			$message .= '<div class="alert alert-success" role="alert">' . "\n";
			$message .= "Success! An e-mail has been sent.\n";
			$message .= "</div>\n";
		}
	}

	// The request form
	include('pages/request_page.php');
?>