<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../include/pager.class.php");
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../include/lottery.inc.php");
include ("include/auto_class.php");
include ("include/order_info.php");

$type = is_numeric($_GET['type']) ? $_GET['type'] : 9;
$game_name = get_gameName($type);
$game_smname = get_gamesmName($type);
switch($type) {
    case 9:
        $g_t = 8;
        break;
    case 10:
        $g_t = 9;
        break;
}
if($_REQUEST['page'] == '') {
    $_REQUEST['page'] = 1;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$game_name?>开奖结果</title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="Css/ssc.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
</head>
<body mode="gm">
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>历史开奖</span>
            <a class="f_r" href="#type">游戏</a>
        </div>
        <?php include_once('u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span></span>
                    <?php include_once('gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="kj_jl">
            <?php include_once('list_type.php') ?>
            <table cellspacing="0" cellpadding="0" border="0" class="tb_list">
                <tr class="tit">
                    <td width="88">期数</td>
                    <td>开出号码</td>
                </tr>
                <?php
                    if($type == 10) {
                        $qh = date('y', $lottery_time) . '001';
                    } else {
                        $qh = date('Y', $lottery_time) . '001';
                    }
                    $sql = "select id from c_auto_$type where qishu>='$qh' order by qishu desc";
                    $query = $mysqli->query($sql);
                    $sum = $mysqli->affected_rows;
                    $pagenum = 15;
                    $CurrentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $myPage = new pager($sum, intval($CurrentPage), $pagenum);
                    $pageStr = $myPage->GetPagerContent();
                    $id = '';
                    $i = 1;
                    $start = ($CurrentPage - 1) * $pagenum + 1;
                    $end = $CurrentPage * $pagenum;
                    while($row = $query->fetch_array()) {
                        if($i >= $start && $i <= $end) {
                            $id .= $row['id'] . ',';
                        }
                        if($i > $end) break;
                        $i++;
                    }
                    if($id) {
                        $id	= rtrim($id, ',');
                        $sql = "select * from c_auto_$type where id in($id) order by qishu desc";
                        $query = $mysqli->query($sql);
                        while($row = $query->fetch_array()) {
                            $hm 		= array();
                            $hm[]		= $row['ball_1'];
                            $hm[]		= $row['ball_2'];
                            $hm[]		= $row['ball_3'];
                            $zh_dx      = str_replace('总和', '', FC3D_Auto($hm, 7));
                            $zh_ds      = str_replace('总和', '', FC3D_Auto($hm, 8));
                            $qiu = '';
                            for($n = 1; $n <= 3; $n++) {
                                $qiu .= '<em class="v_m n_' . $row['ball_' . $n] . '"></em>';
                            }
                            ?>
                            <tr class="list">
                                <td><?=$row['qishu']?></td>
                                <td class="ssc"><?=$qiu?></td>
                            </tr>
                            <?php
                        }
                    }
                ?>
                <tr>
                    <td colspan="2"><?php echo $pageStr; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>