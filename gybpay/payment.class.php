<?php

/*
 * @name 简易收款基础类
 *
 * @QQ:970308759
 */
class Payment {
 
    
	/**
	 * 类初始化
	 * @array $payment	签名密钥
	 * @param url		请求的URL
	 */
        public $debug = 0;


        public function __construct($payment=array(), $url="") {
                $this->ID   = $payment['id'];
		$this->Key  = $payment['key'];
                unset($payment['id']);
                unset($payment['key']);
                //************对于id，key以外的参数自动加入扩展
                foreach($payment as $key => $val){
                    $this->$key = trim($val);
                }
		$this->serverUrl = $url;
	}
        
        /**
	 * @name 创建表单
	 * @data 表单内容
	 * @submitMethod post or get
	 * @param bool $isUrlencode 是否url编码  true 为是，false 为否，只为post方式有效
         * $autoSubmit  是否自动提交
	 */
	function buildForm($data, $submitMethod='post',$autoSubmit=true,$isUrlencode=true) {			
                $sHtml = "<form id='payform' name='payform' action='".$this->serverUrl."' method='".$submitMethod."' target='_self'>";
                $inputType = $this->debug?"text":"hidden";
                foreach($data as $key => $val){
                    if($this->debug)
                        {
                            $sHtml.="<br/>{$key}:";
                        }
                   if((strtolower($submitMethod)=='post')&&$isUrlencode){                                           
                           $val = urlencode($val);                       
                       }
                       $sHtml.= "<input type='{$inputType}' name='".$key."' value='".$val."'/>";
                }

                if(!$autoSubmit){
                $sHtml.= "<input type='submit' value='立即支付'>";                        
                }
                $sHtml.= "</form>";
                if($autoSubmit){
                  $sHtml.= "<script>document.forms['payform'].submit();</script>";  
                }

                return $sHtml;
	}
        
        /**
	 * @name	生成签名
	 * @param	sourceData
	 * @return	签名数据
	 */
	public function signMD5($data,$type='') {
		$signature = MD5($data.$this->Key);
                if($this->debug){
                echo "<br/>MD5签名结果：".$signature;
                }
		return $signature;
	}
        
        /**
	 * @name	准备签名/验签字符串
         * @param array $data 签名数组
         * @param string $type 空值是否加入签名，1为是，0为否，默认为否
         * @return string 待签名字符串
         *  */
	public function prepareSign($data,$type=0) {
				
		$array = array();
		foreach ($data as $key=>$value) {
                    if($value||$type){
                        array_push($array, $key.'='.$value);
                    }			
		}
                if($this->debug){
                    echo "<br/>待签字符串：".implode($array, '&');
                }
		return implode($array, '&');
	}
        
      
      
        /*
	 * @name	验证签名
	 * @param	signData 签名数据
	 * @param	sourceData 原数据
	 * @return
	 */
	public function verify($mySign, $signature) {
		//$mySign = $this->signMD5($data);
		if (strncasecmp($mySign, $signature) == 0) {
			return true;
		} else {
			return false;
		}
	}
        
        /*
         * 记录GET返回信息
         */
        public function logGET(){
                $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                $this->log2file($url);
                return $url;
	}
        
        
	/*
         * 记录POST返回信息
         */        
	public function logPOST(){
                $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                $html = "<form action='{$url}' method=POST target=_blank><br/>";
                foreach($_POST as $key => $value){
                    $html .= "{$key}:<input type=text name='{$key}' value='{$value}' /><br/>";
                }
                $html .="<input type=submit value='提交' /></form><br/>";
                $this->log2file($html);
	}
        
        
        /*
         * 记录返回信息
         * $logFile 通知日志
         */
	public function log2file($message,$logfile="log.txt"){
		file_put_contents($logfile,date("Y-m-d H:i:s : ").$message."\r\n",FILE_APPEND);
	}
        
        
        /*
         * 现金网 更新订单表
         * $orderNo 订单号
         * $orderAmount 金额
         * $username 用户名
         * $url 返回跳转的地址
         */
        public function updateCoinXianJin($orderNo,$orderAmount,$username,$url='') {
            global $mysqli;    
            if ($username==""){
                echo "返回信息错误!";
                exit;
              }else{
                      $sql="select uid,username,money from k_user where username='$username' limit 1";
                      $query	=	$mysqli->query($sql);
                      $rows	 =	$query->fetch_array();
                      $cou	=	$query->num_rows;
                      if($cou<=0){
                              echo "返回信息错误!";
                              exit;
                      }
                      $assets	 =	$rows['money'];
                      $uid	 =	$rows['uid'];
                      $username=	$rows['username'];
              }


              $sql="select * from k_money where m_order = '".$orderNo."'";
              $query	=	$mysqli->query($sql);
              $cou	=	$query->num_rows;
              if ($cou==0){
                  $sql		=	"insert into k_money(uid,m_value,m_order,status,assets,balance) values($uid,$orderAmount,'$orderNo',2,$assets,$assets+$orderAmount)";
                      $mysqli->query($sql);
                      $m_id = $mysqli->insert_id;
                      $sql	=	"update k_money,k_user set k_money.status=1,k_money.update_time=now(),k_user.money=k_user.money+k_money.m_value,k_money.about='该订单在线冲值操作成功',k_money.sxf=0,k_money.balance=k_user.money+k_money.m_value where k_money.uid=k_user.uid and k_money.m_id=$m_id and k_money.`status`=2";
                      $mysqli->query($sql);
              }	
               if(strlen($url)>0){
                          echo "<Script language=javascript>alert('交易成功,请回首页重新登入.');window.open('$url','_top')</script>";  
                }   
        }
        
        /*
         * 现金网3.0 版本 更新订单表
         * $orderNo 订单号
         * $orderAmount 金额
         * $username 用户名
         * $url 返回跳转的地址
         */
        public function updateCoinXianJin3($orderNo,$orderAmount,$username,$url='') {
            global $mysqli;    
            if ($username==""){
                echo "返回信息错误1!";
                exit;
              }else{
                      $sql="select user_id,user_name,money from user_list where user_name='$username' limit 1";
					 
                      $query	=	$mysqli->query($sql);
                      $rows	 =	$query->fetch_array();
                      $cou	=	$query->num_rows;
                      if($cou<=0){
                              echo "返回信息错误!";
                              exit;
                      }
                      $assets	 =	$rows['money'];
                      $uid	 =	$rows['user_id'];
                      $username=	$rows['user_name'];
              }


              $sql="select * from money where order_num = '".$orderNo."'";			 
              $query	=	$mysqli->query($sql);
              $cou	=	$query->num_rows;
              if ($cou==0){
				   $sql		=	"insert into money(user_id,order_value,order_num,status,assets,balance) values($uid,$orderAmount,'$orderNo','确认',$assets,$assets+$orderAmount)";
                     $mysqli->query($sql);
                      $m_id = $mysqli->insert_id;
					$sql	=	"update money,user_list set money.status='成功',money.update_time=now(),user_list.money=user_list.money+money.order_value,money.about='该订单在线冲值操作成功',money.sxf=money.order_value/100,money.balance=user_list.money+money.order_value where money.user_id=user_list.user_id and money.id=$m_id and money.`status`='确认'";
                    if($mysqli->query($sql)){
						$balance = $assets+$orderAmount;
						$sql  =   "INSERT INTO `money_log` (`user_id`,`order_num`,`about`,`update_time`,`type`,`order_value`,`assets`,`balance`) VALUES ('$username','$orderNo','".""."',now(),'在线冲值操作成功','$orderAmount','$assets','$balance');";
						$mysqli->query($sql);
					}
              }	
               if(strlen($url)>0){
                          echo "<Script language=javascript>alert('交易成功,请回首页重新登入.');window.open('$url','_top')</script>";  
                }   
        }
        /*
         * 万金 更新订单表
         * $orderNo 订单号
         * $orderAmount 金额
         */
         public function updateCoinWanJin($orderNo,$orderAmount,$db_pre='xy_') {
           
            $actionTime=time();
            $result = mysql_query("select count(*) from ".$db_pre."member_recharge where rechargeId='{$orderNo}'");
            $num = mysql_result($result,"0");
            
            if(!$num){
                return false;
            }else{
	 	$result2 = mysql_query("select * from ".$db_pre."member_recharge where rechargeId='{$orderNo}'");
		$row = mysql_fetch_array($result2);
			if($row['state']=='0')   // 未上分
		       {  
                        //-----------------帐变明细-----------------------------

                        $actionIP=$_SERVER["REMOTE_ADDR"];
                         $chaxun5 = mysql_query("select coin from ".$db_pre."members where uid= '".$row['uid']."'");
                        $coin = mysql_result($chaxun5,0);
                         $inserts = "insert into ".$db_pre."coin_log (uid,type,playedId,coin,userCoin,fcoin,liqType,actionUID,actionTime,actionIP,info,extfield0,extfield1) values ('".$row['uid']."',0,0,'".$orderAmount."','".$coin."'+'".$orderAmount."',0,1,0,UNIX_TIMESTAMP(),'".$actionIP."','huanxun ok','".$row['id']."','".$orderNo."')";

                        if (mysql_query($inserts)){echo "";}
                        else{echo "Error creating database: " . mysql_error();}    


                        //-----------------帐变明细-----------------------------
                        $s="update  ".$db_pre."members set coin=coin+{$orderAmount} where  uid={$row['uid']}";
                                if (mysql_query($s)){echo "";}
                                else{echo "Error creating database: " . mysql_error();}  
                        $ss="update  ".$db_pre."member_recharge set state='2',rechargeAmount={$orderAmount},actionTime={$actionTime} where  rechargeId='".$orderNo."'";
                                if (mysql_query($ss)){echo "";}
                                else{echo "Error creating database: " . mysql_error();} 
                                return true;
                       }else{
                          
                           return true;
                       }
            }
        }
        
        /*
         * 自动跳转 
         */
        
        function redirect($data,$submitMethod="post",$autoSubmit=true){
            echo  $this->buildForm($data,$submitMethod,$autoSubmit);
        }
        
        /*
         * 获取支付ip
         */
        public function real_ip() {
             static $realip = NULL;

            if ($realip !== NULL)
            {
                return $realip;
            }

            if (isset($_SERVER))
            {
                if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                {
                    $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

                    /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                    foreach ($arr AS $ip)
                    {
                        $ip = trim($ip);

                        if ($ip != 'unknown')
                        {
                            $realip = $ip;

                            break;
                        }
                    }
                }
                elseif (isset($_SERVER['HTTP_CLIENT_IP']))
                {
                    $realip = $_SERVER['HTTP_CLIENT_IP'];
                }
                else
                {
                    if (isset($_SERVER['REMOTE_ADDR']))
                    {
                        $realip = $_SERVER['REMOTE_ADDR'];
                    }
                    else
                    {
                        $realip = '0.0.0.0';
                    }
                }
            }
            else
            {
                if (getenv('HTTP_X_FORWARDED_FOR'))
                {
                    $realip = getenv('HTTP_X_FORWARDED_FOR');
                }
                elseif (getenv('HTTP_CLIENT_IP'))
                {
                    $realip = getenv('HTTP_CLIENT_IP');
                }
                else
                {
                    $realip = getenv('REMOTE_ADDR');
                }
            }

            preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
            $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

            return $realip;
                }   
}
