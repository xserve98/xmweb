<?php
include_once("../common/login_check.php");
check_quanxian("cwgl");
function getstatus($status){
   $return="";
   switch ($status){
   	case 0:$return="失败";break;
   	case 1:$return="成功";break;
   	case 2:$return="待处理";break;
   	default:break;
   }
   return $return;
}

$time	=	$_GET["time"];
$time	=	$time==""?"CN":$time;
$status	=	$_GET["status"];
$order	=	$_GET["order"];
$order	=	$order==""?"m_id":$order;
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
$btime	=	$bdate." ".$bhour.":".$bsecond.":00";
$etime	=	$edate." ".$ehour.":".$esecond.":59";
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户积分管理</TITLE>
<script language="javascript">
function go(value)
{
location.href=value;
}
</script>
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
    <td height="24" nowrap background="../images/06.gif"><font ><span class="STYLE2">积分记录：查看所有的用户积分记录</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><table width="100%" cellspacing="0" cellpadding="0" border="0">
     <form name="form1" method="GET" action="jifen.php" >
      <tr>
        <td align="left">&nbsp;<select name="status" id="status">
            <option value="0" <?=$status=='0' ? 'selected' : ''?> style="color:#FF9900;">所有记录</option>
            <option value="1" <?=$status=='1' ? 'selected' : ''?> style="color:#FF0000;">投注赠送</option>
            <option value="2" <?=$status=='2' ? 'selected' : ''?> style="color:blue;">充值赠送</option>
            <option value="3" <?=$status=='3' ? 'selected' : ''?> style="color:#006600;">积分兑换</option>
          </select>
          &nbsp;会员名称
          <input name="username" type="text" id="username" value="<?=@$_GET['username']?>" size="15" maxlength="20"/></td>
        </tr>
		<tr>
		<td align="left">开始日期
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
		分
		&nbsp;<input name="find" type="submit" id="find" value="查找"/>
		</td>
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
        <td width="6%" ><strong>编号</strong></td>
         <td width="6%" ><strong>会员</strong></td>
        <td width="20%" ><strong>订单号</strong></td>
        <td width="8%"><strong>类型</strong></td>
        <td width="8%"><strong>积分数</strong></td>
        <td width="8%"><strong>时间</strong></td>
        <td width="8%"><strong>其它说明</strong></td>
        <td width="6%" ><strong>操作</strong></td>
        </tr>
<?php
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

$sqlwhere	=	"";
if($status!=0){
	$sqlwhere	.=	" and type=".intval($status);
}
if($username!=""){
	$sqlwhere	.=	" and uid=(select uid from k_user where username='$username')";
}
if($time=="CN"){
	$q_btime	=	date("Y-m-d H:i:s",strtotime($btime));
	$q_etime	=	date("Y-m-d H:i:s",strtotime($etime));
}else{
	$q_btime	=	$btime;
	$q_etime	=	$etime;
}
$sql	=	"select m_id from k_jifen where `m_make_time`>='$q_btime' and `m_make_time`<='$q_etime' ".$sqlwhere." order by $order desc";
//echo $sql;
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);

$mid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$mid .=	$row['m_id'].',';
  }
  if($i > $end) break;
  $i++;
}
$c_sum	=	$m_sum	=	$t_sum	=	$f_sum	=	$sxf_sum	=	0;
if($mid){
	$mid	=	rtrim($mid,',');
	$arr	=	array();
	$sql	=	"select k_jifen.*,k_user.username from k_jifen left outer join k_user on k_jifen.uid=k_user.uid where m_id in ($mid) order by $order desc";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
		$money	=	abs($rows["m_value"]);
		$m_sum +=	$money;
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
        <td height="20" align="center"  ><?=$rows["m_id"]?></td>
        <td height="20" align="center"  ><?=$rows["username"]?></td>
        <td><?=$rows["m_order"]?></td>
        <td><?=$rows["gametype"]?></td>
        <td><?=$rows['type']==1 ? "<font color='#009900'>+".sprintf("%.2f",$rows["m_value"]).'</font>' : "<font color='red'>-".sprintf("%.2f",$rows["m_value"]).'</font>'?></td>
         <td><?=$time=='CN' ? get_bj_time($rows["m_make_time"]) : $rows["m_make_time"]?></td>
        <td><?=$rows["about"]?></td>
        <td>--</td>
        </tr>
<?php
	}
}	 
?>
    </table></td>
  </tr>
  <tr>
    <td style="line-height:24px;"><div>总积分：<span style="color:#0000FF"><?=sprintf("%.2f",$m_sum)?></span>&nbsp;&nbsp;</div>
	<div><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></div></td>
  </tr>
</table>
</table>
</body>
</html>