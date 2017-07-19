<!DOCTYPE html>
<html lang="en">
  <head>
		<?php
			$pageTitle = "Signup";
			$pageDescription = "Sign Up for your awesome EarthMates account!";
			include('includes/header.php'); 
		?>
  </head>

  <body>
		<!-- Fixed navbar -->
		<?php include('includes/navbar.php'); ?>
		
		<!-- Begin page content -->
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
      <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>">
        <h2 class="form-signin-heading">Create an account</h2>
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
				
				<!-- Password section -->
				<div class="form-group">
					<label for="inputPassword">Pick a Password</label>
					<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
					<label for="retypePassword" class="sr-only">Retype Password</label>
					<input type="password" id="retypePassword" name="retypePassword" class="form-control" placeholder="Retype Password" required>
				</div><!-- End password -->
		
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up!</button>
				<a href="login.php" class="pull-right"><u>Already have an account?</u></a>
      </form>

    </div> <!-- /container -->

		<?php include('includes/footer.php'); ?>
  </body>
</html>
