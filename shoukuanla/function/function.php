<?php 
/*
功能：公用函数
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net
备用域名：www.chonty.com
*/

//递归
function skl_recursive($filter, $data){

	$result = array();
	foreach ($data as $key => $val) {
		$result[$key] = is_array($val)? skl_recursive($filter, $val) : call_user_func($filter, $val);
	}
	return $result;

}

//过滤POST数据
function skl_I($post=null,$funArr=array()){

	if(empty($post)){
		$post=&$_REQUEST;
	} 
	if(empty($post)){ return $post; }

  if(empty($funArr)){
	  $funArr=array('trim','htmlspecialchars','addslashes');  //strip_tags
	}

  foreach($funArr as $v){
	  $post=is_array($post) ? skl_recursive($v,$post) : $v($post);  
	}
 
	return $post;

}


//读取配置文件
function skl_C($fileName='config.php'){

  $config=array();
  $fileName=SKL_ROOT_PATH.$fileName;
	if(file_exists($fileName)){
	   $config=require($fileName); 
	}
   
  return $config;
}


//输出错误信息
function skl_error($title=null,$returnPath=null,$returnTime=300){
 
   require_once(SKL_VIEW_PATH.'error.php');
	 exit;
}


?>