<?php
require_once 'variables.php';
require_once 'json.php';
require_once 'file.php';
require_once 'html.php';
class app {
    function __construct() {
        $this->variables = new variables();
        $this->json = new json();
        $this->file = new file();
        $this->setclass($this);
    }
    public $variables;
    public $json;
    public $file;


    public function setclass($class){
        $this->variables->setclass($class);
        $this->json->setclass($class);
        $this->file->setclass($class);
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
?>
