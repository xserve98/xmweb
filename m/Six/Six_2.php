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
    <script type="text/javascript" src="Js/class_1.js"></script>
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
            <div class="pk s">
                第<span id="open_qihao">000000</span>期
                <span>正码2</span>
                封盘剩：<span><em id="hour_show">0</em>:<em id="minute_show">0</em>:<em id="second_show">0</em></span>
                <select id="gm_type">
                    <option value="Six_1.php">正码1</option>
                    <option value="Six_2.php" selected="selected">正码2</option>
                    <option value="Six_3.php">正码3</option>
                    <option value="Six_4.php">正码4</option>
                    <option value="Six_5.php">正码5</option>
                    <option value="Six_6.php">正码6</option>
                </select>
            </div>
            <div class="tz">
                <form name="orders" id="orders" action="order/order.php?type=0" method="post" target="OrderFrame">
                    <div class="tz_box">
                        <div class="tit">正码2</div>
                        <?php
                        for($s = 1; $s <= 49; $s++) {
                            if($s % 2 == 1) {
                                echo '<ul>';
                            }
                            ?>
                            <li>
                                <div class="wf_box six">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu"><em class="n_<?=$s?>"></em></span>
                                        <span class="odds" id="ball_2_o<?=$s?>"></span>
                                    </div>
                                    <div class="inp" id="ball_2_m<?=$s?>"></div>
                                </div>
                            </li>
                            <?php
                            if($s % 2 == 0 || $s == 49) {
                                echo '</ul>';
                            }
                        }
                        ?>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">大码</span>
                                        <span class="odds" id="ball_2_o50"></span>
                                    </div>
                                    <div class="inp" id="ball_2_m50"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">小码</span>
                                        <span class="odds" id="ball_2_o51"></span>
                                    </div>
                                    <div class="inp" id="ball_2_m51"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">单码</span>
                                        <span class="odds" id="ball_2_o52"></span>
                                    </div>
                                    <div class="inp" id="ball_2_m52"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">双码</span>
                                        <span class="odds" id="ball_2_o53"></span>
                                    </div>
                                    <div class="inp" id="ball_2_m53"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">合大</span>
                                        <span class="odds" id="ball_2_o54"></span>
                                    </div>
                                    <div class="inp" id="ball_2_m54"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">合小</span>
                                        <span class="odds" id="ball_2_o55"></span>
                                    </div>
                                    <div class="inp" id="ball_2_m55"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">合单</span>
                                        <span class="odds" id="ball_2_o56"></span>
                                    </div>
                                    <div class="inp" id="ball_2_m56"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">合双</span>
                                        <span class="odds" id="ball_2_o57"></span>
                                    </div>
                                    <div class="inp" id="ball_2_m57"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">尾大</span>
                                        <span class="odds" id="ball_2_o58"></span>
                                    </div>
                                    <div class="inp" id="ball_2_m58"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">尾小</span>
                                        <span class="odds" id="ball_2_o59"></span>
                                    </div>
                                    <div class="inp" id="ball_2_m59"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tool">
                        <div class="kj_box">
                            <div class="kuaisu">
                                <input id="kj_money" class="kj_inp" type="text" placeholder="快速金额" value="" />
                                <input id="qi_num" type="hidden" name="qi_num" value=""/>
                            </div>
                            <button type="button" title="重填" onclick="formReset();" class="btn btn-danger">重填</button>
                            <button type="button" title="下注" onclick="order();" class="btn btn-primary">下注</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
    <script type="text/javascript">
        loadInfo(2);
    </script>
</body>
</html>