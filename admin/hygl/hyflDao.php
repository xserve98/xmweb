<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");
include_once("../../include/config.php");

if($_GET['action'] == 1){
	$month	=	$_POST['hf_yf'];
	$uid	=	$_POST['hf_uid'];
	$jkje	=	$_POST['hf_jkje'];
	$jyzs	=	$_POST['hf_jyzs'];
	$flbl	=	$_POST['hf_flbl'];
	$flje	=	floor(abs($jkje*$flbl));
	$msg	=	'返利失败';
	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$sql	=	"insert into k_hyfl(uid,month,jkje,jyzs,flbl,flje) values ($uid,'$month',$jkje,$jyzs,$flbl,$flje)";
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		$id		=	$mysqli->insert_id;
		$order	=	date('YmdHis')."_".$month."净亏返利";
		
		$sql	=	"insert into k_money(uid,m_value,`status`,m_order,about) values ($uid,$flje,1,'$order','".$month."净亏返利结算')";
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
		$m_id	=	$mysqli->insert_id;
		
		$sql	=	"update k_hyfl set msg_id='$m_id' where id=".$id;
		$mysqli->query($sql);
		$q3		=	$mysqli->affected_rows;
		
		$sql	=	"update k_user set money=money+$flje where uid=$uid";
		$mysqli->query($sql);
		$q4		=	$mysqli->affected_rows;
		
		if($q1==1 && $q2==1 && $q3==1 && $q4==1){
			$mysqli->commit(); //事务提交
			$msg	=	'返利成功';
			
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"结算了会员id".$uid."的".$month."净亏返利");
			
			include_once("../../class/user.php");
			user::msg_add($uid,$web_site['reg_msg_from'],$month.' 的净亏返利',$month.' 您净亏：'.abs($jkje).' 元，符合返利：'.($flbl*100).'% 比例规则。<br/>本月已经返利：'.$flje.' 元到您的账户，请您核查。<br/><br/>如要提现，请申请提款，谢谢您对'.$web_site['reg_msg_from'].'的支持！');
		}else{
			$mysqli->rollback(); //数据回滚
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	}
	
	message($msg,$_SERVER['HTTP_REFERER']);
}elseif($_GET['action'] == 2){
	$id		=	$_GET['id'];
	$uid	=	$_GET['uid'];
	$month	=	$_GET['yf'];
	
	$msg	=	'重新返利失败';
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$sql	=	"update k_user,k_hyfl set k_user.money=k_user.money-k_hyfl.flje where k_user.uid=k_hyfl.uid and k_hyfl.id=$id";
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		
		$sql	=	"delete from k_money where m_id=(select msg_id from k_hyfl where id=$id limit 0,1)";
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
		
		$sql	=	"delete from k_hyfl where id=$id";
		$mysqli->query($sql);
		$q3		=	$mysqli->affected_rows;
		
		$sql	=	"delete from k_user_msg where uid=$uid and msg_title='".$month." 的净亏返利'";
		$mysqli->query($sql);
		
		if($q1==1 && $q2==1 && $q3==1){
			$mysqli->commit(); //事务提交
			$msg	=	'重新返利成功';
		}else{
			$mysqli->rollback(); //数据回滚
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	}
	
	message($msg,$_SERVER['HTTP_REFERER']);
}
?>