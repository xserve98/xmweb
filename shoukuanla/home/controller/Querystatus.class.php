<?php
/*
功能：ajax查询订单状态使用频率高放到单独的文件可以提升性能。
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net 
备用域名：www.chonty.com
版本号:1.0
*/
class Querystatus extends ShoukuanlaBase{

function __construct(){  
  
	$this->_newDb();

}

//ajax查询订单状态
public function index(){

	$get=skl_I($_GET); 
	$order=$get['order'];
	$rechargeType=$get['rechargeType'];

	if($rechargeType == '2'){
	   $this->_newCfg('config'.$rechargeType.'.php');
	}else{
	   $this->_newCfg();
	}
 
	$chaStatus=$this->db->find($this->cfg_orderTableName,"`$this->cfg_stateField`","`$this->cfg_orderField`='$order' ORDER BY `$this->cfg_timeField` DESC");
	
	$jsonInfo=array();
	if(!empty($chaStatus)){ 
	  $jsonInfo[$this->cfg_stateField]=$chaStatus[$this->cfg_stateField];
	
	}else{
	  $jsonInfo['isEmpty']='1';
	}

  echo json_encode($jsonInfo);
 
}


}
?>