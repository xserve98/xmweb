<?php
class money{
	static function chongzhi($uid,$order,$money,$assets,$status=2,$about='',$m_type){
	
		global $mysqli;
    	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values ($uid,$money,$status,'$order','$about',$assets,$assets+$money,$m_type)";
		$sql_user	=	"update k_user set money=money+$money where uid=$uid";
		
    	$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql_money);
			$q1		=	$mysqli->affected_rows;
			$mysqli->query($sql_user);
			$q2		=	$mysqli->affected_rows;
			if($q1==1 && $q2==1){
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
		  
	static function tixian($uid,$money,$assets,$pay_card,$pay_num,$pay_address,$pay_name,$order=0,$status=2,$about='',$m_type){
	
		global $mysqli;
    	$sql_user	=	"update k_user set money=money-$money where uid=$uid";
		
    	$money		=	0-$money; //把金额置成带符号数字
    	if($order	==	'0'){
			$order	=	date("YmdHis")."_".$_SESSION['username'];
		}
		$sql_money	=	"insert into k_money(uid,m_value,status,m_order,pay_card,pay_num,pay_address,pay_name,about,assets,balance,type) values($uid,$money,$status,'$order','$pay_card','$pay_num','$pay_address','$pay_name','$about',$assets,$assets+$money,$m_type)";
    	
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql_user);
			$q1		=	$mysqli->affected_rows;
			$mysqli->query($sql_money);
			$q2		=	$mysqli->affected_rows;
			if($q1==1 && $q2==1){
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