			<div class="panel panel-default profile-panel">		
				<div class="panel-body">
					<p class="lead welcome-text">It looks like you're just getting started. That's great! Complete the self-assessment and invite one friend to evaluate you in order to view your scores.</p>					
					<div class="profile-buttons">
						<?php 
							if (!$_SESSION['quizComplete'])
								echo '<a href="quiz.php" class="btn btn-lg btn-default profile-button">Take Self-Assessment</a>';
							else
								echo '<a href="quiz.php" class="btn btn-lg btn-default profile-button disabled">Take the Quiz!</a>';
							
							if(!$_SESSION['receivedFeedback'])
								echo '<a href="request.php" class="btn btn-lg btn-default profile-button">Invite Friend</a>';
							else
								echo '<a href="request.php" class="btn btn-lg btn-default profile-button disabled">Invite Friend</a>';
						?>
					</div>
				</div>
			</div>