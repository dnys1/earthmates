<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = $competencyName;
			$pageDescription = "Competency: " . $competencyName;
			include('includes/header.php'); 
		?>
	</head>

  <body>

		<!-- Fixed navbar -->
		<?php include('includes/navbar.php'); ?>

		<!-- Begin page content -->
		<div class="container">
			<div class="page-header">
				<h1><?php echo $competencyName ?></h1>
			</div>
			<p class="lead">Your score is: <?php echo getAverageCompetencyScore($_SESSION['userID'], $competencyID) ?></p>
			
			<!-- Comments panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Comments</h3>
				</div>
				<div class="panel-body">
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
		</div>
		
		<?php
			include('includes/footer.php');
		?>
  </body>
</html>
