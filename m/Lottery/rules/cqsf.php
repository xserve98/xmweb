<?php
$g_t = 5;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>重庆幸运农场 - 游戏规则</title>
    <link type="text/css" rel="stylesheet" href="../../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Css/ssc.css"/>
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/mmenu.all.min.js"></script>
</head>
<body mode="gm">
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>游戏规则</span>
            <a class="f_r" href="#type">游戏</a>
        </div>
        <?php include_once('../u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span></span>
                    <?php include_once('../gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="yx_gz">
            <?php include_once('type.php') ?>
            <div class="guize">
                <p class="f20">幸运农场规则说明</p>
                <p class="b m_tb">简介</p>
                <p>每期重庆幸运农场开奖球数共八粒。每粒球除了总和玩法，其它都有单独的投注页面。重庆幸运农场每天开97期，每期间隔10分钟。投注时间为8分钟，等待开奖时间为2分钟，北京时间（GMT+8）每天白天从上午10：00开到凌晨02：00。</p>
                <p class="b m_tb">游戏玩法</p>
                <p class="c_t m_b">1、第一球 ~ 第八球</p>
                <p><span class="b">※第一球~第八球：</span>第一球、第二球、第三球、第四球、第五球、第六球、第七球、第八球：指下注的每一球特码与开出之号码其开奖顺序及开奖号码相同，视为中奖，如第一球开出号码8，下注第一球为 8 者视为中奖，其余情形视为不中奖。</p>
                <p><span class="b">※两面：</span>指单、双；大、小；尾大、尾小；合单、合双。</p>
                <p style="padding-left: 2em;">单、双：号码为双数叫双，如8、16；号码为单数叫单，如19、5。</p>
                <p style="padding-left: 2em;">大、小：开出之号码大于或等于11为大，小于或等于10为小。</p>
                <p style="padding-left: 2em;">尾大、尾小：开出之尾数大于或等于5为尾大，小于或等于4为尾小。</p>
                <p style="padding-left: 2em;">合单、合双：开出之个位数与十位数之和为单、双的一种玩法。</p>
                <p style="padding-left: 2em;">每一个号码为一投注组合，假如投注号码为开奖号码并在所投的球位置，视为中奖，其余情形视为不中奖。</p>
                <p><span class="b">※中发白：</span></p>
                <p style="padding-left: 2em;">中：开出之号码为01、02、03、04、05、06、07</p>
                <p style="padding-left: 2em;">发：开出之号码为08、09、10、11、12、13、14</p>
                <p style="padding-left: 2em;">白：开出之号码为15、16、17、18、19、20</p>
                <p><span class="b">※东南西北：</span></p>
                <p style="padding-left: 2em;">东：开出之号码为01、05、09、13、17</p>
                <p style="padding-left: 2em;">南：开出之号码为02、06、10、14、18</p>
                <p style="padding-left: 2em;">西：开出之号码为03、07、11、15、19</p>
                <p style="padding-left: 2em;">北：开出之号码为04、08、12、16、20</p>
                <p class="c_t m_tb">2、总和</p>
                <p><span class="b">※总和单双：</span>所有8个开奖号码的数字总和值是单数为总和单，如数字总和值是31、51；所有8个开奖号码的数字总和值是双数为总和双，如数字总和是42、80；假如投注组合符合中奖结果，视为中奖，其余情形视为不中奖。</p>
                <p><span class="b">※总和大小：</span>所有8个开奖号码的数字总和值85到132为总大；所有8个开奖号码的数字总和值36到83为总分小；所有8个开奖号码的数字总和值为84打和；如开奖号码为01、20、02、08、17、09、11，数字总和是68，则总分小。假如投注组合符合中奖结果，视为中奖，其余情形视为不中奖，打和不计算结果。</p>
                <p><span class="b">※总尾大小：</span>所有8个开奖号码的数字总和数值的个位数大于或等于5为总尾大，小于或等于4为总尾小；假如投注组合符合中奖结果，视为中奖，其余情形视为不中奖。</p>
                <p class="c_t m_tb">3、龙虎</p>
                <p><span class="b">※龙：</span>开出之号码第一球的中奖号码大于第八球的中奖号码。如 第一球开出14 第八球开出09；第一球开出17 第八球开出08；第一球开出05 第八球开出01...中奖为龙。</p>
                <p><span class="b">※虎：</span>开出之号码第一球的中奖号码小于第八球的中奖号码。如 第一球开出14 第八球开出16；第一球开出13 第八球开出18；第一球开出05 第八球开出08...中奖为虎。</p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../js/base.js"></script>
</body>
</html>