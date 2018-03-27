<?php
class bet{
    static function set($bid,$status,$sorce){ //审核当前投注项1，2， 4，5 赢，输，赢一半，输一半
	
		$sql	=	"";
		$msg	=	"";
    	switch ($status){
    		case "1": //赢
    			$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_win+(k_bet.bet_money*0.01),k_bet.win=k_bet.bet_win,k_bet.status=1 ,k_bet.update_time=now(),k_bet.MB_Inball='$sorce',fs=(k_bet.bet_money*0.01) where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
                $msg	=	"审核了编号为".$bid."的注单,设为赢";
				break; 
   			case "2": //输
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money+(k_bet.bet_money*0.01),status=2,update_time=now(),k_bet.MB_Inball='$sorce',fs=(k_bet.bet_money*0.01) where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
   				$msg	=	"审核了编号为".$bid."的注单,设为输";
   				break;
   		    case "3": //无效或取消
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_money,k_bet.win=k_bet.bet_money,k_bet.status=3,k_bet.update_time=now(),k_bet.sys_about='批量无效',k_bet.MB_Inball='$sorce' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
   				$msg	=	"审核了编号为".$bid."的注单,设为取消";
   				break;
   		    case "8": //和局
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_money,k_bet.win=k_bet.bet_money,k_bet.status=8,k_bet.update_time=now(),k_bet.MB_Inball='$sorce' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
   				$msg	=	"审核了编号为".$bid."的注单,设为和";
   				break;				
			default:break;
    	}
		//echo $sql;exit;
		global $mysqli;
		global $mysqlio;
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			$q1	=	$mysqli->affected_rows;
			if($q1 == 2 || $q1 == 1){
				$mysqli->commit(); //事务提交
				
				$mysqlio->query("insert into sys_log(uid,log_info,log_ip) values('".$_SESSION["adminid"]."','$msg','".$_SERVER['REMOTE_ADDR']."')");
				
				return  true;
			}else{
				$mysqli->rollback(); //数据回滚
				return  false;
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			return  false;
		}
    }
	
	
	static function qx_bet($bid,$status){ //单式重新结算
    	
		global $mysqli;
		$money		=	0;
		if($status==1 || $status==2 || $status==4 || $status==5){ //有退水
			$sql	=	"select bet_money from k_bet where bid=$bid";
			$query	=	$mysqli->query($sql);
			$row 	=	$query->fetch_array();
			if($status	==1 || $status	==2){ //输赢
				$money	=	$row['bet_money']*0.01;
			}
			if($status	==4 || $status	==5){
				$money	=	$row['bet_money']*0.005;
			}
		}
		
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$sql		=	"update k_bet,k_user set k_user.money=k_user.money-k_bet.win-$money where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status>0";
			$mysqli->query($sql);
			$q1			=	$mysqli->affected_rows;
			$sql		=	"update k_bet set status=0,win=0,update_time=null,fs=0 where k_bet.bid=$bid and k_bet.status>0";
			$mysqli->query($sql);
			$q2			=	$mysqli->affected_rows;
			if($q1==1 || $q2==1){
				$mysqli->commit(); //事务提交
				return true;
			}else{
				$mysqli->rollback(); //数据回滚
				return false;
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			return false;
		}
	}
	

}
?>