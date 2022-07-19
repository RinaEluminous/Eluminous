<?php
		$strFrom = 'eluminous_sedk@eluminoustechnologies.com';
		$strFrom = 'postmaster@sandbox8b0f65bbabb34703985a86c446d6d747.mailgun.org';
		$strTo = 'eluminous_sedk@eluminoustechnologies.com';
		$strTo = 'eluminous.developer13@gmail.com';
		$strToName = 'DK';
		$strSubject = 'welecome';
		$strContent = 'This Is Test Conent For Testing Purpose.' ;
		
		$arrData = array(
			'from' => $strFrom,
			'to' => $strTo,
			'subject' => $strSubject,
			'html' => $strContent
		);
		
		echo "<pre>";
		echo "Input <br>";
		print_r($arrData);
		
		$strServiceUrl = 'https://api.mailgun.net/v3/sandbox8b0f65bbabb34703985a86c446d6d747.mailgun.org/messages';
		$strApiKey = '6b60e603-769e5989';
		$strApiKey = 'fc53dba84437fa72fd64ae67554145c8-6b60e603-769e5989';
		
		echo '<br>Key >> '.$strApiKey;
		
		$curl = curl_init($strServiceUrl);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, $strApiKey); 

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);

		curl_setopt($curl, CURLOPT_POSTFIELDS, $arrData);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 

		$curl_response = curl_exec($curl);  
		
		if (curl_error($curl)) {
			echo $strErrorMsg = curl_error($curl); die;
		}

		$arrResponse = (array) json_decode($curl_response);
		curl_close($curl);
		
		echo "<br><br><br> Response: ";
		
		var_dump($arrResponse);

		print_r($arrResponse);die;
?> 