<?php
class admin{
	static function login($login_name,$login_pwd){ //管理员登陆
	
		global $mysqlio;
		$sql = "select uid,quanxian,ip,about,address,login_pwd,login_name from sys_admin where login_name=? and login_pwd=? limit 1";
		$stmt = $mysqlio->prepare($sql);
		$stmt->bind_param("ss",$login_name,md5(md5($login_pwd)));
		$stmt->execute();
		$stmt->bind_result($t_uid,$t_quanxian,$t_ip,$t_about,$t_address,$t_login_pwd,$t_login_name);
		$stmt->fetch();
		$stmt->close();
		//$query	=	$mysqlio->query($sql);
		//$t		=	$query->fetch_array();
		if($t_uid > 0 && md5(md5($login_pwd))==$t_login_pwd && $login_name==$t_login_name){
			include_once("../ip.php");
			$ClientSity	=	iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"],'../'));   //取出客户端IP所在城市
			$bool		=	true;
			if($t_address){
				$bool	=	false;
				$arr	=	explode(',',$t_address);
				foreach($arr as $k=>$v){
					if(strpos('='.$ClientSity,$v)){ //会员登陆的地址是在限制的地区内
						$bool	=	true;
						break;
					}
				}
			}
			
			if($t_ip && $bool){
				if($t_ip === $_SERVER['REMOTE_ADDR']){
					$_SESSION["adminid"]	=	$t_uid;
					$_SESSION["about"]		=	$t_about;
					$_SESSION["login_name"]	=	$login_name;
					$_SESSION["quanxian"]	=	$t_quanxian;
					$_SESSION["login_pwd"]	=	md5(md5($login_pwd));
					
					include_once("../cache/conf.php");
					$sql		=	"update sys_admin set is_login=1,login_ip=?,login_address=?,www=?,updatetime=? where uid=?";
					$stmt = $mysqlio->prepare($sql);
					$stmt->bind_param("ssssi",$_SERVER["REMOTE_ADDR"],$ClientSity,$conf_www,time(),$t_uid);
					$stmt->execute();
					$stmt->close();
					//$mysqlio->query($sql);
					$sql		=	"insert into `admin_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES (?,?,?,?,now(),?)";
					$stmt = $mysqlio->prepare($sql);
					$stmt->bind_param("issss",$t_uid,$login_name,$_SERVER['REMOTE_ADDR'],$ClientSity,$conf_www);
					$stmt->execute();
					$stmt->close();
					//$mysqlio->query($sql);
					
					return '1,'.$t_uid;
				}else{
					return '0,3,'.$_SERVER['REMOTE_ADDR'];
				}
			}elseif($bool){
				$_SESSION["adminid"]	=	$t_uid;
				$_SESSION["about"]		=	$t_about;
				$_SESSION["login_name"]	=	$login_name;
				$_SESSION["quanxian"]	=	$t_quanxian;
				$_SESSION["login_pwd"]	=	md5(md5($login_pwd));
			
				include_once("../cache/conf.php");
				$sql		=	"update sys_admin set is_login=1,login_ip=?,login_address=?,www=?,updatetime=? where uid=?";
				$stmt = $mysqlio->prepare($sql);
				$stmt->bind_param("ssssi",$_SERVER["REMOTE_ADDR"],$ClientSity,$conf_www,time(),$t_uid);
				$stmt->execute();
				$stmt->close();
				//$mysqlio->query($sql);
				$sql		=	"insert into `admin_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES (?,?,?,?,now(),?)";
				$stmt = $mysqlio->prepare($sql);
				$stmt->bind_param("issss",$t_uid,$login_name,$_SERVER['REMOTE_ADDR'],$ClientSity,$conf_www);
				$stmt->execute();
				$stmt->close();
				//$mysqlio->query($sql);
					
				return '1,'.$t_uid;
			}else{
				return '0,2,'.$ClientSity;
			}
		}else{
			return '0,1';
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

	array('en'=>'hygl','cn'=>'会员管理'),
	array('en'=>'sgjzd','cn'=>'手工结注单'),
	array('en'=>'cwgl','cn'=>'财务管理'),
	array('en'=>'jkkk','cn'=>'加款扣款'),
	array('en'=>'xxgl','cn'=>'消息管理'),
	array('en'=>'dlgl','cn'=>'代理管理'),
	array('en'=>'glygl','cn'=>'管理员管理'),
	array('en'=>'bbgl','cn'=>'报表管理'),
	array('en'=>'xtgl','cn'=>'系统管理'),
	array('en'=>'rzgl','cn'=>'日志管理'),
    array('en'=>'lhcgl','cn'=>'六合彩管理'), 
	array('en'=>'sjgl','cn'=>'数据管理')
);

?>