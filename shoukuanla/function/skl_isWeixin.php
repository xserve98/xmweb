<?php 
//判断是不是微信浏览器请求
function skl_isWeixin(){

  if(stripos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false){ 
     return false; 
  }else{ return true; }

}