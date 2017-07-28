<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "View Scores";
			$pageDescription = "Your EarthMates scores";
			include('includes/header.php'); 
		?>
	<script src="https://d3js.org/d3.v4.min.js"></script>
	<script src="js/scores.js"></script>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('includes/navbar.php'); ?>
	 
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1><?php echo $pageTitle ?></h1>
      </div>
		
			<?php include('scores_panel.php'); ?>
		
			<!-- Scores Table -->
			<div class="panel panel-default">
				<div class="panel-heading">Competencies (Click for more information)</div>
				<table class="table table-hover profile-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Competency</th>
							<th class="table-score">Scores<br>(You vs. Others)</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$competencies = getAllCompetencies();
						$index = 1;
						
						foreach ($competencies as $row)
						{
							echo '<tr onclick="window.document.location=\'competency.php?id=' . $row['ID'] . "'\">\n";
							echo "<td>" . $index . "</td>\n";
							echo "<td>" . $row['Competency'] . "</td>\n";
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