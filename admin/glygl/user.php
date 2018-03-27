<?php
include_once("../common/login_check.php");
///echo json_encode(check_quanxian("glygl"));
//echo json_encode($_SESSION["quanxian"]);
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户列表</TITLE>
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
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td{font:13px/120% "宋体";padding:3px;}
a{

	color:#F37605;

	text-decoration: none;

}
.t-title{background:url(/super/images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">管理员管理：系统管理员管理</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><A href="adduser.php" >新增用户</A></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color:#CCCCCC;" align="center">
        <td width="176" height="20" align="center"><strong>IP限制/登陆名/地区限制</strong></td>
        <td width="56"><strong>用户名</strong></td>
        <td width="357"><strong>权限描述</strong></td>
        <td width="126"><strong>在线状态</strong></td>
        <td width="236"><strong>登陆IP</strong></td>
        <td width="156"><strong>操作</strong></td>
      </tr>
<?php
include_once("../../class/admin.php");

$sql		=	"select * from sys_admin order by uid desc";
$query		=	$mysqlio->query($sql);
while($rows = $query->fetch_array()){
?>
	        <tr onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td height="20" align="center"  ><?=$rows["ip"] ? $rows["ip"] : '<span style="color:#999999">无限制</span>'?><br /><a href="login_ip.php?username=<?=$rows["login_name"]?>"><?=$rows["login_name"]?></a><br /><?=$rows["address"] ? $rows["address"] : '<span style="color:#999999">无限制</span>'?></td>
	          <td align="center"><?=$rows["about"]?></td>
              <td>
<?php
	$temp_i=0;
	foreach($quanxian as $t){
		$temp_i++;
		if(strpos($rows["quanxian"],$t['en'])) echo $t["cn"].",";
        if($temp_i%5==0) echo "<br />";
	}
	 
?>            </td>
	          <td align="center"><?=$rows["is_login"]==1 ? '<span style="color:#FF00FF">在线</span>' : '<span style="color:#999999">离线</span>'?><br /><span style="color:#999999"><?=$rows["www"]?></span></td>
	          <td  align="center"><?=$rows["login_ip"]?><br /><?=$rows["login_address"]?></td>
	          <td align="center"><A href="user_edit.php?id=<?=$rows["uid"]?>">编辑</a> | <A onClick="javascript:return confirm('确定踢线');" href="userdel.php?id=<?=$rows["uid"]?>&amp;login_name=<?=$rows["login_name"]?>">踢线</a> | <A href="set_pwd.php?id=<?=$rows["uid"]?>">设置密码</a></td>
          </tr>    	
<?php
}
?>
    </table>
    </td>
  </tr>
</table>
</body>
</html>