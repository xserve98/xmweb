<?php
$g_t = 3;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>北京赛车(PK10) - 游戏规则</title>
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
                <p class="f20">北京赛车(原名：北京福彩“PK拾”)规则说明</p>
                <p class="b m_tb">简介</p>
                <p>该游戏的投注时间、开奖时间和开奖号码与"北京PK拾"完全同步，北京时间（GMT+8）每天白天从上午09:02开到晚上23:57，每5分钟开一次奖，每天开奖179期。</p>
                <p class="b m_tb">游戏玩法</p>
                <p class="c_t m_b">1、第一名 ~ 第十名</p>
                <p><span class="b">※第一名~第十名：</span>车号指定，每一个车号为一投注组合，开奖结果"投注车号"对应所投名次视为中奖，其余情形视为不中奖。</p>
                <p><span class="b">※两面：</span>指单、双；大、小。</p>
                <p style="padding-left: 2em">单、双：号码为双数叫双，如8、10；号码为单数叫单，如9、5。</p>
                <p style="padding-left: 2em">大、小：开出之号码大于或等于6为大，小于或等于5为小。</p>
                <p class="c_t m_tb">2、1~5龙虎</p>
                <p><span class="b">※冠　军 龙/虎：</span>"第一名"车号大于"第十名"车号视为【龙】中奖、反之小于视为【虎】中奖，其余情形视为不中奖。</p>
                <p><span class="b">※亚　军 龙/虎：</span>"第二名"车号大于"第九名"车号视为【龙】中奖、反之小于视为【虎】中奖，其余情形视为不中奖。</p>
                <p><span class="b">※季　军 龙/虎：</span>"第三名"车号大于"第八名"车号视为【龙】中奖、反之小于视为【虎】中奖，其余情形视为不中奖。</p>
                <p><span class="b">※第四名 龙/虎：</span>"第四名"车号大于"第七名"车号视为【龙】中奖、反之小于视为【虎】中奖，其余情形视为不中奖。</p>
                <p><span class="b">※第五名 龙/虎：</span>"第五名"车号大于"第六名"车号视为【龙】中奖、反之小于视为【虎】中奖，其余情形视为不中奖。</p>
                <p class="c_t m_tb">3、冠亚军和</p>
                <p><span class="b">※冠军车号＋亚军车号＝冠亚和值：</span>冠军号码与亚军号码的和值区间为3~19，当投注组合符合冠亚军和值，即视为中奖。</p>
                <p><span class="b">※冠亚和大小：</span>大于11时投注"大"的注单视为中奖，小于或等于11时投注"小"的注单视为中奖，其余视为不中。</p>
                <p><span class="b">※冠亚和单双：</span>为单视为投注"单"的注单视为中奖，为双视为投注"双"的注单视为中奖，其余视为不中奖。</p>
                <p class="c_t m_tb">4、冠亚季军和</p>
                <p><span class="b">※冠军号码＋亚军号码+季军号码＝冠亚季和值：</span>冠亚季和值区间为6～27，投中对应"冠亚季和值"数字的视为中奖，其余视为不中奖。</p>
                <p><span class="b">※冠亚季和大小：</span>冠亚季和大于16时投注"大"的注单视为中奖，小于或等于16时投注"小"的注单视为中奖，其余视为不中奖。</p>
                <p><span class="b">※冠亚季和单双：</span>冠亚季和为单视为投注"单"的注单视为中奖，为双视为投注"双"的注单视为中奖，其余视为不中奖。</p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../js/base.js"></script>
</body>
</html>