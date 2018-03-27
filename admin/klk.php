<?php   
require 'DataAccess.php';
require 'SecurityCard.php';

session_start();   
session_register("slocation");   
$type = 'png';
$width = 50;
$height = 20;
$randval = randStr(4,"");
$_SESSION['slocation'] = $randval;
header("Content-type: image/".$type);
srand((double)microtime()*1000000);

if($type!='png' && function_exists('imagecreatetruecolor')){
$im = @imagecreatetruecolor($width,$height);
}else{
$im = @imagecreate($width,$height);
}
$r = Array(210,50,120);
$g = Array(240,225,235);
$b = Array(250,225,10);

$rr = Array(255,240,0);
$gg = Array(100,0,0);
$bb = Array(0,0,205);

$key = rand(0,2);

$stringColor = ImageColorAllocate($im,255,255,255); //字体颜色
$backColor = ImageColorAllocate($im,18,121,226);//背景色（随机）
$borderColor = ImageColorAllocate($im, 16, 140, 232);//边框色
$pointColor = ImageColorAllocate($im, 18,121,226);//点颜色

@imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);//背景位置
@imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor); //边框位置

@imagestring($im, 5, 7, 3, $randval, $stringColor); //调整字型位置
$ImageFun='Image'.$type;
$ImageFun($im);
@ImageDestroy($im);

//产生随机字符串
function randStr($len=6,$format='ALL') {
    $scode = new SecurityCard;
    return $scode->getLocation();
}
?>