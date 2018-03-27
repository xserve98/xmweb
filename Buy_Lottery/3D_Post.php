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
$zhnum=$_REQUEST["zhnum"];
$atype=$_REQUEST["atype"];
$btype=$_REQUEST["btype"];
$ctype=$_REQUEST["ctype"];
$dtype=$_REQUEST["dtype"];
$stype=$_REQUEST["stype"];
$key=$_REQUEST["key"];

$usql = "SELECT * FROM k_user WHERE uid=$uid ";
$uresult = $mysqli->query($usql);
$urow = $uresult->fetch_array();
$tsql = "select * from lottery_k_3d where kaipan<'".$l_time."' and fengpan>'".$l_time."'";
$tresult = $mysqli->query($tsql);
$trow = $tresult->fetch_array();
$tcou = $mysqli->affected_rows;

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
include_once("../cache/group_".@$_SESSION["gid"].".php"); //加载权限组权限
$cp_zd = @$pk_db['彩票最低'];
$cp_zg = @$pk_db['彩票最高'];

if($stype==6 || $stype==7 || $stype==8){
	/*验证投注信息 BEGIN*/
	$odds=$_REQUEST["odds_1"];
	if(chkBetOdds($atype,$btype,$ctype,$odds)==false) {
		echo "<script language=javascript>alert('投注信息被篡改，投注失败！'); refdialog();</script>";
		exit;
	}
	/*验证投注信息 END*/
	
	/*验证最低投注 BEGIN*/
	if ($cp_zd > 0) {
		if (abs($_REQUEST["money_1"]) < $cp_zd) {
			echo "<script language=javascript>alert('最低下注金额为 $cp_zd RMB！'); refdialog();</script>";
			exit;
		}
	} else {
		if (abs($_REQUEST["money_1"]) < $lowbet) {
			echo "<script language=javascript>alert('最低下注金额为 $lowbet RMB！'); refdialog();</script>";
			exit;
		}
	}
	
	if ($cp_zg > 0) {
		if (abs($_REQUEST["money_1"]) > $cp_zg) {
			echo "<script language=javascript>alert('最高下注金额为 $cp_zg RMB！'); refdialog();</script>";
			exit;
		}
	}
	/*验证最低投注 END*/
	
	$allmoney=abs($_REQUEST["money_1"]);
	if($allmoney==0){
		echo "<script language=javascript>alert('非法投注金额！'); refdialog();</script>";
		exit;
	}
}else{
	for ( $i=0; $i<$zhnum; $i++ ){
		/*验证投注信息 BEGIN*/
		$odds=$_REQUEST["odds_".$i.""];
		$chkctype=$ctype;
		if($btype=='组二'){
			$content=$_REQUEST["num_".$i.""];
			$z2hm1=substr($content,0,1);
			$z2hm2=substr($content,1,1);
			if($z2hm1==$z2hm2){
				$chkctype="对子";
			}else{
				$chkctype="杂二";
			}
		}
		if(chkBetOdds($atype,$btype,$chkctype,$odds)==false) {
			echo "<script language=javascript>alert('投注信息被篡改，投注失败！'); refdialog();</script>";
			exit;
		}
		/*验证投注信息 END*/
		
		/*验证最低投注 BEGIN*/
		if ($cp_zd > 0) {
			if (abs($_REQUEST["money_".$i.""]) < $cp_zd) {
				echo "<script language=javascript>alert('最低下注金额为 $cp_zd RMB！'); refdialog();</script>";
				exit;
			}
		} else {
			if (abs($_REQUEST["money_".$i.""]) < $lowbet) {
				echo "<script language=javascript>alert('最低下注金额为 $lowbet RMB！'); refdialog();</script>";
				exit;
			}
		}
		
		if ($cp_zg > 0) {
			if (abs($_REQUEST["money_".$i.""]) > $cp_zg) {
				echo "<script language=javascript>alert('最高下注金额为 $cp_zg RMB！'); refdialog();</script>";
				exit;
			}
		}
		/*验证最低投注 END*/

		if ($_REQUEST["ck_".$i.""]<>""){
			$allmoney = $allmoney+abs($_REQUEST["money_".$i.""]);
			if(abs($_REQUEST["money_".$i.""])==0){
				echo "<script language=javascript>alert('非法投注金额！'); refdialog();</script>";
				exit;
            }
        }
    }
}
if ($tcou==0){
    echo "<script language=javascript>alert('当前期数已经关闭投注！'); refdialog();</script>";
    exit;
    }
if ($allmoney>$urow['money']){
    echo "<script language=javascript>alert('您的可用额度不足进行本次投注！'); refdialog();</script>";
    exit;
    }
if ($key=="y"){
	$ye=$urow['money']-$allmoney;
	$msql="update k_user set money='".$ye."' where username='".$urow['username']."'";
	$mysqli->query($msql);
	if($stype==1 || $stype==2 || $stype==3 || $stype==4 || $stype==5){
		for ( $i=0; $i<$zhnum; $i++ ){
			if ($_REQUEST["ck_".$i.""]<>""){
				//echo $_REQUEST["num_".$i.""]."=".$_REQUEST["money_".$i.""]."=".$_REQUEST["odds_".$i.""]."=".$ye."<br>";
				$sql="insert into lottery_data set mid='".$trow['qihao']."',uid='".date("YmdHis",$lottery_time).rand(1000,9999)."',atype='".$atype."',btype='".$btype."',ctype='".$ctype."',dtype='".$dtype."',content='".$_REQUEST["num_".$i.""]."',money='".abs($_REQUEST["money_".$i.""])."',odds='".$_REQUEST["odds_".$i.""]."',win='".abs($_REQUEST["money_".$i.""])*$_REQUEST["odds_".$i.""]."',username='".$urow['username']."',agent='".$urow['agents']."',bet_date='".date("Y-m-d",time())."',bet_time='".date("Y-m-d H:i:s",time())."'";
				$mysqli->query($sql);
			}
		}
	}
	if($stype==6 || $stype==7 || $stype==8){
		$sql="insert into lottery_data set mid='".$trow['qihao']."',uid='".date("YmdHis",$lottery_time).rand(1000,9999)."',atype='".$atype."',btype='".$btype."',ctype='".$ctype."',dtype='".$dtype."',content='".$_REQUEST["num_1"]."',money='".abs($_REQUEST["money_1"])."',odds='".$_REQUEST["odds_1"]."',win='".abs($_REQUEST["money_1"])*$_REQUEST["odds_1"]."',username='".$urow['username']."',agent='".$urow['agents']."',bet_date='".date("Y-m-d",time())."',bet_time='".date("Y-m-d H:i:s",time())."'";
		$mysqli->query($sql);
	}
	echo "<script language=javascript>alert('下注成功，请到下注记录中查询本注单！'); refdialog();</script>";
}
?>
</body>
</html>