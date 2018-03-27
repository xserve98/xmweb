<?php
//网站配置变量读取
//echo $_SESSION['SitePath']."/cache/website.php";exit;
$C_Patch=$_SERVER['DOCUMENT_ROOT'];
@include_once($C_Patch."/cache/website.php");
@include_once($C_Patch."/cache/conf.php");
//echo "asdf";exit;
if($web_site['close'] == 1) {
	//header("location:./close.php");
	echo "<script>parent.location.href='./close.php';</script>";
    exit();
}
?>