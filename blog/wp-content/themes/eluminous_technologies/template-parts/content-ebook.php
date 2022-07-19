<?php
error_reporting(E_ALL);

    $statusMsg = '';
    if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        // MailChimp API credentials
        $apiKey = 'b5c5b2260813d92498d241e3299d37ee-us19';
        $listID = '1dc7fb5efc';
        
        // MailChimp API URL
        $memberID = md5(strtolower($email));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;
        
        // member information
        $json = json_encode([
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => [
                'FNAME'     => $fname
            ]
        ]);
        
        // send a HTTP POST request with curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // store the status message based on response code
        if ($httpCode == 200) {
            //$_SESSION['msg'] = '<p style="color: #34A853">You have successfully subscribed to Eluminous Blog.</p>';
            $statusMsg = '<p style="color: #34A853">You have successfully subscribed to Eluminous Blog.</p>';
            
           /* $to      = 'eluminous.se45@gmail.com';
			$subject = 'Fake sendmail test';
			$message = 'If we can read this, it means that our fake Sendmail setup works!';
			$headers = 'From: eluminous.se45@gmail.com' . "\r\n" .
			           'X-Mailer: PHP/' . phpversion();

			if(mail($to, $subject, $message, $headers)) {
			    echo 'Email sent successfully!';
			} else {
			    die('Failure: Email was not sent!');
			}*/
                        
        } else {
            switch ($httpCode) {
                case 214:
                    $msg = 'You are already subscribed.';
                    break;
                default:
                    $msg = 'Some problem occurred, please try again.';
                    break;
            }
            //$_SESSION['msg'] = '<p style="color: #EA4335">'.$msg.'</p>';
            $statusMsg = '<p style="color: #EA4335">'.$msg.'</p>';
        }
    }else{
       // $_SESSION['msg'] = '<p style="color: #EA4335">Please enter valid email address.</p>';
       $statusMsg = '<p style="color: #EA4335">Please enter valid email address.</p>';
    }
}
//header('Location:test.php');
?>

<?php
echo get_the_ID();
$airkit_post_thumbnail = get_post_thumbnail_id( get_the_ID() );
$airkit_img_src = wp_get_attachment_url( $airkit_post_thumbnail ,'medium');
$uploaded_file = get_post_meta(get_the_ID(), 'wpcf-upload-file', true); 
$download_btn_color = get_post_meta(get_the_ID(), 'wpcf-download-button-color', true); 

?>

<div class="e-book-details">
<div class="row align-items-center justify-content-center">
    <div class="col-md-12 col-lg-3 col-sm-12 mb-3 mb-lg-0 mb-md-0">
        <div class="book-img-sec">
            <img src="<?php echo $airkit_img_src; ?>" alt="" class="img-fluid"/>
        </div>
    </div>
 <div class="col-md-12 col-lg-9 col-sm-12"> 
 <h2>
    <small>Read</small>
    <?php the_title(); ?></h2>
</div>
 <div class="col-md-12">
 <div class="news-latter-box">
 <h3>Leave your email to get it for FREE!</h3>
 <div class="popup-form">
 	<?php if (isset($statusMsg) && ($statusMsg!='')) { ?> 	
	<div>
		<p><?php echo $message; ?></p>
		<p><a href="<?php echo $uploaded_file; ?>" target="_blank">Download Now</a></p>
	</div>
 	<?php }else{ ?>
 	<form method="post" action="">
        <div class="row">
 		<div class="col-md-12 col-lg-6 mb-md-3 mb-lg-0">
          <input name="fname" id="fname" type="text" placeholder="Your First Name" required="required" />
        </div>
        <div class="col-md-12 col-lg-6">
          <input name="email" id="email" type="email" placeholder="Email ID" required="required" />
        </div>
        <div class="col-md-12">
          <!--<input name="submit" type="submit" value="Download ebook" id="btnSubmit" style="background:<?php echo $download_btn_color; ?>;" />-->
          <input name="submit" type="submit" class="small_blue_btn" value="Download ebook" id="btnSubmit"/>
        </div>
        </div>
	</form>
 	
 	<?php } ?>
 </div>
 </div>
 </div>
  <div class="col-md-12"> <div class="popup-footer"> Your email id is safe with us. We hate SPAM as much as you. </div> </div>
</div>
</div>



<script type="text/javascript">

jQuery(document).ready(function() {

	jQuery("#btnSubmit").click(function(){

		var email	=	jQuery("#email").val();
		var fname	=	jQuery("#fname").val();
		var count	=	0;

		if(fname	==	""){
			count = 1;
			jQuery("#fname").css("border","2px solid red");

		}else{
			jQuery("#fname").css("border","none");
		}

		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

		if (filter.test(email)) {
			jQuery("#email").css("border","none");
		}else {
			count = 1;
			jQuery("#email").css("border","2px solid red");
		}

		if(count ==0){
			return true;
		}else{
			return false;
		}
	});
});
</script>

