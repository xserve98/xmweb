<?php
/*
功能：输出选择金额样式
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net 
备用域名：www.chonty.com
版本号:1.0
*/
class Selectmoney extends ShoukuanlaBase{

/*function __construct(){  
  
	$this->_newDb();

}*/


public function index(){

}

//输出选择金额组样式
/*调用方法：      
<?php 
$_GET['c']='Selectmoney';
require_once(dirname(__FILE__).'/../shoukuanla/index.php');
$shoukuanla->showmoney();
?>
*/
public function showmoney($skl_moneyName='money'){

	$this->_newCfg();
	
 	//扫描目录名称
	require_once(SKL_FUNCTION_PATH.'skl_scanDirFile.php');
	$dirName=skl_scanDirFile(SKL_ROOT_PATH.'images/aliqrcode','dir'); 
	sort($dirName);

  require_once(SKL_VIEW_PATH.SKL_CONTROLLER.'/showmoney.php');

}


//输出支付方式样式
public function showpaytype($payType=array('alipay'=>'alipay','wxpay'=>'wxpay','tenpay'=>'tenpay'),$inputName='paytype'){

foreach($payType as $k=>$v){

if($k == 'alipay'){ $checked='checked="checked"'; }else{ $checked='';  }
echo '
<label><input name="'.$inputName.'" value="'.$v.'" type="radio" '.$checked.'>
<img src="'.SKL_WEBROOT_PATH.'images/'.$k.'.png"></label>

';

}

}


}
?>