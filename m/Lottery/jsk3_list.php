<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../include/lottery.inc.php");
include ("include/auto_class.php");
include ("include/order_info.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>江苏快三开奖结果</title>
<link type="text/css" rel="stylesheet" href="css/ssc.css"/>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<style>
body{
	margin:0px;
	padding:0px;
	font-family: "宋体", Arial;
	color:#383838;
    position: relative;
	font-size:12px;
	/* 样式修改 */
	background:#CCCCCA;
}
a:link, a:visited, a:active, a:hover { color: #000000; }
</style>
</head>
<body>
<div class="lottery_main" style="margin: 0px auto;">
<div class="ssc_left">
    <div class="touzhu" style="margin: 0px;">
        <table class="bian" border="0" cellpadding="0" cellspacing="1">
            <tr class="bian_tr_title">
                <td colspan="12">江苏快三开奖结果</td>
            </tr>
            <tr class="bian_tr_txt">
                <td colspan="12">选择日期查看：
                    <a href="jsk3_list.php?t=1"><?=date("Y-m-d",$lottery_time);?></a>&nbsp;&nbsp;
                    <a href="jsk3_list.php?t=2"><?=date("Y-m-d",$lottery_time-1*24*3600);?></a>&nbsp;&nbsp;
                    <a href="jsk3_list.php?t=3"><?=date("Y-m-d",$lottery_time-2*24*3600);?></a>&nbsp;&nbsp;
                    <a href="jsk3_list.php?t=4"><?=date("Y-m-d",$lottery_time-3*24*3600);?></a>&nbsp;&nbsp;
                    <a href="jsk3_list.php?t=5"><?=date("Y-m-d",$lottery_time-4*24*3600);?></a>&nbsp;&nbsp;
                    <a href="jsk3_list.php?t=6"><?=date("Y-m-d",$lottery_time-5*24*3600);?></a>&nbsp;&nbsp;
                    <a href="jsk3_list.php?t=7"><?=date("Y-m-d",$lottery_time-6*24*3600);?></a>
                </td>
            </tr>
            <tr class="bian_tr_title">
                <td width="20%">开奖时间</td>
                <td width="12%">彩票期号</td>
                <td width="5%">一</td>
                <td width="5%">二</td>
                <td width="5%">三</td>
                <td width="22%">总和</td>
            </tr>
            <?php
            $t = $_GET["t"];
            $t = intval($t);
            if ($t <= 0 || $t > 7) {
                $t = 1;
            }
            $tday = date("Y-m-d",$lottery_time-($t-1)*24*3600);
            $sql = "select * from c_auto_6 where DATEDIFF(datetime, '$tday')=0 order by qishu desc";
            $query = $mysqli->query($sql);
            while ($rows = $query->fetch_array()) {
                $color = "#FFFFFF";
                $over = "#EBEBEB";
                $out = "#ffffff";
                $hm = array();
                $hm[] = $rows['ball_1'];
                $hm[] = $rows['ball_2'];
                $hm[] = $rows['ball_3'];
            ?>
            <tr class="bian_tr_txt">
                <td><?=$rows['datetime']?></td>
                <td><?=$rows['qishu']?></td>
                <td><img src="/Lottery/Images/Ball_6/<?=BuLing($rows['ball_1'])?>.png"></td>
                <td><img src="/Lottery/Images/Ball_6/<?=BuLing($rows['ball_2'])?>.png"></td>
                <td><img src="/Lottery/Images/Ball_6/<?=BuLing($rows['ball_3'])?>.png"></td>
                <td><?=Jsk3_Auto($hm,1)?> / <?=Jsk3_Auto($hm,2)?> / <?=Jsk3_Auto($hm,3)?></td>
            </tr>
            <?php
            }
            ?>
      </table>
    </div>
</div>
</div>
</body>
</html>