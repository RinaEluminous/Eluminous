<?php 
require_once('includes/constant.php');
//if (isset($_GET['file'])) {
//$file = $_GET['file'];
$file_path  = PATH.'/images/pdf-file/Case Studies- eLuminous Technologies.pdf';
//echo $file_path;
if (file_exists($file_path) && is_readable($file_path) && preg_match('/\.pdf$/',$file_path)) {
 header('Content-Type: application/pdf');
 header("Content-Disposition: attachment; filename=\"$file_path\"");
 readfile($file_path);
//}
} else {
 header("HTTP/1.0 404 Not Found");
 echo "<h1>Error 404: File Not Found: <br /><em>$file</em></h1>";
}
?>