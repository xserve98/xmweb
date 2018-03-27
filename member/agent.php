<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
include_once("qrcode.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
	
	$sqla="select * from k_user where uid = '$uid'  limit 1";
	
	$query	 =	$mysqli->query($sqla);
    $rs	 =	$query->fetch_array();
	$fandian= $rs['fandian'];
renovate($uid,$loginid);

if(!user::is_daili($uid)) {
    message('你还不是代理，请先申请！', "agent_reg.php");
}
$sub = 1;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html class="no-js" lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/newdsn/css/jquery-ui.css">
<link rel="stylesheet" href="/newdsn/css/cash/popup.css">
<link rel="stylesheet" href="/newdsn/css/admin.css">
<link rel="stylesheet" href="/newdsn/css/stepitm.css">
<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="/js/laydate/laydate.min.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/admin_content.js"></script>
<script type="text/javascript" src="/js/dialog.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/common.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/index.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/home.js"></script>
</head>

<body >

<?php include_once("agentmenu.php"); ?>

<div class="rightpanel rw">
		<div class="contentcontainer">
<div class="maincol innerline" style="
    text-align: center;
">
				<div class="row pagetitle">
					<span class="bluepagetitle">专属二维码</span><br>  分享二维码给好友可以获的高额返点
				</div>
			<div class="row">
				
	<img src="../member/images/uidimg/<?=$_SESSION["uid"]+100000?>.png" alt="二维码" >	
			</div>	
			</div>
			<div class="maincol">
				<div class="row pagetitle">
					<span class="bluepagetitle">推广网址</span>&nbsp;&nbsp;&nbsp;&nbsp;直接复邀请链接给好友,您的下级投注返点：<span style="color:red"><?=$fandian?></span>
				</div>
				<div class="row" id="row-item">

					<div class="maincol bind">
						<div class="moneybtn" style="
    width: 500px !important;
">
							<div class="mt2 ml55">
								
							</div>
							<div>推广网址：http://<?= $_SERVER['SERVER_NAME']?>/?f=<?=$_SESSION["uid"]+100000?>
</div>
							<div class="iconmoney"></div>
						</div>
					</div>							
					
				</div>
				<div id="row-info">温馨提示：没有绑定手机或邮箱的会员请及时完善资料，否则会影响修改银行卡和姓名或其他资料。</div>
			</div>
		</div>
	</div>


</body>

</html>
