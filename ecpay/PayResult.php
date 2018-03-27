<?
//error_reporting(0);
		//MD5私钥
include_once("../include/mysqli.php");
include_once("../include/config.php");


		
	$MD5key = "}q]OYbue";

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
	$Remark = $_REQUEST["Remark"];


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
 
 $arr=explode('_',$BillNo);
 $r8_MP=$arr[1];
 $r6_Order=$BillNo;
 $r3_Amt=$Amount;
 
 if ($r8_MP==""){
	    echo "返回信息错误!";
	    exit;
	}else{
		$sql="select uid,username,money from k_user where username='$r8_MP' limit 1";
		$query	=	$mysqli->query($sql);
		$rows	 =	$query->fetch_array();
		$cou	=	$query->num_rows;
		if($cou<=0){
			echo "返回信息错误!";
	    	exit;
		}
		$assets	 =	$rows['money'];
		$uid	 =	$rows['uid'];
		$username=	$rows['username'];
		
	}
	
	
	$sql="select * from k_money where m_order = '".$r6_Order."'";
				$query	=	$mysqli->query($sql);
				$cou	=	$query->num_rows;
				if ($cou==0){
				    $sql		=	"insert into k_money(uid,m_value,m_order,status,assets,balance) values($uid,$r3_Amt,'$r6_Order',2,$assets,$assets)";
					$mysqli->query($sql);
					$m_id = $mysqli->insert_id;
					$sql	=	"update k_money,k_user set k_money.status=1,k_money.update_time=now(),k_user.money=k_user.money+k_money.m_value,k_money.about='该订单在线冲值操作成功',k_money.sxf=k_money.m_value/100,k_money.balance=k_user.money+k_money.m_value where k_money.uid=k_user.uid and k_money.m_id=$m_id and k_money.`status`=2";
					$mysqli->query($sql);
					
			        echo "<Script language=javascript>alert('交易成功,请回首页重新登入.');window.open('/','_top')</script>";
				}
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
