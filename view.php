<?php
require_once 'mainclass.php';
$app = new app();
$jsonurl = 'comics/twokinds/twokinds.json';
$json = $app->json->load($jsonurl);
$json = objectToArray($json);
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $last = end($json);
    $page = $last['number'];
}
$last = end($json);
$previous = $page - 1;
$next = $page + 1;
if($previous == 0) {
    $previous = 1;
}
if($next > $last['number']) {
    $next = $last['number'];
}

foreach ($json as $YYYYMMDD => $array) {
    if($page == $array['number']) {
        $comic = $array['filename'];
        $comic_number = $array['number'];
        $comic_YYYYMMDD = $array['YYYYMMDD'];
    }
}
$comic_YYYYMMDD = preg_replace('/[^0-9]/', '', $comic_YYYYMMDD);
$timestamp = strtotime($comic_YYYYMMDD);
$day = date("l", $timestamp);
$month = date("F", $timestamp);
$date = $day . ", " . $month ." ". date("j", $timestamp)  . "<span style=\"font-size:xx-small; vertical-align:top;\">".date("S", $timestamp)."</span>".", ".date("Y", $timestamp);
list($width, $height, $type, $attr)= getimagesize("comics/twokinds/$comic");
$width = $width . "px";
$height = $height . "px";
echo "<html><head><title>TwoKinds Comic Download Veiwer</title><link rel=\"stylesheet\" type=\"text/css\" href=\"viewer.css\" /></head><body>";
echo "<div id=\"main\">";
echo "<div id=\"header\">";
echo "Comic Number: $comic_number<br />Comic for $date<br />";
echo "</div";
echo "<div id=\"img\">";
echo "<img style=\"border:0px;width:$width;height:$height\" src=\"comics/twokinds/$comic\">";
echo "</div>";
echo "<div id=\"navagation\">";
echo "<a href=\"view.php?page=1\">First Comic</a><span class=\"space\">.</span><a href=\"view.php?page=$previous\">Previous Comic</a><span class=\"space\">.</span><a href=\"index.php\">Archives</a><span class=\"space\">.</span><a href=\"view.php?page=$next\">Next Comic</a><span class=\"space\">.</span><a href=\"view.php\">Last Comic</a>";
echo "</div>";
echo "</div>";
echo "</body></html>";


?>
