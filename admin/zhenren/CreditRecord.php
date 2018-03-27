<?php
include_once("../common/login_check.php");
check_quanxian("ssgl"); 
include_once("../../include/mysqli.php");
include("../../include/pager.class.php");
include("CommonFun.php");

$username = trim($_GET["username"]);
$tradeNo = trim($_GET["tradeNo"]);
$transferType = $_GET["transferType"];

$betDate1 = $_GET["betDate1"];
$betHour1 = $_GET["betHour1"];
$betSecond1 = $_GET["betSecond1"];
$betDate1 = $betDate1==""?date("Y-m-d",time()):$betDate1;
$betHour1 = $betHour1==""?"00":$betHour1;
$betSecond1 = $betSecond1==""?"00":$betSecond1;

$betDate2 = $_GET["betDate2"];
$betHour2 = $_GET["betHour2"];
$betSecond2 = $_GET["betSecond2"];
$betDate2 = $betDate2==""?date("Y-m-d",time()):$betDate2;
$betHour2 = $betHour2==""?"23":$betHour2;
$betSecond2 = $betSecond2==""?"59":$betSecond2;

$betTime1 = $betDate1." ".$betHour1.":".$betSecond1.":00";
$betTime2 = $betDate2." ".$betHour2.":".$betSecond2.":59";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome</title>
	<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
	<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
	<script language="JavaScript" src="/js/calendar.js"></script>
</head>
<body>
<div id="pageMain">
	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td valign="top">
				<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="font12" style="border:1px solid #798EB9;">
					<form name="form1" method="get" action="<?=$_SERVER["REQUEST_URI"]?>">
						<tr>
							<td align="left">
								会员
								<input name="username" type="text" id="username" value="<?=$username?>" size="12" />
								&nbsp;&nbsp;交易单号
								<input name="tradeNo" type="text" id="tradeNo" value="<?=$tradeNo?>" size="16" />
								&nbsp;&nbsp;交易类型
								<select name="transferType" id="transferType">
									<option value="">1.全部</option>
									<option value="IN" <?=$transferType=="IN"?"selected":""?>>2.转入额度</option>
									<option value="OUT" <?=$transferType=="OUT"?"selected":""?>>3.转出额度</option>
									<option value="BET" <?=$transferType=="BET"?"selected":""?>>4.下注</option>
									<option value="CANCEL_BET" <?=$transferType=="CANCEL_BET"?"selected":""?>>5.系统取消下注</option>
									<option value="RECKON" <?=$transferType=="RECKON"?"selected":""?>>6.派彩</option>
									<option value="RECALC" <?=$transferType=="RECALC"?"selected":""?>>7.重新派彩</option>
									<option value="DONATEFEE" <?=$transferType=="DONATEFEE"?"selected":""?>>8.玩家小费</option>
									<option value="GBED" <?=$transferType=="GBED"?"selected":""?>>9.代理修改额度</option>
									<option value="RECALC_ERR" <?=$transferType=="RECALC_ERR"?"selected":""?>>10.重新派彩时扣款失败</option>
									<option value="CHANGE_CUS_BALANCE" <?=$transferType=="CHANGE_CUS_BALANCE"?"selected":""?>>11.修改玩家账户额度</option>
									<option value="RESET_CUS_CREDIT" <?=$transferType=="RESET_CUS_CREDIT"?"selected":""?>>12.重置玩家信用额度</option>
									<option value="CHANGE_CUS_CREDIT" <?=$transferType=="CHANGE_CUS_CREDIT"?"selected":""?>>13.修改玩家信用额度</option>
								</select>
							</td>
						</tr>
						<tr>
							<td align="left">
								交易时间
								<input name="betDate1" type="text" id="betDate1" value="<?=$betDate1?>" onClick="new Calendar(2008,2020).show(this);" size="8" maxlength="10" readonly="readonly" />
								<select name="betHour1" id="betHour1">
									<?php
									for ($i=0;$i<24;$i++) {
										$hour = $i<10?"0".$i:$i;
									?>
									<option value="<?=$hour?>" <?=$betHour1==$hour?"selected":""?>><?=$hour?></option>
									<?php } ?>
								</select>
								时
								<select name="betSecond1" id="betSecond1">
									<?php
									for ($i=0;$i<60;$i++) {
										$second = $i<10?"0".$i:$i;
									?>
									<option value="<?=$second?>" <?=$betSecond1==$second?"selected":""?>><?=$second?></option>
									<?php } ?>
								</select>
								分
								&nbsp;&nbsp;到
								<input name="betDate2" type="text" id="betDate2" value="<?=$betDate2?>" onClick="new Calendar(2008,2020).show(this);" size="8" maxlength="10" readonly="readonly" />
								<select name="betHour2" id="betHour2">
									<?php
									for ($i=0;$i<24;$i++) {
										$hour = $i<10?"0".$i:$i;
									?>
									<option value="<?=$hour?>" <?=$betHour2==$hour?"selected":""?>><?=$hour?></option>
									<?php } ?>
								</select>
								时
								<select name="betSecond2" id="betSecond2">
									<?php
									for ($i=0;$i<60;$i++) {
										$second = $i<10?"0".$i:$i;
									?>
									<option value="<?=$second?>" <?=$betSecond2==$second?"selected":""?>><?=$second?></option>
									<?php } ?>
								</select>
								分
								&nbsp;&nbsp;<input type="submit" name="Submit" value="查询" />
							</td>
						</tr>
					</form>
				</table>
				<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;line-height:20px;" bgcolor="#798EB9">   
					<tr style="background-color:#3C4D82;color:#FFF;text-align:center;">
						<td>会员账号 /<br>真人账号</td>
						<td>交易单号 /<br>转账编号</td>
						<td>交易时间</td>
						<td>交易类别</td>
						<td>交易前余额</td>
						<td>交易额度</td>
						<td>交易后额度</td>
						<td>平台类型</td>
					</tr>
					<?php
					$where = "";
					if ($username!="") {
						$where .= " and B.username='$username'";
					}
					if ($tradeNo!="") {
						$where .= " and A.tradeNo='$tradeNo'";
					}
					if ($transferType!="") {
						$where .= " and A.transferType='$transferType'";
					}
					$sql = "select A.id from agaccounttransfer A left outer join k_user B on A.playerName=B.ag_zr_username where A.creationTime>='$betTime1' and A.creationTime<='$betTime2' $where order by A.id desc";
					$query = $mysqli->query($sql);
					$sum = $mysqli->affected_rows;
					$thisPage = 1;
					$pagenum = 50;
					if($_GET['page']) {
						$thisPage = $_GET['page'];
					}
					$CurrentPage = isset($_GET['page'])?$_GET['page']:1;
					$myPage = new pager($sum,intval($CurrentPage),$pagenum);
					$pageStr = $myPage->GetPagerContent();
					  
					$id = '';
					$i = 1;
					$start = ($thisPage-1)*$pagenum+1;
					$end = $thisPage*$pagenum;
					while ($row = $query->fetch_array()) {
						if($i>=$start && $i<=$end) {
							$id .= $row['id'].',';
						}
						if($i>$end) break;
						$i++;
					}
					if ($id) {
						$id = rtrim($id,',');
						$sql = "select A.*,B.username from agaccounttransfer A left outer join k_user B on A.playerName=B.ag_zr_username where A.id in($id) order by A.id desc";
						$query = $mysqli->query($sql);
						
						while ($rows = $query->fetch_array()) {
							$color = "#FFFFFF";
							$over = "#EBEBEB";
							$out = "#ffffff";
					?>
					<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;line-height:20px;height:25px;">
						<td><?=$rows["username"]?> /<br><?=$rows["playerName"]?></td>
						<td><?=$rows["tradeNo"]?> /<br><?=$rows["transferId"]?></td>
						<td><?=$rows["creationTime"]?></td>
						<td><?=getTransferType($rows["transferType"])?></td>
						<td><?=sprintf("%.2f",$rows['previousAmount'])?></td>
						<td><?=sprintf("%.2f",$rows['transferAmount'])?></td>
						<td><?=sprintf("%.2f",$rows['currentAmount'])?></td>
						<td><?=$rows["platformType"]?></td>
					</tr>
					<?php
						}
					}
					?>
					<tr style="background-color:#FFFFFF;">
						<td colspan="12" align="center"><?php echo $pageStr;?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
</body>
</html>