<?php
require 'vendor/autoload.php';

$email = new \SendGrid\Mail\Mail(); 

$email->setFrom("biz@eluminoustechnologies.com", "Elmer Thomas");
$email->setSubject("Sending with Twilio SendGrid is Fun");
try {
    $email->addTo("eluminous.sse24@gmail.com", "Rajendra");
} catch (SendGrid\Mail\TypeException $e) {
    echo 'Caught type exception: '. $e->getMessage() ."\n";
}
$mailContent = new Content("text/html", "and easy to do anywhere, even with PHP");
$email->addContent($mailContent);
die();$email->addContent("text/html", "<strong>and easy to do anywhere, even with PHP</strong>");


$sendgrid = new \SendGrid(getenv('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'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}