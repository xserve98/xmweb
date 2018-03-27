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

$type = 1;
$game_name = get_gameName($type);
$game_smname = get_gamesmName($type);
$g_t = 7;
if($_REQUEST['page'] == '') {
    $_REQUEST['page'] = 1;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?=$game_name?>开奖结果</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link type="text/css" rel="stylesheet" href="css/ssc.css"/>
    <link rel="stylesheet" type="text/css" href="/newdsn/css/g_KL8.css" />
<link rel="stylesheet" type="text/css" href="/js/jquery/ui-lightness/jquery-ui.css" />
            <link rel="stylesheet" type="text/css" href="/newdsn/css/table.css?id=3498000221" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" src="/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/default/js/skin.js"></script>
</head>
<body>
    <div class="kj_jl">
        <?php include_once('list_type.php') ?>
<table class="list table_ball table">
<thead><tr class="tit">

                 <th width="100">期数</th>
                <th width="100">开奖时间</th>
                <th width="300">开出号码</th>
                <th colspan="3">总和</th>
                <th>上中下</th>
                <th>奇和偶</th>
        
            </tr></thead>
<tbody>
            <?php
                $date = date('Y-m-d', $lottery_time - 6 * 24 * 3600) . ' 00:00:00';
                $sql = "select id from c_auto_$type where datetime>='$date' order by qishu desc";
                $query = $mysqli->query($sql);
                $sum = $mysqli->affected_rows;
                $pagenum = 10;
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
                        $hm[]		= $row['ball_4'];
                        $hm[]		= $row['ball_5'];
                        $hm[]		= $row['ball_6'];
                        $hm[]		= $row['ball_7'];
                        $hm[]		= $row['ball_8'];
                        $hm[]		= $row['ball_9'];
                        $hm[]		= $row['ball_10'];
                        $hm[]		= $row['ball_11'];
                        $hm[]		= $row['ball_12'];
                        $hm[]		= $row['ball_13'];
                        $hm[]		= $row['ball_14'];
                        $hm[]		= $row['ball_15'];
                        $hm[]		= $row['ball_16'];
                        $hm[]		= $row['ball_17'];
                        $hm[]		= $row['ball_18'];
                        $hm[]		= $row['ball_19'];
                        $hm[]		= $row['ball_20'];
                        $zh_dx      = str_replace('总和', '', Kl8_Auto($hm, 1));
                        $zh_ds      = str_replace('总和', '', Kl8_Auto($hm, 2));
                        ?>
                        <tr class="list">
                            <td><?=$row['qishu']?></td>
                            <td><?=date('m-d H:i', strtotime($row['datetime']))?></td>
                            <td class="kl8">
                                <?php
                                    $str = '';
                                    for($j = 1; $j <= 20; $j++) {
                                        $qh = $row['ball_' . $j];
                                        $str .= "<em class='n_$qh'></em>";
                                        if($j == 10) {
                                            $str .= "<br>";
                                        }
                                    }
                                    echo $str;
                                ?>
                            </td>
                            <td width="60"><?=Kl8_Auto($hm,0)?></td>
                            <td width="60"<?=$zh_dx == '大' ? ' class="red"' : ''?>><?=$zh_dx?></td>
                            <td width="60"<?=$zh_ds == '双' ? ' class="red"' : ''?>><?=$zh_ds?></td>
                            <td width="60"><?=Kl8_Auto($hm, 3)?></td>
                            <td width="60"><?=Kl8_Auto($hm, 4)?></td>
                        </tr>
            <?php
                    }
                }
            ?>
             <thead><tr>
                <th colspan="8"><?php echo $pageStr; ?></th>
            </tr></thead>
     </tbody></table>
    </div>
    <?php include_once('r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>