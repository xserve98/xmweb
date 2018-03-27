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
$stype=$_REQUEST['stype'];
$hm=$_REQUEST['hm'];
$class2=$_REQUEST['class2'];
$class3=$_REQUEST['class3'];
if($stype==1){
$hmrr=explode(",",$hm);
$hmsum=count($hmrr);
$content=$hm;
}
switch ($class2){
	case 'HEZHI':
	$class2='和值';
	break;
	case 'JIHEOU':
	$class2='奇和偶';
	break;
	case 'SHANGZHONGXIA':
	$class2='上中下';
	break;
	default:
	$class2=$class2;
	}
switch ($class3){
	case 'DA':
	$class3='大';
	break;
	case 'XIAO':
	$class3='小';
	break;
	case 'DAN':
	$class3='单';
	break;
	case 'SHUANG':
	$class3='双';
	break;
	case 'JI':
	$class3='奇';
	break;
	case 'HE':
	$class3='和';
	break;
	case 'OU':
	$class3='偶';
	break;
	case 'SHANG':
	$class3='上';
	break;
	case 'ZHONG':
	$class3='中';
	break;
	case 'XIA':
	$class3='下';
	break;
	default:
	$class3=$class3;
	}
if($stype!=1){
$content=$class3;
}
switch ($hmsum){
	case 2:
	$class2name='选一';
	$class3name='中一';
	break;
	case 3:
	$class2name='选二';
	$class3name='中二';
	break;
	case 4:
	$class2name='选三';
	$class3name='中三';
	break;
	case 5:
	$class2name='选四';
	$class3name='中四';
	break;
	case 6:
	$class2name='选五';
	$class3name='中五';
	break;
	default:
	$class2name=$class2;
	$class3name=$class3;
	}
$psql = "select * from lottery_odds where class1='kl8' and class2='".$class2name."' and class3='".$class3name."'";
$presult = $mysqli->query($psql);
$prow = $presult->fetch_array();

$tsql = "select * from lottery_k_kl8 where kaipan<'".$l_time."' and fengpan>'".$l_time."'";
$tresult = $mysqli->query($tsql);
$trow = $tresult->fetch_array();
$tcou = $mysqli->affected_rows;

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
var ts="";
if(document.getElementById("money").value<<?=$cp_zd?> || document.getElementById("money").value==''){
			ts = '请输入<?=$content?>的下注金额！\n最低下注金额为<?=$cp_zd?>￥';
			}
if (ts!=""){
	alert(""+ts+"");
return false;
	}
if(document.getElementById("money").value > <?=$cp_zg?>){
			ts = '<?=$content?>的下注金额超过最大限额<?=$cp_zg?>￥！\n';
			}
if (ts!=""){
	alert(""+ts+"");
return false;
	}
if (confirm("确认提交下注？"))
document.form.submit()
}
var allmoneys = 0;
function wins(){
	var tzmoney = parseInt(document.getElementById("money").value.replace(/\b(0+)/gi,""));
	var odds = document.getElementById("odd").innerHTML;
	if(isNaN(tzmoney)){
		document.getElementById("money").value = '';
		document.getElementById("win_1").innerHTML = 0;
		}else{
	document.getElementById("win_1").innerHTML = changeTwoDecimal(tzmoney*odds-tzmoney);
	}
}
</script>
</head>
<body>
<?
if ($tcou==0){
	echo "<script language=javascript>alert('当前期数已经关闭投注！'); location.href = 'javascript:art.dialog.close();'</script>";
	exit;
	}

/* 加密数据防止作弊 2014.05.03 BEGIN */
include_once("../ajaxleft/postkey.php");
$orderinfo		=	$trow['qihao']."kl8".$class2name.$class3name.$content.$prow['odds']."y";
$orderkey		=	StrToHex($orderinfo,$postkey);
/* 加密数据防止作弊 2014.05.03 END */
?>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" background="../images/Lotteyr/kk_dd_bg.jpg">
  <tr>
    <td height="200" align="center" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="5" style="margin-top:2px;"><form method="post" name="form" action="kl8_post.php?uid=<?=$uid?>">
      <tr>
        <td align="center" style="font-size:14px;"><font color="#990000"><?=$class2name?></font> 注单內容
          <input type="hidden" name="qihao" id="qihao" value="<?=$trow['qihao']?>" /><input type="hidden" name="atype" id="atype" value="kl8" /><input type="hidden" name="btype" id="btype" value="<?=$class2name?>" /><input type="hidden" name="ctype" id="ctype" value="<?=$class3name?>" /><input type="hidden" name="content" id="content" value="<?=$content?>" /><input type="hidden" name="odds" id="odds" value="<?=$prow['odds']?>" /><input type="hidden" name="key" id="key" value="y" /></td>
          <input type="hidden" name="orderkey" value="<?=$orderkey?>"/>
	  </tr>
      <tr>
        <td align="center" style="color:#00F">☆最小金额:<font color="#FF0000">10</font>  ☆单注限额:<font color="#FF0000">1000000</font></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#242424">
          <tr>
            <td align="center"><font color="#FFFFFF">选号</font></td>
            <td align="center"><font color="#FFFFFF">赔率</font></td>
            <td align="center"><font color="#FFFFFF">下注金额</font></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#E5E5E5"><font color="#0000FF"><?=$content?></font></td>
            <td align="center" bgcolor="#E5E5E5" style=" color:#990000" id="odd"><?=$prow['odds']?></td>
            <td align="center" bgcolor="#E5E5E5"><INPUT id="money" value="0" maxLength="12" size="5" onkeyup="wins()" name="money"></td>
          </tr>
          <tr>
            <td align="center"><font color="#FFFFFF">可赢金额</font></td>
            <td colspan="2" bgcolor="#E5E5E5" id="win_1" style="color:#F00">0</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center"><img src="../images/Lotteyr/buy_1.jpg" style="cursor:pointer;" onclick="art.dialog.close();"/> <img src="../images/Lotteyr/buy_3.jpg" style="cursor:pointer;" onclick="msg();"/></td>
      </tr></form>
    </table></td>
  </tr>
</table>
</body>
</html>
