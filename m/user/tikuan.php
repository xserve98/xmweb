<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("function.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);

$sql	=	"select pay_name,pay_card from k_user where uid=$uid limit 1";
$query	=	$mysqli->query($sql);
$rs		=	$query->fetch_array();
if($rs['pay_card'] == ""){
	message("请先绑定银行账号信息","set_card.php");
	exit();
}

if(@$_GET["action"]=="tikuan"){
    //验证取款密码
    $qk_pwd	=	md5($_POST["qk_pwd"]);
    $qk_sql	=	"select uid from k_user where uid=$uid and qk_pwd='$qk_pwd'";
	$qk_query	=	$mysqli->query($qk_sql);  		
	$qk_rs		=	$qk_query->fetch_array();
	if(!$qk_rs){
		message('提款密码错误，请重新输入');
		exit();
	}
	
	$pay_value	=	sprintf("%.2f",floatval($_POST["pay_value"]));
	if(($pay_value<0)||($pay_value>$userinfo["money"])){
		message('提款金额错误，请重新输入');
		exit();
	}
    
    if($pay_value<$web_site['qk_limit']){
        message('提款金额不能低于['.$web_site['qk_limit'].']元');
		exit();
    }
    
    $currtime=time();
    $c_time=date("Y-m-d H:i",$currtime);
    $qk_time_begin=date("Y-m-d",$currtime)." ".$web_site['qk_time_begin'];
    $qk_time_end=date("Y-m-d",$currtime)." ".$web_site['qk_time_end'];
    if (strtotime($c_time)<strtotime($qk_time_begin) || strtotime($c_time)>strtotime($qk_time_end)) {
        message('很抱歉，不在提款时间段，暂时不能提款');
		exit();
    }
	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$sql		=	"update k_user set money=money-$pay_value where uid=$uid";
		$mysqli->query($sql);
		$q1			=	$mysqli->affected_rows;
		
		$pay_value	=	0-$pay_value; //把金额置成带符号数字
		$order		=	$_SESSION['username']."_".date("YmdHis");
		$sql		=	"insert into k_money(uid,m_value,status,m_order,pay_card,pay_num,pay_address,pay_name,about,assets,balance,type) values($uid,$pay_value,2,'$order','".$userinfo["pay_card"]."','".$userinfo["pay_num"]."','".$userinfo["pay_address"]."','".$userinfo["pay_name"]."','',".$userinfo["money"].",".($userinfo["money"]+$pay_value).",2)";
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
		
		if($q1==1 && $q2==1){
			$mysqli->commit(); //事务提交
			message('提款申请已经提交，等待财务人员为您出款','tikuan.php');
		}else{
			$mysqli->rollback(); //数据回滚
			message("由于网络堵塞，本次申请提款失败。\\n请您稍候再试，或联系在线客服。");
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message("由于网络堵塞，本次申请提款失败。\\n请您稍候再试，或联系在线客服。");
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
<script language="javascript" src="../js/tikuan.js"></script> 
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
		    <h3 class="panel-title">提取现金</h3>
		  </div>
		  <div class="panel-body">
		    <form class="form-horizontal" onsubmit="return  check_submit()" action="?action=tikuan" method="post" name="form1">
				<div class="form-group">
				    <label class="col-sm-2 control-label">取款金额：</label>
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
			    <p>会员账户：<?=$userinfo["username"]?></p>
			    <p>当前余额：<span id="hyye" style="color:red"><?=sprintf("%.2f",$userinfo["money"])?></span></p>

				<p>银行名称：<?=$userinfo["pay_card"]?></p>
				<p>银行账号：<?=cutNum($userinfo["pay_num"])?></p>
				<p>开户地址：<?=cutNum($userinfo["pay_address"])?></p>
			  </div>
		  </div>

		  <div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">提款须知</h3>
		  </div>
		  <div class="panel-body">
		    <p>1 、银行账户持有人姓名必须与在乐博国际输入的姓名一致，否则无法申请提款。</p>
			  <p>2 、大陆各银行帐户均可申请提款。</p>
			  <p>3 、充值后未经全额投注提款申请不予受理。</p>
			  <p>4 、单笔最低提款<?=$web_site['qk_limit']?>元，单笔最高提款50万元，每个帐户每24小时内只能提款一次。</p>
			  <p>5 、每位客户只可以使用一张银行卡进行提款,如需要更换银行卡请与客服人员联系.否则提款将被拒绝。</p>
			  <p>6 、为保障客户资金安全，乐博国际有可能需要用户提供电话，银行账号或其它资料验证，以确保客户资金不会被冒领。 </p>
		  </div>
		  <div class="panel-footer">
		  <h4 class="text-danger">到帐时间</h4>
		  <p>5分钟至30分钟到账。</p>
		  </div>
		</div>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>