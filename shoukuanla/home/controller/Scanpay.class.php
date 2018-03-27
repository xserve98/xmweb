<?php 
/*
功能：显示扫码支付页面
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net 
备用域名：www.chonty.com
版本号:1.0

//升级修改
*/
class Scanpay extends ShoukuanlaBase{

function __construct(){  

  $this->_newDb();
}

//支付宝
public function index(){

  $post=skl_I($_POST);

  if(empty($post['titleLong'])){  exit; }
	if(empty($post['titleShort']) && $post['isWriteNote'] == '1'){  exit; }	

	$rechargeType=$post['rechargeType'];
	if($rechargeType == '2'){
	   $this->_newCfg('config'.$rechargeType.'.php');
	}else{
	   $this->_newCfg();
	}

	$titleLong=$post['titleLong'];
  //先查出订单有效时间
  $chaOrderInfo=$this->db->find($this->cfg_orderTableName,"`$this->cfg_timeField`","`$this->cfg_orderField`='$titleLong'"); 
	if(empty($chaOrderInfo)){ skl_error('该订单已失效'); }

  if($this->cfg_isTimestamp){
	   $orderCreateTime=$chaOrderInfo[$this->cfg_timeField];
	}else{
	   $orderCreateTime=strtotime($chaOrderInfo[$this->cfg_timeField]);
	}
	$post['cfg_geTime']=$this->cfg_geTime-(time()-$orderCreateTime);

	if($post['isMobile'] == '1'){

		//支付宝
		if($post['payType'] == 'alipay'){
       $template='/alipay_mobile.php';
		}elseif($post['payType'] == 'wxpay'){
       $template='/wxpay_mobile.php';
		}elseif($post['payType'] == 'tenpay'){
       $template='/tenpay_mobile.php';
		}else{ skl_error('支付类型错误！'); }

	}else{

	  //微信
		if($post['payType'] == 'alipay'){
       $template='/alipay.php';
		}elseif($post['payType'] == 'wxpay'){
       $template='/wxpay.php';
		}else{ skl_error('支付类型错误！'); }
	}

  require_once(SKL_VIEW_PATH.SKL_CONTROLLER.$template);

}


}


?>