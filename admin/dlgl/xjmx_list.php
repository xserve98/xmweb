<?php
include_once("../common/login_check.php");
check_quanxian("dlgl"); 

function sum($num){
	return $num=='' ? 0 : $num;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../../css/tikuan2.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.STYLE1 {color: #000000}
-->
</style>
</head>
<body>
<div>
  <div class="waikuang00">
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="waikuang">
    <tr class="sekuai_01">
	  <td width="200">会员名称</td>
	  <td width="200">存款总额</td>
	  <td width="200">取款总额</td>
	  <td width="172">盈亏情况</td>
	  </tr>	
<?php
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

$uid		=	$_GET['uid'];
$thisMonth	=	date('Y-m',time()); //默认为当前月
$month		=	$_GET['month'];

$where		=	'';
if($month != $thisMonth) $where	=	" and reg_date<='".date("Y-m-d H:i:s",strtotime("$month"."-1 23:59:59"." +1 month")-1)."'"; //查询上个月
$sql		=	"select uid,username from k_user where top_uid=$uid $where order by uid desc";

$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,15);

$uid		=	'';
$arr_user	=	array();
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
	if($i >= $start && $i <= $end){
		$uid .=	$row['uid'].',';
		$arr_user[$row['uid']]	=	$row['username'];
	}
	if($i > $end) break;
	$i++;
}

if($uid){
	$uid	=	rtrim($uid,',');
	$ck		=	$qk	=	$yk	=	array();
	$sql	=	"select m_value,uid,about,sxf from k_money where `status`=1 and m_make_time like('".$month."%') and uid in(".$uid.")"; //本月会员存款取款总额
	$query	=	$mysqli->query($sql);
	while($row = $query->fetch_array()){
		if($row['m_value'] > 0){ //存款
			if($row['about'] == '' || $row['about'] == 'The order system is successful' || $row['about'] == '该订单手工操作成功'){ //不是系统赠送金额
				$ck[$row['uid']]	+=	$row['m_value'];
				$yk[$row['uid']]	-=	$row['sxf'];
			}else{
				$yk[$row['uid']]	-=	$row['m_value'];
			}
		}else{ //取款
			$qk[$row['uid']]		+=	abs($row['m_value']);
			$yk[$row['uid']]		-=	$row['sxf'];
		}
	}
	$sql	=	"select money,zsjr,uid from huikuan where `status`=1 and `adddate` like('".$month."%') and uid in(".$uid.")"; //本月会员汇款总额
	$query	=	$mysqli->query($sql);
	while($row = $query->fetch_array()){
		$yk[$row['uid']]	-=	$row['zsjr'];
		$ck[$row['uid']]	+=	$row['money'];
	}
	$sql	=	"select uid,bet_money,win,fs from k_bet where `status` in (1,2,4,5) and uid in(".$uid.") and match_coverdate like('".$month."%')"; //单式盈亏,未结算，无效不算
	$query	=	$mysqli->query($sql);
	while($row = $query->fetch_array()){
		$yk[$row['uid']]	+=	$row['bet_money']; //先扣交易金额
		$yk[$row['uid']]	-=	$row['win']; //再加已赢金额
		$yk[$row['uid']]	-=	$row['fs']; //再加返水金额
	}
	$sql	=	"select uid,bet_money,win,fs from k_bet_cg_group where `status`=1 and uid in(".$uid.") and match_coverdate like('".$month."%')"; //串关盈亏,已结算才计算
	$query	=	$mysqli->query($sql);
	while($row = $query->fetch_array()){
		$yk[$row['uid']]	+=	$row['bet_money']; //先扣交易金额
		$yk[$row['uid']]	-=	$row['win']; //再加已赢金额
		$yk[$row['uid']]	-=	$row['fs']; //再加返水金额
	}
	
	$i		=	0;
	foreach($arr_user as $k=>$v){
		if(($i%2)==0) $bgcolor="#FFFFFF";
		else $bgcolor="#F5F5F5";
		$i++;
?>
	<tr align="center" bgcolor="<?=$bgcolor?>"  onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'">
    <td height="30" valign="middle" ><?=$v?></td>
    <td height="30" valign="middle" ><?=sum($ck[$k])?></td>
    <td height="30" valign="middle" ><?=sum($qk[$k])?></td>
    <td height="30" valign="middle" ><?=sum($yk[$k])>0 ? '<span style="color:#FF0000;">'.sum($yk[$k]).'</span>' : '<span style="color:#000000;">'.sum($yk[$k]).'</span>'?></td>
    </tr>
<?php
	}
}else{
?>
	<tr align="center" >
    <td height="30" colspan="4" valign="middle" ><span class="STYLE1">暂无下级</span></td>
    </tr>
<?php
}
?>
    </table>
	<div class="sekuai_03"><div class="fanye"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></div>
	本页总存款：<font color="#FFFFFF"><?=array_sum($ck)?></font>，总取款：<font color="#FFFFFF"><?=array_sum($qk)?></font>，总盈亏：<font color="#FFFFFF"><?=round(array_sum($yk),2)?></font></span>
  </div>
  </div>
</div>
</body>
</html>