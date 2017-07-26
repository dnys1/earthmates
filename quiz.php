<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	/****************************/
	
	
	/* Process quiz data */
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// Get user and follower ids
		// Follower is leaving feedback about user
		if(!empty($_POST['tokenFollowerID']) && !empty($_POST['tokenUserID']))
		{
			$tokenUserID = $_POST['tokenUserID'];
			$tokenFollowerID = $_POST['tokenFollowerID'];
		}
		else
		{
			$tokenUserID = $tokenFollowerID = $_SESSION['userID'];
		}
		
		$incompleteQ = [];
		if(isset($_SESSION['quizResume'])) $incompleteQ = json_decode($_SESSION['quizResume']);
		
		$array = $_POST['answers'];
		$array = json_decode($array);
		
		foreach ($array as $value){
			if(isset($value->answer))
			{
				$competency = $value->competencyID;
				$answer = $value->answer;
				// postValue($tokenUserID, $tokenFollowerID, $competency, $answer);
				
				// If it was previously an unanswered question and this is a quiz resume
				// Delete it from the unanswered questions array
				if(!empty($incompleteQ) && in_array($value->ID, $incompleteQ))
				{
					$index = array_search($value->ID, $incompleteQ);
					array_splice($incompleteQ, $index, 1);
				}
			}
			else
			{
				if(!in_array($value->ID, $incompleteQ))
					$incompleteQ[] = $value->ID;
			}
		}
		
		// Quiz complete 
		if(!isset($incompleteQ) || empty($incompleteQ))
		{
			updateQuizComplete($tokenUserID, true);
		}
		// Quiz incompelte
		else
		{
			$incompleteString = json_encode($incompleteQ);
			saveIncompleteQuestions($tokenUserID, $incompleteString);
			$_SESSION['quizResume'] = $incompleteString;
		}
		
		// Delete the token and invalidate it
		// so it can no longer be referenced
		if(isset($_SESSION['token']))
			invalidateToken($_SESSION['token']);
		
		/*
		if (check_if_logged_in())
			redirect_to('scores.php?success=1');
		else
			redirect_to('index.php?success=1');*/
	}
	else
	{	
		if(isset($_GET['token']) && !empty($_GET['token']))
		{
			$_SESSION['token'] = $token = $_GET['token'];
			$tokenInfo = getTokenInfo($token);
			
			if(!empty($tokenInfo))
			{
				$tokenUserID = $tokenInfo['UserID'];
				$tokenFollowerID = $tokenInfo['FollowerID'];
			}
			else
			{
				// Invalid token
				redirect_to('index.php?token-invalid=1');
			}
		}
		else
		{
			if(!check_if_logged_in()) 
			{
				// User is not logged in
				// and no token is provided
				redirect_to('index.php?login-required=1');
			}
		}
	
	include('pages/quiz_page.php');
	}
?>

