<?php
/* *
 * 功能：一般支付处理文件
 * 版本：1.0
 * 日期：2012-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */

include_once("../include/mysqli.php");
$uid     = $_POST["uid"];
$uername =$_POST["username"];
	require_once("Mobaopay.Config.php");
	require_once("lib/MobaoPay.class.php");
////
	$time		= time();
	$orderNo	= date("YmdHis",$time);
	$tradeDate	= date("Ymd",$time); 
	///

	// 请求数据赋值
	$data = "";
	// 商户APINMAE，WEB渠道一般支付
	$data['apiName'] = $mobaopay_apiname_pay;
	// 商户API版本
	$data['apiVersion'] = $mobaopay_api_version;
	// 商户在Mo宝支付的平台号
	$data['platformID'] = $platform_id;
	// Mo宝支付分配给商户的账号
	$data['merchNo'] = $merchant_acc;
	// 商户通知地址
	$data['merchUrl'] = $merchant_notify_url;
	// 银行代码，不传输此参数则跳转Mo宝收银台
	$data['bankCode'] = $_POST["payId"];
	$data['choosePayType'] =$_POST["choosePayType"];
	//商户订单号
	$data['orderNo'] = $orderNo;
	// 商户订单日期
	$data['tradeDate'] = $tradeDate;
	// 商户交易金额
	$data['amt'] = $_POST["amount"];
	// 商户参数
	$data['merchParam'] = '澳洲彩票';
	// 商户交易摘要
	$data['tradeSummary'] = $username.' - 会员充值';
	var_dump($data);exit;
	// 对含有中文的参数进行UTF-8编码
	// 将中文转换为UTF-8
	if(!preg_match("/[\xe0-\xef][\x80-\xbf]{2}/", $data['merchUrl']))
	{
  	$data['merchUrl'] = iconv("GBK","UTF-8", $data['merchUrl']);
	}
	
	if(!preg_match("/[\xe0-\xef][\x80-\xbf]{2}/", $data['merchParam']))
	{

  	$data['merchParam'] = iconv("GBK","UTF-8", $data['merchParam']);
	}

	if(!preg_match("/[\xe0-\xef][\x80-\xbf]{2}/", $data['tradeSummary']))
	{
  	$data['tradeSummary'] = iconv("GBK","UTF-8", $data['tradeSummary']);
	}
	//////////////////插入订单////////////////
	
	//充值方式：bank为网银，card为卡类支付
    $account = $uid;  //充值的账号
    $amount = $_POST['amount'];   //充值的金额
    $sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$rows	 =	$query->fetch_array();
	$assets	 =	sprintf("%.2f",$rows['money']);

if($data['choosePayType']==4){
	$manner="摩宝在线/支付宝";	
}else if($data['choosePayType']==5){
	$manner="摩宝在线/微信";	
} else{
	
	$manner="摩宝在线/网银";	
	
}
   
	$date1 =date("Y-m-d H:i:s", time());
	$sql	=	"Insert Into huikuan (orderid,cztype,money,bank,date,manner,address,adddate,status,uid,lsh,assets,balance) values ('$orderNo',1,$amount,'$payType','$date1','$manner','',now(),0,'".$uid."','".$username.'_'.date("YmdHis")."',$assets,$assets)";
    $mysqli->query($sql);


	
	
	/////////////////////
	// 初始化
	$cMbPay = new MbPay($mbp_key, $mobaopay_gateway);
	// 准备待签名数据
	$str_to_sign = $cMbPay->prepareSign($data);
	// 数据签名
	$sign = $cMbPay->sign($str_to_sign);
	$data['signMsg'] = $sign;
	// 生成表单数据
	echo $cMbPay->buildForm($data, $mobaopay_gateway);
	
	//$cMbPay->mobaopayOrder($data);
?> 