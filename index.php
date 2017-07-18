<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "Home";
			$pageDescription = "EarthMates home page";
			include('includes/header.php'); 
		?>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('includes/navbar.php'); ?>

		<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>EarthMates</h1>
        <p>
					For you, the truly brave of heart, comes an opportunity to share and invite a new level of <b>vulnerability</b> and <b>transparency</b> into your life,
					with far-reaching personal and professional implications.
				</p>
        <p><a class="btn btn-primary btn-lg" href="about.php" role="button">Learn more &raquo;</a></p>
      </div>
    </div>
		
    <!-- Begin page content -->
    <div class="container">
			<h3>Based off the breakthrough principals of these works:</h3>
		
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Good to Great <small>Jim Collins</small></h2>
          <img src="img/collins.png" class="img-responsive" alt="Jim Collins Good to Great">
        </div>
        <div class="col-md-4">
          <h2>How to Win Friends and Influence People <small>Dale Carnegie</small></h2>
          <img src="img/carnegie.jpg" class="img-responsive" alt="Dale Carnegie How to Win Friends and Influence People">
       </div>
        <div class="col-md-4">
          <h2>The 7 Habits of Highly Effective People <small>Stephen Covey</small></h2>
          <img src="img/covey.jpg" class="img-responsive" alt="Stephen Covey The 7 Habits of Highly Effective People">
        </div>
      </div>
    </div>
	
	<?php
		// include('includes/page_nav.html');
		include('includes/footer.php');
	?>
  </body>
</html>
