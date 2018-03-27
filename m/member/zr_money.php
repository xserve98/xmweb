<?php
session_start();
//include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("../cache/website.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);

if(@$_GET["save"]=="ok"){
	
	$agname=strtoupper($userinfo['zr_username']);

	$zz_type=intval($_POST["zz_type"]);
    $zz_money=intval($_POST["zz_money"]);
	$old_type=$zz_type;
	switch ($zz_type) {
		case 1: $zz_type="tsun"; break;
		case 2: $zz_type="tag"; break;
		case 4: $zz_type="sunt"; break;
		case 5: $zz_type="sunag"; break;
		case 7: $zz_type="agt"; break;
		case 8: $zz_type="agsun"; break;
		//新增
		case 11: $zz_type="mainToGame"; break;
		case 21: $zz_type="gameToMain"; break;
		
	}
    if($zz_money<$web_site['zh_low'])
    {
        message("转账金额最低为：".$web_site['zh_low']."元，请重新输入");
    }else if($zz_money>$web_site['zh_high']){
        message("转账金额最高为：".$web_site['zh_high']."元，请重新输入");
	}
    else
    {
		$accountNow = accountNow();
		if($old_type==1||$old_type==2){
			if($accountNow<$zz_money){
				message("余额不足，请充值后再转帐！");
			}
		}
    }
}
$sub = 3;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?=$web_site['web_title']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="Expires" content="0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telphone=no">
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/jquery.json-2.3.min.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/language/CN/main.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/patrn.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/login.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/util.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/account.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/conversion.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/register.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/validation/languages/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/validation/jquery.validationEngine.js"></script>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/js/mobile/validation/validationEngineRed.jquery.css">
<script type="text/javascript" src="/cscpLoginWeb/scripts/showMessageArtDialog.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/artDialog/artDialog.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/artDialog/artDialog.source.js"></script>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/js/mobile/artDialog/skins/black.css">
<script type="text/javascript" src="/cscpLoginWeb/scripts/mobile/TouchSlide.js"></script>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/index.css">
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/main.css">
<script type="text/javascript" src="/cscpLoginWeb/scripts/personalMsg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/report.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLotto.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLottery.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportM8Sport.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLive.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportDsLottery.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportOg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportAg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportBBIN.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportYY.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportGG.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportPt.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportSg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportAllBet.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportIg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/mobile/dialog.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/soltsPage.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/other-caiShenCP.js"></script>
</head>
<body>
<div class="wraper">
		<div class="tit">
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>额度转换
			<a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
		</div>
		<div style="height: 44px;"></div>
		<div class="wrap_div bg2 pbtt">
			
				<div class="transfer_tit">
					<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/info_tf01.png">选择额度
				</div>
				<ul class="tf_ul" id="tb_transfer_out">
						<li id="1">
							<p style="margin: 10px auto 3px auto;">我的钱包</p>
							<p style="margin: 2px auto 0px auto;">
								<span id="out_1" class="MAIN_WALLET"><?=sprintf("%.2f",$userinfo["money"])?></span> &nbsp;
								<span onclick="getBalanceForMobile('MAIN_WALLET');">
								<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/tf_liimg.png" width="11px" height="11px"></span>
							</p>
						</li>
					
						<li id="2">
							<p style="margin: 10px auto 3px auto;">彩票额度</p>
							<p style="margin: 2px auto 0px auto;">
								<span id="out_2" class="DS_LOTTERY_WALLET">0.00</span> &nbsp;
								<span onclick="getBalanceForMobile('DS_LOTTERY_WALLET');">
								<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/tf_liimg.png" width="11px" height="11px"></span>
							</p>
						</li>
					
						<li id="3">
							<p style="margin: 10px auto 3px auto;">体育额度</p>
							<p style="margin: 2px auto 0px auto;">
								<span id="out_3" class="SOPRT_WALLET">0.00</span> &nbsp;
								<span onclick="getBalanceForMobile('SOPRT_WALLET');">
								<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/tf_liimg.png" width="11px" height="11px"></span>
							</p>
						</li>
					
						<li id="4">
							<p style="margin: 10px auto 3px auto;">AG额度</p>
							<p style="margin: 2px auto 0px auto;">
								<span id="out_4" class="AG_LIVE_WALLET">0.00</span> &nbsp;
								<span onclick="getBalanceForMobile('AG_LIVE_WALLET');">
								<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/tf_liimg.png" width="11px" height="11px"></span>
							</p>
						</li>
					
						<li id="5">
							<p style="margin: 10px auto 3px auto;">BBIN额度</p>
							<p style="margin: 2px auto 0px auto;">
								<span id="out_5" class="BBIN_WALLET">0.00</span> &nbsp;
								<span onclick="getBalanceForMobile('BBIN_WALLET');">
								<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/tf_liimg.png" width="11px" height="11px"></span>
							</p>
						</li>
					
						<li id="6">
							<p style="margin: 10px auto 3px auto;">OG额度</p>
							<p style="margin: 2px auto 0px auto;">
								<span id="out_6" class="OG_WALLET">0.00</span> &nbsp;
								<span onclick="getBalanceForMobile('OG_WALLET');">
								<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/tf_liimg.png" width="11px" height="11px"></span>
							</p>
						</li>
					
						<li id="9">
							<p style="margin: 10px auto 3px auto;">YY额度</p>
							<p style="margin: 2px auto 0px auto;">
								<span id="out_9" class="YY_WALLET">0.00</span> &nbsp;
								<span onclick="getBalanceForMobile('YY_WALLET');">
								<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/tf_liimg.png" width="11px" height="11px"></span>
							</p>
						</li>
					
						<li id="10">
							<p style="margin: 10px auto 3px auto;">PT额度</p>
							<p style="margin: 2px auto 0px auto;">
								<span id="out_10" class="PT_WALLET">0.00</span> &nbsp;
								<span onclick="getBalanceForMobile('PT_WALLET');">
								<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/tf_liimg.png" width="11px" height="11px"></span>
							</p>
						</li>
					
						<li id="11">
							<p style="margin: 10px auto 3px auto;">SG额度</p>
							<p style="margin: 2px auto 0px auto;">
								<span id="out_11" class="SPADE_WALLET">0.00</span> &nbsp;
								<span onclick="getBalanceForMobile('SPADE_WALLET');">
								<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/tf_liimg.png" width="11px" height="11px"></span>
							</p>
						</li>
					
				</ul>
				<div class="transfer_tit">
					<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/info_tf02.png">转入
				</div>
				<ul class="tf_ul" id="tb_transfer_in">
					
						<li id="1">
							<p style="margin: 10px auto 3px auto;">我的钱包</p>
							<p style="margin: 2px auto 0px auto;" class="MAIN_WALLET 1"><?=sprintf("%.2f",$userinfo["money"])?></p>
						</li>
					
						<li id="2">
							<p style="margin: 10px auto 3px auto;">彩票额度</p>
							<p style="margin: 2px auto 0px auto;" class="DS_LOTTERY_WALLET 2">0.00</p>
						</li>
					
						<li id="3">
							<p style="margin: 10px auto 3px auto;">体育额度</p>
							<p style="margin: 2px auto 0px auto;" class="SOPRT_WALLET 3">0.00</p>
						</li>
					
						<li id="4">
							<p style="margin: 10px auto 3px auto;">AG额度</p>
							<p style="margin: 2px auto 0px auto;" class="AG_LIVE_WALLET 4">0.00</p>
						</li>
					
						<li id="5">
							<p style="margin: 10px auto 3px auto;">BBIN额度</p>
							<p style="margin: 2px auto 0px auto;" class="BBIN_WALLET 5">0.00</p>
						</li>
					
						<li id="6">
							<p style="margin: 10px auto 3px auto;">OG额度</p>
							<p style="margin: 2px auto 0px auto;" class="OG_WALLET 6">0.00</p>
						</li>
					
						<li id="9">
							<p style="margin: 10px auto 3px auto;">YY额度</p>
							<p style="margin: 2px auto 0px auto;" class="YY_WALLET 9">0.00</p>
						</li>
					
						<li id="10">
							<p style="margin: 10px auto 3px auto;">PT额度</p>
							<p style="margin: 2px auto 0px auto;" class="PT_WALLET 10">0.00</p>
						</li>
					
						<li id="11">
							<p style="margin: 10px auto 3px auto;">SG额度</p>
							<p style="margin: 2px auto 0px auto;" class="SPADE_WALLET 11">0.00</p>
						</li>
						
				</ul>
				<div class="transfer_tit">
					<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/info_tf02.png">选择转账金额
				</div>

					<div class="tf_num">
<div class="txtAmountformError parentFormcreditForm formError" style="opacity: 0.87; position: absolute; top: 783px; left: 370px; margin-top: -34px;">
			</div>
<input id="zz_money" name="zz_money" type="text" class="inputFull" onkeyup="clearNoNum(this);" maxlength="10" placeholder="输入金额">
					</div>
					<ul class="tf_num_ul" id="quick_price">
						<li money="-1"    class="on"><p class="bd_e tf_bt">全部</p></li>
						<li money="100"   class=""><p class="bd_e tf_bt">100</p></li>
						<li money="500"   class=""><p class="bd_e tf_bt">500</p></li>
						<li money="1000"  class=""><p class="bd_e tf_bt">1000</p></li>
						<li money="5000"  class=""><p class="bd_e tf_bt">5000</p></li>
						<li money="10000" class=""><p class="bd_e tf_bt">10000</p></li>
					</ul>
				</form>

				<div class="wrap_div pa10 bb">
			<input name="SubTran" id="SubTran" type="button" class="bd_dl bd_dl_full" value="提交" onclick="SubInfo();">
		    <input id="btnSubmit" type="button" class="bn_zc fontSize18" style="width: 100%;margin-top: 20px;" value="余额一键回收" onclick="recoverBalance();">
				</div>
			</div>
		</div>
		<div style="height: 40px;"></div>
<?php include_once("../modules/foots.php"); ?>

<script type="text/javascript" src="../js/base.js"></script>
</body>
</html>