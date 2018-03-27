<?php
session_start();
header('Content-type: text/json; charset=utf-8');
include_once("cache/group_".$_SESSION["gid"].".php"); //加载权限组权限
include_once("include/mysqli.php");
include_once("include/config.php");

$ball_sort		=	$_REQUEST['ball_sort'];
$touzhuxiang	=	$_REQUEST['touzhuxiang'];
$bet_money		=	$_REQUEST['bet_money'];
$match_id		=	$_REQUEST['match_id'];

if($ball_sort == "冠军" || $ball_sort == "金融"){
	$dz	=	@$dz_db["$ball_sort"];
	$dc	=	@$dc_db["$ball_sort"];
}else{
	$dz	=	@$dz_db["$ball_sort"]["$touzhuxiang"];
	$dc	=	@$dc_db["$ball_sort"]["$touzhuxiang"];
}
if(!$dz || $dz=="") $dz=$dz_db['未定义'];
if(!$dc || $dc=="") $dc=$dc_db['未定义'];
if($bet_money<=$dz){
    $s_t	=	strftime("%Y-%m-%d",time())." 00:00:00";
	$e_t	=	strftime("%Y-%m-%d",time())." 23:59:59";
	$sql	=	"select sum(bet_money) as s from `k_bet` where match_id=$match_id and uid=".$_SESSION["uid"]." and bet_time>='$s_t' and bet_time<='$e_t' and `status` not in(3,8)"; //无效跟平手不当成投注
	$query	=	$mysqli->query($sql);  		
	$rs		=	$query->fetch_array();
	if(!$rs['s'] || $rs['s']=="null") $rs['s']=0;
	if(($rs['s']+$bet_money)<=$dc){
	    $json['result']				=	"ok";
		$_SESSION["check_action"]	=	'true'; //防软件打水
	}else{
	    $json['result']				=	$ball_sort."-".$touzhuxiang."\n您本次交易：".$bet_money."\n单场限额：".$dc."\n您本场已交易：".$t['s']."\n本次允许交易：".($dc-$t['s']);
	}
}else{
	if($_SESSION["gid"]) $json['result']=$ball_sort."-".$touzhuxiang." 单注限额：".$dz;
	else $json['result']="wdl"; //用户未登陆
}

echo json_encode($json);
exit;
?>