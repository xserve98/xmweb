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
	<script language="javascript" src="/js/jquery.js"></script> 
	<script language="javascript">
		var i = 31;
		var aas
		function check(){	
			clearTimeout(aas);		
			i = i -1;
			$("#location").html("对不起,您点击页面太快,请在"+i+"秒后进行操作");
			if(i == 1){
				window.location.href ='lq_match.php'
			}
			aas = setTimeout("check()",1000);
		}
	</script>
	<script language="javascript" src="/js/mouse.js"></script>
</head> 
<body>
<div class="top" >
	<div class="result_title"><span>篮球结果</span>
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
		<th width="40">1</th>
		<th width="40">2</th>
		<th width="40">3</th>
		<th width="40">4</th>
		<th width="40">上半</th>
		<th width="40">下半</th>
		<th width="40">加时</th>
		<th width="40">全场</th>
	</tr>
	<?php
	$sql	=	"select Match_Date,Match_Time, match_name,match_master,match_guest,MB_Inball_1st,TG_Inball_1st,MB_Inball_2st,TG_Inball_2st,MB_Inball_3st,TG_Inball_3st,MB_Inball_4st,TG_Inball_4st,MB_Inball_HR,	TG_Inball_HR,MB_Inball_ER,TG_Inball_ER,MB_Inball,TG_Inball,MB_Inball_Add,TG_Inball_Add from  lq_match where MB_Inball_OK is not null and  match_Date='".date('m-d',strtotime($date))."' and match_js=1 order by match_coverdate,match_id asc";
	$query	=	$mysqlis->query($sql);  		
	$rows	=	$query->fetch_array();
	if(!$rows){
		echo "<tr><td height='100' colspan='10' align='center' bgcolor='#FFFFFF'>暂无任何赛果</td></tr>";
	}else{
		do{
			if($temp_match_name!=$rows["match_name"]){
				$temp_match_name=$rows["match_name"]; 
	?>
	<tr>
		<td colspan="10" align="center" class='liansai'><strong><?=$rows["match_name"]?></strong></td>
	</tr>
	<?php
			}
	?>
	<tr>
		<td class='zhong line'><?=$rows["Match_Date"]?> <?=$rows["Match_Time"]?></td>
		<td class='line'><?=$rows["match_master"]?><br /><font color="#990000"><?=$rows["match_guest"]?></font></td>
		<td class='zhong line red'><?=$rows["MB_Inball_1st"]>=0 ? $rows["MB_Inball_1st"] : '无效'?><br /><?=$rows["TG_Inball_1st"]>=0 ? $rows["TG_Inball_1st"] : '无效'?></td>
		<td class='zhong line red'><?=$rows["MB_Inball_2st"]>=0 ? $rows["MB_Inball_2st"] : '无效'?><br /><?=$rows["TG_Inball_2st"]>=0 ? $rows["TG_Inball_2st"] : '无效'?></td>
		<td class='zhong line red'><?=$rows["MB_Inball_3st"]>=0 ? $rows["MB_Inball_3st"] : '无效'?><br /><?=$rows["TG_Inball_3st"]>=0 ? $rows["TG_Inball_3st"] : '无效'?></td>
		<td class='zhong line red'><?=$rows["MB_Inball_4st"]>=0 ? $rows["MB_Inball_4st"] : '无效'?><br /><?=$rows["TG_Inball_4st"]>=0 ? $rows["TG_Inball_4st"] : '无效'?></td>
		<td class='zhong line red'><?=$rows["MB_Inball_HR"]>=0 ? $rows["MB_Inball_HR"] : '无效'?><br /><?=$rows["TG_Inball_HR"]>=0 ? $rows["TG_Inball_HR"] : '无效'?></td>
		<td class='zhong line red'><?=$rows["MB_Inball_ER"]>=0 ? $rows["MB_Inball_ER"] : '无效'?><br /><?=$rows["TG_Inball_ER"]>=0 ? $rows["TG_Inball_ER"] : '无效'?></td>
		<td class='zhong line red'><?=$rows["MB_Inball_Add"]<0 ? '无效' : $rows["MB_Inball_Add"]>0 ? $rows["MB_Inball_Add"] : ''; ?><br /><?=$rows["TG_Inball_Add"]<0 ? '无效' : $rows["TG_Inball_Add"]>0 ? $rows["TG_Inball_Add"] : ''; ?></td>
		<td class='zhong line red'><?=$rows["MB_Inball"]>=0 ? $rows["MB_Inball"] : '无效'?><br /><?=$rows["TG_Inball"]>=0 ? $rows["TG_Inball"] : '无效'?></td>
	</tr>
	<?php
		}while($rows = $query->fetch_array());
	}
	?>
</table>
</body> 
</html>