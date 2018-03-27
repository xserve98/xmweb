<?php
/**
* 计算会员各项盈亏
* uid 代理编号
* user 代理名称
* month 计算月份
* daili 指定计算代理还是计算会员盈亏
**/
function calculateGainsAndLosses($uid, $user, $month, $daili=false) {
    global $mysqli;
	global $mysqlit;
	
	$gainsAndLosses = array();
	$gainsAndLosses["ty_y"] = 0;
	$gainsAndLosses["ty_s"] = 0;
	$gainsAndLosses["ty_yx"] = 0;
	$gainsAndLosses["fc_y"] = 0;
	$gainsAndLosses["fc_s"] = 0;
	$gainsAndLosses["lotto"] = 0;
	$gainsAndLosses["cj"] = 0;
	$gainsAndLosses["sxf"] = 0;

	$user="'".$user."'";
	if($daili) {
	    $sql = "select uid,username from k_user where top_uid=".$uid." and is_daili=0 and is_zongdaili=0";
		$uid="";
		$user="";
		$query	=	$mysqli->query($sql);
	    while($row = $query->fetch_array()){
		    if($uid=="") {
		        $uid =	$row['uid'];
				$user = "'".$row['username']."'";
			} else {
			    $uid =	$uid.",".$row['uid'];
				$user = $user.",'".$row['username']."'";
			}
        }
	}
	
	if($uid=="") {
	    return $gainsAndLosses;
	}
	//echo $user;exit;
	
	$sql	=	"select bet_money,win,`status`,match_coverdate,fs,bet_point,point_column from k_bet where `status`>0 and uid in ($uid) and match_coverdate like('".$month."%') and (ball_sort!='重庆时时彩' AND ball_sort!='广东快乐十分' AND ball_sort!='北京PK10' AND ball_sort!='福彩3D' AND ball_sort!='体彩排列三' AND ball_sort!='上海时时乐') order by match_coverdate asc"; //单式
	//echo $sql;exit;
	$query	=	$mysqli->query($sql);
	while($rows	=	$query->fetch_array()){
		$ts		=	$rows['fs'];
		if($rows['status']=="1" || $rows['status']=="4"){ //赢和赢一半都算赢
			$gainsAndLosses["ty_y"]+=$rows['win']-$rows['bet_money']+$ts; //净赢金额不包括本金
			if($rows['status']=="1") {
			    $bet_point = $rows['bet_point'];
				if($rows['point_column']=='match_bhdy' || 
				   $rows['point_column']=='match_bzh' || 
				   $rows['point_column']=='match_bgdy' || 
				   $rows['point_column']=='match_bmdy' || 
				   $rows['point_column']=='match_bzg' || 
				   $rows['point_column']=='match_bzm'
				   ) {
				    $bet_point = $bet_point - 1;
				}
			    if($bet_point>1) {
				    $gainsAndLosses["ty_yx"] += $rows['bet_money'];
					//echo $gainsAndLosses["ty_yx"]."赢大于1".$rows['bet_money']."<br/>";
				} else {
				    $gainsAndLosses["ty_yx"] += $rows['bet_money'] * $rows['bet_point'];
					//echo $gainsAndLosses["ty_yx"]."赢小于1".($rows['bet_money']* $rows['bet_point'])."<br/>";
				}
			}else {
				$gainsAndLosses["ty_yx"] += ($rows['bet_money'] * $rows['bet_point'])/2;
				//echo $gainsAndLosses["ty_yx"]."赢一半".(($rows['bet_money']* $rows['bet_point'])/2)."<br/>";
			}
			
		}elseif($rows['status']=="2" || $rows['status']=="5"){ //输和输一半都算输
			$gainsAndLosses["ty_s"]+=abs($rows['win']-$rows['bet_money']+$ts); //净输金额不包括已赢金额
			if($rows['status']=="2") {
				$gainsAndLosses["ty_yx"] += $rows['bet_money'];
				// $gainsAndLosses["ty_yx"]."输".$rows['bet_money']."<br/>";
			} else {
			    $gainsAndLosses["ty_yx"] += $rows['bet_money']/2;
				//echo $gainsAndLosses["ty_yx"]."输一半".($rows['bet_money']/2)."<br/>";
			}
		}
	}
	
	$sql	=	"select bet_money,win,`status`,match_coverdate,fs from k_bet_cg_group where `status`>0 and uid in ($uid) and match_coverdate like('".$month."%') order by match_coverdate asc"; //串关
	//echo $sql;exit;
	$query	=	$mysqli->query($sql);
	while($rows	=	$query->fetch_array()){
		if($rows['status']=="1"){ //输跟赢
			$ts		=	$rows['fs'];
			if($rows['win']>0){ //赢
				$gainsAndLosses["ty_y"]+=$rows['win']-$rows['bet_money']+$ts; //净赢金额不包括本金
			}else{ //输
				$gainsAndLosses["ty_s"]+=$rows['bet_money']-$ts;
			}
			$gainsAndLosses["ty_yx"] += $rows['bet_money'];
		}
	}
	
	$sql	=	"select bet_money,win,`status`,match_coverdate,fs from k_bet where `status`>0 and uid in ($uid) and match_coverdate like('".$month."%') and (ball_sort='重庆时时彩' or ball_sort='广东快乐十分' or ball_sort='北京PK10' or ball_sort='福彩3D' or ball_sort='体彩排列三' or ball_sort='上海时时乐') order by match_coverdate asc"; //单式
	//echo $sql;exit;
	$query	=	$mysqli->query($sql);
	while($rows	=	$query->fetch_array()){
		$ts		=	$rows['fs'];
		if($rows['status']=="1" || $rows['status']=="4"){ //赢和赢一半都算赢
			$gainsAndLosses["fc_y"]+=$rows['win']-$rows['bet_money']+$ts; //净赢金额不包括本金
		}elseif($rows['status']=="2" || $rows['status']=="5"){ //输和输一半都算输
			$gainsAndLosses["fc_s"]+=abs($rows['win']-$rows['bet_money']+$ts); //净输金额不包括已赢金额
		}
	}
	
	$sql	=	"select ka_tan.*,ka_kithe.nd,ka_kithe.nn from ka_tan,ka_kithe where ka_tan.kithe=ka_kithe.nn and ka_kithe.na<>0 and ka_kithe.lx=1 and ka_kithe.nd like('".$month."%')  and ka_tan.username in (".$user.") order by `id` asc"; //汇款，只显示成功和处理中的
	//echo $sql;exit;
	$query	=	$mysqlit->query($sql);
	while($rows	=	$query->fetch_array()){
		if($rows['bm']==1){		//会员中奖
			$z_user=($rows['sum_m']*$rows['rate']-$rows['sum_m']);
			$z_user+=$rows['sum_m']*abs($rows['user_ds'])/100;
		}elseif($rs['bm']==0){					//未中奖退水
			$z_user=-($rows['sum_m']-($rows['sum_m']*abs($rows['user_ds'])/100));
		}
		$gainsAndLosses["lotto"]+=$z_user;
	}
	
	$sql	=	"select m_value,uid,about,sxf,type,jiesuan_type from k_money where `status`=1 and m_make_time like('".$month."%') and uid in(".$uid.")"; //本月会员存款取款总额
	$query	=	$mysqli->query($sql);
	while($row = $query->fetch_array()){
		if($row['m_value'] > 0){ //存款
			if(intval($row['jiesuan_type']) == 1){ //正常存款
				$gainsAndLosses["sxf"]	-=	$row['sxf'];
			}else if(intval($row['jiesuan_type']) == 2){//彩金类型
				$gainsAndLosses["cj"]	-=	$row['m_value'];
			}
		}else{ 
			$gainsAndLosses["sxf"]	-=	$row['sxf'];
		}
	}
	
	$gainsAndLosses["yk"] = 0 - ($gainsAndLosses["ty_y"] - $gainsAndLosses["ty_s"] + $gainsAndLosses["fc_y"] - $gainsAndLosses["fc_s"] + $gainsAndLosses["lotto"] - $gainsAndLosses["sxf"] - $gainsAndLosses["cj"]);
	
	return $gainsAndLosses;
}
?>