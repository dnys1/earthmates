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
		
			<!--
			<div class="panel panel-default">
				<div class="panel-heading">What Do Your Scores Mean?</div>
				<div class="panel-body">
					<p>In general, the scoring was designed to follow this pattern:</p>
					<ul>
						<li><b>Level 0:</b> </li>
						<li><b>Level 1:</b> </li>
						<li><b>Level 2:</b> </li>
						<li><b>Level 3:</b> </li>
						<li><b>Level 4:</b> </li>
						<li><b>Level 5:</b> </li>
					</ul>
				</div>
			</div>-->
		
			<!-- Scores Table -->
			<div class="panel panel-default">
				<div class="panel-heading">Competencies (Click for more information)</div>
				<table class="table table-hover profile-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Competency</th>
							<th class="table-score">Scores<br>(<span class="you">You</span> vs. <span class="l1">O</span><span class="l2">t</span><span class="l3">h</span><span class="l4">e</span><span class="l5">r</span><span class="l6">s</span>)</th>
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