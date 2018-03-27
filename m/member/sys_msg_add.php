<?php
session_start();
//ini_set('display_errors','yes');
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);

//设置取款密码
if($_GET["action"]=="pass"){
	$title=trim($_POST["title"]);
	$cont=trim($_POST["cont"]);
	$vlcodes=$_POST["yzm"];
	
	if($vlcodes!=$_SESSION["randcode"]){   
		message("验证码错误，请重新输入");
	}
	$_SESSION["randcode"]=rand(10000,99999); //更换一下验证码
    if($title==""){
		message("请输入信息标题");
	}
	if(strlen($cont)<6){
		message("请输入信息内容，不能少于6个字");
	}
	
	if(user::msg_add2($_SESSION["uid"],$_SESSION['username'],$title,$cont)){
		message('您的信息已经提交，我们的客户人员会尽快回复您','sys_msg_add.php');
	}else{
		message('信息提交失败，请检查您的输入','sys_msg_add.php');
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link type="text/css" rel="stylesheet" href="images/member.css"/>
    <script type="text/javascript" src="../skin/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="images/member.js"></script>
	<!--[if IE 6]><script type="text/javascript" src="images/DD_belatedPNG.js"></script><![endif]-->
</head>
<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px #FFF solid;">
	<?php 
	include_once("mainmenu.php");
	?>
	<tr>
		<td colspan="2" align="center" valign="middle">
			<?php 
			include_once("usermenu.php");
			?>
			<div class="content">
				<table width="98%" border="0" cellspacing="0" cellpadding="5">
					<form action="?action=pass" method="post" name="form1">
					<tr>
						<th colspan="3" align="left" style="color:#F2310B">请详细描述您要咨询的问题,我们的客服人员会尽快的回复您,谢谢!<br>
--------------------------------------------------------------------------------------------------</th>
					</tr>
					<tr>
						<td width="20%" align="right">信息标题：</td>
						<td width="80%" align="left" class="hong"><input name="title" type="text" class="input_250" id="title" size="30"/></td>
					</tr>
					<tr>
						<td align="right">信息内容：</td>
						<td align="left" class="hong"><textarea name="cont" cols="50" rows="5" id="cont"></textarea></td>
					</tr>
					<tr>
						<td align="right">验证码：</td>
						<td align="left" class="hong"><input name="yzm" type="text" class="input_80" id="yzm" maxlength="20"/> <img src="/yzm.php" alt="点击更换" name="checkNum_img" id="checkNum_img" style="cursor:pointer;position:relative;top:1px;" onclick="next_checkNum_img()" /></td>
					</tr>
					<tr>
						<td align="left">&nbsp;</td>
						<td align="left"><input name="submit" type="submit" id="submit" class="submit_108" value="确认提交"/> </td>
					</tr>
					</form>
					<form action="?action=moneypass" method="post" name="form1" onsubmit="return check_submit_money();"  >
				    </form>
				</table>
			</div>
		</td>
	</tr>
</table>
</body>
</html>