<?php
$C_Patch=$_SERVER['DOCUMENT_ROOT'];
@include_once($C_Patch."/../cache/website.php");
@include_once($C_Patch."/../cache/conf.php");

if($web_site['close'] == 1) {
	echo "<script>parent.location.href='./close.php';</script>";
    exit();
}

/*自定义攻击拦截*/
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
?>