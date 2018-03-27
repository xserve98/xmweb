<?php
session_start();
if(!isset($_SESSION["uid"]) || !isset($_SESSION["username"])) {
    echo json_encode(array('code' => -1));
    exit;
}

include_once("../../include/config.php");
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");
include ("../include/ball_name.php");
include ("../include/order_info.php");

$uid = $_SESSION["uid"];
$username = $_SESSION["username"];

$class = $_GET['class'];
//清空所有POST数据为空的表单
$datas = array_filter($_POST);
$qh = $datas['qi_num'];
unset($datas['qi_num']);
//获取清空后的POST键名
$names = array_keys($datas);

$allmoney = 0;
$edu = 0;
$count = 0;
$tz_list = array();
$fs = 0;

//香港六合彩
if($_GET['type'] == 0) {
	//获取期数
	$qishu	= lottery_qishu($_GET['type']);
    if($qishu == -1 || $qh != $qishu) {
        echo json_encode(array('code' => 2, 'info' => '已经封盘，禁止下注！'));
        exit;
	}
	if($class == 8) { //正码过关
		if(is_numeric(!$_POST['money'])) {
            echo json_encode(array('code' => 1, 'info' => '参数错误，请重新下注！'));
            exit;
		}
		if(count($datas) < 2) {
            echo json_encode(array('code' => 1, 'info' => '正码过关至少选择 2 项！'));
            exit;
		}
		$money = $_POST['money'];
		$edu = user_money($username, $money);
		if($edu == -1) {
            echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
            exit;
		}
		for ($i = 0; $i < count($datas) - 1; $i++) {
			//分割键名，取ball_后的数字，来判断属于第几球
			$qiu	= explode("_",$datas[$names[$i]]);
			$qiuhao = $ball_name['qiu_'.$qiu[0]];
			$wanfa	= $ball_name['ball_'.$qiu[1].''];
			//获取赔率
			$odds	= lottery_odds($_GET['type'],'ball_'.$qiu[0],$qiu[1]);
			$wanfa_zong .= $qiuhao.'|'.$wanfa.'|'.$odds.'<hr />';
            $wanfa_info .= $qiuhao.'|'.$wanfa.'|'.'@';
			$odds_zong += $odds;
		}
        $wanfa_info = rtrim($wanfa_info, '@');

		$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'正码过关','".$wanfa_zong."',".$odds_zong.",".$money.",".$money*$odds_zong.",$fs)";
		$mysqli->query($sql) or die ("操作失败!!!");
        //积分开始
		$id 	=	$mysqli->insert_id;
		include_once("../../class/user.php");
		$jifen = $web_site['jf_tzjf'] * $money;
		$bet_info = "$qishu - 正码过关 - $wanfa_zong @ $odds_zong";
		$about = $bet_info."<br>下注:$money 元";
		$re = user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
        //积分结束
        $tz_list[] = array(
            'orderId' => $id,
            'type'    => '过关',
            'wanfa'   => $wanfa_info,
            'odds'    => $odds_zong,
            'money'   => $money,
            'win'     => round($money * $odds_zong, 2)
        );
        $allmoney += $money;
        $count++;
	} else if($class == 11) { //连码
		if(is_numeric(!$_POST['money'])) {
            echo json_encode(array('code' => 1, 'info' => '参数错误，请重新下注！'));
            exit;
		}
		$money = $_POST['money'];
		$qiuhao = $ball_name['qiu_'.$class.'_'.$_POST['ball_'.$class.'']];
		if($_POST['type'] == 1){ //普通玩法
			if($_POST['ball_'.$class.''] == 1){ //四全中
				$odds	= lottery_odds($_GET['type'],'ball_11',$_POST['ball_11']);
				$ws = count($_POST['ball']);
				if($ws < 4 || $ws > 10) {
                    echo json_encode(array('code' => 1, 'info' => '只能选择 4 - 10 个号码！'));
                    exit;
				}
				$zz = $ws * ($ws - 1) * ($ws - 2) * ($ws - 3) / 24;
				$allmoney = $zz * $money;
				$edu = user_money($username, $allmoney);
				if($edu == -1) {
                    echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                    exit;
				}
				for ( $a = 0 ; $a < $ws - 3 ; $a++ ){
					for ( $b = $a + 1 ; $b < $ws - 2 ; $b++ ){
						for ( $c= $b + 1 ; $c < $ws - 1 ; $c++ ){
							for ( $d = $c + 1 ; $d < $ws ; $d++ ){
								$qw++;
								$wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d];

								$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
								$mysqli->query($sql) or die ("操作失败!!!");
								//jifen start
								$id 	=	$mysqli->insert_id;
								include_once("../../class/user.php");
								$jifen=$web_site['jf_tzjf']*$money;
								$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
								$about=$bet_info."<br>下注:$money 元";
								$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
								//jifen end
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
					}
				}
			}
			if($_POST['ball_'.$class.''] == 2 || $_POST['ball_'.$class.''] == 3){ //三全中
				$odds	= lottery_odds($_GET['type'],'ball_11',$_POST['ball_11']);
				$ws = count($_POST['ball']);
				if($ws < 3 || $ws > 10) {
                    echo json_encode(array('code' => 1, 'info' => '只能选择 3 - 10 个号码！'));
                    exit;
				}
				$zz = $ws * ($ws - 1) * ($ws - 2) / 6;
				$allmoney = $zz * $money;
				$edu = user_money($username, $allmoney);
				if($edu == -1) {
                    echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                    exit;
				}
				for ( $a = 0 ; $a < $ws - 2 ; $a++ ){
					for ( $b = $a + 1 ; $b < $ws - 1 ; $b++ ){
						for ( $c= $b + 1 ; $c < $ws ; $c++ ){
							$qw++;
							$wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c];

							$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
							$mysqli->query($sql) or die ("操作失败!!!");
							//jifen start
							$id 	=	$mysqli->insert_id;
							include_once("../../class/user.php");
							$jifen=$web_site['jf_tzjf']*$money;
							$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
							$about=$bet_info."<br>下注:$money 元";
							$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
							//jifen end
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
				}
			}
			if($_POST['ball_'.$class.''] == 4 || $_POST['ball_'.$class.''] == 5 || $_POST['ball_'.$class.''] == 6){ //三全中
				if($_POST['ball_'.$class.''] == 4) {
					$odds	= lottery_odds($_GET['type'],'ball_11',5);
				}
				if($_POST['ball_'.$class.''] == 5) {
					$odds	= lottery_odds($_GET['type'],'ball_11',6);
				}
				if($_POST['ball_'.$class.''] == 6) {
					$odds	= lottery_odds($_GET['type'],'ball_11',8);
				}
				$ws = count($_POST['ball']);
				if($ws < 2 || $ws > 10){
                    echo json_encode(array('code' => 1, 'info' => '只能选择 2 - 10 个号码！'));
                    exit;
				}
				$zz = $ws * ($ws - 1) / 2;
				$allmoney = $zz * $money;
				$edu = user_money($username, $allmoney);
				if($edu == -1) {
                    echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                    exit;
				}
				for ( $a = 0 ; $a < $ws - 1 ; $a++ ){
					for ( $b = $a + 1 ; $b < $ws ; $b++ ){
						$qw++;
						$wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b];

						$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
						$mysqli->query($sql) or die ("操作失败!!!");
						//jifen start
                        $id 	=	$mysqli->insert_id;
                        include_once("../../class/user.php");
                        $jifen=$web_site['jf_tzjf']*$money;
                        $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                        $about=$bet_info."<br>下注:$money 元";
                        $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
						//jifen end
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
			}
		}
		if($_POST['type'] == 2 || $_POST['type'] == 3){ //生肖对碰，尾数对碰
			if($_POST['type'] == 2) {
				$ws  = count($_POST['ball_sx']);
				$arr = explode(",",$_POST['ball_sx'][0]);
				$brr = explode(",",$_POST['ball_sx'][1]);
			}
			if($_POST['type'] == 3) {
				$ws  = count($_POST['ball_ws']);
				$arr = explode(",",$_POST['ball_ws'][0]);
				$brr = explode(",",$_POST['ball_ws'][1]);
			}
			if($ws != 2) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 2 组号码！'));
                exit;
			}
			if($_POST['ball_'.$class.'']==4){
				$odds	= lottery_odds($_GET['type'],'ball_11',5);
			}
			if($_POST['ball_'.$class.'']==5){
				$odds	= lottery_odds($_GET['type'],'ball_11',6);
			}
			if($_POST['ball_'.$class.'']==6){
				$odds	= lottery_odds($_GET['type'],'ball_11',8);
			}
			$zz = count($arr)*count($brr);
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu==-1){
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for($i=0;$i<count($arr);$i++){
				for ($a=0;$a<count($brr);$a++){
					$qw++;
					$wanfa =  $arr[$i].','.$brr[$a];

					$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
					$mysqli->query($sql) or die ("操作失败!!!");
					//jifen start
                    $id 	=	$mysqli->insert_id;
                    include_once("../../class/user.php");
                    $jifen=$web_site['jf_tzjf']*$money;
                    $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                    $about=$bet_info."<br>下注:$money 元";
                    $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
					//jifen end
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
			
		}
		if($_POST['type'] == 4){ //串肖尾数
			$arr = explode(",",$_POST['ball_sx']);
			$brr = explode(",",$_POST['ball_ws']);
			if(!$_POST['ball_sx'] || !$_POST['ball_ws']) {
                echo json_encode(array('code' => 1, 'info' => '请正确选择生肖与尾数！'));
                exit;
			}
			$brr = arrdel($arr,$brr);
			if($_POST['ball_'.$class.'']==1){
				$odds	= lottery_odds($_GET['type'],'ball_11',1);
				$zz 	= (count($brr)*(count($brr)-1)*(count($brr)-2)/6)*count($arr);
			}
			if($_POST['ball_'.$class.'']==2){
				$odds	= lottery_odds($_GET['type'],'ball_11',2);
				$zz 	= (count($brr)*(count($brr)-1)/2)*count($arr);
			}
			if($_POST['ball_'.$class.'']==3){
				$odds	= lottery_odds($_GET['type'],'ball_11',3);
				$zz 	= (count($brr)*(count($brr)-1)/2)*count($arr);
			}
			if($_POST['ball_'.$class.'']==4){
				$odds	= lottery_odds($_GET['type'],'ball_11',5);
				$zz 	= count($brr)*count($arr);
			}
			if($_POST['ball_'.$class.'']==5){
				$odds	= lottery_odds($_GET['type'],'ball_11',6);
				$zz 	= count($brr)*count($arr);
			}
			if($_POST['ball_'.$class.'']==6){
				$odds	= lottery_odds($_GET['type'],'ball_11',8);
				$zz 	= count($brr)*count($arr);
			}
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			if($_POST['ball_'.$class.''] == 1){ //四全中
				for($i=0;$i<count($arr);$i++){
					for ($a=0;$a<count($brr)-2;$a++){
						for ($b=$a+1;$b<count($brr)-1;$b++){
							for ($c=$b+1;$c<count($brr);$c++){
								$qw++;
								$wanfa =  $brr[$a].','.$brr[$b].','.$brr[$c].','.$arr[$i];

								$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
								$mysqli->query($sql) or die ("操作失败!!!");
								//jifen start
								$id 	=	$mysqli->insert_id;
								include_once("../../class/user.php");
								$jifen=$web_site['jf_tzjf']*$money;
								$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
								$about=$bet_info."<br>下注:$money 元";
								$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
								//jifen end
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
					}
				} 
			}
			if($_POST['ball_'.$class.''] == 2 || $_POST['ball_'.$class.''] == 3) { //三全中，三中特
				for($i=0;$i<count($arr);$i++){
					for ($a=0;$a<count($brr)-1;$a++){
						for ($b=$a+1;$b<count($brr);$b++){
							$qw++;
							$wanfa =  $brr[$a].','.$brr[$b].','.$arr[$i];

							$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
							$mysqli->query($sql) or die ("操作失败!!!");
							//jifen start
							$id 	=	$mysqli->insert_id;
							include_once("../../class/user.php");
							$jifen=$web_site['jf_tzjf']*$money;
							$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
							$about=$bet_info."<br>下注:$money 元";
							$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
							//jifen end
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
				} 
			}
			if($_POST['ball_'.$class.''] == 4 || $_POST['ball_'.$class.''] == 5 || $_POST['ball_'.$class.''] == 6) { //二全中，二中特，特串
				for($i=0;$i<count($arr);$i++){
					for ($a=0;$a<count($brr);$a++){
						$qw++;
						$wanfa =  $brr[$a].','.$arr[$i];
						$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.")";
						$mysqli->query($sql) or die ("操作失败!!!");
                        $id 	=	$mysqli->insert_id;
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
			}
		}
		if($_POST['type'] == 5){ //拖胆
			$arr = $_POST['ball_dm'];
			$brr = $_POST['ball_tm'];
			$brr = arrdel($arr,$brr);
			if(count($arr) < 1) {
                echo json_encode(array('code' => 1, 'info' => '请选择胆码！'));
                exit;
			}
			if(count($brr) < 1) {
                echo json_encode(array('code' => 1, 'info' => '请选择拖码！'));
                exit;
			}
			if($_POST['ball_'.$class.'']==1){
				$odds	= lottery_odds($_GET['type'],'ball_11',1);
				if(count($arr)==3){
					$zz = count($brr);
				}
				if(count($arr)==2){
					$zz = count($brr)*(count($brr)-1)/2;
				}
				if(count($arr)==1){
					$zz = count($brr)*(count($brr)-2)*(count($brr)-1)/6;
				}
			}
			if($_POST['ball_'.$class.'']==2){
				$odds	= lottery_odds($_GET['type'],'ball_11',2);
				if(count($arr)==2){
					$zz = count($brr);
				}
				if(count($arr)==1){
					$zz = count($brr)*(count($brr)-1)/2;
				}
			}
			if($_POST['ball_'.$class.'']==3){
				$odds	= lottery_odds($_GET['type'],'ball_11',3);
				if(count($arr)==2){
					$zz = count($brr);
				}
				if(count($arr)==1){
					$zz = count($brr)*(count($brr)-1)/2;
				}
			}
			if($_POST['ball_'.$class.'']==4){
				$odds	= lottery_odds($_GET['type'],'ball_11',5);
				$zz 	= count($brr)*count($arr);
			}
			if($_POST['ball_'.$class.'']==5){
				$odds	= lottery_odds($_GET['type'],'ball_11',6);
				$zz 	= count($brr)*count($arr);
			}
			if($_POST['ball_'.$class.'']==6){
				$odds	= lottery_odds($_GET['type'],'ball_11',8);
				$zz 	= count($brr)*count($arr);
			}
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			if($_POST['ball_'.$class.''] == 1){ //四全中
				if(count($arr) < 1 || count($arr) > 3) {
                    echo json_encode(array('code' => 1, 'info' => '请选择 1 - 3 个胆码！'));
                    exit;
				}
				if(count($arr)==3){
					for($i=0;$i<count($brr);$i++){
						for ($a=0;$a<count($arr)-2;$a++){
							for ($b=$a+1;$b<count($arr)-1;$b++){
								for ($c=$b+1;$c<count($arr);$c++){
									$qw++;
									$wanfa =  $brr[$i].','.$arr[$a].','.$arr[$b].','.$arr[$c];

									$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
									$mysqli->query($sql) or die ("操作失败!!!");
									//jifen start
                                    $id 	=	$mysqli->insert_id;
                                    include_once("../../class/user.php");
                                    $jifen=$web_site['jf_tzjf']*$money;
                                    $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                                    $about=$bet_info."<br>下注:$money 元";
                                    $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
                                    //jifen end
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
						}
					}
				}
				if(count($arr) == 2) {
					for ($a=0;$a<count($brr)-1;$a++){
						for ($b=$a+1;$b<count($brr);$b++){
							$qw++;
							$wanfa =  $brr[$a].','.$brr[$b].','.$arr[0].','.$arr[1];

							$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
							$mysqli->query($sql) or die ("操作失败!!!");
							//jifen start
							$id 	=	$mysqli->insert_id;
							include_once("../../class/user.php");
							$jifen=$web_site['jf_tzjf']*$money;
							$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
							$about=$bet_info."<br>下注:$money 元";
							$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
							//jifen end
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
				}
				if(count($arr)==1){
					for ($a=0;$a<count($brr)-2;$a++){
						for ($b=$a+1;$b<count($brr)-1;$b++){
							for ($c=$b+1;$c<count($brr);$c++){
								$qw++;
								$wanfa =  $brr[$a].','.$brr[$b].','.$brr[$c].','.$arr[0];

								$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
								$mysqli->query($sql) or die ("操作失败!!!");
								//jifen start
								$id 	=	$mysqli->insert_id;
								include_once("../../class/user.php");
								$jifen=$web_site['jf_tzjf']*$money;
								$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
								$about=$bet_info."<br>下注:$money 元";
								$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
								//jifen end
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
					}
				}
			}
			if($_POST['ball_'.$class.''] == 2 || $_POST['ball_'.$class.''] == 3){//三全中，三中三
				if(count($arr) < 1 || count($arr) > 2) {
                    echo json_encode(array('code' => 1, 'info' => '请选择 1 - 2 个胆码！'));
                    exit;
				}
				if(count($arr) == 2) {
					for($i=0;$i<count($brr);$i++){
						for ($a=0;$a<count($arr)-1;$a++){
							for ($b=$a+1;$b<count($arr);$b++){
								$qw++;
								$wanfa =  $brr[$i].','.$arr[$a].','.$arr[$b];

								$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
								$mysqli->query($sql) or die ("操作失败!!!");
								//jifen start
								$id 	=	$mysqli->insert_id;
								include_once("../../class/user.php");
								$jifen=$web_site['jf_tzjf']*$money;
								$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
								$about=$bet_info."<br>下注:$money 元";
								$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
								//jifen end
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
					}
				}
				if(count($arr) == 1) {
					for ($a=0;$a<count($brr)-1;$a++){
						for ($b=$a+1;$b<count($brr);$b++){
							$qw++;
							$wanfa =  $brr[$a].','.$brr[$b].','.$arr[0];

							$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
							$mysqli->query($sql) or die ("操作失败!!!");
							//jifen start
							$id 	=	$mysqli->insert_id;
							include_once("../../class/user.php");
							$jifen=$web_site['jf_tzjf']*$money;
							$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
							$about=$bet_info."<br>下注:$money 元";
							$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
							//jifen end
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
				}
			}
			if($_POST['ball_'.$class.''] == 4 || $_POST['ball_'.$class.''] == 5 || $_POST['ball_'.$class.''] == 6) { //二全中，二中特，特串
				if(count($arr) < 1 || count($arr) > 3) {
                    echo json_encode(array('code' => 1, 'info' => '请选择 1 - 3 个胆码！'));
                    exit;
				}
				for ($a=0;$a<count($arr);$a++){
					for ($b=0;$b<count($brr);$b++){
						$qw++;
						$wanfa =  $brr[$b].','.$arr[$a];

						$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
						$mysqli->query($sql) or die ("操作失败!!!");
						//jifen start
                        $id 	=	$mysqli->insert_id;
                        include_once("../../class/user.php");
                        $jifen=$web_site['jf_tzjf']*$money;
                        $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                        $about=$bet_info."<br>下注:$money 元";
                        $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
						//jifen end
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
			}
		}
	} else if($class == 12) { //合肖
		if(is_numeric(!$_POST['money'])){
            echo json_encode(array('code' => 1, 'info' => '参数错误，请重新下注！'));
            exit;
		}
		$zs = 64;
		$qiuhao = $ball_name['qiu_'.$class];
		$money = $_POST['money'];
		$edu = user_money($username,$money);
		if($edu == -1) {
            echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
            exit;
		}
		$ws = count($_POST['ball']);
		if($ws < 2 || $ws > 11) {
            echo json_encode(array('code' => 1, 'info' => '只能选择 2 - 11 个生肖！'));
            exit;
		}
		$wanfa = '';
		for( $i=0; $i<$ws-1; $i++){
			$sx = $_POST['ball'][$i]+$zs;
			$wanfa .= $ball_name['ball_'.$sx].',';
		}
		$ws1 = $_POST['ball'][$ws-1]+$zs;
		$wanfa .= $ball_name['ball_'.$ws1];
		//获取赔率
		$odds	= lottery_odds($_GET['type'],'ball_12',$ws-1);
		
		$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
		$mysqli->query($sql) or die ("操作失败!!!");
		//jifen start
		$id 	=	$mysqli->insert_id;
		include_once("../../class/user.php");
		$jifen=$web_site['jf_tzjf']*$money;
		$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
		$about=$bet_info."<br>下注:$money 元";
		$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
		//jifen end
        $tz_list[] = array(
            'orderId' => $id,
            'type'    => $qiuhao,
            'wanfa'   => $wanfa,
            'odds'    => $odds,
            'money'   => $money,
            'win'     => round($money * $odds, 2)
        );
        $allmoney += $money;
        $count++;
    } else if($class == 13 || $class == 14) { //生肖连，尾数连
		if(is_numeric(!$_POST['money'])){
            echo json_encode(array('code' => 1, 'info' => '参数错误，请重新下注！'));
            exit;
		}
		if($class == 13) {
			$zs = 64;
		}
		if($class == 14) {
			$zs = 76;
		}
		$qiuhao = $ball_name['qiu_'.$class.'_'.$_POST['ball_'.$class.'']];
		$qw = $zz = 0;//先定义循环注单数量与结算注单数量为0
		$ws = count($_POST['ball']);
		$money = $_POST['money'];
		if($_POST['ball_'.$class.''] == 4) { //五连
			if($ws < 5 || $ws > 6) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 5 - 6 个选项！'));
                exit;
			}
			$zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)/120;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 4 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws - 3 ; $b++ ){
					for ( $c= $b + 1 ; $c < $ws - 2 ; $c++ ){
						for ( $d = $c + 1 ; $d < $ws - 1 ; $d++ ){
							for ( $e = $d + 1 ; $e < $ws ; $e++ ){
								$qw++;
								$hm = array();
								$hm[] = $_POST['ball'][$a];
								$hm[] = $_POST['ball'][$b];
								$hm[] = $_POST['ball'][$c];
								$hm[] = $_POST['ball'][$d];
								$hm[] = $_POST['ball'][$e];
								$odds = six_odds($class,$_POST['ball_'.$class.''],$hm);
								$wanfa =  $ball_name['ball_'.($_POST['ball'][$a]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$b]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$c]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$d]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$e]+$zs).''];

								$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
								$mysqli->query($sql) or die ("操作失败!!!");
								//jifen start
								$id 	=	$mysqli->insert_id;
								include_once("../../class/user.php");
								$jifen=$web_site['jf_tzjf']*$money;
								$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
								$about=$bet_info."<br>下注:$money 元";
								$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
								//jifen end
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
					}
				}
			}
		}
		if($_POST['ball_'.$class.''] == 3) { //四连
			if($ws < 4 || $ws > 6) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 4 - 6 个选项！'));
                exit;
			}
			$zz = $ws*($ws-1)*($ws-2)*($ws-3)/24;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 3 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws - 2 ; $b++ ){
					for ( $c= $b + 1 ; $c < $ws - 1 ; $c++ ){
						for ( $d = $c + 1 ; $d < $ws ; $d++ ){
							$qw++;
							$hm = array();
							$hm[] = $_POST['ball'][$a];
							$hm[] = $_POST['ball'][$b];
							$hm[] = $_POST['ball'][$c];
							$hm[] = $_POST['ball'][$d];
							$odds = six_odds($class,$_POST['ball_'.$class.''],$hm);
							$wanfa =  $ball_name['ball_'.($_POST['ball'][$a]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$b]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$c]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$d]+$zs).''];

							$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
							$mysqli->query($sql) or die ("操作失败!!!");
							//jifen start
							$id 	=	$mysqli->insert_id;
							include_once("../../class/user.php");
							$jifen=$web_site['jf_tzjf']*$money;
							$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
							$about=$bet_info."<br>下注:$money 元";
							$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
							//jifen end
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
				}
			}
		}
		if($_POST['ball_'.$class.''] == 2) { //三连
			if($ws < 3 || $ws > 6) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 3 - 6 个选项！'));
                exit;
			}
			$zz = $ws*($ws-1)*($ws-2)/6;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 2 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws - 1 ; $b++ ){
					for ( $c= $b + 1 ; $c < $ws ; $c++ ){
						$qw++;
						$hm = array();
						$hm[] = $_POST['ball'][$a];
						$hm[] = $_POST['ball'][$b];
						$hm[] = $_POST['ball'][$c];
						$odds = six_odds($class,$_POST['ball_'.$class.''],$hm);
						$wanfa =  $ball_name['ball_'.($_POST['ball'][$a]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$b]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$c]+$zs).''];

						$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
						$mysqli->query($sql) or die ("操作失败!!!");
						//jifen start
                        $id 	=	$mysqli->insert_id;
                        include_once("../../class/user.php");
                        $jifen=$web_site['jf_tzjf']*$money;
                        $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                        $about=$bet_info."<br>下注:$money 元";
                        $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
						//jifen end
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
			}
		}
		if($_POST['ball_'.$class.''] == 1) { //二连
			if($ws < 2 || $ws > 6) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 2 - 6 个选项！'));
                exit;
			}
			$zz = $ws*($ws-1)/2;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 1 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws  ; $b++ ){
					$qw++;
					$hm = array();
					$hm[] = $_POST['ball'][$a];
					$hm[] = $_POST['ball'][$b];
					$odds = six_odds($class,$_POST['ball_'.$class.''],$hm);
					$wanfa =  $ball_name['ball_'.($_POST['ball'][$a]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$b]+$zs).''];

					$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
					$mysqli->query($sql) or die ("操作失败!!!");
					//jifen start
                    $id 	=	$mysqli->insert_id;
                    include_once("../../class/user.php");
                    $jifen=$web_site['jf_tzjf']*$money;
                    $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                    $about=$bet_info."<br>下注:$money 元";
                    $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
					//jifen end
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
		}
		
	} else if($class == 15) { //全不中投注
		if(is_numeric(!$_POST['money'])) {
            echo json_encode(array('code' => 1, 'info' => '参数错误，请重新下注！'));
            exit;
		}
		$qiuhao = $ball_name['qiu_15_'.$_POST['ball_15']];
		$qw = $zz = 0;//先定义循环注单数量与结算注单数量为0
		$ws = count($_POST['ball']);
		$money = $_POST['money'];
		$odds	= lottery_odds($_GET['type'],'ball_15',$_POST['ball_15']);
		if($_POST['ball_15'] == 1) { //五不中
			if($ws < 5 || $ws > 10) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 5 - 10 个号码！'));
                exit;
			}
			$zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)/120;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 4 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws - 3 ; $b++ ){
					for ( $c= $b + 1 ; $c < $ws - 2 ; $c++ ){
						for ( $d = $c + 1 ; $d < $ws - 1 ; $d++ ){
							for ( $e = $d + 1 ; $e < $ws ; $e++ ){
								$qw++;
								$wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e];

								$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
								$mysqli->query($sql) or die ("操作失败!!!");
								//jifen start
								$id 	=	$mysqli->insert_id;
								include_once("../../class/user.php");
								$jifen=$web_site['jf_tzjf']*$money;
								$bet_info="$qishu - $qiuhao - $wanfa @ $odds";
								$about=$bet_info."<br>下注:$money 元";
								$re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
								//jifen end
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
					}
				}
			}
		}
		if($_POST['ball_15'] == 2) { //六不中
			if($ws < 6 || $ws > 10) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 6 - 10 个号码！'));
                exit;
			}
			$zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)/720;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 5 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws - 4 ; $b++ ){
					for ( $c= $b + 1 ; $c < $ws - 3 ; $c++ ){
						for ( $d = $c + 1 ; $d < $ws - 2 ; $d++ ){
							for ( $e = $d + 1 ; $e < $ws - 1 ; $e++ ){
								for ( $f = $e + 1 ; $f < $ws ; $f++ ){
									$qw++;
									$wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f];

									$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
									$mysqli->query($sql) or die ("操作失败!!!");
									//jifen start
                                    $id 	=	$mysqli->insert_id;
                                    include_once("../../class/user.php");
                                    $jifen=$web_site['jf_tzjf']*$money;
                                    $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                                    $about=$bet_info."<br>下注:$money 元";
                                    $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
                                    //jifen end
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
						}
					}
				}
			}
		}
		if($_POST['ball_15'] == 3) { //七不中
			if($ws < 7 || $ws > 10) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 7 - 10 个号码！'));
                exit;
			}
			$zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)/5040;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 6 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws - 5 ; $b++ ){
					for ( $c= $b + 1 ; $c < $ws - 4 ; $c++ ){
						for ( $d = $c + 1 ; $d < $ws - 3 ; $d++ ){
							for ( $e = $d + 1 ; $e < $ws - 2 ; $e++ ){
								for ( $f = $e + 1 ; $f < $ws - 1 ; $f++ ){
									for ( $g = $f + 1 ; $g < $ws ; $g++ ){
										$qw++;
										$wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g];

										$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
										$mysqli->query($sql) or die ("操作失败!!!");
										//jifen start
                                        $id 	=	$mysqli->insert_id;
                                        include_once("../../class/user.php");
                                        $jifen=$web_site['jf_tzjf']*$money;
                                        $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                                        $about=$bet_info."<br>下注:$money 元";
                                        $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
                                        //jifen end
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
							}
						}
					}
				}
			}
		}
		if($_POST['ball_15'] == 4) { //八不中
			if($ws < 8 || $ws > 11) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 8 - 11 个号码！'));
                exit;
			}
			$zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)*($ws-7)/40320;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 7 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws - 6 ; $b++ ){
					for ( $c= $b + 1 ; $c < $ws - 5 ; $c++ ){
						for ( $d = $c + 1 ; $d < $ws - 4 ; $d++ ){
							for ( $e = $d + 1 ; $e < $ws - 3 ; $e++ ){
								for ( $f = $e + 1 ; $f < $ws - 2 ; $f++ ){
									for ( $g = $f + 1 ; $g < $ws - 1 ; $g++ ){
										for ( $h = $g + 1 ; $h < $ws ; $h++ ){
											$qw++;
											$wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g].','.$_POST['ball'][$h];

											$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
											$mysqli->query($sql) or die ("操作失败!!!");
											//jifen start
                                            $id 	=	$mysqli->insert_id;
                                            include_once("../../class/user.php");
                                            $jifen=$web_site['jf_tzjf']*$money;
                                            $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                                            $about=$bet_info."<br>下注:$money 元";
                                            $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
                                            //jifen end
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
								}
							}
						}
					}
				}
			}
		}
		if($_POST['ball_15'] == 5) { //九不中
			if($ws < 9 || $ws > 12) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 9 - 12 个号码！'));
                exit;
			}
			$zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)*($ws-7)*($ws-8)/362880;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 8 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws - 7 ; $b++ ){
					for ( $c= $b + 1 ; $c < $ws - 6 ; $c++ ){
						for ( $d = $c + 1 ; $d < $ws - 5 ; $d++ ){
							for ( $e = $d + 1 ; $e < $ws - 4 ; $e++ ){
								for ( $f = $e + 1 ; $f < $ws - 3 ; $f++ ){
									for ( $g = $f + 1 ; $g < $ws - 2 ; $g++ ){
										for ( $h = $g + 1 ; $h < $ws  - 1; $h++ ){
											for ( $i = $h + 1 ; $i < $ws ; $i++ ){
												$qw++;
												$wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g].','.$_POST['ball'][$h].','.$_POST['ball'][$i];

												$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
												$mysqli->query($sql) or die ("操作失败!!!");
												//jifen start
                                                $id 	=	$mysqli->insert_id;
                                                include_once("../../class/user.php");
                                                $jifen=$web_site['jf_tzjf']*$money;
                                                $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                                                $about=$bet_info."<br>下注:$money 元";
                                                $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
                                                //jifen end
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
									}
								}
							}
						}
					}
				}
			}
		}
		if($_POST['ball_15'] == 6) { //十不中
			if($ws < 10 || $ws > 13) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 10 - 13 个号码！'));
                exit;
			}
			$zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)*($ws-7)*($ws-8)*($ws-9)/3628800;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 9 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws - 8 ; $b++ ){
					for ( $c= $b + 1 ; $c < $ws - 7 ; $c++ ){
						for ( $d = $c + 1 ; $d < $ws - 6 ; $d++ ){
							for ( $e = $d + 1 ; $e < $ws - 5 ; $e++ ){
								for ( $f = $e + 1 ; $f < $ws - 4 ; $f++ ){
									for ( $g = $f + 1 ; $g < $ws - 3 ; $g++ ){
										for ( $h = $g + 1 ; $h < $ws  - 2; $h++ ){
											for ( $i = $h + 1 ; $i < $ws - 1 ; $i++ ){
												for ( $j = $i + 1 ; $j < $ws ; $j++ ){
													$qw++;
													$wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g].','.$_POST['ball'][$h].','.$_POST['ball'][$i].','.$_POST['ball'][$j];

													$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
													$mysqli->query($sql) or die ("操作失败!!!");
													//jifen start
                                                    $id 	=	$mysqli->insert_id;
                                                    include_once("../../class/user.php");
                                                    $jifen=$web_site['jf_tzjf']*$money;
                                                    $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                                                    $about=$bet_info."<br>下注:$money 元";
                                                    $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
                                                    //jifen end
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
										}
									}
								}
							}
						}
					}
				}
			}
		}
		if($_POST['ball_15'] == 7) { //十一不中
			if($ws < 11 || $ws > 13) {
                echo json_encode(array('code' => 1, 'info' => '只能选择 11 - 13 个号码！'));
                exit;
			}
			$zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)*($ws-7)*($ws-8)*($ws-9)*($ws-10)/39916800;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 10 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws - 9 ; $b++ ){
					for ( $c= $b + 1 ; $c < $ws - 8 ; $c++ ){
						for ( $d = $c + 1 ; $d < $ws - 7 ; $d++ ){
							for ( $e = $d + 1 ; $e < $ws - 6 ; $e++ ){
								for ( $f = $e + 1 ; $f < $ws - 5 ; $f++ ){
									for ( $g = $f + 1 ; $g < $ws - 4 ; $g++ ){
										for ( $h = $g + 1 ; $h < $ws  - 3 ; $h++ ){
											for ( $i = $h + 1 ; $i < $ws - 2 ; $i++ ){
												for ( $j = $i + 1 ; $j < $ws - 1 ; $j++ ){
													for ( $k = $j + 1 ; $k < $ws ; $k++ ){
														$qw++;
														$wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g].','.$_POST['ball'][$h].','.$_POST['ball'][$i].','.$_POST['ball'][$j].','.$_POST['ball'][$k];

														$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
														$mysqli->query($sql) or die ("操作失败!!!");
														//jifen start
                                                        $id 	=	$mysqli->insert_id;
                                                        include_once("../../class/user.php");
                                                        $jifen=$web_site['jf_tzjf']*$money;
                                                        $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                                                        $about=$bet_info."<br>下注:$money 元";
                                                        $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
                                                        //jifen end
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
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		if($_POST['ball_15'] == 8) { //十二不中
			if($ws < 12 || $ws > 14){
                echo json_encode(array('code' => 1, 'info' => '只能选择 12 - 14 个号码！'));
                exit;
			}
			$zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)*($ws-7)*($ws-8)*($ws-9)*($ws-10)*($ws-11)/479001600;
			$allmoney = $zz*$money;
			$edu = user_money($username,$allmoney);
			if($edu == -1) {
                echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
                exit;
			}
			for ( $a = 0 ; $a < $ws - 11 ; $a++ ){
				for ( $b = $a + 1 ; $b < $ws - 10 ; $b++ ){
					for ( $c= $b + 1 ; $c < $ws - 9 ; $c++ ){
						for ( $d = $c + 1 ; $d < $ws - 8 ; $d++ ){
							for ( $e = $d + 1 ; $e < $ws - 7 ; $e++ ){
								for ( $f = $e + 1 ; $f < $ws - 6 ; $f++ ){
									for ( $g = $f + 1 ; $g < $ws - 5 ; $g++ ){
										for ( $h = $g + 1 ; $h < $ws  - 4 ; $h++ ){
											for ( $i = $h + 1 ; $i < $ws - 3 ; $i++ ){
												for ( $j = $i + 1 ; $j < $ws - 2 ; $j++ ){
													for ( $k = $j + 1 ; $k < $ws - 1 ; $k++ ){
														for ( $l = $k + 1 ; $l < $ws ; $l++ ){
															$qw++;
															$wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g].','.$_POST['ball'][$h].','.$_POST['ball'][$i].','.$_POST['ball'][$j].','.$_POST['ball'][$k].','.$_POST['ball'][$l];

                                                            $sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs)";
															$mysqli->query($sql) or die ("操作失败!!!");
															//jifen start
                                                            $id 	=	$mysqli->insert_id;
                                                            include_once("../../class/user.php");
                                                            $jifen=$web_site['jf_tzjf']*$money;
                                                            $bet_info="$qishu - $qiuhao - $wanfa @ $odds";
                                                            $about=$bet_info."<br>下注:$money 元";
                                                            $re=user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
                                                            //jifen end
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
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}		
	} else {
		//判断会员账户额度是否大于总投注额度
		for ($i = 0; $i < count($datas); $i++) {
			$allmoney += $datas[''.$names[$i].''];
		}
		$edu = user_money($username, $allmoney);
		if($edu == -1) {
            echo json_encode(array('code' => 1, 'info' => '您的账户额度不足进行本次投注，请充值后在进行投注！'));
            exit;
		}
		for ($i = 0; $i < count($datas); $i++) {
			//分割键名，取ball_后的数字，来判断属于第几球
			$qiu	= explode("_",$names[$i]);
			$qiuhao = $ball_name['qiu_'.$qiu[1]];
			if( $qiu[1] == 9 ){
				$wanfa	= $ball_name_zh['ball_'.$qiu[2].''];
			}else if( $qiu[1] == 10 ){
				$wanfa	= $ball_name['ball_'.($qiu[2]+64).''];
				if( $qiu[2] > 12 ){
					$qiuhao = $ball_name['qiu_'.$qiu[1].'_2'];
				}else{
					$qiuhao = $ball_name['qiu_'.$qiu[1].'_1'];
				}
			}else{
				$wanfa	= $ball_name['ball_'.$qiu[2].''];
			}
			$money	= $datas[''.$names[$i].''];
			//获取赔率
			$odds	= lottery_odds($_GET['type'],'ball_'.$qiu[1],$qiu[2]);
			
			//特码A
			$sm = '';
            $fs = 0;
			if($qiu[1] == 7) {
                $sm='特码B';
            } elseif($qiu[1] == 16) {
				$sm = '特码A';
				$sql_fs		= "select h1 as ts from c_odds_0 where type='ball_18'";
				$query_fs		= $mysqli->query($sql_fs);
				$rs_fs = $query_fs->fetch_array();
				$fs = $money * $rs_fs['ts'] / 100;
			} elseif($qiu[1] == 8) {
                $sm = '正码B';
            } elseif($qiu[1] == 17) {
				$sm = '正码A';
				$sql_fs		= "select h2 as ts from c_odds_0 where type='ball_18'";
				$query_fs		= $mysqli->query($sql_fs);
				$rs_fs = $query_fs->fetch_array();
				$fs = $money * $rs_fs['ts'] / 100;
			}
			
			$sql	=	"insert into c_bet(uid,username,addtime,type,qishu,mingxi_1,mingxi_2,odds,money,win,fs,sm) values (".$uid.",'".$username."','".$l_time."','".$ball_name['name']."',".$qishu.",'".$qiuhao."','".$wanfa."',".$odds.",".$money.",".$money*$odds.",$fs,'".$sm."')";
			$mysqli->query($sql) or die ("操作失败!!!");
            //积分开始
			$id 	=	$mysqli->insert_id;
			include_once("../../class/user.php");
			$jifen = $web_site['jf_tzjf'] * $money;
			$bet_info = "$qishu - $qiuhao - $wanfa @ $odds";
			$about = $bet_info."<br>下注:$money 元";
			$re = user::jifen_add($uid,$id,$about,$jifen,1,$ball_name['name']);
            //积分结束
            $tz_list[] = array(
                'orderId' => $id,
                'type'    => $qiuhao . ($sm ? "($sm)" : ''),
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
}