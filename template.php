<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "Template";
			$pageDescription = "EarthMates template page";
			include('includes/header.php'); 
		?>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('includes/navbar.php'); ?>

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Page header</h1>
      </div>
	  <p class="lead">Lead text</p>
    </div>
	
	<?php
		// include('includes/page_nav.html');
		include('includes/footer.php');
	?>
  </body>
</html>
