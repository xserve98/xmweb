<?php
/**
* 取出代理额度
* uid 代理编号
* xjuid 该代理的下级会员编号
* s 指定开始时间
* e 指定结束时间
**/
function getDLED($uid,$s,$e){

	global $mysqli;
	$yk				=	0; //默认代理额度为 0
	$xjuid			=	'';
	$sql			=	"select uid from k_user where top_uid=$uid and reg_date<='$e' order by uid desc"; //取出该代理所有下级会员
	$query			=	$mysqli->query($sql);
	while($row		=	$query->fetch_array()) $xjuid	.=	$row['uid'].',';
	if($xjuid){
		$xjuid		=	rtrim($xjuid,',');
		$sql		=	"select m_value,about,sxf from k_money where `status`=1 and `type`=1 and m_make_time>='$s' and m_make_time<='$e' and uid in(".$xjuid.")"; //本月会员存款取款总额
		$query		=	$mysqli->query($sql);
		while($row	=	$query->fetch_array()){
			if($row['m_value'] > 0){ //存款
				if($row['about'] == '' || $row['about'] == 'The order system is successful' || $row['about'] == '该订单手工操作成功'){ //不是系统赠送金额
					$yk	-=	$row['sxf'];
				}else{
					$yk	-=	$row['m_value'];
				}
			}else{ //取款
				$yk	-=	$row['sxf'];
			}
		}
		//echo $yk."<br><br>";
		$sql		=	"select zsjr from huikuan where `status`=1 and `adddate`>='$s' and `adddate`<='$e' and uid in(".$xjuid.")"; //本月会员汇款总额
		$query		=	$mysqli->query($sql);
		while($row	=	$query->fetch_array()){
			$yk		-=	$row['zsjr'];
		}
		$sql		=	"select bet_money,win,fs from k_bet where `status` in (1,2,4,5) and uid in(".$xjuid.") and match_coverdate>='$s' and  match_coverdate<='$e'"; //单式盈亏,未结算，无效不算
		$query		=	$mysqli->query($sql);
		while($row	=	$query->fetch_array()){
			$yk		+=	$row['bet_money']; //先扣交易金额
			$yk		-=	$row['win']; //再加已赢金额
			$yk		-=	$row['fs']; //再加返水金额
		}
		$sql		=	"select bet_money,win,fs from k_bet_cg_group where `status`=1 and uid in(".$xjuid.") and match_coverdate>='$s' and  match_coverdate<='$e'"; //串关盈亏,已结算才计算
		$query		=	$mysqli->query($sql);
		while($row	=	$query->fetch_array()){
			$yk		+=	$row['bet_money']; //先扣交易金额
			$yk		-=	$row['win']; //再加已赢金额
			$yk		-=	$row['fs']; //再加返水金额
		}
		//echo $e."-".$xjuid."-".$yk."<br>";
	}
	return round($yk,2);
}

/**
* 根据输赢情况获取提成比例值
* shuying 具体输赢金额
**/
function get_point($shuying){ //根据输赢获取提成比例

	if($shuying < 0){
		return 0.3;
    }elseif($shuying == 0){
		return 0;
    }elseif($shuying < 200000){
    	return 0.3;
    }elseif($shuying < 1000000){
    	return 0.4;
    }else{
    	return 0.5;
    }
}
?>