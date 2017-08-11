<?php
require '../config.php';
require '../includes/sendgrid-php/sendgrid-php.php';
echo SENDGRID_API_KEY . '<br>';
echo getEnv('SENDGRID_API_KEY') . "<br>";
$from = new SendGrid\Email("Example User", "admin@earthmates.me");
$subject = "Sending with SendGrid is Fun";
$to = new SendGrid\Email("Example User", "dillon.andre.nys@gmail.com");
$content = new SendGrid\Content("text/plain", "and easy to do anywhere, even with PHP");
$mail = new SendGrid\Mail($from, $subject, $to, $content);
$sg = new \SendGrid(SENDGRID_API_KEY);
$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();
?>