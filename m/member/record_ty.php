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
$jine = 0;
$sub = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>体育单式交易记录</title>
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
                    $sql = "select bid from k_bet where uid=$uid and status=0 order by bet_time desc";
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
                            $id .=	$row['bid'].',';
                        }
                        if($i > $end) break;
                        $i++;
                    }
                    if(!$id) {
                        ?>
                        <tr align="center">
                            <td colspan="4">没有交易记录！</td>
                        </tr>
                        <?php
                    } else {
                        $id = rtrim($id,',');
                        $sql = "select * from k_bet where bid in($id) order by bid desc";
                        $query	=	$mysqli->query($sql);
                        while($rows = $query->fetch_array()){
                            $bet_money += $rows["bet_money"];
                            $ky += $rows["bet_win"] + $rows["fs"];
                            ?>
                            <tr class="list f_12">
                                <td><?= $rows["bet_time"] ?></td>
                                <td>
                                    <div>
                                        <?= $rows["ball_sort"] ?>
                                        <?
                                        $m = explode('-', $rows["bet_info"]);
                                        if ($rows["ball_sort"] == "冠军" || $rows["ball_sort"] == "金融") ;
                                        else echo $tz_type = $m[0];

                                        if (count($m) > 3) {
                                            $m[2] = preg_replace('[\[(.*)\]]', '', $m[2] . $m[3]);
                                            unset($m[3]);
                                        }
                                        //如果是波胆
                                        if (mb_strpos($m[0], "胆")) {
                                            $bodan_score = explode("@", $m[1], 2);
                                            $score = $bodan_score[0];
                                            $m[1] = "波胆@" . $bodan_score[1];
                                        }
                                        ?>
                                    </div>
                                    <hr>
                                    <div>
                                        <span class="c_blue f_b"><?= $rows["match_name"] ?></span>
                                        <?
                                        //正则匹配
                                        $m_count = count($m);
                                        preg_match('[\((.*)\)]', $m[$m_count - 1], $matches);
                                        if (strpos($rows["master_guest"], 'VS.')) {
                                            $team = explode('VS.', $rows["master_guest"]);
                                        } else {
                                            $team = explode('VS', $rows["master_guest"]);
                                        }

                                        if ($rows["match_type"] == 2) {
                                            echo $rows['match_time'];
                                            if ($rows['match_nowscore'] == "" && strpos($rows["ball_sort"], "滚球") == false)
                                                echo '(0:0)';
                                            else if (strtolower($rows["match_showtype"]) == "h" && strpos($rows["ball_sort"], "滚球") == false)
                                                echo "(" . $rows['match_nowscore'] . ")";
                                            else if (strpos($rows["ball_sort"], "滚球") == false)
                                                echo "(" . strrev($rows['match_nowscore']) . ")";
                                        }
                                        ?>
                                        <br/>
                                        <? if (mb_strpos($m[1], "让") > 0) { //让球?>
                                            <? if (strtolower($rows["match_showtype"]) == "c") { //客让?>
                                                <?= $team[1] ?>
                                                <?= str_replace(array("主让", "客让"), array("", ""), $m[1]) ?>
                                                <?= $team[0] ?>(主)
                                            <? } else { //主让?>
                                                <?= $team[0] ?>
                                                <?= str_replace(array("主让", "客让"), array("", ""), $m[1]) ?>
                                                <?= $team[1] ?>
                                            <? } ?>
                                            <?
                                            $m[1] = "";
                                        } else { ?>
                                            <?= $team[0] ?>
                                            <? if (isset($score)) { ?>
                                                <?= $score ?>
                                            <? } else { ?>
                                                <? if ($team[1] != "") { ?>VS.<? }
                                            } ?><span class="c_red"><?= $team[1] ?></span>
                                        <? } ?>
                                        <br/>
                                        <?
                                        //半全场替换显示
                                        $arraynew = array($team[0], $team[1], "和局", " / ", "局");
                                        $arrayold = array("主", "客", "和", "/", "局局");
                                        ?>
                                        <?php
                                        if ($rows["ball_sort"] == "冠军" || $rows["ball_sort"] == "金融") {
                                            $ss = explode("@", $rows["bet_info"]);
                                            echo "<span class='c_red'>" . $ss[0] . "</span> @ <span class='c_red'>" . $ss[1] . "</span>";
                                        } else {
                                            $ss = str_replace($arrayold, $arraynew, preg_replace('[\((.*)\)]', '', $m[$m_count - 1]));
                                            $ss = explode("@", $ss);
                                            if ($ss[0] == "独赢") echo $m[1] . "&nbsp;";
                                            elseif (strpos($ss[0], "独赢")) echo $m[1] . "-";
                                            echo str_replace(" ", '', $ss[0]);
                                            if ($rows['match_nowscore'] == "") ;
                                            else if (strtolower($rows["match_showtype"]) == "h" || (!strrpos($tz_type, "球"))) echo "(" . $rows['match_nowscore'] . ")";
                                            else echo "(" . strrev($rows['match_nowscore']) . ")";
                                            echo " @ <span class='c_red'>" . $ss[1] . "</span>";
                                        }
                                        ?>
                                        <?
                                        if (($rows["status"] != 0) && ($rows["status"] != 3) && ($rows["status"] != 7) && ($rows["status"] != 6))
                                            if ((strtolower($rows["match_showtype"]) == "c") && (strpos('&match_ao,match_ho,match_bho,match_bao&', $rows["point_column"]) > 0)) {
                                                ?>
                                                [<?= $rows["TG_Inball"] ?>:<?= $rows["MB_Inball"] ?>]
                                            <?php
                                            } elseif ($rows["ball_sort"] == "冠军" || $rows["ball_sort"] == "金融") {
                                                $sql = "select x_result from t_guanjun where match_id=" . $rows["match_id"];
                                                $query = $db->query($sql);
                                                if ($rs = mysql_fetch_array($query)) {
                                                    $rs['x_result'] = str_replace("<br>", "&nbsp;", $rs['x_result']);
                                                    echo '[' . $rs['x_result'] . ']';
                                                }
                                            } else {
                                                ?>
                                                [<?= $rows["MB_Inball"] ?>:<?= $rows["TG_Inball"] ?>]
                                            <? } ?>
                                        <? if ($rows["lose_ok"] == 0 && $rows["ball_sort"] == "足球滚球") { ?>
                                            [确认中]
                                        <? } else if ($rows["status"] == 0 && $rows["ball_sort"] == "足球滚球") { ?>
                                            [已确认]
                                        <? } ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="c_red"><?= $rows["bet_money"] ?></span> @ <span class="c_blue">
                                        <?php
                                        if ($rows["status"] == 0) {
                                            if (strtotime($rows["bet_time"]) + 60 < time()) echo $rows["bet_win"];
                                            else echo '审核中';
                                        } else {
                                            echo $rows["bet_win"] + $rows["fs"];
                                        }
                                        ?>
                                    </span>
                                </td>
                                <td>
                                    <?
                                    if ($rows["status"] == 0) {
                                        echo '未知';
                                    } else {
                                        echo $rows["status"] != 3 ? $rows["MB_Inball"] . ':' . $rows["TG_Inball"] . '<br>' : '';
                                        echo getbet_msg($rows["status"]);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            unset($score);
                        }
                    } ?>
                </table>
                <table cellspacing="0" cellpadding="0" border="0" class="page">
                    <tr>
                        <td align="right"><?=$page->get_htmlPage('record_ty.php?');?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>