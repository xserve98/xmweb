<?php
/* params加密函数 */
function get_params($input) {
	global $services;
	global $siteno;
	$arrcur = array();
	$arrcur = get_service();
	
	$arryparam = array();
	$arryparam["siteNo"] = $siteno;
	$arryparam["paramsUrl"] = $input;
	
	try {
		@$objSoapClient = new SoapClient("http://$arrcur[0]/AGLineService.asmx?WSDL");
		$out = $objSoapClient->DesParams($arryparam);
		$data = $out->DesParamsResult;
	} catch (Exception $ex) {
		$data = "error";
		$i = 0;
		while($i<count($services) && $data=="error"){
			$i++;
			$arrcur = fetch_nextservice($arrcur[1]);
			try {
				@$objSoapClient = new SoapClient("http://$arrcur[0]/AGLineService.asmx?WSDL");
				$out = $objSoapClient->DesParams($arryparam);
				$data = $out->DesParamsResult;
			} catch (Exception $ex) {
				$data = "error";
			}
		}
	}
	
	return $data;
}

/* 创建游戏账号加密 */
function CheckOrCreateGameAccount($loginname,$password,$actype) {
	global $cagent;
	$input = "cagent=$cagent/\\\\/loginname=$loginname/\\\\/method=lg/\\\\/actype=$actype/\\\\/password=$password";
	$params = get_params($input);
	return $params;
}

/* 登陆游戏加密 */
function ForwardGame($loginname,$password,$actype) {
	global $cagent;
	global $dm;
	global $cur;
	global $gametype;
	$sid = $cagent.get_billno();
	$input = "cagent=$cagent/\\\\/loginname=$loginname/\\\\/password=$password/\\\\/dm=$dm/\\\\/sid=$sid/\\\\/actype=$actype/\\\\/lang=1/\\\\/gameType=$gametype/\\\\/cur=$cur";
	$params = get_params($input);
	return $params;
}

/* 查询余额加密 */
function GetBalance($loginname,$password,$actype) {
	global $cagent;
	global $cur;
	$input = "cagent=$cagent/\\\\/loginname=$loginname/\\\\/method=gb/\\\\/actype=$actype/\\\\/password=$password/\\\\/cur=$cur";
	$params = get_params($input);
	return $params;
}

/* 预备转账加密 */
function PrepareTransferCredit($loginname,$password,$actype,$billno,$type,$credit) {
	global $cagent;
	global $cur;
	$input = "cagent=$cagent/\\\\/loginname=$loginname/\\\\/method=tc/\\\\/billno=$billno/\\\\/type=$type/\\\\/credit=$credit/\\\\/actype=$actype/\\\\/password=$password/\\\\/cur=$cur";
	$params = get_params($input);
	return $params;
}

/* 转账确认加密 */
function TransferCreditConfirm($loginname,$password,$actype,$billno,$type,$credit,$flag) {
	global $cagent;
	global $cur;
	$input = "cagent=$cagent/\\\\/loginname=$loginname/\\\\/method=tcc/\\\\/billno=$billno/\\\\/type=$type/\\\\/credit=$credit/\\\\/actype=$actype/\\\\/flag=$flag/\\\\/password=$password/\\\\/cur=$cur";
	$params = get_params($input);
	return $params;
}

/* 注册账号 */
function reg_liveuser($username,$uid,$actype) {
	$agloginname = get_nextloginname($username);
	$agpassword = get_password();
	$params = CheckOrCreateGameAccount($agloginname,$agpassword,$actype);
	$curl = new Curl_HTTP_Client();
	if ($params!="" && $params!="error") {
		global $giurl;
		global $md5key;
		global $dofile;
		global $useragent;
		global $timeout;
	
		$key = md5($params.$md5key);
		$loginurl = $giurl."/".$dofile."?params=".$params."&key=".$key;
		$curl->set_user_agent($useragent);
		$html_data = $curl->fetch_url($loginurl, "", $timeout);
		$xml = simplexml_load_string($html_data);
		
		/* 如果失败重复3次 */
		$i = 0;
		while($i<3 && $xml["info"]!="0") {
			$i++;
			$agloginname = get_nextloginname($username);
			$agpassword = get_password();
			$params = CheckOrCreateGameAccount($agloginname,$agpassword,$actype);
			if ($params!="" && $params!="error") {
				$key = md5($params.$md5key);
				$loginurl = $giurl."/".$dofile."?params=".$params."&key=".$key;
				$curl->set_user_agent($useragent);
				$html_data = $curl->fetch_url($loginurl, "", $timeout);
				$xml = simplexml_load_string($html_data);
			}
		}
		/* 如果失败重复3次 */
		
		if ($xml["info"]=="0") {
			update_liveuser($agloginname,$agpassword,$uid);
			return "0";
		} else {
			return "真人开通失败，info:[".$xml["info"]."] msg:[".$xml["msg"]."]";
		}
	} else {
		return "真人开通失败，请检查网络线路！";
	}
}

/* 网站获取真人余额 */
function get_balance($agloginname,$agpassword,$uid,$actype) {
	$params = GetBalance($agloginname,$agpassword,$actype);
	$curl = new Curl_HTTP_Client();
	if ($params!="" && $params!="error") {
		global $giurl;
		global $md5key;
		global $dofile;
		global $useragent;
		global $timeout;
	
		$key = md5($params.$md5key);
		$loginurl = $giurl."/".$dofile."?params=".$params."&key=".$key;
		$curl->set_user_agent($useragent);
		$html_data = $curl->fetch_url($loginurl, "", $timeout);
		$xml = simplexml_load_string($html_data);
		$retmsg = array();
		$retmsg[0] = "no";
		
		if ($xml["msg"]=="") {
			update_livemoney($uid,$xml["info"]);
			$retmsg[0] = "ok";
			$retmsg[1] = $xml["info"];
		} else {
			$retmsg[0] = "no";
			$retmsg[1] = "真人余额获取失败，info:[".$xml["info"]."] msg:[".$xml["msg"]."]";
		}
	} else {
		$retmsg[0] = "no";
		$retmsg[1] = "真人余额获取失败，请检查网络线路！";
	}
	
	return $retmsg;
}

/* 网站准备转账 */
function prepare_transfer($agloginname,$agpassword,$actype,$billno,$type,$credit) {
	$params = PrepareTransferCredit($agloginname,$agpassword,$actype,$billno,$type,$credit);
	$curl = new Curl_HTTP_Client();
	if ($params!="" && $params!="error") {
		global $giurl;
		global $md5key;
		global $dofile;
		global $useragent;
		global $timeout;
	
		$key = md5($params.$md5key);
		$loginurl = $giurl."/".$dofile."?params=".$params."&key=".$key;
		$curl->set_user_agent($useragent);
		$html_data = $curl->fetch_url($loginurl, "", $timeout);
		$xml = simplexml_load_string($html_data);
		
		if ($xml["info"]=="0") {
			return "0";
		} else {
			return "预备转账失败，info:[".$xml["info"]."] msg:[".$xml["msg"]."]";
		}
	} else {
		return "预备转账失败，请检查网络线路！";
	}
}

/* 网站转账确认 */
function transfer_confirm($agloginname,$agpassword,$actype,$billno,$type,$credit,$flag) {
	$params = TransferCreditConfirm($agloginname,$agpassword,$actype,$billno,$type,$credit,$flag);
	$curl = new Curl_HTTP_Client();
	if ($params!="" && $params!="error") {
		global $giurl;
		global $md5key;
		global $dofile;
		global $useragent;
		global $timeout;
	
		$key = md5($params.$md5key);
		$loginurl = $giurl."/".$dofile."?params=".$params."&key=".$key;
		$curl->set_user_agent($useragent);
		$html_data = $curl->fetch_url($loginurl, "", $timeout);
		$xml = simplexml_load_string($html_data);
		
		if ($xml["info"]=="0") {
			return "0";
		} else {
			return "转账确认失败，info:[".$xml["info"]."] msg:[".$xml["msg"]."]";
		}
	} else {
		return "转账确认失败，请检查网络线路！";
	}
}
?>