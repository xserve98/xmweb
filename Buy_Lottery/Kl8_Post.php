<?
session_start();
if(!isset($_SESSION["uid"]) || !isset($_SESSION["username"])){
    echo "<script type=\"text/javascript\" language=\"javascript\">_parent.location.href='/';</script>";
    exit();
}
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/function.php");
include "../include/lottery.inc.php";
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$qihao=$_REQUEST["qihao"];
$atype=$_REQUEST["atype"];
$btype=$_REQUEST["btype"];
$ctype=$_REQUEST["ctype"];
$content=$_REQUEST["content"];
$money=abs($_REQUEST["money"]);

$odds=$_REQUEST["odds"];
$key=$_REQUEST["key"];
$usql = "SELECT * FROM k_user WHERE uid=$uid ";
$uresult = $mysqli->query($usql);
$urow = $uresult->fetch_array();
$tsql = "select * from lottery_k_kl8 where kaipan<'".$l_time."' and fengpan>'".$l_time."'";
$tresult = $mysqli->query($tsql);
$trow = $tresult->fetch_array();
$tcou = $mysqli->affected_rows;
$ye=$urow['money']-$money;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="../css/buy_lottery.css">
<script src="../box/artDialog.js?skin=idialog"></script>
<script src="../box/plugins/iframeTools.js"></script>
<script>
	function refdialog() {
		art.dialog.close();
		var win = art.dialog.open.origin;//来源页面
		win.location.reload();
		return false;
	}
</script>
</head>
<body>
<?
/* 加密数据防止作弊 2014.05.03 BEGIN */
include_once("../ajaxleft/postkey.php");
$orderinfo		=	$qihao.$atype.$btype.$ctype.$content.$odds.$key;
$orderkey		=	StrToHex($orderinfo,$postkey);
$postorderkey	=	$_POST["orderkey"];

if($orderkey!=$postorderkey){
	echo "<script language=javascript>alert('投注信息被篡改，投注失败！'); refdialog();</script>";
	exit;
}

$hmrr=explode(",",$content);
for($i=0;$i<count($hmrr);$i++){
	$hmrr[$i]=trim($hmrr[$i]);
	if(is_numeric($hmrr[$i])){
		$hmrr[$i]=$hmrr[$i]*1;
	}
}
if(count($hmrr)!=count(array_unique($hmrr))){
	echo "<script language=javascript>alert('投注信息被篡改，投注失败！'); refdialog();</script>";
	exit;
}
/* 加密数据防止作弊 2014.05.03 END */

/*验证投注信息 BEGIN*/
if(chkBetOdds($atype,$btype,$ctype,$odds)==false) {
	echo "<script language=javascript>alert('投注信息被篡改，投注失败！'); refdialog();</script>";
	exit;
}
/*验证投注信息 END*/

/*验证最低投注 BEGIN*/
include_once("../cache/group_".@$_SESSION["gid"].".php"); //加载权限组权限
$cp_zd = @$pk_db['彩票最低'];
$cp_zg = @$pk_db['彩票最高'];

if ($cp_zd > 0) {
	if ($money < $cp_zd) {
		echo "<script language=javascript>alert('最低下注金额为 $cp_zd RMB！'); refdialog();</script>";
		exit;
	}
} else {
	if ($money < $lowbet) {
		echo "<script language=javascript>alert('最低下注金额为 $lowbet RMB！'); refdialog();</script>";
		exit;
	}
}

if ($cp_zg > 0) {
	if ($money > $cp_zg) {
		echo "<script language=javascript>alert('最高下注金额为 $cp_zg RMB！'); refdialog();</script>";
		exit;
	}
}
/*验证最低投注 END*/

if($money==0){
	echo "<script language=javascript>alert('非法投注金额！'); refdialog();</script>";
	exit;
}
if ($tcou==0){
    echo "<script language=javascript>alert('当前期数已经关闭投注！'); refdialog();</script>";
    exit;
}
if ($money>$urow['money']){
    echo "<script language=javascript>alert('您的可用额度不足进行本次投注！'); refdialog();</script>";
    exit;
}
if ($key=="y"){
	$msql="update k_user set money='".$ye."' where username='".$urow['username']."'";
	$mysqli->query($msql);
	$sql="insert into lottery_data set mid='".$trow['qihao']."',uid='".date("YmdHis",$lottery_time).rand(1000,9999)."',atype='".$atype."',btype='".$btype."',ctype='".$ctype."',content='".$content."',money='".$money."',odds='".$odds."',win='".$money*$odds."',username='".$urow['username']."',agent='".$urow['agents']."',bet_date='".date("Y-m-d",time())."',bet_time='".date("Y-m-d H:i:s",time())."'";
	$mysqli->query($sql);
    echo "<script language=javascript>alert('下注成功，请到下注记录中查询本注单！'); refdialog();</script>";
}
?>
</body>
</html>