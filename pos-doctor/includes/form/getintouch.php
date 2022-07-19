<?php  
error_reporting(0);
if(isset($_REQUEST) && !empty($_REQUEST))
 {  //print_r($_REQUEST);
  $user_email       = "";
  $errors            = array();
  if(isset($_REQUEST['user_email']) &&  $_REQUEST['user_email']!='')
  {
    $user_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_REQUEST['user_email']);

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) 
    {
     $errors[] = "Invalid email address";
   } 
 }
 else
 {
  $errors[] = 'Your email field is required';
}

if(empty($errors))
{
    //echo 'hh';
  $base_url="https://eluminoustechnologies.com";
  include("../../../class.phpmailer.php");
  $mailObj =  new PHPMailer();
      $mailObj->IsSMTP(); // enable SMTP

     

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
      $mailObj->addAddress($user_email);
      
      $subject = 'Thank you for contacting eLuminous Technologies'; // Your Email Subject.      
      $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
      $headers .= "FROM: eLuminous Technologies Pvt Ltd Nashik <sales@eluminoustechnologies.com>\r\n";
      $mailObj->Subject = $subject;
      $mailSubject = '<body style="font-family: Arial, Helvetica, arial, Segoe UI,Tahoma, Verdana, Geneva, sans-serif; background-color:#fff;"><table style="width:580px;" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="90"><img src="'.$base_url.'/mailer_data/eluminous-pvt-ltd_black.png" alt="eluminous-pvt-ltd_black" width="200" style="display: block;"></td><td width="50%" style="text-align: right; font-weight:normal;"><span style="font-size:16px; color:#334455;font-family:Segoe UI,Tahoma arial;font-weight: bold;">+91 253 238 2566 <br><a style="color: #2196f3;text-decoration:none; " href="mailto:sales@eluminoustechnologies.com"> sales@eluminoustechnologies.com</a></span></td></tr></tbody></table></td></tr><tr><td valign="top" height="265"><img src="'.$base_url.'/mailer_data/thank-baneer.jpg" alt="eluminous-pvt-ltd_black" width="600"></td></tr></tbody></table></td></tr><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="30">&nbsp;</td></tr><tr><td><span style="font-size:16px;line-height:20px;color:#334455;font-family:Segoe UI,Tahoma">';

      $mailSubject .='Hello '.$user_email.',<br> <br>Thank you! We have received your request <br> <br>eLuminous Technologies success relies on the success of our customers. Following the latest technology trends, we help them in driving more agile process with our proven IT Solutions.<br><br>One of our representative will get in touch with you shortly to get an overview of your project ideas & offer solutions tailored for your needs.<br><br>We look forward providing top-notch quality service to you. Thank you once again for your time & consideration.<br><br>Best Regards,<br>Team eLuminous Technologies</b><br><br></span></td></tr><tr style="border-top: 1px solid #dcdcdc;padding-top: 10px;display: block; text-align: center;"><td style="text-align: center;width:100%; display: block;" ><span style="font-size:16px;line-height:38px;color:#334455;font-family:Segoe UI,Tahoma; font-weight: 500; text-transform: capitalize;"> Be in Touch</span><br><a style="display: inline-block; margin-right:10px;" href="https://www.facebook.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-fb.png" alt="eluminous-pvt-ltd_black" width="39" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.youtube.com/channel/UCfqg8756psg4hflU027Iu9g"><img src="'.$base_url.'/mailer_data/youtube-logotype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://twitter.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-twitter.png" alt="eluminous-pvt-ltd_black" width="37" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.linkedin.com/company/eluminous-technologies"><img src="'.$base_url.'/mailer_data/connect-linkedin.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><img src="'.$base_url.'/mailer_data/skype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><br> <br></td></tr></tbody></table></td></tr><tr><td><table style="width:100%; text-align: center; margin-top: 10px; padding:15px;background-color: #efefef;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td valign="middle" height="38"><span style="font-size:14px;color:#757575;font-family:Segoe UI,Tahoma"><a href="https://eluminoustechnologies.com/" style="color: #444444;text-decoration:none;font-size: 15px;">eLuminous technologies </a> © 2019 All Rights Reserved</span></td></tr></tbody></table></td></tr></tbody></table></body>';
      $mailObj->Body = $mailSubject;
      $mailObj->send();


      $mail =   new PHPMailer();
      $mail->IsSMTP(); // enable SMTP
      $mail->SMTPAuth   = true;
      $mail->SMTPSecure = 'ssl';
      $mailObj->SMTPDebug = 1;
      $mail->Host       = 'smtp.gmail.com';
      $mail->Port       =  '465';
      $mail->IsHTML(true);
      $mail->Username   = 'biz@eluminoustechnologies.com';
      $mail->Password   = 'R#w=XmK4u@URx@Ys';
      //$mail->Password   = 'T4jn=3Pb ';
      //$mail->setfrom('biz@eluminoustechnologies.com','eLuminous');
      //$mail->setfrom('eluminous.se50@gmail.com','test user');
      $mail->setfrom($user_email);
      $mail->addAddress('sales@eluminoustechnologies.com');
      $mail->addAddress('gauri@eluminoustechnologies.com');
      $message = '';
      $subject  = 'POS Doctor - New Online enquiry';  // Your Email Subject.
      $message .= '<span style="display:block;color:#000;"> Hi Admin, </span>';
      $message .= '<span style="display:block;color:#000;">Below is the user detail </span>';
      $message .= '<table border="0" cellspacing="0" cellpadding="0" style="border-color: #ffffff;font-size: 12px;width:100%;"><tbody>';
      $message .= '<tr><td style="padding: 4px 8px;border: 1px solid #efefef;">Email </td><td style="padding: 4px 8px;border: 1px solid #efefef;">'.$user_email.'</td></tr>';

      $top = '<p style="text-align:center;margin:0px;padding:23px 10px;background:#2196f3;color:white;font-size:28px;width:500px">'.$subject.'</p>';
      $bottom = '<p style="width:500px;text-align:center;margin-top:10px;padding:15px;background-color:#efefef;font-size: 24px;">Thank You</p>';
      $messageFormate = '<p style="text-align:left;margin:0px;padding:23px 10px;background: #fff0;color:black;font-size:14px;border:  1px solid #efefef;">'.$message.'</p>';
      $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";

      $mail->Subject = $subject;
      $mailSubject = '<body style="font-family: Arial, Helvetica, arial, Segoe UI,Tahoma, Verdana, Geneva, sans-serif; background-color:#fff;"><table style="width:580px;" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="90"><img src="'.$base_url.'/mailer_data/eluminous-pvt-ltd_black.png" alt="eluminous-pvt-ltd_black" width="200" style="display: block;"></td><td width="50%" style="text-align: right; font-weight:normal;"><span style="font-size:16px; color:#334455;font-family:Segoe UI,Tahoma arial;font-weight: bold;">+91 253 238 2566 <br><a style="color: #2196f3;text-decoration:none; " href="mailto:sales@eluminoustechnologies.com"> sales@eluminoustechnologies.com</a></span></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="0">&nbsp;</td></tr><tr><td><span style="font-size:16px;line-height:20px;color:#334455;font-family:Segoe UI,Tahoma">';

      $mailSubject .= ' '.$messageFormate .'<tr style="border-top: 1px solid #dcdcdc;padding-top: 10px;display: block; text-align: center;"><td style="text-align: center;width:100%; display: block;" ><span style="font-size:16px;line-height:38px;color:#334455;font-family:Segoe UI,Tahoma; font-weight: 500; text-transform: capitalize;"> Be In Touch</span><br><a style="display: inline-block; margin-right:10px;" href="https://www.facebook.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-fb.png" alt="eluminous-pvt-ltd_black" width="39" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.youtube.com/channel/UCfqg8756psg4hflU027Iu9g"><img src="'.$base_url.'/mailer_data/youtube-logotype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://twitter.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-twitter.png" alt="eluminous-pvt-ltd_black" width="37" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.linkedin.com/company/eluminous-technologies"><a style="display: inline-block; margin-right:10px;" href="skype:eluminoustechnologies?chat"><img src="'.$base_url.'/mailer_data/skype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><br> <br></td></tr></tbody></table></td></tr><tr><td><table style="width:100%; text-align: center; margin-top: 10px; padding:15px;background-color: #efefef;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td valign="middle" height="38"><span style="font-size:14px;color:#757575;font-family:Segoe UI,Tahoma"><a href="https://eluminoustechnologies.com/" style="color: #444444;text-decoration:none;font-size: 15px;">eLuminous technologies </a> © 2019 All Rights Reserved</span></td></tr></tbody></table></td></tr></tbody></table></body>';
      $mail->Body = $mailSubject;

      if(!$mail->send()) 
        { 
          $error_msg[] = 'error';
          $err = array_merge( $error_msg, $errors);
          echo json_encode($err);
          die;
        } 
        else 
        { 
           $success_msg = array('success','Thank you for contacting eLuminous Technologies..!!!');
           echo json_encode($success_msg);
           die;
        }
   }
   else
   {
    $error_msg[]    = 'error';
    $err            = array_merge( $error_msg, $errors);
    echo json_encode($err);
    die;
  }
}?>

<form method="post" id="getintouch-frm" class="d-flex align-items-center  align-items-md-start justify-content-center flex-column flex-md-row flex-wrap ">
  <div class="contact-elem form-group">
    <input type="email" id="user_email" name="user_email" placeholder="name@company.com" class="form-control" required>
    <p class="frm_error_msg" style="display: none;"></p>
  </div> 
  <div class="form-group">
    <button type="submit" class="btn">Get In Touch</button>
  </div>
</form>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">

  $(document).ready(function() {

    $(function () 
    {

      $("#getintouch-frm").validate({
        rules: {
          user_email: {
            required: true,
            email: true
          },
        },
    // Specify validation error messages
    messages: {
      user_email:
      { 
       required: "Please enter a email",
       email: "Please enter a valid email address",
     }
   },

   submitHandler: function(form) 
   {
    $('.center_loader').show();
    $('body').addClass('stop');
    var user_email = $('#user_email').val();
    var data = {user_email : user_email};
    jQuery.ajax({
      url: 'includes/form/getintouch',
      type: "POST",
      data: data,
      success: function(response)
      { 
        console.log(response);
        $('.center_loader').hide();
        $('body').removeClass('stop');
        var responseData = JSON.parse(response);
        if(responseData[0]=='error')
        {
          $('.frm_error_msg').html(responseData[1]);
          $('.frm_error_msg').css('display','block');
        }
        else
        {
          $('.frm_error_msg').css('display','none');
          $('.thank_you').modal('show');
          $('.thank_you p .color_151').html(responseData[1]);
        }
        $('#getintouch-frm')[0].reset();
      }
    });
  }
});
    });
  });
</script>