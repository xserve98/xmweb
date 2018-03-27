<?php
include_once("../common/login_check.php");
check_quanxian("sjgl");

if($_GET['action'] == 'save'){
	include_once("../../include/mysqli.php");
	
	$state	=	$_REQUEST['s_date1'].' 00:00:00';
	$end	=	$_REQUEST['e_date1'].' 00:00:00';
	$num	=	0;
	if($_REQUEST['num']){
		$num=	$_REQUEST['num'];
	}
	$sum	=	0; //总会员数
	if($_REQUEST['sum']){
		$sum=	$_REQUEST['sum']; //总会员数
	}
	$str_uid=	'';
	if($_REQUEST['hf_uid']){
		$str_uid=	$_REQUEST['hf_uid']; //会员uid字符串 用,号分开
	}
	$sb_uid=	'';
	if($_REQUEST['hf_sb']){
		$sb_uid=	$_REQUEST['hf_sb']; //保存失败会员uid
	}
	
	if($str_uid == ''){ //第一次保存，需要取出所有有过存款，取款，单式，串关，汇款的会员
		$arr	=	array();
		$sql	=	"select uid from k_money where m_make_time>='".$state."' and m_make_time<'".$end."' and `status`<2 and `type`=1"; //存款，取款
		$query	=	$mysqli->query($sql);
		while($row = $query->fetch_array()){
			$arr[$row['uid']]	=	$row['uid'];
		}
		
		$sql	=	"select uid from huikuan where adddate>='".$state."' and adddate<'".$end."' and `status`>0"; //汇款
		$query	=	$mysqli->query($sql);
		while($row = $query->fetch_array()){
			$arr[$row['uid']]	=	$row['uid'];
		}
		
		$sql	=	"select uid from k_bet where match_coverdate>='".$state."' and match_coverdate<'".$end."'"; //单式
		$query	=	$mysqli->query($sql);
		while($row = $query->fetch_array()){
			$arr[$row['uid']]	=	$row['uid'];
		}
		
		$sql	=	"select uid from k_bet_cg_group where match_coverdate>='".$state."' and match_coverdate<'".$end."'"; //串关
		$query	=	$mysqli->query($sql);
		while($row = $query->fetch_array()){
			$arr[$row['uid']]	=	$row['uid'];
		}
		$sum	=	count($arr); //会员总个数
		foreach($arr as $k){
			$str_uid	.=	$k.',';
		}
		if($str_uid){
			$str_uid	=	rtrim($str_uid,',');
		}
		unset($arr);
	}
	$arr	=	array();
	$arr	=	explode(',',$str_uid);
	$uid	=	$str_uid	=	'';
	foreach($arr as $k=>$v){
		if($k == 0){
			$uid	 =	$v;
		}else{
			$str_uid.=	$v.',';
		}
	}
	if($str_uid){
		$str_uid	=	rtrim($str_uid,',');
	}
	
	//保存方案开始
	$bool	=	true; //默认还要保存会员记录
	$llje	=	0; //理论金额，保存用的
	$sql	=	"select addtime,llje from k_um where uid=$uid order by addtime desc limit 1"; //取出该会员保存的最后一个备份记录
	$query	=	$mysqli->query($sql);
	if($row = $query->fetch_array()){
		$save	=	strtotime($row['addtime']);
		$s_date	=	strtotime($state); //开始时间
		$e_date	=	strtotime($end); //结束时间
		if($save >= $e_date-1){ //已经保存过会员记录，不用再保存了
			$bool	=	false;
		}else{ //取最后一次保存的理论金额
			$state	=	date("Y-m-d H:i:s",$save+1); //最新开始时间
			$llje	=	$row['llje']; //最后一次保存的理论金额
		}
	}
	
	$msg		=	'已保存';
	
	if($bool){ //判断是否还需要保存该会员
		$ds		=	array(); //单式
		$cg		=	array(); //串关
		$ck		=	0; //存款
		$qk		=	0; //取款
		$hk		=	0; //汇款
		$fs		=	0; //返水
		
		$sql	=	"select bet_money,`status`,win,fs from k_bet where uid=$uid and match_coverdate>='".$state."' and match_coverdate<'".$end."' and `status`>0"; //所有单式下注信息,未结算，平手，无效不取
		$query	=	$mysqli->query($sql);
		while($row = $query->fetch_array()){
			$llje		-=	$row['bet_money']; //扣用户交易金额
			$llje		+=	$row['win']; //加已赢金额
			$llje		+=	$row['fs']; //加返水金额
			$ds['xz']	+=	$row['bet_money']; //单式下注金额
			$ds['yy']	+=	$row['win']; //单式已赢金额
			$fs			+=	$row['fs'];
		}
		
		$sql	=	"select bet_money,`status`,win,fs from k_bet_cg_group where uid=$uid and match_coverdate>='".$state."' and match_coverdate<'".$end."' and `status`=1"; //所有串关下注信息
		$query	=	$mysqli->query($sql);
		while($row = $query->fetch_array()){
			$llje		-=	$row['bet_money']; //扣用户交易金额
			$llje		+=	$row['win']; //加已赢金额
			$llje		+=	$row['fs']; //加退水金额
			$cg['xz']	+=	$row['bet_money']; //串关下注金额
			$cg['yy']	+=	$row['win']; //串关已赢金额
			$fs			+=	$row['fs'];
		}
		
		$sql	=	"select m_value from k_money where uid=$uid and `status`=1 and `type`=1 and m_make_time>='".$state."' and m_make_time<'".$end."'"; //所有成功的存款取款
		$query	=	$mysqli->query($sql);
		while($row = $query->fetch_array()){
			if($row['m_value'] > 0){ //存款
				$llje	+=	$row['m_value']; //加存进来的钱
				$ck		+=	$row['m_value']; //总存款数
			}else{ //取款，不管成功还是未处理，都要扣用户账户上的钱
				$llje	-=	abs($row['m_value']); //扣取出去的钱
				$qk		+=	abs($row['m_value']); //总取款数
			}
		}
		
		$sql	=	"SELECT money,zsjr FROM huikuan where uid=$uid and `status`=1 and adddate>='".$state."' and adddate<'".$end."'"; //所有成功的汇款记录
		$query	=	$mysqli->query($sql);
		while($row = $query->fetch_array()){
			$llje	+=	$row['money']+$row['zsjr']; //加汇进来的钱
			$hk		+=	$row['money']; //总汇款数
		}
		
		$dsxz		=	double_format($ds['xz']);
		$dsyy		=	double_format($ds['yy']);
		$cgxz		=	double_format($cg['xz']);
		$cgyy		=	double_format($cg['yy']);
		$ck			=	double_format($ck);
		$qk			=	double_format($qk);
		$hk			=	double_format($hk);
		$fs			=	double_format($fs);
		
		$sql		=	"insert into k_um(uid,llje,ckje,qkje,hkje,dsxz,dsyy,cgxz,cgyy,fs,addtime) values ($uid,$llje,$ck,$qk,$hk,$dsxz,$dsyy,$cgxz,$cgyy,$fs,'".date("Y-m-d H:i:s",strtotime($end)-1)."')";
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			$id 	=	$mysqli->insert_id;
			$q1		=	$mysqli->affected_rows;
			if($q1 == 1){
				$mysqli->commit(); //事务提交
				$msg=	'<span style="color:#009900;">保存成功</span>';
				
				include_once("../../class/admin.php");
				admin::insert_log($_SESSION["adminid"],"保存了会员".$uid."的核查记录：$id");
			}else{
				$mysqli->rollback(); //数据回滚
				$sb_uid	.=	$uid.',';
				$msg	 =	'<span style="color:#FF0000;">保存失败</span>';
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			$sb_uid	.=	$uid.',';
			$msg	 =	'<span style="color:#FF0000;">保存失败</span>';
		}
		$num++;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>保存所有会员核查记录</title>
<link rel="stylesheet" href="../Images/CssAdmin.css">
</head>
<script>
function wait(){
	setTimeout("gotonext()",500); //等待1秒后再保存
}

function gotonext(){
	document.form1.submit(); //跳转到下一个会员保存信息
}
</script>
<body <?php if($num < $sum){?>onload="wait()"<?php }?>>
<form id="form1" name="form1" method="post" action="save.php?action=save&num=<?=$num?>&sum=<?=$sum?>">
<p>当前进度：
  <input name="hf_uid" type="hidden" id="hf_uid" value="<?=$str_uid?>" />
  <input name="hf_sb" type="hidden" id="hf_sb" value="<?=$sb_uid?>" />
  <input name="s_date1" type="hidden" id="s_date1" value="<?=$_REQUEST['s_date1']?>" />
  <input name="e_date1" type="hidden" id="e_date1" value="<?=$_REQUEST['e_date1']?>" />
</p>
<table width="500" border="1" cellpadding="0" cellspacing="0" bordercolor="#009900">
  <tr>
    <td><div style="width:<?=sprintf("%.2f",($num/$sum)*100)?>%; background-color:#009900; color:#FFFFFF;"><?=sprintf("%.2f",($num/$sum)*100)?>%</div></td>
  </tr>
</table>
<p>共：<?=$sum?> 个会员，当前保存到第：<?=$num?> 个会员，状态：<?=$msg?></p>
<?php if($num == $sum && $sb_uid){?>
<p>保存失败的会员有：<?=rtrim($sb_uid,',')?></p>
<?php }?>
</form>
</body>
</html>
<?php
}else{
	echo '参数错误！';
	exit;
}
?>