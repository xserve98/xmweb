<?php
/* 获取webservice */
function get_service() {
	global $mysqli;
	$sql = "select curservice,curid from zhenren_config limit 0,1";
    $query = $mysqli->query($sql);
	$row = array();
	$row = $query->fetch_array();
	
	global $services;
	$arrcur = array();
	if ($row[0]=="") {
		$randno = rand(0,count($services)-1);
		$arrcur[0] = $services[$randno];
		$arrcur[1] = $randno;
		update_service($arrcur[0],$arrcur[1]);
	} else {
		$arrcur[0] = $row[0];
		$arrcur[1] = $row[1];
	}
	
	return $arrcur;
}

/* 更新webservice */
function update_service($cuservice,$curid) {
	global $mysqli;
	$sql = "update zhenren_config set curservice='$cuservice',curid=$curid";
    $query = $mysqli->query($sql);
}

/* 获取下一个webservice */
function fetch_nextservice($curid) {
	global $services;
	$curid = $curid+1;
	if ($curid >= count($services)) {
		$curid = 0;
	}
	update_service($services[$curid],$curid);
	$arrcur = array();
	$arrcur[0] = $services[$curid];
	$arrcur[1] = $curid;
	
	return $arrcur;
}

/* 生成随机字符 */
function get_randomstr($len) {
    $chars = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9");
    $charsLen = count($chars) - 1;
    shuffle($chars);
    $output = "";
    for ($i=0; $i<$len; $i++)
    {
        $output .= $chars[mt_rand(0,$charsLen)];
    }
    return $output;
}

/* 生成真人用户名 */
function get_nextloginname($username) {
	global $prefix;
	$username = substr(preg_replace("/[^a-zA-Z0-9]/si","",$username),0,8);
	$loginname = $prefix.strtoupper($username.get_randomstr(2));
	$i = 0;
	while ($i<10 && exsit_loginname($loginname)) {
		$i++;
		$loginname = $prefix.strtoupper($username.get_randomstr(2));
	}
	
	return $loginname;
}

/* 生成真人密码 */
function get_password() {
	return strtoupper(get_randomstr(19));
}

/* 检查真人账号是否重复 */
function exsit_loginname($loginname) {
	global $mysqli;
	$sql = "select uid from k_user where ag_zr_username='$loginname' limit 0,1";
    $query = $mysqli->query($sql);
	$row = array();
	$row = $query->fetch_array();
	if ($row['uid']) {
		return true;
	} else {
		return false;
	}
}

/* 将真人用户写入数据库 */
function update_liveuser($agloginname,$agpassword,$uid) {
	global $mysqli;
	$sql = "update k_user set ag_zr_username='$agloginname',ag_zr_pwd='$agpassword',ag_zr_is=1,ag_zr_regnum=0 where uid=$uid";
    $query = $mysqli->query($sql);
}

/* 获取系列号 */
function get_billno() {
	return date("mdHis").substr(microtime(),2,5).rand(1,9);
}

/* 更新真人余额 */
function update_livemoney($uid,$agmoney) {
	global $mysqli;
	$sql = "update k_user set ag_zr_money='$agmoney',ag_zr_uptime=now() where uid=$uid";
    $query = $mysqli->query($sql);
}

/* 检查是否维护区间 */
function check_agwh() {
	global $web_site;
	$cur_bjtime = time();
	$cur_bjhour = date("Y-m-d H:i",$cur_bjtime);
	$cur_bjdate = date("Y-m-d",$cur_bjtime);
	$cur_bjzhou = date("w",$cur_bjtime);
	$cur_bjzhou==0?7:$cur_bjzhou;
	if ($web_site['zrwh_zhou'.$cur_bjzhou]==$cur_bjzhou) {
		$zrwh_begin = $cur_bjdate." ".$web_site['zrwh_begin'];
		$zrwh_end = $cur_bjdate." ".$web_site['zrwh_end'];
		if (strtotime($cur_bjhour)>=strtotime($zrwh_begin) && strtotime($cur_bjhour)<=strtotime($zrwh_end)) {
			return "真人娱乐场于北京时间".$web_site['zrwh_begin']."-".$web_site['zrwh_end']."例行维护";
		}
	}
	return "0";
}
?>