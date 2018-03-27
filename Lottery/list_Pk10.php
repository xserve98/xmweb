<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../include/pager.class.php");
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../include/lottery.inc.php");
include ("include/auto_class4.php");
include ("include/order_info.php");

$type = is_numeric($_GET['type']) ? $_GET['type'] : 4;
$game_name = get_gameName($type);
$game_smname = get_gamesmName($type);
switch($type) {
    case 4:
        $g_t = 3;
        break;
    case 8:
        $g_t = 4;
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
    <link type="text/css" rel="stylesheet" href="css/ssc.css"/>
    <link rel="stylesheet" type="text/css" href="/newdsn/css/table.css?id=3498000221" />
<link rel="stylesheet" type="text/css" href="/newdsn/css/g_PK10.css" />
<link rel="stylesheet" type="text/css" href="/js/jquery/ui-lightness/jquery-ui.css" />
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
<thead><tr><th>期数</th><th>开奖时间</th><th colspan="10">开出号码</th><th colspan="3" class="strong">冠亚军和</th><th colspan="5" class="strong">1～5 龙虎</th></tr></thead>
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
                        $hm[] = $row['ball_5'];
                        $hm[] = $row['ball_6'];
                        $hm[] = $row['ball_7'];
                        $hm[] = $row['ball_8'];
                        $hm[] = $row['ball_9'];
                        $hm[] = $row['ball_10'];
                        ?>
                        <tr class="list">
                            <td><?=$row['qishu']?></td>
                            <td><?=date('m-d H:i', strtotime($row['datetime']))?></td>
                            <td class="pk10"><em class="n_<?=$row['ball_1']?>"></em></td>
                            <td class="pk10"><em class="n_<?=$row['ball_2']?>"></em></td>
                            <td class="pk10"><em class="n_<?=$row['ball_3']?>"></em></td>
                            <td class="pk10"><em class="n_<?=$row['ball_4']?>"></em></td>
                            <td class="pk10"><em class="n_<?=$row['ball_5']?>"></em></td>
                            <td class="pk10"><em class="n_<?=$row['ball_6']?>"></em></td>
                            <td class="pk10"><em class="n_<?=$row['ball_7']?>"></em></td>
                            <td class="pk10"><em class="n_<?=$row['ball_8']?>"></em></td>
                            <td class="pk10"><em class="n_<?=$row['ball_9']?>"></em></td>
                            <td class="pk10"><em class="n_<?=$row['ball_10']?>"></em></td>
                            <td width="35"><?=Ssc_Auto($hm,1)?></td>
                            <td width="35"<?=Ssc_Auto($hm,2) == '大' ? ' class="red"' : ''?>><?=Ssc_Auto($hm,2)?></td>
                            <td width="35"<?=Ssc_Auto($hm,3) == '双' ? ' class="red"' : ''?>><?=Ssc_Auto($hm,3)?></td>
                            <td width="35"<?=Ssc_Auto($hm,4) == '龙' ? ' class="blue"' : ''?>><?=Ssc_Auto($hm,4)?></td>
                            <td width="35"<?=Ssc_Auto($hm,5) == '龙' ? ' class="blue"' : ''?>><?=Ssc_Auto($hm,5)?></td>
                            <td width="35"<?=Ssc_Auto($hm,6) == '龙' ? ' class="blue"' : ''?>><?=Ssc_Auto($hm,6)?></td>
                            <td width="35"<?=Ssc_Auto($hm,7) == '龙' ? ' class="blue"' : ''?>><?=Ssc_Auto($hm,7)?></td>
                            <td width="35"<?=Ssc_Auto($hm,8) == '龙' ? ' class="blue"' : ''?>><?=Ssc_Auto($hm,8)?></td>
                        </tr>
            <?php
                    }
                }
            ?>
           
            
            <thead><tr>
                <th colspan="20"><?php echo $pageStr; ?></th>
            </tr></thead>
     </tbody></table>
    </div>
    <?php include_once('r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>