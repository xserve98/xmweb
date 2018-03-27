<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");


$sql	=	"select * from message where uid='".intval($_SESSION["uid"])."' and id='".intval($_GET["id"])."' limit 1";
$query	=	$mysqli->query($sql);  		
$rows	=	$query->fetch_array();
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>意见反馈详情</title>
<link rel="stylesheet" href="/newdsn/css/cash/master.css">
<link rel="stylesheet" href="/newdsn/css/cash/style.css">
<link rel="stylesheet" href="/newdsn/css/cash/popup.css">
</head>
<body>
	<div id="feedback" class="section">
            <div class="row clearfix ">
                <div style="width: 100px">反馈时间：</div>
                <div class="txttheme"><?=$rows['addtime']?></div>
            </div>
            <hr>
            <div class="row clearfix ">
                <div style="width: 120px">您的问题 ：	</div>
                <div class="txttheme"><?=$rows['title']?></div>
            </div>
            <hr>
            <div class="row clearfix ">
                <div style="width: 120px">问题具体描述 ：</div>
                <div class="txttheme"><?=$rows['msg']?></div>
            </div>
            <hr>
            <div class="row clearfix ">
                <div style="width: 120px">回复内容 ：</div>
                <div class="txttheme_s"><?=$rows['remsg']?></div>
            </div>
            <hr>
            
        </div>

</body></html>