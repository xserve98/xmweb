<?php
include_once("../common/login_check.php");
include_once("../include/mysqli.php");

$sql	=	"update k_user_msg set islook=1 where uid='".$_SESSION["uid"]."' and msg_id='".$_GET["id"]."'";
$mysqli->query($sql);

$sql	=	"select * from k_user_msg where uid='".$_SESSION["uid"]."' and msg_id='".$_GET["id"]."' limit 1";
$query	=	$mysqli->query($sql);  		
$rows	=	$query->fetch_array();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>万丰国际</title>
	<title>系统消息查询</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/styles/ucenter.css">
	<script src="/assets/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
    <script>
    function Go(url){
		alert('请在PC版中浏览代理详情');
	}
    </script>
</head> 
<body class="body_msg">
<div class="h10"></div>
<div class="ucenter">
	<div class="container">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3><?=$rows["msg_title"]?></h3>
		  </div>
		  <div class="panel-body">
		    <p><?=str_replace("\r\n","<br />",$rows["msg_info"])?></p>
		    <p>
		    	<a href="javascript:history.go(-1);" class="btn btn-green pull-left">[返回上一页]</a>
		    	<a href="sys_msg_del.php?id=<?=$rows["msg_id"]?>" class="btn btn-danger pull-right">[删除]</a>
		    </p>
		  </div>
		  <div class="panel-footer text-right"><?=$rows["msg_from"]?> <?=date("Y-m-d",strtotime($rows["msg_time"]))?></div>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body> 
</html>