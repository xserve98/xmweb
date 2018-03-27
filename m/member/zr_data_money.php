<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("function.php");
include_once("../cache/website.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$userinfo=user::getinfo($_SESSION["uid"]);

$cn_begin=$_GET["cn_begin"];
$s_begin_h=$_GET["s_begin_h"];
$s_begin_i=$_GET["s_begin_i"];
$cn_begin=$cn_begin==""?date("Y-m-d",time()):$cn_begin;
$s_begin_h=$s_begin_h==""?"00":$s_begin_h;
$s_begin_i=$s_begin_i==""?"00":$s_begin_i;

$cn_end=$_GET["cn_end"];
$s_end_h=$_GET["s_end_h"];
$s_end_i=$_GET["s_end_i"];
$cn_end=$cn_end==""?date("Y-m-d",time()):$cn_end;
$s_end_h=$s_end_h==""?"23":$s_end_h;
$s_end_i=$s_end_i==""?"59":$s_end_i;

$begin_time=$cn_begin." ".$s_begin_h.":".$s_begin_i.":00";
$end_time=$cn_end." ".$s_end_h.":".$s_end_i.":59";

$zz_type=$_GET["zz_type"];

$subsub = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$web_site['web_title']?></title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Lottery/Css/ssc.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="../js/laydate.js"></script>
    <script type="text/javascript" src="/member/images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="/member/images/member.css">
	<script type="text/javascript" src="../js/form.min.js"></script>
    <script type="text/javascript" src="../js/layer.js"></script>
	
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<META name="apple-mobile-web-app-capable" content="yes">
<META name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<META http-equiv="pragma" content="no-cache">
<META http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="Expires" content="0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telphone=no">
<meta charset="UTF-8">
<script type="text/javascript" src="/cscpLoginWeb/js/jquery.json-2.3.min.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/language/CN/main.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/patrn.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/login.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/util.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/account.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/conversion.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/register.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/validation/languages/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/validation/jquery.validationEngine.js"></script>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/js/mobile/validation/validationEngineRed.jquery.css" />
<script type="text/javascript" src="/cscpLoginWeb/scripts/showMessageArtDialog.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/artDialog/artDialog.js"></script>  
<script type="text/javascript" src="/cscpLoginWeb/js/mobile/artDialog/artDialog.source.js"></script> 
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/js/mobile/artDialog/skins/black.css"/>
<script type="text/javascript" src="/cscpLoginWeb/scripts/mobile/TouchSlide.js"></script>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/index.css"/>
<link rel="stylesheet" type="text/css" href="/cscpLoginWeb/style/CN/caiShenCP/mobile/main.css"/>
<script type="text/javascript" src="/cscpLoginWeb/scripts/personalMsg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/report.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLotto.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLottery.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportM8Sport.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportLive.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportDsLottery.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportOg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportAg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportBBIN.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportYY.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportGG.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportPt.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportSg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportAllBet.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/reportIg.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/mobile/dialog.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/soltsPage.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/scripts/other-caiShenCP.js"></script>
<script type="text/javascript" src="/cscpLoginWeb/js/jquery-1.10.1.min.js"></script>
</head>
<body>
	<div class="wraper">
	<div class="container-fluid gm_main">
		<div class="tit">
			<a href="javascript:history.go(-1)" class="return" data-ajax="false"></a>额度记录
			<a href="/member/index" class="home" style="position: fixed; left: inherit; right: 0px;" data-ajax="false"></a>
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
        <div style="height: 44px;"></div>
        <div class="wrap">
            <form id="form1" name="form1" action="?query=true" method="get">
                <table cellspacing="0" cellpadding="0" border="0" class="tab1">
                    <tr>
                        <td class="bg" align="right">转账类型：</td>
                        <td>
                            <select name="zz_type" id="zz_type">
                                <option value="" <?=$zz_type==""?"selected":""?>>全部</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">开始日期：</td>
                        <td>
                            <input name="cn_begin" type="text" id="cn_begin" class="input_150 laydate-icon" readonly="readonly" value="<?=$cn_begin?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer; margin-bottom: 5px"/>
                            <div>
                                <select name="s_begin_h" id="s_begin_h">
                                    <?php
                                    for($bh_i=0;$bh_i<24;$bh_i++){
                                        $b_h_value=$bh_i<10?"0".$bh_i:$bh_i;
                                        ?>
                                        <option value="<?=$b_h_value?>" <?=$s_begin_h==$b_h_value?"selected":""?>><?=$b_h_value?></option>
                                    <?php } ?>
                                </select> 时
                                <select name="s_begin_i" id="s_begin_i">
                                    <?php
                                    for($bh_j=0;$bh_j<60;$bh_j++){
                                        $b_i_value=$bh_j<10?"0".$bh_j:$bh_j;
                                        ?>
                                        <option value="<?=$b_i_value?>" <?=$s_begin_i==$b_i_value?"selected":""?>><?=$b_i_value?></option>
                                    <?php } ?>
                                </select> 分
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">结束日期：</td>
                        <td>
                            <input name="cn_end" type="text" id="cn_end" class="input_150 laydate-icon" readonly="readonly" value="<?=$cn_end?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer; margin-bottom: 5px"/>
                            <div>
                                <select name="s_end_h" id="s_end_h">
                                    <?php
                                    for($eh_i=0;$eh_i<24;$eh_i++){
                                        $e_h_value=$eh_i<10?"0".$eh_i:$eh_i;
                                        ?>
                                        <option value="<?=$e_h_value?>" <?=$s_end_h==$e_h_value?"selected":""?>><?=$e_h_value?></option>
                                    <?php } ?>
                                </select> 时
                                <select name="s_end_i" id="s_end_i">
                                    <?php
                                    for($eh_j=0;$eh_j<60;$eh_j++){
                                        $e_i_value=$eh_j<10?"0".$eh_j:$eh_j;
                                        ?>
                                        <option value="<?=$e_i_value?>" <?=$s_end_i==$e_i_value?"selected":""?>><?=$e_i_value?></option>
                                    <?php } ?>
                                </select> 分
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg"></td>
                        <td><button type="submit" name="query" class="btn btn-primary" style="width: 150px">查　询</button></td>
                    </tr>
                </table>
            </form>
			<?php include_once("../modules/foots.php"); ?>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                <tr class="tic">
                    <td width="33.333%">转账时间</td>
                    <td width="33.333%">类型/金额</td>
                    <td width="33.333">转换状态</td>
                </tr>
                <?php
                if($zz_type != "") {
                    $sqlwhere = " and type='".$zz_type."'";
                }
                $begin_time = strtotime($begin_time);
                $end_time = strtotime($end_time);
                $sql	=	"select id from zz_info where uid=$uid ".$sqlwhere." and actionTime>='$begin_time' and actionTime<='$end_time' order by id desc";
                $query	=	$mysqli->query($sql);
                $sum	=	$mysqli->affected_rows; //总页数
                $thisPage	=	1;
                if(@$_GET['page']){
                    $thisPage	=	$_GET['page'];
                }
                $page		=	new newPage();
                $perpage	=   15;
                $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
                $id		=	'';
                $i		=	1; //记录 uid 数
                $start	=	($thisPage-1)*$perpage+1;
                $end	=	$thisPage*$perpage;
                while($row = $query->fetch_array()){
                    if($i >= $start && $i <= $end){
                        $id .=	$row['id'].',';
                    }
                    if($i > $end) break;
                    $i++;
                }
                if($id) {
                    $id		=	rtrim($id,',');
                    $sql	=	"select * from zz_info where id in($id) order by id desc";
                    $query	=	$mysqli->query($sql);
                    $okmoney	=	0;
                    $nomoney	=	0;
                    while($rows = $query->fetch_array()) {
                        ?>
                        <tr class="list f_12">
                            <td><?=date("Y-m-d H:i:s",$rows["actionTime"]+1*12*3600)?></td>
                            <td><span class="c_blue"><?=$rows["info"]?></span> @ <span class="c_red"><?=sprintf("%.2f",$rows["amount"])?></span></td>
                            <td><?=$rows["result"]?></td>
                        </tr>
                        <?php
                        $okmoney += abs($rows["amount"]);
                    }
                } else { ?>
                    <tr align="center">
                        <td colspan="3">暂无转账记录！</td>
                    </tr>
                <?php } ?>
            </table>
            <table border="0" cellspacing="0" cellpadding="0" class="page">
                <tr>
                    <td align="right"><?=$page->get_htmlPage("zr_data_money.php?cn_begin=".$cn_begin."&s_begin_h=".$s_begin_h."&s_begin_i=".$s_begin_i."&cn_end=".$cn_end."&s_end_h=".$s_end_h."&s_end_i=".$s_end_i."&zz_type=".$zz_type);?></td>
                </tr>
            </table>
        </div>
    </div>
	</div>
<script type="text/javascript" src="../js/base.js"></script>
</body>
</html>