<script>
	var totalSelfScore = <?php if(on_page('dashboard.php')) { echo getTotalAverageSelfScore($_SESSION['userID']); $onScoresPage = true; }
														 else { echo getAverageSelfCompetencyScore($_SESSION['userID'], $_GET['id']); $onScoresPage = false; }
												?>;
	var totalOtherScore = <?php if(on_page('dashboard.php')) { echo getTotalAverageOtherScore($_SESSION['userID']);}
															else echo getAverageOtherCompetencyScore($_SESSION['userID'], $_GET['id']);
												?>;
	var other = false;
</script>
<script src="js/scores_panel.js"></script>
<div id="scorePanel" class="panel panel-default">
	<div class="panel-heading"></div>
	<div class="panel-body">
	
		<div id="overallScoreHeading">
			<div id="overallScoreTitle" class="overallScoreHeading text-center">
				<h2>
					<?php echo $onScoresPage ? "Your EarthMates score:" : "Your Competency score:"; ?><br>
					<small><?php echo $onScoresPage ? "An average of your individual competency values." : "A comparison of your self-assessment vs. others'"?></small>
				</h2>
			</div>
			<div id="overallScore" class="overallScore center-block"></div>
		</div>
		
		<p class="lead">In general, the scoring was designed to follow this pattern:</p>
		<table id="scoreDescriptions" class="table score-panel-table">
		<tbody>
			<tr>
				<td style="border-top: none;" class="score-table-label">Level 0</td>
				<td style="border-top: none;">A person with no awareness around a set of Level 5 behaviors is classified as Level 0.</td>
			</tr>
			<tr>
				<td class="score-table-label">Level 1</td>
				<td>A person at Level 1 has become aware they are behaving inappropriately, yet is still controlled by their habit.</td>
			</tr>
			<tr>
				<td class="score-table-label">Level 2</td>
				<td>
					A person at Level 2 has taken their first steps towards changing their behaviors (habits).
					This stage is often characterized by modest attempts at Level 5 behavior, though nothing seems to stick.
				</td>
			</tr>
			<tr>
				<td class="score-table-label">Level 3</td>
				<td>
					A person at Level 3 has had their "breakthrough" moment in redefining their behavior. They had developed about
					repertoire with the Level 5 abilities and have begun to spiral inward. Their level of awareness forces them to
					notice their behaviors more in everything they do.
				</td>
			</tr>
			<tr>
				<td class="score-table-label">Level 4</td>
				<td>
					As a person spirals inward, they develop proficiency with the Level 5 skills, and with that, a level of re-inforced
					positivity around the skills. In other words, the new behaviors become pleasing to do, because the person has become
					good at them, which incentivizes them to continue getting better (to a point). This stage is often characterized by
					performing the Level 5 skills nearly perfect (95%+ of the time)... meaning too, they are still making exceptions
					when it is more convenient to perform the Level 0 behaviors.
				</td>
			</tr>
			<tr>
				<td class="score-table-label">Level 5</td>
				<td>
					At Level 5, a person is a perfect role model for these behaviors, often called on for their expertise, and constantly
					sacrificing convenience in order to do what is Right.
				</td>
			</tr>
		</tbody>
		</table>
		<div class="score-gradient pull-left"></div>
	</div>
</div>