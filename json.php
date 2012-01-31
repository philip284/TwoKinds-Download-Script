<?php
class json {
    private $app;
    private $json;
    public function setclass($class){
        $this->app = $class;
    }
    public function decode($file) {
        return json_decode($file);
    }
    public function load($filename) {
        return $this->decode(file_get_contents($filename));
    }
    public function save($save, $filename) {
        file_put_contents($filename, json_encode($save));
    }
}

?>
