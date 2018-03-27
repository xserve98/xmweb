<?php
include_once("../common/login_check.php");
check_quanxian("dlgl");
include_once("../../include/mysqli.php");
include_once("../../include/function_dled.php");

$month		=	$_POST["month"];
$lastTime	=	date("Y-m-d H:i:s",strtotime("$month"."-1 23:59:59"." +1 month")-1); //本月月末时间
$arr		=	$_POST["r_id"];
$msg		=	'结算失败';
$uid1		=	'';
foreach($arr as $k=>$v){
	$uid1	.=	$v.',';
}
if($uid1){
	$uid1	=	rtrim($uid1,',');
	$yxxj	=	array();
	$sql	=	"select top_uid,count(top_uid) as s from k_user where top_uid in($uid1) and money>0 and reg_date like('$month%') group by top_uid"; //取出该代理本月有效下级个数
	$query	= $mysqli->query($sql);
	while($rows = $query->fetch_array()){
		$yxxj[$rows['top_uid']]	=	$rows['s'];
	}
	
	foreach($arr as $k=>$uid){
		$yk		=	getDLED($uid,$month.'-1 00:00:00',$lastTime); //取本月代理盈亏额度
		$bl		=	get_point($yk);
		$jg		=	floor($yk*$bl);
		$yxxj[$uid]	=	$yxxj[$uid] ? $yxxj[$uid] : 0;
	
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$sql	=	"insert into k_user_daili_result(uid,month,shuying,`point`,result,yxxj) values ($uid,'$month',$yk,$bl,$jg,".$yxxj[$uid].")";
			$mysqli->query($sql);
			$q1		=	$mysqli->affected_rows;
			if($q1 == 1){
				$mysqli->commit(); //事务提交
				$msg	=	'结算成功';
				
				include_once("../../class/admin.php");
				admin::insert_log($_SESSION["adminid"],"结算了会员id".$uid."的".$month."代理额度");
			}else{
				$mysqli->rollback(); //数据回滚
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
		}
	}
}

message($msg,$_SERVER['HTTP_REFERER']);
?>
