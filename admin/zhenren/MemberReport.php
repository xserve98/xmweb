<?php
include_once("../common/login_check.php");
check_quanxian("ssgl"); 
include_once("../../include/mysqli.php");
include("../../include/pager.class.php");
include("CommonFun.php");

$username = trim($_GET["username"]);

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
								&nbsp;&nbsp;查询时间
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
						<td>会员账号</td>
						<td>真人账号</td>
						<td>下注订单笔数</td>
						<td>投注额度</td>
						<td>有效投注额度</td>
						<td>会员派彩</td>
					</tr>
					<?php
					$where = "";
					if ($username!="") {
						$where .= " and B.username='$username'";
					}
					$sql = "select B.username,A.playerName,count(A.id) as orderNum,sum(A.netAmount) as netAmount,sum(A.betAmount) as betAmount,sum(A.validBetAmount) as validBetAmount from agbetdetail A left outer join k_user B on A.playerName=B.ag_zr_username where A.betTime>='$betTime1' and A.betTime<='$betTime2' $where group by A.playerName";
					$query = $mysqli->query($sql);
					
					$color = "#FFFFFF";
					$over = "#EBEBEB";
					$out = "#ffffff";
					
					$sum_orderNum = 0;
					$sum_betAmount = 0;
					$sum_validBetAmount = 0;
					$sum_netAmount = 0;
					
					while ($rows = $query->fetch_array()) {
						$sum_orderNum += $rows["orderNum"];
						$sum_betAmount += $rows['betAmount'];
						$sum_validBetAmount += $rows['validBetAmount'];
						$sum_netAmount += $rows['netAmount'];
					?>
					<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;line-height:20px;height:25px;">
						<td><?=$rows["username"]?></td>
						<td><?=$rows["playerName"]?></td>
						<td><?=$rows["orderNum"]?></td>
						<td><?=sprintf("%.2f",$rows['betAmount'])?></td>
						<td><?=sprintf("%.2f",$rows['validBetAmount'])?></td>
						<td style="color:<?=$rows['netAmount']<0?'#0000ff':''?>"><?=sprintf("%.2f",$rows['netAmount'])?></td>
					</tr>
					<?php
					}
					?>
					<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;line-height:20px;height:25px;font-weight:bold;">
						<td colspan="2">合计</td>
						<td><?=$sum_orderNum?></td>
						<td><?=sprintf("%.2f",$sum_betAmount)?></td>
						<td><?=sprintf("%.2f",$sum_validBetAmount)?></td>
						<td style="color:<?=$sum_netAmount<0?'#0000ff':''?>"><?=sprintf("%.2f",$sum_netAmount)?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
</body>
</html>