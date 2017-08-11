<?php
	/********* INCLUDES **********/
	require_once('../includes/session_start.php');
	require_once('../includes/db_functions.php');
	require_once('../includes/redirect.php');
	require_once('../includes/form_functions.php');
	require_once('../includes/alerts.php');
	/****************************/

	ensure_user_logged_in();
	
	$firstName = $lastName = $email = "";

	/* Process form data */
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// Check first name field
		// First, is it empty?
		// Then, does it contain only letters?
		if(empty($_POST["firstName"])) {
			$alert['error'] .= "<li>First name is required.</li>\n";
		} 
		else
		{
			$firstName = test_input($_POST["firstName"]);
			if (!preg_match("/^[a-zA-Z]*$/", $firstName))
			{
				$alert['error'] .= "<li>Only letters allowed in name fields.</li>\n";
			}
		}
		
		// Check last name field
		// First, is it empty?
		// Then, does it contain only letters?
		if(empty($_POST["lastName"])) {
			$alert['error'] .= "<li>Last Name is required.</li>\n";
		} 
		else
		{
			$lastName = test_input($_POST['lastName']);
			if (!preg_match("/^[a-zA-Z]*$/", $lastName))
			{
				$alert['error'] .= "<li>Only letters allowed in name fields.</li>\n";
			}
		}
		
		// Check email field
		// Is it in the proper format?
		if(empty($_POST["inputEmail"])) {
			$alert['error'] .= "<li>Email is required.</li>\n";
		}
		else 
		{
			$email = test_input($_POST["inputEmail"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$alert['error'] .= "<li>Invalid email format.</li>\n";
			}
			if (!strcmp($email, $_SESSION['userEmail']))
			{
				$alert['error'] .= "<li>You cannot request feedback from yourself.</li>";
			}
		}
		
		if (empty($alert['error'])) 
		{
			require '../includes/sendgrid-php/sendgrid-php.php';
			
			$userID = $_SESSION['userID'];
			$followerID = createUser($firstName, $lastName, $email);
			
			// Returns the token to access the follower link
			$token = createFollowerLink($userID, $followerID);
			
			// Create the stable link
			// Email to follower
			// Generate success message at profile page
			$followerLink = "https://earthmates.me/quiz.php?token=" . $token;
			
			$body = $_SESSION['userName'] . " is requesting feedback for their EarthMates profile. To take a short assessment of their behavior, follow the link below. You may save at any point.<br><br>";
			$body .= '<a href="' . $followerLink . '">Link to form</a>';
			
			$from = new SendGrid\Email("EarthMates", "admin@earthmates.me");
			$subject = "Request for EarthMates Feedback";
			$to = new SendGrid\Email($firstName . " " . $lastName, $email);
			$content = new SendGrid\Content("text/html", $body);
			$mail = new SendGrid\Mail($from, $subject, $to, $content);
			$apiKey = getenv('SENDGRID_API_KEY');
			$sg = new \SendGrid($apiKey);
			$response = $sg->client->mail()->send()->post($mail);
			
			if (intval($response->statusCode()) != 202) {
				$alert['error'] = "Message could not be sent at this time. Please try again later.";
			} else {
				$alert['success'] = "Success! An e-mail has been sent.\n";
			}
		}
	}

	// The request form
	require_once('../pages/invite_page.php');
?>