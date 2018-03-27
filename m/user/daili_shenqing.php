<?php
@session_start();
if(!$_SESSION['uid']){
	echo "<script>alert('请您登陆后再来申请代理！！');history.go(-1);</script>";
	exit();	
}
include_once("../common/login_check.php");
include_once("../include/config.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");

if(user::is_daili($_SESSION["uid"])){ //这里跳转到代理申请的页面
	echo "<script>alert('你已经是代理\\n不需重复代理');location.href='cha_xiaji_zongdai.php';</script>";
	exit();
}
$sql	=	"select d_id from k_user_daili where uid='".$_SESSION["uid"]."' and add_time>='".date("Y-m-d")." 00:00:00' and add_time<='".date("Y-m-d")." 23:59:59'";
$query	=	$mysqli->query($sql);
if($query->fetch_array()){
	message('代理每天只能申请一次，您今天已经提交申请了，请等待客服人员联系和确认。','dailicode.php');
}

if(@$_GET["action"]=="add"){ 
	$yzm	=	$_POST['tf_yzm'];
	if($yzm ==	$_SESSION["randcode"]){
		$_SESSION["randcode"]	=	rand(10000,99999); //更换一下验证码
		
		$uid	=	$_SESSION["uid"];
		$r_name	=	(trim($_POST["pay_name"]));
		$mobile	=	$_POST["mobile"];
		$email	=	$_POST["email"];
		$about	=	$_POST["about"];
		$sql	=	"insert into k_user_daili(uid,r_name,mobile,email,about) values ('$uid','$r_name','$mobile','$email','$about')";
		
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			$q1		=	$mysqli->affected_rows;
			if($q1 == 1){
				$mysqli->commit(); //事务提交
				message('你的申请已经提交，等待客服人员联系和确认。','dailicode.php');
			}else{
				$mysqli->rollback(); //数据回滚
				message('保存失败');
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			message('保存失败');
		}
	}else{
		message('验证码错误');
	}
}
$userinfo=user::getinfo($_SESSION["uid"]);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>www</title>
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
if(self==top){
	top.location='/index.php';
}
function check_form(){
  	var t_about=document.getElementById("about").value;
  	var t_r_name=document.getElementById("r_name").value;
	  if(t_r_name.length<2) { 
		  alert("请填写你的真实姓名");
		  return false;
	  }
	  if(t_about.length<10) { 
		  alert("请填写申请理由,长度不够");
		  return false;
	 }
	 
  	var yzm=document.getElementById("tf_yzm").value;
	if(yzm.length < 4){
		document.getElementById("tf_yzm").select();
		return false;
	}
}

function next_checkNum_img(){
	document.getElementById("checkNum_img").src = "../yzm.php?"+Math.random();
	return false;
}
</script>
<body>
<div class="h10"></div>
<div class="ucenter">
	<div class="container">
	<div class="row">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">代理申请</h3>
		  </div>
		  <div class="panel-body">
		    <form class="form-horizontal" id="form1"  name="form1" onsubmit="return check_form()" method="post" action="?action=add">
		    	<div class="form-group">
				    <label class="col-sm-2 control-label">会员账号：</label>
				    <div class="col-sm-10">
				    	<input class="form-control" name="username" id="username" readonly  value="<?=$userinfo["username"]?>" />
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">真实姓名：</label>
				    <div class="col-sm-10">
				    	<input class="form-control" name="pay_name" id="pay_name" type="text" value="<?=$userinfo["pay_name"]?>"/>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">联系电话：</label>
				    <div class="col-sm-10">
				    	<input class="form-control" name="mobile" value="<?=$userinfo["mobile"]?>"/>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">电子邮箱：</label>
				    <div class="col-sm-10">
				    	<input class="form-control" name="email" value="<?=$userinfo["email"]?>"/>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">申请理由：</label>
				    <div class="col-sm-10">
				    	<textarea class="form-control" name="about" id="about" cols="50" rows="5" style="width: 360px; height: 90px; margin: 0 0 0 0px; font-size:12px;"></textarea>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">验证码：</label>
				    <div class="col-sm-10">
				    	<div class="row">
				    		<div class="col-xs-8"><input class="form-control" name="tf_yzm" id="tf_yzm" maxlength="4" onfocus="next_checkNum_img()" /></div>
				    		<div class="col-xs-4"><img src="../yzm.php" alt="点击更换" name="checkNum_img" id="checkNum_img" onclick="next_checkNum_img()" /></div>
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
        
		</div>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>