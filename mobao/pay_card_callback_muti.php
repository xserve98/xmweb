<?php
/* *
 * 功能：支付回调文件
 * 版本：1.0
 * 日期：2015-03-26
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码。
 */
 session_start();
    include_once("../include/mysqli.php");
	require_once("./Gfpay.config.php");
	include_once("./mnouvw/class.bankpay.php");
	file_put_contents("./callcard.txt", json_encode($_GET)."\r\n",FILE_APPEND);	
	//if($_GET['opstate'] == "0"){
		$orderid = $_GET['orderid'];   //平台订单号

		$uid=$_SESSION['uid'];
		echo $uid;
		exit();
		$ovalue=$data['tradeAmt'];
		$about="国易付在线充值";	
		$ovalue = $_GET['ovalue'];       //订单金额
		$sql ="select * from k_user where uid='$uid' ";
		$query	=	$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		$rs2		=	$query->fetch_array();

		$assets=$rs2['money'];
				$sql1	=	"update huikuan set status=1 where orderid='$orderid' ";
				$show = $mysqli->query($sql1);
				////////////chu处理订单状态///
				$sql2= "update k_user set money = money+". $ovalue ." where uid='$uid'";		
				$show = $mysqli->query($sql2);
				////////处理会员余额////////
				$sql3		=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values($uid,$ovalue,1,'$orderid','$about','$assets',".($assets+$ovalue).",1)";
				
				$mysqli->query($sql3);
				//$q2		=	$mysqli->affected_rows;
				//////////////写入变动		
				
			/*$mysqli->autocommit(FALSE);
			$mysqli->query("BEGIN"); //事务开始
			try{
				$mysqli->query($sql1);
				$q1		=	$mysqli->affected_rows;
				$mysqli->query($sql2);
				$q2		=	$mysqli->affected_rows;
				$mysqli->query($sql3);
				$q3		=	$mysqli->affected_rows;
				if($q1 == 1&&$q2==1&&$q3==1){
				$mysqli->commit(); //事务提交*/
				//echo "SUCCESS";
				die("opstate=0")	
	/*}else{
		echo "error";
	}*/

?>