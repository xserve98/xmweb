<?php
session_start();
include_once("../common/login_check.php"); 
check_quanxian("xxgl");
include_once("../../include/mysqli.php");

$sql	=	"select k.*,u.username from k_user_msg k,k_user u where k.uid=u.uid and msg_id=".intval($_GET['id']);
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>查看短消息</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
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
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;查看短消息</font></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
	        <tr align="center">
	          <td width="14%" align="right"><strong>标题：</strong></td>
              <td width="86%" align="left"><?=$rows["msg_title"]?></td>
          </tr>
	        <tr align="center">
	          <td align="right"><strong>添加时间：</strong></td>
	          <td align="left"><?=$rows['msg_time']?></td>
        </tr>
	        <tr align="center">
	          <td align="right"><strong>接收人：</strong></td>
	          <td align="left"><a href="../hygl/user_show.php?id=<?=$rows["uid"]?>"><?=$rows['username']?></a></td>
        </tr>
	        <tr align="center">
	          <td align="right"><strong>发送人：</strong></td>
	          <td align="left"><?=$rows['msg_from']?></td>
        </tr>
	        <tr align="center">
	          <td align="right"><strong>内容：</strong></td>
	          <td align="left"><?=str_replace("\r\n","<br>",$rows["msg_info"])?></td>
        </tr>
	        <tr align="center">
	          <td>&nbsp;</td>
	          <td align="left"><a href="#" onClick="javascript:history.back();">返回上一页</a></td>
        </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>