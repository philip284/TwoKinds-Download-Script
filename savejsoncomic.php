<?php
session_start();
require_once 'mainclass.php';
$install = new app();

############ save 
############################################################# Overview Section
$save = array();
$save['20031022'] = array(
    "number" => "1",
    "YYYYMMDD" => "20031022",
    "filename" => "20031022.jpg"
);
$save['20031024'] = array(
    "number" => "2",
    "YYYYMMDD" => "20031024",
    "filename" => "20031024.jpg"
);
$install->json->save($save,'comics/twokinds/twokinds.json');
?>
