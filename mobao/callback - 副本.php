<?php
/* *
 * 功能：支付回调文件
 * 版本：1.0
 * 日期：2015-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */
    include_once("../include/mysqli.php");
	require_once("Mobaopay.Config.php");
	require_once("lib/MobaoPay.class.php");

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

	//print_r( $data);
	// 初始化
	$cMbPay = new MbPay($mbp_key, $mobaopay_gateway);
	// 准备准备验签数据
	$str_to_sign = $cMbPay->prepareSign($data);
	// 验证签名
	$resultVerify = $cMbPay->verify($str_to_sign, $data['signMsg']);
	//var_dump($data);
	if ('1' == $_REQUEST["notifyType"]) 
	{
		/*if () {
			$url = "notify.php";
			Header("Location: $url");
			return true;
		}*/
	
	$orderid=$data["orderNo"];
	 if ($data['orderStatus'] == '1')// 需更新商户系统订单状态
		{
			
$sql ="select * from huikuan where orderid='$orderid' ";
$query	=	$mysqli->query($sql);
$q1		=	$mysqli->affected_rows;
$rs		=	$query->fetch_array();

if($rs['status']==0){
	/*
if($rs['bank']=='1004')	{
	$about="微信支付".$orderid;
}else if($rs['bank']=='992'){
	$about="支付宝".$orderid;	
}else{
	$about="网银支付".$orderid;	
}	
$status=$rs['status'];
}*/

$uid=$rs['uid'];
$ovalue=$data['tradeAmt'];
$about="摩宝在线充值";	
$sql ="select * from k_user where uid='$uid' ";

$query	=	$mysqli->query($sql);
$q1		=	$mysqli->affected_rows;
$rs2		=	$query->fetch_array();
$assets=$rs2['money'];
		$sql1	=	"update huikuan set status=1 where orderid='$orderid' ";
	///	$mysqli->query($sql);
		////////////chu处理订单状态///
		$sql2= "update k_user set money = money+$ovalue where uid='$uid'";		
		///$mysqli->query($sql);
		////////处理会员余额////////
		$sql3		=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values($uid,$ovalue,1,'$orderid','$about','$assets',".($assets+$ovalue).",1)";
		///$mysqli->query($sql);
		//$q2		=	$mysqli->affected_rows;
		//////////////写入变动		
		
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql1);
		$q1		=	$mysqli->affected_rows;
		$mysqli->query($sql2);
		$q2		=	$mysqli->affected_rows;
	    $mysqli->query($sql3);
		$q3		=	$mysqli->affected_rows;
		if($q1 == 1&&$q2==1&&$q3==1){
		$mysqli->commit(); //事务提交
		echo "SUCCESS";
		echo '<script>window.close();</script>'; 
		return true;
			
		}else{
			$mysqli->rollback(); //数据回	
		
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚

	}	
		
		
		
		
		}				
	}
			
	///	else if ($data['orderStatus'] == '2')// 需更新商户系统订单状态
		//	echo "失败[".$data['orderStatus']."]";
	//	else if ($data['orderStatus'] == '4')// 需更新商户系统订单状态
		///	echo "部分退货[".$data['orderStatus']."]";
	///	else if ($data['orderStatus'] == '5')// 需更新商户系统订单状态
		//	echo "全部退货[".$data['orderStatus']."]";
		//else if ($data['orderStatus'] == '9')// 需更新商户系统订单状态
			//echo "退款处理中[".$data['orderStatus']."]";
		//else if ($data['orderStatus'] == '11')
			//echo "订单过期[".$data['orderStatus']."]";
		//else
			//echo "其他[".$data['orderStatus']."]";

		/*商户需要在此处判定通知中的订单状态做后续处理*/
		/*由于页面跳转同步通知和异步通知均发到当前页面，所以此处还需要判定商户自己系统中的订单状态，避免重复处理。*/
		
	}
	else
	{
		// 签名验证失败
		echo "验证签名失败";
		echo '<script>window.close();</script>'; 
		return false;
	}

?>