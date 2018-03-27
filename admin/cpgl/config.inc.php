<?php
/*自定义攻击拦截*/
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');

$dbhost                                = "127.0.0.1";                 // 数据库主机名
$dbuser                                = "root";                 // 数据库用户名
$dbpass                                = "@@##qqaa8520";                         // 数据库密码
$dbname                                = "3dy1_db";                 // 数据库名
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8'"); 
mysql_query("SET CHARACTER_SET_CLIENT=utf8"); 
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
?>