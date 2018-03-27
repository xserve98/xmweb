<?php
//随机秘钥，防止作弊
if(isset($_SESSION["postkey"]) && strlen($_SESSION["postkey"])>0){
	$_SESSION["postkey"]=$_SESSION["postkey"];
}else{
	$_SESSION["postkey"]=md5(uniqid(rand(),true));
}
$postkey=$_SESSION["postkey"];

//加密函数
function StrToHex($string,$postkey)
{
	$hex="";
	for ($i=0;$i<strlen($string);$i++)
		$hex.=dechex(ord($string[$i]));
	$hex=strtoupper($hex);
	
	return strtoupper(md5($hex.$postkey));
}
?>