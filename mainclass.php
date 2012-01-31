<?php
require_once 'json.php';
require_once 'html.php';
class app {
    function __construct() {
        $this->json = new json();
        $this->setclass($this);
    }
    public $json;


    public function setclass($class){
        $this->json->setclass($class);
    }
    public function checkpage($page,$jsonurl) {
        if (file_exists($jsonurl)== FALSE){
            return FALSE; # DOES NOT EXISTS
        }
        $json = $this->json->load($jsonurl);
        foreach ($json as $YYYYMMDD => $array) {
            foreach ($array as $key => $value) {
                if ($page == $value) {
                  return TRUE; # EXISTS
                }  
            }
        }
        return FALSE; # DOES NOT EXISTS
    }
}
function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}
?>
