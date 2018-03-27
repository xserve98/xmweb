<?php
/*
功能：实现支付宝、微信扫码自动充值
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net 
备用域名：www.chonty.com
版本号:2.5

//升级修改
*/
class Shoukuanla extends ShoukuanlaBase{

public $aliEmailKey='seller_email';
public $aliTitleKey='out_trade_no';
public $aliMoneyKey='price';

public $tenEmailKey='seller_email';
public $tenTitleKey='out_trade_no';
public $tenMoneyKey='price';

public $wxTitleKey='out_trade_no';
public $wxMoneyKey='price';

public $aliAlias='alipay';//不能修改
public $tenAlias='tenpay';//不能修改
public $wxAlias='wxpay';//不能修改

public $tableAmount=1;
public $uidKey='uid';
public $separator='-';
public $publicPost=array();

function __construct(){  

  $this->_newDb();

	$rechargeType=$_GET['rechargeType'];  
  if($rechargeType == '2'){
     $this->_newCfg('config'.$rechargeType.'.php');
	}else{
	   $this->_newCfg();
	}

}

public function index(){
  $this->pay();
}


//自动切换输金额备注方式
/*public function pay2(){ 

	$post=skl_I();

	$payType=$post['payType'];
  if(empty($payType)){ $payType = $this->aliAlias; }


	if($payType == $this->aliAlias){

		$poMoney=$post[$this->aliMoneyKey];
		$payTypeName='ali';
 
  }elseif($payType == $this->wxAlias){

		$poMoney=$post[$this->wxMoneyKey];
		$payTypeName='wx';

  }elseif($payType == $this->tenAlias){
	  $this->publicPost=$post;
    $this->insert();
		exit; 
  }else{ exit; }


	//扫描目录名称
	require_once(SKL_FUNCTION_PATH.'skl_scanDirFile.php');	
	$dirName=skl_scanDirFile(SKL_ROOT_PATH."images/".$payTypeName."qrcode",'dir'); 

  $poMoney=(float)$poMoney;
	if(in_array($poMoney,$dirName)){		 
		 $skl_money_type='0';
	}else{
		 $skl_money_type='1';
	}

  $post['skl_money_type']=$skl_money_type; 
	$this->publicPost=$post;
  $this->insert();

}*/


//支付页面
public function pay(){ 

if(empty($this->publicPost)){ 
  $post=skl_I();
}else{
  $post=$this->publicPost;
}
 
$payType=$post['payType'];

if(empty($payType) || $payType == $this->aliAlias){
	$poEmail=$post[$this->aliEmailKey];
	$poTitle=$post[$this->aliTitleKey];
	$poMoney=$post[$this->aliMoneyKey];

	$poEmailKey=$this->aliEmailKey;
	$poTitleKey=$this->aliTitleKey;
	$poMoneyKey=$this->aliMoneyKey;


}elseif($payType == $this->wxAlias){
	$poEmail=$post[$this->wxEmailKey];
	$poTitle=$post[$this->wxTitleKey];
	$poMoney=$post[$this->wxMoneyKey];

	$poTitleKey=$this->wxTitleKey;
	$poMoneyKey=$this->wxMoneyKey;

}elseif($payType == $this->tenAlias){
	$poEmail=$post[$this->tenEmailKey];
	$poTitle=$post[$this->tenTitleKey];
	$poMoney=$post[$this->tenMoneyKey];

	$poEmailKey=$this->tenEmailKey;
	$poTitleKey=$this->tenTitleKey;
	$poMoneyKey=$this->tenMoneyKey;


}else{ exit; }

$poGoto=$post['goto'];
$poUid=$post[$this->uidKey];
$insert='insert';  $dopay='dopay';


//扫描目录名称
require_once(SKL_FUNCTION_PATH.'skl_scanDirFile.php');
$dirName=skl_scanDirFile(SKL_ROOT_PATH."images/aliqrcode",'dir'); 

sort($dirName);

//强行显示手机页面
if($post['isMobile'] == '1'){
	 $viewPath=SKL_VIEW_PATH.SKL_CONTROLLER.'/pay_mobile.php';
}else{

	//自动识别手机请求
	require_once(SKL_FUNCTION_PATH.'skl_isMobile.php');
	if(skl_isMobile()){
		 $viewPath=SKL_VIEW_PATH.SKL_CONTROLLER.'/pay_mobile.php';
	}else{
		 $viewPath=SKL_VIEW_PATH.SKL_CONTROLLER.'/pay.php';
	}
}
require_once($viewPath);
 

}


//提交订单处理，已生成网站订单情况
public function _dopay(){  
  //ini_set('date.timezone','Asia/Shanghai');  

	if(empty($this->publicPost)){
		$post=skl_I();
 
	}else{
		$post=& $this->publicPost;
	}

	$payType=$post['payType'];
  if(empty($payType)){ $payType = $this->aliAlias; }

	if($payType == $this->aliAlias){
    //支付宝
		$poEmail=$post[$this->aliEmailKey];
    if(empty($poEmail)){
		   $poEmail=$this->_getEmail($payType);
		}
		$poTitle=$post[$this->aliTitleKey];
		$poMoney=$post[$this->aliMoneyKey];

    $webPayType=$this->cfg_aliPayValue;
		$information=$this->_charset('支付宝扫码充值');

		//判断是否开启写备注方式
		if($this->cfg_isWriteNoteAli == '1' || $post['skl_money_type'] == '1'){
			 $isWriteNote=1;
		}

  }elseif($payType == $this->wxAlias){
    //微信
		$poTitle=$post[$this->wxTitleKey];
		$poMoney=$post[$this->wxMoneyKey];

    $webPayType=$this->cfg_wxPayValue;
		$information=$this->_charset('微信扫码充值');

		//判断是否开启写备注方式
		if($this->cfg_isWriteNoteWx == '1' || $post['skl_money_type'] == '1'){
			 $isWriteNote=1;
		}

  }elseif($payType == $this->tenAlias){

		$poEmail=$post[$this->tenEmailKey];
		if(empty($poEmail)){
	     $poEmail=$this->_getEmail($payType);
	  }
		$poTitle=$post[$this->tenTitleKey];
		$poMoney=$post[$this->tenMoneyKey];

    $webPayType=$this->cfg_tenPayValue;
		$information=$this->_charset('财付通充值');

		//如果是财付通必须要写备注
    $isWriteNote=1;

  }else{ exit; }
	

  //如果是免备注方式金额必须是整数
  if($isWriteNote != 1){
	   $poMoney=intval($poMoney);
	}else{
     $poMoney=(float)$poMoney;
  }

	if(empty($poTitle) || empty($poMoney)){ skl_error('网站订单号或金额不能为空！'); }

	//检查表单是否合法
	/*if(!$this->_checkToken($poTitle,$post['skl_token'])){ 
	    skl_error('禁止非法数据');  
	}*/

  //添加扫码字段
  $this->_addSklFiled();


	//查出所有字段
  //$findAllField=$this->db->select($this->cfg_orderTableName,'*',"`$this->cfg_orderField`<>'' limit 1");

 
	//生成备注订单号
  $orderFileName=$this->_randOrder($isWriteNote,$poMoney,$poTitle,$webPayType); 
	$sklOrder=$orderFileName['randNum'];

  if(!$sklOrder){ skl_error($poMoney.'元二维码图片资源不足，请选择其他金额或联系网站管理员添加二维码'); }
  $nowTimes=time();

  if(empty($orderFileName['findOrder'])){

		$nowTime=$this->_nowTime();

		$upArr=array(
			$this->cfg_sklOrderField=>$sklOrder,
			$this->cfg_timeField=>$nowTime,
			$this->cfg_payTypeField=>$webPayType,
		);

		if(!empty($this->cfg_infoField)){ 
			 $upArr[$this->cfg_infoField]=$information;
		}
		

	  $isUpdate=$this->db->update($this->cfg_orderTableName,$upArr,"`$this->cfg_orderField`='$poTitle' AND `$this->cfg_stateField`!='$this->cfg_stateValue' ORDER BY `$this->cfg_timeField` DESC LIMIT 1");  

    if($isUpdate < 1){ skl_error('该订单更新失败！'); }	

	   
	}else{
    
		$poTitle=$orderFileName['findOrder']['orderField'];  

	}
  

  $this->_fileJson(array($payType=>array('title'=>$sklOrder,'rechargeTime'=>$nowTimes))); 


  $nowFileName=$orderFileName['fileName'];

  //读取支付宝二维码链接配置
	if($payType == $this->aliAlias){
	  $urlCfg=skl_C($payType.'cfg.php');	  
	
	  if($isWriteNote == 1){
		   $nowFileName='aliqrcode';
		}
	}
  	

	//提交到付款页面
	$arrays=array(
		'payType'           =>$payType,
		'email'             =>$poEmail, 
    'money'             =>$poMoney,
		'titleShort'        =>$sklOrder,
		'titleLong'         =>$poTitle,
		'isWriteNote'       =>$isWriteNote,
		'fileName'          =>$nowFileName,
		'urlCfg'            =>$urlCfg[$nowFileName],
		'isMobile'          =>$post['isMobile'],
    'rechargeType'      =>$this->cfg_configId,
	);

  $this->_goPay($arrays);

}

//提交到付款页面
public function _goPay(& $arr=array()){

	if($arr['isMobile'] != '1'){	
	 //自动识别手机请求  
	  require_once(SKL_FUNCTION_PATH.'skl_isMobile.php');
    if(skl_isMobile()){
	    $arr['isMobile']='1';
	  }
	}	


  //如果是微信浏览器直接用识别二维码支付
	require_once(SKL_FUNCTION_PATH.'skl_isWeixin.php');
	if($arr['isMobile'] == '1' && $arr['payType'] == $this->wxAlias && skl_isWeixin()){

		header('location: '.SKL_WEBROOT_PATH.'index.php?c=Identify&rechargeType='.$arr['rechargeType'].'&titleShort='.$arr['titleShort'].'&isWriteNote='.$arr['isWriteNote'].'&money='.$arr['money'].'&cfg_stateField='.$this->cfg_stateField.'&cfg_stateValue='.$this->cfg_stateValue.'&fileName='.$arr['fileName'].'&cfg_findOrderUrl='.urlencode($this->cfg_findOrderUrl).'&titleLong='.$arr['titleLong'].'&cfg_returnUrl='.urlencode($this->cfg_returnUrl));
		exit;

	}

	
	if($arr['isMobile'] != '1' && $arr['payType'] == $this->tenAlias){

		//提交到财付通转账页面
		$md5=md5($arr['email']."&".$arr['money']."&".$arr['titleShort']);
		$infos='https://www.tenpay.com/v2/account/pay/paymore_cft.shtml?data='.$arr['email'].'%26'.$arr['money'].'%26'.$arr['titleShort'].'&validate='.$md5;
		header('location: '.$infos);
		exit;
	
	}


	$actionUrl=SKL_WEBROOT_PATH.'index.php?c=Scanpay';
  require_once(SKL_VIEW_PATH.SKL_CONTROLLER.'/goPay.php'); 


}
  
	

//提交订单处理，未生成网站订单情况
public function insert(){
///exit('insert成员函数未启用！');//用到时去掉exit;
//ini_set('date.timezone','Asia/Shanghai');   

if(empty($this->publicPost)){
	$post=skl_I();

}else{
	$post=& $this->publicPost;

}


$payType=$post['payType'];

if(empty($payType)){ $payType = $this->aliAlias; }
if($payType == $this->aliAlias){

	$poEmail=$post[$this->aliEmailKey];
	if(empty($poEmail)){
	   $poEmail=$this->_getEmail($payType);
	}
	$poMoney=$post[$this->aliMoneyKey];

  $webPayType=$this->cfg_aliPayValue;
	$information=$this->_charset('支付宝扫码充值');

	$poEmailKey=$this->aliEmailKey;
	$poTitleKey=$this->aliTitleKey;
	$poMoneyKey=$this->aliMoneyKey;

	//判断是否开启写备注方式
	if($this->cfg_isWriteNoteAli == '1' || $post['skl_money_type'] == '1'){
		 $isWriteNote=1;
	}

}elseif($payType == $this->wxAlias){

	$poMoney=$post[$this->wxMoneyKey];
  $webPayType=$this->cfg_wxPayValue;
	$information=$this->_charset('微信扫码充值');

	$poTitleKey=$this->wxTitleKey;
	$poMoneyKey=$this->wxMoneyKey;

	//判断是否开启写备注方式
	if($this->cfg_isWriteNoteWx == '1' || $post['skl_money_type'] == '1'){
		 $isWriteNote=1;
	}

}elseif($payType == $this->tenAlias){

	$poEmail=$post[$this->tenEmailKey];
	if(empty($poEmail)){
	   $poEmail=$this->_getEmail($payType);
	}
	$poMoney=$post[$this->tenMoneyKey];

  $webPayType=$this->cfg_tenPayValue;
	$information=$this->_charset('财付通充值');

  $poEmailKey=$this->tenEmailKey;
	$poTitleKey=$this->tenTitleKey;
	$poMoneyKey=$this->tenMoneyKey;

	//如果是财付通必须要写备注
  $isWriteNote=1;

}else{ exit; }

//如果是免备注方式金额必须是整数
if($isWriteNote != 1){
	 $poMoney=intval($poMoney);
}else{
   $poMoney=(float)$poMoney;
}

//会获取session或者cookie中的uid
$poUid=$_SESSION[$this->uidKey]; 
if(empty($poUid)){ skl_error('请登录后再提交');  }
if(empty($poMoney)){ skl_error('金额不能为空');  }

//检查表单是否合法
/*if(!$this->_checkToken($poUid,$post['skl_token']){ 
	 skl_error('禁止非法数据');  
}*/


//判断是否发生恶意提交行为
$timeValue =$this->_addtime(time(),-86400);
$timeValue =$timeValue[1];
$countOrder=$this->db->select($this->cfg_orderTableName,"`$this->cfg_uidField`","`$this->cfg_uidField`='$poUid' AND `$this->cfg_timeField`>='$timeValue'",'count');


//检查到发生恶意行为，开启验证码保护
if($countOrder > 30){

	if($post['skl_check'] != '1'){
   echo '
	  <style type="text/css">
	  .contens{
		width:280px;
		background-color: #FFF;
		box-shadow: 0px 3px 10px #0070A6;
		margin-right: auto;
		margin-left: auto;
		margin-top: 50px;
		height: auto;
		border-radius: 6px;
		font-family: "微软雅黑";
		margin-bottom: 50px;
		padding-top: 10px;
		padding-right: 20px;
		padding-bottom: 20px;
		padding-left: 20px;
	  text-align: center;
		}
		.buttonStyle{ width:120px;cursor: pointer; }
		</style>

		<div class="contens">
	  <p>订单提交太频繁，请输入验证码。</p>
	  <p><img style="cursor: pointer;" src="'.SKL_WEBROOT_PATH.'index.php?a=verify" title="看不清？点击刷新" onclick="javascript:this.src=\''.SKL_WEBROOT_PATH.'?a=verify&mt=\'+Math.random()"></p>
	  <form method="post" action="">
	  <p><input style="width:120px;" name="skl_value"></p>
		<input name="skl_check" type="hidden" value="1" />
    ';

		foreach($post as $poK=>$poV){
			echo '<input name="'.$poK.'" type="hidden" value="'.$poV.'" />';
		}

	  echo '<input class="buttonStyle" type="submit" value="提交">
		</form>	

		</div>
	';
	exit;

	}else{//开始验证
		
		$value=trim($post['skl_value']);  
	  if(empty($value)){ skl_error('验证码不能为空！','/'); }
		
    if(!$this->verify($value)){
       skl_error('验证码错误！','/');
    }

	
	}
 
}


//添加扫码字段
$this->_addSklFiled();


//生成备注订单号
$orderFileName=$this->_randOrder($isWriteNote,$poMoney,null,$webPayType,$poUid);
$sklOrder=$orderFileName['randNum'];

//var_dump($orderFileName);exit;

if(!$sklOrder){ skl_error($poMoney.'元二维码图片资源不足，请选择其他金额或联系网站管理员添加二维码'); }

$nowTimes=time();
if(empty($orderFileName['findOrder'])){

		//查用户名、当前用户余额
		/*
		$chaUser=$this->db->find($this->cfg_memberTableName,"`username`,`money`","`$this->cfg_memberUidField`=$poUid");
		if(empty($chaUser['username'])){ skl_error('该用户不存在！');  }
		*/

    $nowTime=$this->_nowTime();
		$titleLong=date('YmdHis').rand(100,999);


		//订单入库
		$insertArr=array(
		$this->cfg_orderField      =>$titleLong,
		$this->cfg_uidField        =>$poUid,
		$this->cfg_moneyField      =>$poMoney,
		$this->cfg_timeField       =>$nowTime,
		$this->cfg_sklOrderField   =>$sklOrder,
		$this->cfg_payTypeField    =>$webPayType,
            "lsh"                  =>$chaUser['username'].'_'.date('YmdHis',time()),
		'assets'           =>$chaUser['money'],	
		//'type'               =>$type,
		);

		//是否需要备注信息
		if(!empty($this->cfg_infoField)){ 
		 $insertArr[$this->cfg_infoField]=$information;
		}

		$insertID=$this->db->insert($this->cfg_orderTableName,$insertArr);  
		if(empty($insertID)){  skl_error('订单入库失败！'); }


}else{
    
	  $titleLong=$orderFileName['findOrder']['orderField'];

}

$this->_fileJson(array($payType=>array('title'=>$sklOrder,'rechargeTime'=>$nowTimes))); 


$nowFileName=$orderFileName['fileName'];

//读取支付宝二维码链接配置
if($payType == $this->aliAlias){
	$urlCfg=skl_C($payType.'cfg.php');	  

	if($isWriteNote == 1){
		 $nowFileName='aliqrcode';
	}
}


//提交到付款页面
$arrays=array(
	'payType'           =>$payType,
	'email'             =>$poEmail, 
	'money'             =>$poMoney,
	'titleShort'        =>$sklOrder,
	'titleLong'         =>$titleLong,
	'isWriteNote'       =>$isWriteNote,
	'fileName'          =>$nowFileName,
	'urlCfg'            =>$urlCfg[$nowFileName],
	'isMobile'          =>$post['isMobile'],
  'rechargeType'      =>$this->cfg_configId,
);
$this->_goPay($arrays);

}



//添加字段
public function _addSklFiled(){
	
	$table=$this->cfg_DB_PREFIX.$this->cfg_orderTableName;

	//添加交易号字段
  $chaJiaoyi=$this->db->find('INFORMATION_SCHEMA.Columns','column_name',"table_name='$table' AND table_schema='$this->cfg_DB_NAME' AND column_name='$this->cfg_jiaoyiField'",null,false);

	if($chaJiaoyi['column_name'] != $this->cfg_jiaoyiField){
	  $JiaoyiIsOk=$this->db->query("ALTER TABLE `$table` ADD `$this->cfg_jiaoyiField` CHAR( 50 ) COMMENT '".$this->_charset('交易号')."'"); 

	  if(!$JiaoyiIsOk){ skl_error('交易号字段添加失败！'); }
 
  }


	//添加支付类型字段
  $chaPayType=$this->db->find('INFORMATION_SCHEMA.Columns','column_name',"table_name='$table' AND table_schema='$this->cfg_DB_NAME' AND column_name='$this->cfg_payTypeField'",null,false);

	if($chaPayType['column_name'] != $this->cfg_payTypeField){
	  $PayTypeIsOk=$this->db->query("ALTER TABLE `$table` ADD `$this->cfg_payTypeField` CHAR( 20 ) COMMENT '".$this->_charset('支付类型')."'"); 

	  if(!$PayTypeIsOk){ skl_error('支付类型字段添加失败！'); }
 
  }

  //添加扫码备注字段
  $chaSweep=$this->db->find('INFORMATION_SCHEMA.Columns','column_name',"table_name='$table' AND table_schema='$this->cfg_DB_NAME' AND column_name='$this->cfg_sklOrderField'",null,false);

	if($chaSweep['column_name'] != $this->cfg_sklOrderField){

	  //$orderIsOk2=$this->db->query("ALTER TABLE  `$table` ADD  `skl_id` INT NOT NULL AUTO_INCREMENT COMMENT  '".$this->_charset('主键')."' FIRST ,ADD PRIMARY KEY (  `skl_id` )"); 

	  $orderIsOk=$this->db->query("ALTER TABLE `$table` ADD `$this->cfg_sklOrderField` CHAR( 50 ) COMMENT '".$this->_charset('扫码备注')."'"); 

	  if(!$orderIsOk){ skl_error('扫码备注字段添加失败！'); }
	 
  }   

}


//生成订单号
public function _randOrder($isWriteNote=0,$poMoney=null,$poTitle=null,$webPayType=null,$uid=null){

  if($poMoney < 0.01){ skl_error('金额不能小于0.01元'); }
 
  $addTime=$this->_addTime(time(),0-$this->cfg_geTime);
	$toTime=$addTime[1];


  //备注识别订单
  $i=0;
  if($isWriteNote == 1){

			if(empty($uid)){
				//会员用户名充值
				$chaUid=$this->db->find($this->cfg_orderTableName,"`$this->cfg_uidField`","`$this->cfg_orderField`='$poTitle'");	
				$chaUid=$chaUid[$this->cfg_uidField];
				
			}else{
				$chaUid=$uid;
			}

			//根据uid查出用户名
      $chaUser=$this->db->find($this->cfg_memberTableName,"`$this->cfg_memberUserField`","`$this->cfg_memberUidField`='$chaUid'");	
			$chaUser=$chaUser[$this->cfg_memberUserField];

      //$chaUser=rand(1,9).rand(0,9).rand(1,9); 
			if(empty($chaUid) || empty($chaUser)){ skl_error('用户信息不存在！'); }
 
      //小数识别订单
	    if($webPayType == $this->cfg_wxPayValue || $webPayType == $this->cfg_aliPayValue){
			
				//同一个用户提交只能留一张订单
				$chaOrder=$this->db->find($this->cfg_orderTableName,"`$this->cfg_orderField`,`$this->cfg_sklOrderField`,`$this->cfg_timeField`","`$this->cfg_uidField`='$chaUid' AND `$this->cfg_moneyField`=$poMoney AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_timeField`>'$toTime' AND `$this->cfg_stateField`!='$this->cfg_stateValue' AND `$this->cfg_sklOrderField` LIKE '%$poMoney%'");

			}else{ 
			
        //同一个用户提交只能留一张订单
        $chaOrder=$this->db->find($this->cfg_orderTableName,"`$this->cfg_orderField`,`$this->cfg_sklOrderField`,`$this->cfg_timeField`","`$this->cfg_uidField`='$chaUid' AND `$this->cfg_moneyField`=$poMoney AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_timeField`>'$toTime' AND `$this->cfg_stateField`!='$this->cfg_stateValue' AND `$this->cfg_sklOrderField` LIKE '%$chaUser%'");			
			}


		  if(!empty($chaOrder)){
		   
				 //同一个用户订单
				 $randNum=$chaOrder[$this->cfg_sklOrderField];    

				 $randNums['findOrder']=array('orderField'=>$chaOrder[$this->cfg_orderField]);
				 

		  }else{

				if($webPayType == $this->cfg_wxPayValue || $webPayType == $this->cfg_aliPayValue){
					 //判断字符串是不是浮点
           function strIsFloat($strFloat){
             return ((int)$strFloat != $strFloat);
           }

           //小数识别订单
					 $readMinimum=0.01; 
					 $configId=$this->cfg_configId;
					 $isFirst=true;
					 while(true){ 

              if($isFirst){
								$isFirst=false;

							  if(strIsFloat($poMoney)){ $readMinimum=0; }
							
							}else{
							   $readMinimum=$readMinimum+0.01;							
							}

						 $randNum=$poMoney+$readMinimum;
						 $randNum=(string)$randNum;  

						 if($this->tableAmount > 1){ $this->_newCfg(); }
						 $isRepeat=$this->db->select($this->cfg_orderTableName,"`$this->cfg_sklOrderField`","`$this->cfg_sklOrderField`='$randNum' AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_stateField`!='$this->cfg_stateValue' AND `$this->cfg_timeField`>'$toTime'",'count');

						 if($this->tableAmount > 1){

								$this->_newCfg('config2.php');
						    $isRepeat2=$this->db->select($this->cfg_orderTableName,"`$this->cfg_sklOrderField`","`$this->cfg_sklOrderField`='$randNum' AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_stateField`!='$this->cfg_stateValue' AND `$this->cfg_timeField`>'$toTime'",'count');				 
						 }

							if($this->tableAmount > 1){							
								 if($isRepeat <= 0 && $isRepeat2 <= 0){
								    break;
							   }
							}else{

								 if($isRepeat <= 0){
								    break;
							   }		
							}

							$i++;
							if($i > 99){ 
								 $randNum=0;
								 break;
							}
					}
					 
					
					if($configId != $this->cfg_configId && $this->tableAmount > 1){ 
						$this->_newCfg('config'.$configId.'.php');	
					}

				}else{				


          if($this->tableAmount > 1){

							//遇到两个订单表时启用 
							$configId=$this->cfg_configId;
							$chaUserNew=$chaUser;
							while($i < 99){ 
							 
								 if($i != 0){
									 $chaUserNew=$chaUser.'0'.$i;
								 }
								 
								 $this->_newCfg();
								 $isRepeat=$this->db->select($this->cfg_orderTableName,"`$this->cfg_sklOrderField`","`$this->cfg_sklOrderField`='$chaUserNew' AND `$this->cfg_moneyField`=$poMoney AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_stateField`!='$this->cfg_stateValue' AND `$this->cfg_timeField`>'$toTime'",'count');

								 $this->_newCfg('config2.php');
								 $isRepeat2=$this->db->select($this->cfg_orderTableName,"`$this->cfg_sklOrderField`","`$this->cfg_sklOrderField`='$chaUserNew' AND `$this->cfg_moneyField`=$poMoney AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_timeField`>'$toTime'",'count');

								 if($isRepeat <= 0 && $isRepeat2 <= 0){
									 $randNum=$chaUserNew; 				 
									 break; 
								 }
								 
								 $i++;
							 
							}

							if($configId != $this->cfg_configId){ 
								$this->_newCfg('config'.$configId.'.php');	
							}			 

					}else{
			      $randNum=$chaUser;
			    }				
         
			 }
			}
				  


	}else{

		require_once(SKL_FUNCTION_PATH.'skl_scanDirFile.php');
		//扫描指定目录下的文件名称
    if($webPayType == $this->cfg_wxPayValue){
		  $fileName=skl_scanDirFile(SKL_ROOT_PATH."images/wxqrcode/$poMoney",'file');
			$payName='微信';
			if(count($fileName) >= 99){ skl_error($payName.$poMoney.'元二维码数量不能超过99张！'); }

		}elseif($webPayType == $this->cfg_aliPayValue){
		  $fileName=skl_scanDirFile(SKL_ROOT_PATH."images/aliqrcode/$poMoney",'file');
			$payName='支付宝';
			if(count($fileName) >= 99){ skl_error($payName.$poMoney.'元二维码数量不能超过99张！'); }	

		}
		
		//判断金额组二维码是否存在
		if(empty($fileName)){  skl_error('没有找到'.$payName.$poMoney.'元的二维码图片'); }
		sort($fileName);
		$fileNameArr=array();
		foreach($fileName as $fileV){
		   $expFileName=explode('.',$fileV);

			 if($webPayType == $this->cfg_wxPayValue || $webPayType == $this->cfg_aliPayValue){
				  $expFileName2=$expFileName[0].'.'.$expFileName[1];
			    $fileNameArr[$expFileName2]=$fileV;
			 }else{
			    $fileNameArr[$expFileName[0]]=$fileV;
			 }			 

		}


		if(empty($uid)){
			//查出订单对应的uid
			$findUid=$this->db->find($this->cfg_orderTableName,"`$this->cfg_uidField`","`$this->cfg_orderField`='$poTitle'");
			$findUid=$findUid[$this->cfg_uidField];		
		}else{
		  $findUid=$uid;
		}

		if(intval($findUid) == 0){ skl_error('UID不存在！'); }


    if($webPayType == $this->cfg_wxPayValue || $webPayType == $this->cfg_aliPayValue){

			 //同一个用户提交只能留一张订单
       $findOrder=$this->db->find($this->cfg_orderTableName,"`$this->cfg_orderField`,`$this->cfg_sklOrderField`,`$this->cfg_timeField`","`$this->cfg_uidField`='$findUid' AND `$this->cfg_moneyField`=$poMoney AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_timeField`>'$toTime' AND `$this->cfg_stateField`!='$this->cfg_stateValue' AND `$this->cfg_sklOrderField` LIKE '%$poMoney.%'");

		}else{
		   //同一个用户提交只能留一张订单
       $findOrder=$this->db->find($this->cfg_orderTableName,"`$this->cfg_orderField`,`$this->cfg_sklOrderField`,`$this->cfg_timeField`","`$this->cfg_uidField`='$findUid' AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_moneyField`=$poMoney AND `$this->cfg_timeField`>'$toTime' AND `$this->cfg_stateField`!='$this->cfg_stateValue' AND `$this->cfg_sklOrderField` LIKE '%$poMoney$this->separator%'");
		}

     
    if(!empty($findOrder)){
		   
       //同一个用户订单
			 $randNum=$findOrder[$this->cfg_sklOrderField];
			 $randNums['randNum']=$randNum;       
			 $randNums['fileName']=$fileNameArr[$randNum];

			 $randNums['findOrder']=array('orderField'=>$findOrder[$this->cfg_orderField]);

			 return $randNums;
		}

		$configId=$this->cfg_configId;
		foreach($fileNameArr as $k=>$v){ 
			
			 if($this->tableAmount > 1){ $this->_newCfg(); }
			 $isRepeat=$this->db->select($this->cfg_orderTableName,"`$this->cfg_sklOrderField`","`$this->cfg_sklOrderField`='$k' AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_stateField`!='$this->cfg_stateValue' AND `$this->cfg_timeField`>'$toTime'",'count');

			 if($this->tableAmount > 1){
			 
					$this->_newCfg('config2.php');
			    $isRepeat2=$this->db->select($this->cfg_orderTableName,"`$this->cfg_sklOrderField`","`$this->cfg_sklOrderField`='$k' AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_timeField`>'$toTime'",'count'); 
			 }


			 if($this->tableAmount > 1){
			 
			 	  if($isRepeat <= 0 && $isRepeat2 <= 0){
				    $IFileName=$v;
				    $randNum=$k; 				 
				    break; 
			    }
			 }else{

				  if($isRepeat <= 0){
				    $IFileName=$v;
				    $randNum=$k; 				 
				    break; 

			    } 		 
			 
			 }			
			 
		}
			
	  if($configId != $this->cfg_configId && $this->tableAmount > 1){ 
			 $this->_newCfg('config'.$configId.'.php');	
    }
		
  }


  $randNums['randNum']=$randNum;
  $randNums['fileName']=$IFileName;
	
  return $randNums;

}


//根据备注查出网站订单号
public function _getWebOrder(& $po=array()){
if(empty($po)){
  $post=skl_I($_POST);
}else{
  $post=$po;
}

if(empty($post['order']) || empty($post['money']) || empty($post['type']) || empty($post['time'])){ exit('参数不全！'); }


//ini_set('date.timezone','Asia/Shanghai');


$payTime=strtotime($post['time']);//付款时间转时间戳
if($payTime == false){  exit('时间格式错误！');  }

$payTime+=10;//付款时间多加10秒防止服务器时间不准造成错误
$addTime=$this->_addTime($payTime,0-$this->cfg_geTime);
$smallTime=$addTime[1];
$payTime=$addTime[0];

 
//判断支付类型
if($post['type'] == $this->aliAlias){
  $webPayType=$this->cfg_aliPayValue;
}elseif($post['type'] == $this->wxAlias){
  $webPayType=$this->cfg_wxPayValue;
}elseif($post['type'] == $this->tenAlias){
  $webPayType=$this->cfg_tenPayValue;
}else{ exit('支付类型错误！'); }

$out_trade_no=$post['title'];
$money=(float)$post['money'];
 
$i=1;
do{

	//防止重复处理订单
  $jyExists=$this->db->find($this->cfg_orderTableName,"`$this->cfg_jiaoyiField`","`$this->cfg_jiaoyiField`='".$post['order']."' AND `$this->cfg_stateField`='$this->cfg_stateValue'",'count');
	if($jyExists > 0){ exit('success:该订单已处理过'); }

	//小数识别订单
	if($post['type'] == $this->wxAlias || $post['type'] == $this->aliAlias){
	   
		 $findUid=$this->db->find($this->cfg_orderTableName,"`$this->cfg_uidField`,`$this->cfg_moneyField`,`$this->cfg_orderField`,`$this->cfg_stateField`","`$this->cfg_sklOrderField`='$money' AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_stateField`!='$this->cfg_stateValue' AND `$this->cfg_timeField` BETWEEN '$smallTime' AND '$payTime' ORDER BY `$this->cfg_timeField` ASC");

	}else{
	   //备注识别订单
		 
		 $findUid=$this->db->find($this->cfg_orderTableName,"`$this->cfg_uidField`,`$this->cfg_moneyField`,`$this->cfg_orderField`,`$this->cfg_stateField`","`$this->cfg_sklOrderField`='$out_trade_no' AND `$this->cfg_payTypeField`='$webPayType' AND `$this->cfg_moneyField`=$money AND `$this->cfg_stateField`!='$this->cfg_stateValue' AND `$this->cfg_timeField` BETWEEN '$smallTime' AND '$payTime' ORDER BY `$this->cfg_timeField` ASC");
	}
	 
	$i++;
	if($i > $this->tableAmount){	 break;	}
	if(empty($findUid) && $this->tableAmount > 1){    
		$this->_newCfg('config'.$i.'.php');
	}

}while(empty($findUid));

if(!empty($findUid)){
	$findUid['existOrderTableName']=$this->cfg_orderTableName;
}

//if($findUid[$this->cfg_stateField] == $this->cfg_stateValue){ exit('success:该订单已处理过');  }

//外部调用时启用
/*if(!empty($this->cfg_configId)){
	$this->_newCfg('config.php');
}*/


return $findUid;


}


//接收软件提交的订单并处理
public function notify(){
	
//exit; 安装后去掉exit
$post=skl_I();

if(empty($post['order']) || empty($post['money']) || empty($post['type']) || empty($post['time'])){  exit('参数不全！'); }


//验证签名，收款啦软件填写的通讯秘钥
if(!$this->_checkKey($this->_getKey(),$post)){ exit('signError'); }

//$out_trade_no=$post['title'];

if($post['type'] == $this->aliAlias){
   $payTypename='支付宝充值';
}elseif($post['type'] == $this->wxAlias){
   $payTypename='微信扫码充值';
}elseif($post['type'] == $this->tenAlias){
   $payTypename='财付通充值';
}else{ exit('支付类型错误！'); }

//根据备注查询网站订单号
$getOrderInfo=$this->_getWebOrder($post);

$webOrder=$getOrderInfo[$this->cfg_orderField];  
if(empty($webOrder)){ exit('orderEmpty'); }

//修改订单状态
if($this->_upOrder($webOrder,$post) < 1){  exit('upOrderError'); }

//加钱
if($this->_addMoney($getOrderInfo[$this->cfg_uidField],$post['money']) < 1){ exit('upMoneyError'); }

$findUid=$this->db->find($this->cfg_orderTableName,"`$this->cfg_uidField`","`$this->cfg_orderField`='$webOrder'");
	$uid=$findUid[$this->cfg_uidField];	
	$fincoin=$this->db->find($this->cfg_memberTableName,"`$this->cfg_memberMoneyField`","`$this->cfg_memberUidField`='$uid'");
	$userCoin=$fincoin[$this->cfg_memberMoneyField];	
	
$insertArr2=array(
	'uid'           =>$uid,
	'm_order'       =>$webOrder,
	'm_value'       =>$post['money'], 
	'balance'     =>$userCoin,
	'assets'     =>$userCoin-$post['money'],
	'type'       =>3,
	'about'         =>$payTypename.'转账充值',  
	

);


$insertID=$this->db->insert($this->cfg_k_money,$insertArr2);





echo 'success';

}


//修改订单状态公共方法
public function _upOrder($order=null,& $post=array()){
 
  $upField="`$this->cfg_stateField`='$this->cfg_stateValue'";
  //如果是小数识别订单要修改金额
  if($post['type'] == $this->wxAlias || $post['type'] == $this->aliAlias){		
		$upField.=",`$this->cfg_moneyField`='".$post['money']."'";
	}

  //修改交易号
  if(!empty($this->cfg_jiaoyiField)){		
		$upField.=",`$this->cfg_jiaoyiField`='".$post['order']."'";
	}

  //修改付款人姓名
  if(!empty($this->cfg_userField)){	
	  $upField.=",`$this->cfg_userField`='".$post['user']."'";
	}

  return $this->db->update($this->cfg_orderTableName,$upField,"`$this->cfg_orderField`='$order'");  
}


//加钱公共方法
public function _addMoney($uid=null,$addMoney=null){

	return $this->db->update($this->cfg_memberTableName,"`$this->cfg_memberMoneyField`=`$this->cfg_memberMoneyField`+$addMoney","`$this->cfg_memberUidField`=$uid");
 
}


//验证秘钥
public function _checkKey($sign=null,& $post=array()){

  //验证签名，收款啦软件填写的通讯秘钥
  if(empty($sign)){ $sign='www.shoukuanla.net'; }

	//md5加密规则
	$md5Str=md5($post['title'].$post['order'].$post['money'].$post['time'].$post['type'].$sign);

  if($post['keymd5'] == $md5Str){  
		return true;  
	}else{ return false; }


}
  

//现在时间和判断时间格式
public function _nowTime(){

	if($this->cfg_isTimestamp){
		 return time();
	}else{
		 return date('Y-m-d H:i:s',time());

	}

}


//时间加减和判断时间格式
public function _addTime($timestamp=null,$addTime=null){

  $absTime=abs($addTime);
	$arrTime=array();
	if($this->cfg_isTimestamp){
     if($addTime > 0){
       $arrTime[0]=$timestamp;
			 $arrTime[1]=$timestamp+$absTime;
       return $arrTime;

		 }elseif($addTime < 0){
       $arrTime[0]=$timestamp;
			 $arrTime[1]=$timestamp-$absTime;
       return $arrTime;

		 }else{ return 0; }
		 	 
	}else{

     if($addTime > 0){
			 $arrTime[0]=date('Y-m-d H:i:s',$timestamp);
       $arrTime[1]=date('Y-m-d H:i:s',$timestamp+$absTime);
       return $arrTime;

		 }elseif($addTime < 0){
			 $arrTime[0]=date('Y-m-d H:i:s',$timestamp);
       $arrTime[1]=date('Y-m-d H:i:s',$timestamp-$absTime);
		   return $arrTime;

		 }else{ return 0; }

	}

}


//验证码
public function verify($checkCode=null){

  require_once(SKL_ClASS_PATH.'VerifyCode.class.php');
  $VerifyCode=new VerifyCode(array('imageH'=>50,'imageW'=>150,'fontSize'=>22));	

	if(empty($checkCode)){
	  $VerifyCode->entry();
	}else{
	  return $VerifyCode->check($checkCode);
	}

}

//编码转换
public function _charset($str=null){

  if(stripos('UTF8',$this->cfg_DB_CHARSET) === false){
     return iconv('UTF-8',$this->cfg_DB_CHARSET,$str);	   
	}else{
     return $str;
	}

}


public function  _fileJson($arr=array()){

  $filename = SKL_ROOT_PATH.'json.txt';
	$dataArr=array();

	if(file_exists($filename)){
		$dataArr=json_decode(file_get_contents($filename),true);			
	  /*if(is_array($dataArr)){
	    $dataArr=array();
	  }*/	

	}

	$data=json_encode(array_merge($dataArr,$arr));
	$is_writ=file_put_contents($filename,$data);
	if(!is_writable($filename) || !$is_writ) {
		 skl_error("json.txt文件无法保存没有写入权限!") ;
	
	}	

}

//生成令牌
public function _createToken($str=null){
	return md5(md5($str.$this->_getKey()));
}

//检查令牌
public function _checkToken($str=null,$skl_token=null){

	if(md5(md5($str.$this->_getKey())) == $skl_token){
		 return true;
	}else{
		 return false;
	}

}


//获取秘钥
public function _getKey(){

  if(empty($this->cfg_sign)){
	   //$findKey=$this->db->find('payment',"`key`","`name`='alipay'");
     return trim($findKey['key']);

	}else{		  
		 return trim($this->cfg_sign);		 
	}
  
}

//获取收款账号
public function _getEmail($payType=null){

  if($payType == $this->aliAlias){

     if(empty($this->cfg_aliUser)){
			  //获取数据库中的收款账号
	      //$findEmail=$this->db->find('payment',"`ali`","`name`='alipay'");
        return $findEmail['ali'];		 
		 }else{
		    return $this->cfg_aliUser;
		 }

	}elseif($payType == $this->tenAlias){		
		
     if(empty($this->cfg_tenUser)){
	      //$findEmail=$this->db->find('payment',"`ten`","`name`='tenpay'");
        return $findEmail['ten'];		 
		 }else{
		    return $this->cfg_tenUser;
		 }		 		 
	}
  
}

public function external(){  }

/*
//收款啦配置,官网www.shoukuanla.net
$_GET['a']='external';
require_once(dirname(__FILE__).'/../../shoukuanla/index.php');
$shoukuanla->publicPost=array('payType'=>$payType,'seller_email'=>$seller_email,'out_trade_no'=>$data['num'],'price'=>$cprice,'skl_money_type'=>$post['skl_money_type'],'isMobile'=>'0');
$shoukuanla->_dopay();exit;
*/


/*
//收款啦配置,官网www.shoukuanla.net
$_GET['a']='external';
require_once(dirname(__FILE__).'/shoukuanla/index.php');
$post=skl_I($_POST);

//验证秘钥
if(!$shoukuanla->_checkKey($shoukuanla->_getKey(),$post)){ exit('signError'); }

//根据备注订单号获取网站订单号
$getWebOrder=$shoukuanla->_getWebOrder($post);			 
$out_trade_no=$getWebOrder[$shoukuanla->cfg_orderField];
if(empty($out_trade_no)){  exit('orderEmpty');	}
.......

if($post['type'] == $shoukuanla->aliAlias || $post['type'] == $shoukuanla->wxAlias){
	 $upMoneySql="`status` = '$shoukuanla->cfg_stateValue',`$shoukuanla->cfg_jiaoyiField`='".$post['order']."',`$shoukuanla->cfg_moneyField`=$c_money";
}else{
	 $upMoneySql="`status` = '$shoukuanla->cfg_stateValue',`$shoukuanla->cfg_jiaoyiField`='".$post['order']."'";
}

*/



/*
//收款啦配置，验证金额
if($getWebOrder[$shoukuanla->cfg_moneyField] != $post['money']){ exit('moneyError'); }
*/


/*
//收款啦配置,官网www.shoukuanla.net
//创建令牌
$_GET['a']='external';
require_once(dirname(__FILE__).'/../shoukuanla/index.php');
$skl_token=$shoukuanla->_createToken($numddh);

header("location: /shoukuanla/index.php?a=dopay&payType=$payType&seller_email=".$seller_email."&out_trade_no=".$numddh."&price=$money&skl_money_type=$skl_money_type&skl_token=$skl_token&isMobile=0");
*/



/*
调用方法：    
<?php 
//输出选择金额组样式
//收款啦配置,官网www.shoukuanla.net 
$_GET['c']='Selectmoney';
require_once(dirname(__FILE__).'/../shoukuanla/index.php');
$shoukuanla->showmoney();

//输出选择支付类型组样式
$shoukuanla->showpaytype(array('alipay'=>'alipay','wxpay'=>'wxpay','tenpay'=>'tenpay'),'paytype');
?>
*/


//测试接收软件提交数据写入文件
//file_put_contents($_POST['type'].'-'.$_POST['order'].'.txt',var_export($_POST,true));


//<!--收款啦配置,style="display:none;"-->
//<iframe src="/shoukuanla/index.php" width="900px" height="700px"  frameborder=0  />


}
?>