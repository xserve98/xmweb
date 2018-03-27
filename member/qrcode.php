<?php
session_start();

//////////获取浏览器参数地址//
function convertUrlQuery($query)
{
  $queryParts = explode('&', $query);
  $params = array();
  foreach ($queryParts as $param) {
    $item = explode('=', $param);
    $params[$item[0]] = $item[1];
  }
  return $params;
}
/**
 * 将参数变为字符串
 * @param $array_query
 * @return string string 'm=content&c=index&a=lists&catid=6&area=0&author=0&h=0®ion=0&s=1&page=1' (length=73)
 */
function getUrlQuery($array_query)
{
  $tmp = array();
  foreach($array_query as $k=>$param)
  {
    $tmp[] = $k.'='.$param;
  }
  $params = implode('&',$tmp);
  return $params;
}

///////////////

$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$arr = parse_url($url);
$arr_query = convertUrlQuery($arr['query']);
$uid=$_SESSION['uid'];

if($uid==''){
	$uid=$arr_query['uid'];
	}

include 'phpqrcode.php';    
$value = "http://".$_SERVER['HTTP_HOST']."/?f=".intval(100000+intval($uid)); //二维码内容  
$errorCorrectionLevel = 'L';//容错级别 
$margin=7; 
$matrixPointSize = 6;//生成图片大小   
//生成二维码图片
ob_clean();   
///QRcode::png($value, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize,$margin, 2);   
$logo = "http://".$_SERVER['HTTP_HOST'].'/uidimg.php?uid='.$uid;//准备好的logo图片

$QR = 'qrcode.png';//已经生成的原始二维码图   

if ($logo !== FALSE) {   
    $QR = imagecreatefromstring(file_get_contents($QR));   
    $logo = imagecreatefromstring(file_get_contents($logo));   
    $QR_width = imagesx($QR);//二维码图片宽度   
    $QR_height = imagesy($QR);//二维码图片高度   
    $logo_width = 150;//logo图片宽度   
    $logo_height = 30;//logo图片高度   
    $logo_qr_width = $QR_width/2 ;   
    $scale = $logo_width;   
    $logo_qr_height = $logo_height;   
    $from_width = 120 ;   
    //重新组合图片并调整大小   
    imagecopyresampled($QR, $logo, $from_width/2, 200, 0, 0, $logo_qr_width,   
    $logo_qr_height, $logo_width, $logo_height);   
}   
//输出图片   
imagepng($QR, 'images/uidimg/'.intval(100000+intval($uid)).'.png');   


?>