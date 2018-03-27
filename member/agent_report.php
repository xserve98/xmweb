<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     	= 	$_SESSION['uid'];
$loginid 	= 	$_SESSION['user_login_id'];
$username	=	$_SESSION["username"];
renovate($uid,$loginid);

if(!user::is_daili($uid)){
    message('你还不是代理，请先申请！', "agent_reg.php");
}

function getlastmonth($date){
	$firstday 	= 	date('Y-m-01', strtotime("$date -1 month"));
	$lastday 	= 	date('Y-m-d', strtotime("$firstday +1 month -1 day"));
	return array($firstday,$lastday);
}
$lastmonth	=	getlastmonth(date("Y-m-d",time()));

$cn_begin=$_GET["cn_begin"];
$s_begin_h=$_GET["s_begin_h"];
$s_begin_i=$_GET["s_begin_i"];
$cn_begin=$cn_begin==""?$lastmonth[0]:$cn_begin;
$s_begin_h=$s_begin_h==""?"00":$s_begin_h;
$s_begin_i=$s_begin_i==""?"00":$s_begin_i;

$cn_end=$_GET["cn_end"];
$s_end_h=$_GET["s_end_h"];
$s_end_i=$_GET["s_end_i"];
$cn_end=$cn_end==""?$lastmonth[1]:$cn_end;
$s_end_h=$s_end_h==""?"23":$s_end_h;
$s_end_i=$s_end_i==""?"59":$s_end_i;

$begin_time=$cn_begin." ".$s_begin_h.":".$s_begin_i.":00";
$end_time=$cn_end." ".$s_end_h.":".$s_end_i.":59";

$cn_begin_time	=	date("Y-m-d H:i:s",strtotime($begin_time));
$cn_end_time	=	date("Y-m-d H:i:s",strtotime($end_time));

$rate_ty	=	$_GET["rate_ty"];
$rate_ty	=	$rate_ty==""?"20":$rate_ty;
$rate_lh	=	$_GET["rate_lh"];
$rate_lh	=	$rate_lh==""?"10":$rate_lh;
$rate_ss	=	$_GET["rate_ss"];
$rate_ss	=	$rate_ss==""?"20":$rate_ss;
$rate_pt	=	$_GET["rate_pt"];
$rate_pt	=	$rate_pt==""?"20":$rate_pt;
$rate_zr	=	$_GET["rate_zr"];
$rate_zr	=	$rate_zr==""?"10":$rate_zr;

$sub = 3;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        <?php include_once("agentmenu.php"); ?>
        <table cellspacing="1" cellpadding="0" border="0" class="tab1">
            <form id="form1" name="form1" action="?query=true" method="get">
                <tr align="center">
                    <td colspan="12" height="30">
                        <span>开始日期</span>
                        <input name="cn_begin" type="text" id="cn_begin" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$cn_begin?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />
                        <select name="s_begin_h" id="s_begin_h">
                            <?php
                            for($bh_i=0;$bh_i<24;$bh_i++){
                                $b_h_value=$bh_i<10?"0".$bh_i:$bh_i;
                                ?>
                                <option value="<?=$b_h_value?>" <?=$s_begin_h==$b_h_value?"selected":""?>><?=$b_h_value?></option>
                            <?php } ?>
                        </select> 时
                        <select name="s_begin_i" id="s_begin_i">
                            <?php
                            for($bh_j=0;$bh_j<60;$bh_j++){
                                $b_i_value=$bh_j<10?"0".$bh_j:$bh_j;
                                ?>
                                <option value="<?=$b_i_value?>" <?=$s_begin_i==$b_i_value?"selected":""?>><?=$b_i_value?></option>
                            <?php } ?>
                        </select> 分
                        <span style="margin-left: 15px">结束日期</span>
                        <input name="cn_end" type="text" id="cn_end" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$cn_end?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />
                        <select name="s_end_h" id="s_end_h">
                            <?php
                            for($eh_i=0;$eh_i<24;$eh_i++){
                                $e_h_value=$eh_i<10?"0".$eh_i:$eh_i;
                                ?>
                                <option value="<?=$e_h_value?>" <?=$s_end_h==$e_h_value?"selected":""?>><?=$e_h_value?></option>
                            <?php } ?>
                        </select> 时
                        <select name="s_end_i" id="s_end_i">
                            <?php
                            for($eh_j=0;$eh_j<60;$eh_j++){
                                $e_i_value=$eh_j<10?"0".$eh_j:$eh_j;
                                ?>
                                <option value="<?=$e_i_value?>" <?=$s_end_i==$e_i_value?"selected":""?>><?=$e_i_value?></option>
                            <?php } ?>
                        </select> 分
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="12" height="30">
                        <span>体育比例</span>
                        <input name="rate_ty" type="text" id="rate_ty" value="<?=$rate_ty?>" size="2" maxlength="3" class="input_80" style="width: 25px" /> %
                        <span>六合彩比例</span>
                        <input name="rate_lh" type="text" id="rate_lh" value="<?=$rate_lh?>" size="2" maxlength="3" class="input_80" style="width: 25px" /> %
                        <span>彩票比例</span>
                        <input name="rate_ss" type="text" id="rate_ss" value="<?=$rate_ss?>" size="2" maxlength="3" class="input_80" style="width: 25px" /> %
                        <span>真人比例</span>
                        <input name="rate_zr" type="text" id="rate_zr" value="<?=$rate_zr?>" size="2" maxlength="3" class="input_80" style="width: 25px" /> %
                        <button type="submit" name="query" class="submit_73" style="margin-left: 15px">计算</button>
                    </td>
                </tr>
            </form>
            <tr class="tic f_b">
                <td colspan="12" align="center"><?=$begin_time?> 至 <?=$end_time?> 下线会员财务报表</td>
            </tr>
            <tr class="tic">
                <td colspan="4">常规存取款</td>
                <td colspan="3">红利派送</td>
                <td rowspan="2">其他情况</td>
                <td colspan="2">手续费(银行转账费用)</td>
                <td colspan="2">真人转账</td>
            </tr>
            <tr class="tic">
                <td>存款</td>
                <td>汇款</td>
                <td>人工汇款</td>
                <td>提款</td>
                <td>汇款赠送</td>
                <td>彩金派送</td>
                <td>反水派送</td>
                <td>第三方(1%)</td>
                <td>提款手续费</td>
                <td>转入</td>
                <td>转出</td>
            </tr>
            <?php
            $sql	=	"select sum(t1_value) as t1_value,sum(t2_value) as t2_value,sum(t3_value) as t3_value,sum(t4_value) as t4_value,sum(t5_value) as t5_value,sum(t6_value) as t6_value,sum(t1_sxf) as t1_sxf,sum(t2_sxf) as t2_sxf,sum(h_value) as h_value,sum(h_zsjr) as h_zsjr,sum(inmoney) as inmoney,sum(outmoney) as outmoney from (";
            //查询存取款记录
            $sql	.=	"select sum(if(m.type=1,m.m_value,0)) as t1_value,sum(if(m.type=2,m.m_value,0)) as t2_value,sum(if(m.type=3,m.m_value,0)) as t3_value,sum(if(m.type=4,m.m_value,0)) as t4_value,sum(if(m.type=5,m.m_value,0)) as t5_value,sum(if(m.type=6,m.m_value,0)) as t6_value,sum(if(m.type=1,m.sxf,0)) as t1_sxf,sum(if(m.type=2,m.sxf,0)) as t2_sxf,0 as h_value, 0 as h_zsjr,0 as inmoney,0 as outmoney from k_money m left outer join k_user u on m.uid=u.uid where m.status=1 and u.top_uid=$uid and m.m_make_time>='$begin_time' and m.m_make_time<='$end_time'";
            $sql	.=	" union all ";
            //查询汇款金额
            $sql	.=	"select 0 as t1_value,0 as t2_value,0 as t3_value,0 as t4_value,0 as t5_value,0 as t6_value,0 as t1_sxf,0 as t2_sxf,sum(ifnull(h.money,0)) as h_value,sum(ifnull(h.zsjr,0)) as h_zsjr,0 as inmoney,0 as outmoney from huikuan h left outer join k_user u on h.uid=u.uid where h.status=1 and u.top_uid=$uid and h.adddate>='$begin_time' and h.adddate<='$end_time'";
            //查询真人
            $sql	.=	" union all ";
            $sql	.=	"select 0 as t1_value,0 as t2_value,0 as t3_value,0 as t4_value,0 as t5_value,0 as t6_value,0 as t1_sxf,0 as t2_sxf,0 as h_value,0 as h_zsjr,sum(if(z.zz_type='d',z.zz_money,0)) as inmoney,sum(if(z.zz_type='w',z.zz_money,0)) as outmoney from ag_zhenren_zz z left outer join k_user u on z.uid=u.uid where u.top_uid=$uid and z.live_type='AG' and z.ok=1 and z.zz_time>='$begin_time' and z.zz_time<='$end_time'";
            $sql	.=	")temp";
            $query	=	$mysqli->query($sql);
            while($row=$query->fetch_array()) {
                //查询返水
                $sql_fs="SELECT SUM(fs) as fs FROM c_bet where uid IN (SELECT uid FROM k_user where top_uid='".$uid."') and addtime>='$begin_time' and addtime<='$end_time' and js=1";
                $query_fs	=	$mysqli->query($sql_fs);
                $row_fs=$query_fs->fetch_array();
                $row["t5_value"]=$row_fs['fs'];

                $sql_fs="SELECT SUM(fs) as fs FROM k_bet where uid IN (SELECT uid FROM k_user where top_uid='".$uid."') and bet_time>='$begin_time' and bet_time<='$end_time' and lose_ok=1 and status in (0,1,2,3,4,5,6,7,8)";
                $query_fs	=	$mysqli->query($sql_fs);
                $row_fs=$query_fs->fetch_array();
                $row["t5_value"]+=$row_fs['fs'];
                $zr_yongjin	=	($row["inmoney"]-$row["outmoney"])*$rate_zr/100;
                $feiyong	=	$row["h_zsjr"]+$row["t4_value"]+$row["t5_value"]+$row["t1_sxf"]+$row["t2_sxf"];
                ?>
                <tr class="list">
                    <td><?=sprintf("%.2f",$row["t1_value"])?></td>
                    <td><?=sprintf("%.2f",$row["h_value"])?></td>
                    <td><?=sprintf("%.2f",$row["t3_value"])?></td>
                    <td><?=sprintf("%.2f",abs($row["t2_value"]))?></td>
                    <td><?=sprintf("%.2f",$row["h_zsjr"])?></td>
                    <td><?=sprintf("%.2f",$row["t4_value"])?></td>
                    <td><?=sprintf("%.2f",$row["t5_value"])?></td>
                    <td><?=sprintf("%.2f",$row["t6_value"])?></td>
                    <td><?=sprintf("%.2f",$row["t1_sxf"])?></td>
                    <td><?=sprintf("%.2f",$row["t2_sxf"])?></td>
                    <td><?=sprintf("%.2f",$row["inmoney"])?></td>
                    <td><?=sprintf("%.2f",$row["outmoney"])?></td>
                </tr>
            <?php } ?>
        </table>
        <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
            <tr class="tic f_b">
                <td colspan="9" align="center"><?=$begin_time?> 至 <?=$end_time?> 下线会员投注报表</td>
            </tr>
            <tr class="tic">
                <td colspan="2">体育</td>
                <td colspan="2">六合彩</td>
                <td colspan="2">彩票</td>
                <td colspan="3">合计</td>
            </tr>
            <tr class="tic">
                <td>下注金额</td>
                <td>盈亏</td>
                <td>下注金额</td>
                <td>盈亏</td>
                <td>下注金额</td>
                <td>盈亏</td>
                <td>下注金额</td>
                <td>盈亏</td>
                <td>代理佣金</td>
            </tr>
            <?php
            $sql	=	"select sum(ty_num) as ty_num,sum(ty_bet_money) as ty_bet_money,sum(ty_yingkui) as ty_yingkui,sum(lh_num) as lh_num,sum(lh_bet_money) as lh_bet_money,sum(lh_yingkui) as lh_yingkui,sum(ss_num) as ss_num,sum(ss_bet_money) as ss_bet_money,sum(ss_yingkui) as ss_yingkui,sum(pt_num) as pt_num,sum(pt_bet_money) as pt_bet_money,sum(pt_yingkui) as pt_yingkui from (";
            //体育单式
            $sql_cz	=	"select if(status<>0,1,0) as ty_num,if(status<>0,bet_money,0) as ty_bet_money,if(status<>0,bet_money-win-fs,0) as ty_yingkui,0 as lh_num,0 as lh_bet_money,0 as lh_yingkui,0 as ss_num,0 as ss_bet_money,0 as ss_yingkui,0 as pt_num,0 as pt_bet_money,0 as pt_yingkui from k_bet k left outer join k_user u on k.uid=u.uid where lose_ok=1 and status in (0,1,2,3,4,5,6,7,8) and u.top_uid=$uid and k.bet_time>='$begin_time' and k.bet_time<='$end_time' ";
            //体育串关
            $sql_cz	.=	" union all ";
            $sql_cz	.=	"select if(status<>0 and status<>2,1,0) as ty_num,if(status<>0 and status<>2,bet_money,0) as ty_bet_money,if(status<>0 and status<>2,bet_money-win-fs,0) as ty_yingkui,0 as lh_num,0 as lh_bet_money,0 as lh_yingkui,0 as ss_num,0 as ss_bet_money,0 as ss_yingkui,0 as pt_num,0 as pt_bet_money,0 as pt_yingkui from k_bet_cg_group k left outer join k_user u on k.uid=u.uid where k.gid>0 and status in (0,1,2,3,4) and u.top_uid=$uid and k.bet_time>='$begin_time' and k.bet_time<='$end_time' ";
            //六合彩
            $sql_cz	.=	" union all ";
            $sql_cz	.=	"select 0 as ty_num,0 as ty_bet_money,0 as ty_yingkui,if(js=1,1,0) as lh_num,if(js=1,k.money,0) as lh_bet_money,if(js=1,(case when k.win<0 then k.money when k.win=0 then 0 else k.money-k.win end),0) as lh_yingkui,0 as ss_num,0 as ss_bet_money,0 as ss_yingkui,0 as pt_num,0 as pt_bet_money,0 as pt_yingkui from c_bet k left outer join k_user u on k.username=u.username where k.money>0 and k.type='香港六合彩' and u.top_uid=$uid and k.addtime>='$begin_time' and k.addtime<='$end_time' ";
            //重庆时时彩
            $sql_cz	.=	" union all ";
            $sql_cz	.=	"select 0 as ty_num,0 as ty_bet_money,0 as ty_yingkui,0 as lh_num,0 as lh_bet_money,0 as lh_yingkui,if(js=1,1,0) as ss_num,if(js=1,k.money,0) as ss_bet_money,if(js=1,(case when k.win<0 then k.money when k.win=0 then 0 else k.money-k.win end),0) as ss_yingkui,0 as pt_num,0 as pt_bet_money,0 as pt_yingkui from c_bet k left outer join k_user u on k.username=u.username where k.money>0 and k.type<>'香港六合彩' and u.top_uid=$uid and k.addtime>='$begin_time' and k.addtime<='$end_time' ";
            $sql	.=	$sql_cz;
            $sql	.=	") temp";
            $query	=	$mysqli->query($sql);
            while($row=$query->fetch_array()) {
                $bet_money	=	$row["ty_bet_money"]+$row["lh_bet_money"]+$row["ss_bet_money"]+$row["pt_bet_money"];
                $yingkui	=	$row["ty_yingkui"]+$row["lh_yingkui"]+$row["ss_yingkui"]+$row["pt_yingkui"];
                $yongjin	=	$row["ty_yingkui"]*$rate_ty/100+$row["lh_yingkui"]*$rate_lh/100+$row["ss_yingkui"]*$rate_ss/100+$row["pt_yingkui"]*$rate_pt/100+$zr_yongjin-$feiyong;
                $yongjin	=	$yongjin<0?0:$yongjin;
                ?>
                <tr class="list">
                    <td><?=sprintf("%.2f",$row["ty_bet_money"])?></td>
                    <td class="<?=$row["ty_yingkui"]>=0?'c_red':'c_green'?>"><?=sprintf("%.2f",$row["ty_yingkui"])?></td>
                    <td><?=sprintf("%.2f",$row["lh_bet_money"])?></td>
                    <td class="<?=$row["lh_yingkui"]>=0?'c_red':'c_green'?>"><?=sprintf("%.2f",$row["lh_yingkui"])?></td>
                    <td><?=sprintf("%.2f",$row["ss_bet_money"])?></td>
                    <td class="<?=$row["ss_yingkui"]>=0?'c_red':'c_green'?>"><?=sprintf("%.2f",$row["ss_yingkui"])?></td>
                    <td><?=sprintf("%.2f",$bet_money)?></td>
                    <td class="<?=$yingkui>=0?'c_red':'c_green'?>"><?=sprintf("%.2f",$yingkui)?></td>
                    <td class="<?=$yongjin>=0?'c_red':'c_green'?>"><?=sprintf("%.2f",$yongjin)?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="9">
                    <p class="f_b">计算说明：</p>
                    <p>1、代理佣金=体育盈亏×体育比例+六合彩盈亏×六合彩比例+彩票盈亏×彩票比例+(转入-转出)×真人比例-红利派送-手续费</p>
                    <p>2、如果按照①的公式计算结果小于0，则代理佣金为0</p>
                    <p>3、佣金比例可自行调整</p>
                    <p>4、如有特殊代理合作方式，可依据以上相关统计数据自行计算佣金</p>
                    <p>5、合作双方如有其它约定，不在本报表中体现</p>
                </td>
            </tr>
        </table>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>
