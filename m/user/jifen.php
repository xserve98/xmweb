<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$userinfo=user::getinfo($_SESSION["uid"]);

//设置银行卡信息
if($_GET["action"]=="save"){
	$pay_jifen=htmlEncode($_POST["pay_value"]);
	$qkpwd=htmlEncode($_POST["qk_pwd"]);
	$vlcodes=$_POST["vlcodes"];
	
	if($vlcodes!=$_SESSION["randcode"]){   
		message("验证码错误，请重新输入");
	}
	$_SESSION["randcode"]=rand(10000,99999); //更换一下验证码
	 //验证取款密码
    $qk_pwd	=	md5($_POST["qk_pwd"]);
    $qk_sql	=	"select uid,money,jifen from k_user where uid=$uid and qk_pwd='$qk_pwd'";
	$qk_query	=	$mysqli->query($qk_sql);  		
	$qk_rs		=	$qk_query->fetch_array();
	if(!$qk_rs){
		message('提款密码错误，请重新输入');
		exit();
	}
	if(!is_numeric($pay_jifen) || $pay_jifen<$web_site['jf_min']){
		message("请输入正确的积分,最低兑换".$web_site['jf_min'].'积分');
	}
	
	$pay_value	=	sprintf("%.2f",floatval($pay_jifen));
	if($pay_value<0){
		message('积分错误，请重新输入');
		exit();
	}
	if($userinfo["jifen"]<$pay_jifen){
		message('您的积分不足'.$pay_jifen.'，请重新输入');
		exit();
	}
	try{
		$order		=	$_SESSION['username']."_".date("YmdHis");
		$about=$pay_value.'积分兑换'.$pay_value.'元';
		$re=user::jifen_add($uid,$order,$about,$pay_value,3,'积分兑换');
		
		if($re){
			$mysqli->commit(); //事务提交
			message('兑换成功','jifen.php');
		}else{
			$mysqli->rollback(); //数据回滚
			message("由于网络堵塞，本次申请失败。\\n请您稍候再试，或联系在线客服。");
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message("由于网络堵塞，本次申请失败。\\n请您稍候再试，或联系在线客服。");
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>乐博国际</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/styles/ucenter.css">
	<script src="/assets/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</head>
<script language="javascript" src="../js/jquery.js"></script> 
<script language="javascript" src="../js/jifen.js"></script> 
<style type="text/css">
body {
	background:#ffffff;
	font-size: 12px;
	font-family:"宋体";
	width:100%;
}
</style>
<script language="javascript">
function confirmsxf() {
	if($("#tikuan_sxf").attr("checked")) {
		$("#btn").removeAttr('disabled');
	} else {
		$("#btn").attr('disabled','disabled');
	}
}
</script>
<body>
<div class="h10"></div>
<div class="ucenter">
	<div class="container">
	<div class="row">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">积分兑换</h3>
		  </div>
		  <div class="panel-body">
		    <form class="form-horizontal" onsubmit="return  check_submit()" action="jifen.php?action=save" method="post" name="form1">
				<div class="form-group">
				    <label class="col-sm-2 control-label">兑换积分：</label>
				    <div class="col-sm-10">
				    	<input class="form-control" name="pay_value" type="text" id="pay_value" onkeyup="if(isNaN(value))execCommand('undo')" maxlength="6"/>
				    </div>
				</div>
		    	<div class="form-group">
				    <label class="col-sm-2 control-label">取款密码：</label>
				    <div class="col-sm-10">
				    	<input class="form-control" name="qk_pwd" type="password" id="qk_pwd" maxlength="30" />
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">验证码：</label>
				    <div class="col-sm-10">
				    	<div class="row">
				    		<div class="col-xs-8"><input name="vlcodes" type="text" class="form-control" id="vlcodes" size="5" maxlength="4" onfocus="next_checkNum_img()" /></div>
				    		<div class="col-xs-4"><img src="/yzm.php" alt="点击更换" name="checkNum_img" id="checkNum_img" onclick="next_checkNum_img()" /></div>
				    	</div>
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-sm-10 col-sm-offset-2">
				    	<input name="submit" type="submit" class="btn btn-green btn-lg btn-block"  id="btn" value="提交"/>
				    </div>
				</div>
		    </form>
		  </div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
			    <h3 class="panel-title">会员信息</h3>
			  </div>
			  <div class="panel-body">
			    <p>会员账户：<?=$_SESSION["username"]?></p>
			    <p>当前余额：<span id="hyye" style="color:red"><?=$userinfo["money"]?></span></p>
                <p>当前积分：<span id="hyye" style="color:green"><?=$userinfo["jifen"]?></span></p>
			  </div>
		  </div>

		  <div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">兑换须知</h3>
		  </div>
		  <div class="panel-body">
		    <p>1 、兑换最低为<?=$web_site['jf_min']?>积分，没有上限。</p>
			  <p>2 、24小时任意时间，无限次数。</p>
			  <p>3 、积分兑换比例为1：1，即100积分兑换100元。</p>
			  <p>4 、积分兑换为即时自动到账。</p>
		  </div>
		</div>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>