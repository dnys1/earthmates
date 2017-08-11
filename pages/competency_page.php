<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = $competencyName;
			$pageDescription = "Competency: " . $competencyName;
			include('../includes/header.php'); 
		?>
	</head>

  <body>

		<!-- Fixed navbar -->
		<?php include('../includes/navbar.php'); ?>

		<!-- Begin page content -->
		<div class="container">
		
			<!-- Breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="profile.php">Profile</a></li>
				<li><a href="dashboard.php">View Scores</a></li>
				<li class="active">Competency Score</li>
			</ol>
			
			<div class="page-header">
				<h1><?php echo $competencyName ?></h1>
			</div>
			
			<?php include('scores_panel.php'); ?>
			
			<!-- Score panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Behavior Sets</h3>
				</div>
				<div class="panel-body" id="score-panel">
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<h2 class="text-center">Level 0</h2>
							<hr>
							<ul>
								<?php
									$level0 = explode("\n", $competencyDescriptions['0']);
									foreach($level0 as $desc)
									{
										echo "<li>".$desc."</li>";
									}
								?>
							</ul>
						</div>
						<div class="col-md-6 col-xs-12">
							<h2 class="text-center">Level 5</h2>
							<hr>
							<ul>
								<?php
									$level5 = explode("\n", $competencyDescriptions['5']);
									foreach($level5 as $desc)
									{
										echo "<li>".$desc."</li>";
									}
								?>
							</ul>
						</div>
					</div>
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
					<th>Score</th>
					<th>Comments</th>
					<th>Date</th>
				</tr>
				<?php
						foreach ($competencyIndex as $commentRow)
						{
							$date = date('M d, Y', strtotime($commentRow['CommentTimestamp']));
							
							echo "<tr>";
							echo "<td>" . getUserName($commentRow['FollowerID']) . "</td>";
							echo "<td>" . $commentRow['Level'] . "</td>";
							echo "<td>";
							echo empty($commentRow['Comment']) ? "None" : $commentRow['Comment'];
							echo "</td>";
							echo "<td>" . $date . "</td>";
							echo "</tr>";
						}
				?>
				</table>
			</div>
		</div>
		
		<?php
			include('../includes/footer.php');
		?>
  </body>
</html>
