<?
include_once("../common/login_check.php");
check_quanxian("ssgl");
include_once("config.inc.php");
$id=$_REQUEST["id"];
$uid=$_REQUEST["uid"];
$langx=$_SESSION["langx"];
$stype=$_REQUEST["stype"];
$loginname=$_SESSION["loginname"];
$lv=$_REQUEST["lv"];
$xtype=$_REQUEST["xtype"];
$username=$_REQUEST["username"];
$riqi=date("Y-m-d",time());
$qi=$_REQUEST["qi"];
$ok=$_REQUEST["ok"];
if($qi==''){
$qi=$riqi;	
}
if($username==''){
$soname="username!=''";	
}else{
$soname="username='".$username."'";
}
if($ok==''){
$sook="bet_ok!=''";	
}else if($ok=='Y'){
$sook="bet_ok=1";
}else if($ok=='N'){
$sook="bet_ok=0";
}
$id=$_REQUEST['id'];
$qihao=$_REQUEST['qihao'];
$kaipan=$_REQUEST['kaipan'];
$fengpan=$_REQUEST['fengpan'];
$hm1=$_REQUEST['hm1'];
$hm2=$_REQUEST['hm2'];
$hm3=$_REQUEST['hm3'];
$hm4=$_REQUEST['hm4'];
$hm5=$_REQUEST['hm5'];
$hm6=$_REQUEST['hm6'];
$tm=$_REQUEST['tm'];

if ($_POST['update']){
	$mysql="update lottery_t_kl8 set qihao='$qihao',kaipan='$kaipan',fengpan='$fengpan' where id='$id'";
	mysql_db_query($dbname,$mysql) or die ("第".$qihao."期修改失敗");		
}

$sql = "select * from lottery_t_kl8 order by id asc";
$result = mysql_db_query($dbname,$sql);
$cou=mysql_num_rows($result);

$resultn = mysql_db_query($dbname,$sql);
$nocount=mysql_num_rows($resultn);

$page=$_REQUEST['page'];
if ($page==''){
	$page=0;
}
$page_size=179;
$page_count=ceil($cou/$page_size);
$offset=$page*$page_size;
$mysql=$sql."  limit $offset,$page_size;";
$result = mysql_db_query($dbname, $mysql);
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
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
.m_title{background:url(../images/06.gif);height:24px;}
.m_title td{font-weight:800;}
</STYLE>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" vlink="#0000FF" alink="#0000FF">
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
<tr>
          <td colspan="4" align="center" bgcolor="#FFFFFF"><a href="lottery_auto_3d.php">福彩3D</a> - <a href="lottery_auto_pl3.php">體彩排列3</a> - <a href="lottery_auto_ssl.php">上海時時樂</a> - <a href="lottery_auto_kl8.php">北京快樂8</a></td>
  </tr>
  <tr class="m_title">
    <td colspan="4" align="center">北京快樂8開盤時間管理【<a href="lottery_auto_kl8.php"><font color="#FF0000">點擊進入北京快樂8開獎管理</font></a>】</td>
  </tr>
  <tr class="m_title">
    <td align="center">北京快樂8期號</td>
    <td align="center">開盤時間</td>
    <td align="center">封盤時間</td>
    <td align="center">操作</td>
  </tr>
  <?
if($cou==0){
?>
  <?
}else{
?>
  <?
while ($row = mysql_fetch_array($result)){
?>
  <tr><form name="FrmSubmit" method="post" action=""> 
    <td align="center" bgcolor="#FFFFFF"><input name="qihao" type="text" id="qihao" value="<?=$row['qihao']?>" maxlength=15 size="15"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="kaipan" type="text" id="kaipan" value="<?=$row['kaipan']?>" size="15"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="fengpan" type="text" id="fengpan" value="<?=$row['fengpan']?>" size="15"></td>
    <td align="center" bgcolor="#FFFFFF"><input class=za_button name="update" type="Submit" id="update" value="更新"><input name="id" type="hidden" id="id" value="<?=$row['id']?>"></td>
  </form></tr>
  <?
}
?>
  <?
}
?>
</table>
</body>
</html>
