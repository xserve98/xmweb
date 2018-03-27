<?php
include_once("../common/login_check.php");
include_once("../../include/newPage.php");
include_once("../../include/mysqli.php");
include_once("../../cache/hlhy.php");



$hl=implode(',',array_keys($hlhy));
session_start();
$suid=$_SESSION["suid"];
$time	=	$_GET["time"];
$time	=	$time==""?"CN":$time;
$bdate	=	$_GET["bdate"];
$bdate	=	$bdate==""?date("Y-m-d",time()):$bdate;
$bhour	=	$_GET["bhour"];
$bhour	=	$bhour==""?"00":$bhour;
$bsecond=	$_GET["bsecond"];
$bsecond=	$bsecond==""?"00":$bsecond;
$edate	=	$_GET["edate"];
$edate	=	$edate==""?date("Y-m-d",time()):$edate;
$ehour	=	$_GET["ehour"];
$ehour	=	$ehour==""?"23":$ehour;
$esecond=	$_GET["esecond"];
$esecond=	$esecond==""?"59":$esecond;
$username=	$_GET["username"];
$topuid=	$_GET["topuid"];
$btime	=	$bdate." ".$bhour.":".$bsecond.":00";
$etime	=	$edate." ".$ehour.":".$esecond.":59";
$type	=	$_GET["type"];
$n=1;
if($_GET["topuid"]) {
 $name=$_GET["topuid"];
 $sql_user	 =	"select * from k_user where username='$name' limit 1"; //取汇款前会员余额
 $query	 =	$mysqli->query($sql_user);
 $rs	 =	$query->fetch_array();
 $topuid=$rs['uid'];

}

?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>财务核查</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE2 {font-size: 12px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td{font:13px/120% "宋体";padding:3px;}
a{

	color:#F37605;

	text-decoration: none;

}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<script language="JavaScript" src="../../js/calendar.js"></script>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font ><span class="STYLE2">财务核查</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
	 <table width="100%" cellspacing="0" cellpadding="0" border="0">
     <form name="form1" method="GET" action="hccw.php" >
      <tr>
        <td>
		
		  &nbsp;开始日期
          <input name="bdate" type="text" id="bdate" value="<?=$bdate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
		  <select name="bhour" id="bhour">
			<?php
			for($i=0;$i<24;$i++){
				$list=$i<10?"0".$i:$i;
			?>
			<option value="<?=$list?>" <?=$bhour==$list?"selected":""?>><?=$list?></option>
			<?php } ?>
		</select>
		时
		<select name="bsecond" id="bsecond">
			<?php
			for($i=0;$i<60;$i++){
				$list=$i<10?"0".$i:$i;
			?>
			<option value="<?=$list?>" <?=$bsecond==$list?"selected":""?>><?=$list?></option>
			<?php } ?>
		</select>
		分
		&nbsp;结束日期
          <input name="edate" type="text" id="edate" value="<?=$edate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
		  <select name="ehour" id="ehour">
			<?php
			for($i=0;$i<24;$i++){
				$list=$i<10?"0".$i:$i;
			?>
			<option value="<?=$list?>" <?=$ehour==$list?"selected":""?>><?=$list?></option>
			<?php } ?>
		</select>
		时
		<select name="esecond" id="esecond">
			<?php
			for($i=0;$i<60;$i++){
				$list=$i<10?"0".$i:$i;
			?>
			<option value="<?=$list?>" <?=$esecond==$list?"selected":""?>><?=$list?></option>
			<?php } ?>
		</select>
		分</td>
	 </tr>
	 <tr>
        <td>
		<select name="type" id="type">
            <option value="" <?=$type==''?'selected':''?>>全部</option>
            <option value="1" <?=$type=='1'?'selected':''?>>存款</option>
            <option value="7" <?=$type=='7'?'selected':''?>>汇款</option>
            <option value="2" <?=$type=='2'?'selected':''?>>取款</option>
			<option value="3" <?=$type=="3"?"selected":""?>>人工汇款</option>
			<option value="4" <?=$type=="4"?"selected":""?>>彩金派送</option>
            <option value="100" <?=$type=="100"?"selected":""?>>投注扣款</option>
			<option value="200" <?=$type=="200"?"selected":""?>>投注返点</option>
			<option value="300" <?=$type=="300"?"selected":""?>>开奖派奖</option>
            <option value="400" <?=$type=="400"?"selected":""?>>注册送金</option>
			<option value="500" <?=$type=="21"?"selected":""?>>反水回收</option>
				<option value="600" <?=$type=="22"?"selected":""?>>分红派送</option>
				<option value="500" <?=$type=="23"?"selected":""?>>分红回收</option>
				<option value="600" <?=$type=="24"?"selected":""?>>占成派送</option>
				<option value="500" <?=$type=="25"?"selected":""?>>占成回收</option>
		
          </select>
			&nbsp;会员名称
          <input name="username" type="text" id="username" value="<?=$username?>" size="20" maxlength="20"/>
         	&nbsp;代理名称  <input name="topuid" type="text" id="topuid" value="<?=$topusername?>" size="20" maxlength="20"/>
        &nbsp;<input name="find" type="submit" id="find" value="查找"/></td>
      </tr>
	</form>
    </table></td>
  </tr>
</table>
<br>



<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
      <tr bgcolor="efe" class="t-title" align="center">
        <td width="6%"  ><strong>变动统计</strong></td>
		<td width="6%"  ><strong>投注扣款</strong></td>
        <td width="6%" ><strong>投注返点</strong></td>
        <td width="6%" ><strong>开奖派奖</strong></td>
        <td width="6%" ><strong>存款</strong></td> 
        <td width="6%"><strong>取款</strong></td>
        <td width="6%" ><strong>汇款</strong></td>
        <td width="6%" ><strong>人工汇款</strong></td>       
		<td width="6%" ><strong>反水回收</strong></td>
        <td width="6%" ><strong>分红派送</strong></td>
        <td width="6%" ><strong>分红回收</strong></td>
		<td width="6%" ><strong>占成派送</strong></td>
		<td width="6%" ><strong>占成回收</strong></td>
        </tr>
<?php

$arr		=	array();
$arr_m		=	array();
$arr_m[1]	=	0; //存款
$arr_m[2]	=	0; //取款
$arr_m[3]	=	0; //汇款
$arr_m[4]	=	0; //人工汇款
$arr_m[5]	=	0; //彩金派送
$arr_m[6]	=	0; //反水派送
$arr_m[7]	=	0; //其他情况
$arr_m[8]	=	0; //彩金派送
$arr_m[9]	=	0; //反水派送
$arr_m[10]	=	0; //其他情况



$sqlwhere	=	"";
if($username!=""){
	$sqlwhere	.=	" and username='$username'";
}
if($topuid!=""){
$sqlwhere	.=	" and concat(',',parents,',') like '%,".intval($topuid).",%'";
}else{
	
$sqlwhere	.=	" and concat(',',parents,',') like '%,".intval($suid).",%'";	
}
if($type!=""){
	$sqlwhere	.=	" and type=$type";
}
if($time=="CN"){
	$q_btime	=	date("Y-m-d H:i:s",strtotime($btime));
	$q_etime	=	date("Y-m-d H:i:s",strtotime($etime));
}else{
	$q_btime	=	$btime;
	$q_etime	=	$etime;
}


//所有该会员的存款取款记录以及加减款
$sql		=	"SELECT  m_id,uid,parents, fxdltype FROM  `k_money2` WHERE  `m_make_time`>='$q_btime' and `m_make_time`<='$q_etime' ".$sqlwhere." and guest=0  order by m_id desc";

$query	=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数

while($row = $query->fetch_array()){
	 
	$m_id .=	$row['m_id'].',';  
}

if($m_id){
//所有该会员的存款取款记录以及加减款
   $m_id		=	rtrim($m_id,',');
   $sql	=	"SELECT * FROM  `k_money2` WHERE  `m_id` IN ($m_id) order by m_id desc";

$query	=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数

 while($row = $query->fetch_array()){
	
	$arr_key	=	strtotime($row['m_make_time']);
	while(array_key_exists($arr_key,$arr)){
		$arr_key++;
	}
	$arr[$arr_key]['username']	=	$row['username'];
	if($row['type'] == 1){ //存款
		$arr[$arr_key]['type']		=	'<span style="color:#006600;">存款</span>';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[1]				+=	$row['m_value'];
	}else if($row['type'] == 2){ //取款
		$arr[$arr_key]['type']		=	'<span style="color:#FF0000;">取款</span>';
		$arr[$arr_key]['money']	=	abs($row['m_value']);
		$arr_m[2]				+=	abs($row['m_value']);
	}else if($row['type']==3){ //人工汇款
		$arr[$arr_key]['type']		=	'人工汇款';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[4]				+=	$row['m_value'];
	}else if($row['type']==4){ //彩金派送
		$arr[$arr_key]['type']		=	'彩金派送';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[5]				+=	$row['m_value'];
	}else if($row['type']==5){ //反水派送
		$arr[$arr_key]['type']		=	'反水派送';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[6]				+=	$row['m_value'];
	}else if($row['type']==6){ //其他情况
		$arr[$arr_key]['type']		=	'其他情况';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[7]				+=	$row['m_value'];
	}
	else if($row['type']==100){ //其他情况
		$arr[$arr_key]['type']		=	'投注扣款';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[8]				+=	$row['m_value'];
	}
	else if($row['type']==200){ //其他情况
		$arr[$arr_key]['type']		=	'投注返点';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[9]				+=	$row['m_value'];
	}
	else if($row['type']==300){ //其他情况
		$arr[$arr_key]['type']		=	'开奖派奖';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[10]				+=	$row['m_value'];
	}
	else if($row['type']==400){ //其他情况
		$arr[$arr_key]['type']		=	'注册送金';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[11]				+=	$row['m_value'];
	}
	else if($row['type']==500){ //其他情况
		$arr[$arr_key]['type']		=	'牛牛扣担保金';
		$arr_m[12]				+=	$row['m_value'];
	}
	else if($row['type']==600){ //其他情况
		$arr[$arr_key]['type']		=	'牛牛担保金';
	
		$arr_m[13]				+=	$row['m_value'];
	}
	else if($row['type']==21){ //其他情况
		$arr[$arr_key]['type']		=	'反水回收';
	
		$arr_m[14]				+=	$row['m_value'];
	}
	else if($row['type']==22){ //其他情况
		$arr[$arr_key]['type']		=	'分红派送';
	
		$arr_m[15]				+=	$row['m_value'];
	}
	else if($row['type']==23){ //其他情况
		$arr[$arr_key]['type']		=	'分红回收';
	
		$arr_m[16]				+=	$row['m_value'];
	}
	else if($row['type']==24){ //其他情况
		$arr[$arr_key]['type']		=	'占成派送';
	
		$arr_m[17]				+=	$row['m_value'];
	}else if($row['type']==25){ //其他情况
		$arr[$arr_key]['type']		=	'占成回收';
	
		$arr_m[18]				+=	$row['m_value'];
	}
	
	
	$arr[$arr_key]['time'] 	=$row["m_make_time"];
	$arr[$arr_key]['lsh'] 		=	$row['m_order'];
	$arr[$arr_key]['uid'] 		=	$row['uid'];
	$arr[$arr_key]['about'] 	=	$row['about'];
	$arr[$arr_key]['assets'] 	=	$row['assets'];
	$arr[$arr_key]['m_value'] 	=	$row['m_value'];
	$arr[$arr_key]['balance'] 	=	$row['balance'];
	$arr[$arr_key]['url'] 		=	'../cwgl/tixian_show.php?id='.$row['m_id'];
}

}

?>

      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" >
        <td align="center" >全部合计</td>
        <td><?=sprintf("%.2f",$arr_m[8])?></td>
        <td><?=sprintf("%.2f",$arr_m[9])?></td>
        <td><?=sprintf("%.2f",$arr_m[10])?></td>
        <td><?=sprintf("%.2f",$arr_m[1])?></td>
           <td><?=sprintf("%.2f",$arr_m[2])?></td>
  <td><?=sprintf("%.2f",$arr_m[4])?></td>
                  <td><?=sprintf("%.2f",$arr_m[5])?></td>
                  
                  <td><?=sprintf("%.2f",$arr_m[14])?></td>
				   <td><?=sprintf("%.2f",$arr_m[15])?></td>
				    <td><?=sprintf("%.2f",$arr_m[16])?></td>
                    <td><?=sprintf("%.2f",$arr_m[17])?></td>
                     <td><?=sprintf("%.2f",$arr_m[18])?></td>



        </tr>
  
    </table></td>
  </tr>
  
  
  

 
</table>





<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
      <tr bgcolor="efe" class="t-title" align="center">
        <td width="5%" height="24" ><strong>编号</strong></td>
        <td width="10%" ><strong>用户名</strong></td>
        <td width="8%" ><strong>类型</strong></td>
        <td width="25%" ><strong>系统订单号</strong></td>
      
        <td width="20%"><strong>金额</strong></td>
        <td width="15%" ><strong>提交时间</strong></td>
        </tr>
<?php
include_once("../../include/mysqli.php");

$arr		=	array();
$arr_m		=	array();
$arr_m[1]	=	0; //存款
$arr_m[2]	=	0; //取款
$arr_m[3]	=	0; //汇款
$arr_m[4]	=	0; //人工汇款
$arr_m[5]	=	0; //彩金派送
$arr_m[6]	=	0; //反水派送
$arr_m[7]	=	0; //其他情况
$arr_m[8]	=	0; //彩金派送
$arr_m[9]	=	0; //反水派送
$arr_m[10]	=	0; //其他情况



$sqlwhere	=	"";
if($username!=""){
	$sqlwhere	.=	" and username='$username'";
}
if($topuid!=""){
$sqlwhere	.=	" and concat(',',parents,',') like '%,".intval($topuid).",%'";
}else{
	
$sqlwhere	.=	" and concat(',',parents,',') like '%,".intval($suid).",%'";	
}
if($type!=""){
	
	
 $sqlwhere	.=	" and type=$type";
}


if($time=="CN"){
	$q_btime	=	date("Y-m-d H:i:s",strtotime($btime));
	$q_etime	=	date("Y-m-d H:i:s",strtotime($etime));
}else{
	$q_btime	=	$btime;
	$q_etime	=	$etime;
}
//所有该会员的存款取款记录以及加减款
$sql		=	"SELECT * FROM  `k_money2` WHERE  `m_make_time`>='$q_btime' and `m_make_time`<='$q_etime' ".$sqlwhere." and guest=0 order by m_id desc";

$query	=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数

while($row = $query->fetch_array()){
 $m_id22 .=	$row['m_id'].',';  
}


if($m_id22){
	      $m_id22		=	rtrim($m_id22,',');
		  $sql	=	"SELECT * FROM  `k_money2` WHERE  `m_id` IN ($m_id22) order by m_id desc";
          $query	=	$mysqli->query($sql);
          $sum	=	$mysqli->affected_rows; //总页
		 /// echo $sql;
          $thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
     }
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);
$uid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;

while($row = $query->fetch_array()){
  ///echo $i.'---'.$start.'---'.$end.'|';
	
if($i >= $start && $i <= $end){
	$m_id2 .=	$row['m_id'].',';
}
if($i > $end) break;
	$i++;	
	}
}



	  if($m_id2) {  
	   
	       $m_id2		=	rtrim($m_id2,',');
		  $sql	=	"SELECT * FROM  `k_money2` WHERE  `m_id` IN ($m_id2) order by m_id desc";
		 
$query	=	$mysqli->query($sql);
$sum	=	$mysqli->affected_rows; //总页数
while($row = $query->fetch_array()){

	$arr_key2	=	strtotime($row['m_make_time']);
	while(array_key_exists($arr_key2,$arr2)){
		$arr_key2++;
	}
	if($row['type'] == 1){ //存款
		$arr2[$arr_key2]['type']		=	'<span style="color:#006600;">存款</span>';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[1]				+=	$row['m_value'];
	}else if($row['type'] == 2){ //取款
		$arr2[$arr_key2]['type']		=	'<span style="color:#FF0000;">取款</span>';
		$arr2[$arr_key2]['money']	=	abs($row['m_value']);
		$arr_m[2]				+=	abs($row['m_value']);
	}else if($row['type']==3){ //人工汇款
		$arr2[$arr_key2]['type']		=	'人工汇款';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[4]				+=	$row['m_value'];
	}else if($row['type']==4){ //彩金派送
		$arr2[$arr_key2]['type']		=	'彩金派送';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[5]				+=	$row['m_value'];
	}else if($row['type']==5){ //反水派送
		$arr2[$arr_key2]['type']		=	'反水派送';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[6]				+=	$row['m_value'];
	}else if($row['type']==6){ //其他情况
		$arr[$arr_key2]['type']		=	'其他情况';
		$arr[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[7]				+=	$row['m_value'];
	}
	else if($row['type']==100){ //其他情况
		$arr2[$arr_key2]['type']		=	'投注扣款';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[8]				+=	$row['m_value'];
	}
	else if($row['type']==200){ //其他情况
		$arr2[$arr_key2]['type']		=	'投注返点';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[9]				+=	$row['m_value'];
	}
	else if($row['type']==300){ //其他情况
		$arr2[$arr_key2]['type']		=	'开奖派奖';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[10]				+=	$row['m_value'];
	}
	else if($row['type']==400){ //其他情况
		$arr2[$arr_key2]['type']		=	'注册送金';
		$arr2[$arr_key2]['money']	=	$row['m_value'];
		$arr_m[11]				+=	$row['m_value'];
	}
		else if($row['type']==500){ //其他情况
		$arr2[$arr_key2]['type']		=	'牛牛扣担保金';
		$arr_m[12]				+=	$row['m_value'];
	}
	else if($row['type']==600){ //其他情况
		$arr2[$arr_key2]['type']		=	'牛牛退担保金';
		$arr_m[13]				+=	$row['m_value'];
	}
	
		else if($row['type']==21){ //其他情况
		$arr2[$arr_key2]['type']		=	'反水回收';
	
		$arr_m[14]				+=	$row['m_value'];
	}
	else if($row['type']==22){ //其他情况
		$arr2[$arr_key2]['type']		=	'分红派送';
	
		$arr_m[15]				+=	$row['m_value'];
	}
	else if($row['type']==23){ //其他情况
		$arr2[$arr_key2]['type']		=	'分红回收';
	
		$arr_m[16]				+=	$row['m_value'];
	}
	else if($row['type']==24){ //其他情况
		$arr2[$arr_key2]['type']		=	'占成派送';
	
		$arr_m[17]				+=	$row['m_value'];
	}else if($row['type']==25){ //其他情况
		$arr2[$arr_key2]['type']		=	'占成回收';
	
		$arr_m[18]				+=	$row['m_value'];
	}
	
	
	
	$arr2[$arr_key2]['username']	=	$row['username'];
	$arr2[$arr_key2]['time'] 	=	$row["m_make_time"];
	$arr2[$arr_key2]['lsh'] 		=	$row['m_order'];
	$arr2[$arr_key2]['uid'] 		=	$row['uid'];
	$arr2[$arr_key2]['about'] 	=	$row['about'];
	$arr2[$arr_key2]['assets'] 	=	$row['assets'];
	$arr2[$arr_key2]['m_value'] 	=	$row['m_value'];
	$arr2[$arr_key2]['balance'] 	=	$row['balance'];
	$arr2[$arr_key2]['url'] 		=	'../cwgl/tixian_show.php?id='.$row['m_id'];
    }
}

$n	=	($thisPage-1)*20+1;
foreach($arr2 as $k=>$v){
	
?>

      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" >
        <td  height="35" align="center" ><?=$n++?></td>
        <td><?=$v["username"]?><br><a href="../bbgl/report_day.php?username=<?=$v["username"]?>" target="_blank">核查会员</a></td>
        <td><?=$v["type"]?></td>
        <td><?=$v["lsh"]?><?php
		if($v["about"]) echo '<br/>'.'<span style="color:#FF0000;">'.$v["about"].'</span>';
		?></td>
        
        <td>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="33%" style="color:#999999;"><?=$v["assets"]?></td>
              <td width="34%" align="center" style="color:#225d9c;"><?=$v["m_value"]?></td>
              <td width="33%" align="right" style="color:#F90A0A;"><?=$v["balance"]?></td>
            </tr>
          </table>          </td>
        <td><?=$v["time"]?></td>
        </tr>
      <?
	}
      ?>
    </table></td>
  </tr>
  
  
   <tr><td ><div style="float:left;"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></div></td></tr>
  <tr>
  

  </tr>
</table>
</body>
</html>