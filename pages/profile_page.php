<!doctype html>
<html>
	<head>
		<?php 
			$pageTitle = "Profile";
			$pageDescription = "This is your EarthMates profile page!";
			include('includes/header.php');
		
			// Set up welcome tour
			if(isset($_GET['signup']) && intval($_GET['signup']) == 1)
				echo '<script src="js/welcome.js"></script>';
		?>
	</head>
	<body>
		<?php include('includes/navbar.php'); ?>
		
    <!-- Begin page content -->
    <div class="container">
			<?php printAlerts(); ?>
			
      <div class="page-header">
        <h1>Profile <small><?php echo $_SESSION['userName']; ?></small></h1>
      </div>

			<?php if(!$_SESSION['quizComplete'] || !$_SESSION['receivedFeedback']) include('profile_panel.php'); ?>
			
			<div class="profile row" id="profile">
				<div class="col-md-2 col-xs-6 profile-picture">
					<img src="img/anonymous.png" class="img-responsive pull-left" />
				</div>
				<div class="col-md-10 col-xs-12 profile-info">
					<h2><b>Name: </b><?php echo $_SESSION['userName']; ?></h2>
					<h2><b>Email: </b><?php echo $_SESSION['userEmail']; ?></h2>
					<h2><b>Timezone: </b><?php echo array_search(getTimezone($_SESSION['userID']), $timezones); ?></h2>
				</div>
			</div>
		</div>
	<?php include('includes/footer.php'); ?>
	</body>
</html>