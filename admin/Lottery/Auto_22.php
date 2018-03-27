<?php
include("../common/login_check.php");ini_set('display_errors','yes');
check_quanxian("ssgl");   
include("../../include/mysqli.php");
include("../../include/pager.class.php");
include ("../../Lottery/include/order_info.php");

include_once("../cqSix/auto_class.php");
include_once("../cqSix/year_sx.php");

//自动判断生肖 BY ZZJY 1063031748
$today = date("Y-m-d",time());
$lunar = new Lunar();
$nl = date("Y",$lunar->S2L($today));

if($nl!=$year['yaar']){
	
	$sxs = array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');
	$sx_arr=array();$sx_arr2=array();

	for($i=1;$i<=49;$i++){
		$dqsx=Get_ShengXiao($nl,$i%12);
		
		//echo $dqsx."===";
		$sx_arr[$dqsx]=$sx_arr[$dqsx].'<div class="ball_'.BuLing($i).'">'.BuLing($i).'</div>';
		$sx_arr2[$dqsx]=$sx_arr2[$dqsx].BuLing($i).',';
		
		//echo $sx_arr2[$dqsx]."<br>";
	}
	$code1=$code2="";
	$ii=1;
		
	foreach($sxs as $val){
	
		$code1.='$sx_'.BuLing($ii).'  = \''.$sx_arr[$val]."';\r\n";
		$code2.='$sx_'.BuLing($ii).'a = \''.rtrim($sx_arr2[$val], ",")."';\r\n";
		$ii++;
	}
	$code="<?php\r\n";
	$code .= $code1.$code2;
	$code .= "\r\n?>";
		
	///if(!write_file("../../Six/class/number_sx.php",$code)){ //写入缓存失败
		//echo	"缓存文件写入失败！请先设number_sx.php文件权限为：0777";
//	}
	
	$code="<?php\r\n";
	$code .= "\$year['year']		=	\"".$nl."\";\r\n";
	$code .= "\$year['sx']		=	\"".$sx."\";\r\n";
	$code .= "\r\n?>";
	//if(!write_file("year_sx.php",$code)){ //写入缓存失败
	///	echo	"缓存文件写入失败！请先设year_sx.php文件权限为：0777";
	//}
	///echo 'sfdgsdfgvsdf';
}




if(is_numeric($_REQUEST['type'])){
	$gameId=intval($_REQUEST['type']);
}else{
	$gameId=get_gameType_self();
}
if(!$gameId) $gameId=22;
$gameName=get_gameName($gameId);
//echo $gameId;
//echo $gameId;
//获取彩票期数
////////////获取本期期号时间///
$type = $gameId;
   $lottery_time=time();
	if($type==8 && date('H',$lottery_time)<5){
		$lottery_time=strtotime('-1 day',$lottery_time);
	}
	
	$sql	=	"select * from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' limit 1";
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	
	if($qs) {
		if($type==14){
				if(date('H',$lottery_time)<10){
					$lottery_time=strtotime('-1 day',$lottery_time);
					}
			
			}
		$xqishu= date("Ymd",$lottery_time).BuLings($qs['qishu']);
		$xtime =date("Ymd",$lottery_time)." ".$qs['kaijiang'];
	} else {
        $day = $lottery_time;
		if($type == 2) {
			$sql = "select * from c_opentime_".$type." where qishu=25";
		} elseif($type == 7 || $type == 3) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=1";
			if(date('H', $lottery_time) >= 22) {
                $day = strtotime('+1 day', $lottery_time);
            }
		} elseif($type == 9 || $type == 10) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=1";
			if(date('H', $lottery_time) >= 20) {
                $day = strtotime('+1 day', $lottery_time);
            }
		} elseif($type == 8) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=132";
		} elseif($type == 11) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=14";
		} else {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=1";
		}
		$query	=	$mysqli->query($sql);
		$qs		=	$query->fetch_array();
		
  	$xqishu=	date("Ymd", $day) . BuLings($qs['qishu']);
	$xtime =date("Ymd",$lottery_time)." ".$qs['kaijiang'];
		
	}
	



$id	=	0;
if($_GET['id'] > 0){
	$id	=	intval($_GET['id']);
}
if($_REQUEST['page']==''){
	$_REQUEST['page']=1;
}
if($_GET["action"]=="add" && $id==0){ 
	$qishu		=	$_POST["qishu"];
	$datetime	=	$_POST["datetime"];
	$ball_1		=	$_POST["ball_1"];
	$ball_2		=	$_POST["ball_2"];
	$ball_3		=	$_POST["ball_3"];
	$ball_4		=	$_POST["ball_4"];
	$ball_5		=	$_POST["ball_5"];
	$ball_6		=	$_POST["ball_6"];
	$ball_7		=	$_POST["ball_7"];
	$sql		=	"select qishu from c_auto_0 where qishu=".$qishu." limit 1";
	$query		=	$mysqli->query($sql);
	$rs			=	$query->fetch_array();
	if($rs['qishu']){
	//	message("期数已经存在！","Six_Auto.php");
		echo "<script>alert('期数已经存在！');window.location.href='Six_Auto.php';</script>";
		exit;
	}
	$sql		=	"insert into c_auto_$gameId(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7) values (".$qishu.",'".$datetime."',".$ball_1.",".$ball_2.",".$ball_3.",".$ball_4.",".$ball_5.",".$ball_6.",".$ball_7.")";

	$mysqli->query($sql);
	message('添加成功');
	
}elseif($_GET["action"]=="edit" && $id>0){
	$qishu		=	$_POST["qishu"];
	$datetime	=	$_POST["datetime"];
	$ball_1		=	$_POST["ball_1"];
	$ball_2		=	$_POST["ball_2"];
	$ball_3		=	$_POST["ball_3"];
	$ball_4		=	$_POST["ball_4"];
	$ball_5		=	$_POST["ball_5"];
	$ball_6		=	$_POST["ball_6"];
	$ball_7		=	$_POST["ball_7"];
	$sql		=	"update c_auto_$gameId set qishu=".$qishu.",datetime='".$datetime."',ball_1=".$ball_1.",ball_2=".$ball_2.",ball_3=".$ball_3.",ball_4=".$ball_4.",ball_5=".$ball_5." ,ball_6=".$ball_6." where id=".$id."";
	$mysqli->query($sql);
		message('添加成功');
}

$orderno=trim($_GET["orderno"]);
?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
<script language="javascript" src="/js/jquery.js"></script>
<script language="javascript">
	
		function inputsr(){  
		
   $('#qishu').val('<?=$xqishu?>');
   $('#datetime').val('<?=$xtime?>');
 }  
	function js(){  
    if(confirm("确认结算吗？请保证开奖号无误之后再确认结算")){  
        return true;  
    }  
    return false;  
 }  
function check_submit(){
	if($("#qishu").val()==""){
		alert("请填写开奖期数");
		$("#qishu").focus();
		return false;
	}
	if($("#datetime").val()==""){
		alert("请填写开奖时间");
		$("#datetime").focus();
		return false;
	}
	if($("#ball_1").val()==""){
		alert("请选择第一球开奖号码");
		$("#ball_1").focus();
		return false;
	}
	if($("#ball_2").val()==""){
		alert("请选择第二球开奖号码");
		$("#ball_2").focus();
		return false;
	}
	if($("#ball_3").val()==""){
		alert("请选择第三球开奖号码");
		$("#ball_3").focus();
		return false;
	}
	if($("#ball_4").val()==""){
		alert("请选择第四球开奖号码");
		$("#ball_4").focus();
		return false;
	}
	if($("#ball_5").val()==""){
		alert("请选择第五球开奖号码");
		$("#ball_5").focus();
		return false;
	}
		if($("#ball_6").val()==""){
		alert("请选择六球开奖号码");
		$("#ball_4").focus();
		return false;
	}
	if($("#ball_5").val()==""){
		alert("请选择第七球开奖号码");
		$("#ball_5").focus();
		return false;
	}
	return true;
}
</script>
</head>
<body>
<div id="pageMain">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top">
        <?php include_once("Menu_Auto.php"); ?>
        <form name="form1" onSubmit="return check_submit();" method="post" action="?id=<?=$id?>&type=<?=$gameId?>&action=<?=$id>0 ? 'edit' : 'add'?>&page=<?=$_REQUEST['page']?>&orderno=<?=$orderno?>">
<?php
if($id>0 && !isset($_GET['action'])){
	$sql	=	"select * from c_auto_$gameId where id=$id limit 1";
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
}
?>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
  <tr>
    <td  align="left" bgcolor="#F0FFFF">彩票类别：</td>
    <td  align="left" bgcolor="#FFFFFF"><?=$gameName?>【<a href="Uptime_2.php?type=<?=$gameId?>" style="color:#ff0000;">点击进入盘口管理</a>】</td>
  </tr>
  <tr>
    <td width="60"  align="left" bgcolor="#F0FFFF">开奖期号：</td>
    <td  align="left" bgcolor="#FFFFFF"><input name="qishu" type="text" id="qishu" value="<?=$rs['qishu']?>" onclick="return inputsr();"   size="20" maxlength="11"/></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#F0FFFF">开奖时间：</td>
    <td align="left" bgcolor="#FFFFFF"><input name="datetime" type="text" id="datetime" value="<?=$rs['datetime']?>" size="20" maxlength="19"/></td>
    </tr>
  <tr>
    <td height="40" align="right" bgcolor="#F2F4F6">开奖号码：</td>
    <td align="left" bgcolor="#FFFFFF" style="padding-left:5px;"><select name="ball_1" id="ball_1">
      <option value="1" <?=$rs['ball_1']==1 ? 'selected' : ''?>>01</option>
      <option value="2" <?=$rs['ball_1']==2 ? 'selected' : ''?>>02</option>
      <option value="3" <?=$rs['ball_1']==3 ? 'selected' : ''?>>03</option>
      <option value="4" <?=$rs['ball_1']==4 ? 'selected' : ''?>>04</option>
      <option value="5" <?=$rs['ball_1']==5 ? 'selected' : ''?>>05</option>
      <option value="6" <?=$rs['ball_1']==6 ? 'selected' : ''?>>06</option>
      <option value="7" <?=$rs['ball_1']==7 ? 'selected' : ''?>>07</option>
      <option value="8" <?=$rs['ball_1']==8 ? 'selected' : ''?>>08</option>
      <option value="9" <?=$rs['ball_1']==9 ? 'selected' : ''?>>09</option>
      <option value="10" <?=$rs['ball_1']==10 ? 'selected' : ''?>>10</option>
      <option value="11" <?=$rs['ball_1']==11 ? 'selected' : ''?>>11</option>
      <option value="12" <?=$rs['ball_1']==12 ? 'selected' : ''?>>12</option>
      <option value="13" <?=$rs['ball_1']==13 ? 'selected' : ''?>>13</option>
      <option value="14" <?=$rs['ball_1']==14 ? 'selected' : ''?>>14</option>
      <option value="15" <?=$rs['ball_1']==15 ? 'selected' : ''?>>15</option>
      <option value="16" <?=$rs['ball_1']==16 ? 'selected' : ''?>>16</option>
      <option value="17" <?=$rs['ball_1']==17 ? 'selected' : ''?>>17</option>
      <option value="18" <?=$rs['ball_1']==18 ? 'selected' : ''?>>18</option>
      <option value="19" <?=$rs['ball_1']==19 ? 'selected' : ''?>>19</option>
      <option value="20" <?=$rs['ball_1']==20 ? 'selected' : ''?>>20</option>
      <option value="21" <?=$rs['ball_1']==21 ? 'selected' : ''?>>21</option>
      <option value="22" <?=$rs['ball_1']==22 ? 'selected' : ''?>>22</option>
      <option value="23" <?=$rs['ball_1']==23 ? 'selected' : ''?>>23</option>
      <option value="24" <?=$rs['ball_1']==24 ? 'selected' : ''?>>24</option>
      <option value="25" <?=$rs['ball_1']==25 ? 'selected' : ''?>>25</option>
      <option value="26" <?=$rs['ball_1']==26 ? 'selected' : ''?>>26</option>
      <option value="27" <?=$rs['ball_1']==27 ? 'selected' : ''?>>27</option>
      <option value="28" <?=$rs['ball_1']==28 ? 'selected' : ''?>>28</option>
      <option value="29" <?=$rs['ball_1']==29 ? 'selected' : ''?>>29</option>
      <option value="30" <?=$rs['ball_1']==30 ? 'selected' : ''?>>30</option>
      <option value="31" <?=$rs['ball_1']==31 ? 'selected' : ''?>>31</option>
      <option value="32" <?=$rs['ball_1']==32 ? 'selected' : ''?>>32</option>
      <option value="33" <?=$rs['ball_1']==33 ? 'selected' : ''?>>33</option>
      <option value="34" <?=$rs['ball_1']==34 ? 'selected' : ''?>>34</option>
      <option value="35" <?=$rs['ball_1']==35 ? 'selected' : ''?>>35</option>
      <option value="36" <?=$rs['ball_1']==36 ? 'selected' : ''?>>36</option>
      <option value="37" <?=$rs['ball_1']==37 ? 'selected' : ''?>>37</option>
      <option value="38" <?=$rs['ball_1']==38 ? 'selected' : ''?>>38</option>
      <option value="39" <?=$rs['ball_1']==39 ? 'selected' : ''?>>39</option>
      <option value="40" <?=$rs['ball_1']==40 ? 'selected' : ''?>>40</option>
      <option value="41" <?=$rs['ball_1']==41 ? 'selected' : ''?>>41</option>
      <option value="42" <?=$rs['ball_1']==42 ? 'selected' : ''?>>42</option>
      <option value="43" <?=$rs['ball_1']==43 ? 'selected' : ''?>>43</option>
      <option value="44" <?=$rs['ball_1']==44 ? 'selected' : ''?>>44</option>
      <option value="45" <?=$rs['ball_1']==45 ? 'selected' : ''?>>45</option>
      <option value="46" <?=$rs['ball_1']==46 ? 'selected' : ''?>>46</option>
      <option value="47" <?=$rs['ball_1']==47 ? 'selected' : ''?>>47</option>
      <option value="48" <?=$rs['ball_1']==48 ? 'selected' : ''?>>48</option>
      <option value="49" <?=$rs['ball_1']==49 ? 'selected' : ''?>>49</option>
      <option value="0" <?=$rs['ball_1']=='' || $rs['ball_1']=='0' ? 'selected' : ''?>>正一</option>
      </select>
      <select name="ball_2" id="ball_2">
        <option value="1" <?=$rs['ball_2']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_2']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_2']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_2']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_2']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_2']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_2']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_2']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_2']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_2']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_2']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_2']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_2']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_2']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_2']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_2']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_2']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_2']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_2']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_2']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_2']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_2']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_2']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_2']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_2']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_2']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_2']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_2']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_2']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_2']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_2']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_2']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_2']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_2']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_2']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_2']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_2']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_2']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_2']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_2']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_2']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_2']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_2']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_2']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_2']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_2']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_2']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_2']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_2']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_2']=='' || $rs['ball_2']=='0' ? 'selected' : ''?>>正二</option>
        </select>
      <select name="ball_3" id="ball_3">
        <option value="1" <?=$rs['ball_3']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_3']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_3']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_3']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_3']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_3']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_3']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_3']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_3']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_3']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_3']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_3']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_3']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_3']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_3']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_3']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_3']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_3']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_3']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_3']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_3']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_3']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_3']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_3']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_3']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_3']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_3']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_3']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_3']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_3']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_3']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_3']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_3']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_3']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_3']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_3']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_3']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_3']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_3']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_3']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_3']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_3']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_3']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_3']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_3']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_3']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_3']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_3']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_3']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_3']=='' || $rs['ball_3']=='0' ? 'selected' : ''?>>正三</option>
        </select>
      <select name="ball_4" id="ball_4">
        <option value="1" <?=$rs['ball_4']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_4']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_4']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_4']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_4']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_4']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_4']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_4']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_4']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_4']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_4']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_4']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_4']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_4']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_4']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_4']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_4']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_4']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_4']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_4']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_4']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_4']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_4']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_4']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_4']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_4']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_4']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_4']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_4']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_4']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_4']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_4']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_4']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_4']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_4']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_4']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_4']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_4']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_4']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_4']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_4']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_4']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_4']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_4']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_4']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_4']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_4']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_4']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_4']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_4']=='' || $rs['ball_4']=='0' ? 'selected' : ''?>>正四</option>
        </select>
      <select name="ball_5" id="ball_5">
        <option value="1" <?=$rs['ball_5']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_5']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_5']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_5']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_5']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_5']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_5']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_5']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_5']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_5']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_5']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_5']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_5']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_5']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_5']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_5']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_5']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_5']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_5']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_5']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_5']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_5']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_5']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_5']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_5']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_5']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_5']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_5']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_5']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_5']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_5']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_5']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_5']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_5']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_5']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_5']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_5']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_5']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_5']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_5']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_5']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_5']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_5']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_5']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_5']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_5']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_5']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_5']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_5']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_5']=='' || $rs['ball_5']=='0' ? 'selected' : ''?>>正五</option>
        </select>
      <select name="ball_6" id="ball_6">
        <option value="1" <?=$rs['ball_6']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_6']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_6']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_6']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_6']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_6']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_6']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_6']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_6']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_6']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_6']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_6']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_6']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_6']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_6']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_6']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_6']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_6']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_6']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_6']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_6']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_6']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_6']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_6']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_6']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_6']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_6']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_6']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_6']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_6']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_6']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_6']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_6']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_6']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_6']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_6']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_6']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_6']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_6']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_6']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_6']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_6']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_6']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_6']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_6']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_6']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_6']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_6']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_6']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_6']=='' || $rs['ball_6']=='0' ? 'selected' : ''?>>正六</option>
        </select>
      <select name="ball_7" id="ball_7">
        <option value="1" <?=$rs['ball_7']==1 ? 'selected' : ''?>>01</option>
        <option value="2" <?=$rs['ball_7']==2 ? 'selected' : ''?>>02</option>
        <option value="3" <?=$rs['ball_7']==3 ? 'selected' : ''?>>03</option>
        <option value="4" <?=$rs['ball_7']==4 ? 'selected' : ''?>>04</option>
        <option value="5" <?=$rs['ball_7']==5 ? 'selected' : ''?>>05</option>
        <option value="6" <?=$rs['ball_7']==6 ? 'selected' : ''?>>06</option>
        <option value="7" <?=$rs['ball_7']==7 ? 'selected' : ''?>>07</option>
        <option value="8" <?=$rs['ball_7']==8 ? 'selected' : ''?>>08</option>
        <option value="9" <?=$rs['ball_7']==9 ? 'selected' : ''?>>09</option>
        <option value="10" <?=$rs['ball_7']==10 ? 'selected' : ''?>>10</option>
        <option value="11" <?=$rs['ball_7']==11 ? 'selected' : ''?>>11</option>
        <option value="12" <?=$rs['ball_7']==12 ? 'selected' : ''?>>12</option>
        <option value="13" <?=$rs['ball_7']==13 ? 'selected' : ''?>>13</option>
        <option value="14" <?=$rs['ball_7']==14 ? 'selected' : ''?>>14</option>
        <option value="15" <?=$rs['ball_7']==15 ? 'selected' : ''?>>15</option>
        <option value="16" <?=$rs['ball_7']==16 ? 'selected' : ''?>>16</option>
        <option value="17" <?=$rs['ball_7']==17 ? 'selected' : ''?>>17</option>
        <option value="18" <?=$rs['ball_7']==18 ? 'selected' : ''?>>18</option>
        <option value="19" <?=$rs['ball_7']==19 ? 'selected' : ''?>>19</option>
        <option value="20" <?=$rs['ball_7']==20 ? 'selected' : ''?>>20</option>
        <option value="21" <?=$rs['ball_7']==21 ? 'selected' : ''?>>21</option>
        <option value="22" <?=$rs['ball_7']==22 ? 'selected' : ''?>>22</option>
        <option value="23" <?=$rs['ball_7']==23 ? 'selected' : ''?>>23</option>
        <option value="24" <?=$rs['ball_7']==24 ? 'selected' : ''?>>24</option>
        <option value="25" <?=$rs['ball_7']==25 ? 'selected' : ''?>>25</option>
        <option value="26" <?=$rs['ball_7']==26 ? 'selected' : ''?>>26</option>
        <option value="27" <?=$rs['ball_7']==27 ? 'selected' : ''?>>27</option>
        <option value="28" <?=$rs['ball_7']==28 ? 'selected' : ''?>>28</option>
        <option value="29" <?=$rs['ball_7']==29 ? 'selected' : ''?>>29</option>
        <option value="30" <?=$rs['ball_7']==30 ? 'selected' : ''?>>30</option>
        <option value="31" <?=$rs['ball_7']==31 ? 'selected' : ''?>>31</option>
        <option value="32" <?=$rs['ball_7']==32 ? 'selected' : ''?>>32</option>
        <option value="33" <?=$rs['ball_7']==33 ? 'selected' : ''?>>33</option>
        <option value="34" <?=$rs['ball_7']==34 ? 'selected' : ''?>>34</option>
        <option value="35" <?=$rs['ball_7']==35 ? 'selected' : ''?>>35</option>
        <option value="36" <?=$rs['ball_7']==36 ? 'selected' : ''?>>36</option>
        <option value="37" <?=$rs['ball_7']==37 ? 'selected' : ''?>>37</option>
        <option value="38" <?=$rs['ball_7']==38 ? 'selected' : ''?>>38</option>
        <option value="39" <?=$rs['ball_7']==39 ? 'selected' : ''?>>39</option>
        <option value="40" <?=$rs['ball_7']==40 ? 'selected' : ''?>>40</option>
        <option value="41" <?=$rs['ball_7']==41 ? 'selected' : ''?>>41</option>
        <option value="42" <?=$rs['ball_7']==42 ? 'selected' : ''?>>42</option>
        <option value="43" <?=$rs['ball_7']==43 ? 'selected' : ''?>>43</option>
        <option value="44" <?=$rs['ball_7']==44 ? 'selected' : ''?>>44</option>
        <option value="45" <?=$rs['ball_7']==45 ? 'selected' : ''?>>45</option>
        <option value="46" <?=$rs['ball_7']==46 ? 'selected' : ''?>>46</option>
        <option value="47" <?=$rs['ball_7']==47 ? 'selected' : ''?>>47</option>
        <option value="48" <?=$rs['ball_7']==48 ? 'selected' : ''?>>48</option>
        <option value="49" <?=$rs['ball_7']==49 ? 'selected' : ''?>>49</option>
        <option value="0" <?=$rs['ball_7']=='' || $rs['ball_7']=='0' ? 'selected' : ''?>>特码</option>
      </select></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="left" bgcolor="#FFFFFF"><input name="submit" type="submit" class="submit80" value="确认发布"/></td>
  </tr>
</table>
</form>
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9" style="margin-top:5px;">
     <form name="form1" method="get" action="?id=<?=$id?>&type=<?=$gameId?>&action=<?=$id>0 ? 'edit' : 'add'?>&page=<?=$_REQUEST['page']?>&orderno=<?=$orderno?>">
      <tr>
        <td align="center" bgcolor="#FFFFFF">
			彩票期号
            <input name="orderno" type="text" id="orderno" value="<?=$orderno?>" size="22" maxlength="20"/>
            <input name="type" type="hidden" id="type" value="<?=$gameId?>" size="22" maxlength="20"/>
            &nbsp;<input type="submit" name="Submit" value="搜索"></td>
        </tr>   
      </form>
    </table>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">   
            <tr style="background-color:#3C4D82; color:#FFF">
              <td align="center"><strong>彩票类别</strong></td>
              <th align="center">彩票期号</th>
            <th align="center">开奖时间</th>
              <th align="center">正一</th>
              <th align="center">正二</th>
              <th align="center">正三</th>
              <th align="center">正四</th>
        <th height="25" align="center">正五</th>
        <th align="center">正六</th>
        <th align="center">特码</th>
        <th align="center">总和</th>
        
        <th align="center">结算</th>
        <th align="center">操作</th>
          </tr>
<?php
if($orderno!=""){
	$sqlwhere	=	" where qishu='$orderno'";
}else{
	$sqlwhere	=	"";
}
$sql		=	"select id from c_auto_$gameId ".$sqlwhere." order by qishu desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
$pagenum	=	50;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$CurrentPage=isset($_GET['page'])?$_GET['page']:1;
$myPage=new pager($sum,intval($CurrentPage),$pagenum);
$pageStr= $myPage->GetPagerContent();

$id		=	'';
$i			=	1; //记录 uid 数
$start	=	($CurrentPage-1)*$pagenum+1;
$end	=	$CurrentPage*$pagenum;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$id .=	$row['id'].',';
  }
  if($i > $end) break;
  $i++;
}
if($id){
	$id	=	rtrim($id,',');
	$sql	=	"select * from c_auto_$gameId where id in($id) order by qishu desc";
	$query	=	$mysqli->query($sql);
	$time	=	time();
	while($rows = $query->fetch_array()){
		$color = "#FFFFFF";
	  	$over	 = "#EBEBEB";
	 	$out	 = "#ffffff";
		$hm 		= array();
		$hm[]		= $rows['ball_1'];
		$hm[]		= $rows['ball_2'];
		$hm[]		= $rows['ball_3'];
		$hm[]		= $rows['ball_4'];
		$hm[]		= $rows['ball_5'];
		$hm[]		= $rows['ball_6'];
		$hm[]		= $rows['ball_7'];
		if($rows['ok']==1){
			
			$ok = '<a href="../cqSix/Auto/Six.php?qi='.$rows['qishu'].'&t=1"><font color="#FF0000">已结算</font></a>';
		}else{
			$ok = '<a href="../cqSix/Auto/Six.php?qi='.$rows['qishu'].'&t=1"  onclick="return js();" ><font color="#0000FF">未结算</font></a>';
		}
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>; line-height:20px;">
        <td height="25" align="center" valign="middle"><?=$gameName?></td>
	     <td align="center" valign="middle"><?=$rows['qishu']?></td>
	 <td align="center"><?=$rows['datetime']?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_1'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_2'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_3'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_4'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_5'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_6'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($rows['ball_7'],1)?></td>
        <td align="center" valign="middle"><?=Six_Auto($hm,2)?></td>
       
        <td align="center"><?=$ok?></td>
        <td><a href="?id=<?=$rows["id"]?>&type=<?=$gameId?>&page=<?=$_REQUEST['page']?>&orderno=<?=$orderno?>">编辑</a></td>
        </tr>
<?php
	}
}
?>
	<tr style="background-color:#FFFFFF;">
        <td colspan="13" align="center" valign="middle"><?php echo $pageStr;?></td>
        </tr>
    </table></td>
    </tr>
  </table>
</div>
</body>
</html>