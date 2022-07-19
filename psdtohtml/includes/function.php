<?php 
function getEmailTemplateContent($admim)
{
  if($admim =='admin')
  {
  	$template_url = 'includes/index2.html';
	  $content = file_get_contents($template_url);
	  return $content;
  }	
  if($admim =='contact')
  {
  	 $template_url = 'includes/index.html';
	  $content = file_get_contents($template_url);
	  return $content;
  }else{
  		 $template_url = 'includes/thankyou.html';
  $content = file_get_contents($template_url);
  return $content;
  }
  
}