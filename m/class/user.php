<?php
@session_start();
class user{
    static function login($username,$passwrod){ //登陆，进行验证，和信息更新,产生UID
		global $mysqli;
	   	$sql	=	"select uid,is_daili,gid,is_delete,is_stop,reg_date from k_user where username='$username' and password='".md5($passwrod)."' limit 1";
		$query	=	$mysqli->query($sql);
		$t		=	$query->fetch_array();
		if($t){
			if($t["is_delete"] == 1){
				echo '3';
				exit;
			}
			
			if($t["is_stop"] == 1){
				echo '3';
				exit;
			}
			
			
			/*if(strtotime("2010-06-14 12:00:00")<=strtotime($t["reg_date"])){ //在 2010-06-14 12:00:00 之后注册的用户，要验证所属IP地址，中国境内，不给登陆
				include_once("ip.php");
				include_once("city.php");
				$ClientSity = iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"]));   //取出客户端IP所在城市
				$bool		= false;
				foreach($city as $k=>$v){
					if(count(explode($v,$ClientSity))-1){
						$bool = true;
						break;
					}
				}
				
				if($bool){
					$db1 -> message("尊敬的客户，由于您所在的国家或地区的法律限制，我公司不能为您提供服务，谢谢您的支持！");
					exit;
				}
			}*/
			
			include_once("cache/conf.php");
			
			$mysqli->query("update k_user set login_time=now(),login_ip='".$_SERVER['REMOTE_ADDR']."',lognum=lognum+1 where username='$username'");
			$time	=	time();
			$date	=	date('YmdHis');
			$rs		=	$mysqli->query("select `uid` from `k_user_login` where uid=".$t["uid"]." limit 1");
			if($row =	$rs->fetch_array()){
				$mysqli->query("update `k_user_login` set `login_id`='$time".'_'.$t["uid"].'_'."$username',`login_time`='$time',`is_login`=1,www='$conf_www' WHERE `uid`='".$t["uid"]."'");
			}else{
				$mysqli->query("insert into `k_user_login` (`login_id`,`uid`,`login_time`,`is_login`,www) VALUES ('$time".'_'.$t["uid"].'_'."$username','".$t["uid"]."','$time',1,'$conf_www')");
			}	
			include_once("ip.php");
			include_once("include/mysqlio.php");
			
			$ClientSity = iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"]));   //取出客户端IP所在城市
			$mysqlio->query("insert into `history_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES (".$t["uid"].",'$username','".$_SERVER['REMOTE_ADDR']."','".$ClientSity."',now(),'$conf_www')");
			
			$_SESSION["uid"]			=	$t["uid"];
			$_SESSION["is_daili"]		=	$t["is_daili"];
			$_SESSION["gid"]			=	$t["gid"]; //所属权限组
			$_SESSION["username"]		=	$username;
			$_SESSION["denlu"]			=	"one";
			$_SESSION['user_login_id']	=	$time.'_'.$t["uid"].'_'.$username;
			$_SESSION['expiretime'] 	= 	time() + 1200;
			$sql="UPDATE `k_user` SET `log_session`='".$_SESSION['user_login_id']."' WHERE (`uid`='".$t["uid"]."')";
			$mysqli->query($sql);
			return $t["uid"];
     	}else{
			return false;
    	}
	}
	
	static  function islogin(){ //验证是否登录
		return isset($_SESSION["uid"],$_SESSION["username"]);
	}

	static function getinfo($uid){
		if($uid<1){
			return 0;
		}else{
			global $mysqli;
			$query	=	$mysqli->query("select * from k_user where uid=$uid limit 1");
			$t		=	$query->fetch_array();
            
            return $t;			
		}
	}
	
	static function getusername($uid){
		if($uid<1){
			return false;
		}else{
			global $mysqli;
			$query	=	$mysqli->query("select username from k_user where uid=$uid limit 1");
			$t		=	$query->fetch_array();

            return $t["username"];			
		}
	}
	
	static function update_pwd($uid,$oldpwd,$newpwd,$type='password'){
	
		global $mysqli;
		$sql	=	"update k_user set ".$type."='".md5($newpwd)."' where uid=$uid and ".$type."='".md5($oldpwd)."'";
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			$q1		=	$mysqli->affected_rows;
			if($q1 == 1){
				$mysqli->commit(); //事务提交
				return  true;
			}else{
				$mysqli->rollback(); //数据回滚
				return  false;
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			return  false;
		}
	}
	
	static function update_paycard($uid,$pay_card,$pay_num,$pay_address,$pay_name,$username){
	
		global $mysqli;
		$sql	=	"update k_user set pay_card=?,pay_num=?,pay_address=? where uid=?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("sssi",$pay_card,$pay_num,$pay_address,$uid);
		$stmt->execute();
		$q1 = $stmt->affected_rows;
		$stmt->close();
		$sql1	=	"insert into history_bank (uid,username,pay_card,pay_num,pay_address,pay_name) values (?,?,?,?,?,?)";
		$stmt = $mysqli->prepare($sql1);
		$stmt->bind_param("isssss",$uid,$username,$pay_card,$pay_num,$pay_address,$pay_name);
		$stmt->execute();
		$q2 = $stmt->affected_rows;
		$stmt->close();
		if($q1==1 && $q2==1){
			return true;
		}else{
			return false;
		}
	}
	
    static function msg_add($uid,$from,$title,$info){
	
    	global $mysqli;
    	$sql	=	"insert into k_user_msg(uid,msg_from,msg_title,msg_info) values ($uid,'$from','$title','$info')";
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			$q1		=	$mysqli->affected_rows;
			if($q1 == 1){
				$mysqli->commit(); //事务提交
				return  true;
			}else{
				$mysqli->rollback(); //数据回滚
				return  false;
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			return  false;
		}
    } 
	static function msg_add2($uid,$from,$title,$info){
	
    	global $mysqli;
    	$sql	=	"insert into message(uid,title,addtime,msg) values ('$uid','$title','".date('Y-m-d H:i:s')."','$info')";
		$q1=$mysqli->query($sql);
		if($q1){
			return true;
		}else{
			return false;
		}
    }
	static function jifen_add($uid,$orderid,$about,$money,$type=1,$gametype=''){
	
    	global $mysqli;
		if($type==1){
			$sql		=	"update k_user set jifen=jifen+$money where uid=$uid";
			$mysqli->query($sql);
			$q1			=	$mysqli->affected_rows;
			$sql		=	"insert into k_jifen(uid,m_value,status,m_order,about,type,gametype) values($uid,$money,1,'$orderid','$about',$type,'$gametype')";
			$mysqli->query($sql);
			$q2		=	$mysqli->affected_rows;
		}elseif($type==2){
			$sql		=	"update k_user set jifen=jifen-$money where uid=$uid";
			$mysqli->query($sql);
			$q1			=	$mysqli->affected_rows;
			$sql		=	"insert into k_jifen(uid,m_value,status,m_order,about,type,gametype) values($uid,$money,1,'$orderid','$about',$type,'$gametype')";
			$mysqli->query($sql);
			$q2		=	$mysqli->affected_rows;
		}elseif($type==3){
			$sql		=	"update k_user set money=money+$money,jifen=jifen-$money where uid=$uid";
			$mysqli->query($sql);
			$q1			=	$mysqli->affected_rows;
			$sql		=	"insert into k_jifen(uid,m_value,status,m_order,about,type,gametype) values($uid,$money,1,'$orderid','$about',$type,'$gametype')";
			$mysqli->query($sql);
			$q2		=	$mysqli->affected_rows;
		}
		if($q1 && $q2){
			return true;
		}else{
			return false;
		}
    }
	static function jifen_del($uid,$orderid,$gametype=''){
	
    	global $mysqli;
			if($gametype) $w=" and gametype=$gametype";
			$sql="select m_value,m_id from `k_jifen` WHERE `m_order`='$orderid' and uid='$uid' $w ";
			$query	=	$mysqli->query($sql);
			$rows	=	$query->fetch_array();
			if($rows){
				$money=$rows['m_value'];
				$sql		=	"update k_user set jifen=jifen-$money where uid=$uid";
				$mysqli->query($sql);
				$delsql="DELETE FROM `k_jifen` WHERE `m_id`='".$rows['m_id']."'";
				$mysqli->query($delsql);
				return true;
			}else{
				return false;
			}
    }
	
    static function is_daili($uid){
	
    	global $mysqli;
    	$query	=	$mysqli->query("select is_daili from k_user where uid=$uid and is_daili=1 limit 1");
		//echo "select is_daili from k_user where uid=$uid and is_daili=1 limit 1";exit;
		$t		=	$query->fetch_array();
    	if($t['is_daili'] == 1){
			setcookie("is_daili",$uid,time()+8*3600);
    		return true;
    	}else{
			setcookie("is_daili","",time()-3600,"/");
    		return  false;
    	}
    }
}
?>