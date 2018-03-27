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
$hm7=$_REQUEST['hm7'];
$hm8=$_REQUEST['hm8'];
$hm9=$_REQUEST['hm9'];
$hm10=$_REQUEST['hm10'];
$hm11=$_REQUEST['hm11'];
$hm12=$_REQUEST['hm12'];
$hm13=$_REQUEST['hm13'];
$hm14=$_REQUEST['hm14'];
$hm15=$_REQUEST['hm15'];
$hm16=$_REQUEST['hm16'];
$hm17=$_REQUEST['hm17'];
$hm18=$_REQUEST['hm18'];
$hm19=$_REQUEST['hm19'];
$hm20=$_REQUEST['hm20'];
$tm=$_REQUEST['tm'];
if ($_POST['update']){
	$mysql="update lottery_k_kl8 set qihao=$qihao,kaipan='$kaipan',fengpan='$fengpan',hm1=$hm1,hm2=$hm2,hm3=$hm3,hm4=$hm4,hm5=$hm5,hm6=$hm6,hm7=$hm7,hm8=$hm8,hm9=$hm9,hm10=$hm10,hm11=$hm11,hm12=$hm12,hm13=$hm13,hm14=$hm14,hm15=$hm15,hm16=$hm16,hm17=$hm17,hm18=$hm18,hm19=$hm19,hm20=$hm20 where id='$id'";
	mysql_db_query($dbname,$mysql) or die ("北京快樂8第".$qihao."期修改失敗");		
}
if ($_POST['delete']){
	$mysql="delete from lottery_k_kl8 where id='$id'";
	mysql_db_query($dbname,$mysql);
}

$sql = "select * from lottery_k_kl8 order by id desc";
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
          <td colspan="3" align="center" bgcolor="#FFFFFF"><a href="lottery_auto_3d.php">福彩3D</a> - <a href="lottery_auto_pl3.php">体彩排列三</a> - <a href="lottery_auto_ssl.php">上海時時樂</a> - <a href="lottery_auto_kl8.php">北京快樂8</a></td>
        </tr>
        <!--<tr class="m_title">
          <td colspan="3" align="center">北京快樂8期數添加</td>
        </tr>
        <tr class="m_title">
          <td width="100" align="center">&nbsp;</td>
          <td align="center">前一天最後一期</td>
          <td align="center">操作</td>
        </tr>
        <tr>
          <td align="right" bgcolor="#FFFFFF">填寫前一天最後一期期號：</td>
          <form name="AddSubmit" method="post" action="lottery_add_kl8.php?save=add">
          <td align="left" bgcolor="#FFFFFF"><input name="qihao" type="text" id="qihao" maxlength=7 size="15">
            * <a href="http://baidu.lecai.com/lottery/draw/view/543/" target="_blank"><font color="#0000FF">點擊這裡進入快樂8官網查看前一天最後一期期號</font></a></td>
          <td align="center" bgcolor="#FFFFFF"><input class=za_button name="add" type="Submit" id="add" value="確認添加當天所有期數開盤"></td>
        </form></tr>
        <tr>
          <td colspan="3" align="center" bgcolor="#FFFFFF"><font color="#FF0000">說明：如果添加今天的179期所有開盤的期數,需要填寫昨天開獎的最後一期期號!</font></td>
        </tr>-->
    </table>
<br>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
  <tr class="m_title">
    <td colspan="25" align="center">北京快樂8開獎管理【<a href="lottery_time_kl8.php"><font color="#FF0000">點擊進入北京快樂8開盤時間管理</font></a>】</td>
  </tr>
  <tr class="m_title">
    <td align="center">期號</td>
    <td align="center">開盤時間</td>
    <td align="center">封盤時間</td>
    <td align="center">1</td>
    <td align="center">2</td>
    <td align="center">3</td>
    <td align="center">4</td>
    <td align="center">5</td>
    <td align="center">6</td>
    <td align="center">7</td>
    <td align="center">8</td>
    <td align="center">9</td>
    <td align="center">10</td>
    <td align="center">11</td>
    <td align="center">12</td>
    <td align="center">13</td>
    <td align="center">14</td>
    <td align="center">15</td>
    <td align="center">16</td>
    <td align="center">17</td>
    <td align="center">18</td>
    <td align="center">19</td>
    <td align="center">20</td>
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
    <td align="center" bgcolor="#FFFFFF"><input name="qihao" type="text" id="qihao" value="<?=$row['qihao']?>" maxlength=6 size="6"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="kaipan" type="text" id="kaipan" value="<?=$row['kaipan']?>" size="15"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="fengpan" type="text" id="fengpan" value="<?=$row['fengpan']?>" size="15"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm1" type="text" id="hm1" value="<?=$row['hm1']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm2" type="text" id="hm2" value="<?=$row['hm2']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm3" type="text" id="hm3" value="<?=$row['hm3']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm4" type="text" id="hm4" value="<?=$row['hm4']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm5" type="text" id="hm5" value="<?=$row['hm5']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm6" type="text" id="hm6" value="<?=$row['hm6']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm7" type="text" id="hm7" value="<?=$row['hm7']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm8" type="text" id="hm8" value="<?=$row['hm8']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm9" type="text" id="hm9" value="<?=$row['hm9']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm10" type="text" id="hm10" value="<?=$row['hm10']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm11" type="text" id="hm11" value="<?=$row['hm11']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm12" type="text" id="hm12" value="<?=$row['hm12']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm13" type="text" id="hm13" value="<?=$row['hm13']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm14" type="text" id="hm14" value="<?=$row['hm14']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm15" type="text" id="hm15" value="<?=$row['hm15']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm16" type="text" id="hm16" value="<?=$row['hm16']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm17" type="text" id="hm17" value="<?=$row['hm17']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm18" type="text" id="hm18" value="<?=$row['hm18']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm19" type="text" id="hm19" value="<?=$row['hm19']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input name="hm20" type="text" id="hm20" value="<?=$row['hm20']?>" maxlength=2 size="2" style="width:20px;"></td>
    <td align="center" bgcolor="#FFFFFF"><input class=za_button name="update" type="Submit" id="update" value="更新"> <input class=za_button name="delete" type="Submit" id="delete" value="删除"><input name="id" type="hidden" id="id" value="<?=$row['id']?>"></td>
    <td align="center" bgcolor="#FFFFFF"><? if($row['ok']==0){?>
      <a href="auto/kl8.php?qihao=<?=$row['qihao']?>"><font color="#FF0000">點擊開獎</font></a>
      <? }else{?>
      <font color="#0000FF">已開獎</font>
      <? }?></td>
  </form>
  </tr>
  <?
}
?>
  <tr>
    <td colspan="25" align="center" bgcolor="#FFFFFF">共計
      <?=$page_count?>
      頁 - 當前第 <?php echo $page+1;?> 頁 <a style="font-weight: normal; color:#000;" href="?qi=<?=$qi?>&username=<?=$username?>&stype=<?=$stype?>&ok=<?=$ok?>&page=<?=($page-1)?>">上一頁</a> | <a style="font-weight: normal; color:#000;" href="?qi=<?=$qi?>&username=<?=$username?>&stype=<?=$stype?>&ok=<?=$ok?>&page=<?=($page+1)?>">下一頁</a></td>
  </tr>
  <?
}
?>
</table>
</body>
</html>
