<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "About";
			$pageDescription = "About EarthMates: What is it and what can it do for you?";
			include('includes/header.php'); 
		?>
	</head>
	<body>
		<!-- Fixed navbar -->
		<?php include('includes/navbar.php'); ?>
	
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>About</h1>
      </div>
			<p class="lead">What is EarthMates?</p>
			<p>
			If you've ever asked yourself the question <em>Am I doing the best I can do? Am I being the best I can be?</em> then EarthMates is the tool for you. If you've ever wondered how people see
			you and your abilities in the workplace and in life, EarthMates is the tool for you. For the first time, you can take a journey through your personality and character, and discover (perhaps
			for the first time) who you are and what you're good at.
			</p>
			<p>
			By working with this website, you'll engage with 17 competencies we believe to encompass the full range of the human experience. But don't take our word for it. If you've ever read leading
			self-help gurus and business experts life Dale Carnegie, Stephen Covey, Jim Collins, etc., you'll surely recognize many, if not all, of the competencies listed.
			</p>
    </div>
		
		<!-- Static footer -->
		<?php include('includes/footer.php'); ?>
	</body>
</html>