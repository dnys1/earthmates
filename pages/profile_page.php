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
			<?php if(isset($message)) { echo $message; } ?>
		
      <div class="page-header">
        <h1>Profile <small><?php echo $_SESSION['userName']; ?></small></h1>
      </div>
			
			<?php
				if (!$quizComplete)
					echo  '<p class="lead welcome-text">' . "It looks like you're just getting started. That's great! Complete the self-assessment to generate your competency scores
								and feel free to invite as many people as you'd like to increase the accuracy of your scores.</p>\n";
			?>
			
			<div class="profile-buttons">
				<?php 
					if (!$quizComplete)
						echo '<a href="quiz.php" class="btn btn-lg btn-success profile-button">Take the Quiz!</a>';
					else
						echo '<a href="quiz.php" class="btn btn-lg btn-success profile-button disabled">Take the Quiz!</a>';
				?>
				<a href="request.php" class="btn btn-lg btn-success profile-button">Request Feedback</a>
			</div>
			
			<?php if($quizComplete) include('pages/profile_table.php') ?>
		</div>
	<?php include('includes/footer.php'); ?>
	</body>
</html>