<?php
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
include_once("../../class/user.php");
///check_quanxian("bbgl");
//ini_set('display_errors','yes');
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
//$username=	$_GET["username"];
$qiantian=	date("Y-m-d",strtotime($bdate)-24*3600);
$cz 	= 	$_GET["cz"];
if(!$cz){
	$cz[0]	=	"tyds";
	$cz[1]	=	"tycg";
	$cz[2]	=	"lhc";
	$cz[3]	=	"cqssc";
}
if($cz){
	$czs="";
	$num = count($cz);
	for($i=0;$i<$num;++$i){
		$czs=$czs."&cz[]=$cz[$i]";
	}
}
$links="time=$time&bdate=$bdate&bhour=$bhour&bsecond=$bsecond&edate=$edate&ehour=$ehour&esecond=$esecond$czs";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome</title>
	<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
	<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
	<script language="JavaScript" src="/js/calendar.js"></script>
</head>
<script>
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
<body>
<div id="pageMain">
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="font12" style="border:1px solid #798EB9;">
		<form name="form1" method="get" action="?top=0">
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
                <!--新增按钮-->
				<?php
				if (date(w,time())==0){
					$num=6;
				}else{
					$num=date(w,time()-60*60*24);
				}
				?>
                <input type="Button" class="za_button" onClick="chg_date('l',-1,-1)" value="昨天">
				<input type="Button" class="za_button" onClick="chg_date('t',0,0)" value="今天">
				<input type="Button" class="za_button" onClick="chg_date('w',-<?=$num?>,6-<?=$num?>)" value="本周">
				<input type="Button" class="za_button" onClick="chg_date('lw',-<?=$num?>-7,6-<?=$num?>-7)" value="上周">
                <input name="find" type="submit" id="find" value="查找"/>
			</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td align="left">
				&nbsp;彩种
				<input name="cz[]" type="checkbox" <?=in_array("tyds",$cz)?"checked":""?> id="cz[]" value="tyds" />体育单式
                <input name="cz[]" type="checkbox" <?=in_array("tycg",$cz)?"checked":""?> id="cz[]" value="tycg" />体育串关
                <input name="cz[]" type="checkbox" <?=in_array("cqssc",$cz)?"checked":""?> id="cz[]" value="cqssc" />
                彩票
                =====<a href="javascript:history.go( -1 );">回上一页</a>
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
	//$cn_q_btime	=	date("Y-m-d H:i:s",strtotime($btime));
	//$cn_q_etime	=	date("Y-m-d H:i:s",strtotime($etime));
	$cn_q_btime	=	date("Y-m-d H:i:s",strtotime($btime)+0);
	$cn_q_etime	=	date("Y-m-d H:i:s",strtotime($etime)+0);
	
	$cj=$_GET['top'];
		$sqlwhere	=	"";
		switch($cj){
			case 0:
				$what="";
				$whats="";
				$orders="";
				$display="公司";
				break;
			case 1:
				$what="agents,top_uid,";
				$whats="agents,top_uid,";
				$orders="group by top_uid";
				$display="代理";
				break;
			case 2:
				$what="username,pay_name,";
				$whats="k.username,u.pay_name,";//体育下注表中没有username字段
				$orders="group by username";
				if ($_GET['agents']!=''){
					$sqlwhere=" and top_uid='{$_GET['agents']}'";}
				else{
					$sqlwhere=" and (top_uid is null or agents='')";}
				$display="会员";
				break;
			}
	?>

	<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;line-height:20px;" bgcolor="#798EB9">
		<tr align="center" style="background:#3C4D82;color:#ffffff;font-weight:bold;">
			<td colspan="11"><?=$btime?> 至 <?=$etime?> 投注报表</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td rowspan="2"><?=$display?></td>
			<td colspan="6">已结算</td>
			<td colspan="2">未结算</td>
			<td colspan="2">注单统计(未结算+已结算)</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td>笔数</td>
			<td>下注金额</td>
			<td>有效投注</td>
			<td>派彩</td>
			<td>反水</td>
			<td>盈亏</td>
			<td>笔数</td>
			<td>下注金额</td>
			<td>笔数</td>
			<td>下注金额</td>
		</tr>
		<?php
			
		$sql	=	"select $what sum(y_num) as y_num,sum(y_bet_money) as y_bet_money,sum(yx_bet_money) as yx_bet_money,sum(y_win) as y_win,sum(y_fs) as y_fs,sum(w_num) as w_num,sum(w_bet_money) as w_bet_money from (";
		
		$sql_cz	=	"";
		//体育单式
		if(in_array("tyds",$cz)){
			$sql_cz	=	"select $what if(status<>0,1,0) as y_num,if(status<>0,bet_money,0) as y_bet_money,if(status=1 or status=2 or status=4 or status=5,bet_money,0) as yx_bet_money,if(status<>0,win,0) as y_win,if(status<>0,fs,0) as y_fs,if(status=0,1,0) as w_num,if(status=0,bet_money,0) as w_bet_money from k_bet k left outer join k_user u on k.uid=u.uid where lose_ok=1 and status in (0,1,2,3,4,5,6,7,8) and k.bet_time>='$q_btime' and k.bet_time<='$q_etime' ".$sqlwhere;
		}
		//体育串关
		if(in_array("tycg",$cz)){
			if($sql_cz!=""){
				$sql_cz	.=	" union all ";
			}
			$sql_cz	.=	"select $what if(status<>0 and status<>2,1,0) as y_num,if(status<>0 and status<>2,bet_money,0) as y_bet_money,if(status=1,bet_money,0) as yx_bet_money,if(status<>0 and status<>2,win,0) as y_win,if(status<>0 and status<>2,fs,0) as y_fs,if(status=0 or status=2,1,0) as w_num,if(status=0 or status=2,bet_money,0) as w_bet_money from k_bet_cg_group k left outer join k_user u on k.uid=u.uid where k.gid>0 and status in (0,1,2,3,4) and k.bet_time>='$q_btime' and k.bet_time<='$q_etime' ".$sqlwhere;
		}
		//重庆时时彩
		if(in_array("cqssc",$cz)){
			if($sql_cz!=""){
				$sql_cz	.=	" union all ";
			}
			$sql_cz	.=	"select $whats if(js=1,1,0) as y_num,if(js=1,k.money,0) as y_bet_money,if(js=1 and win<>0,k.money,0) as yx_bet_money,if(js=1,(case when win<0 then 0 when win=0 then k.money else win end),0) as y_win,0 as y_fs,if(js=0,1,0) as w_num,if(js=0,k.money,0) as w_bet_money from c_bet k left outer join k_user u on k.username=u.username where k.money>0 and k.addtime>='$q_btime' and k.addtime<='$q_etime' ".$sqlwhere;
		}
		
		$sql	.=	$sql_cz;
		//$sql	.=	") temp group by username";
		$sql	.=	") temp $orders";
		$query	=	$mysqli->query($sql);
		//echo $sql;
		$sum_y_num			=	0;
		$sum_y_bet_money	=	0;
		$sum_yx_bet_money	=	0;
		$sum_y_win			=	0;
		$sum_y_fs			=	0;
		$sum_y_yingkui		=	0;
		$sum_w_num			=	0;
		$sum_w_bet_money	=	0;
		
		while($row=$query->fetch_array()){
			$y_yingkui	=	sprintf("%.2f",$row["y_bet_money"]-$row["y_win"]-$row["y_fs"]);
			
			$sum_y_num			+=	$row["y_num"];
			$sum_y_bet_money	+=	$row["y_bet_money"];
			$sum_yx_bet_money	+=	$row["yx_bet_money"];
			$sum_y_win			+=	$row["y_win"];
			$sum_y_fs			+=	$row["y_fs"];
			$sum_y_yingkui		+=	$y_yingkui;
			$sum_w_num			+=	$row["w_num"];
			$sum_w_bet_money	+=	$row["w_bet_money"];
		?>
		<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
			<?php
            switch($cj){
			case 0:
				if ($row["y_num"]==''){
					$html="<td><a href='?top=1&$links'>admin</a></td><td>0</td>";}
				else{
					$html="<td><a href='?top=1&$links'>admin</a></td><td>".$row["y_num"]."</td>";}
				break;
			case 1:
				if ($row["top_uid"]=='' || $row["top_uid"]<=0){
				$html="<td><a href='?top=2&$links&agents=' style='color:red'>none</a></td><td>".$row["y_num"]."</td>";}
				else{
				$top_name=user::getusername($row["top_uid"]);
				$html="<td><a href='?top=2&$links&agents=".$row["top_uid"]."'>".$top_name."</a></td><td>".$row["y_num"]."</td>";}
				break;
			case 2:
				$html="<td><a href='report_detail.php?$links&username=".$row["username"]."'>".$row["username"]."(".$row["pay_name"].")"."</a></td><td>".$row["y_num"]."</td>";
				break;
			}
			?>
			<?=$html?>
			<td><?=sprintf("%.2f",$row["y_bet_money"])?></td>
			<td><?=sprintf("%.2f",$row["yx_bet_money"])?></td>
			<td><?=sprintf("%.2f",$row["y_win"])?></td>
			<td><?=sprintf("%.2f",$row["y_fs"])?></td>
			<td style="color:<?=$y_yingkui>=0?'#ff0000':'#009900'?>"><?=$y_yingkui?></td>
			<td><? if($row["w_num"]==''){echo "0";}else{echo $row["w_num"];}?></td>
			<td><?=sprintf("%.2f",$row["w_bet_money"])?></td>
			<td><?=$row["y_num"]+$row["w_num"]?></td>
			<td><?=sprintf("%.2f",$row["y_bet_money"]+$row["w_bet_money"])?></td>
        </tr>
		<?php } ?>
		<tr align="center" style="background:#ffffff;color:#ff0000;">
			<td>合计</td>
			<td><?=$sum_y_num?></td>
			<td><?=sprintf("%.2f",$sum_y_bet_money)?></td>
			<td><?=sprintf("%.2f",$sum_yx_bet_money)?></td>
			<td><?=sprintf("%.2f",$sum_y_win)?></td>
			<td><?=sprintf("%.2f",$sum_y_fs)?></td>
			<td style="color:<?=$sum_y_yingkui>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$sum_y_yingkui)?></td>
			<td><?=$sum_w_num?></td>
			<td><?=sprintf("%.2f",$sum_w_bet_money)?></td>
			<td><?=$sum_y_num+$sum_w_num?></td>
			<td><?=sprintf("%.2f",$sum_y_bet_money+$sum_w_bet_money)?></td>
        </tr>
	</table>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="font12" style="margin-top:5px;line-height:20px;">
		<tr>
			<td>
				<p>备注说明：</p>
				<p>1、代理显示为none，表示用户已经被删除或是没有代理，但有下注记录</p>
			</td>
		</tr>
	</table>
</div>
</div>
</body>
</html>