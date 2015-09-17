<?php
$data = array();
$time = date("H:i:s");
$data[] = $time;

$temp_seite = '{"temp1":'.rand(100,400).',"temp2":'.rand(100,400).'}';//file_get_contents("192.168.1.7/json");
$json = json_decode($temp_seite,true);
$data[] = $json["temp1"];
$data[] = $json["temp2"];
$myFile = "temp-data";
$fh = fopen($myFile, 'a') or die("can't open file");
$stringData = '["'.$time.'",'.$json["temp1"].','.$json["temp2"].'],'."\n";
fwrite($fh, $stringData);
fclose($fh);

//var_dump($data);
echo json_encode($data);

?>
