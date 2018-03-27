<?php
include_once("../common/login_check.php");
header("Content-type: text/html; charset=utf-8");

$val				=	explode("|||",$_POST["value"]);
$mid				=	$val[3];

if($mid){
	 $MB			=	$val[0];
     $TG			=	$val[1];
	 
	 include_once("../../include/mysqli.php");
	 include_once("../../include/mysqlis.php");
	 
	 $sql			=	"select Match_Master,match_name,Match_Guest from lq_match where Match_ID=$mid limit 1";
	 $query			=	$mysqlis->query($sql);
	 $rows			=	$query->fetch_array();
	 
	 $match_name	=	$rows["match_name"];
	 $Match_Master	=	$rows["Match_Master"];
	 $Match_Guest	=	$rows["Match_Guest"];
	 $Match_Date	=	$val[2];
	 
	 $sql			=	"select Match_ID from lq_match where match_name='$match_name' and Match_Master='$Match_Master' and Match_Guest='$Match_Guest' and Match_Date='".$Match_Date."'";
	 $query			=	$mysqlis->query($sql);
	 $mid			=	"";
	 while($rows	=	$query->fetch_array()){
	 	$mid .= $rows["Match_ID"].",";
	 }
	 $mid			=	rtrim($mid,",");
	 $value			=	"";
	 if($MB!="" && $TG!=""){ //保存
	 	$mb_inball	=	'MB_Inball'; //默认全场
		$tg_inball	=	'TG_Inball'; //默认全场
		$preg1		=	"/第[1-4]節/";
		if(strpos($Match_Master,'上半') && strpos($Match_Guest,'上半')){
	 		$mb_inball		=	'MB_Inball_HR'; //上半场
			$tg_inball		=	'TG_Inball_HR'; //上半场
		}elseif(preg_match($preg1,$Match_Master,$num) && preg_match($preg1,$Match_Guest,$num)){
			if(strpos($num[0],'1')){
	 			$mb_inball	=	'MB_Inball_1st'; //第1节
				$tg_inball	=	'TG_Inball_1st'; //第1节
			}elseif(strpos($num[0],'2')){
	 			$mb_inball	=	'MB_Inball_2st'; //第2节
				$tg_inball	=	'TG_Inball_2st'; //第2节
			}elseif(strpos($num[0],'3')){
	 			$mb_inball	=	'MB_Inball_3st'; //第3节
				$tg_inball	=	'TG_Inball_3st'; //第3节
			}elseif(strpos($num[0],'4')){
	 			$mb_inball	=	'MB_Inball_4st'; //第4节
				$tg_inball	=	'TG_Inball_4st'; //第4节
			}
		}elseif(strpos($Match_Master,'下半') && strpos($Match_Guest,'下半')){
	 		$mb_inball		=	'MB_Inball_ER'; //下半场
			$tg_inball		=	'TG_Inball_ER'; //下半场
		}elseif(strpos($Match_Master,'加時') && strpos($Match_Guest,'加時')){
	 		$mb_inball		=	'MB_Inball_ADD'; //加时
			$tg_inball		=	'TG_Inball_ADD'; //加时
		}
		
	 
	 	$sql		=	"update lq_match set $mb_inball='$MB',$tg_inball='$TG',MB_Inball_OK='$MB',TG_Inball_OK='$TG' where match_id in($mid)";
		$mysqlis->query($sql);
		
		//保存所有全场单式注单比分
		$sql		=	"select bid from k_bet where lose_ok=1 and status=0 and match_id in($mid) order by bid desc ";
		$result		=	$mysqli->query($sql); //单式
		$bid		=	"";
		while($rows	=	$result->fetch_array()){
		    $bid	.=	$rows["bid"].",";
		}
		if($bid != ""){ //全场
			$bid	=	rtrim($bid,",");
			$sql	=	"update k_bet set MB_Inball='$MB',TG_Inball='$TG' where bid in($bid)";
			$mysqli->query($sql);
		}
		
		//保存所有全场串关注单比分
		$sql		=	"select bid from k_bet_cg where status=0 and match_id in($mid) order by bid desc";
		$result_cg	=	$mysqli->query($sql); //串关
		$bid		=	"";
		while($rows	=	$result_cg->fetch_array()) {
			$bid	.=	$rows["bid"].",";
		}
		if($bid != ""){
			$bid	=	rtrim($bid,",");
			$sql	=	"update k_bet_cg set mb_inball='$MB',tg_inball='$TG' where bid in($bid)";
			$mysqli->query($sql);
		}
		
		echo "1,$mb_inball,$tg_inball";
		exit;
	 }
}else{
	echo 3;
	exit;
}
?>