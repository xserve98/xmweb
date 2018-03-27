<?
include("../common/login_check.php");
check_quanxian("ssgl");
include("../../include/mysqli.php");
include("../../include/pager.class.php");
include ("../../Lottery/include/order_info.php");
$gameId=is_numeric($_REQUEST['type']) ? intval($_REQUEST['type']) : 2;
$gameName=get_gameName($gameId);
$nums=intval($_POST['nums']);
$action=$_GET["action"];

if($action=="ok")
{
	for($i=1;$i<=$nums;$i++)
	{
		$kaipan=$_POST['kaipan_'.$i];
		$fengpan=$_POST['fengpan_'.$i];
		$kaijiang=$_POST['kaijiang_'.$i];
		$sql="update c_opentime_$gameId set kaipan='".$kaipan."',fengpan='".$fengpan."',kaijiang='".$kaijiang."' where qishu=".$i;
		$mysqli->query($sql);
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome</title>
	<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
	<script language="javascript" src="/js/jquery.js"></script>
	<script>
		function OpeSeconds(type)
		{
			var seconds = $("#seconds").val();
			var nums = $("#nums").val();
			
			switch (type)
			{
				case 1:
					for (var i = 1; i <= nums; i++)
					{
						//开盘-
						var oldkptime = $("#kaipan_" + i).val();
						var oldkpdate = new Date("2012/01/01 " + oldkptime);
						var newkptime = oldkpdate.getTime() - seconds * 1000;
						var newkpdate = new Date(newkptime);
						$("#kaipan_" + i).val(TimeFormat(newkpdate));
						
						//封盘-
						var oldfptime = $("#fengpan_" + i).val();
						var oldfpdate = new Date("2012/01/01 " + oldfptime);
						var newfptime = oldfpdate.getTime() - seconds * 1000;
						var newfpdate = new Date(newfptime);
						$("#fengpan_" + i).val(TimeFormat(newfpdate));
						
						//开奖-
						var oldkjtime = $("#kaijiang_" + i).val();
						var oldkjdate = new Date("2012/01/01 " + oldkjtime);
						var newkjtime = oldkjdate.getTime() - seconds * 1000;
						var newkjdate = new Date(newkjtime);
						$("#kaijiang_" + i).val(TimeFormat(newkjdate));
					}
					break;
				case 2:
					for (var i = 1; i <= nums; i++)
					{
						//开盘+
						var oldkptime = $("#kaipan_" + i).val();
						var oldkpdate = new Date("2012/01/01 " + oldkptime);
						var newkptime = oldkpdate.getTime() + seconds * 1000;
						var newkpdate = new Date(newkptime);
						$("#kaipan_" + i).val(TimeFormat(newkpdate));
						
						//封盘+
						var oldfptime = $("#fengpan_" + i).val();
						var oldfpdate = new Date("2012/01/01 " + oldfptime);
						var newfptime = oldfpdate.getTime() + seconds * 1000;
						var newfpdate = new Date(newfptime);
						$("#fengpan_" + i).val(TimeFormat(newfpdate));
						
						//开奖+
						var oldkjtime = $("#kaijiang_" + i).val();
						var oldkjdate = new Date("2012/01/01 " + oldkjtime);
						var newkjtime = oldkjdate.getTime() + seconds * 1000;
						var newkjdate = new Date(newkjtime);
						$("#kaijiang_" + i).val(TimeFormat(newkjdate));
					}
					break;
			}
		}
		
		function TimeFormat(datetime)
		{
			var hours = datetime.getHours();
			hours = hours < 10 ? "0" + hours : hours;
			var minutes = datetime.getMinutes();
			minutes = minutes < 10 ? "0" + minutes : minutes;
			var seconds = datetime.getSeconds();
			seconds = seconds < 10 ? "0" + seconds : seconds;
			
			return hours + ":" + minutes + ":" + seconds;
		}
	</script>
</head>
<body>
<div id="pageMain">
	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td valign="top">
				<form name="FrmSubmit" method="post" action="?action=ok&type=<?=$gameId?>" onSubmit="return confirm('您确定要修改盘口？');">
				<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
					<tr>
						<td width="60" align="left" bgcolor="#F0FFFF">彩票类别：</td>
						<td align="left" bgcolor="#FFFFFF"><?=$gameName?>【<a href="Auto_2.php?type=<?=$gameId?>" style="color:#ff0000;">点击进入开奖设置</a>】</td>
					</tr>
					<tr>
						<td width="60" align="left" bgcolor="#F0FFFF">时间修改：</td>
						<td align="left" bgcolor="#FFFFFF">
							<table border="0" cellpadding="0" cellspacing="0" class="font12">
								<tr>
									<td><a href="javascript:void(0);" onClick="javascript:OpeSeconds(1);"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
									<td>&nbsp;<input name="seconds" id="seconds" type="text" value="60" maxlength="6" style="width:80px;" /></td>
									<td>&nbsp;秒</td>
									<td>&nbsp;<a href="javascript:void(0);" onClick="javascript:OpeSeconds(2);"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="60" align="left" bgcolor="#F0FFFF">&nbsp;</td>
						<td align="left" bgcolor="#FFFFFF">
							<input name="submit" type="submit" class="submit80" value="确认修改"/>
							<input name="submit" type="button" class="submit80" value="刷新" onClick="location.href='Uptime_2.php?type=<?=$gameId?>'" /></td>
					</tr>
				</table>
				<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">   
					<tr align="center" style="background-color:#3C4D82; color:#FFF">
						<td><strong>彩票期号</strong></td>
						<td><strong>开盘时间</strong></td>
						<td><strong>封盘时间</strong></td>
						<td><strong>开奖时间</strong></td>
					</tr>
					<?php
					$sql="select * from c_opentime_$gameId order by qishu asc";
					$query=$mysqli->query($sql);
					$sum=$mysqli->affected_rows;
					while($rows=$query->fetch_array()){
						$color="#FFFFFF";
						$over="#EBEBEB";
						$out="#ffffff";
					?>
					<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>; line-height:20px;">
						<td><?=$rows['qishu']?></td>
						<td><input type="text" name="kaipan_<?=$rows['qishu']?>" id="kaipan_<?=$rows['qishu']?>" value="<?=$rows['kaipan']?>" maxlength="8" style="width:100px;" /></td>
						<td><input type="text" name="fengpan_<?=$rows['qishu']?>" id="fengpan_<?=$rows['qishu']?>" value="<?=$rows['fengpan']?>" maxlength="8" style="width:100px;" /></td>
						<td><input type="text" name="kaijiang_<?=$rows['qishu']?>" id="kaijiang_<?=$rows['qishu']?>" value="<?=$rows['kaijiang']?>" maxlength="8" style="width:100px;" /></td>
					</tr>
					<?php } ?>
					<input type="hidden" name="nums" id="nums" value="<?=$sum?>" />
				</table>
				</form>
			</td>
		</tr>
	</table>
</div>
</body>
</html>