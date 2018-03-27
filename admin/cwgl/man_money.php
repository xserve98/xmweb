<?php
include_once("../common/login_check.php"); 
check_quanxian("jkkk");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>手工结算</TITLE>
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
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">手工结算：对用户财务进行手工结算</span></font></td>
  </tr>
  <tr>
  <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">用户名：<input name="username" type="text" size="20" maxlength="20" value="<?=$_GET['username']?>"/>&nbsp;&nbsp;<input name="find" type="submit" id="find" value="查找"/></td>
  </form>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="20%" height="20" align="center"><strong>用户名</strong></td>
        <td width="20%"><strong>账户余额</strong></td>
        <td colspan="2"><strong>操作</strong></td>
        </tr>
<?php
if(isset($_GET["username"])){ 
	include_once("../../include/mysqli.php");
	$sql	=	"select uid,username,money from k_user where username='".$_GET['username']."' or  ag_zr_username='".$_GET['username']."' limit 1";
	$query	=	$mysqli->query($sql);
	if($rows = $query->fetch_array()){
?>
	        <tr align="center">
	          <td height="20" ><a href="../hygl/user_show.php?id=<?=$rows["uid"]?>"><?=$rows["username"]?></a></td>
              <td><font color="#FF0000"><?=sprintf("%.2f",$rows["money"])?></font></td>
	          <td width="31%" align="center"><a href="set_money.php?uid=<?=$rows["uid"]?>&amp;type=add">加钱</a></td>
	          <td width="29%" align="center"><a href="set_money.php?uid=<?=$rows["uid"]?>&amp;type=min">扣钱</a></td>
          </tr>   	
<?php
	}
}
?>
    </table>
    </td>
  </tr>
</table>
</body>
</html>