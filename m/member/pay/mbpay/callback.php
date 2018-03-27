<?php
/* *
 * 功能：支付回调文件
 * 版本：1.0
 * 日期：2015-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */
 
	require_once("Mobaopay.Config.php");
	require_once("lib/MobaoPay.class.php");
	include_once("../../../include/mysqli.php");

	// 请求数据赋值
	$data = "";
	$data['apiName'] = $_REQUEST["apiName"];
	// 通知时间
	$data['notifyTime'] = $_REQUEST["notifyTime"];
	// 支付金额(单位元，显示用)
	$data['tradeAmt'] = $_REQUEST["tradeAmt"];
	// 商户号
	$data['merchNo'] = $_REQUEST["merchNo"];
	// 商户参数，支付平台返回商户上传的参数，可以为空
	$data['merchParam'] = $_REQUEST["merchParam"];
	// 商户订单号
	$data['orderNo'] = $_REQUEST["orderNo"];
	// 商户订单日期
	$data['tradeDate'] = $_REQUEST["tradeDate"];
	// Mo宝支付订单号
	$data['accNo'] = $_REQUEST["accNo"];
	// Mo宝支付账务日期
	$data['accDate'] = $_REQUEST["accDate"];
	// 订单状态，0-未支付，1-支付成功，2-失败，4-部分退款，5-退款，9-退款处理中
	$data['orderStatus'] = $_REQUEST["orderStatus"];
	// 签名数据
	$data['signMsg'] = $_REQUEST["signMsg"];
	$r6_Order=$data['accNo'];
	$r3_Amt=$data['tradeAmt'];
	//$r6_Order=$data['tradeAmt'];

	//print_r( $data);
	// 初始化
	$cMbPay = new MbPay($mbp_key, $mobaopay_gateway);
	// 准备准备验签数据
	$str_to_sign = $cMbPay->prepareSign($data);
	// 验证签名
	$resultVerify = $cMbPay->verify($str_to_sign, $data['signMsg']);
	//var_dump($data);
	if ($resultVerify) 
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
				//echo  "<br />3秒后自动返回首页";
				//echo  "<script>function g(){location.href='http://www.hz2288.com';} setTimeout('g()',3000)</script>";
			}
			/* 会员入款 结束 */
		}else{
			echo "交易信息被篡改1";
		}
		return true;
	}
	else
	{
		// 签名验证失败
		echo "验证签名失败";
		return false;
	}

?>