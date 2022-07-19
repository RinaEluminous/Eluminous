<?php 

if ($valueTest == "captchaValidation") {

	$clientResult = $_POST['clientAnswer'];
	if (trim($clientResult) == trim($_SESSION['captcha'])) {
		echo "correct";
	}else{
		echo "Please try again";
	}
}
session_start();
$valOne = rand(5,10);
$valTwo = rand(1,5);
$valTwos = rand(1,3);
if ($valTwos == 1) {
	$_SESSION['captchaResult'] = $valOne + $valTwo;
	$_SESSION['captcha'] =  $valOne." + ".$valTwo;
}elseif ($valTwos == 2) {
	$_SESSION['captchaResult'] = $valOne - $valTwo;
	$_SESSION['captcha'] =  $valOne." - ".$valTwo;
}elseif ($valTwos == 3) {
	$_SESSION['captchaResult'] = $valOne * $valTwo;
	$_SESSION['captcha'] =  $valOne." * ".$valTwo;
}
 echo 
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<input type="text" id="ques" readonly name="cap" value="<?php echo $_SESSION['captcha'];?>">
<input type="text" id="UserAnswer" name="reslt" value="">
<input type="hidden" value="<?php echo $_SESSION['captchaResult']; ?>" name="" id="syatemAns">
<input type="submit" id="ssss" name="cc" value="fff">
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
	$("#ssss").click(function(){
    $("#ques").text();
});
</script>