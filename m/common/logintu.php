<?php 
/*function checkuserlogin($uid){
	if(isset($uid)){
		 echo "<script>location.href='/index.php'</script>";
	}
}

/*用户退出*/
function logintu($uid){
	if($uid!=''){
		global $mysqli;
		$mysqli->query("update k_user set logout_time=now() where uid=$uid");
		$mysqli->query("update `k_user_login` set `is_login`=0 WHERE `uid`='$uid' and `is_login`>0");
		$time	=	time()-3600;
		
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query("update `k_user_login` set `is_login`=0 WHERE login_time<$time and `is_login`>0");
			$q1		=	$mysqli->affected_rows;
			if($q1 > 0){
				$mysqli->commit(); //事务提交
			}else{
				$mysqli->rollback(); //数据回滚
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
		}
	}
	return true;
}	

/*删除不在线用户*/
function renovate($uid,$loginid,$kick=true){
	if($uid && $loginid) {
		global $mysqli;
		$sql		=	"select uid from k_user where uid=$uid and log_session='".$_SESSION['user_login_id']."' limit 1";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		if(!$rs['uid']){
			session_destroy();
			echo "<script>alert('您的账号已在别处登录！');window.open('/member/logout','_top');</script>";  
			exit();
		}
		
	}else{
		return true;
	}
	return true;
}	


function getip(){
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
	   $ip = getenv("HTTP_CLIENT_IP");
   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
	   $ip = getenv("HTTP_X_FORWARDED_FOR");
   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
	   $ip = getenv("REMOTE_ADDR");
   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
	   $ip = $_SERVER['REMOTE_ADDR'];
   else
	   $ip = "unknown";
   return $ip;
}


/*首页十秒刷新次数超过五次，设置为非法用户*/
function indexSession($ip,$url){
	
		/*if(!$_SESSION["indexSessionIf"] ){
			$_SESSION["indexSessionIf"] = 0;
			$_SESSION["indexSessionTime"] = time();
		}
	    $time = time() - $_SESSION["indexSessionTime"];	
		if($time>='10') {
			$_SESSION["indexSessionIf"] = '0';
			$_SESSION["indexSessionTime"] = time();
		}
		
		if($_SESSION["indexSessionIf"]<5) {
			$_SESSION["indexSessionIf"] = $_SESSION["indexSessionIf"]+1;
		}else{
			global $mysqli;
			
			$query	=	$mysqli->query("select why from `ban_ip` where `ip`='$ip' limit 1");
			$rs		=	$query->fetch_array();
			if($rs['why']){
				$meg=	$rs['why'].'、'.$url;
				$mysqli->query("update `ban_ip` set his=2,`why`='$meg',`ext_time`='".time()."',is_jz=1 where `ip`='$ip'");	
			}else{
				$mysqli->query("insert into `ban_ip` (`ip`,`ban_time`,`why`) values ('$ip','".time()."','频繁刷新网站".$url."')");	
			} 
			
			echo "<script>location.href='/zzip.html'</script>";
			exit;
		}*/
		return true;
}


/*被禁止IP不能进人网站*/
function banIP($ip){
	global $mysqli;
	$query	=	$mysqli->query("select his from `ban_ip` where `ip`='$ip' and is_jz=1 limit 1");
	$rs		=	$query->fetch_array();
	if($rs['his']>1){
		echo "<script>location.href='/zzip.html'</script>";
		exit;	
	}
	return true;
}

function sessionNum($uid,$type,$cal=''){
	if(!$_SESSION["sessionIf"]){
		$_SESSION["sessionIf"] = 1;
		$_SESSION["sessionTime"] = time();
		$_SESSION["3ssessionIf"] = 1;
		$_SESSION["3ssessionTime"] = time();
	}

	$time3 = time() - $_SESSION["3ssessionTime"];	
	if($time3>='60') {
		$_SESSION["3ssessionIf"]   = '0';
		$_SESSION["3ssessionTime"] = time();
	}
	if($_SESSION["3ssessionIf"]<='80'){
		$_SESSION["3ssessionIf"] = $_SESSION["3ssessionIf"]+1;	
	}else{
		global $mysqli;
		$mysqli->query("update `k_user` set `is_stop`=1 where uid='$uid'");	
		@session_destroy();
	}
	$time  = time() - $_SESSION["sessionTime"];
	if($time>='30') {
		$_SESSION["sessionIf"]   = '0';
		$_SESSION["sessionTime"] = time();
	}
	if($_SESSION["sessionIf"]<=25){
		$_SESSION["sessionIf"] = $_SESSION["sessionIf"]+1;
	}else{
		$_SESSION["sessionTime"] = time();
		if($type==3) {
			echo "<div id=\"location\"  style='line-height:40px;text-align:center;color:#666; border-bottom:1px solid #999;'>对不起,您点击页面太快,请在60秒后进行操作</div><script>check();</script>";
		}elseif($type==4){
			$json['zq']				= 0;
			$json['zq_ds']			= 0;
			$json['zq_gq']			= 0;
			$json['zq_sbc']			= 0;
			$json['zq_sbbd']		= 0;
			$json['zq_bd']			= 0;
			$json['zq_rqs']			= 0;
			$json['zq_bqc']			= 0;
			$json['zq_jg']			= 0;
			$json['zqzc']			= 0;
			$json['zqzc_ds']		= 0;
			$json['zqzc_sbc']		= 0;
			$json['zqzc_sbbd']		= 0;
			$json['zqzc_bd']		= 0;
			$json['zqzc_rqs']		= 0;
			$json['zqzc_bqc']		= 0;
			$json['lm']				= 0;
			$json['lm_ds']			= 0;
			$json['lm_dj']			= 0;
			$json['lm_gq']			= 0;
			$json['lm_jg']			= 0;
			$json['lmzc']			= 0;
			$json['lmzc_ds']		= 0;
			$json['lmzc_dj']		= 0;
			$json['wq']				= 0;
			$json['wq_ds']			= 0;
			$json['wq_bd']			= 0;
			$json['wq_jg']			= 0;
			$json['pq']				= 0;
			$json['pq_ds']			= 0;
			$json['pq_bd']			= 0;
			$json['pq_jg']			= 0;
			$json['bq']				= 0;
			$json['bq_ds']			= 0;
			$json['bq_zdf']			= 0;
			$json['bq_jg']			= 0;
			$json['bqzc']			= 0;
			$json['bqzc_ds']		= 0;
			$json['bqzc_zdf']		= 0;
			$json['gj']				= 0;
			$json['gj_gj']			= 0;
			$json['gj_gjjg']		= 0;
			$json['gj_jg']			= 0;
			$json['jr']				= 0;
			$json['jr_jr']			= 0;
			$json['jr_jrjg']		= 0;
			$json['jr_jg']			= 0;
			$json['tz_money']		= "0 RMB";
			$json['user_money']		= "0 RMB";
			$json['user_num']		= 0;
			echo $cal."(".json_encode($json).");";
		}else{
			$json["fy"]["p_page"] = "error2";
			echo $type."(".json_encode($json).");";
		}
		exit;
	}
	return true;
}


function sessionBet($uid){
	if(!$_SESSION["bets"]){
		$_SESSION["bets"] = 0;
		$_SESSION["betTime"] = time();
	}
	$time3 = time() - $_SESSION["betTime"];	
	if($time3>='15') {
		$_SESSION["bets"]   = '0';
		$_SESSION["betTime"] = time();
	}
	if(@$_SESSION["betif"]!='') {
		if($time3>='30') {
			$_SESSION["bets"]   = '0';
			$_SESSION["betTime"] = time();
			$_SESSION["betif"]	= '';
		}
	}
	if($_SESSION["bets"]<10) {
		$_SESSION["bets"] = $_SESSION["bets"]+1;
	}else{
		$_SESSION["betTime"] = time();
		$_SESSION["betif"] = rand(100000,999999);	
		echo "<div class=\"pollbox\" id =\"idcs\"> 
			      <p style=\"text-align:center\"></p> 
				  <p style=\" text-align:center\"></p>
				  <p style=\"font-size:12px;\"><font style=\"color:red;text-align:center;\">）：您点击次数太快了..<br />为了保证网站数据安全..<br />请您稍等<span id='miao'>30</span>秒后再操作..</font></p></div>
				  
	<script language=\"javascript\">\r\n
		var i = 31;\r\n
		var timeouts;\r\n
		clearTimeout(timeouts);\r\n
		checkidcs();\r\n
		function checkidcs(){\r\n
			i = i-1;\r\n
			document.getElementById('miao').innerHTML	= '';\r\n
			document.getElementById('miao').innerHTML	=i;\r\n
			if(i == 0){\r\n
			clearTimeout(timeouts);\r\n
				document.getElementById('bet_moneydiv').style.display='none';\r\n
				document.getElementById('idcs').style.display='none';\r\n
				document.getElementById('maxmsg_div').style.display='none';\r\n
			}else{\r\n
				timeouts=setTimeout(\"checkidcs()\",1000);\r\n
			}
		}\r\n
</script>\r\n";
		exit;	
	}
	return true;	
}


function investSZ($uid='') {
	if(!$_SESSION["investValue"]){
		$_SESSION["investValue"] = 0;
		$_SESSION["investTime"]  = time();
	}
	$time = time() - $_SESSION["investTime"];	
	
	if($time>='5'){
		$_SESSION["investValue"] = '0';
		$_SESSION["investTime"]  = time();
	}
	if($_SESSION["investValue"]<=2){
		$_SESSION["investValue"] = $_SESSION["investValue"]+1;	
		return $_SESSION["investValue"];	
	}else{
		$_SESSION["investTime"] = time();
		return $_SESSION["investValue"];	
	}
}

function islogin_match($uid){
	if($uid){
		return true;
	}else{
		session_destroy();
		echo "<script>window.location.href='/left.php';</script>";
		exit;
	}
}
?>