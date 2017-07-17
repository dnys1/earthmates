<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
		
    <link rel="icon" href="favicon.ico">

    <title>EarthMates Home</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	
	<!-- Custom styles for this page -->
    <link href="css/cover.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">EarthMates</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="#">Home</a></li>
									<li><a href="about.php">About</a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
										<ul class="dropdown-menu">
										<?php
											// if logged in
											if (isset($_SESSION['userID'])) {
												echo '<li><a href="profile.php">Profile</a></li>' . "\n";
												echo '<li><a href="logout.php">Log Out</a></li>' . "\n";
											}
											else
											{
												echo '<li><a href="login.php">Log In</a></li>';
												echo '<li><a href="signup.php">Sign Up</a></li>';
											}
											?>
										</ul>
									</li>
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading">Brutally honest.</h1>
            <p class="lead">For the truly brave of heart comes an opportunity to share and invite a new level <b>vulnerability</b> and <b>transparency</b> into your life.</p>
            <p class="lead">
              <a href="signup.php" class="btn btn-lg btn-default">Take the dive</a><br>
            </p>
						<small><a href="login.php"><u>Sign In</u></a></small>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>&copy 2017 Dillon Nys</p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
