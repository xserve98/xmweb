<?php

function build_mysign($sort_array,$key,$signType = "MD5") 
{
    $prestr = create_linkstring($sort_array);     	//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
    $prestr = $prestr.$key;							//把拼接后的字符串再与安全校验码直接连接起来
    $mysgin = sign($prestr,$signType);			    //把最终的字符串签名，获得签名结果
    return $mysgin;
}	

/********************************************************************************/

/**
    *把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
	*$array 需要拼接的数组
	*return 拼接完成以后的字符串
*/
function create_linkstring($array) 
{
    $arg  = "";
    while (list ($key, $val) = each ($array)) 
	{
        $arg.=$key."=".$val."&";
    }
    $arg = substr($arg,0,count($arg)-2);		     //去掉最后一个&字符
    return $arg;
}

/********************************************************************************/

/**
    *除去数组中的空值和签名参数
	*$parameter 签名参数组
	*return 去掉空值与签名参数后的新签名参数组
 */
function para_filter($parameter) 
{
    $para = array();
    while (list ($key, $val) = each ($parameter)) 
	{
        if($key == "sign" || $val == "")
		{
			continue;
		}
        else
		{
			$para[$key] = $parameter[$key];
		}
    }
    return $para;
}
/********************************************************************************/

/**对数组排序
	*$array 排序前的数组
	*return 排序后的数组
 */
function arg_sort($array) 
{
    ksort($array);
    reset($array);
    return $array;
}

/********************************************************************************/

/**签名字符串
	*$prestr 需要签名的字符串
	*return 签名结果
 */
function sign($prestr,$signType) 
{
    $sign='';
    if($signType == 'MD5') 
	{
        $sign =  strtoupper(md5($prestr));
    }
	else 
	{
        die("暂不支持".$sign_type."类型的签名方式");
    }
    return $sign;
}

/********************************************************************************/
?>