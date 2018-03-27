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

function bjssc($bj_ssc){
	$beijing_ssc = strtotime($bj_ssc);
	$bj_sscs=date("Y-m-d",time())." ".date("H:i:s",$beijing_ssc);
	return $bj_sscs;
	}

$qihao=$_REQUEST['qihao'];
$save=$_REQUEST['save'];

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
<link rel="stylesheet" href="/style/agents/control_main.css" type="text/css">
<script>
function sbar(st){
st.style.backgroundColor='#BFDFFF';
}
function cbar(st){
st.style.backgroundColor='';
}
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" vlink="#0000FF" alink="#0000FF">
<? if($save=='add'){
    if($qihao=="")
    {
        echo "<script>alert('期号不能为空!');window.open('lottery_auto_kl8.php','mainFrame');</script>";
        exit();
    }
    ?>
<table border="0" cellpadding="5" cellspacing="1" class="m_tab">
  <tr class="m_title">
    <td colspan="3" align="center">北京快樂8開獎管理</td>
  </tr>
  <tr class="m_title">
    <td align="center">期號</td>
    <td align="center">開盤時間</td>
    <td align="center">封盤時間</td>
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
  <tr>
    <td align="center" bgcolor="#FFFFFF"><?=$qihao+$row['qihao']?></td>
    <td align="center" bgcolor="#FFFFFF"><?=bjssc($row['kaipan'])?></td>
    <td align="center" bgcolor="#FFFFFF"><?=bjssc($row['fengpan'])?></td>
  </tr>
<?
$qi=$qihao+$row['qihao'];
//$sql="insert into lottery_k_kl8 set qihao=".$qi.",kaipan='".bjssc($row['kaipan'])."',fengpan='".bjssc($row['fengpan'])."',hm1=0,hm2=0,hm3=0,hm4=0,hm5=0,hm6=0,hm7=0,hm8=0,hm9=0,hm10=0,hm11=0,hm12=0,hm13=0,hm14=0,hm15=0,hm16=0,hm17=0,hm18=0,hm19=0,hm20=0,ok=0";
$sql="insert into lottery_k_kl8 set qihao=".$qi.",kaipan='".bjssc($row['kaipan'])."',fengpan='".bjssc($row['fengpan'])."'";
mysql_db_query($dbname,$sql) or die ("操作失败!!!");

}
?>
  <?
}
?>
</table>
<? }?>
</body>
</html>
