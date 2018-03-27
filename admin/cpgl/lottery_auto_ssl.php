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
if ($_REQUEST['save']=='add'){
	$mysql="insert into lottery_k_ssl set qihao='$qihao',kaipan='$kaipan',fengpan='$fengpan'";
	mysql_db_query($dbname,$mysql) or die ("第".$qihao."期添加失敗");		
}
if ($_POST['update']){
	$mysql="update lottery_k_ssl set qihao='$qihao',hm1=$hm1,hm2=$hm2,hm3=$hm3 where id='$id'";
	mysql_db_query($dbname,$mysql) or die ("第".$qihao."期修改失敗");		
}
if ($_POST['delete']){
	$mysql="delete from lottery_k_ssl where id='$id'";
	mysql_db_query($dbname,$mysql);
}

$sql = "select * from lottery_k_ssl order by id desc";
$result = mysql_db_query($dbname,$sql);
$cou=mysql_num_rows($result);

$resultn = mysql_db_query($dbname,$sql);
$nocount=mysql_num_rows($resultn);

$page=$_REQUEST['page'];
if ($page==''){
	$page=0;
}
$page_size=50;
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
          <td colspan="6" align="center" bgcolor="#FFFFFF"><a href="lottery_auto_3d.php">福彩3D</a> - <a href="lottery_auto_pl3.php">体彩排列三</a> - <a href="lottery_auto_ssl.php">上海時時樂</a> - <a href="lottery_auto_kl8.php">北京快樂8</a></td>
  </tr>
  <tr class="m_title">
    <td colspan="6" align="center">上海時時樂開獎管理【<a href="lottery_time_ssl.php"><font color="#FF0000">點擊進入上海時時樂開盤時間管理</font></a>】</td>
  </tr>
  <tr class="m_title">
    <td align="center">上海時時樂期號</td>
    <td align="center">百位</td>
    <td align="center">十位</td>
    <td align="center">個位</td>
    <td align="center">操作</td>
    <td align="center">開獎</td>
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
  <tr><form name="FrmSubmit" method="post" action="?"> 
    <td align="center" bgcolor="#FFFFFF"><input name="qihao" type="text" id="qihao" value="<?=$row['qihao']?>" maxlength=15 size="15"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm1" type="text" id="hm1" value="<?=$row['hm1']?>" maxlength=1 size="2"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm2" type="text" id="hm2" value="<?=$row['hm2']?>" maxlength=1 size="2"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm3" type="text" id="hm3" value="<?=$row['hm3']?>" maxlength=1 size="2"></td>
    <td align="center" bgcolor="#FFFFFF"><input class=za_button name="update" type="Submit" id="update" value="更新"> <input class=za_button name="delete" type="Submit" id="delete" value="删除"><input name="id" type="hidden" id="id" value="<?=$row['id']?>"></td>
    <td align="center" bgcolor="#FFFFFF"><? if($row['ok']==0){?><a href="auto/ssl.php?qihao=<?=$row['qihao']?>"><font color="#FF0000">點擊開獎</font></a>
      <? }else{?><font color="#0000FF">已開獎</font><? }?></td>
  </form></tr>
  <?
}
?>
  <tr>
    <td colspan="6" align="center" bgcolor="#FFFFFF">共計
      <?=$page_count?>
      頁 - 當前第 <?php echo $page+1;?> 頁 <a style="font-weight: normal; color:#000;" href="?qi=<?=$qi?>&username=<?=$username?>&stype=<?=$stype?>&ok=<?=$ok?>&page=<?=($page-1)?>">上一頁</a> | <a style="font-weight: normal; color:#000;" href="?qi=<?=$qi?>&username=<?=$username?>&stype=<?=$stype?>&ok=<?=$ok?>&page=<?=($page+1)?>">下一頁</a></td>
  </tr>
  <?
}
?>
</table>
</body>
</html>
