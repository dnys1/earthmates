<div class="panel panel-default profile-panel" id="profile-panel">		
	<div class="panel-body">
		<p class="lead welcome-text">It looks like you're just getting started. That's great! Complete the self-assessment and invite one friend to evaluate you in order to view your scores.</p>					
		<div class="profile-buttons">
			<?php 
				if (!$_SESSION['quizComplete'])
					echo '<a href="quiz.php" class="btn btn-lg btn-default profile-button" id="quiz">Take the Quiz!</a>';
				else
					echo '<a href="quiz.php" class="btn btn-lg btn-default profile-button disabled" is"quiz">Take the Quiz!</a>';
				
				if(!$_SESSION['receivedFeedback'])
					echo '<a href="invite.php" class="btn btn-lg btn-default profile-button" id="invite">Invite Friend</a>';
				else
					echo '<a href="invite.php" class="btn btn-lg btn-default profile-button disabled" id="invite">Invite Friend</a>';
			?>
		</div>
	</div>
</div>