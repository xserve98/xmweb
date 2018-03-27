<?php
include_once("../common/login_check.php");
check_quanxian("dlgl");
include_once("../../include/mysqli.php");
include_once("../../include/function_dled.php");
function sum($num){
	return $num=='' ? 0 : $num;
}
$data_k	= 	$data_o	=	date('Y-m-d',time()); //默认为当天
if ($_REQUEST['data_k']!=''){
	$data_k	= $_REQUEST['data_k'];
}
if ($_REQUEST['data_o']!=''){
	$data_o	= $_REQUEST['data_o'];
}
$u_arr		=	array();
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>代理结算</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
<script type="text/javascript" src="../../js/calendar.js"></script>
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
a{color:#FFA93E;}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
.STYLE3 {color: #FF0000}
</STYLE>

<script>
function ckall(){
    for (var i=0;i<document.form2.elements.length;i++){
	    var e = document.form2.elements[i];
		if (e.name != 'checkall') e.checked = document.form2.checkall.checked;
	}
}

function check(){
    var len = document.form2.elements.length;
	var num = false;
    for(var i=0;i<len;i++){
		var e = document.form2.elements[i];
        if(e.checked && e.name=='r_id[]'){
			num = true;
			break;
		}
    }
	if(num){
		var action = document.getElementById("s_action").value;
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}else if(action=="2"){
			document.form2.action="re_dailijisuan.php";
		}
		return true;
	}else{
        alert("您未选中任何复选框");
        return false;
    }
}
</script>
</HEAD>
<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">代理月额度：对所有代理会员进行结算</span></font></td>
  </tr>
  <form action="?uid=<?=$_REQUEST['uid']?>" method="get">
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
      <a href="javascript:window.history.back(-1)"><strong><font color="#FF0000">返回上一页</font></strong></a></td>
  </tr>
  </form>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
    <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" align="center"  >
      <tr style="background-color: #EFE" class="t-title" align="center">
        <td   height="20" align="center"><strong>会员账号</strong></td>
        <td  ><strong>体育注单</strong></td>
        <td  ><strong>体育投注额</strong></td>
        <td ><strong>体育输赢</strong></td>
        <td ><strong>彩票注单</strong></td>
        <td ><strong>彩票投注额</strong></td>
        <td ><strong>彩票输赢</strong></td>
        <td ><strong>反水总额</strong></td>
        <td ><strong>存款总额</strong></td>
        <td ><strong>提款总额</strong></td>
        <td ><strong>手续费</strong></td>
        <td ><strong>红利/赠送</strong></td>
        </tr>
<?php
//读取下级会员UID
$sql	=	"select uid from k_user where top_uid=".$_REQUEST["uid"]." order by uid desc";
$query	=	$mysqli->query($sql);
while($row = $query->fetch_array()){
	$uids = $uids.$row['uid'].',';
}
$uids = $uids.'0';
//根据会员UID读取会员投注记录
$sql	=	"select uid from k_bet where uid in(".$uids.") and bet_time>='".$data_k." 00:00:00' and bet_time<='".$data_o." 23:59:59' and status in(1,2,4,5) group by uid order by uid desc";
$query	=	$mysqli->query($sql);
$i = 1;
$tytz_z = 0;
$tysy_z = 0;
$cptz_z = 0;
$cpsy_z = 0;
$hyck_z = 0;
$hyqk_z = 0;
$fs_z = 0;
$sxf_z = 0;
$qt_z = 0;
while($row = $query->fetch_array()){
//根据UID读取会员账号
$sql_name		=	"select username,agents from k_user where uid=".$row['uid'].""; 
$query_name		=	$mysqli->query($sql_name);
$row_name		=	$query_name->fetch_array();
//开始计算单式有效注单,有效投注,输赢结果,反水总额
$sql_ds		=	"select count(bid) as num,sum(bet_money) as bet_money,sum(win) as win,sum(fs) as fs from k_bet where status in(1,2,4,5) and match_coverdate>='".$data_k." 00:00:00' and match_coverdate<='".$data_o." 23:59:59' and uid=".$row['uid']."";
$query_ds	=	$mysqli->query($sql_ds);
$row_ds		=	$query_ds->fetch_array();
$ds_sy		=	sum($row_ds['bet_money']-$row_ds['win']-$row_ds['fs']);
//开始计算串关有效注单,有效投注,输赢结果,反水总额
$sql_cg		=	"select count(gid) as num,sum(bet_money) as bet_money,sum(win) as win,sum(fs) as fs from k_bet_cg_group where status=1 and match_coverdate>='".$data_k." 00:00:00' and match_coverdate<='".$data_o." 23:59:59' and uid=".$row['uid']."";
$query_cg	=	$mysqli->query($sql_cg);
$row_cg		=	$query_cg->fetch_array();
$cg_sy		=	sum($row_cg['bet_money']-$row_cg['win']-$row_cg['fs']);
$zhudan		=	$row_ds['num']+$row_cg['num'];
$kuiying	=	$ds_sy+$cg_sy;
$youxiaotz	=	sum($row_ds['bet_money']+$row_cg['bet_money']);
$fanshui	=	sum($row_ds['fs']+$row_cg['fs']);
if($kuiying<=0){
	$kuiyings = $kuiying;
}else{
	$kuiyings = '<font color="#FF0000">'.$kuiying.'</font>';
}
//开始计算单式投注总额
$sql_dsz		=	"select sum(bet_money) as bet_money from k_bet where match_coverdate>='".$data_k." 00:00:00' and match_coverdate<='".$data_o." 23:59:59' and uid=".$row['uid']."";
$query_dsz	=	$mysqli->query($sql_dsz);
$row_dsz		=	$query_dsz->fetch_array();
//开始读取本月存款数据
$sql_ck		=	"select sum(m_value) as money,sum(sxf) as sxf from k_money where status=1 and m_value>0 and m_make_time>='".$data_k." 00:00:00' and m_make_time<='".$data_o." 23:59:59' and about='' and uid in(".$row['uid'].")"; 
$query_ck	=	$mysqli->query($sql_ck);
$row_ck		=	$query_ck->fetch_array();
//开始计算彩票有效注单,有效投注,输赢结果,反水总额
$sql_cp		=	"select count(id) as num,sum(money) as bet_money,sum(win) as win from lottery_data where agent='".$row_name['agents']."' and bet_ok=1 and bet_time>='".$data_k." 00:00:00' and bet_time<='".$data_o." 23:59:59' and username='".$row_name['username']."'";
$query_cp	=	$mysqli->query($sql_cp);
$row_cp		=	$query_cp->fetch_array();
$shuying_cp		=	sum($row_cp['win']);
if($shuying_cp<=0){
	$shuying_cp = $shuying_cp;
}else{
	$shuying_cp = '<font color="#FF0000">'.$shuying_cp.'</font>';
}
//开始读取本月汇款款数据
$sql_hk		=	"select sum(money) as money,sum(zsjr) as sxf from huikuan where status=1 and adddate>='".$data_k." 00:00:00' and adddate<='".$data_o." 23:59:59' and uid in(".$row['uid'].")"; 
$query_hk	=	$mysqli->query($sql_hk);
$row_hk		=	$query_hk->fetch_array();
$cunkuan	=	sum($row_ck['money']+$row_hk['money']);
//开始读取本月提款数据
$sql_tk		=	"select sum(m_value) as money,sum(sxf) as sxf from k_money where status=1 and m_value<0 and m_make_time>='".$data_k." 00:00:00' and m_make_time<='".$data_o." 23:59:59' and uid in(".$row['uid'].")"; 
$query_tk	=	$mysqli->query($sql_tk);
$row_tk		=	$query_tk->fetch_array();
//开始读取红利,赠送
$sql_hl		=	"select sum(m_value) as money from k_money where status=1 and m_value>0 and m_make_time>='".$data_k." 00:00:00' and m_make_time<='".$data_o." 23:59:59' and about!='' and uid in(".$row['uid'].")"; 
$query_hl	=	$mysqli->query($sql_hl);
$row_hl		=	$query_hl->fetch_array();
$hongli		=	sum($row_ck['sxf']+$row_hk['sxf']+$row_hl['money']);
?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
	          <td height="20"><?=$row_name['username']?></td>
              <td><font color="#FF0000">
                <?=$zhudan?>
              </font></td>
              <td><?=sum($row_dsz['bet_money'])?></td>
              <td><?=$kuiyings?></td>
              <td><font color="#FF0000">
                <?=$row_cp['num']?>
              </font></td>
              <td><?=sum($row_cp['bet_money'])?></td>
              <td><?=$shuying_cp?></td>
              <td><?=$fanshui?></td>
              <td><?=$cunkuan?></td>
              <td><?=sum($row_tk['money'])?></td>
              <td><?=sum($row_tk['sxf'])?></td>
              <td><?=$hongli?></td>
          </tr>   	
<?php
$i = $i+1;
$tytz_z = $tytz_z+sum($row_dsz['bet_money']);
$tysy_z = $tysy_z+$kuiyings;
$cptz_z = $cptz_z+sum($row_cp['bet_money']);
$cpsy_z = $cpsy_z+$shuying_cp;
$hyck_z = $hyck_z+$cunkuan;
$hyqk_z = $hyqk_z+sum($row_tk['money']);
$fs_z = $fs_z+$fanshui;
$sxf_z = $sxf_z+sum($row_tk['sxf']);
$qt_z = $qt_z+$hongli;
}
?>
<tr style="color:#FFF;">
    <td colspan="12" align="center" bgcolor="#000000">体育投注额：<font color="#FFFF00"><?=$tytz_z?></font> 体育输赢：<font color="#FFFF00"><?=$tysy_z?></font> 彩票投注额：<font color="#FFFF00"><?=$cptz_z?></font> 彩票输赢：<font color="#FFFF00"><?=$cpsy_z?></font> 反水总计：<font color="#FFFF00"><?=$fs_z?></font> 手续费总计：<font color="#FFFF00"><?=$sxf_z?></font> 其他费用：<font color="#FFFF00"><?=$qt_z?></font> </td>
    </tr>
</table>
    </td>
  </tr>
  <tr><td >
  </td></tr>
</table>
</body>
</html>