<?php
	$script = $_SERVER["REQUEST_URI"];
	$script = ltrim($script, '/');
	
	function on_page ($page) {
		global $script;
		if(strcmp($script, $page) == 0) {
			return true;
		}
		return false;
	}
?>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="./">EarthMates</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="./">Home</a></li>
				<li <?php echo on_page('about.php') ? 'class="active"' : ''?>><a href="about.php">About</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php
							// If not logged in
							if(!isset($_SESSION['userID'])) {
								echo '<li ';
								echo on_page('login.php') ? 'class="active"' : '';
								echo '><a href="login.php">Log In</a></li>';
								echo '<li ';
								echo on_page('signup.php') ? 'class="active"' : '';
								echo '><a href="signup.php">Sign Up</a></li>';
							}
							// If logged in
							else
							{
								echo '<li><a href="logout.php">Log Out</a></li>';
							}
						?>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<?php
				if (isset($_SESSION['userID'])) {
					echo '<li ';
					echo on_page('profile.php') ? 'class="active"' : '';
					echo '><a href="profile.php">Profile</a></li>';
				}
			?>
			 </ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>