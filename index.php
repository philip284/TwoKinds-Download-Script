<?php
$padding = 3;
require_once 'mainclass.php';
$app = new app();
$jsonurl = 'comics/twokinds/twokinds.json';
$json = $app->json->load($jsonurl);
$json = objectToArray($json);

foreach ($json as $YYYYMMDD => $array) {
    
}

echo "<html><head><title>TwoKinds Comic Download Veiwer</title><link rel=\"stylesheet\" type=\"text/css\" href=\"viewer.css\" /></head><body>";
echo "<div id=\"main\">";
echo "<div id=\"header\">";
echo "<img src=\"archive.png\"><br />";
echo "</div>";
$count = 0;
echo "<div>";
foreach ($json as $YYYYMMDD => $array) {
    if($count == 20) {
        echo "<br />";
        $count = 0;
    }
    echo "<a href=\"view.php?page=".$array['number']."\">".str_pad($array['number'], $padding, "0", STR_PAD_LEFT)." </a>";
    $count++;
}
echo "</div>";
echo "<div><a href=\"update.php\">Update</a></div>";
echo "</div>";
echo "</body></html>";

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