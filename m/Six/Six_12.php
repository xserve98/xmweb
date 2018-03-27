<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/function.php");
include_once("../class/user.php");
include_once("../cache/website.php");
include_once("include/Lottery_Time.php");
if(intval($web_site['six']) == 1) {
    include('../Lottery/close_cp.php');
    exit();
}
$uid = $_SESSION['uid'];
$userinfo = user::getinfo($uid);

$gm = 11;
$t_day = date('Y-m-d', $lottery_time);
$w_name = array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');
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
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="../js/form.min.js"></script>
    <script type="text/javascript" src="../js/layer.js"></script>
</head>
<body mode="gm">
    <!--内容开始-->
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>香港六合彩</span>
            <a class="f_r" href="#type">类型</a>
        </div>
        <?php include_once('../Lottery/u_nav.php') ?>
        <?php include_once('Menu.php') ?>
        <div class="wrap">
            <div class="kj">
                <span><em id="numbers">000000</em>期开奖</span>
                <span id="open_num" class="six"></span>
            </div>
            <div class="pk">
                第<span id="open_qihao">000000</span>期
                <span>合肖</span>
                封盘剩：<span><em id="hour_show">0</em>:<em id="minute_show">0</em>:<em id="second_show">0</em></span>
            </div>
            <div class="tz">
                <form name="orders" id="orders" action="order/order.php?type=0&class=12" method="post" target="OrderFrame">
                    <div class="tz_box">
                        <div class="tit">合肖</div>
                        <?php
                        for($s = 1; $s <= 12; $s++) {
                            if($s % 2 == 1) {
                                echo '<ul>';
                            }
                            ?>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball[]" type="checkbox" value="<?=$s?>">
                                        <span class="qiu"><?=$w_name[$s - 1]?></span>
                                    </div>
                                </div>
                            </li>
                            <?php
                            if($s % 2 == 0) {
                                echo '</ul>';
                            }
                        }
                        ?>
                        <div class="wf_box" style="text-align: center">赔率：<span id="odds" class="odds">-</span></div>
                    </div>
                    <div class="tool">
                        <div class="kj_box">
                            <div class="kuaisu">
                                <input id="kj_money" name="money" class="kj_inp" type="text" placeholder="快速金额" value="" />
                                <input id="qi_num" type="hidden" name="qi_num" value=""/>
                            </div>
                            <button type="button" title="重选" onclick="formReset();" class="btn btn-danger">重选</button>
                            <button type="button" title="下注" onclick="order();" class="btn btn-primary">下注</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="Js/class_12.js"></script>
    <script type="text/javascript" src="../js/base.js"></script>
    <script type="text/javascript">
        loadInfo();
		$(function() {
			$(".wf_info").unbind().click(function() {
				var fp = $("#fp_time");
				if(fp.html() == "00:00" || fp.html() == "开奖中") {
					return false;
				}
				var chk = $(this).find(":checkbox");
				if(chk.is(":checked")) {
					chk.attr("checked", false);
				} else {
					chk.attr("checked", true);
				}
				if(!sx_click()) {
					chk.attr("checked", false);
				}
			});
		});
    </script>
</body>
</html>