
<?
     $defaultBankNumber =$_REQUEST["pd_FrpId"];   //[选填]银行代码s 
	  
	  if ($defaultBankNumber=="NOCARD"){
	     $MD5key = "}q]OYbue";		//MD5私钥
         $MerNo = "25346";					//商户号
		  $ReturnURL = "http://hcpay.1688618.com/ecpay/PayResult_n.php"; 
		  $AdviceURL ="http://hcpay.1688618.com/ecpay/PayResult_n.php";  
	  }else
	  {
	   $MD5key = "}q]OYbue";		//MD5私钥
       $MerNo = "25346";					//商户号
	   $ReturnURL = "http://hcpay.1688618.com/ecpay/PayResult.php"; 
       $AdviceURL ="http://hcpay.1688618.com/ecpay/PayResult.php";  
	  }
	  
    $username=trim($_REQUEST["pa_MP"]);
     $BillNo =date('YmdHis').rand(100,200)."_".$username;		//[必填]订单号(商户自己产生：要求不重复)
     $Amount = $_REQUEST["p3_Amt"];		//[必填]订单金额
  
    			//[必填]返回数据给商户的地址(商户自己填写):::注意请在测试前将该地址告诉我方人员;否则测试通不过
     $Remark = "";  //[选填]升级。
     

    $md5src = $MerNo."&".$BillNo."&".$Amount."&".$ReturnURL."&".$MD5key;		//校验源字符串
    $SignInfo = strtoupper(md5($md5src));		//MD5检验结果


	  //[必填]支付完成后，后台接收支付结果，可用来更新数据库值
	 $orderTime =date('YmdHis');   //[必填]交易时间YYYYMMDDHHMMSS
	

	 //送货信息(方便维护，请尽量收集！如果没有以下信息提供，请传空值:'')
	 //因为关系到风险问题和以后商户升级的需要，如果有相应或相似的内容的一定要收集，实在没有的才赋空值,谢谢。

    $products=$username;// '------------------物品信息

?>
<html>
<head>
<title>Payment By CreditCard online</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body onLoad="javascript:document.py.submit();">
<form name="py" action="http://hcpay.1688618.com/i.php" method="post"  >
  <table align="center">
    
    <tr>
      <td></td>
      <td><input type="hidden" name="MerNo" value="<?=$MerNo?>"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="hidden" name="BillNo" value="<?=$BillNo?>"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="hidden" name="Amount" value="<?=$Amount?>"></td>
    </tr>

    <tr>
      <td></td>
      <td><input type="hidden" name="ReturnURL" value="<?=$ReturnURL?>" ></td>
    </tr>
    
	 <tr>
      <td></td>
      <td><input type="hidden" name="AdviceURL" value="<?=$AdviceURL?>" ></td>
    </tr>
	 <tr>
      <td></td>
      <td><input type="hidden" name="orderTime" value="<?=$orderTime?>"></td>
    </tr>
    
	 <tr>
      <td></td>
      <td><input type="hidden" name="defaultBankNumber" value="<?=$defaultBankNumber?>"></td>
    </tr>

    <tr>
      <td></td>
      <td><input type="hidden" name="SignInfo" value="<?=$SignInfo?>"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="hidden" name="Remark" value="<?=$Remark?>"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="hidden" name="products" value="<?=$products?>"></td>
    </tr>
  </table>
  <p align="center">&nbsp;
     
  </p>
</form>
</body>
</html>
