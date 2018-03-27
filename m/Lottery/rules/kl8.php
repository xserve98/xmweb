<?php
$g_t = 7;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>北京快乐8 - 游戏规则</title>
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
                <p class="f20">北京快乐8规则说明</p>
                <p class="b m_tb">简介</p>
                <p>北京快乐8是依照北京福彩网发行的北京快乐8的官方开奖结果所规划的游戏。由1至80的号码中随机摇出20个数字作为开奖号码，依这20个号码变化成各式不同的玩法，在根据猜中的号码个数或玩法可以获得不同等级的奖金。此游戏的开奖时间和开奖号码完全与北京福彩网发行的北京快乐8同步，每日从早上9:00至晚上23:55，每五分钟开奖一次，每日开奖179期。</p>
                <p class="b m_tb">游戏玩法</p>
                <p class="c_t m_b">1、选号玩法</p>
                <p>选号玩法是在1至80的80个号码中选出1至5个号码组合成一组进行的投注。会员将选择的投注号码与中奖号码对照，根据所选号码与中奖号码相符的个数多少（顺序不限）确定相应的中奖奖级。</p>
                <p><span class="b">※举例：</span>投注者购买的是1，2，3这三个号码为一个组合，且该期开奖号码中包含1，2，3这三个数字，则视为投注‘3中3’的玩法者中奖；若开出号码中只有1，2则视为投注‘3中2’的玩法者中奖。</p>
                <p class="c_t m_tb">2、和值玩法</p>
                <p>以所有开出的全部20个号码加起来的和值来判定。</p>
                <p><strong>总单/双：</strong>20个号码加总的和值为单，叫做和单；20个号码加总的和值为双，叫做和双。</p>
                <p><strong>总大/小：</strong>20个号码加总的和值大于810，为和大；20个号码加总的和值小于810，则为和小。</p>
                <p><strong>和值810：</strong>20个号码加总的和值等于810，叫和值810。</p>
                <p><span class="b">※举例：</span>开奖号码为1，2，3，4，5，6，7，8，9，10，11，12，13，14，15，16，17，18，19，20；那么此20个开奖号码的和值总和为210，则为小，为双。则投注小和双者中奖。投注大、单、和值810者不中奖。</p>
                <p class="c_t m_tb">3、上下盘玩法</p>
                <p>中奖号码个位、十位、百位的单双大小</p>
                <p>上下盘：开奖号码1至40为上盘号码，41至80为下盘号码。开出的20个号码中：如上盘号码（1-40）在此局开出号码数目占多数时，此局为上盘；下盘号码（41-80）在此局开出号码数目占多数时，此局为下盘；上盘号码（1－40）和下盘号码（41-80）在此局开出的数目相同时（各10个数字），此局为中盘。</p>
                <p><span class="b">※举例：</span>此局开出1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20.此局为上盘。</p>
                <p><span class="b">※举例：</span>此局开出41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60此局为下盘。</p>
                <p><span class="b">※举例：</span>此局开开出 1,2,3,4,5,6,7,8,9,10,41,42,43,44,45,46,47,48,49,50此局为中盘。</p>
                <p class="c_t m_tb">4、奇偶盘玩法</p>
                <p>开奖号码中1，3，5，7，…，75，77，79为奇数号码，2，4，6，8，……，76，78，80为偶数号码。当期开出的20个中奖号码中，如奇数号码数目占多数时（超过10个），则为奇盘，投注奇者中奖；偶数号码占多数时（超过10个），则为偶盘，投注偶者中奖；如果奇数和偶数号码数目相同时（均为10个），则为和，投注和者中奖。</p>
                <p><span class="b">※举例：</span>此期开出1，3，5，7，9，11，13，15，17，19，21，22，24，26，28，30，32，34，46，68，其中奇数11个偶数9个，此期为奇盘。</p>
                <p><span class="b">※举例：</span>此期开出2，4，6，8，10，12，14，16，44，48，66，68，25，27，31，35，37，39，41，55，其中偶数12个奇数8个，此期为偶盘。</p>
                <p><span class="b">※举例：</span>此期开出2，4，6，8，10，12，14，16，18，20，41，43，45，47，49，51，53，55，57，59，其中奇数10个偶数10个，此期为和。</p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../js/base.js"></script>
</body>
</html>