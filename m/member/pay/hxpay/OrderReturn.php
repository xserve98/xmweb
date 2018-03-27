<?php
header("Content-type:text/html; charset=gb2312"); 
include_once("../moneyconfig.php");
include_once("../../../include/mysqli.php");
include_once("../config.php");
//----------------------------------------------------
//  接收数据
//  Receive the data
//----------------------------------------------------
$billno = $_GET['billno'];
$amount = $_GET['amount'];
$mydate = $_GET['date'];
$succ = $_GET['succ'];
$msg = $_GET['msg'];
$attach = $_GET['attach'];
$ipsbillno = $_GET['ipsbillno'];
$retEncodeType = $_GET['retencodetype'];
$currency_type = $_GET['Currency_type'];
$signature = $_GET['signature'];

//'----------------------------------------------------
//'   Md5摘要认证
//'   verify  md5
//'----------------------------------------------------

//RetEncodeType设置为17（MD5摘要数字签名方式）
//交易返回接口MD5摘要认证的明文信息如下：
//billno+【订单编号】+currencytype+【币种】+amount+【订单金额】+date+【订单日期】+succ+【成功标志】+ipsbillno+【IPS订单编号】+retencodetype +【交易返回签名方式】+【商户内部证书】
//例:(billno000001000123currencytypeRMBamount13.45date20031205succYipsbillnoNT2012082781196443retencodetype17GDgLwwdK270Qj1w4xho8lyTpRQZV9Jm5x4NwWOTThUa4fMhEBK9jOXFrKRT6xhlJuU2FEa89ov0ryyjfJuuPkcGzO5CeVx5ZIrkkt1aBlZV36ySvHOMcNv8rncRiy3DQ)

//返回参数的次序为：
//billno + mercode + amount + date + succ + msg + ipsbillno + Currecny_type + retencodetype + attach + signature + bankbillno
//注2：当RetEncodeType=17时，摘要内容已全转成小写字符，请在验证的时将您生成的Md5摘要先转成小写后再做比较
$content = 'billno'.$billno.'currencytype'.$currency_type.'amount'.$amount.'date'.$mydate.'succ'.$succ.'ipsbillno'.$ipsbillno.'retencodetype'.$retEncodeType;
//请在该字段中放置商户登陆merchant.ips.com.cn下载的证书
$cert = $pay_mkey;
$signature_1ocal = md5($content . $cert);

if ($signature_1ocal == $signature)
{
	//----------------------------------------------------
	//  判断交易是否成功
	//  See the successful flag of this transaction
	//----------------------------------------------------
	if ($succ == 'Y')
	{
		/**----------------------------------------------------
		*比较返回的订单号和金额与您数据库中的金额是否相符
		*compare the billno and amount from ips with the data recorded in your datebase
		*----------------------------------------------------
		
		if(不等)
			echo "从IPS返回的数据和本地记录的不符合，失败！"
			exit
		else
			'----------------------------------------------------
			'交易成功，处理您的数据库
			'The transaction is successful. update your database.
			'----------------------------------------------------
		end if
		**/
		echo '交易成功';
        
        /* 会员入款 开始 */
        $sql="select uid,username,money from k_user where username='$attach' limit 1";
		$query	=	$mysqli->query($sql);
		$rows   =	$query->fetch_array();
		$cou	=	$query->num_rows;
		if($cou<=0){
			echo "返回信息错误!";
	    	exit;
		}
		$assets	 =	$rows['money'];
		$uid	 =	$rows['uid'];
		$username=	$rows['username'];
        echo "支付成功".'<br>';
        echo "订单号=".$billno.'<br>';
        echo "金额=".$amount.'<br>';
        echo "币种=".$currency_type.'<br>';
        $sql="select * from k_money where m_order = '".$billno."'";
        $query	=	$mysqli->query($sql);
        $cou	=	$query->num_rows;
        if ($cou==0){
            $sql	=	"insert into k_money(uid,m_value,m_order,status,assets,balance,type) values($uid,$amount,'$billno',2,$assets,$assets+$amount,1)";
            $mysqli->query($sql);
            $m_id = $mysqli->insert_id;
            $sql	=	"update k_money,k_user set k_money.status=1,k_money.update_time=now(),k_user.money=k_user.money+k_money.m_value,k_money.about='该订单在线冲值操作成功',k_money.sxf=k_money.m_value/100,k_money.balance=k_user.money+k_money.m_value where k_money.uid=k_user.uid and k_money.m_id=$m_id and k_money.`status`=2";
            $mysqli->query($sql);
			echo "支付成功";
        }
        /* 会员入款 结束 */
	}
	else
	{
		echo '交易失败！';
		exit;
	}
}
else
{
	echo '签名不正确！';
	exit;
}
?>