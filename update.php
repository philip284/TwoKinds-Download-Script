<html><body>
<?php
require_once 'mainclass.php';
$app = new app();
ob_implicit_flush(true);
for($i=0; $i<8; $i++) {
    echo "<span style='width:8px; background:blue'> </span>";
    for($k = 0; $k < 40000; $k++)
        echo ' '; // extra spaces to fill up browser buffer
}
set_time_limit(0);
######  Get link
$jsonurl = 'comics/twokinds/twokinds.json';
$differnt = 0;
$page = 1;
while ($differnt==0) {
    echo $page;
    $tmp_check = $app->checkpage($page,$jsonurl);
    echo '<br>past first check<br>';
    if ($tmp_check == TRUE) {
        echo 'looping<br>';
        goto loop;
    }
    ### Parse Web Page
    $url = 'http://twokinds.keenspot.com/archive.php?p='.$page;
    $html = file_get_html($url);
    $e_array = $html->find('img[alt="Next"],img[alt="End"]');
    $i=0;
    foreach($e_array as $e_tmp) {
        if($i==1) die('More that one element with alt="Next" or alt="End"'); 
        $e = $e_tmp;
        $i++;
    }
    ### Parse Url
    $value = $e->src;
    $path = parse_url($value, PHP_URL_PATH);
    $path_parts = pathinfo($path);
    $filename = $path_parts['basename'];
    ### Download
    $dir = 'comics/twokinds/';
    $filepath = $dir.$filename;
    $file = file_get_contents('http://twokinds.keenspot.com' . $value);
    ### Compare Files
    $prevpage = $page - 1;
    echo 'starting second check<br>';
    if (file_exists($jsonurl)== FALSE){
        echo 'skips';
        goto skip; # DOES NOT EXISTS
    }
    if ($prevpage == 0) {
        $json = $app->json->load($jsonurl);
        goto skip3; # DOES NOT EXISTS
    }
    $json = $app->json->load($jsonurl);
    $json = objectToArray($json);
    foreach ($json as $YYYYMMDD => $array) {
        foreach ($array as $key => $value) {
            if ($prevpage == $value) { # EXISTS
                $prevfilepath = $dir.$array['filename'];
                $prevfile = file_get_contents($prevfilepath);
                $imgcmp = strcmp($prevfile,$file);
                if ($imgcmp == 0) { # SAME
                    
                    echo 'breaking<br>';
                    goto done;
                } else {
                }
            }
        }
    }
    skip3:
    goto skip2;
    skip:
    $json = array();
    skip2:
    echo 'past second check downloading<br>';
    $name = $path_parts['filename'];
    $json = objectToArray($json);
    $json[$name] = array(
        "number" => $page,
        "YYYYMMDD" => $path_parts['filename'],
        "filename" => $filename
    );
    $app->json->save($json,$jsonurl);
    ### Save file
    $handle = fopen($filepath, 'w');
    fwrite($handle, $file);
    fclose($handle);
    echo 'downloaded<br>';
    loop:
    $page++; ## Goes at very end
}
done:
?>
<script type="text/javascript">
    <!--
    window.location = "index.php"
    //-->
</script>
    </body></html>