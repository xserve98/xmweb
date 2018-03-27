<?php 
session_start();
require ("include/config.php");
$number='888';
$codenumber=$_POST['codenumber'];
$action=$_POST['action'];
if (@$action=="check"){
	if ($number==$codenumber){
		$_SESSION["safecode"]=$number;
		header("Content-type: text/html; charset=utf-8");
		header("Location: http://".$_SERVER['SERVER_NAME']."?f=".$_GET["f"]); 
		echo "<SCRIPT language='javascript'>\nlocation='/?f=".$_GET["f"]."';</script>";
		exit;
		}
	else{
		header("Content-type: text/html; charset=utf-8");
		echo "<SCRIPT language='javascript'>\nalert('安全码错误，请重新输入');location='/codecheck.php?f=".$_GET["f"]."';</script>";
		exit;
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
</head>
<style type="text/css">
.{font-size:12px;}
</style>

<body style="text-align:center;">
<div style="margin:0 auto; width:100%; height:auto; text-align:center;" id="main">
<div style="margin:0 auto; width:100%; height:58px; text-align:center; background:url(newindex/2015.jpg) no-repeat bottom center; padding:0px; padding-top:220px;">
<form action="" method="post">
<table cellpadding="0" cellspacing="10" border="0" style="margin:0 auto;">
<tr>
<td width=100 height=48>
<label style="vertical-align:middle;">内部管理</label>
</td>
<td>
<input type="text" name="codenumber" size="25" style="vertical-align:middle;"/>
<input type="hidden" name="action" value="check" />
</td>
<td>
<input type="submit" value="Submit"  style="vertical-align:middle; height:22px;">
</td>
</tr>
</table>
</form>
</div>
</div>
</body>
<script type="text/javascript" language="javascript">
<!--
    var winWidth = 0;
    var winHeight = 0;
    function findDimensions() //函数：获取尺寸
    {
        //获取窗口宽度
        if (window.innerWidth)
            winWidth = window.innerWidth;
        else if ((document.body) && (document.body.clientWidth))
            winWidth = document.body.clientWidth;
        //获取窗口高度
        if (window.innerHeight)
            winHeight = window.innerHeight;
        else if ((document.body) && (document.body.clientHeight))
            winHeight = document.body.clientHeight;
        //通过深入Document内部对body进行检测，获取窗口大小
        if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth) {
            winHeight = document.documentElement.clientHeight;
            winWidth = document.documentElement.clientWidth;
        }
        //结果输出至两个文本框
        document.getElementById("main").style.height = winHeight + "px";
    }
    findDimensions();
    //调用函数，获取数值
    window.onresize = findDimensions;
-->
</script>
</html>