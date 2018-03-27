<?php
include_once("../common/login_check.php");
check_quanxian("hygl");

if($_GET['action'] == 'save'){
	$uid	=	rtrim($_POST['jkhy'],',');
	if($uid){
		include_once("../../include/mysqli.php");
		
		$str	=	"<?php\r\n";
		$str	.=	"unset(\$jkhy,\$jk_uid);\r\n";
		$str	.=	"\$jk_uid='$uid';\r\n";
		$str	.=	"\$jkhy=array();\r\n";
		$sql	=	"select username,uid from k_user where uid in($uid)";
		$result	=	$mysqli->query($sql);
		while($rows	= $result->fetch_array()){
			$str	.=	"\$jkhy[".$rows['uid']."]='".$rows['username']."';\r\n";
		}
		
		if(!write_file("../../cache/jkhy.php",$str.'?>')){ //写入缓存失败
			message("缓存文件写入失败！请先设/jkhy.php 文件权限为：0777");
		}
        message("设置成功!");
	}
}
include_once('../../cache/jkhy.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>监控会员</title>
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE2 {
	font-size: 12px;
	font-weight: bold;
}
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
<script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../js/jkhy.js"></script>
</head>
<body>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
	<tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="67%" height="20" align="left"><strong>被监控的会员交易记录&nbsp;&nbsp;<span id="num"></span>&nbsp;&nbsp;(5分钟内体育赛事交易记录)</strong>
          <input name="ds" type="hidden" id="ds" />
          <input name="cg" type="hidden" id="cg" />
          <input name="uid" type="hidden" id="uid" value="<?=$jk_uid?>" />
        </td>
    </tr>
  <tr align="center">
    <td align="left" ><div id="div_ds">&nbsp;</div></td>
  </tr>
</table>
<br />
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
	<tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="67%" height="20" align="left"><strong>被监控的会员名称</strong></td>
    </tr>
  <tr align="center">
    <td align="left" >&nbsp;<div id="div_zx">&nbsp;</div></td>
  </tr>
</table>
<br/>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font style="float:left">&nbsp;<span class="STYLE2">添加要监控的会员</span></font><font style="float:right">&nbsp;&nbsp;</font></td>
  </tr>
</table>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
<form id="form1" name="form1" method="post" action="jkhy.php?action=save" onsubmit="return check();">
  <tr align="center">
    <td width="13%" align="right" >会员编号：</td>
    <td width="87%" align="left" ><textarea name="jkhy" cols="80" rows="3" id="jkhy"><?=$jk_uid?></textarea>
    多个会员编号用 , 区分开 </td>
  </tr>
  <tr align="center">
    <td colspan="2" align="left" ><div id="mp3">&nbsp;</div></td>
  </tr>
  <tr align="center">
    <td align="right" >操作：</td>
    <td align="left" ><label>
      <input type="submit" name="Submit" value="保存" />
    </label></td>
  </tr>
</form>
</table>
</body>
</html>