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
$odds=$_REQUEST['odds'];
if ($_REQUEST['save']=='add'){
	$mysql="insert into lottery_k_ssc set qihao='$qihao',kaipan='$kaipan',fengpan='$fengpan'";
	mysql_db_query($dbname,$mysql) or die ("第".$qihao."期添加失敗");		
}
if ($_POST['update']){
	$mysql="update lottery_odds set odds=".$odds." where id='$id'";
	mysql_db_query($dbname,$mysql) or die ("改失敗");		
}
$sql = "select * from lottery_odds where class1='ssl' order by id asc";
$result = mysql_db_query($dbname,$sql);
$cou=mysql_num_rows($result);

$resultn = mysql_db_query($dbname,$sql);
$nocount=mysql_num_rows($resultn);

$page=$_REQUEST['page'];
if ($page==''){
	$page=0;
}
$page_size=58;
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
          <td colspan="4" align="center" bgcolor="#FFFFFF"><a href="lottery_odds_3d.php">福彩3D</a> - <a href="lottery_odds_pl3.php">體彩排列3</a> - <a href="lottery_odds_ssl.php">上海時時樂</a> - <a href="lottery_odds_kl8.php">北京快樂8</a></td>
  </tr>
  <tr class="m_title">
    <td colspan="4" align="center">上海時時樂 賠率管理</td>
  </tr>
  <tr class="m_title">
    <td align="center">玩法分類</td>
    <td align="center">玩法內容</td>
    <td align="center">當前賠率</td>
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
  <tr><form name="FrmSubmit" method="post" action="?stype=<?=$stype?>"> 
    <td align="center" bgcolor="#FFFFFF"><?=$row['class2']?></td>
    <td align="center" bgcolor="#FFFFFF"><?=$row['class3']?></td>
    <td align="center" bgcolor="#FFFFFF"><input name="odds" type="text" id="odds" value="<?=$row['odds']?>" size="10"></td>
    <td align="center" bgcolor="#FFFFFF"><input class=za_button name="update" type="Submit" id="update" value="更新"><input name="id" type="hidden" id="id" value="<?=$row['id']?>"></td>
  </form></tr>
  <?
}
?>
  <tr>
    <td colspan="4" align="center" bgcolor="#FFFFFF">共計
      <?=$page_count?>
      頁 - 當前第 <?php echo $page+1;?> 頁 <a style="font-weight: normal; color:#000;" href="?uid=<?=$uid?>&qi=<?=$qi?>&username=<?=$username?>&stype=<?=$stype?>&ok=<?=$ok?>&page=<?=($page-1)?>">上一頁</a> | <a style="font-weight: normal; color:#000;" href="?uid=<?=$uid?>&qi=<?=$qi?>&username=<?=$username?>&stype=<?=$stype?>&ok=<?=$ok?>&page=<?=($page+1)?>">下一頁</a></td>
  </tr>
  <?
}
?>
</table>
</body>
</html>
