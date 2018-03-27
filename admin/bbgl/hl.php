<?php
include_once("../common/login_check.php");
check_quanxian("bbgl");

if($_GET['action'] == 'save'){
	$uid	=	rtrim($_POST['hlhy'],',');
	if($uid){
		include_once("../../include/mysqli.php");
		
		$str	=	"<?php\r\n";
		$str	.=	"unset(\$hlhy,\$hl_uid);\r\n";
		$str	.=	"\$hl_uid='$uid';\r\n";
		$str	.=	"\$hlhy=array();\r\n";
		$sql	=	"select username,uid from k_user where uid in($uid)";
		  
		$result	=	$mysqli->query($sql);
		$sum		=	$mysqli->affected_rows; //总页数
		//echo $sum;
		//echo $sql;
		while($rows	= $result->fetch_array()){
			$str	.=	"\$hlhy[".$rows['uid']."]='".$rows['username']."';\r\n";
					}
					//echo json_encode($str);
					//exit;

		
		if(!write_file("../../cache/hlhy.php",$str.'?>')){ //写入缓存失败
			message("缓存文件写入失败！请先设/cache/hlhy.php 文件权限为：0777");
		}
	}
}
include_once('../../cache/hlhy.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>报表忽略</title>
<link rel="stylesheet" href="../Images/CssAdmin.css">
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
</head>
<script>
function check(){
	var hlhy = document.getElementById("hlhy").value;
	if(hlhy.length < 1){
		alert("请您输入要忽略的会员编号！");
		return false;
	}
	return true;
}
</script>
<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font style="float:left">&nbsp;<span class="STYLE2">忽略会员</span></font><font style="float:right">&nbsp;&nbsp;</font></td>
  </tr>
</table>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
	<tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="67%" height="20" align="left"><strong>被忽略的会员名称</strong></td>
    </tr>
  <tr align="center">
    <td align="left" ><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#666666">
<?php
$i	=	0;
foreach($hlhy as $k=>$v){
	if($i%4 == 0) echo '<tr>';
	$i++;
?>
        <td width="25%" align="center" style="background-color:#FFFFFF;" onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'"><a href="../hygl/user_show.php?id=<?=$k?>"><?=$v?></a></td>
<?php
	if($i%4 == 0) echo '</tr>';
}
while($i%4 != 0){
?>
		<td width="25%" onMouseOver="this.style.backgroundColor='#C0E0F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">&nbsp;</td>
<?php
	$i++;
	if($i%4 == 0) echo '</tr>';
}
?>
    </table></td>
  </tr>
</table>
<br/>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font style="float:left">&nbsp;<span class="STYLE2">添加要忽略的会员</span></font><font style="float:right">&nbsp;&nbsp;</font></td>
  </tr>
</table>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
<form id="form1" name="form1" method="post" action="hl.php?action=save" onsubmit="return check();">
  <tr align="center">
    <td width="13%" align="right" >会员编号：</td>
    <td width="87%" align="left" ><textarea name="hlhy" cols="80" rows="5" id="hlhy"><?=$hl_uid?></textarea>
    多个会员编号用 , 区分开 </td>
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
<p>忽略会员此功能用于查询报表时，忽略内部账户的所有记录</p>
</body>
</html>