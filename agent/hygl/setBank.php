<?php
include_once("../common/login_check.php"); 
include_once("../../include/mysqli.php");
$sql		=	"select uid,username,pay_card,pay_num,pay_address,pay_name from k_user where pay_num is not null and pay_num!='' order by uid asc";
$query		=	$mysqli->query($sql);
$sum		=	0;
while($row	=	$query->fetch_array()){
	$sql	=	"insert into history_bank (uid,username,pay_card,pay_num,pay_address,pay_name) values (".$row['uid'].",'".$row['username']."','".$row['pay_card']."','".$row['pay_num']."','".$row['pay_address']."','".$row['pay_name']."')";
	$mysqli->query($sql);
	$sum++;
}
echo '本次共添加记录：'.$sum;
exit;
?>