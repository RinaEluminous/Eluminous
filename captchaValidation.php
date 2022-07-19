<?php 
if (isset($_POST)) {
	# code...
	$captchaAnswer = $_POST['answer'];
	$captchaQuestion = $_POST['question'];
	$captchaQuestionSplit  = explode("+",$captchaQuestion);
	$captchaSystemAnswer = trim($captchaQuestionSplit['0'] ) + trim ($captchaQuestionSplit['1'] );
	if (trim($captchaSystemAnswer) == trim($captchaAnswer) ) {		
		$capRes =  "true";
		ob_start();
		echo json_encode($capRes);
		$newClientResultArray = ob_get_clean();
		echo $newClientResultArray;
	}else{
		$valOne = rand(1,20);
		$valTwo = rand(1,10);	
		$newCptcha = $valOne ."+". $valTwo;
		ob_start();
		echo json_encode($newCptcha);
		$newClientResultArray = ob_get_clean();
		echo $newClientResultArray;

	}
}
?>