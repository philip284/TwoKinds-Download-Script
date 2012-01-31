<?php
class variables {
    function __construct() {
        $this->setvars();
    }
    public $path;
    public $templatedir;
    private $app;
    public $installoverrideon = TRUE;
    public function setclass($class){
        $this->app = $class;
    }
    private function setvars(){
        $this->path = $_SERVER['DOCUMENT_ROOT'];
        $this->templatedir = '/Flame_Dash/include/template/';
    }
}
?>
