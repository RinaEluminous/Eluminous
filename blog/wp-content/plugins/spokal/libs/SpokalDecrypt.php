<?php

class DecryptPassword {
    
    
  protected $mcrypt_cipher = MCRYPT_RIJNDAEL_256;
  
  protected $mcrypt_mode = MCRYPT_MODE_CBC;
  
  protected $key = "I7S8VdkzDQ215iCfC0950ST01Wk12Mr7";
  
  protected $iv = "W3jmzx2XaqQZtbd67313xys4144tl2S6";
  
  
  public function decrypt($encrypted){
    if(!function_exists("mb_convert_encoding")){return 'mbstring';}
    if(!function_exists("mcrypt_decrypt")){return false;}
    
    $iv_utf = mb_convert_encoding($this->iv, 'UTF-8');
    return mcrypt_decrypt($this->mcrypt_cipher, $this->key, base64_decode($encrypted), $this->mcrypt_mode, $iv_utf);

  }
  
  
}