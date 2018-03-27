<?php
session_start();
if(!isset($_SESSION["uid"]) || !isset($_SESSION["username"])) {
    echo json_encode(array('code' => -1));
    exit;
}

include ("../../include/config.php");
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");
include ("../include/ball_name.php");
include ("../include/order_info.php");

$uid = $_SESSION["uid"];
$sql="select * from k_send_back where uid='$uid' and k_type =". $_REQUEST['type'];			
	$query	 =	$mysqli->query($sql);
	$xerows =	$query->fetch_array();

$cp_zd = $xerows['k_d_limit'];
$cp_zg = $xerows['k_e_limit'];

if($cp_zd <= 0) {
    $cp_zd = 1;
}
if($cp_zg <= 0) {
    $cp_zg = 1000000;
}

$sql="select *  from k_user where uid='$uid' limit 1";			
$query	 =	$mysqli->query($sql);
$prows =	$query->fetch_array();
$user=$prows;
$pankou = $prows["pankou"];
$username = $_SESSION["username"];

//清空所有POST数据为空的表单
$datas = array_filter($_POST);
$qh = $datas['qi_num'];
unset($datas['qi_num']);
//获取清空后的POST键名
$names = array_keys($datas);

$fs=0;
$did=date("YmdHis");
//快乐8
if ($_REQUEST['type'] == 1 || $_REQUEST['type'] == 30 || $_REQUEST['type'] == 18) {
	$game_name = get_gameName($_REQUEST['type']);
	//获取期数
	if($_REQUEST['type'] == 30) {
        $qishu = lottery_qishu_30($_REQUEST['type']);
		
    } else if($_REQUEST['type'] == 18){
        $qishu = lottery_qishu_18($_REQUEST['type']);
	
    }else{
	$qishu = lotteryk8_qishu($_REQUEST['type']);
		}
    if($qishu == -1 || $qh != $qishu) {
        echo json_encode(array('code' => 2, 'info' => '已经封盘，禁止下注！'));
        exit;
	}
	
	
	
			//选二~选五检查
	$names_s = array();
	for($ii = 0; $ii < count($names); $ii++) {
		$qiu = explode("_", $names[$ii]);
			$names_s[] = $names[$ii];
	}
	
		$qiu = explode("_", $names_s[0]);
	
		
	
	//判断会员账户额度是否大于总投注额度
	$allmoney = 0;
	for ($i = 0; $i < count($datas); $i++) {
		$allmoney += $datas[''.$names[$i].''];
	}
	

		
		if($qiu[1]==1||$qiu[1]==6||$qiu[1]==7||$qiu[1]==8){
	for ($i = 0; $i < count($datas); $i++) {
		if ($names[$i] != 'autoInput') {
          if (abs($datas[''.$names[$i].'']) < $cp_zd) {
                echo json_encode(array('code' => 1, 'info' => '最低下注金额：' . $cp_zd . '元！'));
                exit;
		    } else if (abs($datas[''.$names[$i].'']) > $cp_zg) {
                echo json_encode(array('code' => 1, 'info' => '最高下注金额：' . $cp_zg . '元！'));
                exit;
		    }
		}
	}
	
		}else{		
			$money = $datas['ball_xx'];
			
			 if ($money < $cp_zd) {
                echo json_encode(array('code' => 1, 'info' => '最低下注金额：' . $cp_zd . '元！'));
                exit;
		    } else if ($money > $cp_zg) {
                echo json_encode(array('code' => 1, 'info' => '最高下注金额：' . $cp_zg . '元！'));
                exit;
		    }
			
			}
	
	
	
	$edu = $user['money'];
	if($edu < $allmoney) {
        echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
		exit;
	}
		

    $tz_list = array();
    $count = 0;

	//选二~选五检查
	$names_s = array();
	for($ii = 0; $ii < count($names); $ii++) {
		$qiu = explode("_", $names[$ii]);
		if($qiu[1] > 1  && $qiu[1] < 6)
			$names_s[] = $names[$ii];
	}
	$sql	=  "insert into c_bet(did,uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,bet_date,fs,k_type,k_wftype) values";
	if(count($names_s) > 0) {
		$qiu = explode("_", $names_s[0]);
		if($qiu[1] == 2 && count($names_s) != 2) {
            echo json_encode(array('code' => 1, 'info' => '【选二】请选择二个号码！'));
            exit;
		} else if($qiu[1] == 3 && count($names_s) != 3) {
            echo json_encode(array('code' => 1, 'info' => '【选三】请选择三个号码！'));
			exit;		
		} else if($qiu[1] == 4 && count($names_s) != 4) {
            echo json_encode(array('code' => 1, 'info' => '【选四】请选择四个号码！'));
			exit;
		} else if($qiu[1] == 5 && count($names_s) != 5) {
            echo json_encode(array('code' => 1, 'info' => '【选五】请选择五个号码！'));
			exit;
		}
		//开始下注
		//分割键名，取ball_后的数字，来判断属于第几球
		$qiuhao = $ball_name['qiu_'.$qiu[1]];
		if( $qiu[1] == 2 ){
			$n1 =  str_replace("2_","",$names_s[0]);
			$n2 =  str_replace("2_","",$names_s[1]);
			$wanfa	= $ball_name[$n1].",".$ball_name[$n2];
		}else if( $qiu[1] == 3 ){
			$n1 =  str_replace("3_","",$names_s[0]);
			$n2 =  str_replace("3_","",$names_s[1]);
			$n3 =  str_replace("3_","",$names_s[2]);
			$wanfa	= $ball_name[$n1].",".$ball_name[$n2].",".$ball_name[$n3];
		}else if( $qiu[1] == 4 ){
			$n1 =  str_replace("4_","",$names_s[0]);
			$n2 =  str_replace("4_","",$names_s[1]);
			$n3 =  str_replace("4_","",$names_s[2]);
			$n4 =  str_replace("4_","",$names_s[3]);
			$wanfa	= $ball_name[$n1].",".$ball_name[$n2].",".$ball_name[$n3].",".$ball_name[$n4];
		}else if( $qiu[1] == 5 ){
			$n1 =  str_replace("5_","",$names_s[0]);
			$n2 =  str_replace("5_","",$names_s[1]);
			$n3 =  str_replace("5_","",$names_s[2]);
			$n4 =  str_replace("5_","",$names_s[3]);
			$n5 =  str_replace("5_","",$names_s[4]);
			$wanfa	= $ball_name[$n1].",".$ball_name[$n2].",".$ball_name[$n3].",".$ball_name[$n4].",".$ball_name[$n5];
		}
		$money = $datas['ball_xx'];

		//获取赔率
		$odds = lottery_odds($_GET['type'],'ball_'.$qiu[1],1);    
      $sql.=	"($did,".$uid.",'".$username."','".$l_time."','$game_name',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",'".$l_date."',$fs,'".$_REQUEST['type']."','0'),";
	
	     $tz_list[] = array(
                'orderId' => $did,
                'type'    => $qiuhao,
                'wanfa'   => $wanfa,
                'odds'    => $odds,
                'money'   => $money,
                'win'     => round($money * $odds, 2)
            );
	$count=1;
	$sql = substr($sql,0,strlen($sql)-1);
	$sqlmoney	=	"update k_user set money=money-$allmoney where username='".$username."' limit 1";
	/////处理投注资金变动////
	$money_type	= 100;	
	$about	=	$game_name."投注";
	$order	=	$username."_".$about."_".date("YmdHis");
	$money2=0-$money;
	$assets	 =	$user['money'];
	$assets2=$assets-$allmoney;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始

	try{
		$mysqli->query($sqlmoney);
		$q1		=	$mysqli->affected_rows;
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
	    $mysqli->query($sql_money);
		$q3		=	$mysqli->affected_rows;
		
	
		if($q1 == 1&&$q2==1&&$q3==1){
			$mysqli->commit(); //事务提交
			
		}else{
			$mysqli->rollback(); //数据回	
		echo json_encode(array('code' => 2, 'info' => '投注失败，请稍后重试！'));
		exit;
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	echo json_encode(array('code' => 2, 'info' => '投注失败，请稍后重试！'));
	exit;
	}	
	  
	
	$mysqli->autocommit(TRUE);
   //////////////////代理反水///////////////
				 $parents =$user['parents'];
				 $parr=explode(',', $parents);
				 $len =count($parr);
				for ($ik = 0; $ik<$len;$ik++){
			/// $fdmoney= $money*$fandian/100;
 	///////////////////////代理反水资金变动记录//////	
    $fdmoney_type	= 200;		$fdabout	=	$game_name."投注返点";
	$fdorder	=	$username."_".$about."_".date("YmdHis");
	///////取得当前代理级别的返点率/////
	$fdsql1="select * from k_send_back where uid='{$parr[$ik]}' and k_type =". $_REQUEST['type'];
				
	$query	 =	$mysqli->query($fdsql1);
	$fdrows	 =	$query->fetch_array();
	$fdlv1	 =	$fdrows['k_'.strtolower($pankou).'_limit'];
	$sjmsql1 ="select money from k_user where uid='{$parr[$ik]}'" ;
				
	$query	 =	$mysqli->query($sjmsql1);
	$sjmrows	 =	$query->fetch_array();
	//$sjmoney	 =	$sjmrows['money'];				
			
	/////////取得下级代理级别的返点率////////////
	$fdsql2="select * from k_send_back where uid='{$parr[$ik+1]}' and k_type =". $_REQUEST['type'];
				
	$query	 =	$mysqli->query($fdsql2);
	$fdrows2	 =	$query->fetch_array();
	$fdlv2	 =	$fdrows2['k_'.strtolower($pankou).'_limit'];
	$sjmsql2 ="select money from k_user where uid='{$parr[$ik+1]}'" ;
					
	$query	 =	$mysqli->query($sjmsql2);
	$sjmrows2	 =	$query->fetch_array();
	$sjmoney2	 =	$sjmrows2['money'];				
						
	if($ik==($len-1)){
	$fd= $fdlv1; 
	$sjmoney=$assets2;
	}else{
	$fd= $fdlv1 -$fdlv2; 
	$sjmoney	 =	$sjmrows['money'];		
		}
				
	$fdmoney=$allmoney*$fd/100;
	$fdassets2=$sjmoney+$fdmoney;
	
	if($fdmoney>0){
    $sqlfd_money	="insert into k_money(uid,xjuid,m_value,status,m_order,about,assets,balance,type) values (".$parr[$ik].",'$uid',".$fdmoney.",1,'$fdorder','$fdabout','$sjmoney','$fdassets2',".$fdmoney_type.")";		
	$mysqli->query($sqlfd_money)  or die ('返点失败');	

////////////////////////////////////////////		
     $sql	=	"update k_user set money=money+$fdmoney where uid='".$parr[$ik]."'    limit 1";
	 $mysqli->query($sql) or die ('返点失败');	
                         }
				}
				
				
		$result = array(
    'code' => 0,
    'username' => $_SESSION["username"],
    'balance' => $edu,
    'qishu' => $qishu,
    'tz_sum' => $count,
    'money_all' => $allmoney,
    'tz_list' => $tz_list
);
echo json_encode($result);
exit;		
	
	}
	
		   
	//选二~选五下注结束
	
	for ($i = 0; $i < count($datas); $i++) {
		//分割键名，取ball_后的数字，来判断属于第几球
		$qiu = explode("_", $names[$i]);
		if(($qiu[1] > 1 && $qiu[1] < 6) || $qiu[1] == "xx") continue; //选二~选五检查跳过
		$qiuhao = $ball_name['qiu_'.$qiu[1]];
		if( $qiu[1] == 6 ){
			$wanfa	= $ball_name_zh['ball_'.$qiu[2].''];
		}else if( $qiu[1] == 7 ){
			$wanfa	= $ball_name_s['ball_'.$qiu[2].''];
		}else if( $qiu[1] == 8 ){
			$wanfa	= $ball_name_f['ball_'.$qiu[2].''];
		}else{
			$wanfa	= $ball_name['ball_'.$qiu[2].''];
		}
		$money	= $datas[''.$names[$i].''];

		//获取赔率
		if($qiu[1] == 1) { //选一
			$odds	= lottery_odds($_GET['type'],'ball_'.$qiu[1],1);
		} else {
			$odds	= lottery_odds($_GET['type'],'ball_'.$qiu[1],$qiu[2]);
		}

		
		    $sql	.=	"($did,".$uid.",'".$username."','".$l_time."','$game_name',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",'".$l_date."',$fs,'".$_REQUEST['type']."','0'),";
	
	     $tz_list[] = array(
                'orderId' => $did,
                'type'    => $qiuhao,
                'wanfa'   => $wanfa,
                'odds'    => $odds,
                'money'   => $money,
                'win'     => round($money * $odds, 2)
            );
		
		$count++;
	}
		
	$sql = substr($sql,0,strlen($sql)-1);
	$sqlmoney	=	"update k_user set money=money-$allmoney where username='".$username."' limit 1";
	/////处理投注资金变动////
	$money_type	= 100;	
	$about	=	$game_name."投注";
	$order	=	$username."_".$about."_".date("YmdHis");
	$money2=0-$allmoney;
	$assets	 =	$user['money'];
	$assets2=$assets-$allmoney;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sqlmoney);
		$q1		=	$mysqli->affected_rows;
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
	    $mysqli->query($sql_money);
		$q3		=	$mysqli->affected_rows;
		
		if($q1 == 1&&$q2>0&&$q3==1){
			$mysqli->commit(); //事务提交
		}else{
			$mysqli->rollback(); //数据回	
		echo json_encode(array('code' => 2, 'info' => '投注失败，请稍后重试！'));
		exit;
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	echo json_encode(array('code' => 2, 'info' => '投注失败，请稍后重试！'));
		exit;
	}	
	  
	
	$mysqli->autocommit(TRUE);
   //////////////////代理反水///////////////

				 $parents =$user['parents'];
				 $parr=explode(',', $parents);
				 $len =count($parr);
				for ($ik = 0; $ik<$len;$ik++){
			/// $fdmoney= $money*$fandian/100;
 	///////////////////////代理反水资金变动记录//////	
    $fdmoney_type	= 200;		$fdabout	=	$game_name."投注返点";
	$fdorder	=	$username."_".$about."_".date("YmdHis");
	///////取得当前代理级别的返点率/////
	$fdsql1="select * from k_send_back where uid='{$parr[$ik]}' and k_type =". $_REQUEST['type'];
				
	$query	 =	$mysqli->query($fdsql1);
	$fdrows	 =	$query->fetch_array();
	$fdlv1	 =	$fdrows['k_'.strtolower($pankou).'_limit'];
	$sjmsql1 ="select money from k_user where uid='{$parr[$ik]}'" ;
				
	$query	 =	$mysqli->query($sjmsql1);
	$sjmrows	 =	$query->fetch_array();
	//$sjmoney	 =	$sjmrows['money'];				
			
	/////////取得下级代理级别的返点率////////////
	$fdsql2="select * from k_send_back where uid='{$parr[$ik+1]}' and k_type =". $_REQUEST['type'];
				
	$query	 =	$mysqli->query($fdsql2);
	$fdrows2	 =	$query->fetch_array();
	$fdlv2	 =	$fdrows2['k_'.strtolower($pankou).'_limit'];
	$sjmsql2 ="select money from k_user where uid='{$parr[$ik+1]}'" ;
					
	$query	 =	$mysqli->query($sjmsql2);
	$sjmrows2	 =	$query->fetch_array();
	$sjmoney2	 =	$sjmrows2['money'];				
						
	if($ik==($len-1)){
	$fd= $fdlv1; 
	$sjmoney=$assets2;
	}else{
	$fd= $fdlv1 -$fdlv2; 
	$sjmoney	 =	$sjmrows['money'];		
		}
				
	$fdmoney=$allmoney*$fd/100;
	$fdassets2=$sjmoney+$fdmoney;
	
	if($fdmoney>0){
    $sqlfd_money	="insert into k_money(uid,xjuid,m_value,status,m_order,about,assets,balance,type) values (".$parr[$ik].",'$uid',".$fdmoney.",1,'$fdorder','$fdabout','$sjmoney','$fdassets2',".$fdmoney_type.")";		
	$mysqli->query($sqlfd_money)  or die ('返点失败');	

////////////////////////////////////////////		
     $sql	=	"update k_user set money=money+$fdmoney where uid='".$parr[$ik]."'    limit 1";
	 $mysqli->query($sql) or die ('返点失败');	
                         }
				}
		   
    
       
	  
	//}
    $result = array(
        'code' => 0,
        'username' => $_SESSION["username"],
        'balance' => $edu-$allmoney,
        'qishu' => $qishu,
        'tz_sum' => $count,
        'money_all' => $allmoney,
        'tz_list' => $tz_list
    );
    echo json_encode($result);
	exit;
	
	
}  elseif ($_REQUEST['type'] == 2 || $_REQUEST['type'] == 20||$_REQUEST['type'] == 21||$_REQUEST['type'] == 7 || $_REQUEST['type'] == 14 || $_REQUEST['type'] == 27 || $_REQUEST['type']== 35 || $_REQUEST['type']== 15) { //重庆时时彩





	$game_name = get_gameName($_REQUEST['type']);
	//获取期数
	
	
	if($_REQUEST['type'] == 21){
		$qishu	= lottery_qishu21($_REQUEST['type']);
		
		} else if($_REQUEST['type'] == 27){
        $qishu = lottery_qishu_27($_REQUEST['type']);

		} else if($_REQUEST['type'] == 35){
        $qishu = lottery_qishu_35($_REQUEST['type']);

		}else{
			
	    $qishu	= lottery_qishu($_REQUEST['type']);
			}

    if($qishu == -1 || $qh != $qishu) {
        echo json_encode(array('code' => 2, 'info' => '已经封盘，禁止下注！'));
        exit;
	}


	$allmoney = 0;
	for ($i = 0; $i < count($datas); $i++) {
		if ($names[$i] != 'autoInput') {
		    $allmoney += abs($datas[''.$names[$i].'']);
            if(abs($datas[''.$names[$i].'']) == 0) {
                echo json_encode(array('code' => 1, 'info' => '投注金额非法！'));
                exit;
            } else if (abs($datas[''.$names[$i].'']) < $cp_zd) {
                echo json_encode(array('code' => 1, 'info' => '最低下注金额：' . $cp_zd . '元！'));
                exit;
		    } else if (abs($datas[''.$names[$i].'']) > $cp_zg) {
                echo json_encode(array('code' => 1, 'info' => '最高下注金额：' . $cp_zg . '元！'));
                exit;
		    }
		}
	}
	$edu = $user['money'];
	if($edu < $allmoney) {
        echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
		exit;
	}
    $sql	=	"insert into c_bet(did,uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,bet_date,fs,k_type,k_wftype) values";
    $tz_list = array();
    $count = 0;
	for ($i = 0; $i < count($datas); $i++) {
		//分割键名，取ball_后的数字，来判断属于第几球
		if ($names[$i] != 'autoInput') {
            $qiu = explode("_", $names[$i]);
            $qiuhao = $ball_name['qiu_' . $qiu[1]];
            if($qiu[1] == 6) {
                $wanfa	= $ball_name_zh['ball_' . $qiu[2] . ''];
            }else if($qiu[1] == 7 || $qiu[1] == 8 || $qiu[1] == 9) {
                $wanfa	= $ball_name_s['ball_' . $qiu[2] . ''];
            }else if($qiu[1] == 10) {
                $wanfa	= $ball_name_s['nball_' . $qiu[2] . ''];
            }else if($qiu[1] == 11) {
                $wanfa	= $ball_name_s['shball_' . $qiu[2] . ''];
            } else {
                $wanfa	= $ball_name['ball_' . $qiu[2] . ''];
            }
            $money	= $datas['' . $names[$i] . ''];
			
        $did=date("YmdHis");

            //获取赔率
            $odds	= lottery_odds($_REQUEST['type'],'ball_'.$qiu[1],$qiu[2]);
    $sql	.=	"($did,".$uid.",'".$username."','".$l_time."','$game_name',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",'".$l_date."',$fs,'".$_REQUEST['type']."','0'),";
	
	     $tz_list[] = array(
                'orderId' => $did,
                'type'    => $qiuhao,
                'wanfa'   => $wanfa,
                'odds'    => $odds,
                'money'   => $money,
                'win'     => round($money * $odds, 2)
            );
        }
		$count++;
	}
	$sql = substr($sql,0,strlen($sql)-1);
	$sqlmoney	=	"update k_user set money=money-$allmoney where username='".$username."' limit 1";
	/////处理投注资金变动////
	$money_type	= 100;	
	$about	=	$game_name."投注";
	$order	=	$username."_".$about."_".date("YmdHis");
	$money2=0-$allmoney;
	$assets	 =	$user['money'];
	$assets2=$assets-$allmoney;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sqlmoney);
		$q1		=	$mysqli->affected_rows;
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
	    $mysqli->query($sql_money);
		$q3		=	$mysqli->affected_rows;
		
		if($q1 == 1&&$q2>0&&$q3==1){
			$mysqli->commit(); //事务提交
		}else{
			$mysqli->rollback(); //数据回	
		echo json_encode(array('code' => 2, 'info' => '投注失败，请稍后重试！'));
		exit;
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	echo json_encode(array('code' => 2, 'info' => '投注失败，请稍后重试！'));
		exit;
	}	
	  
	
	$mysqli->autocommit(TRUE);
   //////////////////代理反水///////////////

				 $parents =$user['parents'];
				 $parr=explode(',', $parents);
				 $len =count($parr);
				for ($ik = 0; $ik<$len;$ik++){
			/// $fdmoney= $money*$fandian/100;
 	///////////////////////代理反水资金变动记录//////	
    $fdmoney_type	= 200;		$fdabout	=	$game_name."投注返点";
	$fdorder	=	$username."_".$about."_".date("YmdHis");
	///////取得当前代理级别的返点率/////
	$fdsql1="select * from k_send_back where uid='{$parr[$ik]}' and k_type =". $_REQUEST['type'];
				
	$query	 =	$mysqli->query($fdsql1);
	$fdrows	 =	$query->fetch_array();
	$fdlv1	 =	$fdrows['k_'.strtolower($pankou).'_limit'];
	$sjmsql1 ="select money from k_user where uid='{$parr[$ik]}'" ;
				
	$query	 =	$mysqli->query($sjmsql1);
	$sjmrows	 =	$query->fetch_array();
	//$sjmoney	 =	$sjmrows['money'];				
			
	/////////取得下级代理级别的返点率////////////
	$fdsql2="select * from k_send_back where uid='{$parr[$ik+1]}' and k_type =". $_REQUEST['type'];
				
	$query	 =	$mysqli->query($fdsql2);
	$fdrows2	 =	$query->fetch_array();
	$fdlv2	 =	$fdrows2['k_'.strtolower($pankou).'_limit'];
	$sjmsql2 ="select money from k_user where uid='{$parr[$ik+1]}'" ;
					
	$query	 =	$mysqli->query($sjmsql2);
	$sjmrows2	 =	$query->fetch_array();
	$sjmoney2	 =	$sjmrows2['money'];				
						
	if($ik==($len-1)){
	$fd= $fdlv1; 
	$sjmoney=$assets2;
	}else{
	$fd= $fdlv1 -$fdlv2; 
	$sjmoney	 =	$sjmrows['money'];		
		}
				
	$fdmoney=$allmoney*$fd/100;
	$fdassets2=$sjmoney+$fdmoney;
	
	if($fdmoney>0){
    $sqlfd_money	="insert into k_money(uid,xjuid,m_value,status,m_order,about,assets,balance,type) values (".$parr[$ik].",'$uid',".$fdmoney.",1,'$fdorder','$fdabout','$sjmoney','$fdassets2',".$fdmoney_type.")";		
	$mysqli->query($sqlfd_money)  or die ('返点失败');	

////////////////////////////////////////////		
     $sql	=	"update k_user set money=money+$fdmoney where uid='".$parr[$ik]."'    limit 1";
	 $mysqli->query($sql) or die ('返点失败');	
                         }
				}
		   
    
       
	  
	//}
    $result = array(
        'code' => 0,
        'username' => $_SESSION["username"],
        'balance' => $edu-$allmoney,
        'qishu' => $qishu,
        'tz_sum' => $count,
        'money_all' => $allmoney,
        'tz_list' => $tz_list
    );
    echo json_encode($result);
	exit;
	
	
 }elseif ($_GET['type'] == 9 || $_GET['type'] == 10 || $_REQUEST['type']== 5) { //福彩3D 排列三
    $game_name = get_gameName($_REQUEST['type']);
    //获取期数
			
    if($_REQUEST['type'] == 5) {
        $qishu = lottery_qishu_5($_REQUEST['type']);
		
    }else{
		
    $qishu	= lottery_qishu9($_REQUEST['type']);
		}
	
    if($qishu == -1 || $qh != $qishu) {
        echo json_encode(array('code' => 2, 'info' => '已经封盘，禁止下注！'));
        exit;
    }
    //判断会员账户额度是否大于总投注额度
    $allmoney = 0;
    for ($i = 0; $i < count($datas); $i++){
        $allmoney += $datas[''.$names[$i].''];
    }
  
		for ($i = 0; $i < count($datas); $i++) {
		if ($names[$i] != 'autoInput') {
		   
            if(abs($datas[''.$names[$i].'']) == 0) {
                echo json_encode(array('code' => 1, 'info' => '投注金额非法！'));
                exit;
            } else if (abs($datas[''.$names[$i].'']) < $cp_zd) {
                echo json_encode(array('code' => 1, 'info' => '最低下注金额：' . $cp_zd . '元！'));
                exit;
		    } else if (abs($datas[''.$names[$i].'']) > $cp_zg) {
                echo json_encode(array('code' => 1, 'info' => '最高下注金额：' . $cp_zg . '元！'));
                exit;
		    }
		}
	}
	
	$edu = $user['money'];
	if($edu < $allmoney) {
        echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
		exit;
	}
 $sql	=	"insert into c_bet(did,uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,bet_date,fs,k_type,k_wftype) values";
    $tz_list = array();
    $count = 0;
    for ($i = 0; $i < count($datas); $i++) {
        //分割键名，取ball_后的数字，来判断属于第几球
        $qiu	= explode("_", $names[$i]);
        $qiuhao = $ball_name['qiu_'.$qiu[1]];
        if($qiu[1] == 4) {
            $wanfa	= $ball_name_zh['ball_'.$qiu[2].''];
        } else if($qiu[1] == 5) {
            $wanfa	= $ball_name_s['ball_'.$qiu[2].''];
        } else {
            $wanfa	= $ball_name['ball_'.$qiu[2].''];
        }
        $money	= $datas[''.$names[$i].''];

        //获取赔率
        $odds	= lottery_odds($_GET['type'],'ball_'.$qiu[1],$qiu[2]);
            $sql	.=	"($did,".$uid.",'".$username."','".$l_time."','$game_name',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",'".$l_date."',$fs,'".$_REQUEST['type']."','0'),";
	
	     $tz_list[] = array(
                'orderId' => $did,
                'type'    => $qiuhao,
                'wanfa'   => $wanfa,
                'odds'    => $odds,
                'money'   => $money,
                'win'     => round($money * $odds, 2)
            );
			$count++;
	}
	
	
	$sql = substr($sql,0,strlen($sql)-1);
	$sqlmoney	=	"update k_user set money=money-$allmoney where username='".$username."' limit 1";
	/////处理投注资金变动////
	$money_type	= 100;	
	$about	=	$game_name."投注";
	$order	=	$username."_".$about."_".date("YmdHis");
	$money2=0-$allmoney;
	$assets	 =	$user['money'];
	$assets2=$assets-$allmoney;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sqlmoney);
		$q1		=	$mysqli->affected_rows;
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
	    $mysqli->query($sql_money);
		$q3		=	$mysqli->affected_rows;
		if($q1 == 1&&$q2>0&&$q3==1){
			$mysqli->commit(); //事务提交
		}else{
			$mysqli->rollback(); //数据回	
		echo json_encode(array('code' => 2, 'info' => '投注失败，请稍后重试！'));
		exit;
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	echo json_encode(array('code' => 2, 'info' => '投注失败，请稍后重试！'));
		exit;
	}	
	  
	
	$mysqli->autocommit(TRUE);
   //////////////////代理反水///////////////

				 $parents =$user['parents'];
				 $parr=explode(',', $parents);
				 $len =count($parr);
				for ($ik = 0; $ik<$len;$ik++){
			/// $fdmoney= $money*$fandian/100;
 	///////////////////////代理反水资金变动记录//////	
    $fdmoney_type	= 200;		$fdabout	=	$game_name."投注返点";
	$fdorder	=	$username."_".$about."_".date("YmdHis");
	///////取得当前代理级别的返点率/////
	$fdsql1="select * from k_send_back where uid='{$parr[$ik]}' and k_type =". $_REQUEST['type'];
				
	$query	 =	$mysqli->query($fdsql1);
	$fdrows	 =	$query->fetch_array();
	$fdlv1	 =	$fdrows['k_'.strtolower($pankou).'_limit'];
	$sjmsql1 ="select money from k_user where uid='{$parr[$ik]}'" ;
				
	$query	 =	$mysqli->query($sjmsql1);
	$sjmrows	 =	$query->fetch_array();
	//$sjmoney	 =	$sjmrows['money'];				
			
	/////////取得下级代理级别的返点率////////////
	$fdsql2="select * from k_send_back where uid='{$parr[$ik+1]}' and k_type =". $_REQUEST['type'];
				
	$query	 =	$mysqli->query($fdsql2);
	$fdrows2	 =	$query->fetch_array();
	$fdlv2	 =	$fdrows2['k_'.strtolower($pankou).'_limit'];
	$sjmsql2 ="select money from k_user where uid='{$parr[$ik+1]}'" ;
					
	$query	 =	$mysqli->query($sjmsql2);
	$sjmrows2	 =	$query->fetch_array();
	$sjmoney2	 =	$sjmrows2['money'];				
						
	if($ik==($len-1)){
	$fd= $fdlv1; 
	$sjmoney=$assets2;
	}else{
	$fd= $fdlv1 -$fdlv2; 
	$sjmoney	 =	$sjmrows['money'];		
		}
				
	$fdmoney=$allmoney*$fd/100;
	$fdassets2=$sjmoney+$fdmoney;
	
	if($fdmoney>0){
    $sqlfd_money	="insert into k_money(uid,xjuid,m_value,status,m_order,about,assets,balance,type) values (".$parr[$ik].",'$uid',".$fdmoney.",1,'$fdorder','$fdabout','$sjmoney','$fdassets2',".$fdmoney_type.")";		
	$mysqli->query($sqlfd_money)  or die ('返点失败');	

////////////////////////////////////////////		
     $sql	=	"update k_user set money=money+$fdmoney where uid='".$parr[$ik]."'    limit 1";
	 $mysqli->query($sql) or die ('返点失败');	
                         }
				}
	
	
	
	
	  $result = array(
        'code' => 0,
        'username' => $_SESSION["username"],
        'balance' => $edu-$allmoney,
        'qishu' => $qishu,
        'tz_sum' => $count,
        'money_all' => $allmoney,
        'tz_list' => $tz_list
    );
    echo json_encode($result);
	exit;
	
	
}elseif ($_GET['type'] ==6 || $_REQUEST['type']==31 || $_REQUEST['type']==32 || $_REQUEST['type']==33 || $_REQUEST['type']==34) { //快三
    $game_name = get_gameName($_REQUEST['type']);
    //获取期数
			
    if($_REQUEST['type'] == 31) {
        $qishu = lottery_qishu_31($_REQUEST['type']);
    }else{
    $qishu	= lottery_qishu6($_REQUEST['type']);
		}
    if($qishu == -1 || $qh != $qishu) {
        echo json_encode(array('code' => 2, 'info' => '已经封盘，禁止下注！'));
        exit;
    }
    //判断会员账户额度是否大于总投注额度
    $allmoney = 0;
    for ($i = 0; $i < count($datas); $i++){
        $allmoney += $datas[''.$names[$i].''];
    }
  
		for ($i = 0; $i < count($datas); $i++) {
		if ($names[$i] != 'autoInput') {
		   
            if(abs($datas[''.$names[$i].'']) == 0) {
                echo json_encode(array('code' => 1, 'info' => '投注金额非法！'));
                exit;
            } else if (abs($datas[''.$names[$i].'']) < $cp_zd) {
                echo json_encode(array('code' => 1, 'info' => '最低下注金额：' . $cp_zd . '元！'));
                exit;
		    } else if (abs($datas[''.$names[$i].'']) > $cp_zg) {
                echo json_encode(array('code' => 1, 'info' => '最高下注金额：' . $cp_zg . '元！'));
                exit;
		    }
		}
	}
	
	$edu = $user['money'];
	if($edu < $allmoney) {
        echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
		exit;
	}
 $sql	=	"insert into c_bet(did,uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,bet_date,fs,k_type,k_wftype) values";
    $tz_list = array();
    $count = 0;
    for ($i = 0; $i < count($datas); $i++) {
        //分割键名，取ball_后的数字，来判断属于第几球
        $qiu	= explode("_", $names[$i]);
        $qiuhao = $ball_name['qiu_'.$qiu[1]];
        if($qiu[1] == 4) {
            $wanfa	= $ball_name_zh['ball_'.$qiu[2].''];
        } else if($qiu[1] == 5) {
            $wanfa	= $ball_name_s['ball_'.$qiu[2].''];
        } else {
            $wanfa	= $ball_name['ball_'.$qiu[2].''];
        }
        $money	= $datas[''.$names[$i].''];

        //获取赔率
        $odds	= lottery_odds($_GET['type'],'ball_'.$qiu[1],$qiu[2]);
            $sql	.=	"($did,".$uid.",'".$username."','".$l_time."','$game_name',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",'".$l_date."',$fs,'".$_REQUEST['type']."','0'),";
	
	     $tz_list[] = array(
                'orderId' => $did,
                'type'    => $qiuhao,
                'wanfa'   => $wanfa,
                'odds'    => $odds,
                'money'   => $money,
                'win'     => round($money * $odds, 2)
            );
			$count++;
	}
	
	
	$sql = substr($sql,0,strlen($sql)-1);
	$sqlmoney	=	"update k_user set money=money-$allmoney where username='".$username."' limit 1";
	/////处理投注资金变动////
	$money_type	= 100;	
	$about	=	$game_name."投注";
	$order	=	$username."_".$about."_".date("YmdHis");
	$money2=0-$allmoney;
	$assets	 =	$user['money'];
	$assets2=$assets-$allmoney;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets','$assets2',".$money_type.")";	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sqlmoney);
		$q1		=	$mysqli->affected_rows;
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
	    $mysqli->query($sql_money);
		$q3		=	$mysqli->affected_rows;
		if($q1 == 1&&$q2>0&&$q3==1){
			$mysqli->commit(); //事务提交
		}else{
			$mysqli->rollback(); //数据回	
		echo json_encode(array('code' => 2, 'info' => '投注失败，请稍后重试！'));
		exit;
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	echo json_encode(array('code' => 2, 'info' => '投注失败，请稍后重试！'));
		exit;
	}	
	  
	
	$mysqli->autocommit(TRUE);
   //////////////////代理反水///////////////

				 $parents =$user['parents'];
				 $parr=explode(',', $parents);
				 $len =count($parr);
				for ($ik = 0; $ik<$len;$ik++){
			/// $fdmoney= $money*$fandian/100;
 	///////////////////////代理反水资金变动记录//////	
    $fdmoney_type	= 200;		$fdabout	=	$game_name."投注返点";
	$fdorder	=	$username."_".$about."_".date("YmdHis");
	///////取得当前代理级别的返点率/////
	$fdsql1="select * from k_send_back where uid='{$parr[$ik]}' and k_type =". $_REQUEST['type'];
				
	$query	 =	$mysqli->query($fdsql1);
	$fdrows	 =	$query->fetch_array();
	$fdlv1	 =	$fdrows['k_'.strtolower($pankou).'_limit'];
	$sjmsql1 ="select money from k_user where uid='{$parr[$ik]}'" ;
				
	$query	 =	$mysqli->query($sjmsql1);
	$sjmrows	 =	$query->fetch_array();
	//$sjmoney	 =	$sjmrows['money'];				
			
	/////////取得下级代理级别的返点率////////////
	$fdsql2="select * from k_send_back where uid='{$parr[$ik+1]}' and k_type =". $_REQUEST['type'];
				
	$query	 =	$mysqli->query($fdsql2);
	$fdrows2	 =	$query->fetch_array();
	$fdlv2	 =	$fdrows2['k_'.strtolower($pankou).'_limit'];
	$sjmsql2 ="select money from k_user where uid='{$parr[$ik+1]}'" ;
					
	$query	 =	$mysqli->query($sjmsql2);
	$sjmrows2	 =	$query->fetch_array();
	$sjmoney2	 =	$sjmrows2['money'];				
						
	if($ik==($len-1)){
	$fd= $fdlv1; 
	$sjmoney=$assets2;
	}else{
	$fd= $fdlv1 -$fdlv2; 
	$sjmoney	 =	$sjmrows['money'];		
		}
				
	$fdmoney=$allmoney*$fd/100;
	$fdassets2=$sjmoney+$fdmoney;
	
	if($fdmoney>0){
    $sqlfd_money	="insert into k_money(uid,xjuid,m_value,status,m_order,about,assets,balance,type) values (".$parr[$ik].",'$uid',".$fdmoney.",1,'$fdorder','$fdabout','$sjmoney','$fdassets2',".$fdmoney_type.")";		
	$mysqli->query($sqlfd_money)  or die ('返点失败');	

////////////////////////////////////////////		
     $sql	=	"update k_user set money=money+$fdmoney where uid='".$parr[$ik]."'    limit 1";
	 $mysqli->query($sql) or die ('返点失败');	
                         }
				}
	
	
	
	
	  $result = array(
        'code' => 0,
        'username' => $_SESSION["username"],
        'balance' => $edu-$allmoney,
        'qishu' => $qishu,
        'tz_sum' => $count,
        'money_all' => $allmoney,
        'tz_list' => $tz_list
    );
    echo json_encode($result);
	exit;
	
	
}