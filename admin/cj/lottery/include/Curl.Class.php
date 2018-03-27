<?php
class curl{
  private $binfo   = array();
  private $headers = array();
  private $comeurl = '';
  private $times   = 30;
  public  $error   = '';
  public  $errno   = 0;
  
  public function __construct() {
       $this -> binfo =array(
        'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 2.0.50727; InfoPath.2; AskTbPTV/5.17.0.25589; Alexa Toolbar)',
		'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0',
		'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET4.0C; Alexa Toolbar)',
		'Mozilla/4.0(compatible; MSIE 6.0; Windows NT 5.1; SV1)',
		$_SERVER['HTTP_USER_AGENT'] 
	  );
  }
  
  public function seting($url = '',  $ip = '127.0.0.1', $time = 30 ) {
	$this -> headers = array( 
	  'CLIENT-IP:' . $ip, 	
	  'X-FORWARDED-FOR:'. $ip, 
	  'Expect:'
    );	 
	$this -> comeurl = $url;
	$this -> times   = $time;
  }
  
  public function post( $url = '',  $data = array()){
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_HTTPHEADER, $this -> headers);//IP
	  curl_setopt($ch, CURLOPT_REFERER, $this -> comeurl);   //来路
	  curl_setopt($ch, CURLOPT_HEADER, 0);
	  curl_setopt($ch, CURLOPT_POST, 1 );
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
	  curl_setopt($ch, CURLOPT_POSTFIELDS, $data );
      curl_setopt($ch, CURLOPT_USERAGENT, $this -> binfo );
	  $out = curl_exec($ch);
	  $this -> error = curl_error($ch);
	  $this -> errno = curl_errno( $ch );
	  curl_close($ch);
	  return !$this -> errno ? $out : false;
  }  

	
}