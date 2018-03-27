<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");
$page	=	$_GET["page"];
$go		=	$_GET["go"];
$arr	=	$_POST['uid'];
$uid	=	'';
$i		=	0; //会员个数
foreach($arr as $k=>$v){
	$uid .= $v.',';
	$i++;
}
$uid	=	rtrim($uid,',');
echo $go;
if($go == 1){ //停用
	$sql = "UPDATE k_user set is_stop=1,why=concat_ws('，',why,'管理员：".$_SESSION['login_name']." 停用此账户') where uid in ($uid) and is_stop=0";
}else if($go == 0){ //启用
	$sql = "UPDATE k_user set is_stop=0 where uid in ($uid) and is_stop=1";
}else if($go == 3){ //踢线
    $sql = "update k_user_login set `is_login`=0 where uid in ($uid) and `is_login`>0";
}else if($go == 4){
	$sql = "update k_user set is_daili=0 where uid in ($uid) and is_daili=1";
}else if($go == 6){
	$sql = "delete from k_user where uid in ($uid)";
}
else if($go == 7){
	$sql = "UPDATE k_user set is_stop=2 where uid in ($uid)  ";
}

$msg	=	'操作失败！';
$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1==$i){
		$mysqli->commit(); //事务提交
		$msg	=	'操作成功！';
	}else{
		$mysqli->rollback(); //数据回滚
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
}

message($msg,'list.php?page='.$page);
?>