<?php
include_once("../common/login_check.php");
check_quanxian("xtgl");

if($_GET['action'] == 'save'){
	$str	=	rtrim($_POST['dq'],',');
	if($str){
		$dq	=	array();
		$dq	=	explode(',',$str);
		include('../../cache/dqxz.php');
		
		$i		=	0;
		$str	=	"<?php\r\n";
		$str	.=	"unset(\$dqxz);\r\n";
		$str	.=	"\$dqxz=array();\r\n";
		foreach($dqxz as $k=>$v){
			$str	.=	"\$dqxz[".$i++."]='".$v."';\r\n";
		}
		foreach($dq as $k=>$v){
			$str	.=	"\$dqxz[".$i++."]='".$v."';\r\n";
		}
		
		
		if(!write_file("../../cache/dqxz.php",$str.'?>')){ //写入缓存失败
			message("缓存文件写入失败！请先设/cache/dqxz.php 文件权限为：0777");
		}
	}
}
if($_GET['action'] == 'del'){
	include('../../cache/dqxz.php');
	unset($dqxz[$_GET['id']]);
		
	$i		=	0;
	$str	=	"<?php\r\n";
	$str	.=	"unset(\$dqxz);\r\n";
	$str	.=	"\$dqxz=array();\r\n";
	foreach($dqxz as $k=>$v){
		$str	.=	"\$dqxz[".$i++."]='".$v."';\r\n";
	}
	
	
	if(!write_file("../../cache/dqxz.php",$str.'?>')){ //写入缓存失败
		message("缓存文件写入失败！请先设/cache/dqxz.php 文件权限为：0777");
	}
}
include('../../cache/dqxz.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>讨论组列表</title>
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
</STYLE>
</head>
<script>
function check(){
	var dq = document.getElementById("dq").value;
	if(dq.length < 1){
		alert("请您输入要限制的地区！");
		return false;
	}
	return true;
}
</script>
<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font style="float:left">&nbsp;<span class="STYLE2">地区限制</span></font><font style="float:right">&nbsp;&nbsp;</font></td>
  </tr>
</table>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
	<tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="67%" height="20"><strong>被限制的地区名称</strong></td>
    </tr>
  <tr align="center">
    <td align="left" ><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#666666">
<?php
$i	=	0;
foreach($dqxz as $k=>$v){
	if($i%3 == 0) echo '<tr>';
	$i++;
?>
        <td width="33%" onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;"><div style="float:left;"><?=$v?></div><div style="float:right; padding-right:10px;"><a href="dqxz.php?action=del&id=<?=$k?>" onclick="return confirm('确定解除地区 <?=$v?> 限制吗？')">解除</a></div></td>
<?php
	if($i%3 == 0) echo '</tr>';
}
while($i%3 != 0){
?>
		<td width="33%" onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">&nbsp;</td>
<?php
	$i++;
	if($i%3 == 0) echo '</tr>';
}
?>
    </table></td>
  </tr>
</table>
<br/>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font style="float:left">&nbsp;<span class="STYLE2">添加限制地区</span></font><font style="float:right">&nbsp;&nbsp;</font></td>
  </tr>
</table>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
<form id="form1" name="form1" method="post" action="dqxz.php?action=save" onsubmit="return check();">
  <tr align="center">
    <td width="13%" align="right" >地区名称：</td>
    <td width="87%" align="left" ><textarea name="dq" cols="80" rows="5" id="dq"></textarea>
    多个地区用 , 区分开 </td>
  </tr>
  <tr align="center">
    <td colspan="2" align="left" >&nbsp;</td>
  </tr>
  <tr align="center">
    <td align="right" >操作：</td>
    <td align="left" ><label>
      <input type="submit" name="Submit" value="提交" />
    </label></td>
  </tr>
</form>
</table>
</body>
</html>