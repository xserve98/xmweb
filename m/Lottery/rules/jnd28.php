<?php
$g_t = 12;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>加拿大28 - 游戏规则</title>
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
                <p class="f20">加拿大28规则说明</p>
                <p class="b m_tb">简介</p>
                <p>该游戏分为“正常盘”和“午夜盘”两盘合计投注是早上09:00到次日早上06:00。正常盘(09:00~23:55)：投注时间、开奖时间和开奖号码与“北京快乐8”完全同步（官方网），北京时间（GMT+8）每天白天从上午09:00开到晚上23:55，每5分钟开一次奖，每天开奖179期。午夜盘(23:56~06:00次日)：投注时间、开奖时间和开奖号码与“加拿大卑斯”完全同步（官方网(需过代理)），官方开奖时间为每4分钟开奖一次，每周二～周日从4：50 am到隔天4:00 am(太平洋时间)，周一从6：05 am到隔天4:00 am(太平洋时间)。</p>
                <p class="b m_tb">游戏玩法</p>
                <p class="c_t m_b">大小玩法：</p>
                <p>数字14-27为大，数字0-13为小</p>
                <p class="c_t m_tb">单双玩法：</p>
                <p>数字1，3，5，~27为单，数字0，2，4~26为双</p>
                <p class="c_t m_tb">极值玩法：</p>
                <p>[极小0-5]，[极大22-27]</p>
                <p class="c_t m_tb">组合玩法：</p>
                <p>数字14，16，~26为大双，数字0，2，4，~12为小双</p>
                <p>数字15，17，~27为大单，数字1，3，5，~13为小单</p>
                <p class="c_t m_tb">定位玩法：</p>
                <p>从数字0-27中选取一个数字</p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../js/base.js"></script>
</body>
</html>