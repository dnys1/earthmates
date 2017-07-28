<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "Settings";
			$pageDescription = "Adjust your EarthMates settings";
			include('includes/header.php'); 
		?>
		<script>
			$(document).ready(function() {
				$("#visibleGlobally").prop("checked", <?php echo $visibleGlobally ? 'true' : 'false' ?>);
				$("#timezone").val("<?php echo $currentTimezone; ?>");
			});
		</script>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('includes/navbar.php'); ?>
	 
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1><?php echo $pageTitle ?></h1>
      </div>
		
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>">
			<div class="form-group">
				<input type="checkbox" id="visibleGlobally" name="visibleGlobally"> Profile is visible to everyone.
			</div>
			<div class="form-group">
				<label for="timezone">Timezone: </label>
				<select name="timezone" id="timezone">
					<?php foreach($timezones as $label => $timezone) echo '<option value="'.$timezone.'">'.$label.'</option>'; ?>
				</select>
			</div>
			<button type="submit" class="btn btn-lg btn-success">Save</button>
		</form>
    </div>
	
	<?php	include('includes/footer.php'); ?>
  </body>
</html>
