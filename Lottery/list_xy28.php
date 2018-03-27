<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../include/pager.class.php");
include_once("../common/login_check.php");
include_once("../include/lottery.inc.php");
include("include/auto_class5.php");
include ("include/order_info.php");

$type = is_numeric($_GET['type']) ? $_GET['type'] : 12;
$game_name = get_gameName($type);
switch($type) {
    case 12:
        $g_t = 11;
        break;
    case 13:
        $g_t = 12;
        break;
}
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
    <link type="text/css" rel="stylesheet" href="Css/ssc.css"/>
    <link rel="stylesheet" type="text/css" href="/default/css/g_PCEGG.css" />
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
<thead> <tr class="tit">
                <th width="100">期数</th>
                <th width="100">开奖时间</th>
                <th width="310">开出号码</th>
                <th colspan="6">属性</th>
            </tr></thead>
<tbody>
            <?php
            $date = date('Y-m-d', $lottery_time - 6 * 24 * 3600) . ' 00:00:00';
            $sql = "select id from c_auto_$type where datetime>='$date' order by qishu desc";
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
                    $hm = array();
                    $hm[] = $row['ball_1'];
                    $hm[] = $row['ball_2'];
                    $hm[] = $row['ball_3'];
                    $hm[] = $row['ball_4'];
                    $qiu = "<em class='n_$row[ball_1]'></em> + <em class='n_$row[ball_2]'></em> + <em class='n_$row[ball_3]'></em> = <em class='n_$row[ball_4]'></em>";
                    $bs = Ssc_Auto($hm, 6);
                    if($bs == '绿') {
                        $color = ' class="green"';
                    } elseif($bs == '蓝') {
                        $color = ' class="blue"';
                    } elseif($bs == '红') {
                        $color = ' class="red"';
                    } else {
                        $color = '';
                    }
                    ?>
                    <tr class="list">
                        <td><?=$row['qishu']?></td>
                        <td><?=date('m-d H:i', strtotime($row['datetime']))?></td>
                        <td class="xy28" style="padding: 1px 0"><?=$qiu?></td>
                        <td width="65"<?=Ssc_Auto($hm, 2) == '大' ? ' class="red"' : ''?>><?=Ssc_Auto($hm, 2)?></td>
                        <td width="65"<?=Ssc_Auto($hm, 3) == '双' ? ' class="red"' : ''?>><?=Ssc_Auto($hm, 3)?></td>
                        <td width="65"<?=Ssc_Auto($hm, 4) == '大双' || Ssc_Auto($hm, 4) == '大单' ? ' class="red"' : ''?>><?=Ssc_Auto($hm, 4)?></td>
                        <td width="65"<?=Ssc_Auto($hm, 5) == '极大' ? ' class="red"' : ''?>><?=Ssc_Auto($hm, 5)?></td>
                        <td width="65"<?=$color?>><?=Ssc_Auto($hm, 6)?></td>
                        <td width="65"<?=Ssc_Auto($hm, 7) == '豹子' ? ' class="red"' : ''?>><?=Ssc_Auto($hm, 7)?></td>
                    </tr>
                    <?php
                }
            }
            ?>
          <thead><tr>
                <th colspan="9"><?php echo $pageStr; ?></th>
            </tr></thead>
     </tbody></table>
    </div>
    <?php include_once('r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>