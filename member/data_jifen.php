<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
ini_set('display_errors','yes');
include_once("function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);

$subsub = 4;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
</head>
<body>
<div class="wrap">
    <?php include_once("moneysubmenu.php"); ?>
    <table cellspacing="1" cellpadding="0" border="0" class="tab1">
        <tr class="tic">
            <td width="20%">编号</td>
            <td width="15%">兑换时间</td>
            <td width="15%">流水号</td>
            <td width="10%">兑换积分</td>
            <td width="10%">增加金额</td>
            <td width="10%">状态</td>
        </tr>
        <?php
        $sql	=	"select m_id from k_jifen where uid=$uid and type=3 order by m_id desc";
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
		$sum_money = 0;
        $start	=	($thisPage-1)*$perpage+1;
        $end	=	$thisPage*$perpage;
        while($row = $query->fetch_array()){
            if($i >= $start && $i <= $end){
                $id .=	$row['m_id'].',';
            }
            if($i > $end) break;
            $i++;
        }
        if($id) {
            $id		=	rtrim($id,',');
            $sql	=	"select * from k_jifen where m_id in ($id) order by m_id desc";
            $query	=	$mysqli->query($sql);
            $inmoney	=	0;
            $outmoney	=	0;
            while($rows = $query->fetch_array()) {
                ?>
                <tr class="list">
                    <td><?=$rows["m_id"]?></td>
                    <td><?=date("Y-m-d H:i:s",strtotime($rows["m_make_time"]))?></td>
                    <td><?=$rows["m_order"]?></td>
                    <td><?=sprintf("%.2f",abs($rows["m_value"]))?></td>
                    <td><?=sprintf("%.2f",abs($rows["m_value"]))?></td>
                    <td>
                        <?php
                        if($rows["status"] == 1) {
                            $sum_money += abs($rows["m_value"]);
                            echo '<span class="c_red">成功</span>';
                        } else if($rows["status"] == 0) {
                            echo '<span>失败</span>';
                        } else {
                            echo '<span class="c_blue">系统审核中</span>';
                        }
                        ?>
                    </td>
                </tr>
        <?php
            }
        } else { ?>
            <tr align="center">
                <td colspan="6">暂无积分兑换记录！</td>
            </tr>
        <?php } ?>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" class="page">
        <tr>
            <td align="left">本页兑换总金额：<span class="c_red"><?=sprintf("%.2f",$sum_money)?></span> RMB</td>
            <td align="right"><?=$page->get_htmlPage("data_jifen.php?")?></td>
        </tr>
    </table>
</div>
<?php include_once('../Lottery/r_bar.php') ?>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>
