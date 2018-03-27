<?php
require_once('webscan_cache.php');

/*discuz防注入代码 开始*/
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
$_GET = daddslashes($_GET);
$_POST = daddslashes($_POST);
$_COOKIE = daddslashes($_COOKIE);
$_FILES = daddslashes($_FILES);

function daddslashes($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = daddslashes($val);
		}
	} else {
		$string = addslashes(str_replace("'","",stripslashes($string)));
	}
	return $string;
}

function do_query_safe($sql,$diyunsafe=array()) {
	$querysafe['dfunction']	= array('load_file','hex','substring','if','ord','char');
	$querysafe['daction']	= array('@','intooutfile','intodumpfile','unionselect','(select', 'unionall', 'uniondistinct');
	//$querysafe['dnote']	= array('/*','*/','#','--','"');
	$querysafe['dlikehex']	= 1;
	
	$sql = str_replace(array('\\\\', '\\\'', '\\"', '\'\''), '', $sql);
	$mark = $clean = '';
	
	$len = strlen($sql);
	$mark = $clean = '';
	for ($i = 0; $i < $len; $i++) {
		$str = $sql[$i];
		switch ($str) {
			case '`':
				if(!$mark) {
					$mark = '`';
					$clean .= $str;
				} elseif ($mark == '`') {
					$mark = '';
				}
				break;
			case '\'':
				if (!$mark) {
					$mark = '\'';
					$clean .= $str;
				} elseif ($mark == '\'') {
					$mark = '';
				}
				break;
			case '/':
				if (empty($mark) && $sql[$i + 1] == '*') {
					$mark = '/*';
					$clean .= $mark;
					$i++;
				} elseif ($mark == '/*' && $sql[$i - 1] == '*') {
					$mark = '';
					$clean .= '*';
				}
				break;
			case '#':
				if (empty($mark)) {
					$mark = $str;
					$clean .= $str;
				}
				break;
			case "\n":
				if ($mark == '#' || $mark == '--') {
					$mark = '';
				}
				break;
			case '-':
				if (empty($mark) && substr($sql, $i, 3) == '-- ') {
					$mark = '-- ';
					$clean .= $mark;
				}
				break;

			default:
				break;
		}
		$clean .= $mark ? '' : $str;
	}

	/*
	if(strpos($clean, '@') !== false) {
		return '-3';
	}
	*/

	$clean = preg_replace("/[^a-z0-9_\-\(\)#\*\/\"]+/is", "", strtolower($clean));
	
	if (is_array($querysafe['dfunction'])) {
		foreach ($querysafe['dfunction'] as $fun) {
			if (strpos($clean, $fun . '(') !== false)
				return '-1';
		}
	}

	if (is_array($querysafe['daction'])) {
		foreach ($querysafe['daction'] as $action) {
			if (strpos($clean, $action) !== false)
				return '-3';
		}
	}

	if ($querysafe['dlikehex'] && strpos($clean, 'like0x')) {
		return '-2';
	}

	if (is_array($querysafe['dnote'])) {
		foreach ($querysafe['dnote'] as $note) {
			if (strpos($clean, $note) !== false)
				return '-4';
		}
	}

	/* 自定义部分 */
	if (is_array($diyunsafe)) {
		foreach ($diyunsafe as $diy) {
			if (strpos($clean, $diy) !== false) return '-5';
		}
	}

	return 1;
}
/*discuz防注入代码 结束*/

/**
 *  数据记录
 */
function webscan_slog($logs) {
	if (file_exists(LOG_PATH)) {
		if (filesize(LOG_PATH) > 1024*1024*1024) {
			unlink(LOG_PATH);
		}
	}
	$logstring = "ip => ".$logs["ip"]
		.", time => ".strftime("%Y-%m-%d %H:%M:%S")
		.", page => ".$_SERVER["PHP_SELF"]
		.", method => ".$logs["method"]
		.", rkey => ".$logs["rkey"]
		.", rdata => ".$logs["rdata"]
		.", dovalue => ".$logs["dovalue"];
    $Ts = fopen(LOG_PATH, "a+");
    fputs($Ts, $logstring."\r\n");
    fclose($Ts);
	clearstatcache();
}

/**
 *  参数拆分
 */
function webscan_arr_foreach($arr) {
	static $str;
	if (!is_array($arr)) {
		return $arr;
	}
	foreach ($arr as $key => $val) {
		if (is_array($val)) {
			webscan_arr_foreach($val);
		} else {
			$str[] = $val;
		}
	}
	return implode($str);
}

/**
 *  防护提示页
 */
function webscan_pape() {
	header('Content-type: text/html; charset=utf-8');
	$js  = '<script type="text/javascript">';
	$js .= 'alert("您输入的内容可能存在危险字符，请检查！");';
	$js .= "window.history.go(-1);";
	$js .= "</script>";
	echo $js;
	exit;
}

/**
 *  攻击检查拦截
 */
function webscan_StopAttack($StrFiltKey, $StrFiltValue, $ArrFiltReq, $method) {
	$StrFiltValue = webscan_arr_foreach($StrFiltValue);
	$return_value = do_query_safe($StrFiltValue);
	$logs = array("ip"=>$_SERVER["REMOTE_ADDR"],"method"=>$method,"rkey"=>$StrFiltKey,"rdata"=>$StrFiltValue,"dovalue"=>$return_value);
	webscan_slog($logs);
	if ($return_value<1 || preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1 || preg_match("/".$ArrFiltReq."/is",$StrFiltKey)==1) {
		//$logs = array("ip"=>$_SERVER["REMOTE_ADDR"],"method"=>$method,"rkey"=>$StrFiltKey,"rdata"=>$StrFiltValue,"dovalue"=>$return_value);
		//webscan_slog($logs);
		exit(webscan_pape());
	}
}

if ($webscan_switch) {
	if ($webscan_get) {
		foreach($_GET as $key=>$value) {
			webscan_StopAttack($key,$value,$getfilter,"GET");
		}
	}
	if ($webscan_post) {
		foreach($_POST as $key=>$value) {
			webscan_StopAttack($key,$value,$postfilter,"POST");
		}
	}
	if ($webscan_cookie) {
		foreach($_COOKIE as $key=>$value) {
			webscan_StopAttack($key,$value,$cookiefilter,"COOKIE");
		}
	}
}

/* config文件调用 开始 */
function filter_unsafe($string) {
	/*
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = filter_unsafe($val);
		}
	} else {
		$string = str_ireplace(array('(',')','/','-','+','!','0x','>','<','|',';','=','~','^','#'), '', $string);
	}
	*/
	return $string;
}

function check_unsafe($unsafe_array, $check_string) {
	$check_string = strtolower($check_string);
	foreach($unsafe_array as $key=>$value) {
		if (strpos($check_string, $value)) {
			return $value;
		}
	}
	
	return "ok";
}

function check_post_get_cookie($method,$key,$value,$unsafes) {
	$check_string = webscan_arr_foreach($value);
	$check_return = check_unsafe($unsafes,$check_string);
	if (do_query_safe($check_string,$unsafes)<1 || $check_return!="ok") {
		$logs = array("ip"=>$_SERVER["REMOTE_ADDR"],"method"=>$method,"rkey"=>$key,"rdata"=>$check_string,"dovalue"=>$check_return);
		webscan_slog($logs);
		exit(webscan_pape());
	}
}

/**
 *  过滤不安全字符，并检测，config中调用
 */
function filter_check_diy() {
	$unsafes = array(
		"and","select","update","from","where","order","by","*","delete","'","insert","into","values","create","table","database",
		"script","iframe","object","declare","exec","dbcc","alter","drop","backup","open","close","begin","retun","exists","union",
		"response","write","count","master","truncate","document","function","event","input","sleep","benchmark","mysql",
		"mysqladmin","grant","show","describe","mysqldump","mysqlimport","rename","source","infile","outfile","load_file",
		"k_user","k_money","huikuan","c_bet","k_bet","lottery_data","ka_admin","ka_mem","ka_tan","securitycard","sys_admin","sys_log",
		"save_user","`","\"","\\","hex","substring","ord","char","dumpfile","like","!","#"
	);
	
	//完全白名单
	$whitelist = array("xtgl/lmgl.php","xtgl/set_site.php");
	foreach($whitelist as $white) {
		if (strpos($_SERVER['PHP_SELF'], $white)) {
			$unsafes = array();
			break;
		}
	}

	$_GET = filter_unsafe($_GET);
	$_POST = filter_unsafe($_POST);
	$_COOKIE = filter_unsafe($_COOKIE);
	
	foreach($_GET as $key=>$value) {
		check_post_get_cookie("GET",$key,$value,$unsafes);
	}
	
	foreach($_POST as $key=>$value) {
		check_post_get_cookie("POST",$key,$value,$unsafes);
	}
	
	foreach($_COOKIE as $key=>$value) {
		check_post_get_cookie("COOKIE",$key,$value,$unsafes);
	}
}

/**
 *  检查某个字符串
 */
function filter_check_mysql($key,$value) {
	$unsafes = array(
		"and","select","update","from","where","order","by","*","delete","'","insert","into","values","create","table","database",
		"script","iframe","object","declare","exec","dbcc","alter","drop","backup","open","close","begin","retun","exists","union",
		"response","write","count","master","truncate","document","function","event","input","sleep","benchmark","mysql",
		"mysqladmin","grant","show","describe","mysqldump","mysqlimport","rename","source","infile","outfile","load_file",
		"k_user","k_money","huikuan","c_bet","k_bet","lottery_data","ka_admin","ka_mem","ka_tan","securitycard","sys_admin","sys_log",
		"save_user","`","\"","\\","hex","substring","ord","char","dumpfile","like","!","#"
	);
	
	check_post_get_cookie("CHECK",$key,$value,$unsafes);
}
/* config文件调用 结束 */

/* 自定义强化拦截 */
filter_check_diy();
?>