<?php 
$valOne = rand(1,20); 
$valTwo = rand(1,10); 
$newCptcha = $valOne ."+". $valTwo;
if(isset($_POST) && !empty($_POST)) {
  $user_name        = "";
  $user_email_id    = "";
  $user_company     = "";
  $user_message     = "";
  $user_phone       = "";
  $message          = "";
  $error            = array();

  if(!empty($_POST))
  {

    if(isset($_POST['user_name']) && $_POST['user_name']!='')
    {
      $user_name = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
    }
    else
    {
     $errors[] = 'Your name field is required';
   }
   if(isset($_POST['user_email_id']) && $_POST['user_email_id']!='')
   {
    $user_email_id = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['user_email_id']);
    if (!filter_var($user_email_id, FILTER_VALIDATE_EMAIL))
    {
      $errors[] = "Invalid email address";
    }
  }
  else
  {
   $errors[] = 'Your email field is required';
 }

 if(isset($_POST['user_company']) && $_POST['user_company']!='')
 {
  $user_company = filter_var($_POST['user_company'], FILTER_SANITIZE_STRING);
}
else
{
 $errors[] = 'Your company field is required';
}
if(isset($_POST['user_phone']) && $_POST['user_phone']!='')
{
  $user_phone = $_POST['user_phone'];
  if (strlen($user_phone) > 15 )
  {
    $errors[] = "Phone number is too long, enter valid phone number.";
  }
}
else
{
 $errors[] = 'Your phone number field is required';
}
if(isset($_POST['message']) && $_POST['message']!='') 
{
  $user_message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
}
else
{
 $errors[] = 'Your message field is required';
}
}

//echo '<pre>';print_r($errors);die;
if(empty($errors))
{
  $base_url="https://eluminoustechnologies.com";
  include("../../../class.phpmailer.php");
  $mailObj =  new PHPMailer();
// send email to user or visitor
  $mailObj->SMTPAuth   = true;
  $mailObj->SMTPSecure = 'ssl';
  $mailObj->SMTPDebug   = 1;
  $mailObj->Host       = 'smtp.gmail.com';
  $mailObj->Port       =  '465';
  $mailObj->IsHTML(true);
  $mailObj->Username   = 'biz@eluminoustechnologies.com';
  $mailObj->Password   = 'R#w=XmK4u@URx@Ys';
      //$mailObj->Password   = 'T4jn=3Pb ';
  $mailObj->setfrom('sales@eluminoustechnologies.com');
  $mailObj->addAddress($user_email_id);

  $subject = 'Thank you for contacting eLuminous Technologies'; // Your Email Subject.
  $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
  $headers .= "FROM: eLuminous Technologies Pvt Ltd Nashik <sales@eluminoustechnologies.com>\r\n";
  $mailObj->Subject = $subject;
  $mailSubject = '';
  $mailSubject .= '<body style="font-family: Arial, Helvetica, arial, Segoe UI,Tahoma, Verdana, Geneva, sans-serif; background-color:#fff;"><table style="width:580px;" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="90"><img src="'.$base_url.'/mailer_data/eluminous-pvt-ltd_black.png" alt="eluminous-pvt-ltd_black" width="200" style="display: block;"></td><td width="50%" style="text-align: right; font-weight:normal;"><span style="font-size:16px; color:#334455;font-family:Segoe UI,Tahoma arial;font-weight: bold;">+91 253 238 2566 <br><a style="color: #2196f3;text-decoration:none; " href="mailto:sales@eluminoustechnologies.com"> sales@eluminoustechnologies.com</a></span></td></tr></tbody></table></td></tr><tr><td valign="top" height="">
    <img src="'.$base_url.'/images/thankyou.jpg" alt="eluminous-pvt-ltd_black" width="600">
  </td></tr></tbody></table></td></tr><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="30">&nbsp;</td></tr><tr><td><span style="font-size:16px;line-height:20px;color:#334455;font-family:Segoe UI,Tahoma">';

  $mailSubject .='Hello '.$user_name.',<br> <br>Thank you! We have received your request <br> <br>eLuminous Technologies success relies on the success of our customers. Following the latest technology trends, we help them in driving more agile process with our proven IT Solutions.<br><br>One of our representative will get in touch with you shortly to get an overview of your project ideas & offer solutions tailored for your needs.<br><br>We look forward providing top-notch quality service to you. Thank you once again for your time & consideration.<br><br>Best Regards,<br>Team eLuminous Technologies</b><br><br></span></td></tr><tr style="border-top: 1px solid #dcdcdc;padding-top: 10px;display: block; text-align: center;"><td style="text-align: center;width:100%; display: block;" ><span style="font-size:16px;line-height:38px;color:#334455;font-family:Segoe UI,Tahoma; font-weight: 500; text-transform: capitalize;"> Be in Touch</span><br><a style="display: inline-block; margin-right:10px;" href="https://www.facebook.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-fb.png" alt="eluminous-pvt-ltd_black" width="39" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.youtube.com/channel/UCfqg8756psg4hflU027Iu9g"><img src="'.$base_url.'/mailer_data/youtube-logotype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://twitter.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-twitter.png" alt="eluminous-pvt-ltd_black" width="37" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.linkedin.com/company/eluminous-technologies"><img src="'.$base_url.'/mailer_data/connect-linkedin.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><img src="'.$base_url.'/mailer_data/skype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><br> <br></td></tr></tbody></table></td></tr><tr><td><table style="width:100%; text-align: center; margin-top: 10px; padding:15px;background-color: #efefef;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td valign="middle" height="38"><span style="font-size:14px;color:#757575;font-family:Segoe UI,Tahoma"><a href="https://eluminoustechnologies.com/" style="color: #444444;text-decoration:none;font-size: 15px;">eLuminous technologies </a> © 2019 All Rights Reserved</span></td></tr></tbody></table></td></tr></tbody></table></body>';

  $mailObj->Body = $mailSubject;

  $mailObj->send();
  
  $mail =  new PHPMailer();
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = 'ssl';
  $mail->SMTPDebug   = 1;
  $mail->Host       = 'smtp.gmail.com';
  $mail->Port       =  '465';
  $mail->IsHTML(true);
  $mail->Username   = 'biz@eluminoustechnologies.com';
  $mail->Password   = 'R#w=XmK4u@URx@Ys';

  $mail->setfrom($user_email_id,$user_name);
//$mail->addAddress($user_email_id);

  $mail->addAddress('sales@eluminoustechnologies.com');
  $mail->addAddress('gauri@eluminoustechnologies.com');
  
  $subject  = 'POS Doctor - New Online enquiry';  // Your Email Subject.
  $message .= '<span style="display:block;color:#000;"> Hi Admin, </span>';
  $message .= '<span style="display:block;color:#000;">Below is the user detail </span>';
  $message .= '<table border="0" cellspacing="0" cellpadding="0" style="border-color: #ffffff;font-size: 12px;width:100%;"><tbody><tr><td style="padding: 4px 8px;border: 1px solid #efefef;">Name </td><td style="padding: 4px 8px;border: 1px solid #efefef;">'.$user_name.'</td></tr>';
  $message .= '<tr><td style="padding: 4px 8px;border: 1px solid #efefef;">Email </td><td style="padding: 4px 8px;border: 1px solid #efefef;">'.$user_email_id.'</td></tr>';
  $message .= '<tr><td style="padding: 4px 8px;border: 1px solid #efefef;">Phone</td><td style="padding: 4px 8px;border: 1px solid #efefef;">'.$user_phone.'</td></tr>';
  $message .= '<tr><td style="padding: 4px 8px;border: 1px solid #efefef;">Company</td><td style="padding: 4px 8px;border: 1px solid #efefef;">'.$user_company.'</td></tr>';
  $message .= '<tr><td style="padding: 4px 8px;border: 1px solid #efefef;">Message</td><td style="padding: 4px 8px;border: 1px solid #efefef;">'.$user_message.'</td></tr> </tbody></table>';
  $top = '<p style="text-align:center;margin:0px;padding:23px 10px;background:#2196f3;color:white;font-size:28px;width:500px">'.$subject.'</p>';
  $bottom = '<p style="width:500px;text-align:center;margin-top:10px;padding:15px;background-color:#efefef;font-size: 24px;">Thank You</p>';
  $messageFormate = '<p style="text-align:left;margin:0px;padding:23px 10px;background: #fff0;color:black;font-size:14px;border:  1px solid #efefef;">'.$message.'</p>';
  $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
  $mail->Subject = $subject;
  $mailSubject = '<body style="font-family: Arial, Helvetica, arial, Segoe UI,Tahoma, Verdana, Geneva, sans-serif; background-color:#fff;"><table style="width:580px;" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="90"><img src="'.$base_url.'/mailer_data/eluminous-pvt-ltd_black.png" alt="eluminous-pvt-ltd_black" width="200" style="display: block;"></td><td width="50%" style="text-align: right; font-weight:normal;"><span style="font-size:16px; color:#334455;font-family:Segoe UI,Tahoma arial;font-weight: bold;">+91 253 238 2566 <br><a style="color: #2196f3;text-decoration:none; " href="mailto:sales@eluminoustechnologies.com"> sales@eluminoustechnologies.com</a></span></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="0">&nbsp;</td></tr><tr><td><span style="font-size:16px;line-height:20px;color:#334455;font-family:Segoe UI,Tahoma">';
  $mailSubject .= ' '.$messageFormate .'<tr style="border-top: 1px solid #dcdcdc;padding-top: 10px;display: block; text-align: center;"><td style="text-align: center;width:100%; display: block;" ><span style="font-size:16px;line-height:38px;color:#334455;font-family:Segoe UI,Tahoma; font-weight: 500; text-transform: capitalize;"> Be In Touch</span><br><a style="display: inline-block; margin-right:10px;" href="https://www.facebook.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-fb.png" alt="eluminous-pvt-ltd_black" width="39" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.youtube.com/channel/UCfqg8756psg4hflU027Iu9g"><img src="'.$base_url.'/mailer_data/youtube-logotype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://twitter.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-twitter.png" alt="eluminous-pvt-ltd_black" width="37" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.linkedin.com/company/eluminous-technologies"><img src="'.$base_url.'/mailer_data/connect-linkedin.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><img src="'.$base_url.'/mailer_data/skype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><br> <br></td></tr></tbody></table></td></tr><tr><td><table style="width:100%; text-align: center; margin-top: 10px; padding:15px;background-color: #efefef;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td valign="middle" height="38"><span style="font-size:14px;color:#757575;font-family:Segoe UI,Tahoma"><a href="https://eluminoustechnologies.com/" style="color: #444444;text-decoration:none;font-size: 15px;">eLuminous technologies </a> © 2019 All Rights Reserved</span></td></tr></tbody></table></td></tr></tbody></table></body>';

  $mail->Body = $mailSubject;
  if(!$mail->send())
  {
  //echo "<p>Somthing went wrong , please try again..!!!</p>";die;
   $error[]     = 'Somthing went wrong , please try again..!!!';
   $error_msg[] = 'error';
   $err         =  array_merge( $error_msg, $errors);
   echo json_encode($err);die;
 }
 else
 {
  $success_msg = array('success','Thank you for contacting eLuminous Technologies..!!!');
  echo json_encode($success_msg);die;
}
}
else
{
  $error_msg[] = 'error';
  $err = array_merge( $error_msg, $errors);
  echo json_encode($err);die;
}
}?>
<div class="error_msg" style="display: none;"></div>
<form method="post" id="contact-frm">
  <div class="row justify-content-start justify-content-sm-end">
    <div class="col-lg-6 contact-elem">
      <div class="form-group">
        <!-- <label for="name">Your Name</label> -->
        <input class="form-control" type="text" id="user_name" name="user_name" placeholder="Your name" pattern=[A-Z\sa-z]{3,20} required>
      </div>
    </div>
    <div class="col-lg-6 contact-elem">
      <div class="form-group">
        <!-- <label for="email">Your E-mail</label> -->
        <input class="form-control" type="email" id="user_email_id" name="user_email_id" placeholder="Email address" required>
      </div>
    </div>
    <div class="col-lg-6 contact-elem">
      <div class="form-group">
        <!-- <label for="phone">Phone</label> -->
        <input class="form-control" type="text" id="user_phone" name="user_phone" onkeydown="return checkPhoneKeyHome(event.key)"  placeholder="Phone" required>
      </div>
    </div>
    <div class="col-lg-6 contact-elem">
      <div class="form-group">
        <!-- <label for="email">Your Company</label> -->
        <input class="form-control" type="text" id="user_company" name="user_company" placeholder="Your Company" required>
      </div>
    </div>
    <div class="col-lg-12 contact-elem">
      <div class="form-group">
        <!-- <label for="message">Message</label> -->
        <textarea class="form-control" id="message" name="message" placeholder="Message" required></textarea>
      </div>
    </div>
    <div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-2 contact-elem">
      <div class="form-group">
        <input type="text" class="change-design form-control text-center" id="cptchaQues" readonly="" name="cptchaQues" value="<?php echo $newCptcha; ?>">
      </div>
    </div>
    <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3 contact-elem">
      <div class="form-group">
       <input type="text" class="form-control" name="captchaAnswer" id="captchaAnswer" value="" required>
     </div>
   </div>
   <div class="col-sm-5 col-md-4 col-lg-4 col-xl-3 d-flex justify-content-end">
    <button type="submit" class="form-control btn border-0">Send Message</button>
  </div>
</div>
</form>