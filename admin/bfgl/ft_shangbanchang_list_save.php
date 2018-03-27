<?php
include_once("../common/login_check.php");
check_quanxian("bfgl");
include_once("../../include/mysqli.php");
include_once("../../class/bet.php");

$mid	=	$_POST["match_id"];
$bool	=	true;

//单式
if(count($_POST["bid"])>0){
	foreach ($_POST['bid'] as $i=>$bid){  
		$status=intval($_POST['status'][$i]);
		$mb_inball=$_POST['mb_inball'][$i];
		$tg_inball=$_POST['tg_inball'][$i];
		$bool	=	bet::set($bid,$status,$mb_inball,$tg_inball);
		if(!$bool) break;
	}
}

//串关
if(count($_POST["bid_cg"])>0){
	foreach ($_POST['bid_cg'] as $i=>$bid){
		$status=intval($_POST['status_cg'][$i]);
		$mb_inball=$_POST['mb_inball_cg'][$i];
		$tg_inball=$_POST['tg_inball_cg'][$i];
		$bool	=	bet::set_cg($bid,$status,$mb_inball,$tg_inball);
		if(!$bool) break;
	}
}
if($bool){
	include_once("../../include/mysqlis.php");
	$mysqlis->query("update bet_match set match_sbjs='1' where match_id in($mid)");
	
	include_once("../../class/admin.php");
	admin::insert_log($_SESSION["adminid"],"批量审核了足球上半场赛事".$mid."注单");
}
header('location:zqbf.php');
?>