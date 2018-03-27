<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);

$cn_begin=$_GET["cn_begin"];
$s_begin_h=$_GET["s_begin_h"];
$s_begin_i=$_GET["s_begin_i"];
$cn_begin=$cn_begin==""?date("Y-m-d",time()):$cn_begin;
$s_begin_h=$s_begin_h==""?"00":$s_begin_h;
$s_begin_i=$s_begin_i==""?"00":$s_begin_i;

$cn_end=$_GET["cn_end"];
$s_end_h=$_GET["s_end_h"];
$s_end_i=$_GET["s_end_i"];
$cn_end=$cn_end==""?date("Y-m-d",time()):$cn_end;
$s_end_h=$s_end_h==""?"23":$s_end_h;
$s_end_i=$s_end_i==""?"59":$s_end_i;

$begin_time=$cn_begin." ".$s_begin_h.":".$s_begin_i.":00";
$end_time=$cn_end." ".$s_end_h.":".$s_end_i.":59";

$zz_type=$_GET["zz_type"];
$subsub = 5;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/laydate.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
</head>
<body>
<div class="wrap">
    <?php include_once("moneysubmenu.php"); ?>
    <table cellspacing="1" cellpadding="0" border="0" class="tab1">
        <tr align="center">
            <td colspan="4" height="30">
                <form id="form1" name="form1" action="?query=true" method="get">
                    转账类型
                    <select name="zz_type" id="zz_type">
                        <option value="" <?=$zz_type==""?"selected":""?>>全部</option>
                    </select>
                    <span style="margin-left: 10px">开始日期</span>
                    <input name="cn_begin" type="text" id="cn_begin" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$cn_begin?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer"/>
                    <select name="s_begin_h" id="s_begin_h">
                        <?php
                        for($bh_i=0;$bh_i<24;$bh_i++){
                            $b_h_value=$bh_i<10?"0".$bh_i:$bh_i;
                            ?>
                            <option value="<?=$b_h_value?>" <?=$s_begin_h==$b_h_value?"selected":""?>><?=$b_h_value?></option>
                        <?php } ?>
                    </select>
                    时
                    <select name="s_begin_i" id="s_begin_i">
                        <?php
                        for($bh_j=0;$bh_j<60;$bh_j++){
                            $b_i_value=$bh_j<10?"0".$bh_j:$bh_j;
                            ?>
                            <option value="<?=$b_i_value?>" <?=$s_begin_i==$b_i_value?"selected":""?>><?=$b_i_value?></option>
                        <?php } ?>
                    </select>
                    分
                    <span style="margin-left: 10px">结束日期</span>
                    <input name="cn_end" type="text" id="cn_end" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$cn_end?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer"/>
                    <select name="s_end_h" id="s_end_h">
                        <?php
                        for($eh_i=0;$eh_i<24;$eh_i++){
                            $e_h_value=$eh_i<10?"0".$eh_i:$eh_i;
                            ?>
                            <option value="<?=$e_h_value?>" <?=$s_end_h==$e_h_value?"selected":""?>><?=$e_h_value?></option>
                        <?php } ?>
                    </select>
                    时
                    <select name="s_end_i" id="s_end_i">
                        <?php
                        for($eh_j=0;$eh_j<60;$eh_j++){
                            $e_i_value=$eh_j<10?"0".$eh_j:$eh_j;
                            ?>
                            <option value="<?=$e_i_value?>" <?=$s_end_i==$e_i_value?"selected":""?>><?=$e_i_value?></option>
                        <?php } ?>
                    </select>
                    分
                    <button type="submit" name="query" class="submit_73" style="margin-left: 10px">查询</button>
                </form>
            </td>
        </tr>
        <tr class="tic">
            <td>转账时间</td>
            <td>转账类型</td>
            <td>转账金额</td>
            <td>转换状态</td>
        </tr>
        <?php
        if($zz_type != "") {
            $sqlwhere = " and type='".$zz_type."'";
        }
        $begin_time = strtotime($begin_time);
        $end_time = strtotime($end_time);
        $sql	=	"select id from zz_info where uid=$uid ".$sqlwhere." and actionTime>='$begin_time' and actionTime<='$end_time' order by id desc";
        $query	=	$mysqli->query($sql);
        $sum	=	$mysqli->affected_rows; //总页数
        $thisPage	=	1;
        if(@$_GET['page']){
            $thisPage	=	$_GET['page'];
        }
        $page		=	new newPage();
        $perpage	=   15;
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
            $sql	=	"select * from zz_info where id in($id) order by id desc";
            $query	=	$mysqli->query($sql);
            $okmoney	=	0;
            $nomoney	=	0;
            while($rows = $query->fetch_array()) {
                ?>
                <tr class="list">
                    <td><?=date("Y-m-d H:i:s",$rows["actionTime"])?></td>
                    <td><?=$rows["info"]?></td>
                    <td><?=sprintf("%.2f",$rows["amount"])?></td>
                    <td><?=$rows["result"]?></td>
                </tr>
                <?php
                $okmoney += abs($rows["amount"]);
            }
        } else { ?>
            <tr align="center">
                <td colspan="4">暂无转账记录！</td>
            </tr>
        <?php } ?>
    </table>
    <table border="0" cellspacing="0" cellpadding="0" class="page">
        <tr>
            <td align="left">本页转账总金额：<span class="c_red"><?=sprintf("%.2f",$okmoney)?></span> RMB</td>
            <td align="right"><?=$page->get_htmlPage("zr_data_money.php?cn_begin=".$cn_begin."&s_begin_h=".$s_begin_h."&s_begin_i=".$s_begin_i."&cn_end=".$cn_end."&s_end_h=".$s_end_h."&s_end_i=".$s_end_i."&zz_type=".$zz_type);?></td>
        </tr>
    </table>
</div>
<?php include_once('../Lottery/r_bar.php') ?>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>