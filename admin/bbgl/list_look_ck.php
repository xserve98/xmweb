<?php
include_once("../common/login_check.php");
check_quanxian("bbgl");

$uid		=	$_GET["uid"];
$stime		=	$_GET["s_time"];
$etime		=	$_GET["e_time"];
$type		=	$_GET["type"];
$username	=	$_GET["username"];
$wtype		=	$_GET["wtype"];
$wtarr		=	wtype($wtype);
$wstr		=	"";
for($i=0; $i<count($wtarr); $i++){
	$wstr.="'".$wtarr[$i]."',";
}
$wstr		=	substr($wstr,0,-1);

$time	=	'EN'; //默认为美东时间
if(isset($_GET['time'])) $time = $_GET['time'];
if($time == 'EN'){ //美东时间
	$stime1		=	$stime;
	$etime1		=	$etime;
}else{ //中国时间
	$stime1		=	date("Y-m-d H:i:s",strtotime($stime)-43200); //取中国时间
	$etime1		=	date("Y-m-d H:i:s",strtotime($etime)-43200); //取中国时间
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>存款报表</TITLE>
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
.STYLE3 {
	color: #FF0000;
	font-weight: bold;
}
.STYLE4 {
	color: #0000FF;
	font-weight: bold;
}
</STYLE>
<script language="javascript">
function go(value){
	if(value != "") location.href=value;
	else return false;
}
</script>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">注单管理：查看所有注单情况（所有时间以美国东部标准为准）</span></font></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15" colspan="2" align="center" bgcolor="#FFFFEE"><span class="STYLE4">未结算</span></td>
    <td width="26%" colspan="2" align="center" bgcolor="#FFF0F1"><span class="STYLE3">已结算</span></td>
    <td width="16%" rowspan="2" align="center" valign="middle" bgcolor="#E1FFE1"><a href="list_look_ck.php?ys=ck&s_time=<?=$stime?>&e_time=<?=$etime?>&type=<?=$type?>&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">存款</a></td>
    <td width="16%" rowspan="2" align="center" valign="middle" bgcolor="#E1DFFF"><a href="list_look_hk.php?ys=hk&s_time=<?=$stime?>&e_time=<?=$etime?>&type=<?=$type?>&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">汇款</a></td>
    <td width="16%" rowspan="2" align="center" valign="middle" bgcolor="#FFE1E1"><a href="list_look_qk.php?ys=qk&s_time=<?=$stime?>&e_time=<?=$etime?>&type=<?=$type?>&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">取款</a></td>
  </tr>
  <tr>
    <td width="13%" height="15" align="center" bgcolor="#E6FFEB"><a href="list_look_ds.php?ys=ds&s_time=<?=$stime?>&e_time=<?=$etime?>&type=N&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">单式</a></td>
    <td width="13%" align="center" bgcolor="#E1E2FF"><a href="list_look_cg.php?ys=cg&s_time=<?=$stime?>&e_time=<?=$etime?>&type=N&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">串关</a></td>
    <td height="14" align="center" bgcolor="#E6FFEB"><a href="list_look_ds.php?ys=ds&s_time=<?=$stime?>&e_time=<?=$etime?>&type=Y&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">单式</a></td>
    <td align="center" bgcolor="#E1E2FF"><a href="list_look_cg.php?ys=cg&s_time=<?=$stime?>&e_time=<?=$etime?>&type=Y&uid=<?=$uid?>&username=<?=$username?>&wtype=<?=$wtype?>">串关</a></td>
  </tr>
</table>
   <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
      <tr bgcolor="efe" class="t-title" align="center">
        <td width="7%" ><strong>编号</strong></td>
        <td width="7%" ><select onchange="javascript:go(this.value)">
            <option value="<?=$_SERVER["REQUEST_URI"]?>&time=EN" <?=$time=='EN' ? 'selected' : ''?>>美东时间</option>
            <option value="<?=$_SERVER["REQUEST_URI"]?>&time=CN" <?=$time=='CN' ? 'selected' : ''?>>中国时间</option>
          </select></td>
        <td width="44%" ><strong>系统订单号</strong></td>
        <td width="10%"><strong>存款金额</strong></td>
        <td width="10%"><strong>手续费</strong></td>
        <td width="15%" ><strong>申请时间</strong></td>
        <td width="7%" ><strong>状态</strong></td>
        </tr>  
<?php
include_once("../../include/mysqli.php");

$money		=	$sxf	=	0;
$sql		=	"select m_id,m_order,m_value,m_make_time,about,sxf from k_money where m_value>=0 and `status`=1 and uid=$uid and m_make_time>='$stime1' and m_make_time<='$etime1' order by m_id desc";
$query		=	$mysqli->query($sql);
while($rows = $query->fetch_array()){
	$money	+=	$rows["m_value"];
	$sxf	+=	$rows["sxf"];
?> 
      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" >
        <td  height="35" align="center"  ><?=$rows["m_id"]?></td>
        <td><?=$time=='EN' ? '美东时间' : '中国时间'?></td>
        <td><?=$rows["m_order"]?><br /><span style="color:#CCCCCC"><?=$rows["about"]?></span></td>
        <td><?=$rows["m_value"]?></td>
        <td><?=$rows["sxf"]?></td>
        <td><?=$time=='EN' ? $rows["m_make_time"] : get_bj_time($rows["m_make_time"])?></td>
        <td><span style='color:#009900;'>存款成功</span></td>
        </tr>     	
<?php
}
?>
  </table>  </tr>
    <tr>
      <td >该页统计：总存款：<span style="color:#FF0000"><?=$money?></span>，手续费：<span style="color:#FF00FF"><?=$sxf?></span></td>
     </tr>
</table>
</body>
</html>