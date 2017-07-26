<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "Settings";
			$pageDescription = "Adjust your EarthMates settings";
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
		
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>">
			<div class="form-group">
				<input type="checkbox" id="visibleGlobally" name="visibleGlobally"> Profile is visible to everyone.
			</div>
			<button type="submit" class="btn btn-lg btn-success">Save</button>
		</form>
    </div>
	
	<?php	include('includes/footer.php'); ?>
  </body>
</html>
