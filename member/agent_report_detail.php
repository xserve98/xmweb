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

$uname  =	$_GET["uname"];
if($uname != '') {
    $sql    =   "select top_uid from k_user where username='$uname' limit 1";
    $query  =   $mysqli->query($sql);
    $row    =   $query->fetch_array();
    if ($row["top_uid"] != $uid) {
        message('你不是该客户的代理，如有疑问，请联系管理员！', "agent.php");
    }
}
$time	=	$_GET["time"];
$time	=	$time==""?"EN":$time;
$bdate	=	$_GET["bdate"];
$bdate	=	$bdate==""?date("Y-m-d",time()):$bdate;
$bhour	=	$_GET["bhour"];
$bhour	=	$bhour==""?"00":$bhour;
$bsecond=	$_GET["bsecond"];
$bsecond=	$bsecond==""?"00":$bsecond;
$edate	=	$_GET["edate"];
$edate	=	$edate==""?date("Y-m-d",time()):$edate;
$ehour	=	$_GET["ehour"];
$ehour	=	$ehour==""?"23":$ehour;
$esecond=	$_GET["esecond"];
$esecond=	$esecond==""?"59":$esecond;
$btime	=	$bdate." ".$bhour.":".$bsecond.":00";
$etime	=	$edate." ".$ehour.":".$esecond.":59";
//$qiantian=	date("Y-m-d",strtotime($bdate)-24*3600);
$cz 	= 	$_GET["cz"];
if(!$cz){
	$cz[1]	=	"tyds";
	$cz[2]	=	"tycg";
	$cz[3]	=	"lhc";
	$cz[4]	=	"cqssc";
	$cz[5]	=	"gdklsf";
	$cz[6]	=	"bjsc";
	$cz[7]	=	"kl8";
	$cz[8]	=	"ssl";
	$cz[9]	=	"3d";
	$cz[10]	=	"pl3";
}

$sub = 4;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/laydate.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
    <script type="text/javascript">
        function padZero(num) {
            return ((num <= 9) ? ("0" + num) : num);
        }
        function chg_date(range,num1,num2){
            if(range=='t' || range=='w' || range=='lw'){
                form1.bdate.value ='<?=date('Y-m-d')?>';
                form1.edate.value =form1.bdate.value;
            }
            if(range!='t'){
                if(form1.bdate.value!=form1.edate.value){
                    form1.bdate.value ='<?=date('Y-m-d')?>';
                    form1.edate.value =form1.bdate.value;
                }
                var aStartDate = form1.bdate.value.split('-');
                var newStartDate = new Date(parseInt(aStartDate[0], 10),parseInt(aStartDate[1], 10) - 1,parseInt(aStartDate[2], 10) + num1);
                form1.bdate.value = newStartDate.getFullYear()+ '-' + padZero(newStartDate.getMonth() + 1)+ '-' + padZero(newStartDate.getDate());

                var aEndDate = form1.edate.value.split('-');
                var newEndDate = new Date(parseInt(aEndDate[0], 10),parseInt(aEndDate[1], 10) - 1,parseInt(aEndDate[2], 10) + num2);
                form1.edate.value = newEndDate.getFullYear()+ '-' + padZero(newEndDate.getMonth() + 1)+ '-' + padZero(newEndDate.getDate());
            }
        }
    </script>
</head>
<body>
    <div class="wrap">
        <?php include_once("agentmenu.php"); ?>
        <form name="form1" method="get" action="agent_report_detail.php">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                <tr align="center">
                    <td>
                      
                        <span>账号</span>
                        <input name="uname" type="text" size="10" maxlength="20" value="<?=$uname?>" onFocus="this.value='';" class="input_80" />
                        <span>开始日期</span>
                        <input name="bdate" type="text" id="bdate" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$bdate?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer"/>
                        <select name="bhour" id="bhour">
                            <?php
                            for($i=0;$i<24;$i++){
                                $list=$i<10?"0".$i:$i;
                                ?>
                                <option value="<?=$list?>" <?=$bhour==$list?"selected":""?>><?=$list?></option>
                            <?php } ?>
                        </select> 时
                        <select name="bsecond" id="bsecond">
                            <?php
                            for($i=0;$i<60;$i++){
                                $list=$i<10?"0".$i:$i;
                                ?>
                                <option value="<?=$list?>" <?=$bsecond==$list?"selected":""?>><?=$list?></option>
                            <?php } ?>
                        </select> 分
                        <span style="margin-left: 10px">结束日期</span>
                        <input name="edate" type="text" id="edate" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$edate?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer"/>
                        <select name="ehour" id="ehour">
                            <?php
                            for($i=0;$i<24;$i++){
                                $list=$i<10?"0".$i:$i;
                                ?>
                                <option value="<?=$list?>" <?=$ehour==$list?"selected":""?>><?=$list?></option>
                            <?php } ?>
                        </select> 时
                        <select name="esecond" id="esecond">
                            <?php
                            for($i=0;$i<60;$i++){
                                $list=$i<10?"0".$i:$i;
                                ?>
                                <option value="<?=$list?>" <?=$esecond==$list?"selected":""?>><?=$list?></option>
                            <?php } ?>
                        </select> 分
                        <?php
                        if (date(w,time())==0){
                            $num=6;
                        }else{
                            $num=date(w,time()-60*60*24);
                        }
                        ?>
                        <button type="button" onclick="chg_date('t', 0, 0)">今天</button>
                        <button type="button" onclick="chg_date('w', -<?=$num?>, 6-<?=$num?>)">本周</button>
                        <button type="button" onclick="chg_date('lw', -<?=$num?>-7, 6-<?=$num?>-7)">上周</button>
                        <button name="find" type="submit" id="find">查找</button>
                    </td>
                </tr>
                <tr align="center">
                    <td>
                        <span>彩种：</span>
                        <input name="cz[]" type="checkbox" <?=in_array("tyds",$cz)?"checked":""?> id="cz[]" value="tyds" /> 体育单式
                        <input name="cz[]" type="checkbox" <?=in_array("tycg",$cz)?"checked":""?> id="cz[]" value="tycg" /> 体育串关
                        <input name="cz[]" type="checkbox" <?=in_array("lhc",$cz)?"checked":""?> id="cz[]" value="lhc" /> 香港六合彩
                        <input name="cz[]" type="checkbox" <?=in_array("cqssc",$cz)?"checked":""?> id="cz[]" value="cqssc" /> 彩票
                        <a href="javascript:window.location.href='agent_report_detail.php';" class="c_red" style="margin-left: 10px">刷新</a>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if($time=="CN"){
            $q_btime	=	date("Y-m-d H:i:s",strtotime($btime));
            $q_etime	=	date("Y-m-d H:i:s",strtotime($etime));
        }else{
            $q_btime	=	$btime;
            $q_etime	=	$etime;
        }
        $sqlwhere	=	"";
        if($username!=""){
            $sqlwhere	.=	" and username='$uname'";//体育下注表中没有存储用户username 造成如果用户被删除，就无法获取到下注表中的下注数据
        }
        $sql_cz	=	"";
        if(in_array("tyds",$cz)) {
            ?>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                <tr class="tic f_b">
                    <td colspan="10"><?=$btime?> 至 <?=$etime?> 会员(<?=$uname?>)投注明细</td>
                </tr>
                <tr class="tic">
                    <td rowspan="2">下注时间</td>
                    <td colspan="9">体育单式注单情况</td>
                </tr>
                <tr class="tic">
                    <td>购买彩种</td>
                    <td>封盘时间</td>
                    <td>投注内容</td>
                    <td>投注金额</td>
                    <td>有效投注</td>
                    <td>赔率</td>
                    <td>输赢1</td>
                    <td>输赢2</td>
                    <td>结算</td>
                </tr>
                <?php
                //体育单式
                $sql_cz	=	"select username,bet_time as bettime,ball_sort as caizhong,match_endtime as qishu,match_name as mingxi_1,master_guest as mingxi_2,bet_info as mingxi_3,MB_Inball as mingxi_4,TG_Inball as mingxi_5,bet_money as xiazhu,if(lose_ok=1,if(status=1 or status=2 or status=4 or status=5,bet_money,0),0) as yx_xiazhu,bet_point as odds,if(lose_ok=1,(case when status=0 then 0 when status=1 or status=4 then if(ben_add=1,win-bet_money,win) when status=2 then -bet_money when status=5 then -bet_money*0.5 else 0 end),0) as win,if(status<>0,1,0) as js,if(lose_ok=1,(case status when 0 then '' when 1 then '赢' when 4 then '赢' when 2 then '输' when 5 then '输' else '取消/平' end),'未确认') as zt from k_bet k left outer join k_user u on k.uid=u.uid where status in (0,1,2,3,4,5,6,7,8) and k.bet_time>='$q_btime' and k.bet_time<='$q_etime' ".$sqlwhere;
                $zquery	=	$mysqli->query($sql_cz);
                $zsum_num			=	0;
                $zsum_bet_money	    =	0;
                $zsum_yx_bet_money	=	0;
                $zsum_win			=	0;
                while($zrow=$zquery->fetch_array()) {
                    $zsum_num            +=  1;
                    $zsum_bet_money	     +=	$zrow["xiazhu"];
                    $zsum_yx_bet_money	 +=	$zrow["yx_xiazhu"];
                    $zsum_win			 +=	$zrow["win"];
                    ?>
                    <tr class="list">
                        <td>
                            <?
                            $dt=explode(' ',$zrow["bettime"]);
                            echo $dt[0].'<br>'.$dt[1];
                            ?>
                        </td>
                        <td><?=$zrow["caizhong"]?></td>
                        <td>
                            <?
                            $dt=explode(' ',$zrow["qishu"]);
                            echo $dt[0].'<br>'.$dt[1];
                            ?>
                        </td>
                        <td><?=$zrow["mingxi_1"]?><? if($zrow["mingxi_2"]!='')echo '@'.$zrow["mingxi_2"]; ?><br />投注内容：<span class="c_red f_b"><?=$zrow['mingxi_3']?></span>；比赛结果&nbsp;<span class="c_green f_b"><?=$zrow['mingxi_4']?>:<?=$zrow['mingxi_5']?></span></td>
                        <td><?=sprintf("%.2f",$zrow["xiazhu"])?></td>
                        <td><?=sprintf("%.2f",$zrow["yx_xiazhu"])?></td>
                        <td><?=$zrow["odds"]?></td>
                        <td><?=sprintf("%.2f",$zrow["win"])?></td>
                        <td><? if($zrow["zt"]=='输') echo '<span class="c_green">输</span>'; elseif($zrow["zt"]=='赢') echo '<span class="c_red">赢</span>'; else echo $zrow["zt"];?></td>
                        <td><? if($zrow['js']==1) echo '<span class="c_green">已结算</span>'; else echo '<span class="c_red">未结算</span>'; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>合计</td>
                    <td>笔数：<?=$zsum_num?></td>
                    <td>-</td>
                    <td>-</td>
                    <td><?=sprintf("%.2f",$zsum_bet_money)?></td>
                    <td><?=sprintf("%.2f",$zsum_yx_bet_money)?></td>
                    <td>-</td>
                    <td><?=sprintf("%.2f",$zsum_win)?></td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </table>
            <?php
        }
        if(in_array("tycg",$cz)) { ?>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                <tr class="tic">
                    <td rowspan="2">下注时间</td>
                    <td colspan="9">体育串关注单情况</td>
                </tr>
                <tr class="tic">
                    <td>购买彩种</td>
                    <td>封盘时间</td>
                    <td>投注内容</td>
                    <td>投注金额</td>
                    <td>有效投注</td>
                    <td>可赢</td>
                    <td>输赢1</td>
                    <td>输赢2</td>
                    <td>结算</td>
                </tr>
                <?php
                //体育串关
                if($sql_cz!=""){
                    $sql_cz	=	"";
                }

                $sql_cz	.=	"select username,k.gid,cg_count,bet_time as bettime,match_coverdate as qishu,bet_money as xiazhu,if(status<>3,bet_money,0) as yx_xiazhu,bet_win as ky,if(status<>0 and status<>2,win,0)as win,if(status<>0 and status<>2,1,0) as js,case status when 0 then '' when 1 then '赢' when 2 then '' when 3 then '取消' else '输' end as zt from k_bet_cg_group k left outer join k_user u on k.uid=u.uid where k.gid>0 and status in (0,1,2,3,4) and k.bet_time>='$q_btime' and k.bet_time<='$q_etime' ".$sqlwhere;

                $cgquery	=	$mysqli->query($sql_cz);
                $cgsum_num			=	0;
                $cgsum_bet_money	    =	0;
                $cgsum_yx_bet_money	=	0;
                $cgsum_ky_win			=	0;
                $cgsum_win			=	0;
                while($cgrow=$cgquery->fetch_array()) {
                    $cgsum_num            +=  1;
                    $cgsum_bet_money	     +=	$cgrow["xiazhu"];
                    $cgsum_yx_bet_money	 +=	$cgrow["yx_xiazhu"];
                    $cgsum_ky_win			 +=	$cgrow["ky"];
                    $cgsum_win			 +=	$cgrow["win"];
                    ?>
                    <tr class="list">
                        <td>
                            <?
                            $dt=explode(' ',$cgrow["bettime"]);
                            echo $dt[0].'<br>'.$dt[1];
                            ?>
                        </td>
                        <td><?=$cgrow["cg_count"]?>串1</td>
                        <td>
                            <?
                            $dt=explode(' ',$cgrow["qishu"]);
                            echo $dt[0].'<br>'.$dt[1];
                            ?>
                        </td>
                        <td>
                            <?php
                            $cgsql = "select match_name as mingxi_1,master_guest as mingxi_2,bet_info as mingxi_3,MB_Inball as mingxi_4,TG_Inball as mingxi_5 from k_bet_cg where gid='".$cgrow['gid']."'";
                            $dcgquery	=	$mysqli->query($cgsql);
                            while($dcgrow=$dcgquery->fetch_array()){ ?>
                                <div><?=$dcgrow["mingxi_1"]?><? if($dcgrow["mingxi_2"]!='')echo '@'.$dcgrow["mingxi_2"]; ?><br />投注内容：<span class="c_red f_b"><?=$dcgrow['mingxi_3']?></span>；比赛结果&nbsp;<span class="c_green f_b"><?=$dcgrow['mingxi_4']?>:<?=$dcgrow['mingxi_5']?></span></div>
                            <?php } ?>
                        </td>
                        <td><?=sprintf("%.2f",$cgrow["xiazhu"])?></td>
                        <td><?=sprintf("%.2f",$cgrow["yx_xiazhu"])?></td>
                        <td><?=sprintf("%.2f",$cgrow["ky"])?></td>
                        <td><?=sprintf("%.2f",$cgrow["win"])?></td>
                        <td><? if($cgrow["zt"]=='输') echo '<span class="c_green">输</span>'; elseif($cgrow["zt"]=='赢') echo '<span class="c_red">赢</span>'; else echo $cgrow["zt"];?></td>
                        <td><? if($cgrow['js']==1) echo '<span class="c_green">已结算</span>'; else echo '<span class="c_red">未结算</span>'; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>合计</td>
                    <td>笔数：<?=$cgsum_num?></td>
                    <td>-</td>
                    <td>-</td>
                    <td><?=sprintf("%.2f",$cgsum_bet_money)?></td>
                    <td><?=sprintf("%.2f",$cgsum_yx_bet_money)?></td>
                    <td><?=sprintf("%.2f",$cgsum_ky_win)?></td>
                    <td><?=sprintf("%.2f",$cgsum_win)?></td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </table>
        <?php } ?>
        <table cellspacing="1" cellpadding="0" border="0" class="tab1">
            <tr class="tic">
                <td rowspan="2">下注时间</td>
                <td colspan="9">非体育注单情况</td>
            </tr>
            <tr class="tic">
                <td>购买彩种</td>
                <td>期数</td>
                <td>投注内容</td>
                <td>投注金额</td>
                <td>有效投注</td>
                <td>赔率</td>
                <td>输赢1</td>
                <td>输赢2</td>
                <td>结算</td>
            </tr>
            <?php
            if($sql_cz!=""){
                $sql_cz	=	"";
            }
            $sql	=	"select username,bettime,caizhong,qishu,mingxi_1,mingxi_2,mingxi_3,xiazhu,yx_xiazhu,odds,js,win,zt from (";
            //六合彩
            if(in_array("lhc",$cz)){
                if($sql_cz!=""){
                    $sql_cz	.=	" union all ";
                }
                $sql_cz	.=	"select username,addtime as bettime,type as caizhong,qishu,mingxi_1,mingxi_2,mingxi_2 as mingxi_3,money as xiazhu,if(js=1 and win=0,0,money) as yx_xiazhu,odds,js,if(js=1,if(win>0,win-money,win),0) as win,if(js=1,(case when win<0 then '输' when win=0 then '平' else '赢' end),'') as zt from c_bet where money>0 and type='香港六合彩' and addtime>='$q_btime' and addtime<='$q_etime' ".$sqlwhere;
            }
            //重庆时时彩
            if(in_array("cqssc",$cz)){
                if($sql_cz!=""){
                    $sql_cz	.=	" union all ";
                }
                $sql_cz	.=	"select username,addtime as bettime,type as caizhong,qishu,mingxi_1,mingxi_2,mingxi_2 as mingxi_3,money as xiazhu,if(js=1 and win=0,0,money) as yx_xiazhu,odds,js,if(js=1,if(win>0,win-money,win),0) as win,if(js=1,(case when win<0 then '输' when win=0 then '平' else '赢' end),'') as zt from c_bet where money>0 and type<>'香港六合彩' and addtime>='$q_btime' and addtime<='$q_etime' ".$sqlwhere;
            }

            $sql	.=	$sql_cz;
            $sql	.=	") temp";
            $query	=	$mysqli->query($sql);

            $sum_num			=	0;
            $sum_bet_money	    =	0;
            $sum_yx_bet_money	=	0;
            $sum_win			=	0;
            while($row=$query->fetch_array()) {
                $sum_num            +=  1;
                $sum_bet_money	    +=	$row["xiazhu"];
                $sum_yx_bet_money	+=	$row["yx_xiazhu"];
                $sum_win			+=	$row["win"];
                ?>
                <tr class="list">
                    <td>
                        <?
                        $dt=explode(' ',$row["bettime"]);
                        echo $dt[0].'<br>'.$dt[1]
                        ?>
                    </td>
                    <td><?=$row["caizhong"]?></td>
                    <td><?=$row["qishu"]?></td>
                    <td><?=$row["mingxi_1"]?><? if($row["mingxi_2"]!='')echo '@'.$row["mingxi_2"]; ?><? if($row["mingxi_3"]!=$row["mingxi_2"]) echo '@'.$row["mingxi_3"]; ?></td>
                    <td><?=sprintf("%.2f",$row["xiazhu"])?></td>
                    <td><?=sprintf("%.2f",$row["yx_xiazhu"])?></td>
                    <td><?=sprintf("%.2f",$row["odds"])?></td>
                    <td><?=sprintf("%.2f",$row["win"])?></td>
                    <td><? if($row["zt"]=='输') echo '<span class="c_green">输</span>'; elseif($row["zt"]=='赢') echo '<span class="c_red">赢</span>'; else echo $row["zt"];?></td>
                    <td><? if($row['js']==1) echo '<span class="c_green">已结算</span>'; else echo '<span class="c_red">未结算</span>'; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td>合计</td>
                <td>笔数：<?=$sum_num?></td>
                <td>-</td>
                <td>-</td>
                <td><?=sprintf("%.2f",$sum_bet_money)?></td>
                <td><?=sprintf("%.2f",$sum_yx_bet_money)?></td>
                <td>-</td>
                <td><?=sprintf("%.2f",$sum_win)?></td>
                <td>-</td>
                <td>-</td>
            </tr>
        </table>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>