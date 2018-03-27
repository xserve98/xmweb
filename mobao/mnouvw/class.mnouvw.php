<?php
/*
===============================================================================
类：mnouvw 国易付卡类支付接口调用类
属性：
	$parter
		商户id，由国易付分配
	$type
		传入接口的卡类型
			1 – QQ卡
			2 – 盛大卡
			3 – 骏网卡
			4 – 亿卡
			5-- 完美一卡通
			6-- 搜狐一卡通
			7-- 征途游戏卡
			8-- 久游一卡通
			9-- 网易一卡通
			10 –魔兽卡
			11 --联华卡
			12-- 电信充值卡
			13-- 神州行充值卡
			14-- 联通充值卡
			15—金山一卡通
			16—光宇一卡通
	$cardno
		卡号
	$cardpwd
		卡密	
	$value
		卡面值，单位元
	$restrict
		卡能使用的地理范围, 当传入比如值9时，表示该卡只能在四川使用。当有多个限制区域时，
		以英文逗号分割限制的区域，如只能在四川、重庆使用，则传入的值为9,10。
			0 全国通用
			9	四川省
			10	重庆市
			11	贵州省
			12	云南省
			13	西藏自治区
			14	北京市
			15	天津市
			16	河北省
			17	山西省
			18	内蒙古自治区
			19	辽宁省
			20	吉林省
			21	黑龙江省
			22	上海市
			23	江苏省
			24	浙江省
			25	安徽省
			26	福建省
			27	江西省
			28	河南省
			29	广东省
			30	湖北省
			31	湖南省
			32	广西壮族自治区
			33	海南省
			34	陕西省
			35	甘肃省
			36	山东省
			37	青海省
			38	宁夏回族自治区
			39	新疆维吾自治区
			40	香港特别行政区

	$orderid
		请求发起方自己的订单号，该订单号将作为国易付的返回数据
	$callbackurl
		在下行过程中返回结果的地址，需要以http://开头
	$key
		商户密钥		
	$message
		[返回字段]，用来表示处理结果的文本消息
	$opstate
		[返回字段]，请求的结果
	$ovalue
		[返回字段]，查询出的卡实际面值，若卡与提交金额一致，返回的值为0
函数:
	send()
		发送到国易付卡类消费接口
		调用示例：
			$mnouvw = new mnouvw();
			$mnouvw->type 			= $cardType;			//卡类型	
			$mnouvw->cardno 		= $card_number;			//卡号
			$mnouvw->cardpwd 		= $card_password;		//卡密
			$mnouvw->value	 		= $amount;				//提交金额
			$mnouvw->restrict 		= $mnouvw_restrict;		//地区限制, 0表示全国范围
			$mnouvw->orderid 		= $order_id;			//订单号
			$mnouvw->callbackurl 	= $mnouvw_callback_url;	//下行url地址
			$mnouvw->parter 		= $mnouvw_merchant_id;		//商家Id
			$mnouvw->key 			= $mnouvw_merchant_key;	//商家密钥
			
			//发送
			$result	= $mnouvw->send();	
	recive()
		接收国易付消息，这里会进行身份的验证，如果您自己要做更多后续的处理，请在您自己的程序中进行
		调用示例：
			
	search($order_id)
		订单查询，在调用之前，必须先为对象设置商户id和签名，以进行身份验证
		参数:
			$order_id 要查询的订单Id号
		返回：
			若卡已经被处理，则返回成功标志1，若还在排队（即未处理），则返回失败标志0
			若卡以备处理，则处理的结果由类的返回参数$message, $opstate,$ovalue表示
		调用示例:
			
===============================================================================
*/
require_once("init.php");
class mnouvw{
	const mnouvw_card_url			= 'http://api.mnouvw.com/Card/';
	const mnouvw_card_search_url	= 'http://api.mnouvw.com/Card/';
	
	/*
	* 传入接口的卡类型
	*/
	var $type;
	
	/*
	* 商户id，由国易付分配
	*/
	var $parter;
	
	/*
	* 卡号
	*/
	var $cardno;
	
	/*
	* 卡密
	*/
	var $cardpwd;
	
	/*
	* 卡面值，单位元
	*/
	var $value;
	
	/*
	* 卡能使用的地理范围。
	*/
	var $restrict;
	
	/*
	* 请求发起方自己的订单号，该订单号将作为国易付的返回数据。
	*/
	var $orderid;
	
	/*
	* 在下行过程中返回结果的地址，需要以http://开头。
	*/
	var $callbackurl;
		
	/*
	* 商户密钥
	*/
	var $key;
	
	/*
	* [返回字段]，消息	
	*/
	var $message;
	
	/*
	* [返回字段]，请求的结果
	*/
	var $opstate;
		
	/*
	* [返回字段]，查询出的卡实际面值，若卡与提交金额一致，返回的值为0
	*/	
	var $ovalue;
		
	
	public function mnouvw(){
			
	}
	
	/*
	///发送到国易付卡类消费接口
	*/
	public function send(){	
		//检查是否正确
		$error 	= 0;
		$msg		= '您调用国易付支付接口的参数有误，错误信息如下：';
		if(empty($this->parter)){
			$error 	= 1;
			$msg 	.= '<li>parter不能为空: 商户id，由国易付联盟分配</li>';
		}
		if(empty($this->type)){
			$error 	= 1;
			$msg 	.= '<li>type不能为空: 卡类型</li>';
		}
		if(empty($this->cardno)){
			$error 	= 1;
			$msg 	.= '<li>cardno不能为空: 卡号</li>';
		}
		if(empty($this->cardpwd)){
			$error 	= 1;
			$msg 	.= '<li>cardpwd不能为空: 卡密</li>';
		}				
		if(empty($this->value)){
			$error 	= 1;
			$msg 	.= '<li>value提交有误: 卡面值</li>';
		}
		if($this->restrict == ''){
			$error 	= 1;
			$msg 	.= '<li>restrict提交有误: 地理范围限制，如果不限制，请传入0</li>';
		}
		
		if(empty($this->callbackurl)){
			$error 	= 1;
			$msg 	.= '<li>callbackurl不能为空：下行过程中返回结果的地址</li>';
		}
		if(empty($this->orderid)){
			$error 	= 1;
			$msg 	.= '<li>orderid不能为空：订单号</li>';
		}
		if(empty($this->key)){
			$error 	= 1;
			$msg 	.= '<li>key不能为空：商户密钥</li>';
		}
		
		//若提交参数有误，则提示错误信息
		if($error){
			die($msg);
		}
		
		$url	= "type=" . $this->type . "&parter=" . $this->parter . "&cardno=" . $this->cardno . "&cardpwd=" . $this->cardpwd . "&value=" . $this->value . "&restrict=" . $this->restrict . "&orderid=" . $this->orderid . "&callbackurl=" . $this->callbackurl;
		
		//签名
		$sign	= md5($url. $this->key);
		$url	= mnouvw::mnouvw_card_url . "?" . $url . "&sign=" .$sign;
				
		$result=file_get_contents($url);
		parse_str($result, $output);
		return $output['opstate'];
	}
	
	
	/*
	///接收亿卡消息，这会判断签名是否正确
	*/
	public function recive(){
		header('Content-Type:text/html;charset=GB2312');
		$orderid        = trim($_GET['orderid']);
		$opstate        = trim($_GET['opstate']);
		$ovalue         = trim($_GET['ovalue']);
		$sign           = trim($_GET['sign']);
		
		//订单号为必须接收的参数，若没有该参数，则返回错误
		if(empty($orderid)){
			die("opstate=-1");		//签名不正确，则按照协议返回数据
		}
		
		
		
		$sign_text  = "orderid=" . $orderid . "&opstate=" . $opstate . "&ovalue=" . $ovalue .$this->key;
		$sign_md5 = md5($sign_text);
		if($sign_md5 != $sign){
			die("opstate=-2");		//签名不正确，则按照协议返回数据
		}	
	}
	
	/*
	///查询
	*/
	public function search($order_id){
		//检查是否正确
		$error 	= 0;
		$msg		= '您调用国易付支付接口的参数有误，错误信息如下：';
		if(empty($this->parter)){
			$error 	= 1;
			$msg 	.= '<li>parter不能为空: 商户id，由亿卡联盟分配</li>';
		}
		if(empty($this->key)){
			$error 	= 1;
			$msg 	.= '<li>key不能为空：商户密钥</li>';
		}
				
		//若提交参数有误，则提示错误信息
		if($error){
			die($msg);
		}
		
		$url	= "orderid=" . $order_id . "&parter=" . $this->parter;
		//签名
		$sign	= md5($url. $this->key);
		$url	= mnouvw::mnouvw_card_search_url . "?" . $url . "&sign=" .$sign;		
		$result=file_get_contents($url);
		parse_str($result, $output);
		
		//设置返回字段
		$this->opstate		= $output['opstate'];
		$this->ovalue		= $output['ovalue'];
		switch((string)$output['opstate']){
			case "3":
				$this->message		= "请求参数无效";
				break;
			case "2":
				$this->message		= "签名错误";
				break;
			case "1":
				$this->message		= "订单Id无效";
				break;
			case "0":
				$this->message		= "卡被成功使用";
				break;
			case "-1":
				$this->message		= "对不起，您的卡号或密码错误，无法完成支付！";
				break;
			case "-2":
				$this->message		= "卡实际面值和提交时面值不符，卡内实际面值未使用, 卡实际面额为: ". $this->ovalue;
				break;
			case "-3":
				$this->message		= "卡实际面值和提交时面值不符，卡内实际面值已使用, 卡实际面额为:". $this->ovalue;
				break;
			case "-4":
				$this->message		= "对不起，您的卡已经被使用，无法完成支付！";
				break;
			case "-5":
				$this->message		= "您的卡正在处理中，请稍等……";
				return 0;
		}
		
		return 1;
	}
}
?>