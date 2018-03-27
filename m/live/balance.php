<?php 
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
<?php 
header("Content-type: text/html; charset=utf-8");
session_start();
$target = $_REQUEST['target'];
if(strlen($target) != 2){
	echo "0.00";exit;
}
$uid = intval(@$_SESSION['uid']);
$username = @$_SESSION["username"];
if(!$username){
	echo "<script>alert('请登录后再试！');window.close();</script>";exit;
}

include_once("config.php");

$sign = md5($plantform."_".$merID."_".$key."_".$username);

$url = $fenjieHost."/inteNew!balance.do?target=".$target."&plantform=".$plantform."&username=".$username."&password=".$password."&sign=".$sign;

$yy = curl_file_get_contents($url);

$json = json_decode($yy);

echo $json->value;

?>