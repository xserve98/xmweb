<?php
/*
功能：微信付款链接识别二维支付。
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net 
备用域名：www.chonty.com
版本号:1.0
*/
class Identify extends ShoukuanlaBase{

function __construct(){  
  $this->_newDb();
}

public function index(){
  $post=skl_I($_GET,array('trim','addslashes'));
	if(empty($post['titleShort']) && $post['isWriteNote'] == '1'){  exit; }

	$rechargeType=$post['rechargeType'];

	if($rechargeType == '2'){
	   $this->_newCfg('config'.$rechargeType.'.php');
	}else{
	   $this->_newCfg();
	}

	$titleLong=$post['titleLong'];
  //先查出订单有效时间
  $chaOrderInfo=$this->db->find($this->cfg_orderTableName,"`$this->cfg_timeField`","`$this->cfg_orderField`='$titleLong' AND `$this->cfg_stateField`!='$this->cfg_stateValue'"); 
	if(empty($chaOrderInfo)){ skl_error('该付款链接已失效'); }

  if($this->cfg_isTimestamp){
	   $orderCreateTime=$chaOrderInfo[$this->cfg_timeField];
	}else{
	   $orderCreateTime=strtotime($chaOrderInfo[$this->cfg_timeField]);
	}
	$post['cfg_geTime']=$this->cfg_geTime-(time()-$orderCreateTime);

  require_once(SKL_VIEW_PATH.SKL_CONTROLLER.'/index.php');
 
}


}
?>