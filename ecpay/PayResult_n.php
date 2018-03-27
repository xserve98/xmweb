<?
	error_reporting(0);	
		//MD5私钥
	$MD5key ="";

	//订单号
	$BillNo = $_POST["BillNo"];
	//金额
	$Amount = $_POST["Amount"];
	//支付状态
	$Succeed = $_POST["Succeed"];
	//支付结果
	$Result = $_POST["Result"];
	//取得的MD5校验信息
	$SignMD5info = $_POST["SignMD5info"]; 
	//备注
 



	//校验源字符串
  $md5src = $BillNo."&".$Amount."&".$Succeed."&".$MD5key;
  //MD5检验结果
	$md5sign = strtoupper(md5($md5src));
	
?>
<html>
<head>
<title>php</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<!-- 请加上你们网站的框架。就是你们网站的头部top，左部left等。还有字体等你们都要做调整。 -->

 <?
 if ($SignMD5info==$md5sign){
 ?>
 <!-- MD5验证成功 -->
<table width="728" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td  align="right" valign="top">充值流水号:</td>
    <td  align="left" valign="top"><?=$BillNo?></td>
  </tr>
  <tr>
    <td  align="right" valign="top">充值金额:</td>
    <td align="left" valign="top"><?=$Amount?> </td>
  </tr>
  <tr>
    <td  align="right" valign="top">充值状态:</td>
	<? if ($Succeed=="88") { ?>
    <td align="left" valign="top" style="color:green;"><?=urldecode($Result)?></td><!-- 提交支付信息成功，返回绿色的提示信息 -->
	<!-- 可修改订单状态为正在付款中 -->
	<?
	
	//b

$db_host="127.0.0.1";  
$db_dbname="ssc";
$db_user="root";
$db_pwd="";
	
	$conn=mysql_connect($db_host,$db_user,$db_pwd);
	if(!$conn){
		die("Can not connect:".mysql_error());
	}
	$dbconn=mysql_select_db($db_dbname);
	if(!$dbconn){
		die("Can not select this database:".mysql_error($conn));
	}
	@session_start();//启动session会话
	mysql_query("SET NAMES 'utf8'");//设置字符集和页面代码统一	
	
	
			$r6_Order=$BillNo;
			$r3_Amt = $Amount;
			
$ssql="select * from ssc_member_recharge where state=0 and rechargeId=$r6_Order";
$sresult=mysql_query($ssql);
if($num=mysql_num_rows($sresult)){
  //echo"查找到订单<br>";
  $rss=mysql_fetch_array($sresult);//订单数组赋值
   $sql_u="select * from ssc_members where uid=$rss[uid]";
   $uresult=mysql_query($sql_u);
   if($unum=mysql_num_rows($uresult)){
   //echo"查找到用户记录<br>";
     $rsu=mysql_fetch_array($uresult);//y用户赋值
	 $rechargeTime=time();
	 $afmoney=$rsu["coin"]+$r3_Amt;
     $sql_o="update ssc_member_recharge set state=1,rechargeAmount=$r3_Amt,coin=$rsu[coin],rechargeTime=$rechargeTime where rechargeId=$r6_Order";
	// echo $sql_o;
	  mysql_query($sql_o);
	  
	  $sql_2="insert into ssc_coin_log (uid,type,playedID,coin,userCoin,fcoin,liqType,actionUID,actionTime,ActionIP,info,extfield0,extfield1,extfield2)values('".$rss["uid"]."','0','0','".$r3_Amt."','".$afmoney."','0','1','0','".$rechargeTime."','0','充值','".$r6_Order."','".$r6_Order."','')";
	  
	  mysql_query($sql_2);
	  //  echo "<br>".$sql_2;
	  
	 $sql_u="update ssc_members set coin=coin+$r3_Amt where uid=$rss[uid]";
	//  echo "<br>".$sql_u;
	  mysql_query($sql_u);
	  
   }	
	 
}	mysql_close();
		//e
	
    }
	else 
		{
	?>
	<td  align="left" valign="top" style="color:red;">成功&nbsp;&nbsp;&nbsp;&nbsp; </td><!-- 提交支付信息失败，返回红色的提示信息 -->
	<? } ?>
  </tr>

</table>
<?
 }
else
{
?>
 <!-- MD5验证失败 -->
<table width="728" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
    <td  align="center" valign="top" style="color:red;">失败</td>
	</tr>
	</table>

<? }?>
<p align="center"><a href="#" onClick="javascript:window.close()"><font size=2 color=blove>Close</font></a></p>
</body>
</html>
