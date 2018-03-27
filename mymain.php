<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("include/lottery.inc.php");
include_once("common/login_check.php");
include_once("common/logintu.php");
include_once("common/function.php");
include_once("class/user.php");
include_once("cache/website.php");

$lm      = 'main';
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];

/*if($_SESSION["is_daili"]==1){
	echo "<script>alert('请先登录！'); window.open('/', '_top');</script>";
	exit();
	
}*/
renovate($uid, $loginid);
$userinfo = user::getinfo($uid);
$urlname = $_GET['url'];

$t_day = date('Y-m-d', $lottery_time);

$sql = "select add_time,msg from k_notice where is_show=1 order by `sort` desc,nid desc limit 0,15";
$query = $mysqli->query($sql);
			
while ($rs = $query->fetch_array()) {
	$time = date("Y/m/d H:i:s", strtotime($rs["add_time"]));
    $msg .= $rs['msg'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$str0 ='<div class="details" style="display: block;"><div class="back_body"></div><div id="dtlColor" class="details_div blue_back"><a href="#"><div class="close_icon"></div></a><div class="details_icon"><div></div></div><div id="dtlFont" class="details_font">';
	$str1 .='<div class="df2"><div class="df_data">'.$time.'</div><div>'.$rs["msg"].'</div></div>';
	$str2 =  ' </div></div></div></div>';
	$msg2 .= $rs['msg']."|";
	
	$htmlstr=$str0.$str1.$str2;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name=”renderer” content=”webkit” />
<link rel="shortcuticon" href="/favicon.ico" />
<title><?=$web_site['web_title']?></title>
<meta name="keywords" content="<?=$web_site['web_name']?>" />
<meta name="description" content="<?=$web_site['web_name']?>致力于打造彩票第一品牌，与您共同打造高品质的游戏平台，彩票游戏，我们更专业！" />
<link rel="stylesheet" type="text/css" href="/newdsn/css/balls.css" >
<link type="text/css" rel="stylesheet" href="/lottery/css/ssc2.css">
<link type="text/css" rel="stylesheet" href="/newindex/zb.css">
<link rel="stylesheet" type="text/css" href="/newdsn/css/main.css" >
<link rel="stylesheet" type="text/css" href="/newdsn/css/notice_popup.css">
<link rel="stylesheet" type="text/css" href="/js/colorbox/colorbox.css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="/newdsn/js/custompage.js"></script>
<script type="text/javascript" src="/js/json2.js"></script>
<script type="text/javascript" src="/js/swfobject.js"></script>
<script type="text/javascript" src="/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="/newdsn/js/member.js"></script>
<script type="text/javascript" src="/default/js/skin.js"></script>
<script type="text/javascript" src="/newdsn/js/notice_popup.js"></script>
<script type="text/javascript" src="/newdsn/js/hk6Base.js"></script>
<script type="text/javascript" src="/newdsn/js/drawurls.js"></script>
<script type="text/javascript" src="/js/layer.js"></script>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript">
var time   = '<?php echo $time;?>';
var msg     ='<?php echo $msg2;?>';
var timearr =time.split('|');
var msgarr =msg.split('|');


var MAX_DIVIDEND=5000000;
var SOUND_URL = '/newdsn/css/images/kaijiang.mp3';

noticePopupWithMore(1,1,msgarr[0],timearr[0]);
</script>
</head>
<body class="skin_blue">

<div id="header" class="header">
<div class="logo"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="210" height="60">
<param name="movie" value="../../newdsn/images/small_logo.jpg">
<param name="quality" value="high">
<embed src="../../newdsn/images/small_logo.jpg" wmode="transparent" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="350" height="80" style="position:absolute;top:-10px;left: -60px;"></object></div>
<div class="top">
<div class="menu">
  <div class="menu1"> 
        <div id="result_info" class="draw_number"></div>
        <a id="result_balls" target="_blank"></a>
        
  </div>
  <div class="menu2">
    <span><a target="frame" href="/member/record_ss.php">未结明细</a></span> |
    <span><a target="frame" href="/member/cha_cp.php?rad=ygsds&cn_begin=<?=$t_day?>&cn_end=<?=$t_day?>&t=y">今天已结</a></span> |
    <span><a target="frame" href="/member/report.php">报表查询</a></span> |
    <span><a href="/Lottery/ssc_list.php" id='kjjg' target="frame">开奖结果</a></span> |
	<span><a href="/url" target="_blank">网址导航</a></span><br/>
    <span><a target="frame" href="/member/info.php">个人资讯</a></span> |
  	<span><a target="frame" href="/member/password.php">修改密码</a></span> |
  	<span><a target="frame" id='yxgz' href="/lottery/rules/cqssc.php" >游戏规则</a></span> |
    <span><a target="frame" href="/member/xjcw2.php">资金变动</a></span> |
	<span><a href="/main">返回首页</a></span>
  </div>
  <div class="menu4"><a target="_blank" href="" class="support"></a></div>
  <div class="menu3">
  		<div class="themepicker">
           	 	<div class="themeicon icon1 icon1active" rel="blue"></div>
                <div class="themeicon icon2" rel="gold"></div>
                <div class="themeicon icon3" rel="red"></div>
           </div>
        <a href="/member/logout"><button type="button" class="logout" style=" width: 60px;"><div style=" margin-left: 30px;">退出</div></button></a>
       </div>
  <div style="clear:both;"></div>
</div>
<div class="lotterys">
<div class="menucontainer">
  <div class="spritearrow arrowup"></div>
    <div id="lotterys" style="display: none">
	  <?php if (intval($web_site['jssc']) == 1) { ?>
	  <?php } else { ?>
	  <a href="javascript:void(0)" id="l_JSSC"      lang="JSSC_2"  rel="0" ><span>极速赛车(PK10)</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['pk10']) == 1) { ?>
	  <?php } else { ?>
      <a href="javascript:void(0)" id="l_BJPK10"    lang="PK10_0"  rel="1" ><span>北京赛车(PK10)</span></a>
	  <?php } ?>
      <?php if (intval($web_site['cqssc']) == 1) { ?>	  
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_CQSSC"     lang="SSC_0"   rel="2" ><span>重庆时时彩</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['ffssc']) == 1) { ?>
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_XMFFC"     lang="SSC_0"   rel="3" ><span>极速时时彩</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['lfssc']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_XMLFC"     lang="SSC_0"   rel="4" ><span>幸运2分彩</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['wfssc']) == 1) { ?>
	  <?php } else { ?>  
	 
	  <?php } ?>
	  <?php if (intval($web_site['cqsix']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_XMHK6"     lang="HK6_2"   rel="5" ><span>极速六合彩</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['six']) == 1) { ?>
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_XGHK6"     lang="HK6_2"   rel="6" ><span>香港六合彩</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['brnn']) == 1) { ?>
	  <?php } else { ?>  
	
	  <?php } ?>
	  <?php if (intval($web_site['xyft']) == 1) { ?>
	  <?php } else { ?>  
      
	  <?php } ?>
	  <?php if (intval($web_site['jsxyft']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_JSXYFT"      lang="PK10_0"  rel="9" ><span>极速幸运飞艇</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['jspcdd']) == 1) { ?>
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_JSPC28"    lang="JSPCDD_2"rel="10" ><span>极速PC蛋蛋</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['xy28']) == 1) { ?>
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_PC28"      lang="PCEGG_0" rel="11" ><span>PC蛋蛋</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['azsf']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_AZKLSF"    lang="KLSF_0"  rel="12" ><span>澳洲快乐十分</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['gdklsf']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_GDKLSF"    lang="KLSF_0"  rel="13" ><span>广东快乐十分</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['xync']) == 1) { ?>
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_XYNC"      lang="KLSF_0"  rel="14" ><span>重庆幸运农场</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['xjssc']) == 1) { ?>
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_XJSSC"     lang="SSC_0"   rel="15" ><span>新疆时时彩</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['jxssc']) == 1) { ?>
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_TJSSC"     lang="SSC_0"   rel="16" ><span>天津时时彩</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['xjp8']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_XJPKL8"    lang="KL8_0"   rel="17" ><span>新加坡快乐8</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['kl8']) == 1) { ?>
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_BJKL8"     lang="KL8_0"   rel="18" ><span>北京快乐8</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['xjp28']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_DWZP"      lang="XJP28_0" rel="19" ><span>新加坡28</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['jnd28']) == 1) { ?>
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_JND28"     lang="JND28_0" rel="20" ><span>加拿大28</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['3d']) == 1) { ?>
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_F3D"       lang="3D_1"    rel="21" ><span>福彩3D</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['pl3']) == 1) { ?>
	  <?php } else { ?>  
      <a href="javascript:void(0)" id="l_PL3"       lang="PL3_1"   rel="22" ><span>体彩排列三</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['azxy5']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_AZXY5"     lang="SSC_0"   rel="23" ><span>澳洲幸运5</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['azxy8']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_AZXY8"     lang="SSC_0"   rel="24" ><span>澳洲幸运8</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['azxy10']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_AZXY10"    lang="SSC_0"   rel="25" ><span>澳洲幸运10</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['azxy20']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_AZXY20"    lang="SSC_0"   rel="26" ><span>澳洲幸运20</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['gd11x5']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_GD115"     lang="KLSF_0"    rel="17" ><span>广东11选5</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['shssl']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_SHSSL"     lang="SSC_0"   rel="2" ><span>上海时时乐</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['shssl']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_JS3"       lang="SSC_0"   rel="3" ><span>极速快三</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['shssl']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_JSK3"       lang="K3_1"    rel="17" ><span>江苏快三</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['shssl']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_SHK3"       lang="K3_1"    rel="17" ><span>上海快三</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['shssl']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_GXK3"       lang="K3_1"    rel="17" ><span>广西快三</span></a>
	  <?php } ?>
	  <?php if (intval($web_site['shssl']) == 1) { ?>
	  <?php } else { ?>  
	  <a href="javascript:void(0)" id="l_FJK3"       lang="K3_1"    rel="17" ><span>福建快三</span></a>
	  <?php } ?>
	  
	  
    </div>
  <div class="show">
    <ul class="items" id="items"></ul>
  </div>
  <div class="menumoregame">
    <div id="moregames">更多游戏</div>
    <div id="moregameicon">▼</div>
  </div>
</div>	

<div class="gamecontainer">
  <div style="height: 20px;"></div>
  <div class="gamebox clearfix" style="display:block">
</div>

  <div class="gamesmltxt">
          注：已选择的彩种可通过鼠标拖动改变排列顺序。
  </div>
  <div class="editon">
    <button class="gamebtn1">编辑</button>
  </div>
  <div class="editoff" style="display: none">
    <button class="gamebtn2">取消</button>
    <button class="gamebtn1">确定</button>
  </div>
</div>
</div>
<div class="sub">

<!--极速快三-->
<div id="sub_JS3" style="display:none">  
<a href="../../Lottery/js3.php?t=两面盘">两面盘</a></div>

<!--广西快三-->
<div id="sub_GXK3" style="display:none">  
<a href="../../Lottery/gxk3.php?t=两面盘">两面盘</a></div>

<!--江苏快三-->
<div id="sub_JSK3" style="display:none">  
<a href="../../Lottery/jsk3.php?t=两面盘">两面盘</a></div>

<!--上海快三-->
<div id="sub_SHK3" style="display:none">  
<a href="../../Lottery/shk3.php?t=两面盘">两面盘</a></div>

<!--福建快三-->
<div id="sub_FJK3" style="display:none">  
<a href="../../Lottery/fjk3.php?t=两面盘">两面盘</a></div>

<!--广东11选5-->
<div id="sub_GD115" style="display:none">  
<a href="../../Lottery/gd11x5.php?t=两面盘">两面盘</a></div>

<!--上海时时乐-->
<div id="sub_SHSSL" style="display:none">
<a href="../../Lottery/shssl.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/shssl.php?t=第一球">第一球</a>|
<a href="../../Lottery/shssl.php?t=第二球">第二球</a>|
<a href="../../Lottery/shssl.php?t=第三球">第三球</a>|</div>

<!--澳洲快乐10分-->
<div id="sub_AZKLSF" style="display:none">
<a href="../../Lottery/azsf.php?t=两面盘">两面盘</a>|
<a href="../../Lottery/azsf.php?t=单球1~8">单球1~8 </a>|
<a href="../../Lottery/azsf.php?t=第一球">第一球</a>|
<a href="../../Lottery/azsf.php?t=第二球">第二球</a>|
<a href="../../Lottery/azsf.php?t=第三球">第三球</a>|
<a href="../../Lottery/azsf.php?t=第四球">第四球</a>|
<a href="../../Lottery/azsf.php?t=第五球">第五球</a>|
<a href="../../Lottery/azsf.php?t=第六球">第六球</a>|
<a href="../../Lottery/azsf.php?t=第七球">第七球</a>|
<a href="../../Lottery/azsf.php?t=第八球">第八球</a>|
<a href="../../Lottery/azsf.php?t=总和、龙虎">总和、龙虎</a>|</div>

<!--澳洲幸运5-->
<div id="sub_AZXY5" style="display:none">
<a href="../../Lottery/azxy5.php?t=两面盘">两面盘</a>|
<a href="../../Lottery/azxy5.php?t=第一球">第一球</a>|
<a href="../../Lottery/azxy5.php?t=第二球">第二球</a>|
<a href="../../Lottery/azxy5.php?t=第三球">第三球</a>|
<a href="../../Lottery/azxy5.php?t=第四球">第四球</a>|
<a href="../../Lottery/azxy5.php?t=第五球">第五球</a>|</div>

<!--澳洲幸运8-->
<div id="sub_AZXY8" style="display:none">
<a href="../../Lottery/azxy8.php?t=两面盘">两面盘</a>|
<a href="../../Lottery/azxy8.php?t=单球1~8">单球1~8 </a>|
<a href="../../Lottery/azxy8.php?t=第一球">第一球</a>|
<a href="../../Lottery/azxy8.php?t=第二球">第二球</a>|
<a href="../../Lottery/azxy8.php?t=第三球">第三球</a>|
<a href="../../Lottery/azxy8.php?t=第四球">第四球</a>|
<a href="../../Lottery/azxy8.php?t=第五球">第五球</a>|
<a href="../../Lottery/azxy8.php?t=第六球">第六球</a>|
<a href="../../Lottery/azxy8.php?t=第七球">第七球</a>|
<a href="../../Lottery/azxy8.php?t=第八球">第八球</a>|
<a href="../../Lottery/azxy8.php?t=总和、龙虎">总和、龙虎</a>|</div>

<!--澳洲幸运10-->
<div id="sub_AZXY10" style="display:none">  
<a href="../../Lottery/azxy10.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/azxy10.php?t=冠,亚军 组合">冠,亚军 组合</a> |
<a href="../../Lottery/azxy10.php?t=1~10定位">1~10定位</a></div>

<!--澳洲幸运20-->
<div id="sub_AZXY20" style="display:none">
<a href="../../Lottery/azxy20.php?t=两面盘">两面盘</a>|
<a href="../../Lottery/azxy20.php?t=选一">选一</a>|
<a href="../../Lottery/azxy20.php?t=选二">选二</a>|
<a href="../../Lottery/azxy20.php?t=选三">选三</a>|
<a href="../../Lottery/azxy20.php?t=选四">选四</a>|
<a href="../../Lottery/azxy20.php?t=选五">选五</a>|</div>

<!--江苏快三-->
<div id="sub_JSK3" style="display:none">  
<a href="../../Lottery/jsk3.php?t=两面盘">两面盘</a></div>

<!--北京赛车-->
<div id="sub_BJPK10" style="display:none">  
<a href="../../Lottery/Pk10.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/Pk10.php?t=1~10定位">1~10定位</a> |
<a href="../../Lottery/Pk10.php?t=冠亚军和">冠亚军和</a> |
<a href="../../Lottery/Pk10.php?t=冠亚季军和">冠亚季军和</a></div>

<!--重庆时时彩-->
<div id="sub_CQSSC" style="display:none">
<a href="../../Lottery/Cqssc.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/Cqssc.php?t=第一球">第一球</a> |
<a href="../../Lottery/Cqssc.php?t=第二球">第二球</a> |
<a href="../../Lottery/Cqssc.php?t=第三球">第三球</a> |
<a href="../../Lottery/Cqssc.php?t=第四球">第四球</a> |
<a href="../../Lottery/Cqssc.php?t=第五球">第五球</a> |
<a href="../../Lottery/Cqssc.php?t=斗牛">斗牛</a> |
<a href="../../Lottery/Cqssc.php?t=梭哈">梭哈</a> |
<a href="../../Lottery/Cqssc.php?t=组合">组合</a> |
<a href="../../Lottery/Cqssc.php?t=总和 龙虎和">总和 龙虎和</a></div>

<!--极速赛车(PK10)-->
<div id="sub_JSSC" style="display:none">
<a href="../../Lottery/jssc.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/jssc.php?t=1~10定位">1~10定位</a> |
<a href="../../Lottery/jssc.php?t=冠亚军和">冠亚军和</a> |
<a href="../../Lottery/jssc.php?t=冠亚季军和">冠亚季军和</a></div>

<!--聚友国际五分彩-->
<div id="sub_XMWFC" style="display:none">
<a href="../../Lottery/Wfssc.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/Wfssc.php?t=第一球">第一球</a> |
<a href="../../Lottery/Wfssc.php?t=第二球">第二球</a> |
<a href="../../Lottery/Wfssc.php?t=第三球">第三球</a> |
<a href="../../Lottery/Wfssc.php?t=第四球">第四球</a> |
<a href="../../Lottery/Wfssc.php?t=第五球">第五球</a>|
<a href="../../Lottery/Wfssc.php?t=斗牛">斗牛</a>|
<a href="../../Lottery/Wfssc.php?t=梭哈">梭哈</a>|
<a href="../../Lottery/Wfssc.php?t=组合">组合</a>|
<a href="../../Lottery/Wfssc.php?t=总和 龙虎和">总和 龙虎和</a></div>

<!--幸运2分彩-->
<div id="sub_XMLFC" style="display:none">
<a href="../../Lottery/Lfssc.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/Lfssc.php?t=第一球">第一球</a> |
<a href="../../Lottery/Lfssc.php?t=第二球">第二球</a> |
<a href="../../Lottery/Lfssc.php?t=第三球">第三球</a> |
<a href="../../Lottery/Lfssc.php?t=第四球">第四球</a> |
<a href="../../Lottery/Lfssc.php?t=第五球">第五球</a>|
<a href="../../Lottery/Lfssc.php?t=斗牛">斗牛</a>|
<a href="../../Lottery/Lfssc.php?t=梭哈">梭哈</a>|
<a href="../../Lottery/Lfssc.php?t=组合">组合</a>|
<a href="../../Lottery/Lfssc.php?t=总和 龙虎和">总和 龙虎和</a></div>

<!--极速时时彩-->
<div id="sub_XMFFC" style="display:none">
<a href="../../Lottery/Ffssc.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/Ffssc.php?t=第一球">第一球</a> |
<a href="../../Lottery/Ffssc.php?t=第二球">第二球</a> |
<a href="../../Lottery/Ffssc.php?t=第三球">第三球</a> |
<a href="../../Lottery/Ffssc.php?t=第四球">第四球</a> |
<a href="../../Lottery/Ffssc.php?t=第五球">第五球</a>|
<a href="../../Lottery/Ffssc.php?t=斗牛">斗牛</a>|
<a href="../../Lottery/Ffssc.php?t=梭哈">梭哈</a>|
<a href="../../Lottery/Ffssc.php?t=组合">组合</a>|
<a href="../../Lottery/Ffssc.php?t=总和 龙虎和">总和 龙虎和</a></div>

<!--极速六合彩-->
<div id="sub_XMHK6" style="display:none">
<a href="../../cqSix/Six_7_1.php">特码</a>|
<a href="../../cqSix/Six_8_1.php">正码</a>|
<a href="../../cqSix/Six_1.php">正码特</a>|
<a href="../../cqSix/Six_8_2.php">过关</a>|
<a href="../../cqSix/Six_9.php">总和</a>|
<a href="../../cqSix/Six_10.php">一肖/尾数</a>|
<a href="../../cqSix/Six_7_2.php">波色&特肖</a>|
<a href="../../cqSix/Six_11.php">连码</a>|
<a href="../../cqSix/Six_12.php">合肖</a>|
<a href="../../cqSix/Six_13.php">生肖连</a>|
<a href="../../cqSix/Six_14.php">尾数连</a>|
<a href="../../cqSix/Six_15.php">全不中</a></div>

<!--幸运飞艇-->
<div id="sub_XYFT" style="display:none">
<a href="../../Lottery/xyft.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/xyft.php?t=1~10定位">1~10定位</a> |
<a href="../../Lottery/xyft.php?t=冠亚军和">冠亚军和</a> |
<a href="../../Lottery/xyft.php?t=冠亚季军和">冠亚季军和</a></div>

<!--极速幸运飞艇-->
<div id="sub_JSXYFT" style="display:none">
<a href="../../Lottery/jsxyft.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/jsxyft.php?t=1~10定位">1~10定位</a> |
<a href="../../Lottery/jsxyft.php?t=冠亚军和">冠亚军和</a> |
<a href="../../Lottery/jsxyft.php?t=冠亚季军和">冠亚季军和</a></div>

<!--香港六合彩-->
<div id="sub_XGHK6" style="display:none">
<a href="../../Six/Six_7_1.php">特码</a>|
<a href="../../Six/Six_8_1.php">正码</a>|
<a href="../../Six/Six_1.php">正码特</a>|
<a href="../../Six/Six_8_2.php">过关</a>|
<a href="../../Six/Six_9.php">总和</a>|
<a href="../../Six/Six_10.php">一肖/尾数</a>|
<a href="../../Six/Six_7_2.php">波色&特肖</a>|
<a href="../../Six/Six_11.php">连码</a>|
<a href="../../Six/Six_12.php">合肖</a>|
<a href="../../Six/Six_13.php">生肖连</a>|
<a href="../../Six/Six_14.php">尾数连</a>|
<a href="../../Six/Six_15.php">全不中</a></div>

<!--新加坡28-->
<div id="sub_DWZP" style="display:none">
<a href="../../Lottery/xjp28.php">两面盘</a></div>

<!--百人牛牛-->
<div id="sub_BRNN" style="display:none">
<a href="../../Lottery/niuniu.php">两面盘</a></div>
   
<!--PC蛋蛋-->
<div id="sub_PC28" style="display:none">
<a href="../../Lottery/XY28.php?t=两面盘">两面盘</a></div>

<!--极速PC蛋蛋-->
<div id="sub_JSPC28" style="display:none">
<a href="../../Lottery/jspcdd.php?t=两面盘">两面盘</a></div>

<!--加拿大28-->
<div id="sub_JND28" style="display:none">
<a href="../../Lottery/jnd28.php?t=混合盘">混合盘</a>|</div>

<!--广东快乐十分-->
<div id="sub_GDKLSF" style="display:none">
<a href="../../Lottery/gdsf.php?t=两面盘">两面盘</a>|
<a href="../../Lottery/gdsf.php?t=单球1~8">单球1~8 </a>|
<a href="../../Lottery/gdsf.php?t=第一球">第一球</a>|
<a href="../../Lottery/gdsf.php?t=第二球">第二球</a>|
<a href="../../Lottery/gdsf.php?t=第三球">第三球</a>|
<a href="../../Lottery/gdsf.php?t=第四球">第四球</a>|
<a href="../../Lottery/gdsf.php?t=第五球">第五球</a>|
<a href="../../Lottery/gdsf.php?t=第六球">第六球</a>|
<a href="../../Lottery/gdsf.php?t=第七球">第七球</a>|
<a href="../../Lottery/gdsf.php?t=第八球">第八球</a>|
<a href="../../Lottery/gdsf.php?t=总和、龙虎">总和、龙虎</a>|</div>

<!--重庆快乐10分-->
<div id="sub_XYNC" style="display:none">
<a href="../../Lottery/Cqsf.php?t=两面盘">两面盘</a>|
<a href="../../Lottery/Cqsf.php?t=单球1~8">单球1~8 </a>|
<a href="../../Lottery/Cqsf.php?t=第一球">第一球</a>|
<a href="../../Lottery/Cqsf.php?t=第二球">第二球</a>|
<a href="../../Lottery/Cqsf.php?t=第三球">第三球</a>|
<a href="../../Lottery/Cqsf.php?t=第四球">第四球</a>|
<a href="../../Lottery/Cqsf.php?t=第五球">第五球</a>|
<a href="../../Lottery/Cqsf.php?t=第六球">第六球</a>|
<a href="../../Lottery/Cqsf.php?t=第七球">第七球</a>|
<a href="../../Lottery/Cqsf.php?t=第八球">第八球</a>|
<a href="../../Lottery/Cqsf.php?t=总和、龙虎">总和、龙虎</a>|</div>

<!--新疆时时彩-->
<div id="sub_XJSSC" style="display:none">
<a href="../../Lottery/Xjssc.php?t=两面盘">两面盘</a>|
<a href="../../Lottery/Xjssc.php?t=第一球">第一球</a>|
<a href="../../Lottery/Xjssc.php?t=第二球">第二球</a>|
<a href="../../Lottery/Xjssc.php?t=第三球">第三球</a>|
<a href="../../Lottery/Xjssc.php?t=第四球">第四球</a>|
<a href="../../Lottery/Xjssc.php?t=第五球">第五球</a>|
<a href="../../Lottery/Xjssc.php?t=斗牛">斗牛</a>|
<a href="../../Lottery/Xjssc.php?t=梭哈">梭哈</a>|
<a href="../../Lottery/Xjssc.php?t=组合">组合</a>|
<a href="../../Lottery/Xjssc.php?t=总和 龙虎和">总和 龙虎和</a></div>

<!--天津时时彩-->
<div id="sub_TJSSC" style="display:none">
<a href="../../Lottery/Jxssc.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/Jxssc.php?t=第一球">第一球</a> |
<a href="../../Lottery/Jxssc.php?t=第二球">第二球</a> |
<a href="../../Lottery/Jxssc.php?t=第三球">第三球</a> |
<a href="../../Lottery/Jxssc.php?t=第四球">第四球</a> |
<a href="../../Lottery/Jxssc.php?t=第五球">第五球</a> |
<a href="../../Lottery/Jxssc.php?t=斗牛">斗牛</a> |
<a href="../../Lottery/Jxssc.php?t=梭哈">梭哈</a> |
<a href="../../Lottery/Jxssc.php?t=组合">组合</a> |
<a href="../../Lottery/Jxssc.php?t=总和 龙虎和">总和 龙虎和</a></div>

<!--新加坡快乐8-->
<div id="sub_XJPKL8" style="display:none">
<a href="../../Lottery/xjp8.php?t=两面盘">两面盘</a>|
<a href="../../Lottery/xjp8.php?t=选一">选一</a>|
<a href="../../Lottery/xjp8.php?t=选二">选二</a>|
<a href="../../Lottery/xjp8.php?t=选三">选三</a>|
<a href="../../Lottery/xjp8.php?t=选四">选四</a>|
<a href="../../Lottery/xjp8.php?t=选五">选五</a>|</div>

<!--北京快乐8-->
<div id="sub_BJKL8" style="display:none">
<a href="../../Lottery/kl8.php?t=两面盘">两面盘</a>|
<a href="../../Lottery/kl8.php?t=选一">选一</a>|
<a href="../../Lottery/kl8.php?t=选二">选二</a>|
<a href="../../Lottery/kl8.php?t=选三">选三</a>|
<a href="../../Lottery/kl8.php?t=选四">选四</a>|
<a href="../../Lottery/kl8.php?t=选五">选五</a>|</div>

<!--福彩3D-->
<div id="sub_F3D" style="display:none">
<a href="../../Lottery/3D.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/3D.php?t=第一球">第一球</a>|
<a href="../../Lottery/3D.php?t=第二球">第二球</a>|
<a href="../../Lottery/3D.php?t=第三球">第三球</a>|</div>

<!--体彩排列三-->
<div id="sub_PL3" style="display:none">
<a href="../../Lottery/pl3.php?t=两面盘">两面盘</a> |
<a href="../../Lottery/pl3.php?t=第一球">第一球</a>|
<a href="../../Lottery/pl3.php?t=第二球">第二球</a>|
<a href="../../Lottery/pl3.php?t=第三球">第三球</a>|</div>

</div>
</div>
</div>
<div id="main">
<div class="side_left" id="side">
<div class="user_info leftpanel">
<div class="lpheader">账户信息</div>
<div class="lpcontent" id="account">
账号：<?php if(strpos($_SESSION["username"],'guest_')===false) {?>
 <?=$_SESSION['username']?>
 <? }else{ ?>
试玩用户
 <? } ?><br>

额度：<span id="balance" class="balance"><?=$userinfo['money']?></span><br>

<!--盘口：<span id="balance" class="balance"><?=$userinfo['pankou']?></span><br-->

<?php 
$uid = $_SESSION['uid'];
$sql = "select SUM(money) as a from c_bet where uid=$uid and js=0";
$query	=	$mysqli->query($sql);
if($result = $query->fetch_array()){
	$summary = $result['a'];
}else{
	$summary = 0;
}?>
未结算金额：<span id="balance1" class="balance"><?php echo number_format($summary,2,'.','')?></span><br/>
<script type="text/javascript">
setInterval(function(){
$("#balance1").load("/summary.php");
},2000);
</script>
</div>

<div class="clearfix">
<?php if(strpos($_SESSION["username"],'guest_')===false) {?>
<? }else{ ?>
<a target="_blank" href="/register">
<button class="supportbtn">
<div style="margin: 0px 0 0 67px;">立即注册</div></button></a>
 <? } ?>
 
<?php if(strpos($_SESSION["username"],'guest_')===false) {?>
<button class="sidenavibtn mrl5" onclick="checkBindSecQue(null,true,false);" rel="/member/userinfo.php">个人中心</button>
<button class="sidenavibtn" onclick="checkBindSecQue(null,true,false);" rel="/member/set_money.php">充值</button>
<button class="sidenavibtn" onclick="checkBindSecQue(null,true,false);" rel="/member/get_money.php">提款</button>
<a href="/deposit" target="_blank"><button class="sidenavibtn_full"><img src="/newdsn/images/play_btn.png" width="23" height="21" style="margin-right:3px;">网银充值视频教程</button></a>
<a target="_blank" href="<?=$web_site["web_kf"]?>">
<button class="supportbtn"><div style="margin-left:47px;">
<img src="/newdsn/images/mic2.png" width="23" height="21"></div> 
<div style="margin: 2px 0 0 5px;">在线客服</div></button></a>
<? } ?>


<div class="lpheader2">最新注单</div>
</div>
	<div id='left' class="gm_left" style="overflow-x: hidden;">
    <div id="user_order"></div>
</div>
</div>
</div>
<div class="frame" style="-webkit-overflow-scrolling:touch; padding-bottom:100px">
<iframe id="frame"  name="frame" scrolling="no"  frameborder="0"></iframe></div>
</div>
 <?php
    $sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 1";
    $query = $mysqli->query($sql);
    $list = '';
    while($rs = $query->fetch_array()) {
        $list = $rs['msg'];
    }
    ?>
<div id="footer" style=" bottom: 0;position: fixed;width: 100%"><marquee id="notices" scrollamount="2" style="margin-right: 80px;">  
<div style="display:none" class="list"></div>
<span style="color: #35406D;"><?=$list?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

    

</marquee><a href="javascript:void(0)" class="more">更多</a></div></div>

<div id="settingbet"  title="快选金额" style="display:none;">
<input name="bet_1" placeholder="快选金额" class="ds"/><br />
<input name="bet_2" placeholder="快选金额" class="ds" /><br />
<input name="bet_3" placeholder="快选金额" class="ds" /><br />
<input name="bet_4" placeholder="快选金额" class="ds" /><br />
<input name="bet_5" placeholder="快选金额" class="ds" /><br />
<input name="bet_6" placeholder="快选金额" class="ds" /><br />
<input name="bet_7" placeholder="快选金额" class="ds" /><br />
<input name="bet_8" placeholder="快选金额" class="ds" /><br />

  <label>
    <input name="settingbet" type="radio" id="settingbet_0" value="1" checked="checked" />
    启动</label>
  <label>
    <input name="settingbet" type="radio" id="settingbet_1" value="0" />
    停用</label>
  <br />
  <br />

<input type="button" class="button" value="储存" onClick="submitsetting()" />

</div>

<div class="Notice"></div>
<div class="details">
  <div class="back_body"></div>
  <div id="dtlColor" class="details_div">
    <a href="javascript:void(0)"><div class="close_icon"></div></a>
    <div class="details_icon"><div></div></div>
    <div id="dtlFont" class="details_font"></div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    getSkinColor();

	var b1 = '<?php echo $str1;?>';  
	
	
    $("#footer .more").click(function() {
        getSkinColor();
		
        $("#dtlFont").html("");
     
	   $("#dtlColor").attr("class", "details_div " + skinColor + "_back");
        $("#dtlFont").html(b1);
		$(".details").show()
    });
	 
    $(".close_icon , .notice_button").click(function() {
        $(".noticeChild").hide();
        $(".details").hide()
    })
});
</script>

<script type="text/javascript">
 function reSetIframeHeight(h){

	var iframe1 = document.getElementById("frame");			
console.log('h'+h);
$(iframe1).height(h);
$("#main").height(h);

 }
 
 
 $("#frame").load(function(){
 var iframe1 = document.getElementById("frame");

 var url =iframe1.contentWindow.window.location;
 var mainheight=800;
var mainh=window.screen.availHeight-170;

$(iframe1).height( mainheight);
	mainheight = $(iframe1).contents().find("body").prop("scrollHeight");	 

			 
	  if(mainheight<mainh){
		 
		mainheight= mainh; 
	 }
	 
	 $(iframe1).height(mainheight);
$("#main").height(mainheight);
}); 
</script>
<script type="text/javascript">
    function get_money() {
      $.getJSON("/leftDao.php?callback=?", function(json) {
         $("#balance").html(json.user_money);
     });
      setTimeout(get_money, 5000);
    }
    get_money();
	$(".m_game").click(function() {
		$(".m_div").toggle();
	});
    $(".nav a").click(function() {
        var p = $(this).closest("li");
        var i = $(this).attr("d_num");
		if(i == 15) {return false;}
        if(!p.hasClass("cur")) {
            p.addClass("cur").siblings().removeClass("cur");
        }
		$(".m_div").hide();
        $(".type ul").removeClass("on").eq(i - 1).addClass("on");
        $("#lskj").attr("onclick", "gm_open(" + i + ");");
        $("#yxgz").attr("onclick", "gm_rules(" + i + ");");
		if(i > 13) {
			$("#kj_info").hide();
			$("#kj_list").html("");
			$("#user_order").html("");
		} else {
			$("#kj_info").show();
		}
    });
    $("#yc").click(function() {
        if($(this).text() == '[隐藏]') {
            $(this).text('[显示]');
        } else {
            $(this).text('[隐藏]');
        }
        $("#kj_list").toggle();
    });
</script>


<script type="text/javascript"> 
var win = window;
var doc = win.document;
var input = doc.createElement ("input");



var ie = (function (){
//"!win.ActiveXObject" is evaluated to true in IE11
if (win.ActiveXObject === undefined) return null;
if (!win.XMLHttpRequest) return 6;
if (!doc.querySelector) return 7;
if (!doc.addEventListener) return 8;
if (!win.atob) return 9;
//"!doc.body.dataset" is faster but the body is null when the DOM is not
//ready. Anyway, an input tag needs to be created to check if IE is being
//emulated
if (!input.dataset) return 10;
return 11;
})();

if(ie<10&&ie !==null){
	
	layer.msg('系统不支持ie10核心以下浏览器，请使用chorme核心浏览器极速模式', {
  icon: 2,
  time: 3000 //2秒关闭（如果不配置，默认是3秒）
}, function(){
window.location.href='http://chrome.360.cn/'
});  
	}
</script>
</body>
</html>