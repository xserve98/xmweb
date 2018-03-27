<?php
include_once("../common/login_check.php");
check_quanxian("cwgl");

$time	=	$_GET["time"];
$time	=	$time==""?"CN":$time;
$status	=	$_GET["status"];
$order	=	$_GET["order"];
$order	=	$order==""?"id":$order;
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
$bank	=	$_GET["bank"];
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户充值申请</TITLE>
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
    <td height="24" nowrap background="../images/06.gif"><font ><span class="STYLE2">充值管理：查看所有的用户充值信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><table width="100%" cellspacing="0" cellpadding="0" border="0">
     <form name="form1" method="GET" action="chongzhi.php" >
      <tr>
        <td align="left"><select name="order" id="order">
         <option value="id" <?=$order=='id' ? 'selected' : ''?>>默认排序</option>
        <option value="money" <?=$order=='money' ? 'selected' : ''?>>充值金额</option>
        <option value="zsjr" <?=$order=='zsjr' ? 'selected' : ''?>>赠送金额</option>
        </select>
		&nbsp;<select name="status" id="status">
            <option value="2" <?=$status=='0' ? 'selected' : ''?> style="color:#FF0000;">充值失败</option>
            <option value="1" <?=$status=='1' ? 'selected' : ''?> style="color:#006600;">充值成功</option>
            <option value="3" <?=$status=='3' ? 'selected' : ''?>>全部充值</option>
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
        <td width="5%" height="24" ><strong>编号</strong></td>
		   <td width="5%" height="24" ><strong>会员名/uid</strong></td>
        <td width="20%" ><strong>订单号/提交时间</strong></td>
        <td width="10%"><strong>充值金额</strong></td>
        <td width="10%"><strong>赠送金额</strong></td>
        <td width="10%"><strong>查看财务</strong></td>
        <td width="10%" ><strong>充值银行</strong></td>
        <td width="8%" ><strong>操作</strong></td>
        </tr>
<?php
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

$sqlwhere	=	"";
if($status!=3){
	$sqlwhere	.=	" and status=".$status;
}
if($username!=""){
	$sqlwhere	.=	" and uid=(select uid from k_user where username='$username')";
}
if($bank!=""){
	$sqlwhere	.=	" and bank='".$bank."'";
}
if($time=="CN"){
	$q_btime	=	date("Y-m-d H:i:s",strtotime($btime));
	$q_etime	=	date("Y-m-d H:i:s",strtotime($etime));
}else{
	$q_btime	=	$btime;
	$q_etime	=	$etime;
}
$sql	=	"select id from huikuan where money>0 ".$sqlwhere." and `adddate`>='$q_btime' and `adddate`<='$q_etime' and cztype = 1  order by $order desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);

$id			=	'';
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
$m_sum	=	$t_sum	=	$f_sum	=	$c_sum	=	$zs_sum	=	0;
if($id){
	$id		=	rtrim($id,',');
	$arr	=	array();
	$sql	=	"select huikuan.*,k_user.username from huikuan left outer join k_user on huikuan.uid=k_user.uid where id in ($id) order by $order desc";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
		$m_sum +=	$rows["money"];
		$zs_sum+=	$rows["zsjr"];
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" >
        <td  height="35" align="center" ><?=$rows["id"]?></td>
		 <td  height="35" align="center" ><?=$rows["username"]?>/<?=$rows["uid"]?></td>
        <td><a href="hk_look.php?id=<?=$rows["id"]?>"><?=$rows["lsh"]?></a><br/><?=$rows["adddate"]?></td>
        <td><span style="color:#999999;"><?=sprintf("%.2f",$rows["assets"])?></span><br /><?=sprintf("%.2f",$rows["money"])?><br /><span style="color:#999999;"><?=sprintf("%.2f",$rows["balance"])?></span></td>
        <td><?=sprintf("%.2f",$rows["zsjr"])?></td>
        <td><a href="hccw.php?username=<?=$rows["username"]?>">查看财务</a></td>
        <td><a href="<?=$_SERVER["REQUEST_URI"]?>&bank=<?=$rows["bank"]?>">
        
        <?php if($rows["bank"]=="992"){
								echo "支付宝";
								}else if($rows["bank"]=="1004"){
									echo "微信";
									}else if($rows["bank"]=="银行转账"){
											echo "银行转账";
												}else if($rows["bank"]=="支付宝转账"){
											echo "支付宝转账";
												}else if($rows["bank"]=="微信转账"){
											echo "微信转账";
										
									}else{
										echo "网银";
										}
							
							?>充值
        </a></td>

        <td><?php
			  if($rows["status"]==1){
			  	$t_sum += $rows["money"];
			  	echo '<span style="color:#006600;">充值成功</span>';
			  }else if($rows["status"]==0){
			  	$f_sum += $rows["money"];
			  	echo '<span style="color:#FF0000;">充值失败</span>';
			  }else{
			  	$c_sum += $rows["money"];
				echo '<span style="color:#FF9900;">审核中</span>';
			  }
			  ?><br /><?php if($rows["status"]){?><a href="hk_rq.php?id=<?=$rows["id"]?>&status=<?=$rows["status"]?>" onClick="return confirm('您真的要重新结算吗？');">重新结算</a><?php }?></td>
        </tr>
<?php
	}
}
?>
    </table></td>
  </tr>
  <tr>
    <td style="line-height:24px;"><div>总金额：<span style="color:#0000FF"><?=sprintf("%.2f",$m_sum)?></span>，成功：<span style="color:#006600"><?=sprintf("%.2f",$t_sum)?></span>，赠送金额：<span style="color:#FF00FF"><?=sprintf("%.2f",$zs_sum)?></span>，失败：<span style="color:#FF0000"><?=sprintf("%.2f",$f_sum)?></span>，审核：<span style="color:#FF9900"><?=sprintf("%.2f",$c_sum)?></span></div>
	<div><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></div></td>
  </tr>
</table>
</body>
</html>