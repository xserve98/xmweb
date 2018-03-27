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
$ok=$_REQUEST["ok"];

if($username==''){
$soname="1=1";	
}else{
$soname="username='".$username."'";
}
if($ok==''){
$sook="1=1";	
}else if($ok=='Y'){
$sook="bet_ok=1";
}else if($ok=='N'){
$sook="bet_ok=0";
}
$s_time = $_REQUEST["s_time"];
$e_time = $_REQUEST["e_time"];
if (isset($s_time) and $s_time != "") {
   $sook .= " and bet_date>='".$s_time."'";
}
if (isset($e_time) and $e_time != "") {
   $sook .= " and bet_date<='".$e_time."'";
}
switch ($stype)
{
case '3d':
  $atypename='3d';
  $typename='福彩3D';
  break;
case 'pl3':
  $atypename='pl3';
  $typename='体彩排列三';
  break;
case 'ssl':
  $atypename='ssl';
  $typename='上海時時樂';
  break;
case 'kl8':
  $atypename='kl8';
  $typename='北京快樂8';
  break;
default:
  $atypename='all';
  $typename='全部彩票';
}

if ($stype==""){
	$sql = "select * from lottery_data where 1=1 and ".$soname." and ".$sook." order by id desc";
	//echo $sql;
	}else{
	$sql = "select * from lottery_data where 1=1 and ".$soname." and ".$sook." and atype='".$atypename."' order by id desc";
	}
$result = mysql_db_query($dbname,$sql);
$cou=mysql_num_rows($result);


$resultn = mysql_db_query($dbname,$sql);
$nocount=mysql_num_rows($resultn);
//$result = mysql_db_query($dbname,$sql);
//$cou=mysql_num_rows($result);
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
.m_title{background:url(../images/06.gif);height:24px;}
.m_title td{font-weight:800;}
</STYLE>
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script language="JavaScript" src="/js/calendar.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" vlink="#0000FF" alink="#0000FF">
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
        <tr>
          <td colspan="10" align="center" bgcolor="#FFFFFF"><a href="?qi=<?=$qi?>&username=<?=$username?>&stype=&ok=<?=$ok?>">全部</a> - <a href="?qi=<?=$qi?>&username=<?=$username?>&stype=3d&ok=<?=$ok?>">福彩3D</a> - <a href="?qi=<?=$qi?>&username=<?=$username?>&stype=pl3&ok=<?=$ok?>">體彩体彩排列三</a> - <a href="?qi=<?=$qi?>&username=<?=$username?>&stype=ssl&ok=<?=$ok?>">上海時時樂</a> - <a href="?qi=<?=$qi?>&username=<?=$username?>&stype=kl8&ok=<?=$ok?>">北京快樂8</a></td>
        </tr>
        <tr><FORM id="myFORM" ACTION="" METHOD=POST name="myFORM" >
          <td colspan="10" align="center" bgcolor="#FFFFFF">
            會員帳號：<input type=TEXT name="username" size=10 value="<?=$username?>" maxlength=11 class="za_text">
            注单日期：<input name="s_time" type="text" id="s_time" value="<?=$s_time?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" />
            ~
            <input name="e_time" type="text" id="e_time" value="<?=$e_time?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" />
            <select name='ok'>
              <option value="" <?php if($ok=='') echo 'selected' ?>>全部</option>		
                    <option value="Y" <?php if($ok=='Y') echo 'selected' ?>>已開獎</option>
                    <option value="N" <?php if($ok=='N') echo 'selected' ?>>未開獎</option> 
              </select>
              <input type=SUBMIT name="SUBMIT" value="确认" class="za_button"></td></FORM>
        </tr>
        <tr class="m_title">
          <td align="center">彩票種類</td>
          <td align="center">投注時間</td>
          <td align="center">注單號</td>
          <td align="center">期數</td>
          <td align="center">玩法</td>
          <td align="center"><font color="#0000FF">投注 @ 賠率</font></td>
          <td align="center">投注金額</td>
          <td align="center">可赢金额</td>
          <td align="center">輸贏結果</td>
          <td align="center">下注會員</td>
          </tr>
          <?
if($cou==0){
?>
      <?
}else{
?>
<?
$tod_num=0;
$tod_bet=0;
$tod_win=0;
while ($row = mysql_fetch_array($result)){
switch ($row['atype'])
{
case '3d':
  $caizhong='福彩3D';
  break;
case 'pl3':
  $caizhong='体彩排列三';
  break;
case 'ssl':
  $caizhong='上海時時樂';
  break;
case 'kl8':
  $caizhong='北京快樂8';
  break;
}
?>
        <tr>
          <td align="center" bgcolor="#FFFFFF"><?=$caizhong?></td>
          <td align="center" bgcolor="#FFFFFF"><?=$row['bet_time']?></td>
          <td align="center" bgcolor="#FFFFFF"><?=$row['uid']?></td>
          <td align="center" bgcolor="#FFFFFF">第 <?=$row['mid']?> 期</td>
          <td align="center" bgcolor="#FFFFFF"><?=$row['btype']?></td>
          <td align="center" bgcolor="#FFFFFF"><?=$row['dtype']?><b><font color="#0000FF"><?=$row['content']?></font> @ <font color="#990000"><?=$row['odds']?></font></b></td>
          <td align="center" bgcolor="#FFFFFF"><font color="#0000FF"><?=$row['money']?></font></td>
          <td align="center" bgcolor="#FFFFFF"><?=$row['money']*$row['odds']-$row['money']?></td>
          <td align="center" bgcolor="#FFFFFF"><? if($row['bet_ok']==1){?><font color="#FF0000"><?=$row['win']?></font><? }else{?><font color="#0000FF">未開獎</font><? }?></td>
          <td align="center" bgcolor="#FFFFFF"><?=$row['username']?></td>
          </tr>
          <?
$tod_num=$tod_num+1;
}
?>
        <tr>
          <td colspan="10" align="center" bgcolor="#FFFFFF">共計 <?=$page_count?> 頁 - 當前第 <?php echo $page+1;?> 頁 <a style="font-weight: normal; color:#000;" href="?qi=<?=$qi?>&username=<?=$username?>&stype=<?=$stype?>&ok=<?=$ok?>&page=<?=($page-1)?>">上一頁</a> | <a style="font-weight: normal; color:#000;" href="?qi=<?=$qi?>&username=<?=$username?>&stype=<?=$stype?>&ok=<?=$ok?>&page=<?=($page+1)?>">下一頁</a></td>
          </tr>
          <?
}
?>
    </table>
</body>
</html>
