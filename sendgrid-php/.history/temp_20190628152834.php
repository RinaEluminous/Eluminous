<?php
require 'vendor/autoload.php';
use \SendGrid\Mail\Personalization;
use \SendGrid\Mail\Mail;
use \SendGrid\Mail\To;

$email = new Mail();
$email->setFrom("dx@sendgrid.com", "DI Team");
$email->setSubject("Sending with Twilio SendGrid is Fun");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent("text/html", "{{firstname}} and easy to do anywhere, even with PHP");

$personalization0 = new Personalization();
$personalization0->addTo(new To("ethomas@twilio.com", "Elmer Thomas"));
$personalization0->addSubstitution("{{firstname}}", "Elmer");
$email->addPersonalization($personalization0);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage(). "\n";
}