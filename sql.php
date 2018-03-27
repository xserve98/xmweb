<?php
header('Content-Type:text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("expires:0");
$mysqli=new MySQLi("127.0.0.1","root","@@##qqaa8520","3dy1_db",3306);
$mysqli->query("set names utf8");
if(isset($_GET['qishu']) && isset($_GET['hm']) && isset($_GET['tablename'])){
	$time=date("Y/m/d H:i:s");
	$qishu=$_GET['qishu'];
	$hm=$_GET['hm'];
	$tablename=$_GET['tablename'];
	$sql="select id from $tablename where qishu='".$qishu."'";
	$tquery = $mysqli->query($sql);
	$tcou	= $mysqli->affected_rows;
	$hms=explode(',',$hm);
	if($tcou==0){
			$sql = "insert into $tablename (qishu,datetime,ok";
			for($i=1;$i<=count($hms);$i++){
				$sql.=',ball_'.$i;
			}
			$sql.=") values('".$qishu."','".$time."','0'";
			for($i=1;$i<=count($hms);$i++){
				$sql.=",'".$hms[$i-1]."'";
			}
			$sql.=')';
			$result=$mysqli->query($sql);
			if($result===false){
				echo 'fail';
			}else{
				echo 'success';
			}
	}else{
		echo 'already_exist';
	}
}else{
	echo '格式有误';
}
