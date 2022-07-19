<?php
//get values from table
$strAddress = get_option('strAddress');
$intContact = get_option('intContact');
$strEmail = get_option('strEmail');
$strSkype = get_option('strSkype');
$strCopyright = get_option('strCopyright');


if(isset($_POST['btn_submit']) && ($_POST['btn_submit']!= '')){
	//get values
	$strAdderess =  trim($_POST['strAddress']);
	$intContact  =  trim($_POST['intContact']);
	$strEmail    =  trim($_POST['strEmail']);
	$strSkype    =  trim($_POST['strSkype']);
	$strCopyright=  trim($_POST['strCopyright']);
	
	//store in options table
	update_option('strAddress', $strAdderess);
	update_option('intContact', $intContact);
	update_option('strEmail', $strEmail);
	update_option('strSkype', $strSkype);
	update_option('strCopyright', $strCopyright);
}
?>

<div class="wrap">
  <h1>Footer Options</h1>
  <h4>Contact Details</h4>
  <form action="" method="post">
  	<div class="form-group">
  		<label>Address</label>
  		<textarea name="strAddress" id="strAddress" class="form-control" ><?php echo (isset($strAddress) && ($strAddress != '')) ? $strAddress : '' ?></textarea>
  	</div>
  	<div class="form-group">
	  	<label>Contact</label>
	  	<input type="text" name="intContact" id="intContact" class="form-control" value="<?php echo (isset($intContact) && ($intContact != '')) ? $intContact : '' ?>"/>
	</div>  	
	<div class="form-group">
	  	<label>Email Address</label>
	  	<input type="text" name="strEmail" id="strEmail" class="form-control" value="<?php echo (isset($strEmail) && ($strEmail != '')) ? $strEmail : '' ?>"/>
	</div>  	
	<div class="form-group">
	  	<label>Skype Id</label>
	  	<input type="text" name="strSkype" id="strSkype" class="form-control" value="<?php echo (isset($strSkype) && ($strSkype != '')) ? $strSkype : '' ?>"/>
	</div>
	<div class="form-group">
	  	<label>Copyright text</label>
	  	<input type="text" name="strCopyright" id="strCopyright" class="form-control" value="<?php echo (isset($strCopyright) && ($strCopyright != '')) ? $strCopyright : '' ?>"/>
	</div>
  	<input type="submit" name="btn_submit" id="btn_submit" class="btn btn-default"/>
  </form>
 </div>