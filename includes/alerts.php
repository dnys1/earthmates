<?php
	$alert = array("success" => "", "error" => "", "info" => "");
	
	function printAlerts()
	{
		global $alert;
		
		foreach ($alert as $key => $value)
		{
			switch($key)
			{
				case "success":
					if (!empty($value))
					{
						echo '<div class="alert alert-success" role="alert">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						echo '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> ';
						echo  $value;
						echo '</div>';
					}
					break;
				case "multerror":
					if (!empty($value))
					{
						echo '<div class="alert alert-danger" role="alert">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ';
						echo 'The following errors were found. Please fix them and try again.';
						echo '<ul>' . $value . '</ul>';
						echo '</div>';
					}
					break;
				case "error":
					if (!empty($value))
					{
						echo '<div class="alert alert-danger" role="alert">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ';
						echo  $value;
						echo '</div>';
					}
					break;
				case "info":
					if(!empty($value))
					{
						echo '<div class="alert alert-info" role="alert">';
						echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						echo $value;
						echo '</div>';
					}
			}
		}
	}
?>