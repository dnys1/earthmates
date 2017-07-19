<?php
	include('includes/ensure_login.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
			$pageTitle = "Login";
			$pageDescription = "Log In to your EarthMates profile!";
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
					echo 'Enter a valid email/password combination' . "\n";
					echo '</div>';
				}
			?>
			<form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
        <h2 class="form-signin-heading">Sign in</h2>
				<div class="input-group">
					<label for="inputEmail" class="sr-only">Email address</label>
					<span class="input-group-addon" id="basic-addon1">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					</span>
					<input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" aria-describedby="basic-addon1" required autofocus>
				</div>
				<div class="input-group">
					<label for="inputPassword" class="sr-only">Password</label>
					<span class="input-group-addon" id="basic-addon2">
						<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
					</span>
					<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" aria-describedby="basic-addon2" required>
				</div>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
					<a href="signup.php" class="pull-right"><u>Create an account</u></a>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

		<!-- Static footer -->
		<?php include('includes/footer.php'); ?>
  </body>
</html>