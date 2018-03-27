<?php
include_once("../common/login_check.php"); 
check_quanxian("xtgl");

$website=	array();
$sum	=	0;
$s_date	=	$e_date	=	date('Y-m-d');
if($_GET['s_date']) $s_date	=	$_GET['s_date'];
if($_GET['e_date']) $e_date	=	$_GET['e_date'];
$s_date	=	$s_date.' 00:00:00';
$e_date	=	date("Y-m-d H:i:s",strtotime("$e_date +1 day")-1);
$sql	=	"select website from ip_la where today>='$s_date' and today<='$e_date' order by website asc";

$query	=	$mysqlio->query($sql);
while($row = $query->fetch_array()){
	$website[$row['website']]++;
	$sum++;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登陆IP列表页面</title>
</head>

<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
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
<script language="javascript" src="../../js/jquery.js"></script>
<script>
function check(){
	if($('#s_date').val().length <1){
		alert('请输入您要查询的开始日期');
		return false;
	}
	if($('#e_date').val().length <1){
		alert('请输入您要查询的结束日期');
		return false;
	}
	return true;
}
</script>
<body>
<script language="JavaScript" src="../../js/calendar.js"></script>
<form id="form1" name="form1" method="get" action="fwjl.php" onsubmit="return check();">
<table width="100%" border="0">
  <tr>
    <td width="17%">请您输入要查询的IP地址：</td>
    <td width="83%"><textarea name="ip" cols="80" rows="3" id="ip"><?=@$_GET['ip']?></textarea>
      多个IP可以用 , 隔开</td>
  </tr>
  <tr>
    <td>请选择日期范围：</td>
    <td><input name="s_date" type="text" id="s_date" onclick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" value="<?=date("Y-m-d",strtotime("$s_date"))?>" readonly="readonly" />
~
  <input name="e_date" type="text" id="e_date" onclick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" value="<?=date("Y-m-d",strtotime("$e_date"))?>" readonly="readonly" /> 
  &nbsp;包含当日&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;访问网站：
  <label>
  <select name="type" id="type">
    <option value="">所有网站</option>
<?php
foreach($website as $k=>$v){
?>
    <option value="<?=$k?>" <?=$_GET['type']==$k ? 'selected' : ''?>><?=$k?></option>
<?php
}
?>
  </select>
  </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="查询" /></td>
  </tr>
</table>
</form>
<br>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
    <td width="20%"><strong>IP地址</strong></td>
    <td width="5%"><strong>次数</strong></td>
    <td width="13%"><strong>访问日期</strong></td>
    <td width="10%"><strong>访问网站</strong></td>
    <td width="52%"><strong>浏览器</strong></td>
</tr>
<?php
	$ip		=	'';
	$un		=	'';
	$where	=	'';
	$arr_ip	=	explode(',',rtrim(trim($_GET["ip"]),','));
	foreach($arr_ip as $k=>$v){
		if($v != ''){
			$ip	.=	"'".$v."',";
		}
	}
	if($ip != ''){
		$ip 	=	rtrim($ip,',');
		$where	.=	" and ip in ($ip)";
	}
	if($_GET['type']){
		$where	.=	" and website='".$_GET['type']."'";
	}
	
	$sql	=	"SELECT * FROM ip_la where today>='$s_date' and today<='$e_date' $where order by id desc";
	$query	=	$mysqlio->query($sql);
	while($row = $query->fetch_array()){
?>
  <tr onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
    <td align="center"><a href="../hygl/login_ip.php?ip=<?=$row['ip']?>" target="_blank"><?=$row['ip']?></a><br/><?=$row['ip_address']?></td>
    <td align="center"><?=$row['his']?></td>
    <td align="center"><?=$row['today']?></td>
    <td align="center"><?=$row['website']?></td>
    <td align="center"><?=$row['browser']?></td>
  </tr>
<?php
}
?>
</table>
<br />
<br />
<br />
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F2F2F2">
<?php
$i	=	0;
foreach($website as $k=>$v){
	$color	=	getColor($i%4);
?>
  <tr>
    <td width="21%" align="right"><a href="fwjl.php?type=<?=$k?>&s_date=<?=date("Y-m-d",strtotime("$s_date"))?>&e_date=<?=date("Y-m-d",strtotime("$e_date"))?>"><?=$k?></a>&nbsp;&nbsp;</td>
    <td width="79%"><table width="500" border="1" cellpadding="0" cellspacing="0" bordercolor="<?=$color?>">
            <tr>
              <td bgcolor="#FFFFFF"><div style="background-color:<?=$color?>; width:<?=$v/$sum==0 ? 2 : $v/$sum*100?>%; color:#FFFFFF; float:left;"><?=$v?> IP</div><div style="float:left; color:<?=$color?>;"><?=sprintf("%.2f",$v/$sum*100).'%'?></div></td>
            </tr>
    </table></td>
  </tr>
<?php
	$i++;
}
?>
</table>
</body>
</html>