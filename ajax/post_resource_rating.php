<?php
	require_once(__DIR__ . '/../../includes/db_functions.php');
	require_once(__DIR__ . '/../../includes/form_functions.php');
	require_once(__DIR__ . '/../../includes/session_start.php');
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		// POST rating
		
		if(isset($_POST['rating']) && isset($_POST['resource']))
		{
			$rating = test_input($_POST['rating']);
			$resource = test_input($_POST['resource']);
			$userID = $_SESSION['userID'];
			
			$result = postResourceRating($userID, $resource, $rating);
			
			if($result == 1)
				echo "Your score has been recorded.";
			else if ($result == 2)
				echo "Your score has been updated.";
			else
				echo "Your score could not be posted at this time.";
		}
	}
?>