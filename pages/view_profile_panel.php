<div class="profile row" id="profile">
	<div class="col-md-2 col-xs-6 profile-picture pull-left">
		<img src="profile_image.php?id=<?php echo $_GET['id']; ?>" class="img-responsive" />
	</div>
	<div class="col-md-10 col-xs-12 profile-info">
		<h2><b>Name: </b><?php echo $userName; ?></h2>
		<h2><b>Email: </b><?php echo $profile['Email']; ?></h2>
		<h2><b>Timezone: </b><?php echo array_search($profile['Timezone'], $timezones); ?></h2>
	</div>
</div>

<script>
	var totalSelfScore = <?php echo $profile['SelfScore'];	?>;
	var totalOtherScore = <?php echo $profile['OtherScore']; ?>;
	var other = true;
</script>
<script src="js/scores_panel.min.js"></script>
<div class="panel panel-default">
	<div class="panel-heading"></div>
	<div class="panel-body">
		<div class="overallScoreHeading text-center">
			<h2>
				<?php echo $profile['FirstName'] . "'s EarthMates score:"; ?><br>
				<small><?php echo "A comparison of their self-assessment vs. others'"; ?></small>
			</h2>
		</div>
		<div class="overallScore center-block"></div>
	</div>
</div>