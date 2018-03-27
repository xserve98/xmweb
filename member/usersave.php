<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("function.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);
$data= array_filter($_POST);
$pay_name=$data['userName'];
$birthDay=$data['birthDay'];
$sex=$data['sex'];
$sqla="select * from k_user where uid = '$uid'  limit 1";
$query	 =	$mysqli->query($sqla);
$rs	 =	$query->fetch_array();
if($rs['pay_name']){
	$name=$rs['pay_name'];
	}else{
		$name=$data['userName'];
		}
		
		
$sql="update k_user set pay_name='$name',birthDay='$birthDay',sex=$sex where uid='$uid' ";
$mysqli->query($sql);
$sum	=	$mysqli->affected_rows; //总页数
// echo json_encode($data);
if($sum>0){

	$arr['success']='True';
	 echo json_encode($arr);
	}else{
		$arr['error']='True';
		 echo json_encode($arr);
		}

?>
