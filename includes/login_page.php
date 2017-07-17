<?php
	if (isset($_SESSION['userID'])) {
		header('Location: profile.php');
		exit();
	}
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
	
		<?php
				if (isset($err) && !empty($err)) {
					echo '<div class="text-center form-error"><p>The following errors were found. Please fix them and try logging in again.</p>' . "\n";
					echo '<ul style="list-style:none">' . "\n";
					echo $err;
					echo "</ul></div>\n";
				}
		?>
		
		<!-- Begin page content -->
    <div class="container">
			<form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
        <h2 class="form-signin-heading">Sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
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