<?php
$merID = "221212";
$key = "1gbzxc456fg!4li8";
$plantform = "HK";
$password = "a123456"; //默认密码,不要乱改

$fenjieHost = "http://www.api58.com";

$callback = "http://xy28.sc656.com/live/callback.php";
$isBB = true;
$isAG = true;
function curl_file_get_contents($durl){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $durl);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $r = curl_exec($ch);
    curl_close($ch);
    return $r;
}
?>