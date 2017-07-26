<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "Resources";
			$pageDescription = "A compiled list of resources geared towards becoming a better human being.";
			include('includes/header.php'); 
		?>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('includes/navbar.php'); ?>
	 
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1><?php echo $pageTitle ?></h1>
      </div>
	  <p class="lead">Lead text</p>
    </div>
	
	<?php	include('includes/footer.php'); ?>
  </body>
</html>
