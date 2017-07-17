<?php
// start the session
session_start();

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();

header('Location: https://earthmates.000webhostapp.com');
exit();
?>
<DOCTYPE !html>
<html>
<body>
</body>
</html>