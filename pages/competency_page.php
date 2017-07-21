<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = $competencyName;
			$pageDescription = "Competency: " . $competencyName;
			include('includes/header.php'); 
		?>
		<script>
			var $_GET = <?php echo json_encode($_GET); ?>;
		</script>
		<script src="js/load_resources.js"></script>
	</head>

  <body>

		<!-- Fixed navbar -->
		<?php include('includes/navbar.php'); ?>

		<!-- Begin page content -->
		<div class="container">
			<div class="page-header">
				<h1><?php echo $competencyName ?></h1>
			</div>
			
			<!-- Score panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Score Explanation</h3>
				</div>
				<div class="panel-body" id="scorePanel">
				<p class="lead text-center">
					Your score is: <?php echo number_format(getAverageCompetencyScore($_SESSION['userID'], $competencyID), 1); ?><br>
					
					<h4>Explain the score.</h4>
				</p>
				</div>
			</div>
			
			<!-- Resources panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Resources</h3>
				</div>
				<div class="panel-body" id="resourcePanel">
				<span id="spinner" class="fa fa-spinner fa-spin"></span>
				</div>
			</div>
			
			<!-- Comments panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Comments</h3>
				</div>
				<table class="table">
				<tr>
					<th>Reviewer</th>
					<th>Date</th>
					<th>Score</th>
					<th>Comments</th>
				</tr>
				<?php
						foreach ($competencyIndex as $commentRow)
						{
							echo "<tr>\n";
							echo "<td>" . getUserName($commentRow['FollowerID']) . "</td>\n";
							echo "<td>" . $commentRow['CommentTimestamp'] . "</td>\n";
							echo "<td>" . $commentRow['Level'] . "</td>\n";
							echo "<td>" . $commentRow['Comment'] . "</td>\n";
							echo "</tr>\n";
						}
				?>
				</table>
			</div>
		</div>
		
		<?php
			include('includes/footer.php');
		?>
  </body>
</html>
