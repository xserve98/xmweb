<?php
/*
功能：基础类
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net 
备用域名：www.chonty.com
版本号:1.0
*/
class ShoukuanlaBase{
public $db;

function __construct(){  
  
}

//初始化配置信息
public function _newCfg($fileName='config.php'){

	//配置信息转成 成员变量	
	$cfg=skl_C($fileName);
  foreach($cfg as $k=>$v){
	   $this->$k=$v;
	}
	unset($cfg);
}


//初始化数据库对象
public function _newDb(){

  if(SKL_VERSION_SMALL){
    require_once (SKL_ClASS_PATH.'ShoukuanlaDb.class.php');
  }else{
	  require_once (SKL_ClASS_PATH.'ShoukuanlaDbi.class.php');
	}
  
	$this->db=new ShoukuanlaDb();

}


}
?>