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
$username = $_SESSION["username"];

//清空所有POST数据为空的表单
$datas = array_filter($_POST);
$qh = $datas['qi_num'];
unset($datas['qi_num']);
//获取清空后的POST键名
$names = array_keys($datas);

$fs=0;

//快乐8
if ($_REQUEST['type'] == 1) {
	$game_name = get_gameName($_REQUEST['type']);
	//获取期数
	$qishu = lotteryk8_qishu($_REQUEST['type']);
    if($qishu == -1 || $qh != $qishu) {
        echo json_encode(array('code' => 2, 'info' => '已经封盘，禁止下注！'));
        exit;
	}
	//判断会员账户额度是否大于总投注额度
	$allmoney = 0;
	for ($i = 0; $i < count($datas); $i++) {
		$allmoney += $datas[''.$names[$i].''];
	}
	$edu = user_money($username, $allmoney);
	if($edu == -1) {
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

		$mysqli->query("insert into c_bet(did,uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,bet_date,fs) values (201312180018,".$uid.",'".$username."','".$l_time."','$game_name',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",'".$l_date."',$fs)") or die ("操作失败1!!!");
        //积分开始
		$id 	=	$mysqli->insert_id;
		include_once("../../class/user.php");
		$jifen = $web_site['jf_tzjf'] * $money;
		$bet_info = "$qishu - $qiuhao - $wanfa @ $odds";
		$about = $bet_info."<br>下注:$money 元";
		$re = user::jifen_add($uid,$id,$about,$jifen,1,$game_name);
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
	}//选二~选五下注结束
	
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

		$mysqli->query("insert into c_bet(did,uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,bet_date,fs) values (201312180018,".$uid.",'".$username."','".$l_time."','$game_name',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",'".$l_date."',$fs)") or die ("操作失败2!!!");
        //积分开始
		$id 	=	$mysqli->insert_id;
		include_once("../../class/user.php");
		$jifen = $web_site['jf_tzjf'] * $money;
		$bet_info = "$qishu - $qiuhao - $wanfa @ $odds";
		$about = $bet_info."<br>下注:$money 元";
		$re = user::jifen_add($uid,$id,$about,$jifen,1,$game_name);
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
} elseif ($_REQUEST['type'] == 2 || $_REQUEST['type'] == 7 || $_REQUEST['type'] == 14 || $_REQUEST['type'] == 15) { //重庆时时彩
	$game_name = get_gameName($_REQUEST['type']);
	//获取期数
	$qishu	= lottery_qishu($_REQUEST['type']);
    if($qishu == -1 || $qh != $qishu) {
        echo json_encode(array('code' => 2, 'info' => '已经封盘，禁止下注！'));
        exit;
	}
	//判断会员账户额度是否大于总投注额度
	include_once("../../cache/group_" . $_SESSION["gid"] . ".php"); //加载权限组权限
	$cp_zd = $pk_db['彩票最低'];
	$cp_zg = $pk_db['彩票最高'];
    if($cp_zd <= 0) {
        $cp_zd = 1;
    }
    if($cp_zg <= 0) {
        $cp_zg = 1000000;
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
	$edu = user_money($username, $allmoney);
    if($edu == -1) {
        echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
        exit;
	}

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

            //获取赔率
            $odds	= lottery_odds($_REQUEST['type'],'ball_'.$qiu[1],$qiu[2]);
            $sql	=	"insert into c_bet(did,uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,bet_date,fs) values (201212140014,".$uid.",'".$username."','".$l_time."','".$game_name."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",'".$l_date."',$fs)";
            $mysqli->query($sql) or die ("操作失败!!!");
            //积分开始
            $id 	=	$mysqli->insert_id;
            include_once("../../class/user.php");
            $jifen = $web_site['jf_tzjf'] * $money;
            $bet_info = "$qishu - $qiuhao - $wanfa @ $odds";
            $about = $bet_info."<br>下注:$money 元";
            $re = user::jifen_add($uid,$id,$about,$jifen,1,$game_name);
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
	}
} elseif ($_GET['type'] == 9 || $_GET['type'] == 10 ) { //福彩3D 排列三
    $game_name = get_gameName($_REQUEST['type']);
    //获取期数
    $qishu	= lottery_qishu9($_REQUEST['type']);
    if($qishu == -1 || $qh != $qishu) {
        echo json_encode(array('code' => 2, 'info' => '已经封盘，禁止下注！'));
        exit;
    }
    //判断会员账户额度是否大于总投注额度
    $allmoney = 0;
    for ($i = 0; $i < count($datas); $i++){
        $allmoney += $datas[''.$names[$i].''];
    }
    $edu = user_money($username, $allmoney);
    if($edu == -1) {
        echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
        exit;
    }

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
        $mysqli->query("insert into c_bet(did,uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,bet_date,fs) values (201312180018,".$uid.",'".$username."','".$l_time."','$game_name',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",'".$l_date."',$fs)") or die ("操作失败1!!!");
        //积分开始
        $id 	=	$mysqli->insert_id;
        include_once("../../class/user.php");
        $jifen = $web_site['jf_tzjf'] * $money;
        $bet_info = "$qishu - $qiuhao - $wanfa @ $odds";
        $about = $bet_info."<br>下注:$money 元";
        $re = user::jifen_add($uid,$id,$about,$jifen,1,$game_name);
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