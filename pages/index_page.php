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

	 <div class="container">
		<?php printAlerts(); ?>
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
			<h3>Based off the breakthrough principles of these works:</h3>
		
      <!-- Row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>How to Win Friends and Influence People <small>Dale Carnegie</small></h2>
          <a href="https://www.amazon.com/How-Win-Friends-Influence-People/dp/0671027034"><img src="img/carnegie.jpg" class="img-responsive" alt="Dale Carnegie How to Win Friends and Influence People"></a>
       </div>
        <div class="col-md-4">
          <h2>The 7 Habits of Highly Effective People <small>Stephen Covey</small></h2>
          <a href="https://www.amazon.com/Habits-Highly-Effective-People-Powerful/dp/0743269519"><img src="img/covey.jpg" class="img-responsive" alt="Stephen Covey The 7 Habits of Highly Effective People"></a>
        </div>
				<div class="col-md-4">
          <h2>The Four Agreements <small>Don Miguel Ruiz</small></h2>
          <a href="https://www.amazon.com/Four-Agreements-Practical-Personal-Freedom/dp/1878424319"><img src="img/ruiz.jpg" class="img-responsive" alt="Jim Collins Good to Great"></a>
        </div>
      </div>
    </div>
		</div>
	
	<?php
		// include('includes/page_nav.html');
		include('includes/footer.php');
	?>
  </body>
</html>
