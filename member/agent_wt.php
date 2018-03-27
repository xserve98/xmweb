<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$lm='ag3';
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
</head>
<body>
    <div class="wrap">
        <?php include_once("agentsubmenu.php"); ?>
        <table cellspacing="1" cellpadding="0" border="0" class="tab1">
            <tr>
                <td>
                    <h1>关于我们的计划方案</h1>
                    <p><strong>1. 什么是“乐博国际交易所合作伙伴计划”？</strong></p>
                    <p>“乐博国际交易所合作伙伴计划”是乐博国际交易所推出的一项寻找“合作伙伴”的活动。“合作伙伴”为乐博国际提供客户，即可从中获得相应的回报。我们的活动绝不需要任何费用，也无须承担任何风险。您只需要介绍会员加入我们的网站，您将能从我们的纯利润中得到您的回报，您介绍的会员越多，您所得到的回报也越大，您的回报是没有任何限额的.</p>
                    <p><strong>2. “乐博国际交易所合作伙伴计划”是免费吗？</strong></p>
                    <p>是的，参加“乐博国际交易所合作伙伴计划”是完全免费的。</p>
                    <p><strong>3.推荐客户须遵循的规则</strong></p>
                    <p>A.所推荐的会员注册时间须在您正式成为代理之后;</p>
                    <p>B.所推荐的会员在的帐号为可以正常使用的帐号,即帐号为真实有效，激活状态且该帐号是此会员在的唯一帐号;</p>
                    <p>C.代理本人的投注帐户不能纳入其代理业务的范畴;</p>
                    <p>D.所推荐的会员必须为自然会员,所谓自然会员是指未成为其他代理的下线会员。</p>
                    <h1>关于利润</h1>
                    <p><strong>1. 我如何查看我的会员统计资料及记录？</strong></p>
                    <p>如您需要查看您介绍的客户输赢记录，登陆后 点击首页右上方的“查看下级”链接，选择您需要查询数据的时间范围，便可查看下级会员的输赢记录及存提款记录。</p>
                    <p><strong>2. 我的“合作伙伴计划”的利润是怎样计算的？</strong></p>
                    <p>请见以下公式解释您的利润是如何计算的：</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;体育博彩利润</p>
                    <p class="c_red">—　会员红利</p>
                    <p class="c_red">—　退款</p>
                    <p class="c_red">—　会员存提款手续費用</p>
                    <p>-------------------------------------------</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;净（ 赢/输）</p>
                    <p class="c_red">×　佣金率</p>
                    <p>-------------------------------------------</p>
                    <p>　您的“合作伙伴计划”利润</p>
                    <p><strong>3. 如果我的“合作伙伴计划”帐户显示负值将如何处理？</strong></p>
                    <p>如果您的下级会员赢多输少，您的“合作伙伴”帐户将出现负数。这是有可能发生的，但通常您的资金报表将显示正数的利润。如果您某日的利润显示为负值，将在您现有资金的基础上扣除，直至账户资金出现正数。（并且会员余额超过100元,这样您就可以申请提取佣金。）</p>
                    <p><strong>4. 我如何收到付款？</strong></p>
                    <p>您的佣金将每天直接体现在您的“合作伙伴计划”账户中，此帐户每月2号至5号均可申请提款（每月仅限提款1次），只要您的账户余额高于100元，您就可以通过注册时的联系资料进行提款。</p>
                    <p><strong>5. 如果我有更多问题，怎么办？</strong></p>
                    <p>如果您有更多问题或需要协助 请联络我们的“合作伙伴计划部”经理，我们很乐意为您服务。</p>
                </td>
            </tr>
        </table>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>