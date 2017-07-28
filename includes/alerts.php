<?php
	$alert = array("success" => "", "error" => "");
	
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
						echo '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> ';
						echo  $value;
						echo '</div>';
					}
				case "error":
					if (!empty($value))
					{
						echo '<div class="alert alert-danger" role="alert">';
						echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ';
						echo 'The following errors were found. Please fix them and try again.';
						echo '<ul>' . $value . '</ul>';
						echo '</div>';
					}
			}
		}
	}
?>