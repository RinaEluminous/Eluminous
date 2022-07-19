<?php
//session_start(); 
get_header();
// place it on the top of the script

    //$statusMsg = !empty($_SESSION['msg'])?$_SESSION['msg']:'';
    $statusMsg = '';
    //unset($_SESSION['msg']);
    //echo $statusMsg;
    
    
    if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        // MailChimp API credentials
        $apiKey = '5553cbdee63817d91a324cf094f032a0-us12';
        $listID = '882a0c5148';
        
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

<section class="banner ">
	<div class="container">
	<?php while(have_posts()) : the_post(); ?>
		<div class="ebook">
			<?php  $airkit_post_thumbnail = get_post_thumbnail_id( get_the_ID() );
			$airkit_img_src = wp_get_attachment_url( $airkit_post_thumbnail ,'medium');
			$uploaded_file = get_post_meta(get_the_ID(), 'wpcf-upload-file', true);
			//echo $uploaded_file;
			if ( $airkit_img_src && has_post_thumbnail( get_the_ID() ) ) : ?>
				<a href="<?php the_permalink();?>" class="media_image"><img src= "<?php echo $airkit_img_src ; ?>" alt="<?php the_title(); ?>" ></a>
				
			<?php endif; ?>
			<div class="ebook-body">
				<h5 class="ebook-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
				<p class="ebook-text"><?php the_excerpt();?></p>
				<?php 
				//echo $statusMsg;
				if (isset($statusMsg) && ($statusMsg!='')) { 
				?>
				<a target="_blank" href="<?php echo $uploaded_file; //the_permalink(); ?>">Download file Here</a>
				<?php }else{ ?>
				<form method="post" action="">
				    <p><label>Name: </label><input type="text" name="fname" /></p>
				    <p><label>Email: </label><input type="text" name="email" /></p>
				    <p><input type="submit" name="submit" value="SUBSCRIBE"/></p>
				</form>
				
				<?php } ?>
			</div>
			
		</div>
	<?php endwhile; ?>
	<?php //echo do_shortcode('[contact-form-7 id="13" title="Send Ebook"]'); ?>
	
	</div>
</section>
<?php
get_footer();
?>
<!--<script>
jQuery(document).ready( function($) {
	var ajaxurl = '<?php echo admin_url("admin_ajax.php") ?>';
	//alert(ajaxurl);
	 jQuery.ajax({
         type : "post",
         dataType : "json",
         url : ajaxurl,
         data : {action: "my_user_vote", post_id : post_id, nonce: nonce},
         success: function(response) {
         	alert(response);
            /*if(response.type == "success") {
            	alert('in if');
            }
            else {
               alert('in else');
            }*/
         }
      });
});

</script>-->