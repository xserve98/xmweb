<?php
include_once("../common/login_check.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"> 
	<title>系统消息查询</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/styles/ucenter.css">
	<script src="/assets/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</head> 
<body class="body_msg">
<div class="h10"></div>
<div class="ucenter">
		<div class="container">
		<div class="row">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">未读信息</h3>
  </div>
  <div class="panel-body">
  	<p class="bg-danger">若数据未完全显示，请左右划动查看</p>
    <div class="table-responsive">
	  <table class="table">
	  <tr><th>标题</th><th>时间</th></tr>
	    <?php
$sql		=	"select msg_id from k_user_msg where uid=".$_SESSION["uid"]." order by islook asc,msg_id desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if(@$_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,15);

$id		=	'';
$i		=	1; //记录 uid 数
$start	=	($thisPage-1)*15+1;
$end	=	$thisPage*15;
while($row = $query->fetch_array()){
	if($i >= $start && $i <= $end){
		$id .=	$row['msg_id'].',';
	}
	if($i > $end) break;
	$i++;
}
if($id){
	$id		=	rtrim($id,',');
	$sql	=	"select islook,msg_title,msg_time,msg_id from k_user_msg where msg_id in($id) order by islook asc,msg_id desc";
	$query	=	$mysqli->query($sql);
	$i		=	1;
	while($rows = $query->fetch_array()){
?>
	    <tr>
	    	<td><i class="fa fa-<?=$rows["islook"] ? 'folder-open-o' : 'envelope'?>"></i> <a href="sys_msg_show.php?id=<?=$rows["msg_id"]?>"><?= strlen(trim($rows["msg_title"])) ? $rows["msg_title"] : '无标题信息' ?></a></td>
	    	<td><?=date("Y-m-d",strtotime($rows["msg_time"]))?></td>
	    </tr>
	<?php
		$i++;
	}
}
?>
<tr><td>
	<ul class="pagination" style="margin:0px;">
	  	<?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?>
	  </ul>
</td><td><a href="sys_msg_del.php?id=-1" onclick="return confirm('您真的要删除全部消息吗？');" class="btn btn-danger">[删除全部]</a></td></tr>
	  </table>
	  
	</div>
	</div>
  </div>
</div>
</div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body> 
</html>