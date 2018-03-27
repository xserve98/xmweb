<?php
include_once("../common/login_check.php");
check_quanxian("bfgl");
include_once("../../include/mysqli.php");
include_once("../../class/bet.php");

$mid 	=	$_POST["match_id"];
$bool	=	true;

//单式
if(count($_POST["bid"])>0){
	foreach ($_POST['bid'] as $i=>$bid){  
		$status		=	intval($_POST['status'][$i]);
		$mb_inball	=	$_POST['mb_inball'][$i];
		$tg_inball	=	$_POST['tg_inball'][$i];
		$bool		=	bet::set($bid,$status,$mb_inball,$tg_inball);
		if(!$bool) break;
	}
}

//串关
if($bool){
	if(count($_POST["bid_cg"])>0){
		foreach ($_POST['bid_cg'] as $i=>$bid){
			$status		=	intval($_POST['status_cg'][$i]);
			$mb_inball	=	$_POST['mb_inball_cg'][$i];
			$tg_inball	=	$_POST['tg_inball_cg'][$i];
			$bool		=	bet::set_cg($bid,$status,$mb_inball,$tg_inball);
			if(!$bool) break;
		}
	}
}

$php	=	$_GET['php'] ? $_GET['php'] : 'zqbf';

if($bool){
	$table	=	$_GET['type'] ? $_GET['type'] : 'bet_match';
	$set	=	$table=='bet_match' ? ',match_sbjs=1' : '';
	include_once("../../include/mysqlis.php");
	$mysqlis->query("update $table set match_js='1'$set where match_id in($mid)");
	
	include_once("../../class/admin.php");
	admin::insert_log($_SESSION["adminid"],"批量审核了足球赛事".$mid."注单");
}

message('本次结算完成',"$php.php");
?>

