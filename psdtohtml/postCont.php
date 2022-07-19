<?php 

include "includes/function.php";
$folderPath= "uploads/";

if(isset($_FILES['uplaodedfile'])){
	$errors= array();
	$file_name = $_FILES['uplaodedfile']['name'];
	$file_size =$_FILES['uplaodedfile']['size'];
	$file_tmp =$_FILES['uplaodedfile']['tmp_name'];
	$file_type=$_FILES['uplaodedfile']['type'];
	move_uploaded_file($file_tmp,"uploads/".$file_name);
		
}
   
if(isset($_POST))
{
	$error='';
     $strFirstName		=	trim($_POST['fullName']);
	 $strEmail 			=	trim($_POST['email']);
	 $strCountry 		=	trim($_POST['country']);
	 $intContactNo 		=	trim($_POST['contactNo']);
	 $strEnquiry 		=	trim($_POST['enquiry']);
	 
	 if(empty($_POST["fullName"])) {
	    $result['fullName'] = "Name is required";
		$result['type']='error';
		$error=1;
	  } 
	  if(empty($_POST["enquiry"])) {
	    $result['enquiry'] = "Enquiry is required";
		$result['type']='error';
		$error=1;
	  } 
	 if(empty($_POST["email"])) {
	    $result['email']= "Email is required";
		$result['type']='error';
		$error=1;
	  }elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		  $result['email'] = "Invalid email format";
		  $result['type']='error';
		$error=1;
		}
	if(empty($_POST["country"])) {
	    $result['country'] = "Country name is required";
		$result['type']='error';
		$error=1;
	  }	
		
	  
	 if(empty($_POST["contactNo"])) {
	    $result['mobileNo'] = "Contact number is required";
		$result['type']='error';
		$error=1;
	  }
	  
	  if($error !='1')
	  {
		  	$msg="User created successfully";
		    $result['type']='succs';
		    $from_name = 'eluminoustechnologies.com'; 
		    $from="priyank_purohit@eluminoustechnologies.com";			
			$admin1 ="hrushikeshw@gmail.com ";
			$admin2 ="sales@eluminoustechnologies.com";
			$admin3 ="gauri@eluminoustechnologies.com";
			
		 	$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		 	$headers .= "From: ".$from."\r\n";
		 	$headers .= "Cc: ".$admin1."\r\n";
		 	//$strCustEmail="eluminous_developer1@eluminoustechnologies.com";
		 	//$strCustEmail=$rowOrdersMail['payer_email'];
			$subject_admin 		= "New Inquiry for PSD to HTML Services ";
			$email_admin_temp = getEmailTemplateContent('contact');
			$email_admin_temp = str_replace('@@NAME@@',$strFirstName,$email_admin_temp);
			$email_admin_temp = str_replace('@@EMAIL@@',$strEmail,$email_admin_temp);
			$email_admin_temp = str_replace('@@COUNTRY@@',$strCountry,$email_admin_temp);
			$email_admin_temp = str_replace('@@CONTACT@@',$intContactNo,$email_admin_temp);
			$email_admin_temp = str_replace('@@ENQUIRY@@',$strEnquiry,$email_admin_temp);
			//For simple mail
			//$resultCont= mail($admin1,$subject_admin,$email_admin_temp,$headers);
			//$resultCont1= mail($admin2,$subject_admin,$email_admin_temp,$headers);
			//$resultCont1= mail($admin3,$subject_admin,$email_admin_temp,$headers);
		   
		    $headers1  = "MIME-Version: 1.0\r\n";
			$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers1 .= "From: ".$from."\r\n";
		    $email_user_temp = getEmailTemplateContent('user');
			$subject_user='Thank you for contacting eLuminous Technologies';
		    $email_user_temp = str_replace('@@NAME@@',$strFirstName,$email_user_temp); 
			$resultCont= mail($strEmail,$subject_user,$email_user_temp,$headers1);
			
			//Mail with attachment
			$files [] = $folderPath.$file_name;
			$send_email = multi_attach_mail($admin1,$subject_admin,$email_admin_temp,$from,$from_name,$files);
			$send_email = multi_attach_mail($admin2,$subject_admin,$email_admin_temp,$from,$from_name,$files);
			$send_email = multi_attach_mail($admin3,$subject_admin,$email_admin_temp,$from,$from_name,$files);
			echo json_encode($result); 	
	  }else{
	  	echo json_encode($result); 
	  }

 }
 
 
function multi_attach_mail($to, $subject, $message, $senderMail, $senderName, $files)
{

    $from = $senderName." <".$senderMail.">"; 
    $headers = "From: $from";

    // boundary 
    $semi_rand = md5(time()); 
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

    // headers for attachment 
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

    // multipart boundary 
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 

    // preparing attachments
    if(count($files) > 0){
        for($i=0;$i<count($files);$i++){
            if(is_file($files[$i])){
                $message .= "--{$mime_boundary}\n";
                $fp =    @fopen($files[$i],"rb");
                $data =  @fread($fp,filesize($files[$i]));
				@fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\n" . 
                "Content-Description: ".basename($files[$i])."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }
    }

    $message .= "--{$mime_boundary}--";
    $returnpath = "-f" . $senderMail;

    //send email
    $mail = @mail($to, $subject, $message, $headers, $returnpath); 

    //function return true, if email sent, otherwise return fasle
    if($mail){ return TRUE; } else { return FALSE; }

}
?>