<?php
include_once("../common/login_check.php");
check_quanxian("cwgl");
$sum = $sumzz = $true = $false = $cl = 0;

$time_type = 'CN'; //默认为中国时间
if(isset($_GET['time_type'])) $time_type = $_GET['time_type'];

include_once("../../include/mysqli.php");
/* 删除7天前转账记录 */
if(@$_GET['act']=='ok')
{
	$time=strtotime(date("Y-m-d"));
	$time=strftime("%Y-%m-%d",$time-6*24*3600).' 00:00:00';
	$sql="Delete From `ag_zhenren_zz` Where zz_time<'$time'";
	$query=$mysqli->query($sql);
	message("删除成功！");
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>转账记录</TITLE>
<script language="javascript">
function go(value){
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
    <td height="24" nowrap background="../images/06.gif"><font ><span class="STYLE2">转账查询：查看所有的用户转账记录</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><table width="100%">
      <tr>
		<form name="form1" method="GET" action="zhuanzhang.php?ok=" >
        <td width="110" align="center"><select name="live_type" id="live_type">
            <option value="AG" <?=$_GET["live_type"]=='AG' ? 'selected' : ''?>>AG</option>
            <option value="" <?=$_GET["live_type"]=='' ? 'selected' : ''?>>全部平台</option>
          </select></td>
        <td width="110" align="center"><select name="ok" id="ok">
            <option value="0" <?=$_GET["ok"]=='0' ? 'selected' : ''?>>转账中</option>
            <option value="1" <?=$_GET["ok"]=='1' ? 'selected' : ''?>>转账成功</option>
            <option value="2" <?=$_GET["ok"]=='2' ? 'selected' : ''?>>转账失败</option>
            <option value="" <?=$_GET["ok"]=='' ? 'selected' : ''?>>全部转账</option>
          </select></td>
        <td width="110" align="center"><label>
          <select name="time_type" id="time_type">
            <option value="CN" <?=$time_type=='CN' ? 'selected' : ''?>>中国时间</option>
            <option value="EN" <?=$time_type=='EN' ? 'selected' : ''?>>美东时间</option>
          </select>
        </label></td>
        <td align="left" width="470">日期：
          <input name="zz_time" type="text" id="zz_time" value="<?=@$_GET['zz_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" />
          &nbsp;&nbsp;会员名称：
          <input name="username" type="text" id="username" value="<?=@$_GET['username']?>" size="15" maxlength="20"/>          &nbsp;&nbsp;
          <input name="find" type="submit" id="find" value="查找"/></td>
		  </form>
		  <form name="form2" method="GET" action="zhuanzhang.php?ok=" onsubmit="return(confirm('您确定要删除7天前所有转账记录？'))">
		  <td align="left">
			<input name="act" type="hidden" id="act" value="ok"/>
			<input name="del" type="submit" id="del" value="删除7天前转账记录"/></td>
		  </form>
        </tr>
    </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
      <tr bgcolor="efe" class="t-title" align="center">
        <td width="12%"><strong>用户名</strong></td>
        <td width="12%"><strong>真人用户名</strong></td>
        <td width="20%"><strong>转账类型</strong></td>
        <td width="12%"><strong>转账金额</strong></td>
        <td width="16%"><strong>转账时间</strong></td>
        <td width="10%"><strong>状态</strong></td>
        <td width="18%"><strong>处理结果</strong></td>
        </tr>    
<?php
include_once("../../include/newpage.php");

$sql		=	"select id from ag_zhenren_zz where 1=1";
if(isset($_GET["live_type"])){
	if($_GET["live_type"] != '') $sql .=	" and live_type='".$_GET["live_type"]."'";
}
if(isset($_GET["ok"])){
	if($_GET["ok"] != '') $sql .=	" and ok='".$_GET["ok"]."'";
}
if($_GET["username"]){
	$sql	.=	" and username ='".$_GET["username"]."'";
}
if($_GET["zz_time"]){
	if($time_type == 'CN'){
		$stime	 =	date("Y-m-d H:i:s",strtotime($_GET["zz_time"])-43200);
		$etime	 =	date("Y-m-d H:i:s",strtotime($stime)+86399);
	}else{
		$stime	 =	$_GET["zz_time"].' 00:00:00';
		$etime	 =	$_GET["zz_time"].' 23:59:59';
	}
	$sql	.=	" and zz_time>='$stime' and zz_time<='$etime'";
}
$sql		.=	" order by id desc";

$query	=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);

$id		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$id .=	$row['id'].',';
  }
  if($i > $end) break;
  $i++;
}

if($id){
	$id		=	rtrim($id,',');
	$sql	=	"select * from ag_zhenren_zz where id in ($id) order by id desc";
	$query	=	$mysqli->query($sql);
	
	$inmoney=0;
	$outmoney=0;
	
	while($rows = $query->fetch_array()){
		if($rows["zz_type"]=='d') $zz_type='体育/彩票 → 真人账户';
		else if($rows["zz_type"]=='vd') $zz_type='体育/彩票账户 → 真人(VIP厅)';
		else if($rows["zz_type"]=='w') $zz_type='真人账户 → 体育/彩票';
		else $zz_type='真人(VIP厅) → 体育/彩票账户';
		if($rows["ok"]==0) $zz_ok='处理中';
		else $zz_ok='已处理';
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" >
        <td height="35" align="center"><?=$rows["username"]?></td>
        <td><?=$rows["zr_username"]?></td>
        <td><?=$zz_type?></td>
        <td><span style="color:#999999;"><?=double_format($rows["moneyA"])?></span><br><?=double_format($rows["zz_money"])?><br><span style="color:#999999;"><?=double_format($rows["moneyB"])?></span></td>
        <td><?=$time_type=='CN' ? date('Y-m-d H:i:s',strtotime($rows["zz_time"])) : date('Y-m-d H:i:s',strtotime($rows["zz_time"]))?></td>
		<td><?=$zz_ok?></td>
        <td><? if($rows["ok"]=='1'){//成功
				echo "<span style='color:#009900;'>".$rows["result"]."</span>";
				if ($rows["zz_type"]=='d') {
					$inmoney	+=	abs($rows["zz_money"]);
				} else if ($rows["zz_type"]=='w') {
					$outmoney	+=	abs($rows["zz_money"]);
				}
		 	}else if($rows["ok"]=='2'){//失败
				echo "<span style='color:#FF0000;'>".$rows["result"]."</span>";
		 	}else{//处理中
				echo $rows["result"];
		 	}
		?></td>
        </tr>
<?php
      }
}
?>
    </table></td>
  </tr>
  <tr>
    <td style="line-height:24px;"><div>本页转账成功：[转入]<span style="color:#006600"><?=double_format($inmoney)?></span>，[转出]<span style="color:#ff0000;"><?=double_format($outmoney)?></span></div>
	<div><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></div></td>
  </tr>
</table>
</body>
</html>