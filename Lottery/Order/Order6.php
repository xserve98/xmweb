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
///include("../../cache/group_" . $_SESSION['gid'] . ".php");
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

$uid = $_SESSION["uid"];
$username = $_SESSION["username"];

//清空所有POST数据为空的表单
$datas = array_filter($_POST);
$did=date("YmdHis");


$fs=0;

  

if($_REQUEST['type'] == 25 ) {
    //获取彩种
    $game_name = '百人牛牛';
    $qh = $datas['issue'];

    //获取期数
    if($_REQUEST['type'] == 25) {
        $qishu = lottery_qishu($_REQUEST['type']);

    } 
	
	//echo $qishu;
    if($qishu == -1 || $qh != $qishu) {
        echo json_encode(array('code' => 2, 'info' => '已经封盘，禁止下注！'));
        exit;
    }
    unset($datas['issue']);

    //获取清空后的POST键名
    $names = array_keys($datas['data']);
    //判断会员账户额度是否大于总投注额度


    $allmoney = 0;
	
	$data =$datas['data'];
    for($i = 0; $i < count($data); $i++) {
        $allmoney += abs($data[$names[$i]]);
        if(abs($data[$names[$i]]) == 0) {
            echo json_encode(array('code' => 1, 'info' => '投注金额非法！'));
            exit;
        } else if(abs($data[$names[$i]]) < $cp_zd) {
            echo json_encode(array('code' => 1, 'info' => '最低下注金额：' . $cp_zd . '元！'));
            exit;
        } else if(abs($data[$names[$i]]) > $cp_zg) {
            echo json_encode(array('code' => 1, 'info' => '最高下注金额：' . $cp_zg . '元！'));
            exit;
        }
    } $id 	=	$mysqli->insert_id;////////////添加资金投注记录////////	$sql	 =	"select * from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$rows	 =	$query->fetch_array();
	$assets	 =	$rows['money'];
	
    $edu = user_money2($username, $allmoney);
    if($edu == -1) {
        echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
        exit;
    }
    $tz_list = array();
    $count = 0;
	
	
    for($i = 0; $i < count($data); $i++) {
        //分割键名，取ball_后的数字
           $wanfa=$names[$i];
		       if($names[$i]=='t'){
			     $wanfa='天';
			     }else if($names[$i]=='d'){
				 $wanfa='地';
			     }else if($names[$i]=='x'){
				 $wanfa='玄';
				 }else if($names[$i]=='h'){
			     $wanfa='黄';
				     }
				    $qiuhao =''; 
					$odds =1;
				  
        
        $money	= $data[''.$names[$i].''];
		$dbje =  $money*6;
        //获取赔率
        ///$odds	= lottery_odds($_REQUEST['type'],'ball_'.$qiu[1],$qiu[2]);
        $sql	=	"insert into c_bet(did,uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,bet_date,fs,dbje) values ($did,".$uid.",'".$username."','".$l_time."','$game_name',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".($money*2).",'".$l_date."',$fs,".$dbje.")";
        $mysqli->query($sql) or die ("操作失败!!!");
		/////////////////////
		$id 	=	$mysqli->insert_id;	
		/////////////////////资金变动记录和代理反水//////////		
			
				  ///////////资金变动记录变量/////////////////
    $sum += $money;
	$did=date("YmdHis");
	$money_type	= 100;		
	$money_type2	= 500;	
	$dbje=6*$money;
	$about	=	$game_name."投注：".$money;
	$about2	=	$game_name."投注担保金：".$dbje;
	$order	=	$username."-订单号".$about."_".date("YmdHis");
	$money2=0-$money;
	$money22=0-6*$money;
	
	/////////////////////////

		$assets0=	$assets - $i*7*$money;
	
	///$assets=$assets+$allmoney-
	$assets2=$assets -$money- $i*7*$money;
	//$assets3=$assets2+ $money;
	$assets22=$assets2-6*$money;
	
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money2.",1,'$order','$about','$assets0','$assets2',".$money_type.")";
	$mysqli->query($sql_money) or die ($sql_money);
	
	$sql_money2	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$uid.",".$money22.",1,'$order','$about2','$assets2','$assets22',".$money_type2.")";
	$mysqli->query($sql_money2) or die ($sql_money2); //////////////////代理反水///////////////
			if($rows['dltype']==0){ /////////////分享代理反水///////
			
				 $sql_web	 =	"select * from web_config "; //取汇款前会员余额
	             $query	 =	$mysqli->query($sql_web);
	             $webs	 =	$query->fetch_array();
				
				 
				 $sjsql	 =	"select * from k_user where uid=$uid limit 1"; //取汇款前会员余额
	             $query	 =	$mysqli->query($sjsql);
	             $sj	 =	$query->fetch_array();
				 $parents =$sj['parents'];
				 $fdjishu=intval($sj['fdjishu']);
				 $fandian=$sj['fandian'];
				 $parr=explode(',', $parents);
				 $len =count($parr);
				 
				if($len>1){
					
					if($len<=$fdjishu+1){
	               
					 $sumfdmoney=0;for ($k = 1; $k<$len-1;$k++){
			 $fdmoney= $money*$fandian/100;	
			 $sumfdmoney +=$fdmoney;	///////////////////////代理反水资金变动记录//////	
$fdmoney_type	= 200;		$fdabout	=	$game_name."投注返点";
	$fdorder	=	$username."_".$about."_".date("YmdHis");
	$fdmoney2=$fdmoney;
	$fdsql	 =	"select money from k_user where uid='".$parr[$k]."'  and is_daili=1  limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($fdsql);
	$fdrows	 =	$query->fetch_array();
	$fdassets	 =	$fdrows['money'];
	$fdassets2=$fdassets+$fdmoney2;
 ///$assets=$assets+$allmoney-
 
$sql_money	="insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$parr[$k].",".$fdmoney2.",1,'$fdorder','$fdabout','$fdassets','$fdassets2',".$fdmoney_type.")";
$mysqli->query($sql_money) or die ($sql_money);

					////////////////////////////////////////////		
						
						

				    $sql	=	"update k_user set money=money+$fdmoney where uid='".$parr[$k]."'  and is_daili=1  limit 1";
		            $mysqli->query($sql);

						
					}
				
					}else{
											 $sumfdmoney=0;
					for ($k = $len-1-$fdjishu; $k<$len-1;$k++) {
				    $fdmoney= $money*$fandian/100;
					$sumfdmoney +=$fdmoney;
								///////////////////////代理反水资金变动记录//////	
$fdmoney_type	= 200;		$fdabout	=	$game_name."投注返点";
	$fdorder	=	$username."_".$about."_".date("YmdHis");
	$fdmoney2=$fdmoney;
	$fdsql	 =	"select money from k_user where uid='".$parr[$k]."' limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($fdsql);
	$fdrows	 =	$query->fetch_array();
	$fdassets	 =	$fdrows['money'];
	$fdassets2=$fdassets+$fdmoney2;
 ///$assets=$assets+$allmoney-
 
$sql_money	="insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$parr[$k].",".$fdmoney2.",1,'$fdorder','$fdabout','$fdassets','$fdassets2',".$fdmoney_type.")";
$mysqli->query($sql_money) or die ($sql_money);
			
					////////////////////////////////////////////					
				    $sql = "update k_user set money=money+$fdmoney where uid='".$parr[$k]."' limit 1";
		            $mysqli->query($sql);
				
					}
			
						}
						
						
						
	 $fdsql	 =	"select money,fandian from k_user where uid='".$parr[0]."' limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($fdsql);
	$fdrows	 =	$query->fetch_array();	
	$fdassets	 =	$fdrows['money'];
	$fdassets2=$fdassets+$sumfdmoney;
	$fdmoney_type	= 200;
	$fdmoney2=$fdmoney= $money*$fdrows['fandian']/100-$sumfdmoney;
$fdorder	=	$username."_".$about."_".date("YmdHis");
$fdassets   =
$sql_money	="insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$parr[0].",".$fdmoney2.",1,'$fdorder','$fdabout','$fdassets','$fdassets2',".$fdmoney_type.")";
$mysqli->query($sql_money) or die ($sql_money);
	
 $sql = "update k_user set money=money+$fdmoney where uid='".$parr[0]."' limit 1";
 $mysqli->query($sql);			
						
					
					
					}
				}///////////分享代理反水结束////////
				
			else{
				
			     $sql_web	 =	"select * from web_config "; //
	             $query	 =	$mysqli->query($sql_web);
	             $webs	 =	$query->fetch_array();
				
				 
				 $sjsql	 =	"select * from k_user where uid=$uid limit 1"; //
	             $query	 =	$mysqli->query($sjsql);
	             $sj	 =	$query->fetch_array();
				 $parents =$sj['parents'];
				// $fdjishu=intval($sj['fdjishu']);
				// $fandian=$sj['fandian'];
				 $parr=explode(',', $parents);
				 $len =count($parr);
				
				if($len>1){
	              
	for ($k = 0; $k<$len-1;$k++){
			/// $fdmoney= $money*$fandian/100;
 	///////////////////////代理反水资金变动记录//////	
$fdmoney_type	= 200;		$fdabout	=	$game_name."投注返点";
	$fdorder	=	$username."_".$about."_".date("YmdHis");
	//$fdmoney2=$fdmoney;
	
	///////取得当前代理级别的返点率/////
	$fdsql	 =	"select * from k_user where uid='".$parr[$k]."'  and is_daili=1  limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($fdsql);
	$fdrows	 =	$query->fetch_array();
	$fdassets	 =	$fdrows['money'];
	$fdlv1	 =	$fdrows['fandian'];
	
	/////////取得下级代理级别的返点率////////////
	$fdsql2	 =	"select * from k_user where uid='".$parr[$k+1]."'  and is_daili=1  limit 1"; //取汇款前会员余额
	
	$query	 =	$mysqli->query($fdsql2);
	$fdrows2	 =	$query->fetch_array();
	$fdlv2	 =	$fdrows2['fandian'];
	
 
	/////////////结束///
	/////计算返点率差,返点金额/////////
	if($k==($len-2)){
	$fd= $fdlv1; 
	}else{
	$fd= $fdlv1 -$fdlv2; 
	$sjmoney	 =	$sjmrows['money'];		
		}
	$fdmoney=$money*$fd/100;
	//////////
	
	$fdassets2=$fdassets+$fdmoney;
 ///$assets=$assets+$allmoney-
    
      $sql_money	="insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$parr[$k].",".$fdmoney.",1,'$fdorder','$fdabout',0,'$fdassets2',".$fdmoney_type.")";
$mysqli->query($sql_money) ;
			
////////////////////////////////////////////		
      $sql	=	"update k_user set money=money+$fdmoney where uid='".$parr[$k]."'  and is_daili=1  limit 1";
	  $mysqli->query($sql);

						
					}
				
	
					
					}
				
	
				
				}	////////////普通代理反水结束//////////
				
				
				//////////////代理反水结束//////////////////
				
		
		
		
		
		
		/////////////////////////
        //积分结束
        $tz_list[] = array(
            'orderId' => $id,
            'type'    => $qiuhao,
            'wanfa'   => $wanfa,
            'odds'    => $odds,
            'money'   => $money,
            'win'     => round($money * $odds, 2)
        );
        $count++;
    }
    $result = array(
	    'status' => "ok",
        'code' => 0,
        'username' => $_SESSION["username"],
        'balance' => $edu,
        'qishu' => $qishu,
        'tz_sum' => $count,
        'money_all' => $allmoney,
        'tz_list' => $tz_list
    );
    echo json_encode($result);
}