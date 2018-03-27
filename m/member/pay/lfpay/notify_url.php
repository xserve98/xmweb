<?php
include_once("../moneyconfig.php");
include_once("../../../include/mysqli.php");
include_once("./config.php");
include_once("./classes/lefupay_notify.php");
include_once("../config.php");
//构造通知函数信息
$lefupay = new lefupay_notify();
$verify_result = $lefupay->notify_verify($key,$signType);
if($verify_result)
{
	$BillNo = $_REQUEST['outOrderId'];
	$Amount = $_REQUEST['amount'];
	if($_REQUEST['handlerResult']=="0000")
	{
		list($s_userid,$dddddd) = @explode('-',$BillNo);
		$m_orderid=$BillNo;
		$m_oamount=$Amount;
		$s_userid = abs(intval($s_userid));
		$sql="select uid,username,money from k_user where uid={$s_userid} limit 1";
		$query=$mysqli->query($sql);
		$rows=$query->fetch_array();
		$cou=$query->num_rows;
		if($cou<=0){
			writeLog($s_userid.'=null');
			echo "SUCCESS";
			exit;
		}
		$assets=$rows['money'];
		$uid=$rows['uid'];
		$username=$rows['username'];
		$sql="select * from k_money where m_order = '".$m_orderid."'";
		$query=$mysqli->query($sql);
		$cou=$query->num_rows;
		if ($cou==0){
			$sql="insert into k_money(uid,m_value,m_order,status,assets,balance,type) values ($uid,$m_oamount,'$m_orderid',2,$assets,$assets+$m_oamount,1)";
			$mysqli->query($sql);
			$m_id=$mysqli->insert_id;
			$sql="update k_money,k_user set k_money.status=1,k_money.update_time=now(),k_user.money=k_user.money+k_money.m_value,k_money.about='该订单在线冲值操作成功',k_money.sxf=k_money.m_value/100,k_money.balance=k_user.money+k_money.m_value where k_money.uid=k_user.uid and k_money.m_id=$m_id and k_money.`status`=2";
			$mysqli->query($sql);
		}
		ob_clean();
		echo "SUCCESS";	
	}
	else 
	{		
		echo "handlerResult=".$_REQUEST['handlerResult'];
	}
}
else
{	
	foreach($_POST as $k=>$v){$reqs .= "&{$k}={$v}";}
	writeLog('fail='.$reqs);
	echo "fail";
}
function writeLog($str){
	$fp = fopen("./log.txt","a");
	flock($fp, LOCK_EX);
	fwrite($fp,$str ." Time: ".date("Y-m-d h:i:s")."\r\n==============================\r\n");
	flock($fp, LOCK_UN); 
	fclose($fp);	
}
?>