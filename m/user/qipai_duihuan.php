<?php
include_once("../common/login_check.php");
include_once("../include/mysqli.php");
include_once("../include/mysqlit.php");
include_once("../include/mysqlio.php");
include_once("../include/config.php");
include_once("../common/function.php");
include_once("../include/sqlservergame.php");
?>
<?php
$uid		=	$_SESSION["uid"];
$sql	=	"select * from k_user where uid=".$uid;
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	$username	=	$rows['username'];
	$v8money	=	$rows['money'];
}

$sql="select * from qipai_config";
$query=$mysqlio->query($sql);
$rows	=	$query->fetch_array();
$enable_exchange = $rows["enable_exchange"];
$game_rate_money = $rows["game_rate_money"];
$game_rate_chip = $rows["game_rate_chip"];
$game_minimum = (int)$rows["game_minimum"];
$money_rate_money = $rows["money_rate_money"];
$money_rate_chip = $rows["money_rate_chip"];
$money_minimum = (int)$rows["money_minimum"];
$daily_activity = $rows["daily_activity"]==null?0:($rows["daily_activity"]=="1"?1:0);
$daily_chip = $rows["daily_chip"];

$conn = open_sql_connection("QPAccountsDB");
if( $conn != false) {
	$sql = "select userid from AccountsInfo where accounts='".$username."'";
	$result = sqlsrv_query( $conn, $sql, null);
	$game_user = null;
	while($row = sqlsrv_fetch_array($result)) {
		$game_user = $row["userid"];
	}
	close_sql_connection($conn);
	if($game_user != null) {
		$conn = open_sql_connection("QPTreasureDB");
		if( $conn != false) {
			$sql = "select score from GameScoreInfo where userid='".$game_user."'";
			$result = sqlsrv_query( $conn, $sql, null);
			while($row = sqlsrv_fetch_array($result)) {
				$qipaimoney = $row["score"];
			}
			close_sql_connection($conn);
		}
	} else{
		echo "<script>alert('棋牌帐户还未同步，请重新登陆一次同步帐号');</script>";
		exit;
	}
}


if($_POST["jiner"]!= null && $_POST["etype"]!= null) {
	if($enable_exchange == 1) {
		$etype = $_POST["etype"];
		$jiner = $_POST["jiner"];
		
		$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
		$query	 =	$mysqli->query($sql);
		$rows	 =	$query->fetch_array();
		$assets	 =	$rows['money'];
		$type    =  intval($_POST["optype"]);
		$order	=	"万丰国际棋牌金额兑换_".date("YmdHis");

		if(((int)$jiner)>0) {
			include_once("../class/money.php");
			$jiner = ((int)$jiner);
			$money   =  $jiner;
			if($etype == "1") {
				if($jiner>$v8money) {
					echo "<script>alert('V8帐户余额小于需要兑换的金额')</script>";
				} else{
					if($jiner>=$game_minimum) {
						$e_qipaimoney = $jiner*(((int)$game_rate_chip)/((int)$game_rate_money));
						$about	=	"V8金额兑换棋牌金额，兑换前V8金额".$assets."兑换前棋牌金额".$qipaimoney."，V8金额".$money."兑换棋牌金额".$e_qipaimoney;
						//echo $about;exit;
						$conn = open_sql_connection("QPTreasureDB");
						if($conn != false && money::tixian($uid,$money,$assets,'万丰国际','888888','美国','万丰国际',$order,1,$about)) {
							$sql = "update GameScoreInfo set score=score+".$e_qipaimoney." where userid=".$game_user;
							sqlsrv_query( $conn, $sql, null);
							echo "<script>alert('兑换成功')</script>";
						} else {
							echo "<script>alert('兑换失败')</script>";
						}
					} else {
						echo "<script>alert('V8金额兑换棋牌金额的最小额度必须大于".$game_minimum."')</script>";
					}
				}
			} else if($etype == "2") {
				if($jiner>$qipaimoney) {
					echo "<script>alert('棋牌帐户余额小于需要兑换的金额')</script>";
				} else{
					$e_v8money = $jiner*(((int)$money_rate_money)/((int)$money_rate_chip));
					if($e_v8money>=$money_minimum) {
						$about	=	"棋牌金额兑换V8金额，兑换前V8金额".$assets."兑换前棋牌金额".$qipaimoney."，棋牌金额".$money."兑换V8金额".$e_v8money;
						//echo $about;exit;
						$conn = open_sql_connection("QPTreasureDB");
						if($conn != false) {
						    $sql = "select userid from GameScoreLocker where UserId=".$game_user;
							$result = sqlsrv_query( $conn, $sql, null);
							while($row = sqlsrv_fetch_array($result)) {
								$lock_user = $row["userid"];
							}
							if($lock_user == null) {
								if(money::chongzhi($uid,$order,$e_v8money,$assets,1,$about,1)){
									$sql = "update GameScoreInfo set score=score-".$money." where userid=".$game_user;
									sqlsrv_query( $conn, $sql, null);
									echo "<script>alert('兑换成功')</script>";
								}else {
									echo "<script>alert('兑换失败')</script>";
								}
							} else {
								echo "<script>alert('您正在游戏中，请退出游戏再兑换')</script>";
							}
						} else {
							echo "<script>alert('兑换失败')</script>";
						}
					} else {
						echo "<script>alert('棋牌金额兑换V8金额，V8金额必须大于".$money_minimum."才可以进行兑换')</script>";
					}
				}
			}
		} else {
			echo "<script>alert('金额必须为大于0的整数')</script>";
		}
		
		echo "<script>location.href=location.href;</script>";
		exit;
	} else {
		echo "<script>alert('兑换功能还没有开启')</script>";
	}
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

function checkSubmit() {
	var regex=/^\d+$/;
	var jiner=$("#jiner").val();
	if(!regex.test(jiner)) {
		alert("金额必须为大于0的整数");
		return false;
	}
	
	var v8 = $("#v8yuer").html();
	var qipai = $("#qipaiyuer").html();
	var type = $("input[name='etype']:checked").val();
	
	if(type=="1") {
		if(parseInt(jiner)>parseInt(v8)) {
			alert("V8帐户余额小于需要兑换的金额，请冲值或者刷新页面");
			return false;
		}else {
			var qipaijiner = Math.ceil(parseInt(jiner) * (parseInt($("#v8chip").html())/parseInt($("#v8money").html())));
			if(confirm("请确认兑换金额： "+jiner+" V8金额兑换 "+qipaijiner+" 棋牌金额")) {
				return true;
			}
			return false;
		}
	} else if(type=="2") {
		if(parseInt(jiner)>parseInt(qipai)) {
			alert("棋牌帐户余额小于需要兑换的金额，请冲值或者刷新页面");
			return false;
		}else {
			var v8jiner = (parseInt(jiner) * (parseInt($("#qipaichip").html())/parseInt($("#qipaimoney").html()))).toFixed(2);
			if(confirm("请确认兑换金额： "+jiner+" 棋牌金额兑换 "+v8jiner+" V8金额")) {
				return true;
			}
			return false;
		}
	}
	
	
}

function url(u){
	window.location.href=u;
}

</script>
</head>
<body>
<div id="top_lishi" >
<div style="text-align:center; line-height:24px;">
 帐户余额兑换<?php if($enable_exchange==0){ echo "（兑换关闭）";} ?>
 </div>
  <div class="waikuang00">
<form id="eform" action="?" method="post" onsubmit="return checkSubmit();">
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="waikuang">
<tr class="sekuai_01">
  <td align="center"><input type="radio" name="etype" id="etype" value="1" checked="checked"/>V8帐户 -> 棋牌帐户&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="etype" id="etype" value="2"/>棋牌帐户 -> V8帐户&nbsp;&nbsp;&nbsp;&nbsp;<b style="color:red">无游戏和冲值记录的帐户将不予提现</b></td>
</tr>
<tr>
  <td align="center" style="background-color:#FFFFFF">
	  <br/>
	  <table cellspacing="8" cellpadding="8">
		  <tr>
			<td width="200" align="left">V8帐户余额</td>
			<td width="100" id="v8yuer"><?=$v8money?></td>
		  </tr>
		  <tr>
			<td width="150" align="left">V8帐户兑换棋牌帐户比率</td>
			<td><span id="v8money"><?=$game_rate_money?></span>:<span id="v8chip"><?=$game_rate_chip?></span></td>
		  </tr>
		  <tr>
			<td width="150" align="left">V8帐户兑换棋牌帐户最小额度</td>
			<td><span id="v8min"><?=$game_minimum?></span>(V8金额)</td>
		  </tr>
		  <tr>
			<td width="150" align="left">棋牌帐户余额</td>
			<td><?=$qipaimoney?></td>
		  </tr>
		  <tr>
			<td width="150" align="left">棋牌帐户兑换V8帐户比率</td>
			<td id="qipaiyuer"><span id="qipaimoney"><?=$money_rate_chip?></span>:<span id="qipaichip"><?=$money_rate_money?></span></td>
		  </tr>
		  <tr>
			<td width="150" align="left">棋牌帐户兑换V8帐户最小额度</td>
			<td><span id="qipaimin"><?=$money_minimum?></span>(V8金额)</td>
		  </tr>
		  <tr>
			<td width="150" align="left">兑换金额</td>
			<td><input type="text" name="jiner" id="jiner"></td>
		  </tr>
	  </table>
	  <br/>
	  <?php if($enable_exchange==1) { ?>
	  <input name="dh" type="submit" id="dh" value="确认兑换">
	  <?php } ?>
	  <br/><br/>
  </td>
</tr>
</table>
</form>
  </div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
<script type="text/javascript" language="javascript" src="../js/left_mouse.js"></script>
</body>
</html>