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

$type = is_numeric($_GET['type']) ? $_GET['type'] : 2;
$game_name = get_gameName($type);
$game_smname = get_gamesmName($type);
switch($type) {
    case 2:
        $g_t = 0;
        break;
    case 7:
        $g_t = 1;
        break;
    case 14:
        $g_t = 2;
        break;
		  case 20:
        $g_t = 3;
        break;
		  case 21:
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
                <th colspan="5">开出号码</th>
                <th colspan="3">总和</th>
                <th>龙虎</th>
                <th>前三</th>
                <th>中三</th>
                <th>后三</th>
            </tr>
            
            </thead>
<tbody>
            
            <?php
                $date = date('Y-m-d', $lottery_time) . ' 00:00:00';
                $sql = "select id from c_auto_$type  order by qishu desc limit 120 ";
			
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
            ?>
                        <tr class="list">
                            <td><?=$row['qishu']?></td>
                            <td><?=date('m-d H:i', strtotime($row['datetime']))?></td>
                            <td class="ssc" width="50"><em class="n_<?=$row['ball_1']?>"></em></td>
                            <td class="ssc" width="50"><em class="n_<?=$row['ball_2']?>"></em></td>
                            <td class="ssc" width="50"><em class="n_<?=$row['ball_3']?>"></em></td>
                            <td class="ssc" width="50"><em class="n_<?=$row['ball_4']?>"></em></td>
                            <td class="ssc" width="50"><em class="n_<?=$row['ball_5']?>"></em></td>
                            <td width="50"><?=Ssc_Auto($hm,1)?></td>
                            <td<?=Ssc_Auto($hm,2) == '大' ? ' class="red"' : ''?> width="50"><?=Ssc_Auto($hm,2)?></td>
                            <td<?=Ssc_Auto($hm,3) == '双' ? ' class="red"' : ''?> width="50"><?=Ssc_Auto($hm,3)?></td>
                            <td<?=Ssc_Auto($hm,4) == '龙' || Ssc_Auto($hm,4) == '和' ? ' class="red"' : ''?> width="50"><?=Ssc_Auto($hm,4)?></td>
                            <td width="50"><?=Ssc_Auto($hm,5)?></td>
                            <td width="50"><?=Ssc_Auto($hm,6)?></td>
                            <td width="50"><?=Ssc_Auto($hm,7)?></td>
                        </tr>
            <?php
                    }
                }
            ?>
            <thead><tr>
                <th colspan="14"><?php echo $pageStr; ?></th>
            </tr></thead>
     </tbody></table>
        </table>
    </div>
    <?php include_once('r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>