<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "Search Users";
			$pageDescription = "Search for EarthMates profiles";
			include('includes/header.php'); 
		?>
		<script>
			var results = '<?php if($results != NULL) echo json_encode($results); ?>';
		</script>
		<script src="js/search.js"></script>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('includes/navbar.php'); ?>
	 
    <!-- Begin page content -->
    <div class="container">
		
			<ol class="breadcrumb">
				<li class="active">Search</li>
			</ol>
		
      <div class="page-header">
        <h1><?php echo $pageTitle ?></h1>
      </div>
	  <p class="lead">Results found for "<?php if($_GET['q']) echo $_GET['q'] ?>"</p>
		<div class="panel panel-default search-panel">
			<div class="panel-heading"></div>
			<?php
				if($results == NULL){ echo '<div class="text-center empty-panel"><h3>No results found for "'.$query.'"</h3></div>'; }
				else
				{
					echo '<table class="table table-hover search-table">';
					echo '<thead>';
					echo '<th></th>';
					echo '<th>Name</th>';
					echo '<th>Score</th>';
					// echo '<th>Profile</th>';
					echo '</thead>';
					
					echo '<tbody>';
					$i = 0;
					foreach ($results as $profile)
					{
						if($i < 5)
						{
							echo "<tr>";
							echo '<td><img src="profile_image.php?id=' . $profile['ID'] . '" class="img-responsive" />';
							if($profile['GlobalProfile'])
							{
								echo '<td><a href="view_profile.php?id=' . $profile['ID'] . '">' . $profile['FirstName'] . " " . $profile['LastName'] . '</a></td>';
								echo '<td class="results-score">' . number_format(getTotalAverageOtherScore($profile['ID']), 1) . '</td>';
								// echo '<td><a class="btn btn-default center-block" role="button" href="view_profile.php?id=' . $profile['ID'] . '">Link</a></td>';
							}
							else 
							{
								echo '<td title="This user does not allow others to view their EarthMates profile.">' . $profile['FirstName'] . " " . $profile['LastName'] . '</td>';
								echo '<td title="This user does not allow others to view their EarthMates profile.">N/A</td>';
								// echo '<td><a class="btn btn-default center-block" disabled="disabled" href="#" role="button" title="This user does not allow others to view their EarthMates profile.">Link</a></td>';
							}	
							echo '</tr>';
						}
						$i++;
					}
					echo '</tbody>';
					echo '</table>';
					if(count($results) > 5) include('includes/results_pagination.php');
				}
			?>
		 
		</div>
    </div>
	
	<?php	include('includes/footer.php'); ?>
  </body>
</html>
