<?php 

$servername = "localhost";
$username = "root";
$password = "eluminous@2018";
$dbname = "elumi_wpblog";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if (!$conn->set_charset("utf8")) {
      $conn->error;
  } else {
      $conn->character_set_name();
  }


//echo'<pre>'.print_r($row,1).'</pre>';
function excerpt($title, $cutOffLength) {

    $charAtPosition = "";
    $titleLength = strlen($title);

    do {
        $cutOffLength++;
        $charAtPosition = substr($title, $cutOffLength, 1);
    } while ($cutOffLength < $titleLength && $charAtPosition != " ");

    return substr($title, 0, $cutOffLength) . '...';

}




?>