<?php
session_start();
include_once("../common/login_check.php");
include_once("../include/config.php");
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
//设置银行卡信息
if(isset($_GET["action"]) && $_GET["action"]=="save"){
	include_once("../class/user.php");
	include_once("../common/function.php");
	
	$yzm	=	strtolower($_POST["vlcodes"]);
	if($yzm!=$_SESSION["randcode"]){   
		message("验证码错误,请重新输入");
	}
	$_SESSION["randcode"]	=	rand(10000,99999); //更换一下验证码
	
	$sql	=	"select qk_pwd,pay_name from k_user where uid='".$_SESSION["uid"]."' limit 1";
	$query	=	$mysqli->query($sql);  		
	$rs		=	$query->fetch_array();
	if($rs['qk_pwd'] != md5($_POST["qk_pwd"])){
		message("取款密码错误,请重新输入");
	}
	$address=	htmlEncode($_POST["add1"]).htmlEncode($_POST["add2"]).htmlEncode($_POST["add3"]);
	if(user::update_paycard($_SESSION["uid"],htmlEncode($_POST["pay_card"]),htmlEncode($_POST["pay_num"]),$address,$rs['pay_name'],$_SESSION["username"])){
  		header('Refresh: 0; url=../money/tikuan.php'); exit();
	}else{
		message('设置出错，请重新设置你的银行卡信息','set_card.php');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>提款信息绑定</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/styles/ucenter.css">
	<script src="/assets/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
<script language="javascript">
function check_submit()
{
 if($("#qk_pwd").val()=="")
 {
 alert("请输入您注册时设置的取款密码");
 $("#qk_pwd").focus();
 return false;
 }
 if($("#pay_num").val()=="")
 {
 alert("请填写好你的银行卡号");
 $("#pay_num").focus();
 return false;
 }
 if($("#add2").val()=="")
 {
 alert("请填写好你银行开户行所在的地区");
 $("#add2").focus();
 return false;
 }
 if($("#add3").val()=="")
 {
 alert("请填写好你的开户行名称");
 $("#add3").focus();
 return false;
 }

}
function next_checkNum_img(){
	document.getElementById("checkNum_img").src = "../yzm.php?"+Math.random();
	return false;
}
</script>
</head>
<body>
<div class="h10"></div>
<div class="ucenter">
	<div class="container">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">提款信息</h3>
		  </div>
		  <div class="panel-body">
		    <form class="form-horizontal" onsubmit="return check_submit();" action="set_card.php?action=save" method="post" name="form1">
		    	<div class="form-group">
				    <label class="col-sm-2 control-label">会员账号：</label>
				    <div class="col-sm-10">
				      <input class="form-control" type="text" disabled="disabled" value="<?=$_SESSION["username"]?>">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">开户姓名：</label>
				    <div class="col-sm-10">
				      <input class="form-control" name="pay_name" type="text" disabled="disabled"  value="<?=urldecode($_GET["pay_name"])?>" />
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">取款密码：</label>
				    <div class="col-sm-10">
				    	<input class="form-control" name="qk_pwd" type="password" id="qk_pwd" maxlength="30" />
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">借记卡种类：</label>
				    <div class="col-sm-10">
				    	<select class="form-control" id="pay_card" name="pay_card">
							<option value="中国工商银行" selected="selected">中国工商银行</option>
							  <option value="中国招商银行">中国招商银行</option>
							  <option value="中国邮政银行">中国邮政银行</option>
							  <option value="中国农业银行">中国农业银行</option>
							  <option value="中国建设银行">中国建设银行</option>
							  <option value="中国民生银行">中国民生银行</option>
							  <option value="中国交通银行">中国交通银行</option>
							  <option value="深圳发展银行">深圳发展银行</option>
							  <option value="中国银行">中国银行</option>
						</select>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">借记卡号：</label>
				    <div class="col-sm-10">
				    	<input class="form-control" name="pay_num" type="text" id="pay_num"  />
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">开户地区：</label>
				    <div class="col-sm-10">
				    	<select class="form-control" id="add1" name="add1">
							<option value="北京" selected="selected">北京</option>
							  <option value="上海">上海</option>
							  <option value="天津">天津</option>
							  <option value="广东">广东</option>
							  <option value="重庆">重庆</option>
							  <option value="河北">河北</option>
							  <option value="河南">河南</option>
							  <option value="江苏">江苏</option>
							  <option value="浙江">浙江</option>
							  <option value="山东">山东</option>
							  <option value="山西">山西</option>
							  <option value="广西">广西</option>
							  <option value="福建">福建</option>
							  <option value="内蒙古">内蒙古</option>
							  <option value="黑龙江">黑龙江</option>
							  <option value="辽宁">辽宁</option>
							  <option value="吉林">吉林</option>
							  <option value="新疆">新疆</option>
							  <option value="甘肃">甘肃</option>
							  <option value="宁夏">宁夏</option>
							  <option value="陕西">陕西</option>
							  <option value="湖北">湖北</option>
							  <option value="湖南">湖南</option>
							  <option value="江西">江西</option>
							  <option value="四川">四川</option>
							  <option value="贵州">贵州</option>
							  <option value="云南">云南</option>
							  <option value="西藏">西藏</option>
							  <option value="青海">青海</option>
							  <option value="海南">海南</option>
							  <option value="安徽">安徽</option>
							  <option value="香港">香港</option>
							  <option value="澳门">澳门</option>
							  <option value="其他">其他</option>
						</select>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">开户市：</label>
				    <div class="col-sm-10">
				    	<input class="form-control" name="add2" type="text" id="add2" />
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">开户网点：</label>
				    <div class="col-sm-10">
				    	<input class="form-control" type="text" name="add3" id="add3">
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-2 control-label">验证码：</label>
				    <div class="col-sm-10">
				    	<div class="row">
				    		<div class="col-xs-8"><input class="form-control" type="text" name="vlcodes" id="vlcodes"></div>
				    		<div class="col-xs-4"><img src="../yzm.php" alt="点击更换" name="checkNum_img" id="checkNum_img" onclick="next_checkNum_img()" /></div>
				    	</div>
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-sm-10 col-sm-offset-2">
				    	<label><input type="checkbox" name="readrule" id="readrule" checked="checked"> 我已查看提款须知，并已清楚了解了</label><br>
				    	<label><input type="checkbox" checked="checked" name="readrule2" id="readrule2"> 绑定此取款信息</label><br>
				    	<input type="submit" class="btn btn-green btn-lg btn-block" value="提交" />
				    </div>
				</div>
		    </form>
		  </div>
		  <div class="panel-footer">
		  	<p>
				<strong class="text-danger">【提款须知】：</strong><br>
				1 、银行账户持有人姓名必须与在万丰国际输入的姓名一致，否则无法申请提款。<br>
				2 、大陆各银行帐户均可申请提款。<br>
				3 、每个会员账户（北京时间）24小时只提供一次提款。<br>
				4 、买彩后未经全额投注提彩申请不予受理。<br>
				5 、每位客户只可以使用一张银行卡进行提款,如需要更换银行卡请与客服人员联系.否则提款将被拒绝。<br>
				6 、为保障客户资金安全，万丰国际有可能需要用户提供电话，银行账号或其它资料验证，以确保客户资金不会被冒领。<br>
				<?php
				if($_COOKIE['is_daili']){
				?>
				7 、代理额度申请时间为每月2～5号，且只能申请一次。首次申请代理额度需在取得代理资格后至少35天。<br>
				<?php
				}
				?>
				<br>
				<strong class="text-danger">【到账时间】：</strong><br>
				5分钟至30分钟到账。<br>
			</p>
		  </div>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>
