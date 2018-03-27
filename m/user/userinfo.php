<?php
session_start();
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../include/sqlservergame.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid,false); //验证是否登陆

if(@$_GET["action"]=="save"){
	if($_POST['zcyzm'] == $_SESSION["randcode"]){
		$_SESSION["randcode"]	=	rand(10000,99999); //更换一下验证码
		
		$sql	=	"select answer,username from k_user where uid=".$uid; //验证密码答案
		$query	=	$mysqli->query($sql);
		$rs		=	$query->fetch_array();
		$username = $rs['username'];
		if($rs['answer'] != $_POST['mmda']){ //密码答案错误
			echo "<script>alert('密码答案错误，修改失败');</script>";
			echo "<script>location.href='userinfo.php';</script>";
			exit;
		}
		
		if($_POST["zcpwd0"] && $_POST["zcpwd1"]){
			if(user::update_pwd($_SESSION["uid"],$_POST["zcpwd0"],$_POST["zcpwd1"],'password')){
			    /*
				$conn = open_sql_connection("QPAccountsDB");
				if( $conn != false) {
					$sql = "select accounts from AccountsInfo where accounts='".$username."'";
					$result = sqlsrv_query( $conn, $sql, null);
					$game_user = null;
					while($row = sqlsrv_fetch_array($result)) {
						$game_user = $row["accounts"];
					}
					if($game_user != null) {
						$password = strtoupper(md5($_POST["zcpwd1"]));
						$sql = "Update [AccountsInfo] SET [LogonPass]='".$password."' WHERE ACCOUNTS='".$username."'";
						sqlsrv_query( $conn, $sql, null);
					}
				}
				close_sql_connection($conn);
				*/
				echo "<script>alert('登陆密码修改成功');</script>";
			}else{
				echo "<script>alert('登陆密码修改失败');</script>";
			}
		}
		if($_POST["qkpwd0"] && $_POST["qkpwd1"]){
			if(user::update_pwd($_SESSION["uid"],$_POST["qkpwd0"],$_POST["qkpwd1"],'qk_pwd')){
				echo "<script>alert('取款密码修改成功');</script>";
			}else{
				echo "<script>alert('取款密码修改失败');</script>";
			}
		}
		if($_POST["dlpwd0"] && $_POST["dlpwd1"]){
			if(user::update_pwd($_SESSION["uid"],$_POST["dlpwd0"],$_POST["dlpwd1"],'dl_pwd')){
				echo "<script>alert('代理密码修改成功');</script>";
			}else{
				echo "<script>alert('代理密码修改失败');</script>";
			}
		}
	}else{
		echo "<script>alert('验证码错误');</script>";
	}
	echo "<script>location.href='userinfo.php';</script>";
	exit;
} else {
	$sql	=	"select * from k_user where uid=".$uid; //验证密码答案
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
	$card = $rs['pay_card'];
	$number = $rs['pay_num'];
	$address = $rs['pay_address'];
}

$userinfo=user::getinfo($_SESSION["uid"]);
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="UTF-8">
<title>修改资料</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/styles/ucenter.css">
<script src="/assets/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script language="javascript">
if(self==top){
	top.location='/index.php';
}
</script>
<script language="javascript">
function check_submit(){
	var xg	=	0;
	if($("#zcpwd0").val().length>0){ //修改了注册密码
		xg	=	xg+1;
		if($("#zcpwd0").val().length<6){
			alert("原登陆密码最少为6个字符");
			$("#zcpwd0").select();
			return false;
		}
		
		if($("#zcpwd1").val().length<6){
			alert("新登陆密码最少为6个字符");
			$("#zcpwd1").select();
			return false;
		}
		
		if($("#zcpwd1").val()!=$("#zcpwd2").val()){
			alert("两次密码输入不一致");
			$("#zcpwd2").select();
			return false;
		}
    }
	
	if($("#qkpwd0").val().length>0){ //修改了取款密码
		xg	=	xg+1;
		if($("#qkpwd0").val().length<6){
			alert("原取款密码最少为6个字符");
			$("#qkpwd0").select();
			return false;
		}
		
		if($("#qkpwd1").val().length<6){
			alert("新取款密码最少为6个字符");
			$("#qkpwd1").select();
			return false;
		}
		
		if($("#qkpwd1").val()!=$("#qkpwd2").val()){
			alert("两次密码输入不一致");
			$("#qkpwd2").select();
			return false;
		}
    }
	
	if($("#dlpwd0").val().length>0){ //修改了代理密码
		xg	=	xg+1;
		if($("#dlpwd0").val().length<6){
			alert("原代理密码最少为6个字符");
			$("#dlpwd0").select();
			return false;
		}
		
		if($("#dlpwd1").val().length<6){
			alert("新代理密码最少为6个字符");
			$("#dlpwd1").select();
			return false;
		}
		
		if($("#dlpwd1").val()!=$("#dlpwd2").val()){
			alert("两次密码输入不一致");
			$("#dlpwd2").select();
			return false;
		}
    }
	
	if(xg==0){
		alert("您什么都没有操作");
		return false;
	}
	
	if($("#mmda").val().length<1){
		alert("请输入密码答案");
		$("#mmda").select();
		return false;
	}
		
	if($("#zcyzm").val().length<4){
		alert("请输入正确的验证码");
		$("#zcyzm").select();
		return false;
	}
	return true;
}

//CharMode函数 
//测试某个字符是属于哪一类
function CharMode(iN) {
	if (iN>=48 && iN <=57) //数字
		return 1;
	if (iN>=65 && iN <=90) //大写字母
		return 2;
	if (iN>=97 && iN <=122) //小写
		return 4;
	else
		return 8; //特殊字符
}

//bitTotal函数
//计算出当前密码当中一共有多少种模式
function bitTotal(num) {
	var modes=0;
	for (i=0;i<4;i++) {
		if (num & 1) modes++;
		num>>>=1;
	}
	return modes;
}

//checkStrong函数
//返回密码的强度级别
function checkStrong(sPW) {
    if (sPW.length<=6) return 0; //密码太短
	var Modes=0;
	for (i=0;i<sPW.length;i++) {      //测试每一个字符的类别并统计一共有多少种模式
		Modes|=CharMode(sPW.charCodeAt(i));
	}
	return bitTotal(Modes);
}

//pwStrength函数
//当用户放开键盘或密码输入框失去焦点时,根据不同的级别显示不同的颜色
function pwStrength(pwd,num) {
	var O_color="btn-default";
	var L_color="btn-danger";
	var M_color="btn-warning";
	var H_color="btn-success";
	if (pwd==null||pwd==''){
		Lcolor=Mcolor=Hcolor=O_color;
	}else{
		S_level=checkStrong(pwd);
		switch(S_level) {
			case 0://最强
				Lcolor=Mcolor=Hcolor=O_color;
			case 1://最弱
				Lcolor=L_color;
				Mcolor=Hcolor=O_color;
				break;
			case 2://中等
				Lcolor=Mcolor=M_color;
				Hcolor=O_color;
				break;
			default://默认
				Lcolor=Mcolor=Hcolor=H_color;
		}
	}
	$('#strength_L'+num).attr('class','btn '+Lcolor);
	$('#strength_M'+num).attr('class','btn '+Mcolor);
	$('#strength_H'+num).attr('class','btn '+Hcolor);
	return;
}

function change_zc_yzm(id){
	document.getElementById(id).src = "../yzm.php?"+Math.random();
	return false;
	
}
</script>
</head> 
<body id="zhuce_body">
<div class="h10"></div>
<div class="ucenter">
	<div class="container">
	<div class="row">
		<form action="userinfo.php?action=save" method="post" name="form1" onsubmit="return check_submit();" class="form-horizontal">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">用户信息</h3>
			  </div>
			  <div class="panel-body">
			    <div class="form-group">
				    <label class="col-sm-2 control-label">会员账户：</label>
				    <div class="col-sm-6">
				      <p class="form-control-static"><?=$_SESSION["username"]?></p>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">银行名称：</label>
				    <div class="col-sm-6">
				      <p class="form-control-static"><?=$card?></p>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">银行账号：</label>
				    <div class="col-sm-6">
				      <p class="form-control-static"><?=$number?></p>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">开户地址：</label>
				    <div class="col-sm-6">
				      <p class="form-control-static"><?=$address?></p>
				    </div>
				</div>
			  </div>
			</div>
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">登录资料</h3>
			  </div>
			  <div class="panel-body">
			    <div class="form-group">
				    <label class="col-sm-2 control-label">原登录密码：</label>
				    <div class="col-sm-6">
				      <input type="password" name="zcpwd0" id="zcpwd0" maxlength="20" class="form-control" />
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">新登录密码：</label>
				    <div class="col-sm-6">
				      <input name="zcpwd1" class="form-control" id="zcpwd1" type="password" maxlength="20" onblur="pwStrength(this.value,0);"  onkeyup="pwStrength(this.value,0);" />
				    </div>
				</div>
				<div class="form-group password-degree">
					<label for="" class="col-sm-2 control-label">密码强度：</label>
					<div class="col-sm-4">
						<div class="btn-group">
						  <button id="strength_L0" type="button" class="btn btn-default">弱</button>
						   <button id="strength_M0" type="button" class="btn btn-default">中</button>
						   <button id="strength_H0" type="button" class="btn btn-default">强</button>
						</div>
					</div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">确认密码：</label>
				    <div class="col-sm-6">
				      <input type="password" name="zcpwd2" id="zcpwd2" class="form-control"/>
				    </div>
				</div>
			  </div>
			</div>
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">取款资料</h3>
			  </div>
			  <div class="panel-body">
			    <div class="form-group">
				    <label class="col-sm-2 control-label">原取款密码：</label>
				    <div class="col-sm-6">
				      <input name="qkpwd0" class="form-control" id="qkpwd0" type="password" maxlength="20" />
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">新取款密码：</label>
				    <div class="col-sm-6">
				      <input name="qkpwd1" class="form-control" id="qkpwd1" type="password" maxlength="20" onblur="pwStrength(this.value,1);"  onkeyup="pwStrength(this.value,1);" />
				    </div>
				</div>
				<div class="form-group password-degree">
						<label for="" class="col-sm-2 control-label">密码强度：</label>
						<div class="col-sm-4">
						<div class="btn-group">
							  <button id="strength_L1" type="button" class="btn btn-default">弱</button>
							   <button id="strength_M1" type="button" class="btn btn-default">中</button>
							   <button id="strength_H1" type="button" class="btn btn-default">强</button>
							</div>
						</div>
					</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">确认密码：</label>
				    <div class="col-sm-6">
				      <input name="qkpwd2" id="qkpwd2" class="form-control" type="password" maxlength="20" />
				    </div>
				</div>
			  </div>
			</div>
			
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">密码问答</h3>
			  </div>
			  <div class="panel-body">
			    <div class="form-group">
				    <label class="col-sm-2 control-label">密码问题：</label>
				    <div class="col-sm-6">
				      <p class="form-control-static"><?=$userinfo['ask']?></p>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">密码答案：</label>
				    <div class="col-sm-6">
				      <input name="mmda" id="mmda" class="form-control" type="text" maxlength="20" />
				    </div>
				</div>
			  </div>
			</div>
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">验证码</h3>
			  </div>
			  <div class="panel-body">
			    <div class="form-group">
				    <label class="col-sm-2 control-label">验证码：</label>
				    <div class="col-sm-6">
				      <div class="row">
				      	<div class="col-xs-8"><input class="form-control" name="zcyzm" id="zcyzm" type="text" maxlength="4" onfocus="change_zc_yzm('zc_img')" /></div>
				      	<div class="col-xs-4"><img src="../yzm.php" alt="点击更换" name="zc_img" id="zc_img" style="cursor:pointer;" onclick="change_zc_yzm('zc_img')" /></div>
				      </div>
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-sm-6 col-sm-offset-2">
				      <input class="btn btn-green btn-lg btn-block" name="tj" type="submit" id="tj" value="提交"/> 
				    </div>
				</div>
			  </div>
			</div>
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">忘记密码？</h3>
			  </div>
			  <div class="panel-body">
			    <p>如果您忘记了密码，请您扫描身份证件发送到万丰国际邮箱，并与客服联系。</p>
		        <p>为了保证会员的资金安全，请您谅解要扫描身份证件验证您的身份。</p>
				<p>请您放心，您的资料绝对保密，谢谢您对万丰国际的支持！</p>
		        <p>万丰国际永久邮箱：customer@ez114.com</p>
			  </div>
			</div>

		</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function($) {
	var hb=$(document).height();
	if(hb>0)
		$('#J_UserIFrame',parent.document).height(hb);
});
</script>
</body> 
</html>