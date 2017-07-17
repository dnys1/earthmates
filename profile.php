<?php
	session_start();
	
	if (!isset($_SESSION['userID']) || empty($_SESSION['userID'])) {
		header('Location: login.php');
		exit();
	}
?>
<!doctype html>
<html>
	<head>
		<?php 
			$pageTitle = "Profile";
			$pageDescription = "This is your EarthMates profile page!";
			include('includes/header.php');
		?>
	</head>
	<body>
		<?php include('includes/navbar.php'); ?>
		
    <!-- Begin page content -->
    <div class="container">
			<?php
				if ($_SERVER["REQUEST_METHOD"] == "GET")
				{
					if(isset($_GET['signup']) && intval($_GET['signup']) == 1) {
						echo '<div class="alert alert-success" role="alert">' . "\n";
						echo "Success! Welcome to your profile.\n";
						echo '</div>' . "\n";
					}
				}
			?>
		
      <div class="page-header">
        <h1>Profile <small><?php echo $_SESSION['userName']; ?></small></h1>
      </div>
			
			<!-- Generating competency content -->
			
    </div>
	
	<?php include('includes/footer.php'); ?>
	</body>
</html>