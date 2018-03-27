<?php
include_once("../../include/config.php");
include_once("../common/login_check.php");
check_quanxian("ssgl");
include_once("../../include/mysqlis.php");

if($_GET['action'] == 'save'){
	$arr	=	$_POST['id'];
	$id		=	'';
	$i		=	0; //会员个数
	foreach($arr as $k=>$v){
		$id .= $v.',';
		$i++;
	}
	$id		=	rtrim($id,',');
	$sql	=	"update bet_match set match_type=1 where id in ($id)";
	$mysqlis->query($sql);
}
$arr_bet=array();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>早餐转单式</title>
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
function $_(_sId){
	return document.getElementById(_sId);
}

function check(){
    var len = document.form1.elements.length;
	var num = false;
    for(var i=0;i<len;i++){
		var e = document.form1.elements[i];
        if(e.checked && e.name=='id[]'){
			num = true;
			break;
		}
    }
	if(num){
		var action = $_("s_action").value;
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}else{
			return true;
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
<form id="form1" name="form1" method="post" action="zczds.php?action=save" onSubmit="return check();">
  <div style="width:900px; padding-bottom:5px;">
    <div style="float:right;"><span class="STYLE4">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="1">早餐转为单式</option>
      </select>
      <input type="submit" name="Submit2" value="执行"/></div></div>
  <table   border="0" cellspacing="1" cellpadding="0"  bgcolor="006255" width="900" height="41">
    <tr class="m_title_ft"> 
      <td width="250" height="18" align="middle">联赛编号/联赛名称</td>
      <td align="middle" width="80">开赛时间</td>
      <td align="middle" width="260">主场队伍</td>
      <td align="middle" width="260">客场队伍</td>
      <td align="middle" width="44"><label>
        <input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/>
      </label></td>
    </tr>
<?php
$sql	=	"SELECT ID, Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest, Match_Name, match_js FROM Bet_Match where match_js=0 and (match_date='".date("m-d")."' or match_date='".date("Y-m-d")."') and Match_Type=0 order by  Match_CoverDate,iPage,match_name,Match_Master,iSn desc";
$query	=	$mysqlis->query($sql);
while($rows = $query->fetch_array()){
if($rows["match_js"]>0){
	$bgcolor="#cccccc";
}else{
	$bgcolor="#ffffff";
}
$arr	=	explode('[上半',$rows["Match_Master"]);
if(!in_array($rows["Match_Master"],$arr_bet)){
	$arr_bet[$rows["Match_ID"]] = $rows["Match_Master"];
}
$ftid	=	array_search($rows["Match_Master"],$arr_bet);
$couarr	=	count($arr);
if($couarr>1){
  
}else{
?>
    <tr class="m_cen" style="background-color:<?=$bgcolor?>"   align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'"> 
      <td width="250"><?=$rows["Match_ID"]?><br/>
      <?=$rows["Match_Name"]?></td>
      <td width="80"><?=$rows["Match_Date"]?><br/>
      <?=$rows["Match_Time"]?></td>
      <td width="260"><div align="right" style="padding-right:5px;"><?=$rows["Match_Master"]?></div></td>
      <td width="260"><div align="left" style="padding-left:5px;"><?=$rows["Match_Guest"]?></div></td>
     <td width="44"><input name="id[]" type="checkbox" id="id[]" value="<?=$rows["ID"]?>" /></td> 
    </tr>
<?php
	}
}
?>
</table>
</form>
</body>
</html>