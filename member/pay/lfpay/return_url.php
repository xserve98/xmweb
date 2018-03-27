<?php
include_once("../moneyconfig.php");
include_once("../../../include/mysqli.php");
include_once("./config.php");
include_once("./classes/lefupay_notify.php");;
include_once("../config.php");

if($web_site['close'] == 1) {
	echo "<script>parent.location.href='./close.php';</script>";
    exit();
}
//构造通知函数信息
$lefupay = new lefupay_notify();
//计算得出通知验证结果
$verify_result = $lefupay->return_verify($key,$signType);
if($verify_result)
{
	if($_REQUEST['handlerResult']=="0000")
	{
		$m_orderid = $_REQUEST['outOrderId'];
		$m_oamount = $_REQUEST['amount'];
		list($s_userid,$dddddd) = @explode('-',$m_orderid);
		$s_userid = abs(intval($s_userid));
		$sql="select uid,username,money from k_user where uid={$s_userid} limit 1";
		$query=$mysqli->query($sql);
		$rows=$query->fetch_array();
		$cou=$query->num_rows;
		if($cou<=0){
			echo '用户不存在！';
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
		$msg = "支付成功";
	}
	else 
	{		
		$msg = "支付成功(".$_REQUEST['handlerResult'].")";
	}

}
else
{	
	$msg = "签名错误";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>


<form id="form1">

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

		<tr>

			<td height="30" align="center">

				<h1>

					※ 在线充值完成 ※

				</h1>

			</td>

		</tr>

	</table>

	<table bordercolor="#cccccc" cellspacing="5" cellpadding="0" width="400" align="center"

		border="0">		
<tr>

			<td class="text_12" bordercolor="#ffffff" align="right" width="150" height="20">

				支付状态：</td>

			<td class="text_12" bordercolor="#ffffff" align="left">

			<input  name='_TransID' readonly="readonly" value= "<?php echo $msg;?>" />

				</td>

		</tr>

		<tr>

			<td class="text_12" bordercolor="#ffffff" align="right" width="150" height="20">

				订单号：</td>

			<td class="text_12" bordercolor="#ffffff" align="left">

			<input  name='_TransID' readonly="readonly" value= "<?php echo $_REQUEST['outOrderId'];?>" />

				</td>

		</tr>

		<tr>

			<td class="text_12" bordercolor="#ffffff" align="right" width="150" height="20">

				实际成功金额：</td>

			<td class="text_12" bordercolor="#ffffff" align="left">

			<input  name='_factMoney' readonly="readonly" value= "<?php echo $_REQUEST['amount'];?>"/>

				</td>

		</tr>		

			

	</table> 



</form>

</body>

</html>