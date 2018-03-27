<?php 
header("Content-type: text/html; charset=utf-8");
session_start();
$uid = intval(@$_SESSION['uid']);
$username = @$_SESSION["username"];
if(!$username){
	echo "<script>alert('请登录后再试！');</script><script>history.go(-1);</script>";exit;
}

include_once("config.php");
$sign = md5($plantform."_".$merID."_".$key."_".$username);

include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../include/mysqli.php");
include_once("../include/mysqlit.php");
include_once("../class/user.php");
include_once("../common/logintu.php");
include_once("../common/function.php");

$loginid=	@$_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$yy = $_REQUEST['zz_money'];
if(ceil($yy)==$yy && $yy > 0){
	$mysqli->autocommit(FALSE);
	$sqlc = "select * from k_user where uid='$uid'";
	$result = $mysqli->query($sqlc);
	$row=$result->fetch_array();
	$conver=htmlEncode(intval($yy));
	$old_money = "".$row["money"];
	if($_REQUEST["zz_type"]=="11" || $_REQUEST["zz_type"]=="12" || $_REQUEST["zz_type"]=="13"){
		if($conver>$row["money"]){
			echo " <script>alert(' 金额错误，请重新输入。');</script><script>history.go(-1);</script>";exit;
		}
		$target = "bb";
		if($_REQUEST["zz_type"]=="12"){
			$target = "ag";
		}else if($_REQUEST["zz_type"]=="13"){
			$target = "mg";
		}
		try{
				$mysqli->query("BEGIN"); //事务开始
				$sql		=	"update k_user set money=money-".abs($yy)." where `uid`=$uid";
				$mysqli->query($sql);//or die($sql);
				$q1			=	$mysqli->affected_rows;
				//$trtype = 7;//7 T0转至体育时时彩
				$trtype = $_REQUEST["zz_type"];
				$status=1;//T0直接转换到体育时时
				$about = "转入".$target;
				$order		=	date("YmdHis")."_".$_SESSION['username'];
				$sql		=	"insert into k_money(uid,m_value,status,m_order,pay_card,pay_num,pay_address,pay_name,about,assets,balance,`type`) values($uid,$yy,$status,'$order','".$row["pay_card"]."','".$row["pay_num"]."','".$row["pay_address"]."','".$row["pay_name"]."','$about',".$row["money"].",".($row["money"]+$yy).",$trtype)";
				//echo $sql;
				$mysqli->query($sql);// or die($sql);
				$q2		=	$mysqli->affected_rows;
				$result = $mysqli->query($sqlc);
				$new=$result->fetch_array();
				$new_money = "".$new['money'];
				$billNO = $merID.time();
				$sql		=	"insert into zz_info(uid,username,old_money,amount,new_money,type,info,actionTime,result,billNO) values($uid,'$username',$old_money,$yy,$new_money,".$_REQUEST["zz_type"].",'转入{$target}', ".time().",'已经提交','$billNO')";
				//echo $sql;
				$mysqli->query($sql);// or die($sql);
				$q3		=	$mysqli->affected_rows;
				$url1 = $fenjieHost."/".$target."!edUp.do?&plantform=".$plantform."&username=".$username."&password=".$password."&ed=".$yy."&sign=".$sign."&billNO=".$billNO."&callback=".$callback;
				//echo $url1;exit;
				$result = curl_file_get_contents($url1);
				if(strstr($result, "success")){
					$sqlx = "update zz_info set result='转账成功',status=1 where billNO='".$billNO."'";
					$mysqli->query($sqlx);// or die($sql);
					$q4=$mysqli->affected_rows;
				}else{
					message('转账已经提交，如果3分钟内未到账，请联系客服处理！');
				}
				if($q1==1 && $q2==1 && $q3==1 && $q4==1){
					$mysqli->commit(); //事务提交
					message("转换成功！");
				}else{
					$mysqli->rollback(); //数据回滚
					message("由于网络堵塞，本次额度转换失败2。\\n请您稍候再试，或联系在线客服。".$q1.$q2.$q3);
				}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			message("由于网络堵塞，本次额度转换失败。\\n请您稍候再试，或联系在线客服。");
		}
		echo "<script>location.href='zr_money.php';</script>";
		exit;
	}else if($_REQUEST["zz_type"]=="21" || $_REQUEST["zz_type"]=="22" || $_REQUEST["zz_type"]=="23"){
		$target = "bb";
		if($_REQUEST["zz_type"]=="22"){
			$target = "ag";
		}else if($_REQUEST["zz_type"]=="23"){
			$target = "mg";
		}
		try{
			$mysqli->query("BEGIN"); //事务开始
			$trtype = $_REQUEST["zz_type"];
			$status=0;//T0直接转换到体育时时
			$about = $target."转出";
			$order		=	date("YmdHis")."_".$_SESSION['username'];
			$sql		=	"insert into k_money(uid,m_value,status,m_order,pay_card,pay_num,pay_address,pay_name,about,assets,balance,`type`) values($uid,$yy,$status,'$order','".$row["pay_card"]."','".$row["pay_num"]."','".$row["pay_address"]."','".$row["pay_name"]."','$about',".$row["money"].",".($row["money"]+$yy).",$trtype)";
			$mysqli->query($sql);// or die($sql);
			$q2		=	$mysqli->affected_rows;
			$result = $mysqli->query($sqlc);
			$new=$result->fetch_array();
			$old_money = "".$new['money'];
			$new_money = $old_money + $yy;
			$billNO = $merID.time();
			$sql		=	"insert into zz_info(uid,username,old_money,amount,new_money,type,info,actionTime,result,billNO) values($uid,'$username',$old_money,$yy,$new_money,".$_REQUEST["zz_type"].", '{$target}转出', ".time().",'提交处理','$billNO')";
			$mysqli->query($sql);// or die($sql);
			$q3		=	$mysqli->affected_rows;
			$url2 = $fenjieHost."/".$target."!edDown.do?plantform=".$plantform."&username=".$username."&password=".$password."&ed=".$yy."&sign=".$sign."&billNO=".$billNO."&callback=".$callback;
			$result = curl_file_get_contents($url2);
			if(strstr($result, "success")){
				$sql		=	"update k_user set money=money+".abs($yy)." where `uid`=$uid";
				$mysqli->query($sql);//or die($sql);
				$q1			=	$mysqli->affected_rows;
				$sqlx = "update zz_info set result='转账成功',status=1 where billNO='".$billNO."'";
				$mysqli->query($sqlx);// or die($sql);
				$q4=$mysqli->affected_rows;
			}else{
				message('转账已经提交，如果3分钟内未到账，请联系客服处理！');
			}
			if($q1==1 && $q2==1 && $q3==1 && $q4==1){
				$mysqli->commit(); //事务提交
				message("转换成功！");
			}else{
				$mysqli->rollback(); //数据回滚
				message("由于网络堵塞，本次额度转换失败2。\\n请您稍候再试，或联系在线客服。");
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			message("由于网络堵塞，本次额度转换失败。\\n请您稍候再试，或联系在线客服。");
		}
		echo "<script>location.href='zr_money.php';</script>";
		exit;
	}else{
		echo " <script>alert('参数错误，请重试。');</script><script>history.go(-1);</script>";exit;
	}
}else{
	echo " <script>alert('金额错误，请重新输入。');</script><script>history.go(-1);</script>";exit;
}
?>