<?php
date_default_timezone_set('Europe/Berlin');

$data = array();
$time = date("H:i:s");
$data[] = $time;

//$temp_seite = '{"temp1":'.rand(100,400).',"temp2":'.rand(100,400).'}';
$temp_seite = file_get_contents("http://192.168.1.7/json");
$json = json_decode($temp_seite,true);
//var_dump($json);
$data[] = $json["temp1"]/100;
$data[] = $json["temp2"]/100;
$myFile = "temp-data";
$fh = fopen($myFile, 'a') or die("can't open file");
$stringData = '["'.$time.'",'.($json["temp1"]/100).','.($json["temp2"]/100).'],'."\n";
fwrite($fh, $stringData);
fclose($fh);

//var_dump($data);
echo json_encode($data);

?>
