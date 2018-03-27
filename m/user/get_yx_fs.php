<?php
include_once("../common/login_check.php");
include_once("../include/mysqli.php");
include_once("../include/mysqlit.php");
include_once("../include/function_daili.php");

if($_GET['month'] != null) {
	$month = $_GET['month'];
	$sql	=	"select * from k_user where uid=".$_SESSION["uid"];
	$query	=	$mysqli->query($sql);
	while($rows	=	$query->fetch_array()){
		if($rows['is_daili']==1) {
			$username	=	$rows['username'];
			$uid = $rows['uid'];
			$daili_type = $rows['is_zongdaili'] == 1?"总代理":"代理";
			$is_zongdaili = $rows['is_zongdaili'] == 1;
			$zongdaili_uid = ($rows['zongdaili_uid']==null || $rows['zongdaili_uid']<=0)?null:$rows['zongdaili_uid'];
			$daili_mode = $rows['daili_mode'];
			$date_time_array = getdate (time());
			
			if($daili_mode==0 && $rows["has_yx_fs"]==0) {
				echo "<script>alert('对不起，您的代理模式无法领取有效返水');location.href='cha_xiaji_dynamic.php';</script>";
				exit;
			}
			
			if($date_time_array[ "mday"]<7 && $month==date('Y-m',time())) {
				echo "<script>alert('对不起，只能在每个月的第七天后才能领取有效金额');location.href='cha_xiaji_dynamic.php';</script>";
				exit;
			} else {
			
				$sql	=	"select * from k_daili_user_config_history where uid=".$_SESSION["uid"]." and processed=0";
				$query	=	$mysqli->query($sql);
				$rows	=	$query->fetch_array();
				
				/*
				if($rows) {
					echo "<script>alert('对不起，您的上级代理给您设置的代理或者模式参数还未生效，请稍候再尝试');location.href='cha_xiaji_dynamic.php';</script>";
					exit;
				}
				*/
			}
		} else {
			echo "<script>alert('对不起，您不是代理');location.href='cha_xiaji_dynamic.php';</script>";
			exit;
		}
	}

	if($username!=null) {
		$daili_ratio = getDailiRatio($uid);
		$gainsAndLosses = calculateGainsAndLosses($uid, $username, $month, true);

		if($daili_mode==0) {
			$ratio = $daili_ratio["zc_yx_ratio"];
		} else {
			$ratio = $daili_ratio["cs_ratio"];
		}
		$total_fs = $gainsAndLosses["ty_yx"] * $ratio;

		$lq_fs = 0;
		$sql	=	"select sum(amount) as total from k_daili_yx_fs where uid=".$uid." and month='".$month."'";
		$query	=	$mysqli->query($sql);
		$rows	=	$query->fetch_array();
		if($rows) {
			$lq_fs = $rows["total"]==null?0:$rows["total"];
		}

		$left_fs = $total_fs - $lq_fs;
		
		if($_POST["amount"]!=null) {
			if(!is_numeric($_POST["amount"]) || intval($_POST["amount"])<=0) {
				$error = "金额必须为大于0的数字";
			}
			
			if($error == null) {
				$lq_amount = intval($_POST["amount"]);
				if($lq_amount<10) {
					$error = "领取金额最低限额10元";
				} 
			}
			
			if($error == null) {
				$lq_amount = intval($_POST["amount"]);
				if($lq_amount>$left_fs) {
					$error = "领取金额不能大于有效返水余额";
				} 
			}
			
			if($error == null) {
				include_once("../class/money.php");
				$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
				$query	 =	$mysqli->query($sql);
				$rows	 =	$query->fetch_array();
				$assets	 =	$rows['money'];
				$type    =  1;
				$order	=	"万丰国际体育有效返水领取_".date("YmdHis");
				$about	=	"体育有效返水领取,领取前有效金额余额".$left_fs;
				$sql	 =	"INSERT INTO `k_daili_yx_fs`(`uid`, `month`, `amount`, `created_time`) VALUES (".$uid.",'".$month."',".$lq_amount.",now())";
				$mysqli->query($sql);
				if(money::chongzhi($uid,$order,$lq_amount,$assets,1,$about,1)){
					echo "<script>alert('领取成功');location.href=location.href;</script>";
				}else {
					echo "<script>alert('领取失败');location.href=location.href;</script>";
				}
			} else {
				echo "<script>alert('".$error."');location.href=location.href;</script>";
				exit;
			}
		}
		
	} else {
		echo "<script>alert('用户不存在');location.href='cha_xiaji_dynamic.php';</script>";
		exit;
	}
} else {
	echo "<script>alert('参数错误');location.href='cha_xiaji_dynamic.php';</script>";
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>万丰国际</title>
<link href="../css/tikuan2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<script language="javascript">
if(self==top){
	//top.location='/index.php';
}

</script>
</head>
<body>
<div id="top_lishi" style="text-align:center" >
<br>
<span style="color:red"><?=$msg?></span>
<br>
<?=$username?>代理类型: <?=$daili_type?><br><br>
<?php $max_ratio=getDailiRatio($uid, true); ?>
有效金额返水说明:<br><br>
<div style="text-align:center">
<div style="text-align:left;width:500px">
1. 代理用户可以按月领取下级会员有效金额的返水<br/>
2. 领取当月返水的时间限制为每个月的第七天后<br/>
3. 请及时领取上月返水，每个月7日后所有上月数据会被清空，未及时领取的返水将不再保留<br/>
4. 领取返水后，返水将直接进入到代理帐户，代理用户可以直接提款<br>
5. 领取反水最低金额不能低于10元，请您注意凑足尾数以免小于10的金额无法领取<br><br>
</div>
</div>
<form action="?month=<?=$month?>" method="post">
	<?=$month?>有效金额共<?=number_format($gainsAndLosses["ty_yx"])?>; 未领取返水共<?=number_format($left_fs)?>; 已领取返水共<?=$lq_fs?><br><br>
	领取返水金额：<input type="text" name='amount'>
	<input type="submit" value="提交">
</form>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
<script type="text/javascript" language="javascript" src="../js/left_mouse.js"></script>
</body>
</html>