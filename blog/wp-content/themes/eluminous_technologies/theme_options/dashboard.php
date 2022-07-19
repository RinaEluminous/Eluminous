<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
$pagename = isset( $_GET['p'] ) ? $_GET['p'] : 'header';
?>
<div class="wrap">
  <div class="row">		
    <div class="col-md-4">
      <ul>
		<li><a href="<?php echo admin_url();?>admin.php?page=elu_settings&p=header">Header settings</a></li>
		<li><a href="<?php echo admin_url();?>admin.php?page=elu_settings&p=footer">Footer settings</a></li>
		<li><a href="<?php echo admin_url();?>admin.php?page=elu_settings&p=social">Social settings</a></li>
      </ul>
    </div>
    <div class="col-md-8">
		<?php
			if ($pagename == 'header'){
				include_once('elu_header_settings.php');
			}else if ($pagename == 'footer'){
				include_once('elu_footer_settings.php');
			}else if ($pagename == 'social'){
				include_once('elu_social_settings.php');
			}else{
				include_once('elu_header_settings.php');
			}
		?>
    </div>
  </div>	
</div>