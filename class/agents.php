<?php
class admin{

    static function login($username,$passwrod){ //登陆，进行验证，和信息更新,产生UID
		global $mysqli;
		
	   	$sql	=	"select uid,is_daili,quanxian,gid,is_delete,is_stop,reg_date,password,username,pankou from k_user where username=? and password=? limit 1";
	
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ss",$username,md5($passwrod));
	
		$stmt->execute();
		$stmt->bind_result($t_uid,$t_is_daili,$t_quanxian,$t_gid,$t_is_delete,$t_is_stop,$t_reg_date,$t_password,$t_username,$t_pankou);
		$stmt->fetch();
		$stmt->close();
		
		//$query	=	$mysqli->query($sql);
		//$t		=	$query->fetch_array();
	
		if($t_password==md5($passwrod) && $t_username==$username&&$t_is_daili==1){
			if($t_is_delete == 1){
				echo '3';
				exit;
			}
			
			if($t_is_stop == 1){
				echo '3';
				exit;
			}
			
			$t_uid = intval($t_uid);
			
			include_once("cache/conf.php");
			$stmt = $mysqli->prepare("update k_user set login_time=now(),login_ip=?,lognum=lognum+1 where username=?");
			$stmt->bind_param("ss",$_SERVER['REMOTE_ADDR'],$username);
			$stmt->execute();
			$stmt->close();
			//$mysqli->query("update k_user set login_time=now(),login_ip='".$_SERVER['REMOTE_ADDR']."',lognum=lognum+1 where username='$username'");
			$time	=	time();
			$date	=	date('YmdHis');
			$rs		=	$mysqli->query("select `uid` from `k_user_login` where uid=".$t_uid." limit 1");
			$login_id = $time.'_'.$t_uid.'_'.$username;
			if($row =	$rs->fetch_array()){
				$stmt = $mysqli->prepare("update `k_user_login` set `login_id`=?,`login_time`=?,`is_login`=1,www=? WHERE `uid`=?");
				$stmt->bind_param("sisi",$login_id,$time,$conf_www,$t_uid);
				$stmt->execute();
				$stmt->close();
				//$mysqli->query("update `k_user_login` set `login_id`='$time".'_'.$t_uid.'_'."$username',`login_time`='$time',`is_login`=1,www='$conf_www' WHERE `uid`='".$t_uid."'");
			}else{
				$stmt = $mysqli->prepare("insert into `k_user_login` (`login_id`,`uid`,`login_time`,`is_login`,www) VALUES (?,?,?,1,?)");
				$stmt->bind_param("siis",$login_id,$t_uid,$time,$conf_www);
				$stmt->execute();
				$stmt->close();
				//$mysqli->query("insert into `k_user_login` (`login_id`,`uid`,`login_time`,`is_login`,www) VALUES ('$time".'_'.$t_uid.'_'."$username','".$t_uid."','$time',1,'$conf_www')");
			}	
			//include_once("ip.php");
			//include_once("include/mysqlio.php");
			
			//$ClientSity = iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"]));   //取出客户端IP所在城市
			//$mysqlio->query("insert into `history_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES (".$t_uid.",'$username','".$_SERVER['REMOTE_ADDR']."','".$ClientSity."',now(),'$conf_www')");
			
			$_SESSION["suid"]			=	$t_uid;
			$_SESSION["quanxian"]		=	$t_quanxian;
			$_SESSION["pankou"]			=	$t_pankou;
			$_SESSION["is_daili"]		=	$t_is_daili;
			$_SESSION["gid"]			=	$t_gid; //所属权限组
			$_SESSION["susername"]		=	$username;
			$_SESSION["denlu"]			=	"one";
			$_SESSION['user_login_id']	=	$time.'_'.$t_uid.'_'.$username;
			$_SESSION["password"]		=	$passwrod;
			$sql="UPDATE `k_user` SET `log_session`='".$_SESSION['user_login_id']."' WHERE (`uid`='$t_uid')";
			$mysqli->query($sql);
			return $t_uid;
     	}else{
			return false;
    	}
	}
	static function insert_log($uid,$log_info){ //超级管理员操作日志增加
	
		global $mysqlio;
		$stmt = $mysqlio->prepare("insert into sys_log(uid,log_info,log_ip) values (?,?,?)");
		$stmt->bind_param("iss",$uid,$log_info,$_SERVER['REMOTE_ADDR']);
		$stmt->execute();
		$stmt->close();
		//$mysqlio->query("insert into sys_log(uid,log_info,log_ip) values ('$uid','$log_info','".$_SERVER['REMOTE_ADDR']."')");
	}
}


$quanxian = array(
	array('en'=>'zdgl','cn'=>'注单管理'),
	array('en'=>'bfgl','cn'=>'比分管理'),
	array('en'=>'ssgl','cn'=>'赛事管理'),
	array('en'=>'hygl','cn'=>'会员管理'),
	array('en'=>'sgjzd','cn'=>'手工结注单'),
	array('en'=>'cwgl','cn'=>'财务管理'),
	array('en'=>'jkkk','cn'=>'加款扣款'),
	array('en'=>'xxgl','cn'=>'消息管理'),
	array('en'=>'dlgl','cn'=>'代理管理'),
	array('en'=>'glygl','cn'=>'管理员管理'),
	array('en'=>'bbgl','cn'=>'报表管理'),
	array('en'=>'jyqk','cn'=>'交易情况'),
	array('en'=>'xtgl','cn'=>'系统管理'),
	array('en'=>'rzgl','cn'=>'日志管理'),
    array('en'=>'lhcgl','cn'=>'六合彩管理'), 
	array('en'=>'sjgl','cn'=>'数据管理')
);

?>