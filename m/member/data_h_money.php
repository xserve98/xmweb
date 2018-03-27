<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$userinfo=user::getinfo($_SESSION["uid"]);

$subsub = 2;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$web_site['web_title']?></title>
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
            <?php include_once("moneysubmenu.php"); ?>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                <tr class="tic">
                    <td width="33.333%">汇款时间</td>
                    <td width="33.333%">充值金额</td>
                    <td width="33.333%">状态</td>
                </tr>
                <?php
                $sql	=	"select id from huikuan where uid=$uid order by id desc";
                $query	=	$mysqli->query($sql);
                $sum	=	$mysqli->affected_rows; //总页数
                $thisPage	=	1;
                if(@$_GET['page']){
                    $thisPage	=	$_GET['page'];
                }
                $page		=	new newPage();
                $perpage	= 	15;
                $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
                $id		=	'';
                $i		=	1; //记录 uid 数
                $start	=	($thisPage-1)*$perpage+1;
                $end	=	$thisPage*$perpage;
                while($row = $query->fetch_array()){
                    if($i >= $start && $i <= $end){
                        $id .=	$row['id'].',';
                    }
                    if($i > $end) break;
                    $i++;
                }
                if($id) {
                    $id		=	rtrim($id,',');
                    $sql	=	"select * from huikuan where id in($id) order by id desc";
                    $query	=	$mysqli->query($sql);
                    $sum_money	=	0;
                    $sum_zsjr	=	0;
                    while($rows = $query->fetch_array()) {
                        ?>
                        <tr class="list f_12">
                            <td><?=date("Y-m-d H:i:s",strtotime($rows["adddate"]))?></td>
                            <td>
                                <span><?=sprintf("%.2f",$rows["money"])?></span>
                                <hr>
                                <span class="c_green"><?=sprintf("%.2f",$rows["zsjr"])?></span> @ <span class="c_blue"><?=sprintf("%.2f",$rows["jifen"])?></span>
                            </td>
                            <td>
                                <?php
                                if($rows["status"] == 1) {
                                    $sum_money += $rows["money"];
                                    $sum_zsjr += $rows["zsjr"];
                                    echo '<span class="c_red">已成功</span>';
                                } else if($rows["status"] == 2) {
                                    echo '<span>已失败</span>';
                                } else {
                                    echo '<span class="c_blue">审核中</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else { ?>
                    <tr align="center">
                        <td colspan="3">暂无汇款记录！</td>
                    </tr>
                <?php } ?>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" class="page">
                <tr>
                    <td align="right"><?=$page->get_htmlPage("data_h_money.php?")?></td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>
