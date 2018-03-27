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
include ("../glpage/cj/lottery/auto_class24.php");

$type = is_numeric($_GET['type']) ? $_GET['type'] : 25;
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
                
                <th width="200">庄牌</th>
                <th >庄</th>
                <th>天</th>
                <th>地</th>
                <th>玄</th>
                <th>黄</th>
            </tr>
            
            </thead>
<tbody>
            
            <?php
                $date = date('Y-m-d', $lottery_time - 6 * 24 * 3600) . ' 00:00:00';
                $sql = "select id from c_auto_25 where datetime>='$date' order by qishu desc";
	
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
                    $sql = "select * from c_auto_25 where id in($id) order by qishu desc";
                    $query = $mysqli->query($sql);
                    while($row = $query->fetch_array()) {
                        $hm = array();
                        $hm[] = $row['ball_1'];
                        $hm[] = $row['ball_2'];
                        $hm[] = $row['ball_3'];
                        $hm[] = $row['ball_4'];
                        $hm[] = $row['ball_5'];
	$zarr1=explode(',',$row['ball_1']);				
$zhm	= niuniu($row['ball_1']);
$thm	= niuniu($row['ball_2']);
$dhm	= niuniu($row['ball_3']);
$xhm	= niuniu($row['ball_4']);
$hhm	= niuniu($row['ball_5']);
$zarr=explode('-',$zhm);
$tarr=explode('-',$thm);
$darr=explode('-',$dhm);
$xarr=explode('-',$xhm);
$harr=explode('-',$hhm);
						
            ?>
                        <tr class="list">
                            <td><?=$row['qishu']?></td>
                            <td><?=date('m-d H:i', strtotime($row['datetime']))?></td>
                          
                            <td class="poker-codes" width="50"><em class="poker_<?=$zarr1[0]?>"></em>
                           <em class="poker_<?=$zarr1[1]?>"></em>
                            <em class="poker_<?=$zarr1[2]?>"></em>
                            <em class="poker_<?=$zarr1[3]?>"></em>
                            <em class="poker_<?=$zarr1[4]?>"></em></td>
                            <td width="50"><?=mingcheng(intval($zarr[0]))?></td>
                            <td width="50"><?=mingcheng(intval($tarr[0]))?></td>
                             <td width="50"><?=mingcheng(intval($darr[0]))?></td>
                            <td width="50"><?=mingcheng(intval($xarr[0]))?></td>
                             <td width="50"><?=mingcheng(intval($harr[0]))?></td>
                         
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