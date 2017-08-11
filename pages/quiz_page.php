<!DOCTYPE html>
<html lang="en">
  <head>
		<?php
			if(isset($tokenFollowerID) && !empty($tokenFollowerID))
			{
				$selfAssessment = false;
				$pageTitle = "Assessment";
				$pageDescription = "Time to evaluate your peer!";
			}
			else
			{
				$selfAssessment = true;
				$pageTitle = "Self-Assessment";
				$pageDescription = "Time to test your skills!";
			}
			include('../includes/header.php'); 
		?>
		<script>
			var selfAssessment = <?php echo $selfAssessment ? 'true' : 'false';?>;
			var quizResume = [];
			<?php if(isset($_SESSION['quizResume'])) echo "quizResume = " . $_SESSION['quizResume'] . ";"; ?>
		</script>
		<script src="js/quiz.min.js"></script>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('../includes/navbar.php'); ?>
		
    <!-- Begin page content -->
    <div class="container">
			<?php printAlerts(); ?>
			
			<!-- Breadcrumb -->
			<?php if($selfAssessment)
			{
				echo '<ol class="breadcrumb">';
				echo '<li><a href="profile.php">Profile</a></li>';
				echo '<li class="active">Self-Assessment</li>';
				echo '</ol>';
			}
			?>
			
      <div class="page-header">
        <h1><?php echo $pageTitle; if(!$selfAssessment) echo " for " . getUserName($tokenUserID); ?></h1>
      </div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em">
							0%
						</div>
					</div>
				</div>
				
				<!-- Welcome panel -->
				<div class="panel-body" id="welcomeScreen">
					<?php 
					if($selfAssessment)
					{
						echo 	"Welcome to the self assessment. You'll be asked to evaluate a series of statements regarding your
									personal beliefs and levels of awareness. Please answer as honestly as possible. Only you will be
									able to see the results of the assessment, unless you choose otherwise.<br><br>";
					}
					else
					{
						echo 	"Thanks for choosing to take part in this assessment. You'll be asked to evaluate a series of statements
									regarding " . getFirstName($tokenUserID) . "'s behaviors and levels of awareness. Please answer as honestly
									as possible. Only they will be able to see the results of the assessment.<br><br>";
					}
					?>
					There are <span id="numQuestions" class="fa fa-spinner fa-spin"></span> questions. Click on "Save Progress" if you would like to come back later to finish.<br><br>
					<button type="button" class="btn btn-default center-block" id="startButton">Start</button>
				</div>
				
				<!-- Quiz container -->
			<div id="quizContainer">
				<form id="quizForm" method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>">
					<h3 id="question"></h3>
					<div class="radio form-group">
						<label>
							<input type="radio" name="answerRadio" id="answerRadio0" value="0">
							Very untrue of <span class="meOrThem"></span>
						</label>
					</div>
					<div class="radio form-group">
						<label>
							<input type="radio" name="answerRadio" id="answerRadio1" value="1">
							Untrue of <span class="meOrThem"></span>
						</label>
					</div>
					<div class="radio form-group">
						<label>
							<input type="radio" name="answerRadio" id="answerRadio2" value="2">
							Somewhat untrue of <span class="meOrThem"></span>
						</label>
					</div>
					<div class="radio form-group">
						<label>
							<input type="radio" name="answerRadio" id="answerRadio3" value="3">
							Somewhat true of <span class="meOrThem"></span>
						</label>
					</div>
					<div class="radio form-group">
						<label>
							<input type="radio" name="answerRadio" id="answerRadio4" value="4">
							True of <span class="meOrThem"></span>
						</label>
					</div>
					<div class="radio form-group">
						<label>
							<input type="radio" name="answerRadio" id="answerRadio5" value="5">
							Very true of <span class="meOrThem"></span>
						</label>
					</div>
					<input type="hidden" name="answers" />
					<input type="hidden" name="competencyValues" />
					<input type="hidden" name="tokenUserID" value="<?php if(isset($tokenUserID)) echo $tokenUserID; ?>" />
					<input type="hidden" name="tokenFollowerID" value="<?php if(isset($tokenFollowerID)) echo $tokenFollowerID; ?>" />
					<div class="form-group">
						<button type="button" class="btn btn-lg btn-default" id="prevQuestion">Previous</button>
						<button type="button" class="btn btn-lg btn-default" id="nextQuestion">Next</button>
						<button type="button" class="btn btn-lg btn-primary pull-right" id="saveProgress">Save Progress</button>
						<button type="button" class="btn btn-lg btn-success pull-right" id="submitQuiz">Submit</button>
					</div>
				</form>
			</div>
			</div>
		
    </div>
	
	<?php	include('../includes/footer.php');	?>
  </body>
</html>