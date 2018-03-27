<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");

message("该功能已取消！");

$fl		=	array(); //总分析
$sum	=	array(); //金额统计
$sj		=	array(); //时间
$ds		=	array(); //单式
$cg		=	array(); //串关
$ck		=	array(); //存款
$qk		=	array(); //取款
$hk		=	array(); //汇款
$bf_um	=	array(); //保存备份数据
$is_bf	=	false; //默认用户未备份
$uid	=	0;
$money	=	0;
$wjs	=	0;
$zt		=	'离线';
$llfs	=	0;
$sjfs	=	0;
$why	=	''; //备注信息

if($_GET['action']==1){
	$sql	=	"select uid,money,why from k_user where username='".$_REQUEST['username']."' limit 1"; //取出会员id和金额
	$query	=	$mysqli->query($sql);
	if($row = $query->fetch_array()){
		$uid	=	$row['uid'];
		$money	=	$row['money'];
		$why	=	$row['why'];
	}
	
	$sql	=	"SELECT uid FROM k_user_login where uid=$uid and `is_login`>0 limit 1"; //用户在线状态
	$query	=	$mysqli->query($sql);
	if($row = $query->fetch_array()){
		if($row['uid']) $zt	=	'在线';
	}
	
	$sql	=	"select * from k_um where uid=$uid order by id asc"; //取出会员保存的备份记录
	$query	=	$mysqli->query($sql);
	while($row = $query->fetch_array()){
		$is_bf				=	true;
		$bf_um['llje']		=	$row['llje'];
		$bf_um['addtime']	=	$row['addtime'];
		$bf_um[strtotime($row['addtime'])]['other']	=	'单式：'.$row['dsxz'].'=>'.$row['dsyy'].'，串关：'.$row['cgxz'].'=>'.$row['cgyy'].'，返水：'.$row['fs'].'，存款：'.$row['ckje'].'，汇款：'.$row['hkje'].'，取款：'.$row['qkje'];
		
		$bf_um['ckje']		+=	$row['ckje'];
		$bf_um['qkje']		+=	$row['qkje'];
		$bf_um['hkje']		+=	$row['hkje'];
		$bf_um['dsxz']		+=	$row['dsxz'];
		$bf_um['dsyy']		+=	$row['dsyy'];
		$bf_um['cgxz']		+=	$row['cgxz'];
		$bf_um['cgyy']		+=	$row['cgyy'];
		$bf_um['fs']		+=	$row['fs'];
		
		$sj[strtotime($row['addtime'])]['type']	=	'备份'; //备份
	}
	
	$where	=	'';
	if($is_bf) $where	=	" and bet_time>'".$bf_um['addtime']."'";
	
	$sql	=	"select number as bid,bet_time,bet_money,`status`,win,bet_point,ben_add,assets,`update_time`,ball_sort,fs from k_bet where uid='$uid'".$where; //所有单式下注信息
	$query	=	$mysqli->query($sql);
	$ts		=	0;
	$sjc	=	0;
	while($row = $query->fetch_array()){
		$ts		=	0;
		$sjc	=	strtotime($row['bet_time']);
		$updatei=	1;
		if(isset($sj[$sjc]['type'])){
			while(isset($sj[$sjc+$updatei]['type'])){
				$updatei++;
			}
			$sjc	+=	$updatei;
		}
		$sum['ds']['money']	+=	$row['bet_money']; //下注总金额
		$sum['ds']['win']	+=	$row['win']+$row['fs']; //结果总金额+返水
		$ds[$sjc]['money']	=	$row['bet_money']; //下注金额
		$ds[$sjc]['assets']	=	$row['assets']; //下注前金额
		$ds[$sjc]['win']	=	$row['win']; //已赢金额
		$ds[$sjc]['status']	=	$row['status']; //状态
		$ds[$sjc]['other']	=	"编号：<a href='../zdgl/check_zd.php?action=1&id=".$row['bid']."' target='_blank' style='color:#000000;'>".$row['bid']."</a>"; //注单编号
		$ds[$sjc]['pl']		=	$row['bet_point']+$row['ben_add']; //赔率
		$ds[$sjc]['other']	.=	'，赔率：'.($row['bet_point']+$row['ben_add']); //注单编号
		if(in_array($row['status'],array(0,3,6,7,8))){ //未结算，平手，无效没有退水
			if($row['status']==0){
				$ds[$sjc]['other']	.=	'，状态：未结算';
				$wjs++;
			}else{
				$ds[$sjc]['other']	.=	'，状态：<span style="color:#0000FF;">无效</span>';
			}
		}elseif($row['status']==1 || $row['status']==2){ //输赢都退1%
			//$ts		=	$row['bet_money']*0.01;
			$ts		=	0;
			$sjfs	+=	$row['fs'];
			//$llfs	+=	$row['bet_money']*0.01;
			$llfs	+=	0;
			if($row['status']==1){
				$ds[$sjc]['other']	.=	'，状态：<span style="color:#FF0000;">赢</span>';
			}else{
				$ds[$sjc]['other']	.=	'，状态：<span style="color:#00CC00;">输</span>';
			}
		}elseif($row['status']==4 || $row['status']==5){ //输一半，赢一半都退0.5%	
			//$ts		=	double_format($row['bet_money']*0.005);
			$ts		=	0;
			$sjfs	+=	$row['fs'];
			//$llfs	+=	double_format($row['bet_money']*0.005);
			$llfs	+=	0;
			if($row['status']==4){
				$ds[$sjc]['other']	.=	'，状态：<span style="color:#FF0000;">赢一半</span>';
			}else{
				$ds[$sjc]['other']	.=	'，状态：<span style="color:#00CC00;">输一半</span>';
			}
		}
		$ds[$sjc]['ts']		=	$ts;
		$ds[$sjc]['other']	.=	'，注前：'.$row['assets'];
		$sj[$sjc]['type']	=	'单式'; //单式
		if(strlen($row['update_time']) > 6){
			$updatei=	1;
			$gxsj	=	strtotime($row['update_time']);
			if(isset($sj[$gxsj]['type'])){
				while(isset($sj[$gxsj+$updatei]['type'])){
					$updatei++;
				}
				$gxsj	+=	$updatei;
			}
			$sj[$gxsj]['type']	=	'单式结算'; //单式结算
			$sj[$gxsj]['time']	=	$sjc; //单式结算时间
			$sj[$gxsj]['ts']	=	$ts; //单式结算时间
		}
		if(strpos('='.$row['ball_sort'],'足球')){
			$fl[1][1]	+=	$row['bet_money'];
			$fl[1][2]	+=	$row['win'];
		}elseif(strpos('='.$row['ball_sort'],'篮球')){
			$fl[2][1]	+=	$row['bet_money'];
			$fl[2][2]	+=	$row['win'];
		}elseif(strpos('='.$row['ball_sort'],'网球')){
			$fl[3][1]	+=	$row['bet_money'];
			$fl[3][2]	+=	$row['win'];
		}elseif(strpos('='.$row['ball_sort'],'排球')){
			$fl[4][1]	+=	$row['bet_money'];
			$fl[4][2]	+=	$row['win'];
		}elseif(strpos('='.$row['ball_sort'],'棒球')){
			$fl[5][1]	+=	$row['bet_money'];
			$fl[5][2]	+=	$row['win'];
		}else{
			$fl[6][1]	+=	$row['bet_money'];
			$fl[6][2]	+=	$row['win'];
		}
	}
	
	$sql	=	"select bet_time,bet_money,`status`,win,gid,assets,`update_time`,fs from k_bet_cg_group where uid='$uid'".$where; //所有串关下注信息
	$query	=	$mysqli->query($sql);
	while($row = $query->fetch_array()){
		$ts		=	0;
		$sjc	=	strtotime($row['bet_time']);
		$updatei=	1;
		if(isset($sj[$sjc]['type'])){
			while(isset($sj[$sjc+$updatei]['type'])){
				$updatei++;
			}
			$sjc	+=	$updatei;
		}
		$sum['cg']['money']	+=	$row['bet_money']; //下注总金额
		$cg[$sjc]['money']	=	$row['bet_money']; //下注金额
		$cg[$sjc]['assets']	=	$row['assets']; //下注前金额
		$cg[$sjc]['other']	=	"编号：<a href='../zdgl/check_zd.php?action=1&id=".$row['gid']."' target='_blank' style='color:#000000;'>".$row['gid']."</a>"; //注单编号
		if($row['status']==1){ //输赢都退1%
			$sum['cg']['win']	+=	$row['win']+$row['fs']; //结果总金额+返水
			$cg[$sjc]['win']	 =	$row['win']; //已赢金额
			//$ts					 =	$row['bet_money']*0.01;
			$ts					 =	0;
			$sjfs				+=	$row['fs'];
			//$llfs				+=	$row['bet_money']*0.01;
			$llfs				+=	0;
			$cg[$sjc]['other']	.=	'，状态：已结算';
		}else{ //未结算，无效没有退水
			if($row['status']==3){
				$cg[$sjc]['other']	.=	'，状态：<span style="color:#0000FF;">无效</span>';
				$sum['cg']['win']	+=	$row['win']; //结果总金额
				$cg[$sjc]['win']	 =	$row['win']; //已赢金额
			}else{
				$cg[$sjc]['other']	.=	'，状态：未结算';
				$wjs++;
			}
		}
		$cg[$sjc]['ts']		=	$ts;
		$cg[$sjc]['other']	.=	'，注前：'.$row['assets'];
		$sj[$sjc]['type']	=	'串关'; //串关
		if(strlen($row['update_time']) > 6){
			$updatei=	1;
			$gxsj	=	strtotime($row['update_time']);
			if(isset($sj[$gxsj]['type'])){
				while(isset($sj[$gxsj+$updatei]['type'])){
					$updatei++;
				}
				$gxsj	+=	$updatei;
			}
			$sj[$gxsj]['type']	=	'串关结算'; //串关结算
			$sj[$gxsj]['time']	=	$sjc; //串关结算时间
			$sj[$gxsj]['ts']	=	$ts; //串关结算时间
		}
	}
	
	if($is_bf) $where	=	" and m_make_time>'".$bf_um['addtime']."'";
	
	$sql	=	"select m_value,m_make_time,`status`,m_order,update_time,about,assets from k_money where uid='$uid' and `type`=1 ".$where; //所有存款取款
	$query	=	$mysqli->query($sql);
	while($row = $query->fetch_array()){
		$sjc	=	strtotime($row['m_make_time']);
		$updatei=	1;
		if(isset($sj[$sjc]['type'])){
			while(isset($sj[$sjc+$updatei]['type'])){
				$updatei++;
			}
			$sjc	+=	$updatei;
		}
		if($row['m_value'] > 0){
			if($row['status'] == 1){
				$sum['ck']['money']	+=	$row['m_value']; //存款总金额
				$ck[$sjc]['money']	=	$row['m_value']; //存款
				$ck[$sjc]['status']	=	$row['status']; //状态
				$ck[$sjc]['other']	=	$row['m_order'].'，存前：'.$row['assets'].'&nbsp;&nbsp;<span style="color:#FF0000;">'.$row['about'].'</span>';
				$sj[$sjc]['type']	=	'存款'; //存款
			}
		}else{
			if($row['status'] > 0){ //失败的不计
				$sum['qk']['money']	+=	abs($row['m_value']); //取款总金额
			}
			$qk[$sjc]['money']	=	abs($row['m_value']); //取款
			$qk[$sjc]['status']	=	$row['status']; //状态
			$qk[$sjc]['other']	=	$row['m_order'].'，取前：'.$row['assets'].'&nbsp;&nbsp;<span style="color:#FF0000;">'.$row['about'].'</span>';;
			$sj[$sjc]['type']	=	'取款'; //取款
			
			if(strlen($row['update_time']) > 6){
				$updatei=	1;
				$gxsj	=	strtotime($row['update_time']);
				if(isset($sj[$gxsj]['type'])){
					while(isset($sj[$gxsj+$updatei]['type'])){
						$updatei++;
					}
					$gxsj	+=	$updatei;
				}
				$sj[$gxsj]['type']	=	'取款结算'; //单式结算
				$sj[$gxsj]['time']	=	$sjc; //单式结算时间
			}
		}
	}
	
	if($is_bf) $where	=	" and adddate>'".$bf_um['addtime']."'";
	
	$sql	=	"SELECT money,adddate,lsh,zsjr,`status`,assets FROM huikuan where `status`<2 and uid='$uid'".$where; //所有不是失败的汇款记录
	$query	=	$mysqli->query($sql);
	while($row = $query->fetch_array()){
		$sjc	=	strtotime($row['adddate']);
		$updatei=	1;
		if(isset($sj[$sjc]['type'])){
			while(isset($sj[$sjc+$updatei]['type'])){
				$updatei++;
			}
			$sjc	+=	$updatei;
		}
		if($row['status']==1) $sum['hk']['money']	+=	$row['money']; //汇款总金额
		$hk[$sjc]['status']	=	$row['status']; //汇款金额
		$hk[$sjc]['money']	=	$row['money']; //汇款金额
		$hk[$sjc]['zsjr']	=	$row['zsjr']; //赠送金额
		$hk[$sjc]['other']	=	$row['lsh'].'，赠送：'.$row['zsjr'].'，汇前：'.$row['assets'];
		$sj[$sjc]['type']	=	'汇款'; //汇款
	}
}
//ksort($sj);
$arr_k = array();
foreach($sj as $k=>$v){	
	$arr_k[$k] 	= $k;
}
ksort($arr_k);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>核查会员财务信息</title>
<link rel="stylesheet" href="../Images/CssAdmin.css">
</head>

<script   language=javascript>   
function   window.confirm(str){   
	execScript("n   =   msgbox('"+   str   +"',257,'信息提示！')","vbscript"); 
	return(n   ==   1); 
}
</script>
<body>
<form id="form1" name="form1" method="post" action="?action=1" style="margin:0 0 0 0;">
请输入会员名称：
<label>
<input name="username" type="text" id="username" value="<?=$_REQUEST['username']?>" size="20" maxlength="20" />
</label>
&nbsp;&nbsp;&nbsp;&nbsp;
  <label>
  <input type="submit" name="Submit" value="核查" /> 
  </label>
</form>
<?php
if($_GET['action']==1){
?>
<br/>
  <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
    <tr>
      <td width="170" align="center" bgcolor="#CCCCCC"><strong >日期</strong></td>
      <td width="90" align="center" bgcolor="#CCCCCC"><strong>类型</strong></td>
      <td width="100" align="center" bgcolor="#CCCCCC"><strong>金额</strong></td>
      <td width="100" align="center" bgcolor="#CCCCCC"><strong>结果</strong></td>
      <td width="627" align="center" bgcolor="#CCCCCC"><strong>备注</strong></td>
    </tr>
<?php
$um		=	0; //用户应该有的金额
$bak_um	=	0;
if($is_bf) $um = $bf_um['llje'];
foreach($arr_k as $k=>$v){
	if($sj[$k]['type']=='单式'){
		$bgcolor	=	'';
		if(double_format($um) !== double_format($ds[$k]['assets'])){
			if(abs(double_format($um-$bak_um)-double_format($ds[$k]['assets'])) > 1){
				$bak_um		=	double_format($um)-double_format($ds[$k]['assets']);
				$bgcolor	=	'bgcolor="#FF0000"';
			}
		}elseif($ds[$k]['status'] == 1){ //赢
			if(double_format($ds[$k]['money']*$ds[$k]['pl']) !== double_format($ds[$k]['win'])) $bgcolor	=	'#FBA09B';
		}elseif($ds[$k]['status'] == 4){ //赢一半
			if(double_format($ds[$k]['money']*((($ds[$k]['pl']-1)/2)+1)) !== double_format($ds[$k]['win'])) $bgcolor	=	'#FBA09B';
		}elseif($ds[$k]['status'] == 5){ //输一半
			if(double_format($ds[$k]['money']/2) !== double_format($ds[$k]['win'])) $bgcolor	=	'#FBA09B';
		}
		
		$um -= $ds[$k]['money'];
		if($um<0){
			$bgcolor	=	'bgcolor="#FF0000"';
		}
?>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" <?=$bgcolor?>><?=date("Y-m-d H:i:s",$k)?></td>
      <td align="center" <?=$bgcolor?>>单式</td>
      <td align="center" <?=$bgcolor?>><?=$ds[$k]['money']?></td>
      <td align="center" <?=$bgcolor?>>&nbsp;</td>
      <td align="left" <?=$bgcolor?>><?=$ds[$k]['other']?></td>
    </tr>
<?php
	}elseif($sj[$k]['type']=='串关'){
		$bgcolor	=	'';
		if(double_format($um-$bak_um) !== double_format($cg[$k]['assets'])){
			if(abs(double_format($um)-double_format($cg[$k]['assets'])) > 1){
				$bak_um		=	double_format($um)-double_format($ds[$k]['assets']);
				$bgcolor	=	'bgcolor="#FF0000"';
			}
		}
		$um -= $cg[$k]['money'];
		if($um<0){
			$bgcolor	=	'bgcolor="#FF0000"';
		}
?>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" <?=$bgcolor?>><?=date("Y-m-d H:i:s",$k)?></td>
      <td align="center" <?=$bgcolor?>>串关</td>
      <td align="center" <?=$bgcolor?>><?=$cg[$k]['money']?></td>
      <td align="center" <?=$bgcolor?>>&nbsp;</td>
      <td align="left" <?=$bgcolor?>><?=$cg[$k]['other']?></td>
    </tr>
<?php
	}elseif($sj[$k]['type']=='存款'){
		if($ck[$k]['status']==1){
			$um += $ck[$k]['money'];
		}
?>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" ><?=date("Y-m-d H:i:s",$k)?></td>
      <td align="center" ><span style="color:#00CC00;">存款</span></td>
      <td align="center" ><?=$ck[$k]['money']?></td>
      <td align="center" >成功</td>
      <td align="left"><?=$ck[$k]['other']?></td>
    </tr>
<?php
	}elseif($sj[$k]['type']=='取款'){
		$um -= $qk[$k]['money'];
		$bgcolor	=	'';
		if($um<0){
			$bgcolor	=	'bgcolor="#FF0000"';
		}
?>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" <?=$bgcolor?>><?=date("Y-m-d H:i:s",$k)?></td>
      <td align="center" <?=$bgcolor?>><span style="color:#FF0000;">取款</span></td>
      <td align="center" <?=$bgcolor?>><?=$qk[$k]['money']?></td>
      <td align="center" <?=$bgcolor?>><?php if($qk[$k]['status']==1){
	  														echo '成功';
	  												   }elseif($qk[$k]['status']==2){
													   		echo '处理中';
															$wjs++;	
													   }else{
													   		echo '失败';
													   }?></td>
      <td align="left" <?=$bgcolor?>><?=$qk[$k]['other']?></td>
    </tr>
<?php
	}elseif($sj[$k]['type']=='汇款'){
		if($hk[$k]['status']==1){
			$um += $hk[$k]['money']+$hk[$k]['zsjr']; //汇款金额+赠送金额
		}
?>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" ><?=date("Y-m-d H:i:s",$k)?></td>
      <td align="center" ><span style="color:#0000FF;">汇款</span></td>
      <td align="center" ><?=$hk[$k]['money']?></td>
      <td align="center" ><?php if($hk[$k]['status']==1){
	  														echo '成功';
	  												   }else{
													   		echo '处理中';
															$wjs++;	
													   }?></td>
      <td align="left"><?=$hk[$k]['other']?></td>
    </tr>
<?php
	}elseif($sj[$k]['type']=='单式结算'){
		$um	+= $ds[$sj[$k]['time']]['win'];
		$um	+= $ds[$sj[$k]['time']]['ts'];
		?>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" ><?=date("Y-m-d H:i:s",$k)?></td>
      <td align="center" >单式结算</td>
      <td align="center" >&nbsp;</td>
      <td align="center" ><?=double_format($ds[$sj[$k]['time']]['win']+$sj[$k]['ts'])?></td>
      <td align="left" ><?=$ds[$sj[$k]['time']]['other']?></td>
    </tr>
        <?php
	}elseif($sj[$k]['type']=='串关结算'){
		$um	+= $cg[$sj[$k]['time']]['win'];
		$um	+= $cg[$sj[$k]['time']]['ts'];
		?>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" ><?=date("Y-m-d H:i:s",$k)?></td>
      <td align="center" >串关结算</td>
      <td align="center" >&nbsp;</td>
      <td align="center" ><?=double_format($cg[$sj[$k]['time']]['win']+$sj[$k]['ts'])?></td>
      <td align="left" ><?=$cg[$sj[$k]['time']]['other']?></td>
    </tr>
<?php
	}elseif($sj[$k]['type']=='取款结算'){
		if($qk[$sj[$k]['time']]['status']==0){
			$um += $qk[$sj[$k]['time']]['money'];
		}
		$bgcolor	=	'';
		if($um<0){
			$bgcolor	=	'bgcolor="#FF0000"';
		}
		?>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" <?=$bgcolor?>><?=date("Y-m-d H:i:s",$k)?></td>
      <td align="center" <?=$bgcolor?>>取款结算</td>
      <td align="center" <?=$bgcolor?>><?=$qk[$sj[$k]['time']]['money']?></td>
      <td align="center" <?=$bgcolor?>><?php if($qk[$sj[$k]['time']]['status']==1){
	  														echo '成功';
	  												   }elseif($qk[$sj[$k]['time']]['status']==2){
													   		echo '处理中';
															$wjs++;	
													   }else{
													   		echo '失败';
													   }?></td>
      <td align="left" <?=$bgcolor?>><?=$qk[$sj[$k]['time']]['other']?></td>
    </tr>
        <?php
	}elseif($sj[$k]['type']=='备份'){
		?>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" ><?=date("Y-m-d H:i:s",$k)?></td>
      <td align="center" >备份</td>
      <td colspan="3" align="left"><?=$bf_um[$k]['other']?></td>
    </tr>
        <?php
	}
}
?>
</table>
  <br/>
  <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
    <tr>
      <td width="20%" align="center" bgcolor="#CCCCCC"><strong>会员名称</strong></td>
      <td width="10%" align="center" bgcolor="#CCCCCC"><strong>状态</strong></td>
      <td width="10%" align="center" bgcolor="#CCCCCC"><strong>账户金额</strong></td>
      <td width="10%" align="center" bgcolor="#CCCCCC"><strong>理论金额</strong></td>
      <td width="10%" align="center" bgcolor="#CCCCCC"><strong>误差范围</strong></td>
      <td width="10%" align="center" bgcolor="#CCCCCC"><strong>理论返水</strong></td>
      <td width="10%" align="center" bgcolor="#CCCCCC"><strong>实际返水</strong></td>
      <td width="10%" align="center" bgcolor="#CCCCCC"><strong>修复操作</strong></td>
      <td width="10%" align="center" bgcolor="#CCCCCC"><strong>保存操作</strong></td>
    </tr>
	<form id="form2" name="form2" method="post" action="k_um.php?uid=<?=$uid?>&username=<?=$_REQUEST['username']?>" onsubmit="return(confirm('进行了保存操作，则被保存的注单不能再进行其它操作，否则会有误差金额！'))">
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" ><a href="user_show.php?id=<?=$uid?>"><?=$_REQUEST['username']?></a></td>
      <td align="center" ><?=$zt?></td>
      <td align="center" ><?=double_format($money)?></td>
      <td align="center" ><?=double_format($um)?></td>
	  <?php
	  $bg	=	'';
	  $fw	=	abs(double_format($money-$um));
	  if($fw > 0) $bg = '#FF0000';
	  ?>
      <td align="center" bgcolor="<?=$bg?>"><?=$fw?></td>
      <td align="center" ><?=$llfs?></td>
	  <?php
	  $bg	=	'';
	  if(abs(double_format($llfs-$sjfs)) > 0) $bg = '#FF0000';
	  ?>
      <td align="center" bgcolor="<?=$bg?>"><a href="check_userfs.php?username=<?=$_REQUEST['username']?>&action=1" target="_blank" title="核查返水"><?=$sjfs?></a></td>
      <td align="center" ><?php if($fw > 0){?><a href="xf.php?uid=<?=$uid?>&money=<?=double_format($um)?>&username=<?=$_REQUEST['username']?>" onclick="alert('该功能不可用！'); return false;">修复</a><?php }else{?>修复<?php }?></td>
      <td align="center" ><?php if($zt=='在线'){
			echo '会员在线';
		 }elseif($wjs<1){
		 	echo '<input type="submit" name="Submit2" value="保存" />';
		 }else{
		 	echo $wjs.' 条信息';
		 }?><input name="hf_llje" type="hidden" id="hf_llje"  value="<?=double_format($um)?>"/>
      <input name="hf_dsxz" type="hidden" id="hf_dsxz"  value="<?=double_format($sum['ds']['money'])?>"/>
      <input name="hf_dsyy" type="hidden" id="hf_dsyy"  value="<?=double_format($sum['ds']['win'])?>"/>
      <input name="hf_cgxz" type="hidden" id="hf_cgxz"  value="<?=double_format($sum['cg']['money'])?>"/>
      <input name="hf_cgyy" type="hidden" id="hf_cgyy"  value="<?=double_format($sum['cg']['win'])?>"/>
      <input name="hf_ckje" type="hidden" id="hf_ckje"  value="<?=double_format($sum['ck']['money'])?>"/>
      <input name="hf_hkje" type="hidden" id="hf_hkje"  value="<?=double_format($sum['hk']['money'])?>"/>
      <input name="hf_qkje" type="hidden" id="hf_qkje"  value="<?=double_format($sum['qk']['money'])?>"/>
      <input name="hf_fs" type="hidden" id="hf_fs"  value="<?=double_format($sjfs)?>"/></td>
    </tr>
    </form>
</table>
  <br/>
  <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
    <tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF"><strong>单式分析</strong></td>
      <td colspan="2" align="center" bgcolor="#FFFFFF"><strong>串关分析</strong></td>
      <td align="center" bgcolor="#FFFFFF" width="12%"><strong>返水分析</strong></td>
      <td colspan="3" align="center" bgcolor="#FFFFFF"><strong>存款/汇款/取款</strong></td>
    </tr>
    <tr>
      <td width="12%" align="center" bgcolor="#CCCCCC">下注金额</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">已赢金额</td>
      <td width="12%" align="center" bgcolor="#CCCCCC">下注金额</td>
      <td width="12%" align="center" bgcolor="#CCCCCC">已赢金额</td>
      <td width="12%" align="center" bgcolor="#CCCCCC">当前返水</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">存款金额</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">汇款金额</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">取款金额</td>
    </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" ><?=double_format($sum['ds']['money'])?></td>
      <td align="center" ><?=double_format($sum['ds']['win'])?></td>
      <td align="center" ><?=double_format($sum['cg']['money'])?></td>
      <td align="center" ><?=double_format($sum['cg']['win'])?></td>
      <td align="center" ><?=double_format($sjfs)?></td>
      <td align="center" ><?=double_format($sum['ck']['money'])?></td>
      <td align="center"><?=double_format($sum['hk']['money'])?></td>
      <td align="center" ><?=double_format($sum['qk']['money'])?></td>
    </tr>
<?php
if($is_bf){
?>
    <tr>
      <td width="12%" align="center" bgcolor="#CCCCCC">保存下注</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">保存已赢</td>
      <td width="12%" align="center" bgcolor="#CCCCCC">保存下注</td>
      <td width="12%" align="center" bgcolor="#CCCCCC">保存已赢</td>
      <td width="12%" align="center" bgcolor="#CCCCCC">保存返水</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">保存存款</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">保存汇款</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">保存取款</td>
    </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" ><?=double_format($bf_um['dsxz'])?></td>
      <td align="center"><?=double_format($bf_um['dsyy'])?></td>
      <td align="center" ><?=double_format($bf_um['cgxz'])?></td>
      <td align="center" ><?=double_format($bf_um['cgyy'])?></td>
      <td align="center" ><?=double_format($bf_um['fs'])?></td>
      <td align="center" ><?=double_format($bf_um['ckje'])?></td>
      <td align="center" ><?=double_format($bf_um['hkje'])?></td>
      <td align="center" ><?=double_format($bf_um['qkje'])?></td>
    </tr>
    <tr>
      <td width="12%" align="center" bgcolor="#CCCCCC">总下注</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">总已赢</td>
      <td width="12%" align="center" bgcolor="#CCCCCC">总下注</td>
      <td width="12%" align="center" bgcolor="#CCCCCC">总已赢</td>
      <td width="12%" align="center" bgcolor="#CCCCCC">总共返水</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">总存款</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">总汇款</td>
      <td width="13%" align="center" bgcolor="#CCCCCC">总取款</td>
    </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" ><?=double_format($sum['ds']['money']+$bf_um['dsxz'])?></td>
      <td align="center" ><?=double_format($sum['ds']['win']+$bf_um['dsyy'])?></td>
      <td align="center" ><?=double_format($sum['cg']['money']+$bf_um['cgxz'])?></td>
      <td align="center" ><?=double_format($sum['cg']['win']+$bf_um['cgyy'])?></td>
      <td align="center" ><?=double_format($sjfs+$bf_um['fs'])?></td>
      <td align="center" ><?=double_format($sum['ck']['money']+$bf_um['ckje'])?></td>
      <td align="center" ><?=double_format($sum['hk']['money']+$bf_um['hkje'])?></td>
      <td align="center" ><?=double_format($sum['qk']['money']+$bf_um['qkje'])?></td>
    </tr>
<?php
}
?>
</table>
<br/>
  <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">

    <tr>
      <td width="15%" align="center" bgcolor="#CCCCCC"><strong>足球交易</strong><strong>=&gt;已赢</strong></td>
      <td width="15%" align="center" bgcolor="#CCCCCC"><strong>篮球交易=&gt;</strong><strong>交易</strong></td>
      <td width="15%" align="center" bgcolor="#CCCCCC"><strong>网球交易</strong><strong>=&gt;已赢</strong></td>
      <td width="15%" align="center" bgcolor="#CCCCCC"><strong>排球交易=&gt;已赢</strong></td>
      <td width="15%" align="center" bgcolor="#CCCCCC"><strong>棒球交易=&gt;已赢</strong></td>
      <td width="25%" align="center" bgcolor="#CCCCCC"><strong>金融冠军=&gt;已赢</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
      <td align="center" ><?=$fl[1][1]?>=><?=$fl[1][2]?></td>
      <td align="center" ><?=$fl[2][1]?>=><?=$fl[2][2]?></td>
      <td align="center" ><?=$fl[3][1]?>=><?=$fl[3][2]?></td>
      <td align="center" ><?=$fl[4][1]?>=><?=$fl[4][2]?></td>
      <td align="center" ><?=$fl[5][1]?>=><?=$fl[5][2]?></td>
      <td align="center" ><?=$fl[6][1]?>=><?=$fl[6][2]?></td>
    </tr>
</table>
  <br/>
  <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
 <form id="form3" name="form3" method="post" action="save_why.php?action=save" onsubmit="return confirm('确定保存会员备注信息?')">
    <tr>
      <td width="15%" align="right" valign="middle" bgcolor="#FFFFFF">会员备注信息：</td>
      <td width="85%" bgcolor="#FFFFFF"><textarea name="why" cols="100" rows="5" id="why"><?=$why?></textarea>
      <input name="hf_username" type="hidden" id="hf_username" value="<?=$_REQUEST['username']?>" />
      <input name="hf_uid" type="hidden" id="hf_uid" value="<?=$uid?>" /></td>
    </tr>
    <tr>
      <td height="30" align="right" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit2" value="保存" /></td>
    </tr>
      </form>
  </table>
    <?php
}
?>
</body>
</html>