<? header("content-Type: text/html; charset=utf-8");?>
<?php
/* *
 功能：智付页面跳转同步通知页面
 版本：3.0
 日期：2013-08-01
 说明：
 以下代码仅为了方便商户安装接口而提供的样例具体说明以文档为准，商户可以根据自己网站的需要，按照技术文档编写。
 * */
include_once("../moneyconfig.php");
include_once("../../../include/mysqli.php");
include_once("../config.php");

//获取智付GET过来反馈信息
//商号号
$merchant_code = $_POST["merchant_code"];

//通知类型
$notify_type = $_POST["notify_type"];

//通知校验ID
$notify_id = $_POST["notify_id"];

//接口版本
$interface_version = $_POST["interface_version"];

//签名方式
$sign_type = $_POST["sign_type"];

//签名
$dinpaySign = $_POST["sign"];

//商家订单号
$order_no = $_POST["order_no"];

//商家订单时间
$order_time = $_POST["order_time"];

//商家订单金额
$order_amount = $_POST["order_amount"];

//回传参数
$extra_return_param = $_POST["extra_return_param"];

//智付交易定单号
$trade_no = $_POST["trade_no"];

//智付交易时间
$trade_time = $_POST["trade_time"];

//交易状态 SUCCESS 成功  FAILED 失败
$trade_status = $_POST["trade_status"];

//银行交易流水号
$bank_seq_no = $_POST["bank_seq_no"];


/**
 *签名顺序按照参数名a到z的顺序排序，若遇到相同首字母，则看第二个字母，以此类推，
*同时将商家支付密钥key放在最后参与签名，组成规则如下：
*参数名1=参数值1&参数名2=参数值2&……&参数名n=参数值n&key=key值
**/


//组织订单信息
$signStr = "";
if($bank_seq_no != "") {
	$signStr = $signStr."bank_seq_no=".$bank_seq_no."&";
}
if($extra_return_param != "") {
	$signStr = $signStr."extra_return_param=".$extra_return_param."&";
}
$signStr = $signStr."interface_version=V3.0&";
$signStr = $signStr."merchant_code=".$merchant_code."&";
if($notify_id != "") {
	$signStr = $signStr."notify_id=".$notify_id."&notify_type=".$notify_type."&";
}

$signStr = $signStr."order_amount=".$order_amount."&";
$signStr = $signStr."order_no=".$order_no."&";
$signStr = $signStr."order_time=".$order_time."&";
$signStr = $signStr."trade_no=".$trade_no."&";
$signStr = $signStr."trade_status=".$trade_status."&";

if($trade_time != "") {
	$signStr = $signStr."trade_time=".$trade_time."&";
}
$key = $pay_mkey;
$signStr = $signStr."key=".$key;
$signInfo = $signStr;
//将组装好的信息MD5签名
$sign = md5($signInfo);
//echo "sign=".$sign."<br>";

//比较智付返回的签名串与商家这边组装的签名串是否一致
if($dinpaySign==$sign) {
	//验签成功
	/**
	此处进行商户业务操作
	业务结束
	*/
	$s_name=$extra_return_param;
	$m_orderid=$order_no;
	$m_oamount=$order_amount;
	
	$sql="select uid,username,money from k_user where username='$s_name' limit 1";
	$query=$mysqli->query($sql);
	$rows=$query->fetch_array();
	$cou=$query->num_rows;
	if($cou<=0){
		echo "返回信息错误!";
		exit;
	}
	$assets=$rows['money'];
	$uid=$rows['uid'];
	$username=$rows['username'];
	echo "SUCCESS".'<br>';
	echo "订单号=".$m_orderid.'<br>';
	echo "金额=".$m_oamount.'<br>';
	$sql="select * from k_money where m_order = '".$m_orderid."'";
	$query=$mysqli->query($sql);
	$cou=$query->num_rows;
	if ($cou==0){
		$sql="insert into k_money(uid,m_value,m_order,status,assets,balance,type) values($uid,$m_oamount,'$m_orderid',2,$assets,$assets+$m_oamount,1)";
		$mysqli->query($sql);
		$m_id=$mysqli->insert_id;
		$sql="update k_money,k_user set k_money.status=1,k_money.update_time=now(),k_user.money=k_user.money+k_money.m_value,k_money.about='该订单在线冲值操作成功',k_money.sxf=k_money.m_value/100,k_money.balance=k_user.money+k_money.m_value where k_money.uid=k_user.uid and k_money.m_id=$m_id and k_money.`status`=2";
		$mysqli->query($sql);
		echo "支付成功";
	}
}else
	{
	//验签失败 业务结束
	echo "支付失败";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<!-- 此处可添加页面展示  提示相关信息给消费者  -->
</body>
</html>