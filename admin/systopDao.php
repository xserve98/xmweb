<?php
session_start();
header('Content-type: text/json; charset=utf-8');
include_once("../include/mysqli.php");
include_once("../include/mysqlio.php");
include_once("../include/mysqlit.php");

$callback	=	$_GET['callback'];
$tknum		=	$ssnum = $hknum = $tsjynum = $dlsqnum = $cgnum = 0;
$quanxian	=	$_SESSION["quanxian"];
$sql		=	"update k_money set `status`=0,update_time=now(),about='该订单系统操作失败',balance=assets where type=1 and `status`=2 and m_value>0 and m_make_time<=DATE_SUB(now(),INTERVAL 30 MINUTE)"; //半个小时存款未成功，自动设为存款失败

$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1 > 0){
		$mysqli->commit(); //事务提交
	}else{
		$mysqli->rollback(); //数据回滚
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
}

$sql		=	"update sys_admin set updatetime=".time()." where is_login=1 and uid=".intval($_SESSION["adminid"]); //更新操作时间
$mysqlio->query($sql);
$time		=	time()-86400; //5分钟未更新，则为离线状态
$sql		=	"update sys_admin set is_login=0 where is_login=1 and updatetime<$time"; //更新操作时间
$mysqlio->query($sql);
/*
/* 删除30分钟没有动的用户 
$intimes = time();
$outtimes = $intimes - 1800;
$mysqli->query("update `k_user_login` set `is_login`=0 WHERE login_time<$outtimes and `is_login`>0");
*/
$today		=	date('Y-m-d H:i:s');
$today_day	=	date('Y-m-d');
if(strpos($today,' 23:59:3') || strpos($today,' 23:59:4') || strpos($today,' 23:59:5')){ //一天结束，要保存会员当天余额
	$sql	=	"select id from save_user where `addtime` like ('$today_day%') limit 1";
	$query	=	$mysqlio->query($sql);
	$rs		=	$query->fetch_array();
	if($rs['id'] > 0){ //已保存，不用再保存
	}else{
		$user	=	array();
		$uid	=	'';
		$sql	=	"select uid,username,money from k_user where is_stop=0 and is_delete=0 and money>0"; //会员账户有钱，且未被删除或停用
		$query	=	$mysqli->query($sql);
		while($rs=	$query->fetch_array()){
			$user[$rs['uid']]['money']		=	$rs['money'];
			$user[$rs['uid']]['username']	=	$rs['username'];
			$uid		.=	$rs['uid'].',';
			$username	.=	"'".$rs['username']."',";
			$arruser[$rs['username']]	=	$rs['uid'];
		}
		$uid		=	rtrim($uid,',');
		$username	=	rtrim($username,',');
		if($uid){
			$bid_gid=	array();
			//未结算单式
			$sql	=	"select uid,number from k_bet where `status`=0 and uid in ($uid)";
			$query	=	$mysqli->query($sql);
			while($rs=	$query->fetch_array()){
				$bid_gid[$rs['uid']]	.=	$rs['number'].',';
			}
			//未结算串关
			$sql	=	"select uid,gid from k_bet_cg_group where `status` in (0,2) and uid in ($uid)";
			$query	=	$mysqli->query($sql);
			while($rs=	$query->fetch_array()){
				$bid_gid[$rs['uid']]	.=	$rs['gid'].',';
			}
			foreach($user as $uid=>$arr){
				$bid_gid[$uid]	=	rtrim($bid_gid[$uid],',')."#";
			}
			//未结算六合
			$sql	=	"select username,num from ka_tan where `checked`=0 and username in ($username)";
			$query	=	$mysqlit->query($sql);
			while($rs=	$query->fetch_array()){
				$current_uid			=	$arruser[$rs['username']];
				$bid_gid[$current_uid]	.=	$rs['num'].',';
			}
			foreach($user as $uid=>$arr){
				$bid_gid[$uid]	=	rtrim($bid_gid[$uid],',')."#";
			}
			//未结算重庆时时彩
			$sql	=	"select uid,id from c_bet where `js`=0 and uid in ($uid)";
			$query	=	$mysqli->query($sql);
			while($rs=	$query->fetch_array()){
				$bid_gid[$rs['uid']]	.=	$rs['id'].',';
			}
			foreach($user as $uid=>$arr){
				$bid_gid[$uid]	=	rtrim($bid_gid[$uid],',')."#";
			}
			//未结算时时彩
			$sql	=	"select uid,id from c_bet where `js`=0 and uid in ($uid)";
			$query	=	$mysqli->query($sql);
			while($rs=	$query->fetch_array()){
				$bid_gid[$rs['uid']]	.=	$rs['id'].',';
			}
			foreach($user as $uid=>$arr){
				$bid_gid[$uid]	=	rtrim($bid_gid[$uid],',')."#";
			}
			//未结算彩票
			$sql	=	"select username,uid as number from lottery_data where `bet_ok`=0 and username in ($username)";
			$query	=	$mysqli->query($sql);
			while($rs=	$query->fetch_array()){
				$current_uid			=	$arruser[$rs['username']];
				$bid_gid[$current_uid]	.=	$rs['number'].',';
			}
			
			foreach($user as $uid=>$arr){
				$sql=	"insert into save_user(uid,username,money,bid_gid,addtime) values ($uid,'".$arr['username']."',".$arr['money'].",'".rtrim($bid_gid[$uid],',')."','$today')";
				$mysqlio->query($sql);
			}
		}
	}
}

/*
$today	=	substr($today,14);
if(strpos($today,':1') || strpos($today,':2') || strpos($today,':3')){ //每分钟校验一次
	$str	 =	"<?php\r\n";
	$str	.=	"unset(\$checkFileList);\r\n";
	$str	.=	"\$checkFileList=array();\r\n";
	
	include('xtgl/function.php');
	saveTree("../../web",'checkFileList',3);

	function write_file($filename,$data,$method="rb+",$iflock=1){
		@touch($filename);
		$handle=@fopen($filename,$method);
		if($iflock){
			@flock($handle,LOCK_EX);
		}
		@fputs($handle,$data);
		if($method=="rb+") @ftruncate($handle,strlen($data));
		@fclose($handle);
		@chmod($filename,0777);	
		if( is_writable($filename) ){
			return true;
		}else{
			return false;
		}
	}
	
	function showTree($result,$fileList,$checkFileList,$ml=''){
		foreach($result as $file=>$time){
			if(strpos($file,'.')){
				if(checkFile($ml,$file,$fileList,$checkFileList)){
					$_SESSION["wjxy"]	=	1;
					break;
				}
			}else{
				if(is_array($time)){
					showTree($time,$fileList["$file"],$checkFileList["$file"],$file);
				}
			}
		}
	}
	write_file("xtgl/checkFileList.php",$str.'?>');
	
	include('xtgl/fileList.php');
	include('xtgl/checkFileList.php');
	
	$_SESSION["wjxy"]	=	0;
	
	$result1	=	array_diff_assoc_recursive($checkFileList,$fileList,array());
	showTree($result1,$fileList,$checkFileList);
	
	if($_SESSION["wjxy"] < 1){
		$result2=	array_diff_assoc_recursive($fileList,$checkFileList,$result1);
		showTree($result2,$fileList,$checkFileList);
		
		include_once('xtgl/fileTime.php');
		if(($fileTime!=(filemtime('xtgl/fileList.php')+5)) || (abs(filemtime('xtgl/fileList.php')-filemtime('xtgl/fileTime.php'))>2)){
			$_SESSION["wjxy"]	=	1;
		}
	}
}
*/
//2015-01-27 增加对时间的判断 
$ntime = time() - 60;
$ndate = date("Y-m-d H:i:s",$ntime);
//未提款数目
if (strpos($quanxian,'cwgl')) {
	$sql		=	"select count(*) as s from k_money where m_value<0 and type=2 and status=2 and m_make_time>'$ndate'";
	$query		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	$tknum		=	$rs['s'];
//存款	
	$sql		=	"select count(*) as s from k_money where m_value>0 and type=1 and status=1 and m_make_time>'$ndate'";
	$query		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	$cknum		=	$rs['s'];
	
	$sql		=	"select count(*) as s from huikuan where status=0 and adddate>'$ndate'";
	$query		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	$hknum		=	$rs['s'];
}

//申诉记录
if (strpos($quanxian,'xxgl')) {
	$sql		=	"select count(*) as s from ban_ip where message is not null and is_jz=1";
	$query		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	$ssnum		=	$rs['s'];

	$sql		=	"select count(*) as s from message where is_jz=0";
	$query		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	$tsjynum	=	$rs['s'];
}

//代理申请
if (strpos($quanxian,'dlgl')) {
	$sql		=	"select count(*) as s from k_user_daili where `status`=0 and add_time>'$ndate'";
	$query		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	$dlsqnum	=	$rs['s'];
}

//异常会员
if (strpos($quanxian,'hygl')) {
	$sql		=	"select count(*) as s from k_user where money<0 and is_delete=0 and is_stop=0 and login_time>'$ndate'";
	$query		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	$ychynum	=	$rs['s'];
}

//串关注单,出结果但未结算
if (strpos($quanxian,'zdgl')) {
	$sql		=	"SELECT count(*) as s FROM k_bet_cg_group cg where cg.`status` in (0,2) and match_coverdate>'$ndate' and cg.cg_count=(select count(*) from k_bet_cg c where c.gid=cg.gid and c.`status` not in(0,3))";
	$query		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	$cgnum		=	$rs['s'];
}

/*
//真人连接异常
if (strpos($quanxian,'hygl')) {
	$sql		=	"select count(*) as s from zhenren_config where ag_logintype=0";
	$query		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	$ycaglive	=	$rs['s'];
}
*/


//$json['sum']  		=	$tknum+$ssnum+$hknum+$tsjynum+$dlsqnum+$ychynum+$cgnum+$_SESSION["wjxy"];
$json['sum']  		=	$tknum+$ssnum+$hknum+$tsjynum+$dlsqnum+$ychynum+$cgnum+$cknum;;
$json['tknum']		=	$tknum;
$json['ssnum']		=	$ssnum;
$json['hknum']		=	$hknum;
$json['tsjynum']	=	$tsjynum;
$json['dlsqnum']	=	$dlsqnum;
$json['ychynum']	=	$ychynum;
$json['cgnum']		=	$cgnum;
$json['cknum']		=	$cknum;
//$json['ycaglive']	=	$ycaglive; //真人连接异常
//$json['wjxynum']	=	$_SESSION["wjxy"];

echo $callback."(".json_encode($json).");";
exit;
?>