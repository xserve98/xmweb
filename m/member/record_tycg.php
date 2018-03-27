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

$bet_money = 0;
$ky = 0;
$sub = 4;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>体育过关交易记录</title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Lottery/Css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="images/member.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
</head>
<body mode="gm">
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>会员中心</span>
            <a class="f_r" href="#type">游戏</a>
        </div>
        <?php include_once('../Lottery/u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span></span>
                    <?php include_once('../Lottery/gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="wrap">
            <?php include_once("recordmenu.php"); ?>
            <div class="content">
                <table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr class="tic">
                        <td width="30%">投注时间</td>
                        <td width="25%">投注详情</td>
                        <td width="25%">下注</td>
                        <td width="20%">结果</td>
                    </tr>
                    <?php
                    $sql = "select g.gid,g.bet_time,g.cg_count,g.bet_money,g.win,g.bet_win from k_bet_cg_group g where g.status in(0,2) and uid=$uid order by g.bet_time desc";
                    $query	=	$mysqli->query($sql);
                    $sum	=	$mysqli->affected_rows; //总页数
                    $thisPage	=	1;
                    if(@$_GET['page']){
                        $thisPage	=	$_GET['page'];
                    }
                    $page		=	new newPage();
                    $perpage	= 	10;
                    $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
                    $arr    =   array();
                    $gid    =   '';
                    $i		=	1;
                    $start	=	($thisPage-1)*$perpage+1;
                    $end	=	$thisPage*$perpage;
                    while($rows = $query->fetch_array()){
                        if($i >= $start && $i <= $end){
                            $arr[$rows['gid']]['bet_time'] = $rows['bet_time'];
                            $arr[$rows['gid']]['cg_count'] = $rows['cg_count'];
                            $arr[$rows['gid']]['bet_money'] = $rows['bet_money'];
                            $arr[$rows['gid']]['win'] = $rows['win'];
                            $arr[$rows['gid']]['bet_win'] = $rows['bet_win'];
                            $gid .= $rows['gid'] . ',';
                        }
                        if($i > $end) break;
                        $i++;
                    }
                    if(!$gid) {
                        ?>
                        <tr align="center">
                            <td colspan="4">没有交易记录！</td>
                        </tr>
                        <?php
                    } else {
                        $gid = rtrim($gid, ',');
                        $arr_cg = array();
                        $sql = "select gid,bid,bet_info,match_name,master_guest,bet_time,MB_Inball,TG_Inball,status from k_bet_cg where gid in ($gid) order by bid desc";
                        $query = $mysqli->query($sql);
                        while ($rows = $query->fetch_array()) {
                            $arr_cg[$rows['gid']][$rows['bid']]['bet_info'] = $rows['bet_info'];
                            $arr_cg[$rows['gid']][$rows['bid']]['match_name'] = $rows['match_name'];
                            $arr_cg[$rows['gid']][$rows['bid']]['master_guest'] = $rows['master_guest'];
                            $arr_cg[$rows['gid']][$rows['bid']]['bet_time'] = $rows['bet_time'];
                            $arr_cg[$rows['gid']][$rows['bid']]['MB_Inball'] = $rows['MB_Inball'];
                            $arr_cg[$rows['gid']][$rows['bid']]['TG_Inball'] = $rows['TG_Inball'];
                            $arr_cg[$rows['gid']][$rows['bid']]['status'] = $rows['status'];
                        }
                        foreach ($arr as $gid => $rows) {
                            $bet_money += $rows["bet_money"];
                            $ky += $rows["bet_win"] + $rows["fs"];
                            ?>
                            <tr class="list f_12">
                                <td><?= $rows["bet_time"] ?></td>
                                <td>
                                    <div>HG_<?= $gid ?> @ <?= $rows["cg_count"] ?>串1</div>
                                    <hr>
                                    <?php
                                    $x = 0;
                                    $nums = count($arr_cg[$gid]);
                                    foreach ($arr_cg[$gid] as $k => $myrows) {
                                        echo "<div>";
                                        $m = explode('-', $myrows["bet_info"]);
                                        echo $m[0];
                                        if (mb_strpos($myrows["bet_info"], " - ")) {
                                            //篮球上半之内的,这里换成正则表达替换
                                            $m[2] = $m[2] . preg_replace('[\[(.*)\]]', '', $m[3]);
                                        }
                                        $m[2] = @preg_replace('[\[(.*)\]]', '', $m[2] . $m[3]);
                                        unset($m[3]);
                                        //如果是波胆
                                        if (mb_strpos($m[0], "胆")) {
                                            $bodan_score = explode("@", $m[1], 2);
                                            $score = $bodan_score[0];
                                            $m[1] = "波胆@" . $bodan_score[1];
                                        }
                                        ?>
                                        <span class="c_blue f_b"><?= $myrows["match_name"] ?></span><br/>
                                        <?
                                        //正则匹配
                                        $m_count = count($m);
                                        preg_match('[\((.*)\)]', $m[$m_count - 1], $matches);
                                        if (strpos($myrows["master_guest"], 'VS.')) $team = explode('VS.', $myrows["master_guest"]);
                                        else $team = explode('VS', $myrows["master_guest"]);
                                        ?>
                                        <? if (count(@$matches) > 0) echo @$myrows['bet_time'] . @$matches[0] . "<br/>"; ?>

                                        <? if (mb_strpos($m[1], "让") > 0) { //让球?>
                                            <? if (mb_strpos($m[1], "主") === false) { //客让?>
                                                <?= $team[1] ?> <?= str_replace(array("主让", "客让"), array("", ""), $m[1]) ?>
                                                <span class="c_red"><?= $team[0] ?></span>(主)
                                            <? } else { //主让?>
                                                <?= $team[0] ?> <?= str_replace(array("主让", "客让"), array("", ""), $m[1]) ?>
                                                <span class="c_red"><?= $team[1] ?></span>
                                            <? } ?>
                                            <?
                                            $m[1] = "";
                                        } else { ?>
                                            <?= $team[0] ?> <? if (isset($score)) { ?> <?= $score ?> <? } else { ?>VS.<? } ?>
                                            <span class="c_red"><?= $team[1] ?></span>
                                        <? } ?>
                                        <br/>
                                        <? if ($m_count == 3) {
                                            if (strpos($m[1], '@')) {
                                                $ss = explode('@', $m[1]);
                                                echo $ss[0] . " @ <span class='c_red'>" . $ss[1] . "</span>";
                                            } else {
                                                echo $m[1] . ' ';//半全场替换显示
                                                $arraynew = array($team[0], " / ", $team[1], "和局");
                                                $arrayold = array("主", "/", "客", "和");
                                                $ss = str_replace($arrayold, $arraynew, preg_replace('[\((.*)\)]', '', $m[$m_count - 1]));
                                                $ss = explode('@', $ss);
                                                echo $ss[0] . " @ <span class='c_red'>" . $ss[1] . "</span>";
                                            }
                                        } ?>
                                        <? if ($myrows["status"] == 3 || $myrows["MB_Inball"] < 0) { ?>
                                            [取消]
                                        <? } else if ($myrows["status"] > 0) { ?>
                                            [<?= $myrows["MB_Inball"] ?>:<?= $myrows["TG_Inball"] ?>]
                                        <? }
                                        echo "</div>";
                                        if ($x < $nums - 1) {
                                            ?>
                                            <hr/>
                                        <?
                                        }
                                        $x++;
                                    }
                                    ?>
                                </td>
                                <td><span class="c_red"><?= $rows["bet_money"] ?></span> @ <span class="c_blue"><?= double_format($rows["bet_win"] + $rows["fs"]) ?></span></td>
                                <td>
                                    <?php
                                    $x = 0;
                                    $nums = count($arr_cg[$gid]);
                                    foreach ($arr_cg[$gid] as $k => $myrows) {
                                        echo "<div>";
                                        if ($myrows["status"] == 0) {
                                            echo '未知';
                                        } else {
                                            if ($myrows["status"] == 3 || $myrows["MB_Inball"] < 0) echo $myrows["MB_Inball"] . ':' . $myrows["TG_Inball"] . '<br>';
                                            echo getbet_msg($myrows["status"]);
                                        }
                                        echo "</div>";
                                        if ($x < $nums - 1) {
                                            ?>
                                            <hr/>
                                        <?
                                        }
                                        $x++;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } ?>
                </table>
                <table cellspacing="0" cellpadding="0" border="0" class="page">
                    <tr>
                        <td align="right"><?=$page->get_htmlPage('record_tycg.php?');?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>