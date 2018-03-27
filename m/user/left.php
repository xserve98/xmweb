<?php @session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>万丰国际</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/css/bootstrap_s.min.css">
	<link rel="stylesheet" href="/css/font-awesome_s.min.css">
	<link rel="stylesheet" href="/styles/ucenter.css">
	<script src="/assets/jquery.js"></script>
	<script src="/js/bootstrap_s.min.js"></script>
</head>
<body>
<?php
ini_set('display_errors','yes');
if(@$_SESSION["uid"] != null) {
$uid = $_SESSION["uid"];
include_once("../include/mysqli.php");
include_once("../include/mysqlio.php");
include_once("../common/logintu.php");
$sql		=	"select count(*) as s from k_user_msg where uid=$uid and islook=0"; //未查看消息
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$user_num	=	$rs['s'];


$sql		=	"select money as s,jifen from k_user where uid=$uid limit 1";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$user_money	=	sprintf("%.2f",$rs['s']);
$user_jifen	=	sprintf("%.2f",$rs['jifen']);
}
?>
<div class="h10"></div>
	<div class="ucenter">
		<div class="container">
			<div class="row">
				<div class="list-group usermenu">
				  <a href="#" class="list-group-item" data-iframe="J_UserIFrame" data-url="/user/userinfo.php"><i class="fa fa-lg fa-user pull-left"></i>
				  <span class="acinfo">
				  账号：<?=@$_SESSION["username"]?><br>
				  余额：<span id="user_money"><?=$user_money?></span>&nbsp;&nbsp;积分：<span id="user_jifen" style="color:#0C3"><?=$user_jifen?></span>
				  </span>
				  <span class="fa fa-lg fa-chevron-right"></span>
				  <div class="clearfix"></div>
				  </a>
				  <a href="#" class="list-group-item" data-iframe="J_UserIFrame" data-url="/cunkuan.php"><i class="fa fa-lg fa-cny"></i>存款<span class="fa fa-lg fa-chevron-right"></span></a>
				  <a href="#" class="list-group-item" data-iframe="J_UserIFrame" data-url="/tikuan.php"><i class="fa fa-lg fa-credit-card"></i>取款<span class="fa fa-lg fa-chevron-right"></span></a>
                  <a href="#" class="list-group-item" data-iframe="J_UserIFrame" data-url="/user/jifen.php"><i class="fa fa-lg fa-jifen"></i>积分兑换<span class="fa fa-lg fa-chevron-right"></span></a>
                  <a href="#" class="list-group-item" data-iframe="J_UserIFrame" data-url="/user/zz_money.php"><i class="fa fa-lg fa-ylc"></i>娱乐场转账<span class="fa fa-lg fa-chevron-right"></span></a>
                  <a href="#" class="list-group-item" data-iframe="J_UserIFrame" data-url="/user/cha_ckonline.php?type=4"><i class="fa fa-lg fa-xm"></i>财务明细<span class="fa fa-lg fa-chevron-right"></span></a>
				</div>
				<div class="h10"></div>
				<div class="list-group usermenu">
				  <a href="#" class="list-group-item" data-iframe="J_UserIFrame" data-url="/user/tzjl.php"><i class="fa fa-lg fa-cart-arrow-down"></i>未结注单<span class="fa fa-lg fa-chevron-right"></span></a>
				  <a href="#" class="list-group-item" data-iframe="J_UserIFrame" data-url="/user/xm.php"><i class="fa fa-lg fa-cubes"></i>历史报表<span class="fa fa-lg fa-chevron-right"></span></a>
				  <?php if(isset($_SESSION['is_daili']) && $_SESSION['is_daili']){ ?>
				  <a href="#" class="list-group-item" data-iframe="J_UserIFrame" data-url="/user/cha_xiaji_dynamic.php"><i class="fa fa-lg fa-users"></i>代理中心<span class="fa fa-lg fa-chevron-right"></span></a>
				  <?php }else{ ?>
				  <a href="#" class="list-group-item" data-iframe="J_UserIFrame" data-url="/user/daili_shenqing.php"><i class="fa fa-lg fa-user-plus"></i>代理申请<span class="fa fa-lg fa-chevron-right"></span></a>
				  <?php } ?>
				  <a href="#" class="list-group-item" data-iframe="J_UserIFrame" data-url="/user/sys_msg.php"><i class="fa fa-lg fa-envelope-o"></i>未读信息<span class="badge"><?=$user_num?></span></a>
				</div>
				<a href="/user/logout.php" class="btn btn-lg btn-block btn-danger" data-slide="#J_p2" data-iframe="J_SportsIFrame" data-url="/user/logout.php" data-target="1">退出当前账号</a>
			</div>
		</div>
	</div>
	<?php include_once("../scripts.php"); ?>
	<script type="text/javascript">
	function refresh_money(){
	$.ajax({
		cache: false,
		url: "/get_money.php",
		success:function(data){
			if(data==""){
			}else{
			$data_arr=data.split("||");
			 $("#user_money").html($data_arr[0]);
			  $("#user_jifen").html($data_arr[1]);
			}
		}
	}); 
	window.setTimeout("refresh_money();", 15000); 
	}
	refresh_money();
	</script>
	<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>