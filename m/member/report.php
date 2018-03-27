<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     	= 	$_SESSION['uid'];
$loginid 	= 	$_SESSION['user_login_id'];
$username	=	$_SESSION["username"];
renovate($uid,$loginid);

$arr_ds	=	array(); //单式
$arr_fc	=	array(); //单式
$arr_cg	=	array(); //串关
$arr_ck	=	array(); //存款
$arr_hk	=	array(); //汇款
$arr_qk	=	array(); //取款
$arr_zrzr	=	array(); //真人转入
$arr_zrzc	=	array(); //真人转出
$total  =   0;
$tytz=$cgtz=$cptz=0;
$tyyl=$cgyl=$cpyl=$zyl=0;
$zrzr=$zrzc=0;
$ck=$hk=$qk=0;

//默认显示1周
$week	=	6;
$ts		=	0; //退水
if(@$_GET['week']==2) $week	=	13;
$stime	=	date("Y-m-d",time()); //今天日期
$etime	=	date("Y-m-d",strtotime("$stime -$week day")); //前 $week 天日期

$sql	=	"select bet_money,win,status,bet_time,fs from k_bet where status<>0 and uid=$uid and bet_time<='".$stime." 23:59:59' and bet_time>='".$etime." 00:00:00' order by bet_time asc"; //单式
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	
	$tytz += $rows['bet_money'];
	$arr_ds['tz'][substr($rows['bet_time'],0,10)]+=$rows['bet_money'];
	$ts		=	$rows['fs'];
	if($rows['status']=="1" || $rows['status']=="4"){ //赢和赢一半都算赢
		$arr_ds['y'][substr($rows['bet_time'],0,10)]+=$rows['win']-$rows['bet_money']+$ts; //净赢金额不包括本金
		$zyl+=$rows['win']-$rows['bet_money']+$ts;
	}elseif($rows['status']=="2" || $rows['status']=="5"){ //输和输一半都算输
		$arr_ds['s'][substr($rows['bet_time'],0,10)]+=abs($rows['win']-$rows['bet_money'])-$ts; //净输金额不包括已赢金额
	}elseif($rows['status']=="6" || $rows['status']=="7" || $rows['status']=="8"){ //平手和无效都算取消
		$arr_ds['qx'][substr($rows['bet_time'],0,10)]+=$rows['bet_money'];
	}
}

$sql	=	"select * from c_bet where js<>0 and uid=$uid and addtime<='".$stime." 23:59:59' and addtime>='".$etime." 00:00:00' order by addtime asc"; //单式
//echo $sql;
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	$cptz += $rows['money'];
	$arr_fc['tz'][substr($rows['addtime'],0,10)]+=$rows['money'];
	$ts		=	$rows['fs'];
	if($rows['js']=="1" && $rows['win']>0){ //赢和赢一半都算赢
		$win=$rows["win"]>0 ? $rows["win"]-$rows["money"] : $rows["win"];
		$arr_fc['y'][substr($rows['addtime'],0,10)]+=$win+$ts; //净赢金额不包括本金
		$zyl+=$rows['win']-$rows['money']+$ts;
	}elseif($rows['js']=="1" && $rows['win']<0){ //输和输一半都算输
		$arr_fc['s'][substr($rows['addtime'],0,10)]+=abs($rows['win'])-$ts; //净输金额不包括已赢金额
	}else{ //平手和无效都算取消
		$arr_fc['qx'][substr($rows['addtime'],0,10)]+=$rows['money'];
	}
}


$sql	=	"select bet_money,win,status,bet_time,fs from k_bet_cg_group where status<>0 and uid=$uid and bet_time<'".$stime." 23:59:59' and bet_time>'".$etime." 00:00:00' order by bet_time asc"; //串关
//echo $sql;
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	$cgtz += $rows['bet_money'];
	$arr_cg['tz'][substr($rows['bet_time'],0,10)]+=$rows['bet_money'];
	if($rows['status']=="1"){ //输跟赢
		$ts		=	$rows['fs'];
		if($rows['win']>0){ //赢
			$zyl+=$rows['win']-$rows['bet_money']+$ts;
			$arr_cg['y'][substr($rows['bet_time'],0,10)]+=$rows['win']-$rows['bet_money']+$ts; //净赢金额不包括本金
		}else{ //输
			$arr_cg['s'][substr($rows['bet_time'],0,10)]+=$rows['bet_money']-$ts;
		}
	}elseif($rows['status']=="3"){ //平手和无效都算取消
		$arr_cg['qx'][substr($rows['bet_time'],0,10)]+=$rows['bet_money'];
	}
}

$sql	=	"select m_value,m_make_time as bet_time from k_money where uid=$uid and `status`>0 and m_make_time<'".$stime." 23:59:59' and m_make_time>'".$etime." 00:00:00' order by m_make_time asc"; //存取款，只显示成功和处理中的
//echo $sql;exit;
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	if($rows['m_value']<0){ //取款
		$ck += abs($rows['m_value']);
		$arr_qk[substr($rows['bet_time'],0,10)]+=abs($rows['m_value']);
	}else{ //存款
		$ck += abs($rows['m_value']);
		$arr_ck[substr($rows['bet_time'],0,10)]+=$rows['m_value'];
	}
}

$sql	=	"select money,zsjr,`date` from `huikuan` where uid=$uid and `status`<2 and `date`<'".$stime." 23:59:59' and `date`>'".$etime." 00:00:00' order by `date` asc"; //汇款，只显示成功和处理中的
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	$hk += $rows['money']+$rows['zsjr'];
	$arr_hk[substr($rows['date'],0,10)]+=$rows['money']+$rows['zsjr'];
}

//zhenren
$sql	=	"select zz_money,zz_type,`zz_time` from `ag_zhenren_zz` where uid=$uid and `ok`=1 and `zz_time`<'".$stime." 23:59:59' and `zz_time`>'".$etime." 00:00:00' order by `zz_time` asc";
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	if($rows['zz_type']=='d'){ //真人转入
		$arr_zrzr[substr($rows['zz_time'],0,10)] += $rows['zz_money'];
	}elseif($rows['zz_type']=='w'){ //真人出
		$arr_zrzc[substr($rows['zz_time'],0,10)] += $rows['zz_money'];
	}
}


function getWeek($num){
	$s	=	'';
	switch ($num) {
    	case 0:	
			$s	=	'天';
			break;
    	case 1:	
			$s	=	'一';
			break;
    	case 2:	
			$s	=	'二';
			break;
    	case 3:	
			$s	=	'三';
			break;
    	case 4:	
			$s	=	'四';
			break;
    	case 5:	
			$s	=	'五';
			break;
    	case 6:	
			$s	=	'六';
			break;
	}
	return $s;
}

$t_day = date('Y-m-d');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>账户历史统计报表</title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Lottery/Css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="images/member.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <style type="text/css">
        .list a{color: #000}
        font:hover{color: #900}
        .week_btn{background-color: #eaeaea; border: 1px solid #acacac; border-radius: 2px; cursor: pointer; padding: 8px}
        .week_btn:hover{background-color: #eaf3fc; border: 1px solid #7eb4ea}
    </style>
    <script type="text/javascript">
        function url(url) {
            location.href = url;
        }
    </script>
</head>
<body mode="gm">
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>会员中心</span>
            <a class="f_r" href="#type">游戏</a>
        </div>
        <?php include_once('../Lottery/u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span></span>
                    <?php include_once('../Lottery/gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="wrap">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                <tr class="tic">
                    <td width="20%">日期</td>
                   <!-- <td width="20%">体育</td>
                    <td width="20%">过关</td>-->
                    <td width="20%">彩票</td>
                    <td width="20%">总盈利</td>
                </tr>
                <?php
                for($i=0;$i<=$week;$i++) {
                    $time	=	date("Y-m-d",strtotime("$stime -$i day")); //前 $i 天日期
                    $m_time =   date("m-d",strtotime("$stime -$i day"));

                  /*  $ds_y	=	double_format($arr_ds['y'][$time]);
                    $ds_s	=	double_format($arr_ds['s'][$time]);
                    $ds_qx	=	double_format($arr_ds['qx'][$time]);
                    $ds_tz	=	double_format($arr_ds['tz'][$time]);*/

                    $fc_y	=	double_format($arr_fc['y'][$time]);
                    $fc_s	=	double_format($arr_fc['s'][$time]);
                    $fc_qx	=	double_format($arr_fc['qx'][$time]);
                    $fc_tz	=	double_format($arr_fc['tz'][$time]);

                  /*  $cg_y	=	double_format($arr_cg['y'][$time]);
                    $cg_s	=	double_format($arr_cg['s'][$time]);
                    $cg_qx	=	double_format($arr_cg['qx'][$time]);
                    $cg_tz	=	double_format($arr_cg['tz'][$time]);*/

                    $ck		=	double_format($arr_ck[$time]);
                    $hk		=	double_format($arr_hk[$time]);
                    $qk		=

                  $zrzr=double_format($arr_zrzr[$time]);
                    $zrzc=double_format($arr_zrzc[$time]);
                    $yk		=	double_format($ds_y-$ds_s+$fc_y-$fc_s+$cg_y-$cg_y+$cg_y-$cg_s);
                    ?>
                    <tr class="list f_12">
                        <td><?=$m_time?><br>星期<?=getWeek(date("w",time()-$i*86400))?></td>
                       <!-- <td>
                            <a href="javascript:void(0);" onclick="url('cha_ty.php?rad=ygsds&cn_begin=<?=$time?>&cn_end=<?=$time?>&t=y')"><?=$ds_tz?></a>
                            <hr>
                            <a href="javascript:void(0);" onclick="url('cha_ty.php?rad=ygsds&cn_begin=<?=$time?>&cn_end=<?=$time?>&t=y')"><?=getcolor($ds_y-$ds_s)?></a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" onclick="url('cha_gg.php?rad=ygsds&cn_begin=<?=$time?>&cn_end=<?=$time?>&t=y')"><?=$cg_tz?></a>
                            <hr>
                            <a href="javascript:void(0);" onclick="url('cha_gg.php?rad=ygsds&cn_begin=<?=$time?>&cn_end=<?=$time?>&t=y')"><?=getcolor($cg_y-$cg_s)?></a>
                        </td>-->
                        <td>
                            <a href="javascript:void(0);" onclick="url('cha_cp.php?rad=ygsds&cn_begin=<?=$time?>&cn_end=<?=$time?>&t=y')"><?=$fc_tz?></a>
                            <hr>
                            <a href="javascript:void(0);" onclick="url('cha_cp.php?rad=ygsds&cn_begin=<?=$time?>&cn_end=<?=$time?>&t=y')"><?=getcolor($fc_y-$fc_s)?></a>
                        </td>
                        <td><span class="c_blue"><?=getcolor($yk)?></span></td>
                    </tr>
                <?php
                }
               /* $ds_y	=	double_format($arr_ds['y']==null?0:array_sum($arr_ds['y']));
                $ds_s	=	double_format($arr_ds['s']==null?0:array_sum($arr_ds['s']));
                $ds_qx	=	double_format($arr_ds['qx']==null?0:array_sum($arr_ds['qx']));
                $ds_tz	=	double_format($arr_ds['y']==null?0:array_sum($arr_ds['tz']));*/

                $fc_y	=	double_format($arr_fc['y']==null?0:array_sum($arr_fc['y']));
                $fc_s	=	double_format($arr_fc['s']==null?0:array_sum($arr_fc['s']));
                $fc_qx	=	double_format($arr_fc['qx']==null?0:array_sum($arr_fc['qx']));
                $fc_tz	=	double_format($arr_fc['tz']==null?0:array_sum($arr_fc['tz']));

               /* $cg_y	=	double_format($arr_cg['y']==null?0:array_sum($arr_cg['y']));
                $cg_s	=	double_format($arr_cg['s']==null?0:array_sum($arr_cg['s']));
                $cg_qx	=	double_format($arr_cg['qx']==null?0:array_sum($arr_cg['qx']));
                $cg_tz	=	double_format($arr_cg['tz']==null?0:array_sum($arr_cg['tz']));*/

                $ck		=	double_format($arr_ck==null?0:array_sum($arr_ck));
                $hk		=	double_format($arr_hk==null?0:array_sum($arr_hk));
                $qk		=	double_format($arr_qk==null?0:array_sum($arr_qk));
                $yk		=	double_format($ds_y-$ds_s+$fc_y-$fc_s+$cg_y-$cg_y+$cg_y-$cg_s);

               $zrzr		=	double_format($arr_zrzr==null?0:array_sum($arr_zrzr));
                $zrzc		=	double_format($arr_zrzc==null?0:array_sum($arr_zrzc));
                ?>
                <tr class="tic">
                    <td>小结</td>
                 <!--   <td><?=$ds_tz?><hr><?=($ds_y-$ds_s)?></td>
                    <td><?=$cg_tz?><hr><?=($cg_y-$cg_s)?></td>-->
                    <td><?=$fc_tz?><hr><?=($fc_y-$fc_s)?></td>
                    <td><?=$yk?></td>
                </tr>
            </table>
            <div class="mt10" style="text-align: right">
                <button class="week_btn" type="button" onclick="url('report.php?week=<?=$_GET['week']==2 ? '1' : '2'?>')">显示<?=$_GET['week']==2 ? '一' : '两'?>周</button>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>