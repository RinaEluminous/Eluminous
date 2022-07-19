<?php 

include "includes/function.php";

if(isset($_POST))
{   $error='';
     $strFirstName		=	trim($_POST['fullName']);
	 $strEmail 			=	trim($_POST['email']);
	 $strCountry 		=	trim($_POST['country']);
	 $intContactNo 		=	trim($_POST['contactNo']);
	 
	 if(empty($_POST["fullName"])) {
	    $result['fullName'] = "Name is required";
		$result['type']='error';
		$error=1;
	  } 
	 if(empty($_POST["email"])) {
	    $result['email']= "email is required";
		$result['type']='error';
		$error=1;
	  }elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		  $result['email'] = "Invalid email format";
		  $result['type']='error';
		$error=1;
		}
	   if(empty($_POST["contactNo"])) {
	    $result['mobileNo'] = "Contact number is required";
		$result['type']='error';
		$error=1;
	  }
	  
	 if(empty($_POST["country"])) {
	    $result['country'] = "Country name is required";
		$result['type']='error';
		$error=1;
	  }
	  
	  if($error !='1')
	  {
		     $result['type']='succs';
		   
		    $from="priyank_purohit@eluminoustechnologies.com";
			$admin1 ="sales@eluminoustechnologies.com";
			$admin2 ="hrushikeshw@gmail.com";
			$admin3 ="gauri@eluminoustechnologies.com";
		 	$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		 	$headers .= "From: ".$strEmail."\r\n";
			$headers .= "Cc: ".$admin1."\r\n";
		 
		 	//$strCustEmail="eluminous_developer1@eluminoustechnologies.com";
		 	//$strCustEmail=$rowOrdersMail['payer_email'];
			//Send mail to admin
			$subject_admin 		= "New Inquiry for PSD to HTML Services ";
			$email_admin_temp = getEmailTemplateContent('admin');
			$email_admin_temp = str_replace('@@NAME@@',$strFirstName,$email_admin_temp);
			$email_admin_temp = str_replace('@@EMAIL@@',$strEmail,$email_admin_temp);
			$email_admin_temp = str_replace('@@COUNTRY@@',$strCountry,$email_admin_temp);
			$email_admin_temp = str_replace('@@CONTACT@@',$intContactNo,$email_admin_temp);
			
			  
			$resultMail= mail($admin1,$subject_admin,$email_admin_temp,$headers);
			$resultMail= mail($admin2,$subject_admin,$email_admin_temp,$headers);
			$resultMail= mail($admin3,$subject_admin,$email_admin_temp,$headers);
			
			//Send mail to user
			$headers1  = "MIME-Version: 1.0\r\n";
			$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers1 .= "From: ".$from."\r\n";
			$email_user_temp = getEmailTemplateContent('user');
			$subject_user="Thank you for contacting eLuminous Technologies";
			$email_user_temp = str_replace('@@NAME@@',$strFirstName,$email_user_temp); 
			$resultMail= mail($strEmail,$subject_user,$email_user_temp,$headers1);
			//echo $email_user_temp ;die;
			echo json_encode($result); 
	
	  }else{
	  	echo json_encode($result); 
	  }
	 

 }
 
?>