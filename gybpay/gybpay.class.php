<?php

/*
 * 
 * 联系QQ：970308759* 
 * 忽略预付卡类
 *  */
include_once 'payment.class.php';
class gybpay extends Payment {
    
    
    /*
     * 初始化类
     * $key 商户key
     * 网关地址
     */
    function __construct($Key, $url = "http://api.mnouvw.com/Bank") {
        
        parent::__construct($Key, $url);
    }
    
    /*
     * 增加参数发送支付请求
     * $data 表单数据
     * $autoSubmit 是否自动提交
     */
    function submit($order,$autoSubmit=true) {
        
        // 业务参数
		$data['parter'] = $this->ID; //商户ID
		$data['type'] = $order['bankCode']; //银行类型
		$data['value'] = $order['orderAmount']; //金额
		$data['orderid'] = $order['ordernNo']; //商户订单号
		$data['callbackurl'] = $order['returnUrl']; //下行异步通知地址
		$data['hrefbackurl'] = $order['notifyUrl']; //下行同步通知地址
		$data['payerIp'] = $this->real_ip(); //支付用户IP
		$data['attach'] = $order['remark']; //备注消息
		

        echo  $this->buildForm($data, $autoSubmit);
    }
    
    /*
     * 生成表单
     * $data 表单数据
     * $autoSubmit 是否自动提交
     */
    function buildForm($data,$autoSubmit=true) {       
           
        $data['sign'] = $this->signMD5($data);       
        return parent::buildForm($data, "get",$autoSubmit,false);
    }
    /*
     * 签名
     * $data 表单数据
     */
      /*
     * 签名
     * $data 表单数据
     */
    function signMD5($data,$type='submit') {
        if($type=='return'){
          $signFiledArray = array('orderid','opstate','ovalue');  
        }else{
          $signFiledArray = array('parter','type','value','orderid','callbackurl'); //提交时
        }
        $key = $this->Key;
        
		
		foreach ($signFiledArray as $value) {
            $signArray[$value] = $value.'='.$data[$value];
        }
        $string = implode("&", $signArray);
		if($this->debug){
		echo "signstring:{$string}<br/>";
		}
        return MD5($string.$key);
    }
    /*
     *  验证返回  
     */
    function verify(){
      //以GET方式返回
		if(isset($_GET)){
            $_POST = array_merge($_GET,$_POST);
        }
		if($_POST['opstate']!='0'){
			return false;
		}
        return parent::verify($this->signMD5($_REQUEST,'return'), $_REQUEST['sign']);        
    }
}
?>
