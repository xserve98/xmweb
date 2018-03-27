<?php
include_once("../include/mysqli.php");
include_once('include/mysqliag.php');
header("Content-type: text/html; charset=utf-8");

/* 网站前缀配置 */
$prefix = "HL";

$sql = "select copyFlag from agxmlconfig where id=1";
$query = $mysqli->query($sql);
$row = $query->fetch_array();
$chk_copyFlag = $row['copyFlag'];

$sum_bet = 0;
$sum_account = 0;

try {
	/* 更新额度明细 */
	$sql = "select * from agaccounttransfer where prefix='$prefix' and copyFlag>$chk_copyFlag order by id";
	$query = $mysqliag->query($sql);
	while ($row = $query->fetch_array()) {
		$rowID = $row['rowID'];
		$agentCode = $row['agentCode'];
		$transferId = $row['transferId'];
		$tradeNo = $row['tradeNo'];
		$platformId = $row['platformId'];
		$platformType = $row['platformType'];
		$playerName = $row['playerName'];
		$transferType = $row['transferType'];
		$transferAmount = $row['transferAmount'];
		$previousAmount = $row['previousAmount'];
		$currentAmount = $row['currentAmount'];
		$currency = $row['currency'];
		$exchangeRate = $row['exchangeRate'];
		$IP = $row['IP'];
		$flag = $row['flag'];
		$creationTime = $row['creationTime'];
		$gameCode = $row['gameCode'];
		$copyFlag = $row['copyFlag'];
		$filePath = $row['filePath'];
		$prefix = $row['prefix'];
		
		/* 检查是否存在 */
		$sql_exists = "select id from agaccounttransfer where rowID='$rowID'";
		$query_exists = $mysqli->query($sql_exists);
		$sum_exists = $mysqli->affected_rows;
		if ($sum_exists > 0) {
			$sql_intup = "update agaccounttransfer set agentCode='$agentCode', ";
			$sql_intup .= "transferId='$transferId', ";
			$sql_intup .= "tradeNo='$tradeNo', ";
			$sql_intup .= "platformId='$platformId', ";
			$sql_intup .= "platformType='$platformType', ";
			$sql_intup .= "playerName='$playerName', ";
			$sql_intup .= "transferType='$transferType', ";
			$sql_intup .= "transferAmount='$transferAmount', ";
			$sql_intup .= "previousAmount='$previousAmount', ";
			$sql_intup .= "currentAmount='$currentAmount', ";
			$sql_intup .= "currency='$currency', ";
			$sql_intup .= "exchangeRate='$exchangeRate', ";
			$sql_intup .= "IP='$IP', ";
			$sql_intup .= "flag='$flag', ";
			$sql_intup .= "creationTime='$creationTime', ";
			$sql_intup .= "gameCode='$gameCode', ";
			$sql_intup .= "copyFlag='$copyFlag', ";
			$sql_intup .= "filePath='$filePath', ";
			$sql_intup .= "prefix='$prefix' ";
			$sql_intup .= "where rowID='$rowID';";
		} else {
			$sql_intup = "insert into agaccounttransfer set rowID='$rowID', ";
			$sql_intup .= "agentCode='$agentCode', ";
			$sql_intup .= "transferId='$transferId', ";
			$sql_intup .= "tradeNo='$tradeNo', ";
			$sql_intup .= "platformId='$platformId', ";
			$sql_intup .= "platformType='$platformType', ";
			$sql_intup .= "playerName='$playerName', ";
			$sql_intup .= "transferType='$transferType', ";
			$sql_intup .= "transferAmount='$transferAmount', ";
			$sql_intup .= "previousAmount='$previousAmount', ";
			$sql_intup .= "currentAmount='$currentAmount', ";
			$sql_intup .= "currency='$currency', ";
			$sql_intup .= "exchangeRate='$exchangeRate', ";
			$sql_intup .= "IP='$IP', ";
			$sql_intup .= "flag='$flag', ";
			$sql_intup .= "creationTime='$creationTime', ";
			$sql_intup .= "gameCode='$gameCode', ";
			$sql_intup .= "copyFlag='$copyFlag', ";
			$sql_intup .= "filePath='$filePath', ";
			$sql_intup .= "prefix='$prefix';";
		}
		$mysqli->query($sql_intup);
		$sum_account++;
	}
	
	/* 更新投注明细 */
	$sql = "select * from agbetdetail where prefix='$prefix' and copyFlag>$chk_copyFlag order by id";
	$query = $mysqliag->query($sql);
	$count = $mysqliag->affected_rows;
	while ($row = $query->fetch_array()) {
		$billNo = $row['billNo'];
		$playerName = $row['playerName'];
		$agentCode = $row['agentCode'];
		$gameCode = $row['gameCode'];
		$netAmount = $row['netAmount'];
		$betTime = $row['betTime'];
		$gameType = $row['gameType'];
		$betAmount = $row['betAmount'];
		$validBetAmount = $row['validBetAmount'];
		$flag = $row['flag'];
		$playType = $row['playType'];
		$currency = $row['currency'];
		$tableCode = $row['tableCode'];
		$loginIP = $row['loginIP'];
		$recalcuTime = $row['recalcuTime'];
		$platformId = $row['platformId'];
		$platformType = $row['platformType'];
		$stringex = $row['stringex'];
		$remark = $row['remark'];
		$round = $row['round'];
		$copyFlag = $row['copyFlag'];
		$filePath = $row['filePath'];
		$prefix = $row['prefix'];
		
		/* 检查是否存在 */
		$sql_exists = "select id from agbetdetail where billNo='$billNo'";
		$query_exists = $mysqli->query($sql_exists);
		$sum_exists = $mysqli->affected_rows;
		if ($sum_exists > 0) {
			$sql_intup = "update agbetdetail set playerName='$playerName', ";
			$sql_intup .= "agentCode='$agentCode', ";
			$sql_intup .= "gameCode='$gameCode', ";
			$sql_intup .= "netAmount='$netAmount', ";
			$sql_intup .= "betTime='$betTime', ";
			$sql_intup .= "gameType='$gameType', ";
			$sql_intup .= "betAmount='$betAmount', ";
			$sql_intup .= "validBetAmount='$validBetAmount', ";
			$sql_intup .= "flag='$flag', ";
			$sql_intup .= "playType='$playType', ";
			$sql_intup .= "currency='$currency', ";
			$sql_intup .= "tableCode='$tableCode', ";
			$sql_intup .= "loginIP='$loginIP', ";
			$sql_intup .= "recalcuTime='$recalcuTime', ";
			$sql_intup .= "platformId='$platformId', ";
			$sql_intup .= "platformType='$platformType', ";
			$sql_intup .= "stringex='$stringex', ";
			$sql_intup .= "remark='$remark', ";
			$sql_intup .= "round='$round', ";
			$sql_intup .= "copyFlag='$copyFlag', ";
			$sql_intup .= "filePath='$filePath', ";
			$sql_intup .= "prefix='$prefix' ";
			$sql_intup .= "where billNo='$billNo';";
		} else {
			$sql_intup = "insert into agbetdetail set billNo='$billNo', ";
			$sql_intup .= "playerName='$playerName', ";
			$sql_intup .= "agentCode='$agentCode', ";
			$sql_intup .= "gameCode='$gameCode', ";
			$sql_intup .= "netAmount='$netAmount', ";
			$sql_intup .= "betTime='$betTime', ";
			$sql_intup .= "gameType='$gameType', ";
			$sql_intup .= "betAmount='$betAmount', ";
			$sql_intup .= "validBetAmount='$validBetAmount', ";
			$sql_intup .= "flag='$flag', ";
			$sql_intup .= "playType='$playType', ";
			$sql_intup .= "currency='$currency', ";
			$sql_intup .= "tableCode='$tableCode', ";
			$sql_intup .= "loginIP='$loginIP', ";
			$sql_intup .= "recalcuTime='$recalcuTime', ";
			$sql_intup .= "platformId='$platformId', ";
			$sql_intup .= "platformType='$platformType', ";
			$sql_intup .= "stringex='$stringex', ";
			$sql_intup .= "remark='$remark', ";
			$sql_intup .= "round='$round', ";
			$sql_intup .= "copyFlag='$copyFlag', ";
			$sql_intup .= "filePath='$filePath', ";
			$sql_intup .= "prefix='$prefix';";
		}
		$mysqli->query($sql_intup);
		$sum_bet++;
		
		if ($count==$sum_bet) {
			$currtime = date("Y-m-d H:i:s",time());
			$sql_upconf = "update agxmlconfig set fileName='$filePath',copyFlag='$copyFlag',upTime='$currtime'";
			$mysqli->query($sql_upconf);
		}
	}
} catch (Exception $ex) {
	//异常处理
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>真人明细记录接收</title>
	<style type="text/css">
		body,td,th {
			font-size: 12px;
		}
		body {
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
		}
	</style>
	<script>
		var limit = "60";
		
		if (document.images) {
			var parselimit = limit;
		}
		
		function beginrefresh() {
			if (!document.images) return;
			if (parselimit==1) {
				window.location.reload();
			} else {
				parselimit -= 1;
				curmin = Math.floor(parselimit);
				if (curmin!=0) {
					curtime = curmin + "秒后自动获取!";
				} else {
					curtime = cursec + "秒后自动获取!";
				}
				timeinfo.innerText = curtime;
				setTimeout("beginrefresh()",1000);
			}
		}

		window.onload = beginrefresh;
	</script>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
		<input type=button name=button value="刷新" onClick="window.location.reload()">
		共更新: 额度记录 <?=$sum_account?>条,投注记录 <?=$sum_bet?>条
		<span id="timeinfo"></span>
	</td>
  </tr>
</table>
</body>
</html>