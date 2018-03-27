<?php
$C_Patch=$_SERVER['DOCUMENT_ROOT'];
@include_once($C_Patch."/cache/website.php");
@include_once($C_Patch."/cache/conf.php");

//关闭白名单控制
$unclose = 0;
$uncloselist = array("xtgl/set_site.php","login.php","/cj/","zdfx.php","zdgl/auto.php");
foreach($uncloselist as $value) {
	if (strpos($_SERVER['PHP_SELF'], $value)) {
		$unclose = 1;
		break;
	}
}
if($web_site['close']==1 && $unclose==0) {
	echo "<script>parent.location.href='./close.php';</script>";
    exit();
}

/*自定义攻击拦截*/
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
?>