<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../include/pager.class.php");
include_once("../common/login_check.php");
include_once("../include/lottery.inc.php");
include("class/auto_class.php");

$g_t = 10;
if($_REQUEST['page'] == '') {
    $_REQUEST['page'] = 1;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>极速六合彩开奖结果</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link type="text/css" rel="stylesheet" href="../Lottery/css/ssc.css"/>
        
    <link rel="stylesheet" type="text/css" href="/js/jquery/ui-lightness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="/newdsn/css/table.css?id=3498000221" />
<link rel="stylesheet" type="text/css" href="/newdsn/css/g_HK6.css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" src="/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/default/js/skin.js"></script>
</head>
<body>
    <div class="kj_jl">
        <?php include_once('../Lottery/list_type.php') ?>
                       <table class="list table_ball table">
<thead> <tr class="tit">
                  <th width="100">期数</th>
                <th width="100">开奖时间</th>
                <th width="300" colspan="6">平码</th>
                <th>特码</th>
                <th>生肖</th>
                <th>总分</th>
            </tr></thead>
<tbody>
            <?php
               $date = date('Y-m-d', $lottery_time - 6 * 24 * 3600) . ' 00:00:00';
               $sql = "select id from c_auto_22 where datetime>='$date' order by qishu desc";
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
                    $sql = "select * from c_auto_22 where id in($id) order by id desc";
                    $query = $mysqli->query($sql);
                    while($row = $query->fetch_array()) {
                        $tm_sx = Get_ShengXiao($row['ball_7']);
                        $zh = $row['ball_1'] + $row['ball_2'] + $row['ball_3'] + $row['ball_4'] + $row['ball_5'] + $row['ball_6'] + $row['ball_7'];
                        ?>
                        <tr class="list">
                            <td><?=$row['qishu']?></td>
                            <td><?=date('m-d H:i', strtotime($row['datetime']))?></td>
                            <td class="six"><em class="n_<?=$row['ball_1']?>"></em></td>
                            <td class="six"><em class="n_<?=$row['ball_2']?>"></em></td>
                            <td class="six"><em class="n_<?=$row['ball_3']?>"></em></td>
                            <td class="six"><em class="n_<?=$row['ball_4']?>"></em></td>
                            <td class="six"><em class="n_<?=$row['ball_5']?>"></em></td>
                            <td class="six"><em class="n_<?=$row['ball_6']?>"></em></td>
                            <td class="six" width="100"><em class="n_<?=$row['ball_7']?>"></em></td>
                            <td width="100"><?=$tm_sx?></td>
                            <td width="100"><?=$zh?></td>
                        </tr>
                        <?php
                    }
                }
            ?>
            <thead><tr>
                <th colspan="11"><?php echo $pageStr; ?></th>
            </tr></thead>
     </tbody></table>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>