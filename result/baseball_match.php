<?php
session_start();
include_once("../include/mysqlis.php");
include_once("../include/config.php");

$date	=	date('Y-m-d',time());
if($_GET['ymd']) $date	=	$_GET['ymd'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>home</title>
	<link href="../skin/sports/right.css" rel="stylesheet" type="text/css" />
	<script language="javascript">
		if(self==top){
			top.location='/index.php';
		}
	</script>
	<script language="javascript" src="/js/jquery.js"></script> 
	<script language="javascript">
		var i = 31;
		function check(){			
			clearTimeout(aas);		
			i = i -1;
			
			$("#location").html("对不起,您点击页面太快,请在"+i+"秒后进行操作");
			if(i == 1){
				window.location.href ='baseball_match.php';
			}
			var aas = setTimeout("check()",1000);
		}
	</script>
	<script language="javascript" src="/js/mouse.js"></script>
</head>
<body>
<div class="top" >
	<div class="result_title"><span>棒球结果</span>
		<?php
		for($i=0;$i<7;$i++){
			$d=date('Y-m-d',time()-$i*86400);
			if($d==$date){
				echo "<li class='i'>".substr($d,5,5)."</li>";
			}else{
				echo "<li><a href='?ymd=".$d."'>".substr($d,5,5)."</a></li>";
			}
		}
		?>
	</div>
</div>
<table border="0" cellspacing="1" cellpadding="0" class="box" bgcolor='#ACACAC'>
	<tr>
		<th width="100">开赛时间</th>
		<th>主场 / 客场</th>
		<th width="80">半场</th>
		<th width="80">全场</th>
	</tr>
	<?php
	$sql	=	"select Match_Date,Match_Time,match_name,match_master,match_guest,MB_Inball,TG_Inball,MB_Inball_HR,TG_Inball_HR from baseball_match where MB_Inball is not null and  match_Date='".date('m-d',strtotime($date))."' and match_js=1";
	$query	=	$mysqlis->query($sql);  		
	$rows	=	$query->fetch_array();
	if(!$rows){
		echo "<tr><td height='100' colspan='4' align='center' bgcolor='#FFFFFF'>暂无任何赛果</td></tr>";
	}else{
		do{
			if($temp_match_name!=$rows["match_name"]){
				$temp_match_name=$rows["match_name"]; 
	?>
	<tr>
		<td colspan="4" align="center" class='liansai'><strong><?=$rows["match_name"]?></strong></td>
	</tr>
	<?php
			}
	?>
	<tr>
		<td class='zhong line'><?=$rows["Match_Date"]?> <?=$rows["Match_Time"]?></td>
		<td class='line'><?=$rows["match_master"]?><br /><font color="#990000"><?=$rows["match_guest"]?></font></td>
		<td class='zhong line red'><?=$rows["MB_Inball"]<0?"赛事无效":$rows["MB_Inball_HR"]?><br /><?=$rows["TG_Inball"]<0?"赛事无效":$rows["TG_Inball_HR"]?></td>
		<td class='zhong line red'><?=$rows["MB_Inball"]<0?"赛事无效":$rows["MB_Inball"]?><br /><?=$rows["TG_Inball"]<0?"赛事无效":$rows["TG_Inball"]?></td>
	</tr>
	<?php
		}while($rows = $query->fetch_array());
	}
	?>
</table>
</div>
</body>
</html>