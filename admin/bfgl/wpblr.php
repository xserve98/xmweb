<?php
include_once("../common/login_check.php");
header("Content-type: text/html; charset=utf-8");

$val	=	explode("|||",$_POST["value"]);
$mid	=	$val[3];
$table	=	$val[4];

if($mid){
	 $MB_Inball		=	$val[0];
     $TG_Inball		=	$val[1];
	 
	 include_once("../../include/mysqli.php");
	 include_once("../../include/mysqlis.php");
	 
	 $sql			=	"select Match_Master,match_name,Match_Guest from $table where Match_ID=$mid limit 1";
	 $query			=	$mysqlis->query($sql);
	 $rows			=	$query->fetch_array();
	 
	 $match_name	=	$rows["match_name"];
	 $Match_Master	=	$rows["Match_Master"];
	 $Match_Guest	=	$rows["Match_Guest"];
	 $Match_Date	=	$val[2];
	 
	 $sql			=	"select Match_ID from $table where match_name='$match_name' and Match_Master='$Match_Master' and Match_Guest='$Match_Guest' and Match_Date='".$Match_Date."'";
	 $query			=	$mysqlis->query($sql);
	 $mid			=	"";
	 while($rows	=	$query->fetch_array()){
	 	$mid .= $rows["Match_ID"].",";
	 }
	 $mid			=	rtrim($mid,",");
	 $value			=	"";
	 if($MB_Inball!="" && $TG_Inball!=""){ //保存全场
	 	$sql		=	"update $table set mb_inball='$MB_Inball',tg_inball='$TG_Inball' where match_id in($mid)";
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
			$sql	=	"update k_bet set MB_Inball='$MB_Inball',TG_Inball='$TG_Inball' where bid in($bid)";
			$mysqli->query($sql);
		}
		
		echo 1;
		exit;
	 }
}else{
	echo 3;
	exit;
}
?>