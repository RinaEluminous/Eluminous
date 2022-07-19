<?php


/*
 * This class actually contains and displays and handles spokal requirements.
 * Spokal requirements are displayed within "Status" tab inside wordpress dashboard
 */
class SpokalRequirements{
    
    private $requirements = array();
    
    private $requirementsChecked = array();
    
    
    
    
    public static function getInstance(){
        global $spokalRequirements;

        if($spokalRequirements == null)
                $spokalRequirements = new SpokalRequirements();

        return $spokalRequirements;
    }
    
    
    
    
    /*
     * In constructor we are just populate our requirements.
     * Please check the array values and comments in order to see in what kind of format you need to insert
     * keys and values in order for requirement to be displayed within the dashboard.
     */
    public function __construct() {
        
        global $wp_version;
        
        $this->disabled_functions = array_map('trim', explode(',', ini_get('disable_functions')));
                
        $this->requirements =  array(
            "1" => array(
                "requirement_id" => "1",
                "requirement_name" => "Wordpress",  //requirement name, which we are going to display within "Status bar" in dashboard
                "requirement_value" => "3.4",     //this is requirement value which will be compare with specific value within requirement method
                "requirement_method" => "wordpressVersionComparator",  //expecting bool from this method always
                "requirement_ok_text" => "Your current Wordpress version is ".$wp_version,                
                "requirement_func_fail_text" => "",
                "requirement_disabled_funs" => array(),
                "requirement_fail_text" => "You need to have Wordpress 3.4 or greater in order to use Spokal.",
                "requirement_error_text" => "You need to have Wordpress 3.4 or greater in order to use Spokal.",
                "requirement_check_functions" => false,
                'status' => false

            ),
            "2" => array(
                "requirement_id" => "2",
                "requirement_name" => "XML-RPC",
                "requirement_value" => "",
                "requirement_method" => "xmlrpcChecker",
                "requirement_ok_text" => "XML-RPC services are enabled",
                "requirement_func_fail_text" => "",
                "requirement_disabled_funs" => array(),
                "requirement_fail_text" => "XML-RPC services are disabled on this site.",
                "requirement_error_text" => "You need to enable XML-RPC in order to use Spokal.",
                "requirement_check_functions" => false,
                'status' => false
            ),
            "3" => array(
                "requirement_id" => "3",
                "requirement_name" => "PHP",
                "requirement_value" => "5.2.4",
                "requirement_method" => "phpVersionComparator",
                "requirement_ok_text" => "Your current PHP version is ".phpversion(),
                "requirement_func_fail_text" => "",
                "requirement_disabled_funs" => array(),
                "requirement_fail_text" => "You need to have PHP 5.2.4 or greater in order to use Spokal.",
                "requirement_error_text" => "You need to have PHP 5.2.4 or greater in order to use Spokal.",
                "requirement_check_functions" => false,
                'status' => false
            ),
            "4" => array(
                "requirement_id" => "4",
                "requirement_name" => "Mcrypt",
                "requirement_value" => "",   //for this module we need any version of Mcrypt module to be enabled
                "requirement_method" => "mcryptChecker",
                "requirement_ok_text" => "You have mcrypt extension installed and enabled.",
                "requirement_func_fail_text" => "You have mcrypt extension installed and enabled, but some mcrypt functions are disabled on your server. Disabled functions are: %s. You need to enable these functions.",
                "requirement_disabled_funs" => array(),
                "requirement_fail_text" => "You need to install or/and enable mcrypt extension for php. Please check the php <a href='https://php.net/mcrypt' target='__blank'>manual</a>",
                "requirement_error_text" => "You need to install or/and enable mcrypt extension for php in order to use Spokal. Please check the php <a href='https://php.net/mcrypt' target='__blank'>manual</a>",
                "requirement_check_functions" => true,
                'status' => false
            ),
            "5" => array(
                "requirement_id" => "5",
                "requirement_name" => "Mbstring",
                "requirement_value" => "",   //for this module we need any version of Mcrypt module to be enabled
                "requirement_method" => "mbstringChecker",
                "requirement_ok_text" => "You have mbstring extension installed and enabled.",
                "requirement_func_fail_text" => "You have mbstring extension installed and enabled, but some mbstring functions are disabled on your server. Disabled functions are: %s. You need to enable these functions.",
                "requirement_disabled_funs" => array(),
                "requirement_fail_text" => "You need to install or/and enable mbstring extension for php. Please check the php <a href='https://php.net/mbstring' target='__blank'>manual</a>",
                "requirement_error_text" => "You need to install or/and enable mbstring extension for php in order to use Spokal. Please check the php <a href='https://php.net/mbstring' target='__blank'>manual</a>",
                "requirement_check_functions" => true,
                'status' => false
            ),
            "6" => array(
                "requirement_id" => "6",
                "requirement_name" => "cURL",
                "requirement_value" => "",   //for this module we need any version of Mcrypt module to be enabled
                "requirement_method" => "curlChecker",
                "requirement_ok_text" => "You have cURL extension installed and enabled.",
                "requirement_func_fail_text" => "You have cURL extension installed and enabled, but some cURL functions are disabled on your server. Disabled functions are: %s. You need to enable these functions.",
                "requirement_disabled_funs" => array(),
                "requirement_fail_text" => "You need to install or/and enable cURL extension for php. Please check the php <a href='https://php.net/curl' target='__blank'>manual</a>",
                "requirement_error_text" => "You need to install or/and enable cURL extension for php in order to use Spokal. Please check the php <a href='https://php.net/curl' target='__blank'>manual</a>",
                "requirement_check_functions" => true,
                'status' => false
            )
        );
        
        $this->checkRequirements();
        
    }
    
    
    
    
    private function checkRequirements() {
        
        for($i = 1; $i <= count($this->requirements); $i++){
            
            if($this->runRequirementMethod($this->requirements[$i])) {
                //requirement is ok
                $this->requirements[$i]['status'] = true;
            }
            else {
                //requirement missed
                $this->requirements[$i]['status'] = false;
            }
            
        }
        
    }
    
    
    
    public function checkIsMissed(){
        foreach($this->requirements as $requirement) {
            if(!$requirement['status']) {
               return true;
            }
        }
        return false;
    }
    
    
    public function isMissingRequirement($name){
        foreach($this->requirements as $requirement) {
            if($requirement["requirement_name"] == $name){
                if(!$requirement['status']) {
                    return true;
                }
            }
        }
        return false;
    }
    
    
    
    
    private function runRequirementMethod($requirementArray) {
        $status = false;
        if(method_exists($this, $requirementArray["requirement_method"])) {
            $requirementMethod = $requirementArray["requirement_method"];
            if(is_callable(array($this, $requirementMethod))){
                $status = $this->$requirementMethod($requirementArray["requirement_id"]);
            }
            else{
                $status = $this->defaultRequirementMethod();
            }
        }
        else {
            $status = $this->defaultRequirementMethod();
        }
        
        return $status;
    }
    
    
    
    
    /*
     * Displaying a green OK message and status
     */
    private function displayRequirementOk($requirementArray) {
        
        //requirement name depends from requirement value. If we dont have a value then its not comparation, its installation or something like that.
        $okName = "";
        if($requirementArray["requirement_value"]) {
            $okName = $requirementArray["requirement_name"]." ".$requirementArray["requirement_value"]." or greater";
        }
        else {
            $okName = $requirementArray["requirement_name"];
        }
        
        ?>
        <div class="requirement-ok">
            <div class="requirement-name"><?php echo $okName; ?></div>
            <div class="current-version-info" onclick="showAdditionalRequirement('id<?php echo $requirementArray["requirement_id"]; ?>')"></div>
            <div class="spokal-clear"></div>
            <div class="requirement-ok-text" id="id<?php echo $requirementArray["requirement_id"]; ?>"><?php echo $requirementArray["requirement_ok_text"]; ?></div>
        </div>
        <?php
    }
    
    private function displayRequirementFailed($requirementArray) {
        
        //requirement name depends from requirement value. If we dont have a value then its not comparation, its installation or something like that.
        $okName = "";
        if($requirementArray["requirement_value"]) {
            $okName = $requirementArray["requirement_name"]." ".$requirementArray["requirement_value"]." or greater";
        }
        else {
            $okName = $requirementArray["requirement_name"];
        }
        
        if($requirementArray["requirement_check_functions"] && !empty($requirementArray["requirement_disabled_funs"])){
            $fail_text = sprintf($requirementArray["requirement_func_fail_text"], implode(", ",$requirementArray["requirement_disabled_funs"]));
        }else{
            $fail_text = $requirementArray["requirement_fail_text"];
        }
        
        ?>
        <div class="requirement-fail">
            <div class="requirement-name"><?php echo $okName; ?></div>
            <div class="current-version-info" onclick="showAdditionalRequirement('id<?php echo $requirementArray["requirement_id"]; ?>')"></div>
            <div class="spokal-clear"></div>
            <div class="requirement-fail-text" id="id<?php echo $requirementArray["requirement_id"]; ?>"><?php echo $fail_text; ?></div>
        </div>
        <?php
    }
    
    
    
    
    /*
     * This method will compare required and current wordpress version and return correspoding bool value
     * as result of that comparation
     */
    private function wordpressVersionComparator($id) {
        global $wp_version;
        $status = false;
        $value = $this->requirements[$id]["requirement_value"];
        
        $currentWpValue = $wp_version;
        $requiredValue = $value;
        if(version_compare($currentWpValue, $requiredValue) >= 0) {
            $status = true;
        }
        else {
            $status = false;
        }
        return $status;
        
    } 
    
    
    
    
    /*
     * This method will compare required and current php version and return correspoding bool value
     * as result of that comparation
     */
    private function phpVersionComparator($id) {
        $status = false;
        $value = $this->requirements[$id]["requirement_value"];
        $currentPHPValue = phpversion();
        $requiredValue = $value;
        if(version_compare($currentPHPValue, $requiredValue) >= 0) {
            $status = true;
        }
        else {
            $status = false;
        }
        return $status;
        
    } 
    
    
    
    
    /*
     * This method will check do we have mcrypt extension enabled
     */
    private function mcryptChecker($id) {
        $mcrypt_funcs = array("mcrypt_decrypt");
        $status = false;
        if(extension_loaded("mcrypt")) {
            $status = true;
            foreach($mcrypt_funcs as $func){
                if(in_array($func, $this->disabled_functions)){
                    array_push($this->requirements[$id]["requirement_disabled_funs"],$func);
                    $status = false;
                }
            }
        }
        else {
            $status = false;
        }
        return $status;
    }
    
    
    
    
    public function mbstringChecker($id){
        $mbstring_funcs = array("mb_convert_encoding");
        $status = false;
        if(extension_loaded("mbstring")) {
            $status = true;
            foreach($mbstring_funcs as $func){
                if(in_array($func, $this->disabled_functions)){
                    array_push($this->requirements[$id]["requirement_disabled_funs"],$func);
                    $status = false;
                }
            }
        }
        else {
            $status = false;
        }
        return $status;
    }
    
    
    
    
    private function curlChecker($id) {
        $curl_funcs = array("curl_init","curl_setopt","curl_exec","curl_close");
        $status = false;
        if(extension_loaded("curl")) {
            $status = true;
            foreach($curl_funcs as $func){
                if(in_array($func, $this->disabled_functions)){
                    array_push($this->requirements[$id]["requirement_disabled_funs"],$func);
                    $status = false;
                }
            }
        }
        else {
            $status = false;
        }
        return $status;
    }
    
    
       
    
    public static function xmlrpcChecker($id) {
        $status = false;
        $enabled = get_option('enable_xmlrpc');
        
        if($enabled) {
            $status = true;
        }
        else {
            global $wp_version;
            if (version_compare($wp_version, '3.5', '>=')) {
                $status = (has_filter('xmlrpc_enabled')) ? false : true;
            }
            else {
                $status = false;
            }  
        }
        return $status;
    }
    
    
    
    
    /*
     * This is default requirement method.
     * If there is requirement where we did not provide a method, in order to avoid any kind of php errors we have
     * a default method which will be called in that case
     */
    private function defaultRequirementMethod() {
        return false; //default requirement method wil always return false;
    }
    
    
    public function renderRequirements() {
        foreach($this->requirements as $requirement) {
            if($requirement['status']) {
                //run code which will display that requirement is ok
                $this->displayRequirementOk($requirement);
            }
            else {
                //run code whih will display that this requirement is not satisfied
                $this->displayRequirementFailed($requirement);
            }
        }
        
    }
    
    
    
    
    public function mainTabRequirementsError(){

        foreach($this->requirements as $requirement) {
            if(!$requirement['status']) { 
                if($requirement["requirement_check_functions"] && !empty($requirement["requirement_disabled_funs"])){
                    $fail_text = sprintf($requirement["requirement_func_fail_text"], implode(", ",$requirement["requirement_disabled_funs"]));
                }else{
                    $fail_text = $requirement["requirement_error_text"];
                } ?>

                <div style="color: #D8000C; margin-bottom: 5px;">
                    <?php echo $fail_text; ?>
                </div>

      <?php }
        }
        
    }
    
    
    
}