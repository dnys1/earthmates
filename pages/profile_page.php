<!doctype html>
<html>
	<head>
		<?php 
			$pageTitle = "Profile";
			$pageDescription = "This is your EarthMates profile page!";
			include('../includes/header.php');
		?>
		<script>
			
		</script>
	</head>
	<body>
		<?php include('../includes/navbar.php'); ?>
		
    <!-- Begin page content -->
    <div class="container">
			<?php printAlerts(); ?>
			
			<!-- Breadcrumb -->
			<ol class="breadcrumb">
				<li class="active">Profile</li>
			</ol>
			
      <div class="page-header">
        <h1>Profile <small><?php echo $_SESSION['userName']; ?></small></h1>
      </div>

			<?php if(!$_SESSION['quizComplete'] || !$_SESSION['receivedFeedback']) include('profile_panel.php'); ?>
			
			<div class="profile row" id="profile">
				<div class="col-md-4 col-xs-6 profile-picture pull-left">
					<img src="profile_image.php" class="img-responsive" />
					<button type="button" class="btn btn-default change-profile-pic" data-toggle="modal" data-target="#change-profile-pic">Change</button>
				</div>
				<div class="col-md-8 col-xs-12 profile-info">
					<div id="name" ><h2><b>Name: </b><?php echo $_SESSION['userName']; ?></h2><!--<a href="#">Edit</a>--></div>
					<div id="email"><h2><b>Email: </b><?php echo $_SESSION['userEmail']; ?></h2></div>
					<div id="timezone"><h2><b>Timezone: </b><?php echo array_search(getTimezone($_SESSION['userID']), $timezones); ?></h2></div>
				</div>
			</div>
			
			<!-- Change Profile Picture modal -->
			<div class="modal" id="change-profile-pic" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form role="form" enctype="multipart/form-data" id="uploadForm" action="profile.php" method="post">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Upload Profile Picture</h4>
							</div>
							<div class="modal-body">
								<div id="messages"></div>
								Choose picture to upload&hellip;
								<input type="file" name="file" id="file" />
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			
		</div>
		
		
		<?php
			// Set up welcome tour
			if((isset($_GET['signup']) && intval($_GET['signup']) == 1) || $_SESSION['showInfoMessage'])
				echo '<script src="js/welcome.min.js"></script>';
		?>
	<?php include('../includes/footer.php'); ?>
	</body>
</html>