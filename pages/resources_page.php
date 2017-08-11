<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "Resources";
			$pageDescription = "A compiled list of resources geared towards becoming a better human being.";
			include('../includes/header.php'); 
		?>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('../includes/navbar.php'); ?>
	 
    <!-- Begin page content -->
    <div class="container">
			<!-- Breadcrumb -->
			<ol class="breadcrumb">
				<li><a href="profile.php">Profile</a></li>
				<li class="active">Resources</li>
			</ol>
		
      <div class="page-header">
        <h1><?php echo $pageTitle ?></h1>
				<p class="lead">A collection of books and videos tailored towards EarthMates users.</p>
      </div>
		<form class="form-inline resource-form">
			<div class="form-group categories">
				<label for="categories">Categories: </label>
				<select id="categories"></select>
			</div>
			<div class="form-group subcategories">
				<label for="subcategories">Subcategories: </label>
				<select id="subcategories"></select>
			</div>			
			<div class="form-group types">
				<label for="types">Types: </label>
				<select id="types"></select>
			</div>
		</form>
	  <div class="panel panel-default resources-panel">
			<div class="panel-heading">
				<h3 class="panel-title"></h3>
			</div>
			<div class="text-center empty-panel" id="resources-message">
				<h3>Please select a category and type to list resources.</h3>
			</div>
			<div class="text-center empty-panel" id="no-resources">
				<h3>There are currently no resources under that selection.</h3>
			</div>
			<table class="table resources-table">
				<thead>
					<tr>
						<th>Image</th>
						<th>Description</th>
						<th class="rating">Rating</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
    </div>
	
	<script src="js/resources.min.js"></script>
	
	<?php	include('../includes/footer.php'); ?>
  </body>
</html>
