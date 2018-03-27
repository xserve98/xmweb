<?php
@session_start();
//print_r($_COOKIE);
$uid		= @$_SESSION["uid"];
	include_once("include/mysqli.php");
	include_once("include/mysqlis.php");
	include_once("common/logintu.php");
	
	
	//投注金额 
	if($uid && $uid>0){ //已登陆
		$sql		=	"SELECT sum(bet_money) as s FROM `k_bet` where uid=$uid and status=0";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$tz_money	=	$rs['s'];
		
		$sql		=	"select sum(bet_money) as s from k_bet_cg_group where uid=$uid and status=0";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$tz_money	+=	$rs['s'];
		
		
		$sql		=	"select count(*) as s from k_user_msg where uid=$uid and islook=0"; //未查看消息
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$user_num	=	$rs['s'];
		
		$sql		=	"select money as s from k_user where uid=$uid limit 1";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$user_money	=	sprintf("%.2f",$rs['s']);
	}
	unset($mysqlis);	

                          if($uid){
                        ?>  <input type="hidden" name="username" id="username" value="<?=$_SESSION["username"];?>">                   
                        
                        <?php } ?>