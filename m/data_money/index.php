<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("../member/function.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);

$sql	=	"select pay_name,pay_card from k_user where uid=$uid limit 1";
$query	=	$mysqli->query($sql);
$rs		=	$query->fetch_array();
if($rs['pay_card'] == ""){
	message("请先绑定银行账号信息","/set_card");
	exit();
}

if(@$_GET["action"]=="tikuan"){
	$date_s = date("Y-m-d")." 00:00:00";
	$date_e = date("Y-m-d")." 23:59:59";
	$sql = "select count(*) as c from k_money where uid='$uid' and m_value<0 and m_make_time > '$date_s' and m_make_time < '$date_e'";
	$query	=	$mysqli->query($sql);  		
	$one	=	$query->fetch_array();
	if($one[c]>=3){
		message("您的本次提款申请失败，由于银行系统管制，每个帐号每天限制只能提款3次。");exit;
	}
    //验证取款密码
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
    
    $currtime=time()+1*12*3600;
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
		$sql		=	"insert into k_money(uid,m_value,status,m_order,pay_card,pay_num,pay_address,pay_name,about,assets,balance,type) values($uid,$pay_value,2,'$order','".$userinfo["pay_card"]."','".$userinfo["pay_num"]."','".$userinfo["pay_address"]."','".$userinfo["pay_name"]."','',".$userinfo["money"].",".($userinfo["money"]+$pay_value).",2)";
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
		
		if($q1==1 && $q2==1){
			$mysqli->commit(); //事务提交
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
$sub = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$web_site['web_title']?></title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">

    <link type="text/css" rel="stylesheet" href="/member/images/member.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="/member/images/member.js"></script>
	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<script type="text/javascript" src="../../cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/js/jquery.json-2.3.min.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/language/CN/main.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/patrn.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/login.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/util.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/account.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/conversion.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/register.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/js/mobile/validation/languages/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/js/mobile/validation/jquery.validationEngine.js"></script>
<link rel="stylesheet" type="text/css" href="../../cscpLoginWeb/js/mobile/validation/validationEngineRed.jquery.css" />
<script type="text/javascript" src="../../cscpLoginWeb/scripts/showMessageArtDialog.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/js/mobile/artDialog/artDialog.js"></script>  
<script type="text/javascript" src="../../cscpLoginWeb/js/mobile/artDialog/artDialog.source.js"></script> 
<link rel="stylesheet" type="text/css" href="../../cscpLoginWeb/js/mobile/artDialog/skins/black.css"/>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/mobile/TouchSlide.js"></script>
<link rel="stylesheet" type="text/css" href="../../cscpLoginWeb/style/CN/caiShenCP/mobile/index.css"/>
<link rel="stylesheet" type="text/css" href="../../cscpLoginWeb/style/CN/caiShenCP/mobile/main.css"/>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/personalMsg.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/report.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportLotto.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportLottery.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportM8Sport.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportLive.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportDsLottery.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportOg.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportAg.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportBBIN.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportYY.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportGG.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportPt.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportSg.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportAllBet.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/reportIg.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/mobile/dialog.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/soltsPage.js"></script>
<script type="text/javascript" src="../../cscpLoginWeb/scripts/other-caiShenCP.js"></script>
	<script type="text/javascript">
		//数字验证 过滤非法字符
        function clearNoNum(obj) {
	        obj.value = obj.value.replace(/[^\d.]/g,""); //先把非数字的都替换掉，除了数字和.
	        obj.value = obj.value.replace(/^\./g,""); //必须保证第一个为数字而不是.
	        obj.value = obj.value.replace(/\.{2,}/g,"."); //保证只有出现一个.而没有多个.
	        obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$","."); //保证.只出现一次，而不能出现两次以上
	        if(obj.value != '') {
				var re=/^\d+\.{0,1}\d{0,2}$/;
				if(!re.test(obj.value)) {
					obj.value = obj.value.substring(0,obj.value.length-1);
					return false;
				} 
	        }
        }
		
		function check_submit() {
			if($("#pay_value").val() == "") {
				alert("请输入您的取款金额");
				$("#pay_value").focus();
				return false;
			}
			if($("#pay_value").val() < <?=$web_site['qk_limit']?>) {
				alert("每次最低提款金额为<?=$web_site['qk_limit']?>元");
				$("#pay_value").focus();
				return false;
			}
			if($("#qk_pwd").val() == "") {
				alert("请输入您的取款密码");
				$("#qk_pwd").focus();
				return false;
			}
		}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#personCenterForPhone p").removeClass("footer_info");
		$("#personCenterForPhone p").addClass("footer_info_on");
/* 		$("#personCenterForPhone span").css("color","#db1902"); */
	});
	
	$(function(){
	    //菜单隐藏展开
	   /*  $("#zhedie .accli").click(function(){
	        $(this).addClass("current").next("div.acc_sub").slideToggle(300).siblings("div.acc_sub").slideUp("slow");
	        $(this).siblings().removeClass("current");
	    });
	    $("#zhedie .accli:eq(0)").click(); */
	})
</script>

</head>
	<div class="wraper">
		<div class="tit">
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>我的钱包
			<a href="/" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
		</div>

		<div style="height: 44px;"></div>
		
<div class="info_head">
	<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/transfer_head_bg.jpg"/>
		<div class="info_user">
		<p><?php if(strpos($_SESSION["username"],'guest_')===false) {?>
 <?=$_SESSION['username']?>
 <? }else{ ?>
试玩用户
 <? } ?>				<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/icon_info2.png" alt="点击查看个人信息" onclick="javascript:window.location.href='/memberInfo'" align="absmiddle" style="width: 22px; height: 22px; display: inline-block;"/>
			</a>
		</p>
		<span>余额：<b id="money"><?=sprintf("%.2f",$userinfo["money"])?> 元</b>
		<img src="/cscpLoginWeb/images/CN/caiShenCP/mobile/icon/shuaxin.png"  onclick="javascript:window.location.href=''"></span>
	</div>
</div>
		<div class="info_tit">
			<p><a href="/set_money" target="_self" data-ajax="false">存款</a></p>
			<p><a href="/get_money" target="_self" data-ajax="false">取款</a></p>
			<p class="on"><a  href="javascript:void(0);" target="_self" data-ajax="false">记录</a></p>
		</div>

		<div class="wrap_div bg2">
			<div class="account_wrap wrap bb bs">
				<div class="info_con2">
					<div class="info_nav">
						<p class="on"><a href="javascript:void(0)">存款记录</a></p>
						<p><a href="/data_t_money">取款记录</a></p>
					</div>
				</div>
<?php include_once("../modules/foots.php"); ?>
				<div class="info_tab02">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                <tr class="tic">
                    <td width="30%">存款时间</td>
                    <td width="25%">充值金额</td>
                    <td width="25%">赠送积分</td>
                    <td width="20%">状态</td>
                </tr>
                <?php
                $sql	=	"select m_id from k_money where uid=$uid and type=1 order by m_id desc";
                $query	=	$mysqli->query($sql);
                $sum	=	$mysqli->affected_rows; //总页数
                $thisPage	=	1;
                if(@$_GET['page']){
                    $thisPage	=	$_GET['page'];
                }
                $page		=	new newPage();
                $perpage	= 	15;
                $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
                $id		=	'';
                $i		=	1; //记录 uid 数
                $start	=	($thisPage-1)*$perpage+1;
                $end	=	$thisPage*$perpage;
                while($row = $query->fetch_array()){
                    if($i >= $start && $i <= $end){
                        $id .=	$row['m_id'].',';
                    }
                    if($i > $end) break;
                    $i++;
                }
                if($id) {
                    $id		=	rtrim($id,',');
                    $sql	=	"select * from k_money where m_id in($id) order by m_id desc";
                    $query	=	$mysqli->query($sql);
                    $sum_money	=	0;
                    $sum_sxf	=	0;
                    while($rows = $query->fetch_array()) {
                        ?>
                        <tr class="list f_12">
                            <td><?=date("Y-m-d H:i:s",strtotime($rows["m_make_time"]))?></td>
                            <td><?=sprintf("%.2f",$rows["m_value"])?></td>
                            <td><?=sprintf("%.2f",abs($rows["jifen"]))?></td>
                            <td>
                                <?php
                                if($rows["status"] == 1) {
                                    $sum_money += $rows["m_value"];
                                    $sum_sxf += $rows["sxf"];
                                    echo '<span class="c_red">已成功</span>';
                                } else if($rows["status"] == 0) {
                                    echo '<span>已失败</span>';
                                } else {
                                    echo '<span class="c_blue">审核中</span>';
                                }
                                ?>
                            </td>
                        </tr>
                <?php
                    }
                } else { ?>
                    <tr align="center">
                        <td colspan="4">暂无存款记录！</td>
                    </tr>
                <?php } ?>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" class="page">
                <tr>
                    <td align="right"><?=$page->get_htmlPage("data_money.php?")?></td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>
