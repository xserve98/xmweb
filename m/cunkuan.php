<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include_once("include/config.php");
if($_SESSION["uid"]==""){
	echo "<script>alert(\"请登录后再进行存款和提款操作\");location.href='zhuce.php';</script>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>在线充值</title>
<meta http-equiv="Cache-Control" content="max-age=864000" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/styles/ucenter.css">
	<script src="/assets/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</head>
<script language="javascript">
if(self==top){
	top.location='/index.php';
}
</script>
<body>
<div class="h10"></div>
<div class="ucenter">
	<div class="container">	
		<div class="row">		
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">在线支付</h3>
		  </div>
		  <div class="panel-body">
		    <form action="http://www.sslfbh.cn/yeepay/pay.php" method="post" name="form1" id="form1">
				<p>用网银在线支付;免手续费;即时到帐.超过10000RMB建议请使用公司入款!</p>
				<p>
				<a href="#" class="btn btn-default btn-lg btn-block">请在PC上使用在线支付</a>
				<!-- <a href="javascript:void(0)" onclick="document.form1.submit();" class="btn btn-green btn-lg btn-block">在线支付</a> -->
				<input name="username" type="hidden" id="username" value="<?=$_SESSION["username"]?>" />
				<input name="uid" type="hidden" id="uid" value="<?=$_SESSION["uid"]?>" />
				</p>
				</form>
		  </div>
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">公司入款</h3>
		  </div>
		  <div class="panel-body">
		    <h3>通过银行卡汇款,支付宝汇款</h3>
		    <p>5~30分钟到账，赠送1.2%红利（银行卡入款）,请每次入款前登录会员核对银行账号是否变更！</p>
		    <a href="huikuan.php" class="btn btn-green btn-lg btn-block">公司入款</a>
		    <h4 class="text-danger">【特别提示】：</h4>
			<p class="bg-danger">5~30分钟到账，赠送1.2%红利,请每次入款前登录会员核对银行账号是否变更！</p>
		  </div>
		</div>
		</div>
	</div>
</div>

<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>