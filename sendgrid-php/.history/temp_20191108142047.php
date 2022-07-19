<?php
require 'vendor/autoload.php';

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("ethomas@twilio.com", "Elmer Thomas");
$email->setSubject("Sending with Twilio SendGrid is Fun");
try {
    $email->addTo("test@example", "Bad User");
} catch (SendGrid\Mail\TypeException $e) {
    echo 'Caught type exception: '. $e->getMessage() ."\n";
}
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}