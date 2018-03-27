<?php
include_once("../common/login_check.php");
check_quanxian("hygl");
include_once("../../include/mysqli.php");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>修改会员所属代理</TITLE>
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

<script language="javascript" src="../js/user_show.js"></script>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">用户管理：修改会员所属代理</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><br>
<?php
$sql	=	"select * from k_user where uid=".intval($_GET["id"])." limit 1";
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
?>
<form action="daili_update.php" method="post" name="form1" id="form1">
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;"  >
  <tr>
    <td bgcolor="#F0FFFF" width="200">用户名</td>
    <td><?=$rows["username"]?>
      <input name="hf_username" type="hidden" id="hf_username" value="<?=$rows["username"]?>"><input type="hidden" name="uid" id="uid" value="<?=$_GET["id"]?>"></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF" width="200">姓名</td>
    <td><?=$rows["pay_name"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">所属代理商</td>
    <td><label>
      <select name="top_uid" id="top_uid">
      <?php
      if ($rows["top_uid"]=='0'){
	  ?>
      <option value="0" selected>请选择代理商</option>
      <?php
	  }
	  ?>
<?php
$sql	=	"select uid,username,pay_name from k_user where is_daili=1 and is_stop=0 and username!='{$rows['username']}' order by uid asc";
$query	=	$mysqli->query($sql);
while($rs = $query->fetch_array()){
?>
        <option value="<?=$rs['uid']?>" <?=$rs['uid']==$rows["top_uid"] ? 'selected' : ''?>><?=$rs['username']?>===<?=$rs['pay_name']?></option>
<?php
}
?>
      </select>
    </label></td>
  </tr>
  <tr>
  	<td colspan="2" align="center"><input type="submit" value="确认提交"> 　 
  	  <input type="button" value="取 消" onClick="javascript:javascript:history.go(-1)"></td>
  </tr>
</table>
</form></td>
  </tr>
</table>
</body>
</html>