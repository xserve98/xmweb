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
$lm = 1;

$cn_begin = $_GET["cn_begin"];
$s_begin_h = $_GET["s_begin_h"];
$s_begin_i = $_GET["s_begin_i"];
$cn_begin = $cn_begin == "" ? date("Y-m-d", time()) : $cn_begin;
$s_begin_h = $s_begin_h == "" ? "00" : $s_begin_h;
$s_begin_i = $s_begin_i == "" ? "00" : $s_begin_i;

$cn_end = $_GET["cn_end"];
$s_end_h = $_GET["s_end_h"];
$s_end_i = $_GET["s_end_i"];
$cn_end = $cn_end == "" ? date("Y-m-d", time()) : $cn_end;
$s_end_h = $s_end_h == "" ? "23" : $s_end_h;
$s_end_i = $s_end_i == "" ? "59" : $s_end_i;

$begin_time = $cn_begin . " " . $s_begin_h . ":" . $s_begin_i . ":00";
$end_time = $cn_end . " " . $s_end_h . ":" . $s_end_i . ":59";

$atype = $_GET["atype"];
$atype = $atype == "" ? "1" : $atype;
$bet_money = 0;
$ky = 0;
$jine = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
</head>
<body>
<div class="wrap">
    <?php include_once("historymenu.php"); ?>
    <div class="content">
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr class="tic">
                <td width="115">投注时间</td>
                <td width="130">注单号/模式</td>
                <td width="321">投注详细信息</td>
                <td width="60">结果</td>
                <td width="71">下注</td>
                <td width="71">返还</td>
            </tr>
            <?php
            $sql = "select bid from k_bet where status<>0 and uid=$uid and bet_time>='$begin_time' and bet_time<='$end_time' order by bet_time desc";
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
                    <td colspan="6">没有交易记录！</td>
                </tr>
                <?php
            } else {
                $id = rtrim($id,',');
                $sql = "select * from k_bet where bid in($id) order by bid desc";
                $query	=	$mysqli->query($sql);
                while($rows = $query->fetch_array()) {
                    $bet_money += $rows["bet_money"];
                    $win = getbet_win($rows["status"], $rows["win"], $rows["bet_money"], $rows["fs"]);
                    $ky += $win;
                    ?>
                    <tr class="list">
                        <td><?= $rows["bet_time"] ?></td>
                        <td>HG_<?= $rows["number"] ?><br/><?= $rows["ball_sort"] ?>
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
                        </td>
                        <td><span class="c_blue f_b"><?= $rows["match_name"] ?></span>
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
                            <? } ?></td>
                        <td>
                            <?
                            if ($rows["status"] == 0) {
                                echo '未知';
                            } else {
                                echo $rows["status"] != 6 && $rows["status"] != 3 ? $rows["MB_Inball"] . ':' . $rows["TG_Inball"] . '<br>' : '';
                                echo getbet_msg($rows["status"]);
                            }
                            ?>
                        </td>
                        <td><?= $rows["bet_money"] ?></td>
                        <td>
                            <?php
                            echo $rows["win"] > 0 && $rows["status"] != 6 && $rows["status"] != 3 ? $rows["win"] + $rows["fs"] : $rows["fs"];
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
                <td align="left">本页总投注金额：<span class="c_red"><?= $bet_money ?></span> RMB，输赢：<span class="c_red"><?= double_format($ky) ?></span> RMB</td>
                <td align="right"><?=$page->get_htmlPage("cha_ty.php?rad=ygsds&cn_begin=$cn_begin&cn_end=$cn_end&t=y");?></td>
            </tr>
        </table>
    </div>
</div>
<?php include_once('../Lottery/r_bar.php') ?>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>