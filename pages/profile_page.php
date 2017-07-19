<!doctype html>
<html>
	<head>
		<?php 
			$pageTitle = "Profile";
			$pageDescription = "This is your EarthMates profile page!";
			include('includes/header.php');
		?>
		</style>
	</head>
	<body>
		<?php include('includes/navbar.php'); ?>
		
    <!-- Begin page content -->
    <div class="container">
			<?php if(isset($message)) { echo $message; } ?>
		
      <div class="page-header">
        <h1>Profile <small><?php echo $_SESSION['userName']; ?></small></h1>
      </div>
			
			<?php
				//Include either the start buttons or the table of competencies
				//depending on whether or not they've completed the self-quiz
				if ($empty)
				{
					include('includes/competency_start.php');
				} else
				{
					include('includes/competency_table.php');
				}
			?>
		</div>
	<?php include('includes/footer.php'); ?>
	</body>
</html>