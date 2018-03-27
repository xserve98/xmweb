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

if(!user::is_daili($uid)){
    message('你还不是代理，请先申请',"agent_reg.php"); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>代理中心</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<link type="text/css" rel="stylesheet" href="images/member.css">
<script type="text/javascript" src="images/member.js"></script>
<link href="../css/userinfo.css" rel="stylesheet" type="text/css" />
</head>
<script language="javascript" src="../js/jquery.js"></script> 
<script language="javascript" src="../js/tikuan.js"></script> 
<style>
.content td{padding:0 10px;}
</style>
<body>
<?php 
include_once("mainmenu.php");
include_once("agentmenu.php");?>
<div class="content">
				<table width="98%" border="0" cellspacing="0" cellpadding="5">
					<tr>
						<td height="30" align="center" bgcolor="#FAFAFA" class="hong"><strong>请使用以下推广网址进行推广</strong></td>
                    </tr>
					<tr>
						<td height="30" align="left" class="lan"><strong>代理推广网址：http://<?= $_SERVER['SERVER_NAME']?>/?f=<?=$_SESSION["username"]?></strong></td>
					</tr>
					<!--tr>
						<td height="30" align="left" class="lan"><strong>代理推广网址②：http://<?=$_SESSION["username"].".".str_replace("www.","",$conf_www);?></strong></td>
					</tr-->
					<tr height="30">
						<td align="left">备注说明：</td>
					</tr>
					<tr height="30">
						<td align="left">1、代理申请成功后，请使用以上推广网址进行推广；</td>
					</tr>
					<tr height="30">
						<td align="left">2、通过推广网址注册来的会员将会成为您的下线会员。</td>
					</tr>
				</table>
			</div>
<script type="text/javascript" language="javascript" src="../js/left_mouse.js"></script>
</body>
</html>