<?php
	function on_page ($page) {
		$script = $_SERVER["REQUEST_URI"];
		if(strpos($script, $page) !== false) {
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
				<?php
							// If not logged in
							// echo the dropdown 'Account' menu
							if(!isset($_SESSION['userID'])) {
								echo '<li><a href="./">Home</a></li>';
								echo '<li ';
								echo on_page('about.php') ? 'class="active"' : '';
								echo '><a href="about.php">About</a></li>';
								echo '<li class="dropdown">';
								echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>';
								echo '<ul class="dropdown-menu">';						
								echo '<li ';
								echo on_page('login.php') ? 'class="active"' : '';
								echo '><a href="login.php">Log In</a></li>';
								echo '<li ';
								echo on_page('signup.php') ? 'class="active"' : '';
								echo '><a href="signup.php">Sign Up</a></li>';
								echo '</ul>';
							}
						?>
					</ul>
				</li>
			</ul>
			<?php
				if (isset($_SESSION['userID'])) {
					echo '<ul class="nav navbar-nav navbar-right">';
					echo '<li class="dropdown">';
					echo '<a id="dropdown-toggle" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $_SESSION['userName'] . '	<span class="caret"></span></a>';
					echo '<ul class="dropdown-menu" id="dropdown-menu">';
					echo '<li ';
					echo on_page('profile.php') ? 'class="active"' : '';
					echo '><a href="profile.php">Profile</a></li>';
					echo '<li ';
					echo on_page('invite.php') ? 'class="active"' : '';
					echo '><a href="invite.php">Invite Friend</a></li>';
					if($_SESSION['quizComplete'] && $_SESSION['receivedFeedback']) {
						echo '<li role="separator" class="divider"></li>';
						echo '<li ';
						echo on_page('dashboard.php') ? 'class="active"' : '';
						echo '><a href="dashboard.php"><b>Dashboard</b></a></li>';
						echo '<li ';
						echo on_page('resources.php') ? 'class="active"' : '';
						echo '><a href="resources.php">Resources</a></li>';
					}
					echo '<li role="separator" class="divider"></li>';
					echo '<li ';
					echo on_page('settings.php') ? 'class="active"' : '';
					echo '><a href="settings.php">Settings</a></li>';
					echo '<li><a href="logout.php">Log Out</a></li>';
					echo '</li></ul>';
					echo '</ul>';
					
					echo '<form class="navbar-form navbar-right" role="search" method="get" action="search_users.php">';
					echo '<div class="form-group">';
					echo '<input type="text" class="form-control" placeholder="Search Users" name="q">';
					echo '</div>';
					echo '<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>';
					echo '</form>';
					}
			?>
		</div><!--/.nav-collapse -->
	</div>
</nav>