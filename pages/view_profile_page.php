<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "View Profile";
			$pageDescription = "View EarthMate user's profile.";
			include('includes/header.php'); 
		?>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('includes/navbar.php'); ?>
	 
    <!-- Begin page content -->
    <div class="container">
		
			<ol class="breadcrumb">
				<li><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Search</a></li>
				<li class="active">View Profile</li>
			</ol>
		
			<div class="page-header">
        <h1>Profile <small><?php if(!empty($profile)) echo $userName; else echo "Private"; ?></small></h1>
      </div>

			<?php
				if(!empty($profile))
				{
					include('includes/view_profile_panel.php');
				}
				else
				{
					include('includes/empty_profile_panel.php');
				}
			?>
		</div>
			
	<?php	include('includes/footer.php'); ?>
  </body>
</html>
