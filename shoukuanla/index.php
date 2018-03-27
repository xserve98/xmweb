<?php 
/*
功能：微型PHP框架入口文件,兼容php所有版本
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net
备用域名：www.chonty.com
*/
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);//显示除去E_WARNING E_NOTICE 之外的所有错误信息
header("Content-Type:text/html; charset=UTF-8");
ini_set('date.timezone','Asia/Shanghai');

$skl_c=trim($_GET['c']);
$skl_a=trim($_GET['a']);
if(empty($skl_c)){ $skl_c='Shoukuanla'; }
if(empty($skl_a)){ $skl_a='index'; }

define('SKL_CONTROLLER',$skl_c); 
define('SKL_ACTION',$skl_a); 

//禁止浏览器访问下划线开头的成员函数
if(stripos($skl_a, '_') === 0){  exit;  }

//启动session
if(strtolower($skl_a) == 'insert'/* || strtolower($skl_a) == 'pay'*/){ 
	if(version_compare(phpversion(), '5.4.0', '>=')){
		if(session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

	} else {
	 session_start();
	}
}


//判断php版本是否小于5.3
if(version_compare(PHP_VERSION,'5.3.0','<')){
	define('SKL_VERSION_SMALL',true);
}else{
	define('SKL_VERSION_SMALL',false);
}


define('SKL_WEBROOT_PATH','/shoukuanla/');  //收款啦文件夹路径(相对于网站根目录)
define('SKL_ROOT_PATH',dirname(__FILE__).'/');
define('SKL_ClASS_PATH',SKL_ROOT_PATH.'class/'); 
define('SKL_CONTROLLER_PATH',SKL_ROOT_PATH.'home/controller/'); //控制器路径
define('SKL_VIEW_PATH',SKL_ROOT_PATH.'home/view/'); //视图路径
define('SKL_FUNCTION_PATH',SKL_ROOT_PATH.'function/'); //函数路径

require_once (SKL_FUNCTION_PATH.'function.php');
require_once (SKL_ClASS_PATH.'ShoukuanlaBase.class.php');
$cFileName=SKL_CONTROLLER_PATH.$skl_c.'.class.php';
if(!file_exists($cFileName)){ exit; }
require_once($cFileName);

$shoukuanla=new $skl_c();
if(method_exists($shoukuanla,$skl_a)){
	$shoukuanla->$skl_a(); 
}else{
  skl_error($skl_a.'成员函数不存在！');
}

?>