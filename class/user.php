<?php
class user{
    static function login($username,$passwrod){ //登陆，进行验证，和信息更新,产生UID
		global $mysqli;
	   	$sql	=	"select uid,is_daili,gid,is_delete,is_stop,reg_date,password,username,pankou from k_user where username=? and password=? limit 1";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ss",$username,md5($passwrod));
		$stmt->execute();
		$stmt->bind_result($t_uid,$t_is_daili,$t_gid,$t_is_delete,$t_is_stop,$t_reg_date,$t_password,$t_username,$t_pankou);
		$stmt->fetch();
		$stmt->close();
		
		//$query	=	$mysqli->query($sql);
		//$t		=	$query->fetch_array();
		if($t_password==md5($passwrod) && $t_username==$username){
			if($t_is_delete == 1){
				echo '3';
				exit;
			}
			
			if($t_is_stop == 1){
				echo '3';
				exit;
			}
			
				
			if($t_is_daili == 1){
				echo '2';
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
			
			$_SESSION["uid"]			=	$t_uid;
			$_SESSION["pankou"]			=	$t_pankou;
			$_SESSION["is_daili"]		=	$t_is_daili;
			$_SESSION["gid"]			=	$t_gid; //所属权限组
			$_SESSION["username"]		=	$username;
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
	
	static  function islogin(){ //验证是否登录
		return isset($_SESSION["uid"],$_SESSION["username"]);
	}

	static function getinfo($uid){
		$uid=intval($uid);
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
		$uid=intval($uid);
		if($uid<1){
			return false;
		}else{
			global $mysqli;
			$query	=	$mysqli->query("select username from k_user where uid=$uid limit 1");
			$t		=	$query->fetch_array();

            return $t['username'];			
		}
	}
	
	static function update_pwd($uid,$oldpwd,$newpwd,$type='password'){
	
		global $mysqli;
		if($type=='qk_pwd'){
			$sql	=	"update k_user set $type=?,birthday=? where uid=? and $type=?";
		}else{
			$type='password';
			$sql	=	"update k_user set $type=?,sex=? where uid=? and $type=?";
		}
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ssis",md5($newpwd),$newpwd,$uid,md5($oldpwd));
		$stmt->execute();
		$q1 = $stmt->affected_rows;
		$stmt->close();
		if($q1==1){
			return true;
		}else{
			return false;
		}
		/*
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
		*/
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
		/*
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			$q1		=	$mysqli->affected_rows;
			$mysqli->query($sql1);
			$q2		=	$mysqli->affected_rows;
			if($q1 == 1 && $q2 == 1){
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
		*/
	}
	
    static function msg_add($uid,$from,$title,$info){
	
    	global $mysqli;
    	$sql	=	"insert into k_user_msg(uid,msg_from,msg_title,msg_info) values (?,?,?,?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("isss",$uid,$from,$title,$info);
		$stmt->execute();
		$q1 = $stmt->affected_rows;
		$stmt->close();
		if($q1==1){
			return true;
		}else{
			return false;
		}
		/*
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
		*/
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
		if($type==1 || $type==2){
			$sql		=	"update k_user set jifen=jifen+$money where uid=$uid";
			$mysqli->query($sql);
			$q1			=	$mysqli->affected_rows;
			$sql		=	"insert into k_jifen(uid,m_value,status,m_order,about,type,gametype) values($uid,$money,1,'$orderid','$about',$type,'$gametype')";
			$mysqli->query($sql);
			$q2		=	$mysqli->affected_rows;
		}elseif($type==4){
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
		$uid=intval($uid);
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