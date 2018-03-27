<?php 
//API调用文件
include_once("../moneyconfig.php");
include_once("./config.php");
require_once("./classes/lefupay_function.php");
require_once("./classes/lefupay_service.php");													
$buyerContactType = "email";
$uid = $_POST['_AdditionalInfo'];
$outOrderId = $uid.'-'.date("YmdHis");
$submitTime = date('YmdHis');
$amount = $_POST['MOAmount'];
$redirectURL = "http://".$_SERVER['HTTP_HOST']."/pay/lfpay/return_url.php";
$notifyURL = "http://".$_SERVER['HTTP_HOST']."/pay/lfpay/notify_url.php";
$parameter = array(
	"outOrderId"	    => $outOrderId,	
	"apiCode"		    => $apiCode,               			        
	"buyer"			    => $_POST['S_Name']?$_POST['S_Name']:$buyer,
	"buyerContact"		=> $buyerContact,
	"currency"		    => $currency,
	"inputCharset"		=> $inputCharset,
	"partner"	        => $partner,
	"amount"	        => $amount,
	"paymentType"		=> $paymentType,
	"redirectURL"		=> $redirectURL,
	"notifyURL"         => $notifyURL,
	"retryFalg"			=> $retryFalg,
	"signType"			=> $signType,
	"submitTime"		=> $submitTime,
	"timeout"		    => $timeout,
	"versionCode"       => $versionCode,
	"buyerContactType"  => $buyerContactType,
	'extParam'          => $uid,
);
if ($_POST['pd_FrpId']){
	$parameter['interfaceCode']  = $_POST['pd_FrpId'];
}
$lefu = new lefupay_service($parameter,$key,$signType);
$sHtmlText = $lefu->BuildForm();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<?php
echo $sHtmlText;
?>
</body>
</html>