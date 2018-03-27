<?
session_start();
if(!isset($_SESSION["uid"]) || !isset($_SESSION["username"])){
	echo "<script type=\"text/javascript\" language=\"javascript\">window.location.href='/';</script>";
	exit();
}
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/function.php");
include "../include/lottery.inc.php";
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$class2=$_REQUEST['class2'];
$class3=$_REQUEST['class3'];
$stype=$_REQUEST['stype'];
$content=$_REQUEST['content'];
$bw=$_REQUEST['bw'];
$sw=$_REQUEST['sw'];
$gw=$_REQUEST['gw'];
//开始判断直选1D 2D 3D
if($stype==1){
	$class2name='单选';
	if($bw!="" && $sw!="" && $gw!=""){
		$wtypename="3D";
		$class3name="三位";
		$class4name="百十个";
		}elseif($bw!="" && $sw=="" && $gw==""){
			$wtypename="1D 百位";
			$class3name="一位";
			$class4name="百";
			}elseif($bw=="" && $sw!="" && $gw==""){
				$wtypename="1D 十位";
				$class3name="一位";
				$class4name="十";
				}elseif($bw=="" && $sw=="" && $gw!=""){
				$wtypename="1D 个位";
				$class3name="一位";
				$class4name="个";
				}elseif($bw!="" && $sw!="" && $gw==""){
				$wtypename="2D 百位 十位";
				$class3name="二位";
				$class4name="百十";
				}elseif($bw!="" && $sw=="" && $gw!=""){
				$wtypename="2D 百位 个位";
				$class3name="二位";
				$class4name="百个";
				}elseif($bw=="" && $sw!="" && $gw!=""){
				$wtypename="2D 十位 个位";
				$class3name="二位";
				$class4name="十个";
				}
	}
if($stype==2){
	$class2name="组一";
	$class3name="号码";
	$class4name="单选";
	$wtypename="组一";
	}
if($stype==3){
	$class2name="组二";
	$class3name="号码";
	$class4name="单选";
	$wtypename="组二";
	}
if($stype==4){
	$class2name="组三";
	$class3name="号码";
	$class4name="单选";
	$wtypename="组三";
	}
if($stype==5){
	$class2name="组六";
	$class3name="号码";
	$class4name="单选";
	$wtypename="组六";
	}
if($stype==6){
	$class2name="跨度";
	$class3name=$content;
	$class4name="单选";
	$wtypename="跨度";
	}
if($stype==7){
	$class2name='和值';
	switch ($content){
	case 'DA':
	$content='大';
	break;
	case 'XIAO':
	$content='小';
	break;
	case 'DAN':
	$content='单';
	break;
	case 'SHUANG':
	$content='双';
	break;
	default:
	$content=$content;
	}
	if($content=="0,1,2,3" || $content=="4,5,6,7" || $content=="8,9,10,11" || $content=="12,13,14,15" || $content=="16,17,18,19" || $content=="20,21,22,23" || $content=="24,25,26,27"){
		$class3name=$content;
		$class4name='区域';
		}else{
			$class3name=$content;
			$class4name='单选';
			}
	}
if($stype==8){
	$class2name="单双大小";
	$class3name="一位";
	$class4name=$class3;
	switch ($content){
	case 'DA':
	$content='大';
	break;
	case 'XIAO':
	$content='小';
	break;
	case 'DAN':
	$content='单';
	break;
	case 'SHUANG':
	$content='双';
	break;
	default:
	$content=$content;
	}
	}
if($stype==3){
$psql = "select id,class1,class2,class3,odds,modds,locked from lottery_odds where class1='pl3' and class2='".$class2name."' order by ID asc";
$presult = $mysqli->query($psql);
while ($prow = $presult->fetch_array()){
$pl=$pl."|".$prow['odds'];
}
$plrr=explode("|",$pl);
}else{
$psql = "select * from lottery_odds where class1='pl3' and class2='".$class2name."' and class3='".$class3name."'";
$presult = $mysqli->query($psql);
$prow = $presult->fetch_array();
}
$tsql = "select * from lottery_k_pl3 where kaipan<'".$l_time."' and fengpan>'".$l_time."'";
$tresult = $mysqli->query($tsql);
$trow = $tresult->fetch_array();
$tcou = $mysqli->affected_rows;
?>
<? 
if($wtypename=="3D"){
$brr=explode(",",$bw);
$srr=explode(",",$sw);
$grr=explode(",",$gw);
for ( $i=0; $i<count($brr)-1; $i++ )
//首先开始循环条件，以$grr数组的元素数量-1为条件；
{
for ( $is=0; $is<count($srr)-1; $is++)
{
for ( $ig=0; $ig<count($grr)-1; $ig++)
{
$zh=$zh.$brr[$i].$srr[$is].$grr[$ig]."|";
//echo $brr[$i].$srr[$is].$grr[$ig]." = ".$prow['odds']." | ";
}	
}
}
$zhrr=explode("|",$zh);
$zhnum=count($zhrr)-1;
}
elseif($wtypename=="1D 百位"){
$zhrr=explode(",",$bw);
$zhnum=count($zhrr)-1;
}
elseif($wtypename=="1D 十位"){
$zhrr=explode(",",$sw);
$zhnum=count($zhrr)-1;
}
elseif($wtypename=="1D 个位"){
$zhrr=explode(",",$gw);
$zhnum=count($zhrr)-1;
}
elseif($wtypename=="2D 百位 十位"){
$brr=explode(",",$bw);
$srr=explode(",",$sw);
for ( $i=0; $i<count($brr)-1; $i++ )
{
for ( $is=0; $is<count($srr)-1; $is++)
{
$zh=$zh.$brr[$i].$srr[$is]."|";	
}
}
$zhrr=explode("|",$zh);
$zhnum=count($zhrr)-1;
}
elseif($wtypename=="2D 百位 个位"){
$brr=explode(",",$bw);
$grr=explode(",",$gw);
for ( $i=0; $i<count($brr)-1; $i++ )
{
for ( $ig=0; $ig<count($grr)-1; $ig++)
{
$zh=$zh.$brr[$i].$grr[$ig]."|";	
}
}
$zhrr=explode("|",$zh);
$zhnum=count($zhrr)-1;
}
elseif($wtypename=="2D 十位 个位"){
$srr=explode(",",$sw);
$grr=explode(",",$gw);
for ( $i=0; $i<count($srr)-1; $i++ )
{
for ( $ig=0; $ig<count($grr)-1; $ig++)
{
$zh=$zh.$srr[$i].$grr[$ig]."|";	
}
}
$zhrr=explode("|",$zh);
$zhnum=count($zhrr)-1;
}elseif($wtypename=="组一"){
$zhrr=explode(",",$sw);
$zhnum=count($zhrr)-1;
}elseif($wtypename=="组二"){
$brr=explode(",",$bw);
$srr=explode(",",$sw);
$ii=0;
for ( $i=0; $i<count($brr)-1; $i++ )
{
for ( $is=$i; $is<count($srr)-1; $is++)
{
$zh=$zh.$brr[$i].$srr[$is]."|";	
}
}
$zhrr=explode("|",$zh);
$zhnum=count($zhrr)-1;
}elseif($wtypename=="组三"){
$brr=explode(",",$bw);
$srr=explode(",",$sw);
$grr=explode(",",$gw);
for ( $i=0; $i<count($brr)-1; $i++ )
{
for ( $ig=0; $ig<count($grr)-1; $ig++)
{
$zh=$zh.$brr[$i].$srr[$i].$grr[$ig]."|";
}
}
$zhrr=explode("|",$zh);
$zhnum=count($zhrr)-1;
}elseif($wtypename=="组六"){
$allnum=$bw.$sw.$gw;
$allrr=explode(",",$allnum);
for ( $i=0; $i<count($allrr)-1; $i++ )
{
for ( $is=$i+1; $is<count($allrr)-1; $is++)
{
for ( $ig=$is+1; $ig<count($allrr)-1; $ig++)
{
$zh=$zh.$allrr[$i].$allrr[$is].$allrr[$ig]."|";
}	
}
}
$zhrr=explode("|",$zh);
$zhnum=count($zhrr)-1;
}else{
$zhnum=1;
	}
	
include_once("../cache/group_".@$_SESSION["gid"].".php"); //加载权限组权限
$cp_zd = @$pk_db['彩票最低'];
$cp_zg = @$pk_db['彩票最高'];
if ($cp_zd > 0) {
	$cp_zd = $cp_zd;
} else {
	$cp_zd = $lowbet;
}
if ($cp_zg > 0) {
	$cp_zg = $cp_zg;
} else {
	$cp_zg = 1000000;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="../css/buy_lottery.css">
<script src="../box/artDialog.js?skin=idialog"></script>
<script src="../box/plugins/iframeTools.js"></script>
<script type="text/javascript">
function changeTwoDecimal(x)
{
var f_x = parseFloat(x);
if (isNaN(f_x))
{
alert('function:changeTwoDecimal->parameter error');
return false;
}
var f_x = Math.round(x*100)/100;
return f_x;
}
function msg(){
var ts = "";
var tsnum = "";
var tstxt = "";
<?
if($stype==1 || $stype==2 || $stype==3 || $stype==4 ||$stype==5){
?>
for(i=0;i<<?=$zhnum?>;i++){
	if(document.getElementById("ck_"+i+"").checked==true){
		if(document.getElementById("money_"+i+"").value<<?=$cp_zd?> || document.getElementById("money_"+i+"").value==''){
			tsnum = document.getElementById("num_"+i+"").innerHTML ;
			ts = ts+'请输入'+tsnum+'的下注金额！\n最低下注金额为<?=$cp_zd?>￥';
			}
		}
	}
<? }?>
<?
if($stype==6 || $stype==7 || $stype==8){
?>
		if(document.getElementById("money_<?=$zhnum?>").value<<?=$cp_zd?> || document.getElementById("money_<?=$zhnum?>").value==''){
			ts = '请输入<?=$content?>的下注金额！\n最低下注金额为<?=$cp_zd?>￥';
			}
<? }?>
if (ts!=""){
	alert(""+ts+"");
return false;
	}
<?
if($stype==1 || $stype==2 || $stype==3 || $stype==4 ||$stype==5){
?>
for(i=0;i<<?=$zhnum?>;i++){
	if(document.getElementById("ck_"+i+"").checked==true){
		if(document.getElementById("money_"+i+"").value > <?=$cp_zg?>){
			tsnum = document.getElementById("num_"+i+"").innerHTML ;
			ts = ts+tsnum+'的下注金额超过最大限额<?=$cp_zg?>￥！\n';
			}
		}
	}
<? }?>
<?
if($stype==6 || $stype==7 || $stype==8){
?>
		if(document.getElementById("money_<?=$zhnum?>").value > <?=$cp_zg?>){
			ts = '<?=$content?>的下注金额超过最大限额<?=$cp_zg?>￥！\n';
			}
<? }?>
if (ts!=""){
	alert(""+ts+"");
return false;
	}
if (confirm("确认提交下注？"))
document.form.submit()
}
var allmoneys = 0;
function wins(id){
	var tzmoney = parseInt(document.getElementById("money_"+id+"").value.replace(/\b(0+)/gi,""));
	var odds = document.getElementById("odd_"+id+"").innerHTML;
	if(isNaN(tzmoney)){
		document.getElementById("money_"+id+"").value = '';
		document.getElementById("win_"+id+"").innerHTML = 0;
		}else{
	document.getElementById("win_"+id+"").innerHTML = changeTwoDecimal(tzmoney*odds-tzmoney);
	}
}
function allmoney(money){
	var alltz = <?=$zhnum?>;
	//var allodds = <?=$prow['odds']?>;
	var newmoney = 0;
	for(i=0;i<alltz;i++){
		cs = parseInt(document.getElementById("money_"+i+"").value);
		money = parseInt(money);
		newmoney = cs+money;
		odds = document.getElementById("odd_"+i+"").innerHTML;
		document.getElementById("money_"+i+"").value = newmoney;
		document.getElementById("win_"+i+"").innerHTML = changeTwoDecimal(newmoney*odds-newmoney);
		}
}
function qk_ck(){
	for(i=0;i<<?=$zhnum?>;i++){
		document.getElementById("money_"+i+"").value = 0;
		document.getElementById("win_"+i+"").innerHTML = 0;
		}
	}
function checkok(id){
	var zdnum = parseInt(document.getElementById("zdnum").innerHTML);
	if(document.getElementById("ck_"+id+"").checked==true){
		document.getElementById("money_"+id+"").disabled = '';
		document.getElementById("zdnum").innerHTML = zdnum + 1
		document.getElementById("odd_"+id+"").style.color = '#ff0000';
		document.getElementById("num_"+id+"").style.color = '';
		document.getElementById("win_"+id+"").style.color = '';
		}
	if(document.getElementById("ck_"+id+"").checked==false){
		document.getElementById("money_"+id+"").disabled = 'disabled';
		document.getElementById("money_"+id+"").value = 0;
		document.getElementById("zdnum").innerHTML = zdnum - 1
		document.getElementById("odd_"+id+"").style.color = '#999999';
		document.getElementById("num_"+id+"").style.color = '#999999';
		document.getElementById("win_"+id+"").style.color = '#999999';
		document.getElementById("win_"+id+"").innerHTML = 0;
		}
	}
</script>
<script>
<!--
document.oncontextmenu=new Function("event.returnValue=false");
-->
</script>
</head>
<body>
<?
if ($tcou==0){
	echo "<script language=javascript>alert('当前期数已经关闭投注！'); location.href = 'javascript:art.dialog.close();'</script>";
	exit;
	}
?><? if($stype==1 || $stype==2 || $stype==3 || $stype==4 || $stype==5){?>
<div class="buy_top"></div>
<div class="buy_content">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
<form method="post" name="form" action="pl3_post.php?uid=<?=$uid?>">
  <tr>
    <td colspan="2" align="center" style="font-size:14px;"><font color="#990000"><?=$wtypename?></font> 注单内容
    <input type="hidden" name="zhnum" value="<?=$zhnum?>" /><input type="hidden" name="atype" value="pl3" /><input type="hidden" name="btype" value="<?=$class2name?>" /><input type="hidden" name="ctype" value="<?=$class3name?>" /><input type="hidden" name="dtype" value="<?=$class4name?>" /><input type="hidden" name="stype" value="<?=$stype?>" /><input type="hidden" name="key" value="y" /></td>
  </tr>
  <tr>
    <td style="border-bottom:1px #333 solid; color:#00F;">☆最小金额:<font color="#FF0000">10</font>  ☆单注限额:<font color="#FF0000">1000000</font>  ☆投注单量:<font color="#FF0000"><span id="zdnum"><?=$zhnum?></span></font>  ☆下注总额:<font color="#FF0000"><span id="allmoneys">0</span></font></td>
    <td align="right" style="border-bottom:1px #333 solid; color:#00F;"><img src="../images/Lotteyr/gold01.gif" alt="1" style="cursor:pointer;" onclick="allmoney(1);" /><img src="../images/Lotteyr/gold05.gif" alt="5" style="cursor:pointer;" onclick="allmoney(5);" /><img src="../images/Lotteyr/gold10.gif" alt="100" style="cursor:pointer;" onclick="allmoney(10);" /><img src="../images/Lotteyr/gold100.gif" alt="100" style="cursor:pointer;" onclick="allmoney(100);" /><img src="../images/Lotteyr/gold1000.gif" alt="1000" style="cursor:pointer;" onclick="allmoney(1000);" /></td>
  </tr>
  <tr>
    <td colspan="2">
    <?
    for ( $i=0; $i<$zhnum; $i++ ){
	?><? 
		$z1=substr($zhrr{$i},0,1);
		$z2=substr($zhrr{$i},1,1);
		if($z1==$z2){
			$xodds = $plrr[2];
			}else{
				$xodds = $plrr[1];
				}
		?>
<div style=" float:left; width:210px; height:auto; margin:0 5px 5px 0;"><table width="210" border="0" cellpadding="0" cellspacing="2" style="border:1px #37576C solid;">
      <tr style="color:#FFF; text-align:center;">
        <td width="40" height="20" bgcolor="#37576C">選號</td>
        <td width="40" bgcolor="#37576C">賠率</td>
        <td width="60" bgcolor="#37576C">下注金額</td>
        <td width="60" bgcolor="#37576C">可贏金額</td>
      </tr>
      <tr>
        <td align="center" style=" font-weight:bold;text-decoration: underline;"><INPUT id="ck_<?=$i?>" CHECKED type="checkbox"  onclick="checkok(<?=$i?>);" name="ck_<?=$i?>"><span id="num_<?=$i?>"><?=$zhrr{$i}?></span><input type="hidden" name="num_<?=$i?>" value="<?=$zhrr{$i}?>" /><? if($stype==3){?><input type="hidden" name="odds_<?=$i?>" value="<?=$xodds?>" /><? }else{?><input type="hidden" name="odds_<?=$i?>" value="<?=$prow['odds']?>" /><? }?></td>
        <td align="center" style="color:#F00;" id="odd_<?=$i?>"><? if($stype==3){?><?=$xodds?><? }else{?><?=$prow['odds']?><? }?></td>
        <td align="center"><INPUT id="money_<?=$i?>" value="0" maxLength="12" size="5" onkeyup="wins(<?=$i?>)" name="money_<?=$i?>"></td>
        <td id="win_<?=$i?>">0</td>
      </tr>
    </table></div>
    <? }?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><img src="../images/Lotteyr/buy_1.jpg" style="cursor:pointer;" onclick="art.dialog.close();"/> <img src="../images/Lotteyr/buy_2.jpg" style="cursor:pointer;" onclick="qk_ck();"/> <img src="../images/Lotteyr/buy_3.jpg" style="cursor:pointer;" onclick="msg();"/></td>
  </tr></form>
</table>
</div>
<div class="buy_bottom"></div><? }?>
<? if($stype==6){?>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" background="../images/Lotteyr/kk_dd_bg.jpg">
  <tr>
    <td height="200" align="center" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="5" style="margin-top:2px;"><form method="post" name="form" action="pl3_post.php?uid=<?=$uid?>">
      <tr>
        <td align="center" style="font-size:14px;"><font color="#990000">跨度 - 单选</font> 注单內容
          <input type="hidden" name="zhnum" value="<?=$zhnum?>" /><input type="hidden" name="atype" value="pl3" /><input type="hidden" name="btype" value="<?=$class2name?>" /><input type="hidden" name="ctype" value="<?=$class3name?>" /><input type="hidden" name="dtype" value="<?=$class4name?>" /><input type="hidden" name="stype" value="<?=$stype?>" /><input type="hidden" name="key" value="y" /></td>
      </tr>
      <tr>
        <td align="center" style="color:#00F">☆最小金额:<font color="#FF0000">1</font>  ☆单注限额:<font color="#FF0000">1000000</font></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#242424">
          <tr>
            <td align="center"><font color="#FFFFFF">选号</font></td>
            <td align="center"><font color="#FFFFFF">赔率</font></td>
            <td align="center"><font color="#FFFFFF">下注金额</font></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#E5E5E5"><font color="#0000FF"><?=$content?></font><input type="hidden" name="num_<?=$zhnum?>" value="<?=$content?>" /><input type="hidden" name="odds_<?=$zhnum?>" value="<?=$prow['odds']?>" /></td>
            <td align="center" bgcolor="#E5E5E5" style=" color:#990000" id="odd_<?=$zhnum?>"><?=$prow['odds']?></td>
            <td align="center" bgcolor="#E5E5E5"><INPUT id="money_<?=$zhnum?>" value="0" maxLength="12" size="5" onkeyup="wins(<?=$zhnum?>)" name="money_<?=$zhnum?>"></td>
          </tr>
          <tr>
            <td align="center"><font color="#FFFFFF">可贏金额</font></td>
            <td colspan="2" bgcolor="#E5E5E5" id="win_<?=$zhnum?>" style="color:#F00">0</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center"><img src="../images/Lotteyr/buy_1.jpg" style="cursor:pointer;" onclick="art.dialog.close();"/> <img src="../images/Lotteyr/buy_3.jpg" style="cursor:pointer;" onclick="msg();"/></td>
      </tr></form>
    </table></td>
  </tr>
</table>
<? }?>
<? if($stype==7){?>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" background="../images/Lotteyr/kk_dd_bg.jpg">
  <tr>
    <td height="200" align="center" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="5" style="margin-top:2px;"><form method="post" name="form" action="pl3_post.php?uid=<?=$uid?>">
      <tr>
        <td align="center" style="font-size:14px;"><font color="#990000">和值 - <? if($class4name=="单选"){?>单选<? }elseif($class4name=="区域"){?>区域<? }?></font> 注单内容
          <input type="hidden" name="zhnum" value="<?=$zhnum?>" /><input type="hidden" name="atype" value="pl3" /><input type="hidden" name="btype" value="<?=$class2name?>" /><input type="hidden" name="ctype" value="<?=$class3name?>" /><input type="hidden" name="dtype" value="<?=$class4name?>" /><input type="hidden" name="stype" value="<?=$stype?>" /><input type="hidden" name="key" value="y" /></td>
      </tr>
      <tr>
        <td align="center" style="color:#00F">☆最小金额:<font color="#FF0000">1</font>  ☆单注限额:<font color="#FF0000">1000000</font></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#242424">
          <tr>
            <td align="center"><font color="#FFFFFF">选号</font></td>
            <td align="center"><font color="#FFFFFF">赔率</font></td>
            <td align="center"><font color="#FFFFFF">下注金额</font></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#E5E5E5"><font color="#0000FF"><?=$content?></font><input type="hidden" name="num_<?=$zhnum?>" value="<?=$content?>" /><input type="hidden" name="odds_<?=$zhnum?>" value="<?=$prow['odds']?>" /></td>
            <td align="center" bgcolor="#E5E5E5" style=" color:#990000" id="odd_<?=$zhnum?>"><?=$prow['odds']?></td>
            <td align="center" bgcolor="#E5E5E5"><INPUT id="money_<?=$zhnum?>" value="0" maxLength="12" size="5" onkeyup="wins(<?=$zhnum?>)" name="money_<?=$zhnum?>"></td>
          </tr>
          <tr>
            <td align="center"><font color="#FFFFFF">可赢金额</font></td>
            <td colspan="2" bgcolor="#E5E5E5" id="win_<?=$zhnum?>" style="color:#F00">0</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center"><img src="../images/Lotteyr/buy_1.jpg" style="cursor:pointer;" onclick="art.dialog.close();"/> <img src="../images/Lotteyr/buy_3.jpg" style="cursor:pointer;" onclick="msg();"/></td>
      </tr></form>
    </table></td>
  </tr>
</table>
<? }?>
<? if($stype==8){?>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" background="../images/Lotteyr/kk_dd_bg.jpg">
  <tr>
    <td height="200" align="center" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="5" style="margin-top:2px;"><form method="post" name="form" action="pl3_post.php?uid=<?=$uid?>">
      <tr>
        <td align="center" style="font-size:14px;"><font color="#990000">大小单双 - <? if($class4name=="百位"){?>百位<? }elseif($class4name=="十位"){?>十位<? }elseif($class4name=="个位"){?>个位<? }?></font> 注单內容
          <input type="hidden" name="zhnum" value="<?=$zhnum?>" /><input type="hidden" name="atype" value="pl3" /><input type="hidden" name="btype" value="<?=$class2name?>" /><input type="hidden" name="ctype" value="<?=$class3name?>" /><input type="hidden" name="dtype" value="<?=$class4name?>" /><input type="hidden" name="stype" value="<?=$stype?>" /><input type="hidden" name="key" value="y" /></td>
      </tr>
      <tr>
        <td align="center" style="color:#00F">☆最小金额:<font color="#FF0000">1</font>  ☆单注限额:<font color="#FF0000">1000000</font></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#242424">
          <tr>
            <td align="center"><font color="#FFFFFF">选号</font></td>
            <td align="center"><font color="#FFFFFF">赔率</font></td>
            <td align="center"><font color="#FFFFFF">下注金额</font></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#E5E5E5"><font color="#0000FF">[<?=$class4name?>]<?=$content?></font><input type="hidden" name="num_<?=$zhnum?>" value="<?=$content?>" /><input type="hidden" name="odds_<?=$zhnum?>" value="<?=$prow['odds']?>" /></td>
            <td align="center" bgcolor="#E5E5E5" style=" color:#990000" id="odd_<?=$zhnum?>"><?=$prow['odds']?></td>
            <td align="center" bgcolor="#E5E5E5"><INPUT id="money_<?=$zhnum?>" value="0" maxLength="12" size="5" onkeyup="wins(<?=$zhnum?>)" name="money_<?=$zhnum?>"></td>
          </tr>
          <tr>
            <td align="center"><font color="#FFFFFF">可赢金额</font></td>
            <td colspan="2" bgcolor="#E5E5E5" id="win_<?=$zhnum?>" style="color:#F00">0</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center"><img src="../images/Lotteyr/buy_1.jpg" style="cursor:pointer;" onclick="art.dialog.close();"/> <img src="../images/Lotteyr/buy_3.jpg" style="cursor:pointer;" onclick="msg();"/></td>
      </tr></form>
    </table></td>
  </tr>
</table>
<? }?>
</body>
</html>
