<?php
include_once("../common/login_check.php");
check_quanxian("ssgl"); 
include_once("../../include/mysqli.php");
include("../../include/pager.class.php");
include("CommonFun.php");

$username = trim($_GET["username"]);
$gameCode = trim($_GET["gameCode"]);
$billNo = trim($_GET["billNo"]);
$gameType = $_GET["gameType"];

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
								&nbsp;&nbsp;局号
								<input name="gameCode" type="text" id="gameCode" value="<?=$gameCode?>" size="14" />
								&nbsp;&nbsp;订单号
								<input name="billNo" type="text" id="billNo" value="<?=$billNo?>" size="14" />
								&nbsp;&nbsp;游戏类型
								<select name="gameType" id="gameType">
									<option value="">1.全部</option>
									<option value="BAC" <?=$gameType=="BAC"?"selected":""?>>2.百家乐</option>
									<option value="CBAC" <?=$gameType=="CBAC"?"selected":""?>>3.包桌百家乐</option>
									<option value="LINK" <?=$gameType=="LINK"?"selected":""?>>4.连环百家乐</option>
									<option value="DT" <?=$gameType=="DT"?"selected":""?>>5.龙虎</option>
									<option value="SHB" <?=$gameType=="SHB"?"selected":""?>>6.骰宝</option>
									<option value="ROU" <?=$gameType=="ROU"?"selected":""?>>7.轮盘</option>
									<option value="FT" <?=$gameType=="FT"?"selected":""?>>8.番摊</option>
								</select>
							</td>
						</tr>
						<tr>
							<td align="left">
								下注时间
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
						<td>订单号 /<br>局号</td>
						<td>桌号</td>
						<td>游戏类型</td>
						<td>下注玩法</td>
						<td>平台类型</td>
						<td>订单状态</td>
						<td>下注额度</td>
						<td>派彩额度</td>
						<td>有效投注额度</td>
						<td>下注时间 /<br>下注IP</td>
					</tr>
					<?php
					$where = "";
					if ($username!="") {
						$where .= " and B.username='$username'";
					}
					if ($gameCode!="") {
						$where .= " and A.gameCode='$gameCode'";
					}
					if ($billNo!="") {
						$where .= " and A.billNo='$billNo'";
					}
					if ($gameType!="") {
						$where .= " and A.gameType='$gameType'";
					}
					$sql = "select A.id from agbetdetail A left outer join k_user B on A.playerName=B.ag_zr_username where A.betTime>='$betTime1' and A.betTime<='$betTime2' $where order by A.id desc";
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
						$sql = "select A.*,B.username from agbetdetail A left outer join k_user B on A.playerName=B.ag_zr_username where A.id in($id) order by A.id desc";
						$query = $mysqli->query($sql);
						
						$sum_betAmount = 0;
						$sum_validBetAmount = 0;
						$sum_netAmount = 0;
						while ($rows = $query->fetch_array()) {
							$color = "#FFFFFF";
							$over = "#EBEBEB";
							$out = "#ffffff";
							
							$sum_betAmount += $rows["betAmount"];
							$sum_validBetAmount += $rows["validBetAmount"];
							$sum_netAmount += $rows["netAmount"];
					?>
					<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;line-height:20px;height:25px;">
						<td><?=$rows["username"]?> /<br><?=$rows["playerName"]?></td>
						<td><?=$rows["billNo"]?> / <br><?=$rows["gameCode"]?></td>
						<td><?=$rows["tableCode"]?></td>
						<td><?=getGameType($rows["gameType"])?></td>
						<td><?=getPlayType($rows["playType"])?></td>
						<td><?=$rows["platformType"]?></td>
						<td><?=getOrderFlag($rows["flag"])?></td>
						<td><?=sprintf("%.2f",$rows['betAmount'])?></td>
						<td><?=sprintf("%.2f",$rows['netAmount'])?></td>
						<td><?=sprintf("%.2f",$rows['validBetAmount'])?></td>
						<td><?=$rows["betTime"]?> /<br><?=$rows["loginIP"]?></td>
					</tr>
					<?php
						}
					}
					?>
					<tr style="background-color:#FFFFFF;">
						<td colspan="12" align="center">本页投注额度：<?=sprintf("%.2f",$sum_betAmount)?> 元&nbsp;&nbsp;派彩额度：<?=sprintf("%.2f",$sum_netAmount)?> 元&nbsp;&nbsp;有效投注额度：<?=sprintf("%.2f",$sum_validBetAmount)?> 元</td>
					</tr>
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