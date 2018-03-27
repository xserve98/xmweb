<?php
class admin{
	static function login($login_name,$login_pwd){ //管理员登陆
	
		global $mysqlio;
		$sql	=	"select uid,quanxian,ip,about,address from sys_admin where login_name='$login_name' and login_pwd='".md5(md5($login_pwd))."' limit 1";
		$query	=	$mysqlio->query($sql);
		$t		=	$query->fetch_array();
		if($t['uid'] > 0){
			include_once("../ip.php");
			$ClientSity	=	iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"],'../'));   //取出客户端IP所在城市
			$bool		=	true;
			if($t['address']){
				$bool	=	false;
				$arr	=	explode(',',$t['address']);
				foreach($arr as $k=>$v){
					if(strpos('='.$ClientSity,$v)){ //会员登陆的地址是在限制的地区内
						$bool	=	true;
						break;
					}
				}
			}
			
			if($t["ip"] && $bool){
				if($t["ip"] === $_SERVER['REMOTE_ADDR']){
					$_SESSION["adminid"]	=	$t["uid"];
					$_SESSION["about"]		=	$t["about"];
					$_SESSION["login_name"]	=	$login_name;
					$_SESSION["quanxian"]	=	$t["quanxian"];
					
					include_once("../cache/conf.php");
					$sql		=	"update sys_admin set is_login=1,login_ip='".$_SERVER["REMOTE_ADDR"]."',login_address='$ClientSity',www='$conf_www',updatetime='".time()."' where uid=".$t["uid"];
					$mysqlio->query($sql);
					$sql		=	"insert into `admin_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES (".$t["uid"].",'$login_name','".$_SERVER['REMOTE_ADDR']."','".$ClientSity."',now(),'$conf_www')";
					$mysqlio->query($sql);
					
					return '1,'.$t["uid"];
				}else{
					return '0,3,'.$_SERVER['REMOTE_ADDR'];
				}
			}elseif($bool){
				$_SESSION["adminid"]	=	$t["uid"];
				$_SESSION["about"]		=	$t["about"];
				$_SESSION["login_name"]	=	$login_name;
				$_SESSION["quanxian"]	=	$t["quanxian"];
			
				include_once("../cache/conf.php");
				$sql		=	"update sys_admin set is_login=1,login_ip='".$_SERVER["REMOTE_ADDR"]."',login_address='$ClientSity',www='$conf_www',updatetime='".time()."' where uid=".$t["uid"];
				$mysqlio->query($sql);
				$sql		=	"insert into `admin_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES (".$t["uid"].",'$login_name','".$_SERVER['REMOTE_ADDR']."','".$ClientSity."',now(),'$conf_www')";
				$mysqlio->query($sql);
					
				return '1,'.$t["uid"];
			}else{
				return '0,2,'.$ClientSity;
			}
		}else{
			return '0,1';
		}
	}
	
	static function insert_log($uid,$log_info){ //超级管理员操作日志增加
	
		global $mysqlio;
		$sql = "insert into sys_log(uid,log_info,log_ip) values ('$uid','$log_info','".$_SERVER['REMOTE_ADDR']."')";
		//echo $sql;
		$mysqlio->query($sql);
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
	array('en'=>'sjgl','cn'=>'数据管理')
);
?>