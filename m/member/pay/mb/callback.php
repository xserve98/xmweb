<?php
	header("Content-Type:text/html;charset=utf-8");
	include 'php.config';
	include 'MobaoPay.class.php';
	include_once("../../../include/mysqli.php");


	// 请求数据赋值
	$data = "";
	$data['apiName']=$_REQUEST["apiName"];
	$data['notifyTime']=$_REQUEST["notifyTime"];
	$data['tradeAmt']=$_REQUEST["tradeAmt"];
	$data['merchNo']=$_REQUEST["merchNo"];
	$data['merchParam']=$_REQUEST["merchParam"];
	$data['orderNo']=$_REQUEST["orderNo"];
	$data['tradeDate']=$_REQUEST["tradeDate"];
	$data['accNo']=$_REQUEST["accNo"];	
	$data['accDate']=$_REQUEST["accDate"];
	$data['orderStatus']=$_REQUEST["orderStatus"];
	$data['signMsg']=$_REQUEST["signMsg"];


	$r6_Order=$data['orderNo'];
	$r3_Amt=$data['tradeAmt'];
	// 验证签名
	$cMbPay = new MbPay($pfxFile, $pubFile, $pfxpasswd);
	
	$str_to_sign = $cMbPay->prepareSign($data);
	if ($cMbPay->verify($str_to_sign, $data['signMsg']) ) 
	{
		if ($data['orderStatus'] == "1"){
			/* 会员入款 开始 */
			$sql="select uid,username,money from k_user where username='".$data['merchParam']."' limit 1";
			$query	=	$mysqli->query($sql);
			$rows	=	$query->fetch_array();
			$cou	=	$query->num_rows;
			if($cou<=0){
				echo "返回信息错误!";
				exit;
			}
			$assets	 =	$rows['money'];
			$uid	 =	$rows['uid'];
			$username=	$rows['username'];
			echo "订单号=".$r6_Order.'<br>';
			echo "金额=".$r3_Amt.'<br>';
			echo "币种=".'RMB<br>';
			$sql="select * from k_money where m_order = '".$r6_Order."'";
			$query	=	$mysqli->query($sql);
			$cou	=	$query->num_rows;
			if ($cou==0){
				$sql		=	"insert into k_money(uid,m_value,m_order,status,assets,balance,type) values($uid,$r3_Amt,'$r6_Order',2,$assets,$assets+$r3_Amt,1)";
				$mysqli->query($sql);
				$m_id = $mysqli->insert_id;
				$sql	=	"update k_money,k_user set k_money.status=1,k_money.update_time=now(),k_user.money=k_user.money+k_money.m_value,k_money.about='该订单在线冲值操作成功',k_money.sxf=k_money.m_value/100,k_money.balance=k_user.money+k_money.m_value where k_money.uid=k_user.uid and k_money.m_id=$m_id and k_money.`status`=2";
				$mysqli->query($sql);
				
				echo "交易成功";
				echo  "<br />在线支付页面返回";
			}
			/* 会员入款 结束 */
		}else{
			echo "交易信息被篡改1";
		}
		return true;
	}
	else
	{
		echo "交易信息被篡改2";
		return false;
	}
?>