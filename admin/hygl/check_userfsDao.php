<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");

if($_GET['action'] == 'xf'){
	include_once("../../include/mysqli.php");
	$arr	=	$_POST['id'];
	$ds		=	$cg		=	'';
	$sum	=	$true	=	$false	=	0;
	foreach($arr as $k=>$v){
		$temp			=	explode(',',$v);
		if($temp[0] == 1){
			$ds	.=	$temp[1].',';
		}else{
			$cg	.=	$temp[1].',';
		}
		$sum++;
	}
	if($ds){ //有单式注单要重新核算返水
		$ds			=	rtrim($ds,',');
		$sql		=	"select bid,bet_money,`status` from k_bet where bid in($ds)";
		$query		=	$mysqli->query($sql);
		while($row	=	$query->fetch_array()){
			$fs		=	0;
			if($row['status']==1 || $row['status']==2){ //输赢都有 1% 返水
				//$fs	=	$row['bet_money']/100;
				$fs	=	0;
			}elseif($row['status']==4 || $row['status']==5){ //输一半赢一半都有 0.5% 返水
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
					$true++;
				}else{
					$mysqli->rollback(); //数据回滚
					$false++;
				}
			}catch(Exception $e){
				$mysqli->rollback(); //数据回滚
				$false++;
			}
		}
	}
	
	if($cg){ //有串关注单要重新核算返水
		$cg			=	rtrim($cg,',');
		$sql		=	"select gid,bet_money,`status` from k_bet_cg_group where gid in($cg)";
		$query		=	$mysqli->query($sql);
		while($row	=	$query->fetch_array()){
			$fs		=	0;
			if($row['status']==1){ //输赢都有 1% 返水
				//$fs	=	$row['bet_money']/100;
				$fs	=	0;
			}
			$sql	=	"update k_bet_cg_group set fs=$fs where gid=".$row['gid'];
			$mysqli->autocommit(FALSE);
			$mysqli->query("BEGIN"); //事务开始
			try{
				$mysqli->query($sql);
				$q1		=	$mysqli->affected_rows;
				if($q1 >= 0){
					$mysqli->commit(); //事务提交
					$true++;
				}else{
					$mysqli->rollback(); //数据回滚
					$false++;
				}
			}catch(Exception $e){
				$mysqli->rollback(); //数据回滚
				$false++;
			}
		}
	}
	
	message("共结算：$sum 条注单；\\n成功有：$true 条；\\n失败有：$false 条。","check_userfs.php?action=1&username=".$_POST['username']);
}
?>