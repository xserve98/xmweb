<?php
/*自定义攻击拦截*/
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
    require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}
//手机目录
$m_file='D:/web/m/';
unset($mysqli);
$mysqli	=	new MySQLi("127.0.0.1","root","root","xiongmao",3306);
$mysqli->query("set names utf8");
?>