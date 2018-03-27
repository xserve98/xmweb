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

$money = 0;
$ky = 0;
$jine = 0;
$sub = 2;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>交易记录彩票</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
</head>
<body>
<div class="wrap">
    <?php include_once("recordmenu.php"); ?>
    <div class="content">
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr class="tic">
                <td width="15%">彩种/投注时间</td>
                <td width="15%">注单号/模式</td>
                <td width="20%">投注详细信息</td>
                <td width="15%">下注金额</td>
                <td>结果</td>
                <td>可赢</td>
            </tr>
            <?php
            $sql = "select id from c_bet where uid=$uid and js=0 order by addtime desc";
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
                    $id .=	$row['id'].',';
                }
                if($i > $end) break;
                $i++;
            }
            if(!$id) {
                ?>
                <tr align="center">
                    <td colspan="6">暂无记录！</td>
                </tr>
                <?php
            } else {
                $id = rtrim($id,',');
                $sql = "select * from c_bet where id in($id) order by id desc";
                $query	=	$mysqli->query($sql);
                while($rows = $query->fetch_array()){
                    $money += $rows["money"];
                    $ky += $rows["win"] + $rows["fs"];
                    ?>
                    <tr class="list">
                        <td><?= $rows['type'] ?><br/><?php echo date('m-d H:i:s', strtotime($rows["addtime"])); ?></td>
                        <td><?= $rows["id"] ?><br/>第 <?= $rows["qishu"] ?> 期</td>
                        <td>
                            <? if ($rows['type'] == '香港六合彩') { ?>
                                <?= $rows["mingxi_1"] ?><?= $rows["sm"] ? '(' . $rows["sm"] . ')' : '' ?><br><span class="c_red"><?= $rows["mingxi_2"] ?></span> @ <span class="c_red"><?= $rows["odds"] ?></span>
                            <? } else { ?>
                                <?= $rows["mingxi_1"] ?>【<span class="c_red"><?= $rows["mingxi_2"] ?></span>】 @ <span class="c_red"><?= $rows["odds"] ?></span>
                            <? } ?>
                        </td>
                        <td><?= $rows["money"] ?></td>
                        <td><?= $rows["jieguo"] ? $rows["jieguo"] : '未知' ?></td>
                        <td>
                            <?php
                            $jine = 0;
                            $jine = $rows["win"] + $rows["fs"];
                            echo double_format($jine);
                            ?>
                        </td>
                    </tr>
                <?php
                }
            } ?>
        </table>
        <table cellspacing="0" cellpadding="0" border="0" class="page">
            <tr>
                <td align="left">本页总投注金额：<span class="c_red"><?= $money ?></span> RMB，最高可赢金额：<span class="c_red"><?= double_format($ky) ?></span> RMB</td>
                <td align="right"><?=$page->get_htmlPage('record_ss.php?');?></td>
            </tr>
        </table>
    </div>
</div>
<?php include_once('../Lottery/r_bar.php') ?>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>