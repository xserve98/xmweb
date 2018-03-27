<?php
include_once("../common/login_check.php");
check_quanxian("glygl");
include_once("../../class/admin.php");

if(@$_GET["action"]=="save"){
	$quanxian_str	=	"  ".implode(',',$_POST["quanxian"]);
	$ip				=	trim($_POST["ip"]);
	$sql			=	"insert into sys_admin(login_name,login_pwd,quanxian,about,ip,address) values('".trim($_POST['login_name'])."','".md5(md5($_POST['login_pwd']))."','$quanxian_str','".trim($_POST['about'])."','$ip','".trim($_POST['address'])."')"; 
	$mysqlio->query($sql);
    admin::insert_log($_SESSION["adminid"],"添加了后台管理员 ".$_POST['login_name']); 
	message('添加成功','user.php');
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>设置注单为无效</TITLE>
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
.STYLE3 {color: #999999}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >管理员<span class="STYLE2">管理：新增管理员</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"></td>
  </tr>
</table>
<br>
 
<form action="<?=$_SERVER['PHP_SELF']?>?action=save" method="post"  name="form1">
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;">
  <tr>
    <td bgcolor="#F0FFFF">登陆名称</td>
    <td><input name="login_name" type="text" size="30"/></td>
  </tr>
  <tr>
    <td width="172" bgcolor="#F0FFFF">登陆密码</td>
    <td width="473"><input name="login_pwd" type="text" size="30"/></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">描述</td>
    <td><input name="about" type="text" id="about" size="30"></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">IP限制</td>
    <td><input name="ip" type="text" id="ip" size="30" maxlength="16"> 
    <span class="STYLE3">为空则任意IP都可以登陆</span></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">地区限制</td>
    <td><input name="address" type="text" id="address" size="30" maxlength="49"> 
    <span class="STYLE3">为空则任意地区都可以登陆</span></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">权限设置</td>
    <td><?
	 $temp_i=0;
     foreach($quanxian as $t)
	 {
		$temp_i++;
	 ?>
      <input type="checkbox" name="quanxian[]"   value="<?=$t["en"]?>"><?=$t["cn"]?>
   <?php
    if($temp_i%5==0) echo "<br />";
    } ?></td>
  </tr>
    <tr>
    <td bgcolor="#F0FFFF">操作</td>
    <td><input type="submit" value="提交"/> 
      &nbsp;   &nbsp;
      <input type="button" value="取消"  onClick="javascript:history.go(-1);"/></td>
  </tr>
</table>
</form>
</body>
</html>