<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("../class/agapi.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);
$username=$userinfo["username"];
$agapi = new agapi();

if (!$userinfo) {
	message("用户不存在！");
	exit();
}

if(@$_GET["save"]=="ok"){
	/* 维护通知 
	include_once("../cache/website.php");
	$rtnagwh = check_agwh();
	if ($rtnagwh!="0") {
		message($rtnagwh);
		exit;
	}
	*/
	$zz_type=intval($_POST["zz_type"]);
    $zz_money=intval($_POST["zz_money"]);
	switch ($zz_type)
	{
		case 1:
			$zz_type="d";
			$type = "IN";
			break;
		case 3:
			$zz_type="w";
			$type = "OUT";
			break;
		default:
			message("转账类型非法！");
			exit();
			break;
	}
	
	if ($type=="IN" || $type=="OUT")
	{
		if($zz_money<$web_site['zh_low'])
		{
			message("转账金额最低为：".$web_site['zh_low']."元，请重新输入");
		}else if($zz_money>$web_site['zh_high']){
			message("转账金额最高为：".$web_site['zh_high']."元，请重新输入");
		}
		else
		{
			if ($type=="IN") {
				if ($userinfo["money"]<$zz_money) {
					message("体育/彩票额度不足！");
					exit();
				}
			}
		
			//获取真人余额A
			$agbalance = $agapi->balance_one($userinfo["username"]);
			if(isset($agbalance['code']) && $agbalance['code']){
				message('获取余额失败，ERR:'.$agbalance['code']);exit;
			}else{
			  $balanceA = number_format($agbalance['amount'],2);
			}
			if ($type=="OUT") {
				if ($balanceA<$zz_money) {
					message("真人额度不足！");
					exit();
				}
			}
			if ($type=="IN") {
				//exit("$res = $agapi->trans_in($username, intval($zz_money));");
				$res = $agapi->trans_in($username, intval($zz_money));
			} elseif ($type=="OUT") {
				//exit("$res = $agapi->trans_out($username, intval($zz_money));");
				$res = $agapi->trans_out($username, intval($zz_money));
			}
			//print_r($res);exit;
			if(isset($res['result']) && $res['result']){
				//加减款
				$moneyA = $userinfo["money"]; //转账前额度
				if ($type=="IN") {
					$sql = "update k_user set money=money-$zz_money where uid=$uid and money>=$zz_money";
					$mysqli->query($sql);
					$moneyB = $moneyA-$zz_money; //转账后额度
				} else if ($type=="OUT") {
					$sql = "update k_user set money=money+$zz_money where uid=$uid";
					$mysqli->query($sql);
					$moneyB = $moneyA+$zz_money; //转账后额度
				}
				$q1 = $mysqli->affected_rows;
				if ($q1<=0) {
					message("转账失败！");
					exit;
				}
				//写入转账记录
				$billno = $res['billno'];
				$username = $userinfo['username'];
				$zr_username = $userinfo['ag_zr_username'];
				$zz_time = date("Y-m-d H:i:s");
				$sql = "insert into ag_zhenren_zz(live_type,zz_type,uid,username,zr_username,zz_money,ok,result,zz_num,zz_time,billno,moneyA,moneyB) values ('AG','$zz_type',$uid,'$username','$zr_username',$zz_money,1,'转账成功',0,'$zz_time','$billno','$moneyA','$moneyB')";
				$mysqli->query($sql);
				$zzid = $mysqli->insert_id;
				message("转账成功,转账金额为".intval($zz_money),'zz_money.php');
			}else{
				message("转账失败：".$agapi->geterrorcode($res['code']),"zz_money.php");
				exit;
			}	
		}
	} else {
		message("转账类型非法！");
		exit();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>乐博国际</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/styles/ucenter.css">
	<script src="/assets/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</head>
<script language="javascript" src="../js/jquery.js"></script> 
<style type="text/css">
body {
	background:#ffffff;
	font-size: 12px;
	font-family:"宋体";
	width:100%;
}
</style>
<script>
		var $my = function(id){
			return document.getElementById(id);
		}
		
		//数字验证 过滤非法字符
        function clearNoNum(obj){
	        obj.value = obj.value.replace(/[^\d.]/g,""); //先把非数字的都替换掉，除了数字和.
	        obj.value = obj.value.replace(/^\./g,""); //必须保证第一个为数字而不是.
	        obj.value = obj.value.replace(/\.{2,}/g,"."); //保证只有出现一个.而没有多个.
	        obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$","."); //保证.只出现一次，而不能出现两次以上
	        if(obj.value != ''){
				var re=/^\d+\.{0,1}\d{0,2}$/;
				if(!re.test(obj.value))   
				{   
					obj.value = obj.value.substring(0,obj.value.length-1);
					return false;
				} 
	        }
        }
		
		function SubInfo(){
			var hk=$my('zz_money').value;
			if(hk==''){
				alert('请输入转账金额');
				$my('zz_money').focus();
				return false;
			}else{
				hk = hk*1;
				if(hk<<?=$web_site['zh_low']?>){
					alert('转账金额最低为：<?=$web_site['zh_low']?>元');
					$my('zz_money').select();
					return false;
				}else if(hk><?=$web_site['zh_high']?>){
					alert('转账金额最高为：<?=$web_site['zh_high']?>元');
					$my('zz_money').select();
					return false;
				}
			}
			
			$my('SubTran').value = "转账处理中";
			$my('SubTran').disabled = "disabled";
			$my('form1').submit();
		}
	</script>
	<script language="javascript">
		function reflivemoney() {
			$("#SubTran").val('请稍后...')
			$("#SubTran").attr('disabled',true);
			$("#live_money_span").html('请稍后...');
			$.getJSON("ajax_money.php?callback=?",function(json){
						$("#live_money_span").html(json.user_livemoney);
						$("#SubTran").val('确认转账')
						$("#SubTran").attr('disabled',false);
				  }
			);
		}
		reflivemoney();
	</script>
<body>
<div class="h10"></div>
<div class="ucenter">
	<div class="container">
	<div class="row">

		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">娱乐场转账</h3>
		  </div>
		  <div class="panel-body">
		   <form id="form1" name="form1" class="form-horizontal" action="?save=ok" method="post">
				<div class="form-group">
				    <label class="col-sm-2 control-label">转账类型：</label>
				    <div class="col-sm-10">
				    	<select name="zz_type" id="zz_type" class="form-control">
										<option value="1">体育/彩票 → 真人账户</option>
										<option value="3">真人账户 → 体育/彩票</option>
									</select>
				    </div>
				</div>
		    	<div class="form-group">
				    <label class="col-sm-2 control-label">转账金额：</label>
				    <div class="col-sm-10">
				    	<input class="form-control" name="zz_money" type="text" id="zz_money" maxlength="30" />
				    </div>
				</div>
		    	<div class="form-group">
				    <div class="col-sm-10 col-sm-offset-2">
				    	<input name="SubTran" type="submit" class="btn btn-green btn-lg btn-block"  id="SubTran" onclick="SubInfo();" value="请稍后..." disabled="disabled"/>
				    </div>
				</div>
		    </form>
		  </div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
			    <h3 class="panel-title">会员信息</h3>
			  </div>
			  <div class="panel-body">
			     <p>会员账户：<?=$userinfo["username"]?></p>
			    <p>体育/彩票额度：<span id="hyye" style="color:red"><?=sprintf("%.2f",$userinfo["money"])?></span></p>

				<p>真人额度：<span id="live_money_span" style="color:red">请稍后..</span></p>
			  </div>
		  </div>

		  
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>