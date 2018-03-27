<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/function.php");
include_once("../class/user.php");
include_once("../cache/website.php");
include_once("include/Lottery_Time.php");
include("class/number_sx.php");
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
                <span>连码</span>
                封盘剩：<span><em id="hour_show">0</em>:<em id="minute_show">0</em>:<em id="second_show">0</em></span>
            </div>
            <div class="tz">
                <form name="orders" id="orders" action="order/order.php?type=0&class=11" method="post" target="OrderFrame">
                    <div class="tz_box">
                        <div class="opt"><input name='ball_11' type="radio" value='1'/> 四全中 <span class="odds" id="ball_11_o1"></span></div>
                        <div class="opt"><input name='ball_11' type="radio" value='2'/> 三全中 <span class="odds" id="ball_11_o2"></span></div>
                        <div class="opt"><input name='ball_11' type="radio" value='3'/> 三中二（中二 <span class="odds" id="ball_11_o3"></span>，中三 <span class="odds" id="ball_11_o4"></span>）</div>
                        <div class="opt"><input name='ball_11' type="radio" value='4'/> 二全中 <span class="odds" id="ball_11_o5"></span></div>
                        <div class="opt"><input name='ball_11' type="radio" value='5'/> 二中特（中特 <span class="odds" id="ball_11_o6"></span>，中二 <span class="odds" id="ball_11_o7"></span>）</div>
                        <div class="opt"><input name='ball_11' type="radio" value='6'/> 特　串 <span class="odds" id="ball_11_o8"></span></div>
                        <div class="opt p1">
                            <span id="type_1"><input name='type' type="radio" value='1'/> 普通</span>
                            <span id="type_2"><input name='type' type="radio" value='2'/> 生肖对碰</span>
                            <span id="type_3"><input name='type' type="radio" value='3'/> 尾数对碰</span>
                            <span id="type_4"><input name='type' type="radio" value='4'/> 肖串尾数</span>
                            <span id="type_5"><input name='type' type="radio" value='5'/> 托胆</span>
                        </div>
                    </div>
                    <div class="tz_box six" id="ball_1" style="display: none">
                        <div class="tit">连码</div>
                        <?php
                        for($s = 1; $s <= 49; $s++) {
                            if($s % 2 == 1) {
                                echo '<ul>';
                            }
                            ?>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball[]" type="checkbox" value="<?=$s?>">
                                        <span class="qiu"><em class="n_<?=$s?>"></em></span>
                                    </div>
                                </div>
                            </li>
                            <?php
                            if($s % 2 == 0 || $s == 49) {
                                echo '</ul>';
                            }
                        }
                        ?>
                    </div>
                    <div class="tz_box" id="ball_2" style="display: none">
                        <div class="tit">生肖</div>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_01a ?>">
                                        <span class="qiu">鼠</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_02a ?>">
                                        <span class="qiu">牛</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_03a ?>">
                                        <span class="qiu">虎</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_04a ?>">
                                        <span class="qiu">兔</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_05a ?>">
                                        <span class="qiu">龙</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_06a ?>">
                                        <span class="qiu">蛇</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_07a ?>">
                                        <span class="qiu">马</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_08a ?>">
                                        <span class="qiu">羊</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_09a ?>">
                                        <span class="qiu">猴</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_10a ?>">
                                        <span class="qiu">鸡</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_11a ?>">
                                        <span class="qiu">狗</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx[]" type="checkbox" value="<?= $sx_12a ?>">
                                        <span class="qiu">猪</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tz_box" id="ball_3" style="display: none">
                        <div class="tit">尾数</div>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws[]" type="checkbox" value="10,20,30,40">
                                        <span class="qiu">0尾</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws[]" type="checkbox" value="1,11,21,31,41">
                                        <span class="qiu">1尾</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws[]" type="checkbox" value="2,12,22,32,42">
                                        <span class="qiu">2尾</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws[]" type="checkbox" value="3,13,23,33,43"/>
                                        <span class="qiu">3尾</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws[]" type="checkbox" value="4,14,24,34,44">
                                        <span class="qiu">4尾</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws[]" type="checkbox" value="5,15,25,35,45">
                                        <span class="qiu">5尾</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws[]" type="checkbox" value="6,16,26,36,46">
                                        <span class="qiu">6尾</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws[]" type="checkbox" value="7,17,27,37,47">
                                        <span class="qiu">7尾</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws[]" type="checkbox" value="8,18,28,38,48">
                                        <span class="qiu">8尾</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws[]" type="checkbox" value="9,19,29,39,49">
                                        <span class="qiu">9尾</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tz_box" id="ball_4" style="display: none">
                        <div class="tit">主肖</div>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_01a ?>">
                                        <span class="qiu">鼠</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_02a ?>">
                                        <span class="qiu">牛</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_03a ?>">
                                        <span class="qiu">虎</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_04a ?>">
                                        <span class="qiu">兔</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_05a ?>">
                                        <span class="qiu">龙</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_06a ?>">
                                        <span class="qiu">蛇</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_07a ?>">
                                        <span class="qiu">马</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_08a ?>">
                                        <span class="qiu">羊</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_09a ?>">
                                        <span class="qiu">猴</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_10a ?>">
                                        <span class="qiu">鸡</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_11a ?>">
                                        <span class="qiu">狗</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_sx" type="radio" value="<?= $sx_12a ?>">
                                        <span class="qiu">猪</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="tit">拖尾数</div>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws" type="radio" value="10,20,30,40">
                                        <span class="qiu">0尾</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws" type="radio" value="1,11,21,31,41">
                                        <span class="qiu">1尾</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws" type="radio" value="2,12,22,32,42">
                                        <span class="qiu">2尾</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws" type="radio" value="3,13,23,33,43">
                                        <span class="qiu">3尾</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws" type="radio" value="4,14,24,34,44">
                                        <span class="qiu">4尾</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws" type="radio" value="5,15,25,35,45">
                                        <span class="qiu">5尾</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws" type="radio" value="6,16,26,36,46">
                                        <span class="qiu">6尾</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws" type="radio" value="7,17,27,37,47">
                                        <span class="qiu">7尾</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws" type="radio" value="8,18,28,38,48">
                                        <span class="qiu">8尾</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input name="ball_ws" type="radio" value="9,19,29,39,49">
                                        <span class="qiu">9尾</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tz_box six" id="ball_5" style="display: none">
                        <?php
                        for($s = 1; $s <= 2; $s++) {
                            if($s == 1) {
                                echo '<div class="tit">胆码</div>';
                            } else {
                                echo '<div class="tit">拖码</div>';
                            }
                            for($i = 1; $i <= 49; $i++) {
                                if($i % 2 == 1) {
                                    echo '<ul>';
                                }
                                ?>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input name="<?= $s == 1 ? 'ball_dm[]' : 'ball_tm[]' ?>" type="checkbox" value="<?=$i?>">
                                            <span class="qiu"><em class="n_<?=$i?>"></em></span>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                if($i % 2 == 0 || $i == 49) {
                                    echo '</ul>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="tz_box"></div>
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
    <script type="text/javascript" src="Js/class_11.js"></script>
    <script type="text/javascript" src="../js/base.js"></script>
    <script type="text/javascript">
        loadInfo();
    </script>
</body>
</html>