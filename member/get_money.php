<?php
session_start();
include_once("../include/config.php"); 
include_once("../m/mail/mail.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("function.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);

$sqla="select * from k_user where uid = '$uid'  limit 1";
$query	 =	$mysqli->query($sqla);
$rs2	 =	$query->fetch_array();
$sqlb="select sum(money) as sum_money from c_bet where uid = '$uid' and js=0 group by uid ";
$query	 =	$mysqli->query($sqlb);
$rs1	 =	$query->fetch_array();





$sql	=	"select pay_name,pay_card from k_user where uid=$uid limit 1";
$query	=	$mysqli->query($sql);
$rs		=	$query->fetch_array();
if($rs['pay_name'] == ""){
	message("请先设置真实姓名","userinfo.php");
	exit();
}
if($rs['pay_card'] == ""){
	message("请先绑定银行账号信息","set_card.php");
	exit();
}

if(@$_GET["action"]=="tikuan"){
	$date_s = date("Y-m-d")." 00:00:00";
	$date_e = date("Y-m-d")." 23:59:59";
	$sql = "select count(*) as c from k_money where uid='$uid' and m_value<0 and m_make_time > '$date_s'  and m_make_time < '$date_e' and type = 2 ";
	///echo $sql;
	$query	=	$mysqli->query($sql);  		
	$one	=	$query->fetch_array();

    //验证提款密码
    $qk_pwd	=	md5($_POST["qk_pwd"]);
    $qk_sql	=	"select uid from k_user where uid=$uid and qk_pwd='$qk_pwd'";
	$qk_query	=	$mysqli->query($qk_sql);  		
	$qk_rs		=	$qk_query->fetch_array();
	if(!$qk_rs){
		message('提款密码错误，请重新输入');
		exit();
	}
	
	$pay_value	=	sprintf("%.2f",floatval($_POST["pay_value"]));
	if(($pay_value<0)||($pay_value>$userinfo["money"])){
		message('提款金额错误，请重新输入');
		exit();
	}
    
    if($pay_value<$web_site['qk_limit']){
        message('提款金额不能低于['.$web_site['qk_limit'].']元');
		exit();
    }
    
    $currtime=time();
    $c_time=date("Y-m-d H:i",$currtime);
    $qk_time_begin=date("Y-m-d",$currtime)." ".$web_site['qk_time_begin'];
    $qk_time_end=date("Y-m-d",$currtime)." ".$web_site['qk_time_end'];
	
    if (strtotime($c_time)<strtotime($qk_time_begin) || strtotime($c_time)>strtotime($qk_time_end)) {
        message('很抱歉，不在提款时间段，暂时不能提款');
		exit();
    }
	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$sql		=	"update k_user set money=money-$pay_value where uid=$uid";
		$mysqli->query($sql);
		$q1			=	$mysqli->affected_rows;
		
		$pay_value	=	0-$pay_value; //把金额置成带符号数字
		$order		=	$_SESSION['username']."_".date("YmdHis");
		$about ='提款-'.$userinfo["pay_card"];
		$sql		=	"insert into k_money(uid,m_value,status,m_order,pay_card,pay_num,pay_address,pay_name,about,assets,balance,type) values($uid,$pay_value,2,'$order','".$userinfo["pay_card"]."','".$userinfo["pay_num"]."','".$userinfo["pay_address"]."','".$userinfo["pay_name"]."','$about',".$userinfo["money"].",".($userinfo["money"]+$pay_value).",2)";
		
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
		
		if($q1==1 && $q2==1){
			$mysqli->commit(); //事务提交
		
			
	    $fromname=$_SESSION['username'].'提款';
		$title='会员'.$_SESSION['username'].'提款'.$pay_value.'元！请及时处理'.date('Y-m-d h:i:s',time());
	$content='会员'.$_SESSION['username'].'提款'.$pay_value.'元！姓名:   '.$userinfo["pay_name"].'  --银行：   '.$userinfo["pay_card"].'   ---卡号：  '.$userinfo["pay_num"].'请及时处理'.date('Y-m-d h:i:s',time());
	 send_mail($fromname,$title,$content);	
				message('提款申请已经提交，等待财务人员为您出款','data_t_money.php');
		}else{
			$mysqli->rollback(); //数据回滚
			message("由于网络堵塞，本次申请提款失败。\\n请您稍候再试，或联系在线客服。");
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message("由于网络堵塞，本次申请提款失败。\\n请您稍候再试，或联系在线客服。");
	}
}
$sub = 2;
?>
<html class="no-js" lang=""><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/newdsn/css/jquery-ui.css">
<link rel="stylesheet" href="/newdsn/css/jquery-ui.theme.css">
<link rel="stylesheet" href="/newdsn/css/admin.css">
<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="/js/laydate/laydate.min.js"></script>

<link type="text/css" rel="stylesheet" href="/js/laydate/need/laydate.css">
<link type="text/css" rel="stylesheet" href="/js/laydate/skins/default/laydate.css" id="LayDateSkin">
<script type="text/javascript" src="/js/dialog.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/admin_content.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/common.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/index.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/draw.js?v=0122"></script>
</head>
<body id="bodyid" class="skin_blue">
 <?php include_once("moneymenu.php"); ?>
	<div class="rightpanel">
		<div class="contentcontainer">
			<div class="row">
				<div class="stepitm stepactive" style="z-index: 3;">
					<div class="stepnotxt">01 提交</div>
					<div class="hlfcircle hlfcircleactive"></div>
				</div>
				<div class="stepitm" style="z-index: 2;">
					<div class="stepnotxt">02 审核</div>
					<div class="hlfcircle"></div>
				</div>
				<div class="stepitm" style="z-index: 1;">
					<div class="stepnotxt">03 出款</div>
					<div class="hlfcircle"></div>
				</div>
				<div class="stepitm" style="z-index: 0;">
					<div class="stepnotxt">04 到账</div>
				</div>

			</div>
			  
             <?php if($rs2['money']<$web_site['qk_limit']) {?>
              
			<div class="row mt10">
				<a href="javascript:void(0);" class="tabnavi tabnaviactive">快速存款</a>
			</div>
			<div class="tabbox clearfix" style="display: block;">
				<div class="margincenter mt15 warningicon"></div>
				<div class="warningtxt">
					您的中心钱包余额尚未达到提款标准<br> 提款金额最少为<?=$web_site['qk_limit']?>元
				</div>
				<div class="warningtxt">
					<a  style=" padding: 10 50px;"  class="btnsubmit"  href ="set_money.php" value="快速存款">快速存款</a>
				</div>
			</div>
            <? }else{ ?>
            
            	<div class="row mt10">
				<a href="javascript:void(0);" class="tabnavi tabnaviactive">申请提款</a>
			</div>
			<div class="tabbox clearfix" style="display: block;">
				<div class="formpanel margintop20">
                   <form  action="?action=tikuan" method="post" name="form1">
					<div class="middlecontainer mt15">
						<div class="row">
							
							<div class="col1">提款金额：</div>
							<div class="col2">
							
                               <input name="pay_value" type="text" class="textbox2" id="pay_value" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"maxlength="10"/>
							</div>
						</div>
						<div class="row">
							<div class="col1">绑定银行：</div>
														<div class="col2">
                             <input type="text" type="hidden" value="<?=$userinfo["pay_card"]?>" class="textbox2" readonly="readonly">
							</div>
						</div>
                            <div class="row">
							<div class="col1">绑定卡号：</div>
							<div class="col2">
                             <input type="text" type="hidden" value="<?=$userinfo["pay_num"]?>" class="textbox2" readonly="readonly">
							</div>
						</div>
						<div class="row">
							<div class="col1">提款密码：</div>
							<div class="col2">
                                <input name="qk_pwd" type="password" class="textbox2" id="qk_pwd" onKeyUp="if(isNaN(value))execCommand('undo')" maxlength="6" /></div>
						</div>
                        
                        
                        <div class="row"><br>
						<div>如未设置提款密码，请尝试登录密码或者 "123456"</div>
						</div>
						<div class="row"><br>
							<div class="col1">&nbsp;</div>
							<div class="col2 btn">
								<input type="submit"  class="btnsubmit" value="提交">
							</div>
						</div>
						<div class="row"><br><br>
<div>　　温馨提示：请认真填写以上提款单 全天允许提款！ <br>出款时间为 09:00 到 24:00) 如需更换银行卡，请联系在线客服。</div>
						</div>
					</div>
                       </form>
				</div>
			</div>
			
            <? } ?>
			  		</div>
	</div>



</body></html>