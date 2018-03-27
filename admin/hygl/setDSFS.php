<?php
include_once("../common/login_check.php"); 
include_once("../../include/mysqli.php");
$sql		=	"select bid,bet_money,`status` from k_bet where `status` in (1,2,4,5) and fs<0.01";
$query		=	$mysqli->query($sql);
$sum		=	0;
while($row	=	$query->fetch_array()){
	$fs		=	0;
	if($row['status']==1 || $row['status']==2){ //输赢都有 1% 返水
		//$fs	=	$row['bet_money']/100;
		$fs	=	0;
	}else{ //输一半赢一半都有 0.5% 返水
		//$fs	=	$row['bet_money']/200;
		$fs	=	0;
	}
	$sql	=	"update k_bet set fs=$fs where bid=".$row['bid'];
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		if($q1 >= 0){
			$mysqli->commit(); //事务提交
			$sum++;
		}else{
			$mysqli->rollback(); //数据回滚
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	}
}
echo '本次共返水单式：'.$sum.' 条记录。';
exit;
?>