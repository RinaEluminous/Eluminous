<!-- Status message -->
<?php if(!empty($statusMsg)){ ?>
    <div class="status-msg <?php echo $status; ?>"><?php echo $statusMsg; ?></div>
<?php } ?>

<!-- Form fields -->
<form action="" method="post">
    <div class="form-input">
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="Enter your name" value="<?php echo !empty($postData['name'])?$postData['name']:''; ?>" required="">
    </div>
    <div class="form-input">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Enter your email" value="<?php echo !empty($postData['email'])?$postData['email']:''; ?>" required="">
    </div>
    <div class="form-input">
        <label for="subject">Subject</label>
        <input type="text" name="subject" placeholder="Enter subject" value="<?php echo !empty($postData['subject'])?$postData['subject']:''; ?>" required="">
    </div>
    <div class="form-input">
        <label for="message">Message</label>
        <textarea name="message" placeholder="Type your message here" required=""><?php echo !empty($postData['message'])?$postData['message']:''; ?></textarea>
    </div>
    
    <input type="submit" name="form_submit" class="btn" value="Submit">
</form>
<?php
 
 
$postData = $statusMsg = $valErr = ''; 
$status = 'error'; 
 if(isset($_POST['form_submit'])){ 
	$postData = $_POST; 
    $name = trim($_POST['name']); 
    $email = trim($_POST['email']); 
    $subject = trim($_POST['subject']); 
    $message = trim($_POST['message']); 
     
    // Validate form fields 
    if(empty($name)){ 
         $valErr .= 'Please enter your name.<br/>'; 
    } 
    if(empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false){ 
        $valErr .= 'Please enter a valid email.<br/>'; 
    } 
    if(empty($subject)){ 
        $valErr .= 'Please enter subject.<br/>'; 
    } 
    if(empty($message)){ 
        $valErr .= 'Please enter your message.<br/>'; 
    } 
     
    if(empty($valErr)){ 
        // Send email notification to the site admin 
        $subject = 'New contact request submitted'; 
        $htmlContent = "<h2>Contact Request Details</h2> 
            <p><b>Name: </b>".$name."</p> 
            <p><b>Email: </b>".$email."</p> 
            <p><b>Subject: </b>".$subject."</p> 
            <p><b>Message: </b>".$message."</p>"; 
         
		$toEmail = 'eluminous.se72@gmail.com'; 
		$fromName = 'Sender Name'; 
		$formEmail = 'shaileshgajre@gmail.com';
        // Always set content-type when sending HTML email 
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
        // Header for sender info 
        $headers .= 'From:'.$fromName.' <'.$formEmail.'>' . "\r\n"; 
        
				
        // Send email 
        @mail($toEmail, $subject, $htmlContent, $headers); 
         
        $status = 'success'; 
        $statusMsg = 'Thank you! Your contact request has submitted successfully, we will get back to you soon.'; 
        $postData = ''; 
    }else{ 
        $statusMsg = '<p>Please fill all the mandatory fields:</p>'.trim($valErr, '<br/>'); 
    } 
}
?> 
