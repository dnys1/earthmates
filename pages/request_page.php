<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "Request Feedback";
			$pageDescription = "Page to request feedback";
			include('includes/header.php'); 
		?>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('includes/navbar.php'); ?>

    <!-- Begin page content -->
    <div class="container">
		<?php if(isset($message)) { echo $message; } ?>
		
      <div class="page-header">
        <h1><?php echo $pageTitle ?></h1>
      </div>
    </div>
		
		<!-- Request form -->
    <div class="container">
			<?php
				if (isset($err) && !empty($err)) {
					echo '<div class="alert alert-danger" role="alert">' . "\n";
					echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>' . "\n";
					echo '<span class="sr-only">Error:</span>' . "\n";
					echo "The following errors were found. Please fix them and try again.\n";
					echo "<ul>\n";
					echo $err;
					echo "</ul>\n";
					echo "</div>\n";
				}
			?>
			<p>In order to request feedback, please fill out the form below.</p>
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
		include('includes/footer.php');
	?>
  </body>
</html>
