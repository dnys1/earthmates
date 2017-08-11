<?php
	require_once('../includes/session_start.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "About";
			$pageDescription = "About EarthMates: What is it and what can it do for you?";
			include('../includes/header.php'); 
		?>
	</head>
	<body>
		<!-- Fixed navbar -->
		<?php include('../includes/navbar.php'); ?>
	
    <!-- Begin page content -->
    <div class="container about-container">
      <div class="page-header">
        <h1>About</h1>
      </div>
			<h2>What is EarthMates?</h2>
			<p class="lead">
			If you've ever asked yourself the question "Am I being the best I can be?", then EarthMates is the tool for you.
			</p>
			<p>
			If you've ever wondered how people see
			you and your abilities in the workplace and in life, EarthMates is the tool for you. For the first time, you can take a journey through your personality and character, and discover (perhaps
			for the first time) who you are and what you're good at.
			</p>
			<p>
			By working with this website, you'll engage with 16 competencies we believe to encompass the full range of the human experience. But don't take our word for it. If you've ever read leading
			self-help gurus and business experts life Dale Carnegie, Stephen Covey, Jim Collins, etc., you'll surely recognize many, if not all, of the competencies listed.
			</p>
			<h2>Why?</h2>
			<div class="panel panel-default quotes-body">
				<div class="panel-body">
				<blockquote>
					<p>Great vision without great people is irrelevant.</p>
					<footer>Jim Collins in <cite title="Good to Great">Good to Great</cite></footer>
				</blockquote>
				</div>
			</div>
			<p>
			Business is about people. Without people who are fully functioning in both the technical and communicative domains, there will always be an element of cohesion that is missing and thus, a room for
			improvement. By becoming aware of what could be improved, we allow for the possibility of improvement. This tool is meant to serve as both a jumping off point, to get you grounded in a new reality,
			and as a springboard, to provide further resources to keep you heading in the right direction.<br><br>
			</p>
			<h4 class="text-center">
			We're not here to tell you what to do; we're only here to serve as a platform for honest dialogue.
			</h4>
			<div class="row">
				<div class="col-sm-12">
					<div class="text-center">
						<a class="btn btn-lg btn-primary about-button" href="signup.php">Let's get started!</a>
					</div>
				</div>
			</div>
    </div>
		
		<!-- Static footer -->
		<?php include('../includes/footer.php'); ?>
	</body>
</html>