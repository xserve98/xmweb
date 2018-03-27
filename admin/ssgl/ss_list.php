<?php
include_once("../common/login_check.php");
check_quanxian("ssgl");
include_once("../../include/mysqlis.php");
$page_date	=	date("m-d");
$page_date2	=	date("Y-m-d");
$table		=	$_GET['type'];	

if(isset($_GET["date"])){
	$page_date	=	$_GET["date"];
	$page_date2	=	date("Y-").$_GET["date"];
}

function getName($n){
	switch ($n) {
		case "bet_match":
			return "足球";
			break;
		case "lq_match":
			return "篮球";
			break;
		case "tennis_match":
			return "网球";
			break;
		case "volleyball_match":
			return "排球";
			break;
		case "baseball_match":
			return "棒球";
			break;
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>录入比分</title>
<meta http-equiv="Cache-Control" content="max-age=8640000" />
<link rel="stylesheet" href="../images/control_main.css" type="text/css">
<style type="text/css">
<!--
.STYLE3 {color: #FF0000; font-weight: bold; }
.STYLE4 {
	color: #FF0000;
	font-size: 12px;
}
-->
</style>
<script language="javascript" src="../../js/jquery.js"></script>
<script language="javascript">
function gopage(url){
	location.href = url;
}

function check(){
    var len = document.form1.elements.length;
	var num = false;
    for(var i=0;i<len;i++){
		var e = document.form1.elements[i];
        if(e.checked && e.name=='mid[]'){
			num = true;
			break;
		}
    }
	if(num){
		var action = $("#s_action").val();
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}else{
			if(action=="1") document.form1.action="editss.php?type=<?=$table?>";
		}
	}else{
        alert("您未选中任何复选框");
        return false;
    }
}

function ckall(){
    for (var i=0;i<document.form1.elements.length;i++){
	    var e = document.form1.elements[i];
		if (e.name != 'checkall') e.checked = document.form1.checkall.checked;
	}
}
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" vlink="#0000FF" alink="#0000FF">
<form id="form1" name="form1" method="post" action="ft_list.php" onSubmit="return check();">
    <table width="900" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="300" height="24">选择日期：
          <select id="DropDownList1" onChange="javascript:gopage(this.value)" name="DropDownList1"><?php
for ($i=0;$i<=10;$i++){
	$s		=	strtotime("-$i day");
	$date	=	date("m-d",$s);
?>
        <option value="<?=$_SERVER['PHP_SELF']?>?type=<?=$table?>&date=<?=$date?>" <?=$page_date==$date ? 'selected' : ''?>><?=$date?></option>
<?php
}
?>
      </select></td>
        <td width="300" align="center"><label>
          <input type="button" name="Submit" value="添加<?=getName($table)?>赛事" onClick="javascript:window.location.href='addss.php?type=<?=$table?>'">
        </label></td>
        <td width="300" align="right"><span class="STYLE4">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="1">编辑赛事</option>
      </select>
      <input type="submit" name="Submit2" value="执行"/></td>
      </tr>
    </table>
  <table   border="0" cellspacing="1" cellpadding="0"  bgcolor="006255" width="900" height="41">
    <tr class="m_title_ft"> 
      <td width="230" height="24" align="middle"><?=$page_date?></td>
      <td align="middle" width="50">时间</td>
      <td align="middle" width="291">主场队伍</td>
      <td width="291" align="middle">客场队伍</td>
      <td align="middle" width="32"><label>
        <input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/>
      </label></td>
    </tr>
    <?php
	$sql		=	"SELECT ID, Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest,Match_Name FROM $table where (match_date='$page_date' or match_date='$page_date2') order by Match_CoverDate,match_name,Match_Master desc";
    $query		=	$mysqlis->query($sql);
	$arr_bet	=	array();
	while($rows	=	$query->fetch_array()){
		$arr     = explode('[上半',$rows["Match_Master"]);
		$couarr  = count($arr);
		if($couarr>1){
		  
		}else{
	 ?>
    <tr style="background-color:#ffffff"   align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'"> 
      <td width="230"><?=$rows["Match_ID"]?><br/>
      <?=$rows["Match_Name"]?></td>
      <td width="50"><?=$rows["Match_Time"]=='45.5' ? '中埸' : $rows["Match_Time"]?></td>
      <td width="291"><div align="right" style="padding-right:5px;"><?=$rows["Match_Master"]?></div></td>
      <td><div align="left" style="padding-left:5px;"><?=$rows["Match_Guest"]?></div></td>
     <td width="32"><input name="mid[]" type="checkbox" id="mid[]" value="<?=$rows["ID"]?>" /></td> 
    </tr>
    <?php 
		} 
	}
	?>
</table>
</form>
</body>
</html>