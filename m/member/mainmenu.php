<?php
$main=1;
$sub=1;
$cururl=$_SERVER['PHP_SELF'];
$cururl=str_ireplace("/member/","",$cururl);

switch($cururl){
	case "userinfo.php":
	case "password.php":
	case "sys_msg.php":
	case "sys_msg_del.php":
	case "sys_msg_show.php":
	
		$main=1;
		break;
	case "set_card.php";
	case "set_money.php":
	case "hk_money.php":
	case "get_money.php":
	case "data_money.php":
	case "data_h_money.php":
	case "data_t_money.php":
	case "data_o_money.php":
	case "zr_money.php":
	case "zr_data_money.php":
	case "data_jifen.php":
	
		$main=2;
		break;
	case "record_ty.php":
	case "record_ss.php":
	case "record_pt.php":
	case "record_lh.php":
	case "record_tycg.php":
		$main=3;
		break;
	case "report.php":
	case "cha_ty.php":
	case "cha_gg.php":
	case "cha_cp.php":
		$main=4;
		break;
	case "agent_reg.php":
	case "agent_fa.php":
	case "agent_wt.php":
	case "agent.php":
	case "agent_user.php":
	case "agent_report.php":
	case "agent_report_detail.php":
		$main=5;
		break;
	case "set_jifen.php":
		$main=2;
		break;
	default:
		$main=1;
		$sub=1;
		break;
}

if(strstr($cururl,"/pay/")){
	$main=2;
	$sub=1;
}

switch($cururl){
	case "userinfo.php":
	case "set_money.php":
	case "record_ty.php":
	case "report.php":
	case "agent_reg.php":
	case "agent.php":
		$sub=1;
		break;
	case "password.php":
	case "get_money.php":
	case "record_ss.php":
	case "agent_user.php":
	
		$sub=2;
		break;
	case "sys_msg.php":
	case "sys_msg_del.php":
	case "sys_msg_show.php":
	case "data_money.php":
	case "data_h_money.php":
	case "data_t_money.php":
	case "data_o_money.php":
	case "record_pt.php":
	case "agent_report.php":
	case "record_lh.php":
		$sub=3;
		break;
	case "zr_money.php":
	case "agent_report_detail.php":
	case "sys_msg_add.php":
	case "record_tycg.php":
		$sub=4;
		break;
	case "zr_data_money.php":
		$sub=5;
		break;
	case "set_jifen.php":
		$sub=6;break;
	case "hk_money.php":
		$sub=7;break;
	default:
		$sub=1;
		break;
}

switch($cururl){
	case "data_money.php":
		$subsub=1;
		break;
	case "data_h_money.php":
		$subsub=2;
		break;
	case "data_t_money.php":
		$subsub=3;
		break;
	case "data_o_money.php":
	case "data_jifen.php":
		$subsub=4;
		break;
	case "zr_data_money.php":
		$subsub=5;
		break;
	default:
		$subsub=1;
		break;
}

$full_url=isset($main_url)?$main_url."/member/":"";
$is_daili=$_SESSION["is_daili"];
?>

<div class="content1">

	<div class="time">
	<ul>
    
    <div id="local"></div> 

<script language="javascript" type="text/javascript"> 

function calcTime(city, offset) { 
var d = new Date(); 
utc = d.getTime() + (d.getTimezoneOffset() * 60000); 
var nd = new Date(utc + (3600000 * offset)); 
var gmtTime = new Date(utc) 
var day = nd.getDate(); 
var month = nd.getMonth(); 
var year = nd.getYear(); 
var hr = nd.getHours(); //+ offset 
var min = nd.getMinutes(); 
var sec = nd.getSeconds(); 
if(year < 1000){ 
year += 1900 
} 
var monthArray = new Array("01", "02", "03", "04", "05", "06", "07", "08", 
"09", "10", "11", "12") 
var monthDays = new Array("31", "28", "31", "30", "31", "30", "31", "31", "30", "31", "30", "31") 
if (year%4 == 0){ 
monthDays = new Array("31", "29", "31", "30", "31", "30", "31", "31", "30", "31", "30", "31") 
} 
if(year%100 == 0 && year%400 != 0){ 
monthDays = new Array("31", "28", "31", "30", "31", "30", "31", "31", "30", "31", "30", "31") 
} 
if (hr >= 24){ 
hr = hr-24 
day -= -1 
} 
if (hr < 0){ 
hr -= -24 
day -= 1 
} 
if (hr < 10){ 
hr = " " + hr 
} 
if (min < 10){ 
min = "0" + min 
} 
if (sec < 10){ 
sec = "0" + sec 
} 
if (day <= 0){ 
if (month == 0){ 
month = 11 
year -= 1 
} 
else{ 
month = month -1 
} 
day = monthDays[month] 
} 
if(day > monthDays[month]){ 
day = 1 
if(month == 11){ 
month = 0 
year -= -1 
} 
else{ 
month -= -1 
} 
} 
return city+": " + year + "-"+monthArray[month] + "-" + day + " " + hr + ":" + min + ":" + sec 
//return "The local time in " + city + " is " + nd.toLocaleString()+; 
} 
function worldClockZone(){ 
document.getElementById('local').innerHTML = calcTime('美东时间','-4'); 

setTimeout("worldClockZone()", 1000) 
} 
window.onload=worldClockZone; 
</script> 
	 </ul>     
	 </div>
        <div class="menu1">
			<ul>
                <li ><a href="javascript:void(0);" onclick="reflash();return false">刷新数据</a></li>
			</ul>
		</div>
		<div class="menu">
			<ul>
				<li <?=$main==1?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>userinfo.php');return false">我的账户</a></li>
				<li <?=$main==2?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>set_money.php');return false">财务中心</a></li>
				<li <?=$main==3?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>record_ty.php');return false">下注记录</a></li>
				<li <?=$main==4?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>report.php');return false">历史报表</a></li>
				<?php if($is_daili==1){ ?>
				<li <?=$main==5?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>agent.php');return false">代理中心</a></li>
				<?php }else{ ?>
				<li <?=$main==5?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>agent_reg.php');return false">申请代理</a></li>
				<?php } ?>
			</ul>
		</div>

      
</div>