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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="/newdsn/css/table.css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script language="JavaScript" src="/js/calendar.js"></script>
<script type="text/javascript" src="/default/js/skin.js"></script>
<script type="text/javascript" src="images/member.js"></script>
</head>
<body class="skin_blue">
<div class="main report">
<div class="search">

</div> 
<table class="list table">
<thead><tr><th>注单号</th><th>时间</th><th>类型</th><th>玩法</th><th>下注金额</th><th>可赢金额</th></tr></thead>
<tbody>
<?php
            $sql = "select id from c_bet where uid=$uid and js=0 order by addtime desc";
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
               <tr><td class="nodata" colspan="8">暂无数据!</td></tr> 
                  <?php
            } else {
                $id = rtrim($id,',');
                $sql = "select * from c_bet where id in($id) order by id desc";
                $query	=	$mysqli->query($sql);
                while($rows = $query->fetch_array()){
                    $money += $rows["money"];
                    $ky += $rows["win"] + $rows["fs"];
                    ?>


<tr class="">
<td><?= $rows["id"] ?></td>
<td class="time"><?= $rows["addtime"] ?></td>
<td class="period"><span class="lottery"><?= $rows["type"] ?></span><br><span class="draw_number">第 <?= $rows["qishu"] ?> 期</span></td>
<td class="contents"><span class="text"><?= $rows["mingxi_1"] ?> <?= $rows["mingxi_2"] ?></span> @ <span class="odds"><?= $rows["odds"] ?></span></td>
<td class="amount"><?= $rows["money"] ?></td>
<td class="result color minus"><?= $rows["win"] ?></td>
</tr>
    <?php
                }
            } ?>

</tbody>
<tfoot>
<tr><td></td><td></td><th>总计</th><td></td><td><?= $money ?></td><td class="result color"><?= double_format($ky) ?></td></tr>
</tfoot>
</table>
<div style="font-size: 16px;text-align: center;margin-top: 12px;">
<?=$page->get_htmlPage('record_ss.php?');?>
	</div>
<div class="page_info">
</div>
</div>
<p>&nbsp;</p>
</body>
</html>