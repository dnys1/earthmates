<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "Invite Friend";
			$pageDescription = "Page to invite a friend to submit feedback";
			include('../includes/header.php'); 
		?>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('../includes/navbar.php'); ?>

    <!-- Begin page content -->
    <div class="container">		
		<?php printAlerts(); ?>
		
			<!-- Breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="profile.php">Profile</a></li>
				<li class="active">Invite Friend</li>
			</ol>
		
      <div class="page-header">
        <h1><?php echo $pageTitle ?></h1>
      </div>
    </div>
		
		<!-- Request form -->
    <div class="container">
			<p class="text-center lead">Enter the information of the person you'd like to request feedback from.</p>
      <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>">
				<div class="form-group">
					<label for="firstName">First Name</label>
					<input type="text" id="firstName" name="firstName" class="form-control" placeholder="John" required autofocus>
				</div>
				<div class="form-group">
					<label for="lastName">Last Name</label>
					<input type="text" id="lastName" name="lastName" class="form-control" placeholder="Doe" required>
				</div>
				<div class="form-group">
					<label for="inputEmail">Email address</label>
					<input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="johndoe@example.com" required>
				</div>
				
        <button class="btn btn-lg btn-primary btn-block center-block" type="submit">Send Request</button>
      </form>
	</div>
	<?php
		include('../includes/footer.php');
	?>
  </body>
</html>
