<?php
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
check_quanxian("bbgl");
//ini_set('display_errors','yes');
function getlastmonth($date){
	$firstday 	= 	date('Y-m-01', strtotime("$date -1 month"));
	$lastday 	= 	date('Y-m-d', strtotime("$firstday +1 month -1 day"));
	return array($firstday,$lastday);
}
$lastmonth	=	getlastmonth(date("Y-m-d",time()));

$time	=	$_GET["time"];
$time	=	$time==""?"EN":$time;
$bdate	=	$_GET["bdate"];
$bdate	=	$bdate==""?$lastmonth[0]:$bdate;
$bhour	=	$_GET["bhour"];
$bhour	=	$bhour==""?"00":$bhour;
$bsecond=	$_GET["bsecond"];
$bsecond=	$bsecond==""?"00":$bsecond;
$edate	=	$_GET["edate"];
$edate	=	$edate==""?$lastmonth[1]:$edate;
$ehour	=	$_GET["ehour"];
$ehour	=	$ehour==""?"23":$ehour;
$esecond=	$_GET["esecond"];
$esecond=	$esecond==""?"59":$esecond;
$btime	=	$bdate." ".$bhour.":".$bsecond.":00";
$etime	=	$edate." ".$ehour.":".$esecond.":59";
$username=	$_GET["username"];
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
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome</title>
	<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
	<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
	<script language="JavaScript" src="/js/calendar.js"></script>
</head>
<body>
<div id="pageMain">
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="font12" style="border:1px solid #798EB9;">
		<form name="form1" method="get" action="">
		<tr bgcolor="#FFFFFF">
			<td align="left">
				<select name="time" id="time" disabled="disabled">
					<option value="CN" <?=$time=='CN' ? 'selected' : ''?>>中国时间</option>
					<option value="EN" <?=$time=='EN' ? 'selected' : ''?>>美东时间</option>
				</select>
				&nbsp;开始日期
				<input name="bdate" type="text" id="bdate" value="<?=$bdate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
				<select name="bhour" id="bhour">
					<?php
					for($i=0;$i<24;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$bhour==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;时
				<select name="bsecond" id="bsecond">
					<?php
					for($i=0;$i<60;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$bsecond==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;分
				&nbsp;结束日期
				<input name="edate" type="text" id="edate" value="<?=$edate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
				<select name="ehour" id="ehour">
					<?php
					for($i=0;$i<24;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$ehour==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;时
				<select name="esecond" id="esecond">
					<?php
					for($i=0;$i<60;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$esecond==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;分
			</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td align="left">
				&nbsp;体育比例
				<input name="rate_ty" type="text" id="rate_ty" value="<?=$rate_ty?>" size="2" maxlength="3"/>&nbsp;%
				&nbsp;六合彩比例
				<input name="rate_lh" type="text" id="rate_lh" value="<?=$rate_lh?>" size="2" maxlength="3"/>&nbsp;%
				&nbsp;彩票比例
				<input name="rate_ss" type="text" id="rate_ss" value="<?=$rate_ss?>" size="2" maxlength="3"/>&nbsp;%
				&nbsp;真人比例
				<input name="rate_zr" type="text" id="rate_zr" value="<?=$rate_zr?>" size="2" maxlength="3"/>&nbsp;%
				&nbsp;代理账号
				<input name="username" type="text" id="username" value="<?=$username?>" size="15" maxlength="20"/>
				&nbsp;<input name="find" type="submit" id="find" value="计算"/>
			</td>
		</tr>
		</form>
	</table>
	<?php
	$color 	=	"#FFFFFF";
	$over	=	"#EBEBEB";
	$out	=	"#ffffff";
		
	if($time=="CN"){
		$q_btime	=	date("Y-m-d H:i:s",strtotime($btime));
		$q_etime	=	date("Y-m-d H:i:s",strtotime($etime));
	}else{
		$q_btime	=	$btime;
		$q_etime	=	$etime;
	}
	$cn_q_btime	=	date("Y-m-d H:i:s",strtotime($btime));
	$cn_q_etime	=	date("Y-m-d H:i:s",strtotime($etime));
	
	$sqlwhere	=	"";
	if($username!=""){
		$sql	=	"select u.uid,u.username from k_user u left outer join k_user tu on u.top_uid=tu.uid where u.top_uid>0 and tu.username='$username' and tu.is_daili=1";
		$query	=	$mysqli->query($sql);
		$uids="";
		$usernames="";
		while($row=$query->fetch_array()){
			$uids		.=	$row["uid"].",";
			$usernames	.=	"'".$row["username"]."',";
		}
		$uids		=	rtrim($uids,',');
		$usernames	=	rtrim($usernames,',');
		if($usernames!=""){
			$sqlwhere	=	" and u.uid in ($uids)";
		}else{
			$sqlwhere	=	" and 1=2";
		}
	}
	
	$sql	=	"select tm.*,u.username,(select count(1) from k_user where top_uid=tm.top_uid) as top_num from (";
	$sql	.=	"select top_uid,money,sum(t1_value) as t1_value,sum(t2_value) as t2_value,sum(t3_value) as t3_value,sum(t4_value) as t4_value,sum(t5_value) as t5_value,sum(t6_value) as t6_value,sum(t1_sxf) as t1_sxf,sum(t2_sxf) as t2_sxf,sum(h_value) as h_value,sum(h_zsjr) as h_zsjr,sum(inmoney) as inmoney,sum(outmoney) as outmoney from (";
	//查询存取款记录
	$sql	.=	"select u.top_uid,u.money,sum(if(m.type=1,m.m_value,0)) as t1_value,sum(if(m.type=2,m.m_value,0)) as t2_value,sum(if(m.type=3,m.m_value,0)) as t3_value,sum(if(m.type=4,m.m_value,0)) as t4_value,sum(if(m.type=5,m.m_value,0)) as t5_value,sum(if(m.type=6,m.m_value,0)) as t6_value,sum(if(m.type=1,m.sxf,0)) as t1_sxf,sum(if(m.type=2,m.sxf,0)) as t2_sxf,0 as h_value, 0 as h_zsjr,0 as inmoney,0 as outmoney from k_money m left outer join k_user u on m.uid=u.uid where m.status=1 and u.top_uid>0 and m.m_make_time>='$q_btime' and m.m_make_time<='$q_etime' ".$sqlwhere." group by u.top_uid";
	$sql	.=	" union all ";
	//查询汇款金额	
	$sql	.=	"select u.top_uid,u.money,0 as t1_value,0 as t2_value,0 as t3_value,0 as t4_value,0 as t5_value,0 as t6_value,0 as t1_sxf,0 as t2_sxf,sum(ifnull(h.money,0)) as h_value,sum(ifnull(h.zsjr,0)) as h_zsjr,0 as inmoney,0 as outmoney from huikuan h left outer join k_user u on h.uid=u.uid where h.status=1 and u.top_uid>0 and h.adddate>='$q_btime' and h.adddate<='$q_etime' ".$sqlwhere." group by u.top_uid";
	//查询真人
	$sql	.=	" union all ";
	$sql	.=	"select u.top_uid,u.money,0 as t1_value,0 as t2_value,0 as t3_value,0 as t4_value,0 as t5_value,0 as t6_value,0 as t1_sxf,0 as t2_sxf,0 as h_value,0 as h_zsjr,sum(if(z.zz_type='d',z.zz_money,0)) as inmoney,sum(if(z.zz_type='w',z.zz_money,0)) as outmoney from ag_zhenren_zz z left outer join k_user u on z.uid=u.uid where u.top_uid>0 and z.live_type='AG' and z.ok=1 and z.zz_time>='$q_btime' and z.zz_time<='$q_etime' ".$sqlwhere." group by u.top_uid";
	$sql	.=	")temp group by top_uid";
	$sql	.=	")tm left outer join k_user u on tm.top_uid=u.uid and u.is_daili=1";
	//echo $sql;exit;
	$query	=	$mysqli->query($sql);
	?>
	<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;line-height:20px;" bgcolor="#798EB9">   
		<tr align="center" style="background:#3C4D82;color:#ffffff;font-weight:bold;">
			<td colspan="15"><?=$btime?> 至 <?=$etime?> 代理财务报表</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td rowspan="2">代理账号</td>
			<td rowspan="2">下线会员</td>
			<td rowspan="2">下线余额</td>
			<td colspan="4">常规存取款</td>
			<td colspan="3">红利派送</td>
			<td rowspan="2">其他情况</td>
			<td colspan="2">手续费(银行转账费用)</td>
			<td colspan="2">真人转账</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
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
		$sum_t1_value	=	0;
		$sum_t2_value	=	0;
		$sum_t3_value	=	0;
		$sum_t4_value	=	0;
		$sum_t5_value	=	0;
		$sum_t6_value	=	0;
		$sum_t1_sxf		=	0;
		$sum_t2_sxf		=	0;
		$sum_h_value	=	0;
		$sum_h_zsjr		=	0;
		$sum_top_num	=	0;
		$sum_inmoney	=	0;
		$sum_outmoney	=	0;
		$arr_money		= 	array();
		$arr_live		= 	array();
		while($row=$query->fetch_array()){
			//查询返水
			$sql_fs="SELECT SUM(fs) as fs FROM `c_bet` where uid IN (SELECT uid FROM k_user where top_uid='".$row["top_uid"]."') and addtime>='$q_btime' and addtime<='$q_etime' and js=1";
			$query_fs	=	$mysqli->query($sql_fs);
			$row_fs=$query_fs->fetch_array();
			$row["t5_value"]=$row_fs['fs'];
			
			$sql_fs="SELECT SUM(fs) as fs FROM `k_bet` where uid IN (SELECT uid FROM k_user where top_uid='".$row["top_uid"]."') and bet_time>='$q_btime' and bet_time<='$q_etime' and lose_ok=1 and status in (0,1,2,3,4,5,6,7,8)";
			$query_fs	=	$mysqli->query($sql_fs);
			$row_fs=$query_fs->fetch_array();
			$row["t5_value"]+=$row_fs['fs'];
			
			$arr_money[$row["top_uid"]]	=	$row["h_zsjr"]+$row["t4_value"]+$row["t5_value"]+$row["t1_sxf"]+$row["t2_sxf"];
			$arr_live[$row["top_uid"]]	=	($row["inmoney"]-$row["outmoney"])*$rate_zr/100;;
		
			$sum_t1_value	+=	$row["t1_value"];
			$sum_t2_value	+=	abs($row["t2_value"]);
			$sum_t3_value	+=	$row["t3_value"];
			$sum_t4_value	+=	$row["t4_value"];
			$sum_t5_value	+=	$row["t5_value"];
			$sum_t6_value	+=	$row["t6_value"];
			$sum_t1_sxf		+=	$row["t1_sxf"];
			$sum_t2_sxf		+=	$row["t2_sxf"];
			$sum_h_value	+=	$row["h_value"];
			$sum_h_zsjr		+=	$row["h_zsjr"];
			$sum_money		+=	$row["money"];
			$sum_top_num	+=	$row["top_num"];
			$sum_inmoney	+=	$row["inmoney"];
			$sum_outmoney	+=	$row["outmoney"];
		?>
		<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
			<td><?=$row["username"]?></td>
			<td><a href="../hygl/list.php?top_uid=<?=$row["top_uid"]?>"><?=$row["top_num"]?></a></td>
			<td><?=sprintf("%.2f",$row["money"])?></td>
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
		<tr align="center" style="background:#ffffff;color:#ff0000;">
			<td>合计</td>
			<td><?=$sum_top_num?></td>
			<td><?=sprintf("%.2f",$sum_money)?></td>
			<td><?=sprintf("%.2f",$sum_t1_value)?></td>
			<td><?=sprintf("%.2f",$sum_h_value)?></td>
			<td><?=sprintf("%.2f",$sum_t3_value)?></td>
			<td><?=sprintf("%.2f",$sum_t2_value)?></td>
			<td><?=sprintf("%.2f",$sum_h_zsjr)?></td>
			<td><?=sprintf("%.2f",$sum_t4_value)?></td>
			<td><?=sprintf("%.2f",$sum_t5_value)?></td>
			<td><?=sprintf("%.2f",$sum_t6_value)?></td>
			<td><?=sprintf("%.2f",$sum_t1_sxf)?></td>
			<td><?=sprintf("%.2f",$sum_t2_sxf)?></td>
			<td><?=sprintf("%.2f",$sum_inmoney)?></td>
			<td><?=sprintf("%.2f",$sum_outmoney)?></td>
        </tr>
	</table>
	<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;line-height:20px;" bgcolor="#798EB9">
		<tr align="center" style="background:#3C4D82;color:#ffffff;font-weight:bold;">
			<td colspan="12"><?=$btime?> 至 <?=$etime?> 代理投注报表 <span style="color:#00ffff;">[只统计已结算的注单]</span></td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td rowspan="2">代理账号</td>
			<td colspan="2">体育</td>
			<td colspan="2">六合彩</td>
			<td colspan="2">彩票</td>
			<td colspan="3">合计</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
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
		$sql	=	"select u.username,tm.top_uid,sum(ty_num) as ty_num,sum(ty_bet_money) as ty_bet_money,sum(ty_yingkui) as ty_yingkui,sum(lh_num) as lh_num,sum(lh_bet_money) as lh_bet_money,sum(lh_yingkui) as lh_yingkui,sum(ss_num) as ss_num,sum(ss_bet_money) as ss_bet_money,sum(ss_yingkui) as ss_yingkui,sum(pt_num) as pt_num,sum(pt_bet_money) as pt_bet_money,sum(pt_yingkui) as pt_yingkui from (";
		$sql	.=	"select u.top_uid,sum(ty_num) as ty_num,sum(ty_bet_money) as ty_bet_money,sum(ty_yingkui) as ty_yingkui,sum(lh_num) as lh_num,sum(lh_bet_money) as lh_bet_money,sum(lh_yingkui) as lh_yingkui,sum(ss_num) as ss_num,sum(ss_bet_money) as ss_bet_money,sum(ss_yingkui) as ss_yingkui,sum(pt_num) as pt_num,sum(pt_bet_money) as pt_bet_money,sum(pt_yingkui) as pt_yingkui from (";
		//体育单式
		$sql_cz	=	"select u.uid,if(status<>0,1,0) as ty_num,if(status<>0,bet_money,0) as ty_bet_money,if(status<>0,bet_money-win-fs,0) as ty_yingkui,0 as lh_num,0 as lh_bet_money,0 as lh_yingkui,0 as ss_num,0 as ss_bet_money,0 as ss_yingkui,0 as pt_num,0 as pt_bet_money,0 as pt_yingkui from k_bet k left outer join k_user u on k.uid=u.uid where lose_ok=1 and status in (0,1,2,3,4,5,6,7,8) and u.top_uid>0 and k.bet_time>='$q_btime' and k.bet_time<='$q_etime' ".$sqlwhere;
		//体育串关
		$sql_cz	.=	" union all ";
		$sql_cz	.=	"select u.uid,if(status<>0 and status<>2,1,0) as ty_num,if(status<>0 and status<>2,bet_money,0) as ty_bet_money,if(status<>0 and status<>2,bet_money-win-fs,0) as ty_yingkui,0 as lh_num,0 as lh_bet_money,0 as lh_yingkui,0 as ss_num,0 as ss_bet_money,0 as ss_yingkui,0 as pt_num,0 as pt_bet_money,0 as pt_yingkui from k_bet_cg_group k left outer join k_user u on k.uid=u.uid where k.gid>0 and status in (0,1,2,3,4) and u.top_uid>0 and k.bet_time>='$q_btime' and k.bet_time<='$q_etime' ".$sqlwhere;
		//六合彩
		$sql_cz	.=	" union all ";
		$sql_cz	.=	"select u.uid,0 as ty_num,0 as ty_bet_money,0 as ty_yingkui,if(js=1,1,0) as lh_num,if(js=1,k.money,0) as lh_bet_money,if(js=1,(case when k.win<0 then k.money when k.win=0 then 0 else k.money-k.win end),0) as lh_yingkui,0 as ss_num,0 as ss_bet_money,0 as ss_yingkui,0 as pt_num,0 as pt_bet_money,0 as pt_yingkui from c_bet k left outer join k_user u on k.username=u.username where k.money>0 and k.type='香港六合彩' and u.top_uid>0 and k.addtime>='$q_btime' and k.addtime<='$q_etime' ".$sqlwhere;
		//重庆时时彩
		$sql_cz	.=	" union all ";
		$sql_cz	.=	"select u.uid,0 as ty_num,0 as ty_bet_money,0 as ty_yingkui,0 as lh_num,0 as lh_bet_money,0 as lh_yingkui,if(js=1,1,0) as ss_num,if(js=1,k.money,0) as ss_bet_money,if(js=1,(case when k.win<0 then k.money when k.win=0 then 0 else k.money-k.win end),0) as ss_yingkui,0 as pt_num,0 as pt_bet_money,0 as pt_yingkui from c_bet k left outer join k_user u on k.username=u.username where k.money>0 and k.type<>'香港六合彩' and u.top_uid>0 and k.addtime>='$q_btime' and k.addtime<='$q_etime' ".$sqlwhere;
		$sql	.=	$sql_cz;
		$sql	.=	") temp left outer join k_user u on temp.uid=u.uid group by u.top_uid";
		//财务代理
		$money_users = implode(',',array_keys($arr_live));
		$sql	.=	" union all ";
		$sql	.=	"select uid as top_uid,0 as ty_num,0 as ty_bet_money,0 as ty_yingkui,0 as lh_num,0 as lh_bet_money,0 as lh_yingkui,0 as ss_num,0 as ss_bet_money,0 as ss_yingkui,0 as pt_num,0 as pt_bet_money,0 as pt_yingkui from k_user where uid in ($money_users)";
		$sql	.=	")tm left outer join k_user u on tm.top_uid=u.uid and u.is_daili=1 group by tm.top_uid";
		$query	=	$mysqli->query($sql);
		$sum_ty_num			=	0;
		$sum_ty_bet_money	=	0;
		$sum_ty_yingkui		=	0;
		$sum_lh_num			=	0;
		$sum_lh_bet_money	=	0;
		$sum_lh_yingkui		=	0;
		$sum_ss_num			=	0;
		$sum_ss_bet_money	=	0;
		$sum_ss_yingkui		=	0;
		$sum_pt_num			=	0;
		$sum_pt_bet_money	=	0;
		$sum_pt_yingkui		=	0;
		$sum_bet_money		=	0;
		$sum_yingkui		=	0;
		$sum_yongjin		=	0;
		//echo $sql;exit;
		while(@$row=$query->fetch_array()){
			$sum_ty_num			+=	$row["ty_num"];
			$sum_ty_bet_money	+=	$row["ty_bet_money"];
			$sum_ty_yingkui		+=	$row["ty_yingkui"];
			$sum_lh_num			+=	$row["lh_num"];
			$sum_lh_bet_money	+=	$row["lh_bet_money"];
			$sum_lh_yingkui		+=	$row["lh_yingkui"];
			$sum_ss_num			+=	$row["ss_num"];
			$sum_ss_bet_money	+=	$row["ss_bet_money"];
			$sum_ss_yingkui		+=	$row["ss_yingkui"];
			$sum_pt_num			+=	$row["pt_num"];
			$sum_pt_bet_money	+=	$row["pt_bet_money"];
			$sum_pt_yingkui		+=	$row["pt_yingkui"];
			$sum_bet_money		+=	$row["ty_bet_money"]+$row["lh_bet_money"]+$row["ss_bet_money"]+$row["pt_bet_money"];
			$yingkui			=	$row["ty_yingkui"]+$row["lh_yingkui"]+$row["ss_yingkui"]+$row["pt_yingkui"];
			$sum_yingkui		+=	$yingkui;
			$yongjin			=	$row["ty_yingkui"]*$rate_ty/100+$row["lh_yingkui"]*$rate_lh/100+$row["ss_yingkui"]*$rate_ss/100+$row["pt_yingkui"]*$rate_pt/100-$arr_money[$row["top_uid"]]+$arr_live[$row["top_uid"]];
			$yongjin			=	$yongjin<0?0:$yongjin;
			$sum_yongjin		+=	$yongjin;
		?>
		<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
			<td><?=$row["username"]?></td>
			<td><?=sprintf("%.2f",$row["ty_bet_money"])?></td>
			<td style="color:<?=$row["ty_yingkui"]>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$row["ty_yingkui"])?></td>
			<td><?=sprintf("%.2f",$row["lh_bet_money"])?></td>
			<td style="color:<?=$row["lh_yingkui"]>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$row["lh_yingkui"])?></td>
			<td><?=sprintf("%.2f",$row["ss_bet_money"])?></td>
			<td style="color:<?=$row["ss_yingkui"]>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$row["ss_yingkui"])?></td>
			<td><?=sprintf("%.2f",$row["ty_bet_money"]+$row["lh_bet_money"]+$row["ss_bet_money"]+$row["pt_bet_money"])?></td>
			<td style="color:<?=$yingkui>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$yingkui)?></td>
			<td style="color:<?=$yongjin>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$yongjin)?></td>
        </tr>
		<?php } ?>
		<tr align="center" style="background:#ffffff;color:#ff0000;">
			<td>合计</td>
			<td><?=sprintf("%.2f",$sum_ty_bet_money)?></td>
			<td style="color:<?=$sum_ty_yingkui>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$sum_ty_yingkui)?></td>
			<td><?=sprintf("%.2f",$sum_lh_bet_money)?></td>
			<td style="color:<?=$sum_lh_yingkui>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$sum_lh_yingkui)?></td>
			<td><?=sprintf("%.2f",$sum_ss_bet_money)?></td>
			<td style="color:<?=$sum_ss_yingkui>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$sum_ss_yingkui)?></td>
			<td><?=sprintf("%.2f",$sum_bet_money)?></td>
			<td style="color:<?=$sum_yingkui>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$sum_yingkui)?></td>
			<td style="color:<?=$sum_yongjin>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$sum_yongjin)?></td>
        </tr>
	</table>
	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="font12" style="margin-top:5px;line-height:20px;">
		<tr>
			<td>
				<p>计算说明：</p>
				<p>1、代理佣金=体育盈亏×体育比例+六合彩盈亏×六合彩比例+彩票盈亏×彩票比例+(转入-转出)×真人比例-红利派送-手续费</p>
				<p>2、如果按照①的公式计算结果小于0，则代理佣金为0</p>
				<p>3、佣金比例可自行调整</p>
				<p>4、如有特殊代理合作方式，可依据以上相关统计数据自行计算佣金</p>
				<p>5、合作双方如有其它约定，不在本报表中体现</p>
			</td>
		</tr>
	</table>
</div>
</div>
</body>
</html>