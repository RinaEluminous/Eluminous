<?php
//get values from table
$strFBLink = get_option('strFBLink');
$strTwitterLink = get_option('strTwitterLink');
$strGplus = get_option('strGplus');
$strLinkedIn = get_option('strLinkedIn');
$strYTLink = get_option('strYTLink');


if(isset($_POST['btn_submit']) && ($_POST['btn_submit']!= '')){
	//get values
	$strFBLink       =  trim($_POST['strFBLink']);
	$strTwitterLink  =  trim($_POST['strTwitterLink']);
	$strGplus        =  trim($_POST['strGplus']);
	$strLinkedIn     =  trim($_POST['strLinkedIn']);
	$strYTLink       =  trim($_POST['strYTLink']);
	
	//store in options table
	update_option('strFBLink', $strFBLink);
	update_option('strTwitterLink', $strTwitterLink);
	update_option('strGplus', $strGplus);
	update_option('strLinkedIn', $strLinkedIn);
	update_option('strYTLink', $strYTLink);
}
?>

<div class="wrap">
  <h1>Social Options</h1>
  <h4>Links for social sites</h4>
  <form action="" method="post">
  	<div class="form-group">
  		<label>FB Link</label>
  		<input type="text" name="strFBLink" id="strFBLink" class="form-control" value="<?php echo (isset($strFBLink) && ($strFBLink != '')) ? $strFBLink : '' ?>"/>
  	</div>
  	<div class="form-group">
	  	<label>Twitter Link</label>
	  	<input type="text" name="strTwitterLink" id="strTwitterLink" class="form-control" value="<?php echo (isset($strTwitterLink) && ($strTwitterLink != '')) ? $strTwitterLink : '' ?>"/>
	</div>  	
	<div class="form-group">
	  	<label>Google + Link</label>
	  	<input type="text" name="strGplus" id="strGplus" class="form-control" value="<?php echo (isset($strGplus) && ($strGplus != '')) ? $strGplus : '' ?>"/>
	</div>  	
	<div class="form-group">
	  	<label>Linked In Link</label>
	  	<input type="text" name="strLinkedIn" id="strLinkedIn" class="form-control" value="<?php echo (isset($strLinkedIn) && ($strLinkedIn != '')) ? $strLinkedIn : '' ?>"/>
	</div>
	<div class="form-group">
	  	<label>Youtube Link</label>
	  	<input type="text" name="strYTLink" id="strYTLink" class="form-control" value="<?php echo (isset($strYTLink) && ($strYTLink != '')) ? $strYTLink : '' ?>"/>
	</div>
  	<input type="submit" name="btn_submit" id="btn_submit" class="btn btn-default"/>
  </form>
 </div>