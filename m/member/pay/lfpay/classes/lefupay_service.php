<?php

require_once("lefupay_function.php");
class lefupay_service
{
	var $gateway;			//网关地址
    var $_key;				//安全校验码
    var $mysign;			//签名结果
    var $sign_type;			//签名类型
    var $parameter;			//需要签名的参数数组
    var $_input_charset;    //字符编码格式

	/**构造函数
	*从配置文件及入口文件中初始化变量
	*$parameter 需要签名的参数数组
	*$key 安全校验码
	*$sign_type 签名类型
    */

	function lefupay_service($parameter,$key,$signType) 
	{
        if ($parameter['partner'] == '8611146479'){
        $this->gateway		= "https://qa.lefu8.com/gateway/trade.htm?";
		}else{
		$this->gateway		= "https://pay.lefu8.com/gateway/trade.htm?";	
		}
        $this->_key  		= $key;
        $this->signType	    = $signType;
        $this->parameter	= para_filter($parameter);
		


        //获得签名结果
        $sort_array   = arg_sort($this->parameter);    //得到从字母a到z排序后的签名参数数组
        $this->mysign = build_mysign($sort_array,$this->_key,$this->signType);
    }

	function BuildForm()
	{
		//GET方式传递
        $sHtml = "<form id='lefupaysubmit' name='lefupaysubmit' target=\"_top\" action='".$this->gateway."' method='get'>";
		//POST方式传递（GET与POST二必选一）
		//$sHtml = "<form id='lefupaysubmit' name='lefupaysubmit' action='".$this->gateway."_input_charset=".$this->parameter['_input_charset']."' method='post'>";

        while (list ($key, $val) = each ($this->parameter)) 
		{
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }

        $sHtml = $sHtml."<input type='hidden' name='sign' value='".$this->mysign."'/>";
        $sHtml = $sHtml."<input type='hidden' name='signType' value='".$this->signType."'/>";

		//submit按钮控件请不要含有name属性
        $sHtml = $sHtml."<input style='display:none;' type='submit' value='正在链接银行....'></form>";
		
		$sHtml = $sHtml."<script>document.forms['lefupaysubmit'].submit();</script>";
			
        return $sHtml;
	}
}
?>