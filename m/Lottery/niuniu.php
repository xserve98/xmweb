<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include ("../include/lottery_time.php");
include ("../../cache/website.php");
include ("include/auto_class4.php");
include_once("../common/login_check.php");
include_once("../cache/group_" . $_SESSION['gid'] . ".php");
require ("curl_http.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
if (intval($web_site['brnn']) == 1) {
    include('close_cp.php');
    exit();
}
$type = $_GET['t'];
if(empty($type)) {
    $type = '两面盘';
}
$kj = $_COOKIE['kj_money'];
$cp_zd = $pk_db['彩票最低'];
$cp_zg = $pk_db['彩票最高'];
if($cp_zd <= 0) {
    $cp_zd = 1;
}
if($cp_zg <= 0) {
    $cp_zg = 1000000;
}



?>
<html xmlns="http://www.w3.org/1999/html"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<script>var userId='muyang01';</script>
<link rel="stylesheet" type="text/css" href="niuniu/css.css">
<link rel="stylesheet" type="text/css" href="niuniu/style.css">
 <link type="text/css" rel="stylesheet" href="/newdsn/css/bet.css" />
<script type="text/javascript" src="niuniu/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="niuniu/js.js"></script>
<script type="text/javascript" src="niuniu/event.js"></script>
<script type="text/javascript" src="../js/layer.js"></script>
<link rel="stylesheet" type="text/css" href="niuniu/game-niuniu.css">
<link rel="stylesheet" type="text/css" href="niuniu/jcountdown.css">
<script type="text/javascript" src="niuniu/jquery.jcountdown.min.js"></script>
<script type="text/javascript" src="js/niuniu.js"></script>
<script>
//var lotteryID=36,defaultIssue='';
</script>
</head>
<body class="skin_blue">
<!-- header -->
<div id="header">
<div class="lottery_info" style=" width: 944px !important;">
<div class="lottery_info_left floatleft" ><span class="name" id="lotteryName">百人牛牛 — 聚友国际厅</span><span class="result">&nbsp;今日输赢：<span id="user_sy" class="sy_n">0</span></span>

 <input id="gm_mode" type="hidden" value="cqssc" />
 <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
 <input id="cp_min" type="hidden" value="<?=$cp_zd?>" />
 <input id="cp_max" type="hidden" value="<?=$cp_zg?>" />

</div>
<div class="lottery_info_right floatright" >第<span id="curissue"></span>期&nbsp;&nbsp;距离封盘：<span class="color_lv bold"><span id="fp_time">00:00</span></span>&nbsp;&nbsp;距离开奖：<span class="color_lv bold"><span id="kj_time">00:00</span></span>
<span id="rf_time" style="float:right;width: 50px;">0秒</span>
</div>
<div class="clearfloat"></div>
</div>
</div>


<div class="page-game_niuniu">
	<div class="page-wrap">
		<div class="mainbody">
			<div class="game-timer" style="display:none">
				<!-- 时间倒计时 -->
				
				<div class="lefttime" >
<div class="countdown" id="countdown">
<div class="jCountdownContainer">
<div class="jCountdown flip white">
<div class="group hour" style="margin-right:15px;">
<div class="container item1" style="margin-right:0px;">
<div class="text" style="background-position: -450px -896px;"></div></div>
<div class="container item2 lastItem" style="margin-right:0px;">
<div class="text" style="background-position: -450px -896px;"></div></div>
</div><div class="group minute" style="margin-right:15px;">
<div class="container item1" style="margin-right:0px;">
<div class="text" style="background-position: -450px -896px;"></div></div>
<div class="container item2 lastItem" style="margin-right:0px;">
<div class="text" style="background-position: -450px -896px;"></div></div></div>
<div class="group second lastItem" style="margin-right:0px;">
<div class="container item1" style="margin-right:0px;">
<div class="text" style="background-position: -450px -896px;"></div></div>
<div class="container item2 lastItem" style="margin-right:0px;">
<div class="text" style="background-position: -450px -896px;"></div></div></div></div></div></div>
				</div>
			</div>
	
			<div class="game-area">
				<!-- 游戏投注选择区域 -->
				<div class="lastcode" style="display:none">
					<div class="issue">
						第
						<b id="last-issue">20170101001</b>期&nbsp;
					</div>
					<span id="last-code-zj"></span>
					<span id="last-code"></span>
					<a href="javascript:;" class="help-more"><i class="glyphicon glyphicon-question-sign"></i></a>
				</div>
				<div class="betarea" id="betarea">
					<div class="betrow" rowtext="庄" rowkey="z">
						<div class="selrow">
							<div class="rowhead">
								<span class="type type_z"></span>
							</div><div class="cardrow">
								<div class="card1 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card2 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card3 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card4 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card5 card">
									<span class="back"></span><span class="front"></span>
								</div>
							</div>
						</div><div class="status">
							<!-- <div style="margin-bottom:10px;">
								<a href="javascript:;" class="btn btn-disabled">申请上庄</a> <i class="help-zj"></i>
							</div> -->
							<span></span>
						</div>
					</div>
					<div class="betrow" rowtext="天" rowkey="t">
						<div class="selrow">
							<div class="rowhead">
								<span class="type type_t"></span>
								
							</div><div class="cardrow">
								<div class="card1 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card2 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card3 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card4 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card5 card">
									<span class="back"></span><span class="front"></span>
								</div>
							</div>
						</div><div class="status">
							<span></span>
						</div>
					</div>
					<div class="betrow" rowtext="地" rowkey="d">
						<div class="selrow">
							<div class="rowhead">
								<span class="type type_d"></span>
							
							</div><div class="cardrow">
								<div class="card1 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card2 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card3 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card4 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card5 card">
									<span class="back"></span><span class="front"></span>
								</div>
							</div>
						</div><div class="status">
							<span></span>
						</div>
					</div>
					<div class="betrow" rowtext="玄" rowkey="x">
						<div class="selrow">
							<div class="rowhead">
								<span class="type type_x"></span>
						
							</div><div class="cardrow">
								<div class="card1 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card2 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card3 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card4 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card5 card">
									<span class="back"></span><span class="front"></span>
								</div>
							</div>
						</div><div class="status">
							<span></span>
						</div>
					</div>
					<div class="betrow" rowtext="黄" rowkey="h">
						<div class="selrow">
							<div class="rowhead">
								<span class="type type_h"></span>
							
							</div><div class="cardrow">
								<div class="card1 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card2 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card3 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card4 card">
									<span class="back"></span><span class="front"></span>
								</div><div class="card5 card">
									<span class="back"></span><span class="front"></span>
								</div>
							</div>
						</div><div class="status">
							<span></span>
						</div>
					</div>
				</div>
			</div>
			<div class="game-actions">
				<!-- 游戏投注金额 -->
				<span class="reloadbox"><a class="reload" ></a></span>
				<input type="text" class="money placeholder" id="money" value="">
				<a href="javascript:;" class="btn submit" id="btn-submit">投注</a>
                	<a href="javascript:;" class="help-more"><i class="glyphicon glyphicon-question-sign"></i></a>
			</div>
		</div>
	</div>
</div>

<div class="game-help" id="game-help" style="display: none;"><i class="help-close"></i></div>
<div class="game-help" id="game-help-zj" style="display: none;"></div>
<!-- footer -->



<script type="text/javascript" src="niuniu/scrolltop.js?v=97c916a7"></script>

<link rel="stylesheet" type="text/css" href="niuniu/css2.css?v=a4bf3449">
<div class="window_shade_div"></div>

<div id="red_pocket_list" style="display: none;"></div>
<script>
  loadinfo(<?=$g_i?>);
$.pagedata={
    'lottery'       : '百人牛牛',
    'cid'       : '36',
    'types'       : '0',
    'delay'     : '10'
};
</script>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="niuniu/game-agniuniu.js"></script>

</body></html>