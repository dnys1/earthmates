<?php
session_start();
	
/********* INCLUDES **********/
require_once('includes/db_functions.php');
require_once('includes/redirect.php');
include('includes/ensure_login.php');
/****************************/

// Assign variables. Get competency info from DB.
if ($_SERVER["REQUEST_METHOD"] == "GET")
{				
	if (isset($_GET['id']) && intval($_GET['id']) >= 1)
	{
		$competencyID = $_GET['id'];
		$competencyName = getCompetency($competencyID);
		$competencyIndex = getCompetencyIndex($_SESSION['userID'], $competencyID);
	}
	else
	{
		redirect_to('profile.php');
	}
}
	
require_once('pages/competency_page.php');
?>