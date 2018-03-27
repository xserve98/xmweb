<?php
include_once("../common/login_check.php");
check_quanxian("bbgl");
include_once("../../include/mysqli.php");
include_once("../../cache/hlhy.php");
//GET传值
$type		=	$_POST["result_type"];
$wtype		=	$_POST["wtype"];
$wtarr		=	wtype($wtype);
$date_start =	$_POST["date_start"]." 00:00:00";
$date_end	=	$_POST["date_end"]." 23:59:59";
$yb	=	$tk	=	$hk	=	$hyhl	=	$dlhl	=	$dlhl1	=	$hyfl	=	$s_ck	=	$s_hk	=	$s_ck1	=	$s_hk1	=	0;
$hk_bank	=	$hk_bank1		=	array();
$lstime		=	date('Y-m-d',strtotime("$date_start -1 day"));
$lsmoney	=	0;
	  
//////获取单式注单的资料
$sql		=	"select bet_money,status,win,point_column,match_type,uid,fs from k_bet where match_coverdate>='$date_start' and lose_ok=1 and match_coverdate<='$date_end' and guest=0";
if($type == "Y") $sql.=" and status>0";
else $sql.=" and status=0";
//echo $sql;exit;
$k_bet_arr = array();
$query		=	$mysqli->query($sql);
if($wtype != "P"){
	while($k_bet_info = $query->fetch_array()){
		if($wtype=="RE" && $k_bet_info["match_type"]==2){
			$k_bet_arr[]=$k_bet_info;
		}elseif(($wtype=="ROU" || $wtype=="HRE" || $wtype=="HROU") && $k_bet_info["match_type"]==2 && in_array($k_bet_info["point_column"],$wtarr)){
			$k_bet_arr[]=$k_bet_info;
		}elseif($wtype!="ROU" && $wtype!="HRE" && $wtype!="HROU" && $wtype!="RE" && in_array($k_bet_info["point_column"],$wtarr)){
			$k_bet_arr[]=$k_bet_info;
		}elseif($wtype==""){
			$k_bet_arr[]=$k_bet_info;
		}
	}
}
$k_bet_count = count($k_bet_arr);

////获取串关总资料
if($type == "Y"){
	$sql	=	"select bet_money,win,gid,status from k_bet_cg_group g where g.status in(1,3) and  g.match_coverdate>='$date_start' and g.match_coverdate<='$date_end' and g.guest=0 order by gid";
}else{
	$sql	=	"select bet_money,gid from k_bet_cg_group g where g.status in(0,2) and  g.match_coverdate>='$date_start' and g.match_coverdate<='$date_end'  and g.guest=0 order by gid"; 
}
$k_bet_cg_group_arr	=	array();
$k_cg_group_gid		=	array();
$query				=	$mysqli->query($sql);

if($wtype == "P" || $wtype == ""){
	while($k_bet_cg_group = $query->fetch_array()){
		$k_bet_cg_group_arr[]	=	$k_bet_cg_group;
		$k_cg_group_gid[]		=	$k_bet_cg_group['gid'];
	}
}
$k_bet_cg_group_count			=	count($k_bet_cg_group_arr);
$k_bet_cg_count					=	count($k_bet_cg_arr);
	 
	 
//获取美东时间总存款/取款/
function get_m_value_en($date_start,$date_end,$type){
	global $yb;
	global $tk;
	global $hk;
	global $hyhl;
	global $dlhl;
	global $hyfl;
	global $s_ck;
	global $s_hk;
	global $hk_bank;
	global $hl_uid;
	global $mysqli;
	
	$sql	=	"select m_value,about,type,sxf from k_money where m_make_time>='$date_start' and status=1 and m_make_time<='$date_end' and guest=0"; //存款取款
	$query	=	$mysqli->query($sql);
	$ck		=	0;
	$qk		=	0;
	
	while($value = $query->fetch_array()){
		if($value["m_value"] > 0 ){
			if($value["about"]=='The order system is successful' || $value["about"]=='该订单手工操作成功' || $value["about"]==''){ //会员存款
				$ck		+=	$value["m_value"];
				$s_ck	+=	$value["m_value"];
				$yb		+=	$value["sxf"]; //要减去YB 1%手续费
			}else{ //系统赠送的钱，算在退水中
				if(strpos($value["about"],'净亏返利')){ //净亏返利
					$hyfl	+=	$value["m_value"];
				}else{
					$hyhl	+=	$value["m_value"];
				}
			}
		}else{
			if($value["type"]==2){ //代理提成
				$dlhl	+=	abs($value["m_value"]);
			}
			$qk		+=	$value["m_value"];
			$tk		+=	$value["sxf"]; //要减去提款手续费
		}
	}
	
	$sql	=	"SELECT money,zsjr,bank FROM huikuan where `status`=1 and adddate>='$date_start' and adddate<='$date_end' and guest=0"; //汇款
	$query	=	$mysqli->query($sql);
	while($value = $query->fetch_array()){
		$ck		+=	$value["money"];
		$s_hk	+=	$value["money"];
		$hk		+=	$value["zsjr"];
		$hk_bank[$value["bank"]]	+=	$value["money"];
	}
	
	if($ck == ""){
		$ck = 0;
	}
	
	if($qk == ""){
		$qk = 0;
	}else{
		$qk = substr($qk,1);
	}
	
	$arr[0] = double_format($qk);
	$arr[1] = double_format($ck);
	return $arr;
}	
 
//获取中国时间总存款/取款/
function get_m_value_cn($date_start,$date_end,$type){
	global $s_ck1;
	global $s_hk1;
	global $dlhl1;
	global $hk_bank1;
	global $hl_uid;
	global $mysqli;
	
	$date_start	=	date("Y-m-d H:i:s",strtotime($date_start)-43200); //取中国时间
	$date_end	=	date("Y-m-d H:i:s",strtotime($date_end)-43200); //取中国时间
	
	$sql	=	"select m_value,about,type,sxf from k_money where m_make_time>='$date_start' and status=1 and m_make_time<='$date_end' and guest=0"; //存款取款
	$query	=	$mysqli->query($sql);
	$ck		=	0;
	$qk		=	0;
	
	while($value = $query->fetch_array()){
		if($value["m_value"] > 0 ){
			if($value["about"]=='The order system is successful' || $value["about"]=='该订单手工操作成功' || $value["about"]==''){ //会员存款
				$ck		+=	$value["m_value"];
				$s_ck1	+=	$value["m_value"];
			}
		}else{
			if($value["type"]==2){ //代理提成
				$dlhl1	+=	abs($value["m_value"]);
			}
			$qk		+=	$value["m_value"];
		}
	}
	
	$sql	=	"SELECT money,zsjr,bank FROM huikuan where `status`=1 and adddate>='$date_start' and adddate<='$date_end' and guest=0"; //汇款
	$query	=	$mysqli->query($sql);
	while($value = $query->fetch_array()){
		$ck		+=	$value["money"];
		$s_hk1	+=	$value["money"];
		$hk_bank1[$value["bank"]]	+=	$value["money"];
	}
	
	if($ck == ""){
		$ck = 0;
	}
	
	if($qk == ""){
		$qk = 0;
	}else{
		$qk = substr($qk,1);
	}
	
	$arr[0] = double_format($qk);
	$arr[1] = double_format($ck);
	return $arr;
}

//用户余额
function get_ye(){
	global $mysqli;	 
	global $hl_uid;
	$sql	=	"select sum(money) as s from k_user where is_delete=0 and is_stop=0 and guest=0"; //停用和已删除会员不记算
	$query	=	$mysqli->query($sql);
	$info	=	$query->fetch_array();
	
	return $info['s'];
}



//获取下注注单全部信息
function get_bet_num(){
	global $k_bet_arr;
	global $k_bet_cg_group_arr;
	global $k_bet_count;
	global $k_bet_cg_group_count;
	global $bet_point_array;
	
	$jine	=	0;
	$tsje	=	0;
	$win	=	0;
	$bm		=	0;
	
	for($i=0; $i<$k_bet_count; $i++){
		$bm			+=	$k_bet_arr[$i]["bet_money"];
		$tsje		+=	$k_bet_arr[$i]["fs"];
		if($k_bet_arr[$i]["status"]==1 || $k_bet_arr[$i]["status"]==2 || $k_bet_arr[$i]["status"]==4 || $k_bet_arr[$i]["status"]==5){     //////判断状态来计算有效金额
			$jine	+=	$k_bet_arr[$i]["bet_money"];
		}
		
		$win		+=	$k_bet_arr[$i]["win"]-$k_bet_arr[$i]["bet_money"]; ////计算输赢
	}
		
	for($i=0; $i<$k_bet_cg_group_count; $i++){
		$bm			+=	$k_bet_cg_group_arr[$i]["bet_money"];
		$tsje		+=	$k_bet_cg_group_arr[$i]["fs"];
		if($k_bet_cg_group_arr[$i]["status"] == 1){     //////判断状态来计算有效金额
			$jine	+=	$k_bet_cg_group_arr[$i]["bet_money"];
		}
		$win		+=	$k_bet_cg_group_arr[$i]["win"]-$k_bet_cg_group_arr[$i]["bet_money"];
	}
	
	$arr["win"]		=	0-$win;
	$arr["yx"]		=	$jine;
	$arr["bet_money"]=	$bm;
	$arr["num"]		=	$k_bet_cg_group_count + $k_bet_count;
	$arr["ts"]		=	$tsje;
	
	return $arr;
}

if($type == "Y"){
	$sql	=	"SELECT sum(money) as s FROM save_user where addtime like('$lstime%')";
	$query	=	$mysqlio->query($sql);
	$rows	=	$query->fetch_array();
	$lsmoney=	$rows['s'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../images/control_main.css" type="text/css">
<style type="text/css"> 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 12px;
}
</style> 
<title>报表总数</title>
<style>
tr{height:20px;}
</style>
</head>
<script type="text/javascript" language="javascript" src="/js/jquery.js"></script>
<script>
var time_id;
function over(){
	window.clearTimeout(time_id);
	div_none('ts');
	div_none('qk');
	div_none('chk');
	$("#ts").css("display","block");
}
function out(){
	time_id = window.setTimeout("div_none('ts')",500);
}

function over1(){
	window.clearTimeout(time_id);
	div_none('ts');
	div_none('qk');
	div_none('chk');
	$("#chk").css("display","block");
}
function out1(){
	time_id = window.setTimeout("div_none('chk')",500);
}

function over2(){
	window.clearTimeout(time_id);
	div_none('ts');
	div_none('qk');
	div_none('chk');
	$("#qk").css("display","block");
}
function out2(){
	time_id = window.setTimeout("div_none('qk')",500);
}

function div_none(div){
	$("#"+div).css("display","none");
}

</script>
<body>
<table width="853" cellpadding="0" cellspacing="1" boder="0">
  <tbody>
    
    <tr  class="m_title_ft">
      <td width="90">存款</td>
      <td width="90">提款</td>
	  <td width="90"><?=substr($lstime,5,10)?>余额</td>
      <td width="90">会员余额</td>
      <td width="50">下注笔数</td>
	  <td width="90">下注金额</td>
      <td width="90">有效金额</td>
      <td width="90">盈亏</td>
      <td width="70">总退水</td>
	  <td width="90">实际盈亏</td>
    </tr>
<?php
$money	=	get_m_value_en($date_start,$date_end,$type); //东美时间存取汇款
$money1	=	get_m_value_cn($date_start,$date_end,$type); //东美时间存取汇款
$bet	=	get_bet_num($date_start,$date_end,$type);
$ye		=	get_ye();
$qt		=	0;
if($bet["win"]+($bet["yx"]*0.01+$yb+$tk+$hk) >= 0){
	$qt	=	$hyhl+$dlhl+$hyfl;
}
?>
    <tr style="background-color:#D8D8D8">
      <td align="center"><a href="#" onmouseover="over1()" onmouseout="out1()"><?=$money[1]?></a></td>
      <td align="center"><a href="#" onmouseover="over2()" onmouseout="out2()"><?=$money[0]?></a></td>
	  <td align="center"><?=$type=="Y" ? double_format($lsmoney) : '/'?></td>
      <td align="center"><a href="chage_xxuser.php?start=<?=$date_start?>&amp;end=<?=$date_end?>&amp;type=<?=$type?>&amp;wtype=<?=$wtype?>"><?=double_format($ye)?></a></td>
      <td align="center"><?=$bet["num"]?></td>
	  <td align="center"><?=double_format($bet["bet_money"])?></td>
	  <td align="center"><?=$type=="Y" ? double_format($bet["yx"]) : '/'?></td>
      <td align="center"><?=$type=="Y" ? double_format($bet["win"]) : '/'?></td>
      <td align="center"><?=$type=="Y" ? '<a href="#" onmouseover="over()" onmouseout="out()">'.double_format($bet["ts"]+$yb+$tk+$hk+$hyhl+$dlhl+$hyfl).'</a>' : '/'?></td>
      <td align="center"><?=$type=="Y" ? double_format($bet["win"]-($bet["ts"]+$yb+$tk+$hk+$qt)) : '/'?></td>
    </tr>
  </tbody>
</table>
<div id="ts" style="width:700px; display:none; position:absolute; left: 153px; top: 45px;" onmouseover="over()" onmouseout="out()">
<table width="700" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td width="100" height="20" align="center" bgcolor="#7DD5D2">交易退水</td>
    <td width="100" align="center" bgcolor="#7DD5D2">YB1%手续费</td>
    <td width="100" align="center" bgcolor="#7DD5D2">提款手续费</td>
    <td width="100" align="center" bgcolor="#7DD5D2">汇款赠送</td>
    <td width="100" align="center" bgcolor="#7DD5D2">会员红利</td>
    <td width="100" align="center" bgcolor="#7DD5D2">代理红利</td>
    <td width="100" align="center" bgcolor="#7DD5D2">会员返利</td>
  </tr>
  <tr>
    <td height="20" align="center" bgcolor="#F0F0F0"><?=$bet["ts"]?></td>
    <td align="center" bgcolor="#F0F0F0"><?=$yb?></td>
    <td align="center" bgcolor="#F0F0F0"><?=$tk?></td>
    <td align="center" bgcolor="#F0F0F0"><?=$hk?></td>
    <td align="center" bgcolor="#F0F0F0"><?=$hyhl?></td>
    <td align="center" bgcolor="#F0F0F0"><?=$dlhl?></td>
    <td align="center" bgcolor="#F0F0F0"><?=$hyfl?></td>
  </tr>
</table>
</div>
<div id="chk" style="width:<?=200+(count($hk_bank)*100)?>px; display:none; position:absolute; left: 0px; top: 45px;" onmouseover="over1()" onmouseout="out1()">
<table width="<?=200+(count($hk_bank)*100)?>" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td height="20" align="center" bgcolor="#7DD5D2">存款时间</td>
    <td height="20" align="center" bgcolor="#7DD5D2">存款金额</td>
    <td align="center" bgcolor="#7DD5D2">汇款总金额</td>
<?php
ksort($hk_bank);
foreach($hk_bank as $k=>$v){
?>
	<td align="center" bgcolor="#7DD5D2"><?=$k?></td>
<?php
}
?>
    </tr>
  <tr>
    <td align="center" bgcolor="#F0F0F0">美东时间</td>
    <td height="20" align="center" bgcolor="#F0F0F0"><?=$s_ck?></td>
    <td align="center" bgcolor="#F0F0F0"><?=$s_hk?></td>
<?php
foreach($hk_bank as $k=>$v){
?>
	<td align="center" bgcolor="#F0F0F0"><?=$v?></td>
<?php
}
?>
    </tr>
</table>
<table width="<?=200+(count($hk_bank1)*100)?>" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td height="20" align="center" bgcolor="#7DD5D2">存款时间</td>
    <td height="20" align="center" bgcolor="#7DD5D2">存款金额</td>
    <td align="center" bgcolor="#7DD5D2">汇款总金额</td>
<?php
ksort($hk_bank1);
foreach($hk_bank1 as $k=>$v){
?>
	<td align="center" bgcolor="#7DD5D2"><?=$k?></td>
<?php
}
?>
    </tr>
  <tr>
    <td align="center" bgcolor="#F0F0F0">中国时间</td>
    <td height="20" align="center" bgcolor="#F0F0F0"><?=$s_ck1?></td>
    <td align="center" bgcolor="#F0F0F0"><?=$s_hk1?></td>
<?php
foreach($hk_bank1 as $k=>$v){
?>
	<td align="center" bgcolor="#F0F0F0"><?=$v?></td>
<?php
}
?>
    </tr>
</table>
</div>
<div id="qk" style="width:200px; display:none; position:absolute; left: 35px; top: 45px;" onmouseover="over2()" onmouseout="out2()">
<table width="200" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td height="20" align="center" bgcolor="#7DD5D2">取款时间</td>
    <td height="20" align="center" bgcolor="#7DD5D2">会员提款</td>
    <td align="center" bgcolor="#7DD5D2">代理提款</td>
    </tr>
  <tr>
    <td align="center" bgcolor="#F0F0F0">美东时间</td>
    <td height="20" align="center" bgcolor="#F0F0F0"><?=$money[0]-$dlhl?></td>
    <td align="center" bgcolor="#F0F0F0"><?=$dlhl?></td>
    </tr>
  <tr>
    <td align="center" bgcolor="#F0F0F0">中国时间</td>
    <td height="20" align="center" bgcolor="#F0F0F0"><?=$money1[0]-$dlhl1?></td>
    <td align="center" bgcolor="#F0F0F0"><?=$dlhl1?></td>
    </tr>
</table>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><a href="javascript:history.go(-1);">返回报表</a></p>
</body>
</html>