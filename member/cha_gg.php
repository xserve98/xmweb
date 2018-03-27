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
$lm = 2;

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
            $sql = "select g.gid,g.bet_time,g.cg_count,g.bet_money,g.win,g.bet_win from k_bet_cg_group g where g.status<>0 and uid=$uid and bet_time>='$begin_time' and bet_time<='$end_time' order by g.bet_time desc";
            $query = $mysqli->query($sql);
            $sum	=	$mysqli->affected_rows; //总页数
            $thisPage	=	1;
            if(@$_GET['page']){
                $thisPage	=	$_GET['page'];
            }
            $page		=	new newPage();
            $perpage	= 	10;
            $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
            $arr = array();
            $gid = '';
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
                    <td colspan="6">没有交易记录！</td>
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
                    $win = 0;
                    $bet_money += $rows["bet_money"];
                    $win = getbet_win($rows["status"], $rows["win"], $rows["bet_money"], $rows["fs"]);
                    $ky += $win;
                    ?>
                    <tr class="list">
                        <td><?= $rows["bet_time"] ?></td>
                        <td>HG_<?= $gid ?><br/><?= $rows["cg_count"] ?>串1</td>
                        <td>
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
                                    <?= $team[0] ?>
                                    <? if (isset($score)) { ?>
                                        <?= $score ?>
                                    <? } else { ?>
                                        VS.
                                    <? } ?>
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
                        <td>
                            <?php
                            $x = 0;
                            $nums = count($arr_cg[$gid]);
                            foreach ($arr_cg[$gid] as $k => $myrows) {
                                echo "<div>";
                                if ($myrows["status"] == 0) {
                                    echo '未知';
                                } else {
                                    if ($myrows["status"] != 3 && $rows["status"] != 6 && $myrows["MB_Inball"] > 0) echo $myrows["MB_Inball"] . ':' . $myrows["TG_Inball"] . '<br>';
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
                        <td><?= $rows["bet_money"] ?></td>
                        <td>
                            <?php
                            $abc = double_format($rows["win"] > 0 ? $rows["win"] + $rows["fs"] : $rows["fs"]);
                            echo $abc;
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            } ?>
        </table>
        <table cellspacing="0" cellpadding="0" border="0" class="page">
            <tr>
                <td align="left">本页总投注金额：<span class="c_red"><?= double_format($bet_money) ?></span> RMB，最高可赢金额：<span class="c_red"><?= double_format($ky) ?></span> RMB</td>
                <td align="right"><?=$page->get_htmlPage("cha_gg.php?rad=ygsds&cn_begin=$cn_begin&cn_end=$cn_end&t=y");?></td>
            </tr>
        </table>
    </div>
</div>
<?php include_once('../Lottery/r_bar.php') ?>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>