<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "Dashboard";
			$pageDescription = "Your EarthMates scores";
			include('includes/header.php'); 
		?>	
	<script src="js/scores.js"></script>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('includes/navbar.php'); ?>
	 
    <!-- Begin page content -->
    <div class="container">
			<?php
			if($_SESSION['showInfoMessage'])
			{
				echo '<div class="alert alert-success infoMessage fade in" role="alert">';
				echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
				echo '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> ';
				echo "Click on each of the competencies to learn more about your individual scores."; // and visit the 'Guide' in the menu to learn more about the EarthMates methodology.";
				echo '</div>';
			}
			?>
			
			<!-- Breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="profile.php">Profile</a></li>
				<li class="active">Dashboard</li>
			</ol>
			
			<div class="page-header">
        <h1><?php echo $pageTitle ?></h1>
      </div>
		
			<?php include('scores_panel.php'); ?>
		
			<!-- Scores Table -->
			<div class="panel panel-default">
				<div class="panel-heading">Competencies (Click for more information)</div>
				<table class="table table-hover score-table">
					<thead>
						<tr>
							<th><h3>#</h3></th>
							<th><h3>Competency</h3></th>
							<th class="table-score"><h3>Scores</h3>(You - <b>Top</b>, Peers - <b>Bottom</b>)</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$competencies = getAllCompetencies();
						$index = 1;
						
						foreach ($competencies as $row)
						{
							echo '<tr onclick="window.document.location=\'competency.php?id=' . $row['ID'] . "'\">\n";
							echo "<td><h5>" . $index . "</h5></td>\n";
							echo "<td><h5>" . $row['Competency'] . "</h5></td>\n";
							echo '<td class="table-score"></td>';
							echo "</tr></a>\n";
							
							$index++;
						}
					?>
					</tbody>
				</table>
			</div>
    </div>
	
	<?php	include('includes/footer.php'); ?>
  </body>
</html>