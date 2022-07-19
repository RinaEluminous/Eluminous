<?php
if($_POST['authentication'] == "cookieAccept"){
	$cookie_name = "cookieAccept";
	$cookie_value = "Accepted";
	setcookie($cookie_name, $cookie_value, time() + (172800 * 30 * 12), "/"); // 172800 = 2 day
}
?>
