<!DOCTYPE html>
<html lang="en">
  <head>
		<?php 
			$pageTitle = "Resources";
			$pageDescription = "A compiled list of resources geared towards becoming a better human being.";
			include('includes/header.php'); 
		?>
		<script src="js/resources.js"></script>
	</head>

  <body>

   <!-- Fixed navbar -->
   <?php include('includes/navbar.php'); ?>
	 
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1><?php echo $pageTitle ?></h1>
      </div>
		<form class="form-inline">
			<div class="input-group categories">
				<label for="categories">Categories: </label>
				<select id="categories"></select>
			</div>
			<div class="input-group subcategories">
				<label for="subcategories">Subcategories: </label>
				<select id="subcategories"></select>
			</div>			
			<div class="input-group types">
				<label for="types">Types: </label>
				<select id="types"></select>
			</div>
		</form>
	  <div class="panel panel-default resources-panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel title</h3>
			</div>
			<span id="resources-message">
				Please select a category to list resources.
			</span>
			<!--
			<div class="panel-body">
				<div class="row book-row">
					<div class="col-md-2 text-center book">
						<a target="_blank"  href="https://www.amazon.com/gp/product/1878424319/ref=as_li_tl?ie=UTF8&camp=1789&creative=9325&creativeASIN=1878424319&linkCode=as2&tag=earthmates08-20&linkId=372bd41194977884e7a7336f83480697"><img border="0" src="//ws-na.amazon-adsystem.com/widgets/q?_encoding=UTF8&MarketPlace=US&ASIN=1878424319&ServiceVersion=20070822&ID=AsinImage&WS=1&Format=_SL250_&tag=earthmates08-20" ></a><img src="//ir-na.amazon-adsystem.com/e/ir?t=earthmates08-20&l=am2&o=1&a=1878424319" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
						<p>Don Miguel Ruiz</p><h4>The Four Agreements</h4>
					</div>
					<div class="col-md-2 text-center book">
						<a target="_blank"  href="https://www.amazon.com/gp/product/0066620996/ref=as_li_tl?ie=UTF8&camp=1789&creative=9325&creativeASIN=0066620996&linkCode=as2&tag=earthmates08-20&linkId=591ce7ce4198e0888dee5ce0148d33de"><img border="0" src="//ws-na.amazon-adsystem.com/widgets/q?_encoding=UTF8&MarketPlace=US&ASIN=0066620996&ServiceVersion=20070822&ID=AsinImage&WS=1&Format=_SL250_&tag=earthmates08-20" ></a><img src="//ir-na.amazon-adsystem.com/e/ir?t=earthmates08-20&l=am2&o=1&a=0066620996" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
						<p>Jim Collins</p><h4>Good to Great</h4>
					</div>
				</div>
			</div>-->
			<table class="table resources-table">
				
			</table>
		</div>
    </div>
	
	<?php	include('includes/footer.php'); ?>
  </body>
</html>
