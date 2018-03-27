
<?php 
header("Content-type: text/html; charset=utf-8");
session_start();

$uid = intval(@$_SESSION['uid']);
$username = @$_SESSION["username"];
include_once("config.php");
if(!$username){
	echo "<script>alert('请登录后再试！');window.close();</script>";exit;
}
if(!$isBB){
	echo "<script>alert('未开通BB!');window.close();</script>";exit;
}


//////////////// 读取bbinurl文件 //////////////////

$filename = "edd112erd!#ewr\\".$username;
if ( file_exists($filename))
{
	$myfile = fopen($filename, 'r');
	if ($myfile != null)
	{
		$bruce=fgets($myfile);	
		if ($bruce != null)
			$_SESSION["bbinUrl"] = $bruce;	
	}
	fclose($myfile);
}
///////////////////////////////////////////////////

// echo '<pre>';print_r($_SESSION);echo '</pre>';

$sign = md5($plantform."_".$merID."_".$key."_".$username);

$page_site = $_REQUEST["site"];
if(!$page_site){
	$page_site = "live";
}



// $pUrl = "bbinUrl";
$pUrl = "bbinUrl";
$pTime = "urltime";
// echo $pUrl." ".$pTime;exit;
// if(@$_SESSION[$pUrl] != null && @$_SESSION[$pTime] > (time() - 5)){
	// if(@$_SESSION['bbinType'] != $page_site){
		// echo "<script>alert('您的登陆过于频繁，请1分钟后在试！！  aaa');window.close();</script>";exit;
	// }else{
		// $url = $_SESSION[$pUrl];
		// $_SESSION[$pTime]=time();
		// echo "<script>alert('您的登陆过于频繁，请1分钟后在试！！ bbb');window.close();</script>";exit;
	// }
// }else
{
	$url = $fenjieHost."/bb!login.do?plantform=".$plantform."&username=".$username."&page_site=".$page_site."&sign=".$sign;
	// echo $url; 
	
	$url = curl_file_get_contents($url);
	if(strpos($url, "alert") > 0){
		// echo $url;
		echo "<script>alert('您的登陆过于频繁，请10秒后在试！');window.close();</script>";exit;
	}else{
		$_SESSION[$pTime]=time();
		$_SESSION[$pUrl]=$url;
		$_SESSION['bbinType']=$page_site;
		
		// 把链接写入文件
		$myfile = fopen($filename, "w") or die("Unable to open file!");
		$txt = $url;
		fwrite($myfile, $txt);
		fclose($myfile);
		//end this
		
		echo $url;exit;
	}
}

?>