<?php
include_once("../common/login_check.php");
check_quanxian("glygl");


if(@$_GET["action"]=="save"){
	$uid	=	intval($_GET["uid"]);
    $sql	=	"update sys_admin set login_pwd='".md5(md5($_POST["password"]))."' where uid=$uid";
	$mysqlio->query($sql);
	include_once("../../class/admin.php");
    admin::insert_log($_SESSION["adminid"],"修改了管理员ID为".$uid."的密码"); 
	message('操作成功','user.php');
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>设置密码</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css"/>
<script language="javascript">
function check_sub(){
	var p1 = document.getElementById("password").value;
	var p2 = document.getElementById("password2").value;
	if(p1.length < 1){
 		alert('请输入密码');
		document.getElementById("password").focus();
		return false;
	}
 
	if(p1 != p2){
 		alert("两次密码输入不一致");
		document.getElementById("password2").select();
 		return false;
	} 
	
	return true;
}
 </script>
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE1 {font-size: 10px}
.STYLE2 {font-size: 12px}
body {	margin: 0px;}
td{font:13px/120% "宋体";padding:3px;}
a{color:#FFA93E;}
.t-title{background:url(/super/images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<?php
$sql	=	"select uid,login_name from sys_admin where uid=".intval($_GET["id"])." limit 1";
$query	=	$mysqlio->query($sql);
$rows	=	$query->fetch_array();
?>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">管理员管理：设置密码</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><form onSubmit="return check_sub();" action="<?=$_SERVER['PHP_SELF']?>?action=save&uid=<?=$rows["uid"]?>" method="post" name="form1">
      <p>&nbsp;</p>
      <table width="661" border="1" align="center" bordercolor="#333333"  style="border-collapse:collapse;color:#000;">
  <tr>
    <td bgcolor="#F0FFFF">管理员</td>
    <td><?=$rows["login_name"]?></td>
  </tr>
  <tr>
    <td width="172" bgcolor="#F0FFFF">密码</td>
    <td width="473"><input id="password" type="password" name="password" value=""/></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">确认密码</td>
    <td><input id="password2" type="password"  name="password2" value=""/></td>
  </tr>
    <tr>
    <td bgcolor="#F0FFFF">操作</td>
    <td><input name="s" type="submit" id="s" value="提交"/></td>
  </tr>
</table>
</form></td>
  </tr>
</table>
</body>
</html>