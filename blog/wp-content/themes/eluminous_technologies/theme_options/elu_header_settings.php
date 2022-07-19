<?php
//get values from table
$headerEmail = get_option('headerEmail');
$usaNumber = get_option('usaNumber');
$indiaNumber = get_option('indiaNumber');
$giveUsCall = get_option('giveUsCall');
$ukNumber = get_option('ukNumber');


if(isset($_POST['btn_submit']) && ($_POST['btn_submit']!= '')){
	//get values
	$headerEmail =  trim($_POST['headerEmail']);
	$usaNumber  =  trim($_POST['usaNumber']);
	$indiaNumber    =  trim($_POST['indiaNumber']);
	$giveUsCall    =  trim($_POST['giveUsCall']);
    $ukNumber=  trim($_POST['ukNumber']);
	
	//store in options table
	update_option('headerEmail', $headerEmail);
	update_option('usaNumber', $usaNumber);
	update_option('indiaNumber', $indiaNumber);
	update_option('giveUsCall', $giveUsCall);
	update_option('ukNumber', $ukNumber);
}
?>

<div class="wrap">
  <h1>Header Options</h1>
  <h4>Contact Details</h4>
  <form action="" method="post">
  	<div class="form-group">
  		<label>Email Address</label>
  		<input type="text" name="headerEmail" id="headerEmail" class="form-control" value="<?php echo (isset($headerEmail) && ($headerEmail != '')) ? $headerEmail : '' ?>" />
  	</div>
  	<div class="form-group">
	  	<label>USA Number</label>
	  	<input type="text" name="usaNumber" id="usaNumber" class="form-control" value="<?php echo (isset($usaNumber) && ($usaNumber != '')) ? $usaNumber : '' ?>"/>
	</div>  	
	<div class="form-group">
	  	<label>India Number</label>
	  	<input type="text" name="indiaNumber" id="indiaNumber" class="form-control" value="<?php echo (isset($indiaNumber) && ($indiaNumber != '')) ? $indiaNumber : '' ?>"/>
	</div>  	
	<div class="form-group">
	  	<label>UK Number</label>
	  	<input type="text" name="ukNumber" id="ukNumber" class="form-control" value="<?php echo (isset($ukNumber) && ($ukNumber != '')) ? $ukNumber : '' ?>"/>
	</div>
	<div class="form-group">
	  	<label>Call Text</label>
	  	<input type="text" name="giveUsCall" id="giveUsCall" class="form-control" value="<?php echo (isset($giveUsCall) && ($giveUsCall != '')) ? $giveUsCall : '' ?>"/>
	</div>
  	<input type="submit" name="btn_submit" id="btn_submit" class="btn btn-default"/>
  </form>
 </div>