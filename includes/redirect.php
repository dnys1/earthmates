<?php
function redirect_to($site)
{
	header('Location: ' . $site);
	exit();
}
?>