<?php
include_once("../common/login_check.php");
check_quanxian("glygl");
include_once("../../class/admin.php");

if(@$_GET["action"]=="save"){
	$quanxian_str	=	" ".implode(',',$_POST["quanxian"]);
	$ip				=	trim(@$_POST["ip"]);
	$sql			=	"update sys_admin set quanxian='$quanxian_str',about='".trim($_POST['about'])."',ip='$ip',address='".trim($_POST['address'])."' where uid=".$_GET["id"]; 
	$mysqlio->query($sql);
	admin::insert_log($_SESSION["adminid"],"编辑了管理员的信息,管理员ID为".$_GET["id"]);
	message('修改成功','user.php');
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>设置注单为无效</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
<script language="javascript" src="../Script/Admin.js"></script>
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
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
    <td height="24" nowrap background="../images/06.gif"><font >管理员<span class="STYLE2">管理：编辑管理员</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"></td>
  </tr>
</table>
<br>
<?php
$sql	=	"select * from sys_admin where uid=".$_GET["id"]." limit 1";
$query	=	$mysqlio->query($sql);
$rows	=	$query->fetch_array();
?>
<form action="<?=$_SERVER['PHP_SELF']?>?action=save&id=<?=$rows["uid"]?>" method="post"  name="form1">
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;">
  <tr>
    <td width="172" bgcolor="#F0FFFF">登陆名称</td>
    <td width="473"><?=$rows["login_name"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">权限设置</td>
    <td>
     <?
	 $temp_i=0;
     foreach($quanxian as $t)
	 {
		$temp_i++;
	 ?>
      <input type="checkbox" name="quanxian[]"  <? if(strpos($rows["quanxian"],$t["en"])){?> checked  <? }?>  value="<?=$t["en"]?>"> <?=$t["cn"]?>
   <?php
    if($temp_i%5==0) echo "<br />";
   } ?> </td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">描述</td>
    <td><label>
      <input name="about" type="text" id="about" value="<?=$rows["about"]?>" size="30">
    </label></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">IP限制</td>
    <td><input name="ip" type="text" id="ip" value="<?=$rows["ip"]?>" size="30" maxlength="20">
      <span class="STYLE3">为空则任意IP都可以登陆</span></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">地区限制</td>
    <td><input name="address" type="text" id="address" value="<?=$rows["address"]?>" size="30" maxlength="49">
      <span class="STYLE3">为空则任意地区都可以登陆</span></td>
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