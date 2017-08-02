<?php
	/********* INCLUDES **********/
	require_once('includes/session_start.php');
	require_once('includes/db_functions.php');
	require_once('includes/redirect.php');
	require_once('includes/alerts.php');
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
				postValue($tokenUserID, $tokenFollowerID, $competency, $answer);
				
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
				// If the answer is not set (unanswered question)
				// and the question number is not already in our array
				// Add it to the end
				if(!in_array($value->ID, $incompleteQ))
					$incompleteQ[] = $value->ID;
			}
		}
		
		// Quiz complete 
		if(!isset($incompleteQ) || empty($incompleteQ))
		{
			if(isset($_SESSION['userID']) &&  $_SESSION['userID'] == $tokenFollowerID && $_SESSION['userID'] == $tokenUserID)
			{
				updateQuizComplete($_SESSION['userID']);				
				redirect_to('scores.php?success=1');
			}
			else if(isset($_SESSION['token']))
			{
				updateQuizComplete($_SESSION['token'], true);
				
				// Delete the token and invalidate it
				// so it can no longer be referenced
				invalidateToken($_SESSION['token']);
				unset($_SESSION['token']);
				
				redirect_to('index.php?success=1');
			}
		}
		// Quiz incompelte
		else
		{
			$incompleteString = json_encode($incompleteQ);
			
			if(isset($_SESSION['userID']) &&  $_SESSION['userID'] == $tokenFollowerID && $_SESSION['userID'] == $tokenUserID)
			{
				saveIncompleteQuestions($_SESSION['userID'], $incompleteString);
				redirect_to('quiz.php?saved=1');
			}
			else if(isset($_SESSION['token']))
			{
				saveIncompleteQuestions($_SESSION['token'], $incompleteString, true);
				redirect_to('quiz.php?token=' . $_SESSION['token'] . '&saved=1');
			}
				
			$_SESSION['quizResume'] = $incompleteString;
		}
	}
	else
	{	
		if(isset($_GET['token']) && !empty($_GET['token']))
		{
			$_SESSION['token'] = $token = $_GET['token'];
			$tokenInfo = getTokenInfo($token);
			
			if(!empty($tokenInfo))
			{
				// if(expired(token)) redirect, invalidate
				
				$tokenUserID = $tokenInfo['UserID'];
				$tokenFollowerID = $tokenInfo['FollowerID'];
				$_SESSION['quizResume'] = getIncompleteQuestions(NULL, $token);
			}
			else
			{
				// Invalid token
				redirect_to('index.php?token-invalid=1');
			}
			
			if(isset($_GET['saved']) && $_GET['saved'] == 1)
			{
				$alert['success'] = "Your quiz has been saved! Return to the same link at any point to continue where you left off.";
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
			
			if ($_SESSION['quizComplete'])
			{
				redirect_to('profile.php?completed=1');
			}
			
			$_SESSION['quizResume'] = getIncompleteQuestions($_SESSION['userID']);
			
			if(isset($_GET['saved']) && $_GET['saved'] == 1)
			{
				$alert['success'] = "Your quiz has been saved! Return to the same link at any point to continue where you left off.";
			}
		}
	
	include('pages/quiz_page.php');
	}
?>

