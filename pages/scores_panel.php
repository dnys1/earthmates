<script>
	var totalSelfScore = <?php if(on_page('scores.php')) echo getTotalAverageSelfScore($_SESSION['userID']);
														 else echo getAverageSelfCompetencyScore($_SESSION['userID'], $_GET['id']); 
												?>;
	var totalOtherScore = <?php if(on_page('scores.php')) echo getTotalAverageOtherScore($_SESSION['userID']); 
															else echo getAverageOtherCompetencyScore($_SESSION['userID'], $_GET['id']);
												?>;
</script>
<script src="js/scores_panel.js"></script>
<div class="panel panel-default">
	<div class="panel-heading">What Do Your Scores Mean?</div>
	<div class="panel-body">
		<div class="overallScore center-block"></div>
		<p>In general, the scoring was designed to follow this pattern:</p>
		<ul>
			<li><b>Level 0:</b> A person with no awareness around a set of Level 5 behaviors is classified as Level 0.</li>
			<li><b>Level 1:</b> A person with no awareness around a set of Level 5 behaviors is classified as Level 0.</li>
			<li><b>Level 2:</b> A person with no awareness around a set of Level 5 behaviors is classified as Level 0.</li>
			<li><b>Level 3:</b> A person with no awareness around a set of Level 5 behaviors is classified as Level 0.</li>
			<li><b>Level 4:</b> A person with no awareness around a set of Level 5 behaviors is classified as Level 0.</li>
			<li><b>Level 5:</b> A person with no awareness around a set of Level 5 behaviors is classified as Level 0.</li>
		</ul>
		<p>Click on each of the competencies to learn more about your individual scores.</p>
		<div class="score-gradient pull-left"></div>
	</div>
</div>