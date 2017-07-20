<?php
	require_once('db_functions.php');
	
	// returns a SQL query
	// with the questions in the 
	// Questions table
	$quizQuestions = loadQuestionSet();
	
	echo json_encode($quizQuestions);
?>