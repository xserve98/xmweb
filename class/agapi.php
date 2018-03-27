<?php

class agapi{
	private $agent = '1000026';
	private $md5_key = 'aY3n1Cd0';
	private $password_prefix = 'abc';
	private $username_prefix = 'AMPJ';
	
	private $register_url = 'http://api.ag8588.com/ag/register'; //新增会员url
	private $balance_url = 'http://api.ag8588.com/ag/balance'; //查询余额url
	private $trans_url = 'http://api.ag8588.com/ag/trans'; //转账url
	private $login_url = 'http://api.ag8588.com/ag/login'; //游戏登录url
	
	
	function __construct(){
		
	}
	
	function register($username,$actype=1){
		//参数 agent,username,password,key
		
		$username = $this->username_prefix.$username;
		
		$agent = $this->agent;
		$password = substr(md5($this->password_prefix.$username),0,12);
		//$actype = 0;
		$code = md5($agent.$username.$actype.($this->md5_key));
		
		$post_data = array('agent'=>$agent,'loginname'=>$username,'password'=>$password,'actype'=>$actype,'code'=>$code);
		
		//$url = $this->register_url."?agent=".$agent."&loginname=".$username."&password=".$password."&actype=".$actype."&code=".$code;
		
		//print_r($post_data);
		
		$res = $this->docurl($this->register_url, $post_data);
		
		if($res){
			return $res;
		}else{
			//注册失败
			return array('code'=>-1,'info'=>'未知错误');
			
		}
		
		//{“result”: true, “code”: “0”, “info”: “succeed!”}  
		
		
	}
	
	function login($username,$actype = 1){
		$username = $this->username_prefix.$username;
		$agent = $this->agent;
		$password = substr(md5($this->password_prefix.$username),0,12);
		$sid = substr(md5(microtime()), 0,15);
		$code = md5($agent.$username.$actype.$sid.($this->md5_key));
		
		$post_data = array(
		'agent'=>$agent,
		'loginname'=>$username,
		'password'=>$password,
		'actype'=>$actype,
		'sid'=>$sid,
		'code'=>$code
		);
		
		//print_r($post_data);
		
		$res = $this->docurl($this->login_url, $post_data);
		
		if(isset($res['result']) && $res['result']){
			//$url = $res['url'].'?params='.$res['params'].'&key='.$res['key'];
		}
		return $res;
		
		/*
		 *  成功：{“result”:true, “url”: “http_url”, params: “parameters”, key: “key”}  
        	失败：{“result”: true, “code”: “error_code”, “info”: “failed!”}  
		 * */  
	}
	
	
	function balance_one($username,$actype=1){
		$username = $this->username_prefix.$username;
		$agent = $this->agent;
		$password = substr(md5($this->password_prefix.$username),0,12);
		$code = md5($agent.$username.$actype.($this->md5_key));
		
		$post_data = array(
		'agent'=>$agent,
		'loginname'=>$username,
		'actype'=>$actype,
		'code'=>$code
		);
		
		$res = $this->docurl($this->balance_url, $post_data);
		return $res;
		/*
		 *  成功：{“result”:true, amount: 100}  
           	失败：{“result”: true, “code”: “code”, “info”: “failed!”}  
           */ 
		
	}
	
	function trans_in($username,$credit,$actype=1){
		$username = $this->username_prefix.$username;
		$agent = $this->agent;
		$md5_key = $this->md5_key;
		$password = substr(md5($this->password_prefix.$username),0,12);
		$billno = rand(1000,9999).rand(1000,9999).rand(1000,9999).rand(1,9999);
		
		$type = 'IN';
		$code = md5($agent.$username.$actype.$billno.$type.$credit.$md5_key);
		$post_data = array(
			'agent'=>$agent,
			'loginname'=>$username,
			'password'=>$password,
			'actype'=>$actype,
			'billno'=>$billno,
			'type'=>$type,
			'credit'=>$credit,
			'code'=>$code
		);
		
		$res = $this->docurl($this->trans_url, $post_data);
		$res['billno'] = $billno; 
		return $res;
		
		/*
		 *  成功：{“result”:true, “code”: 0, “info”:”succeed!”}  
         失败：{“result”: true, “code”: “code”, “info”: “failed!”}
		 * */
		
	}
	
	function trans_out($username,$credit,$actype=1){
		$username = $this->username_prefix.$username;
		$agent = $this->agent;
		$md5_key = $this->md5_key;
		$password = substr(md5($this->password_prefix.$username),0,12);
		$billno = rand(1000,9999).rand(1000,9999).rand(1000,9999).rand(1,9999);
		
		$type = 'OUT';
		$code = md5($agent.$username.$actype.$billno.$type.$credit.$md5_key);
		$post_data = array(
			'agent'=>$agent,
			'loginname'=>$username,
			'password'=>$password,
			'actype'=>$actype,
			'billno'=>$billno,
			'type'=>$type,
			'credit'=>$credit,
			'code'=>$code
		);
		
		$res = $this->docurl($this->trans_url, $post_data);
		$res['billno'] = $billno; 
		return $res;
		
		/*
		 *  成功：{“result”:true, “code”: 0, “info”:”succeed!”}  
         失败：{“result”: true, “code”: “code”, “info”: “failed!”}
		 * */
	} 
	
	private function docurl($url,$post_data=array(),$post=true){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$res = curl_exec($ch);
		curl_close($ch);
		//print_r($res);
		return json_decode($res,true);
	}
	
	function geterrorcode($code=''){
		
		$errorcode = array("10000"=>array("error info","查看具体的说明内容"),
"10016"=>array("Network error!","网络错误"),
"25004"=>array("The agent is not exist","代理商号不存在"),
"22011"=>array("The member is not exist","会员不存在"),
"44000"=>array("key error..","验证码错误或丢失"),
"44001"=>array("The parameters are not complete","参数不完整"));
		if($code){
			if(key_exists($code, $errorcode)){
				return $errorcode[$code][1];
			}else{
				return '服务器忙，请稍后重试';
			}
		}
		return $errorcode;
	}
	
}





