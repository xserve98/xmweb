<?php
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid, $loginid);
$userinfo=user::getinfo($_SESSION["uid"]);
$lm = 3;

$cn_begin = $_GET["cn_begin"];
$s_begin_h = $_GET["s_begin_h"];
$s_begin_i = $_GET["s_begin_i"];
$cn_begin = $cn_begin == "" ? date("Y-m-d", time()) : $cn_begin;
$s_begin_h = $s_begin_h == "" ? "00" : $s_begin_h;
$s_begin_i = $s_begin_i == "" ? "00" : $s_begin_i;

$cn_end = $_GET["cn_end"];
$s_end_h = $_GET["s_end_h"];
$s_end_i = $_GET["s_end_i"];
$cn_end = $cn_end == "" ? date("Y-m-d", time()) : $cn_end;
$s_end_h = $s_end_h == "" ? "23" : $s_end_h;
$s_end_i = $s_end_i == "" ? "59" : $s_end_i;

$begin_time = $cn_begin . " " . $s_begin_h . ":" . $s_begin_i . ":00";
$end_time = $cn_end . " " . $s_end_h . ":" . $s_end_i . ":59";

$money = 0;
$ky = 0;
$jine = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$web_site['web_title']?></title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Lottery/Css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="images/member.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
	
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<META name="apple-mobile-web-app-capable" content="yes">
<META name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<META http-equiv="pragma" content="no-cache">
<META http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="Expires" content="0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telphone=no">
<meta charset="UTF-8">
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
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/js/mobile/validation/validationEngineRed.jquery.css" />
<script type="text/javascript" src="/cscpLoginWeb/scripts/showMessageArtDialog.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/artDialog/artDialog.js"></script>  
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/artDialog/artDialog.source.js"></script> 
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/js/mobile/artDialog/skins/black.css"/>
<script type="text/javascript" src="/cscpLoginWeb/scripts/mobile/TouchSlide.js"></script>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/index.css"/>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/main.css"/>
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
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
</head>
<body>
	<div class="wraper">
		<div class="tit">
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>报表中心
			<a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
		</div>
		<div style="height: 50px;"></div>
		<div class="wrap">
		
                <table  class="table_list" width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr class="tic">
                        <td width="25%">彩种</td>
                        <td width="25%">详情</td>
                        <td width="25%">金额</td>
                        <td width="25%">结果</td>
                    </tr>
                    <?php
                    $sql = "select id from c_bet where js<>0 and uid=$uid and addtime>='$begin_time' and addtime<='$end_time' order by addtime desc";
                    $query	=	$mysqli->query($sql);
                    $sum	=	$mysqli->affected_rows; //总页数
                    $thisPage	=	1;
                    if(@$_GET['page']){
                        $thisPage	=	$_GET['page'];
                    }
                    $page		=	new newPage();
                    $perpage	= 	10;
                    $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
                    $id		=	'';
                    $i		=	1;
                    $start	=	($thisPage-1)*$perpage+1;
                    $end	=	$thisPage*$perpage;
                    while($row = $query->fetch_array()){
                        if($i >= $start && $i <= $end){
                            $id .=	$row['id'].',';
                        }
                        if($i > $end) break;
                        $i++;
                    }
                    if(!$id) {
                        ?>
                        <tr align="center">
                            <td colspan="4">暂无记录！</td>
                        </tr>
                        <?php
                    } else {
                        $id = rtrim($id,',');
                        $sql = "select * from c_bet where id in($id) order by id desc";
                        $query	=	$mysqli->query($sql);
                        while($rows = $query->fetch_array()) {
                            $money += $rows["money"];
                            $win = $rows["win"] > 0 ? $rows["win"] - $rows["money"] : $rows["win"];
                            $ky += $win + $rows["fs"];
                            ?>
                            <tr class="list f_12">
                                <td>
                                    <div><?= $rows['type'] ?></div>
                                    <div><?php echo date('m-d H:i:s', strtotime($rows["addtime"])); ?></div>
                                </td>
                                <td>
                                    <div>第 <?= $rows["qishu"] ?> 期</div>
                                    <hr>
                                    <div>
                                        <? if ($rows['type'] == '香港六合彩') { ?>
                                            <?= $rows["mingxi_1"] ?><br><span class="c_red"><?= $rows["mingxi_2"] ?></span><br>@ <span class="c_red"><?= $rows["odds"] ?></span>
                                        <? } else { ?>
                                            <?= $rows["mingxi_1"] ?>【<span class="c_red"><?= $rows["mingxi_2"] ?></span>】 @ <span class="c_red"><?= $rows["odds"] ?></span>
                                        <? } ?>
                                    </div>
                                </td>
                                <td>
                                    <span><?= $rows["money"] ?></span>
                                    <hr>
                                    <?= $rows["win"] > 0 ? '<span class="c_red">全赢</span>' : '<span class="c_green">全输</span>' ?>
                                    <hr>
                                    <span class="c_blue"><?= $rows["fs"] ?></span>
                                </td>
                                <td>
                                    <?php
                                    $jine = 0;
                                    $jine = $rows["win"] > 0 ? $rows["win"] + $rows["fs"] : $rows["fs"];
                                    if ($rows["js"] == 0) {
                                        echo '待结算';
                                    } else {
                                        echo double_format($jine);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } ?>
                </table>
                <!--table cellspacing="0" cellpadding="0" border="0" class="page">
                    <tr>
                        <td align="right"><?=$page->get_htmlPage("cha_cp.php?rad=ygsds&cn_begin=$cn_begin&cn_end=$cn_end&t=y");?></td>
                    </tr>
                </table-->
            </div>
        </div>
    </div>
	<?php include_once("../modules/foots.php"); ?>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>