<?php 
header("Content-type: text/html; charset=utf-8");

include_once("config.php");

$billNO = $_GET['billNO'];
if(strlen($billNO) > 24){
	echo "failed, billNO error!";exit;
}
$ed = $_GET['ed'];
if(!is_numeric($ed)){
	echo "failed, ed error!";exit;
}

//$sign = md5($plantform.''.$billNO.$merID.$ed.$key);
//if($sign != $_GET['key']){
	//echo $sign." -- ".$_GET['key']."failed, sign error!";exit;
//}

include_once("../include/config.php");
include_once("../include/mysqli.php");
include_once("../include/mysqlit.php");
include_once("../common/function.php");
try{
	$query = "select * from zz_info where `billNO`=".$billNO;
	//echo $query;
	$result = $mysqli->query($query);
	$info = $result->fetch_array();
	if($info['amount'] - $ed != 0){
		echo "failed, ed not same!";exit;
	}
	if(!$info['status']){
		try{
			$mysqli->query("BEGIN"); //事务开始
			if($info['type'] == 21 || $info['type'] == 22 || $info['type'] == 23 || $info['type'] == 24 || $info['type'] == 25){
				$sql		=	"update k_user set money=money+".abs($ed)." where `uid`={$info['uid']}";
				$mysqli->query($sql);//or die($sql);
				$q1			=	$mysqli->affected_rows;
			}
			$sqlx = "update zz_info set result='转账成功',status=1 where billNO='".$billNO."'";
			$mysqli->query($sqlx);// or die($sql);
			$q2=$mysqli->affected_rows;
			if($q1==1 && $q2==1){
				$mysqli->commit();
				echo "success, uping";
			}
			$mysqli->rollback();
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
		}
		echo "failed, error int uping";
	}else{
		echo "success, uped";
	}
}catch(Exception $e){
	echo "failed, error!";
}
?>