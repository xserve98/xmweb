<?php
include_once("../common/login_check.php");
check_quanxian("dlgl");
include_once("../../include/mysqli.php");
include_once("../../include/function_dled.php");

$month		=	isset($_GET["month"])?$_GET["month"]:date("Y-m");
$u_arr		=	array();
$lastTime	=	date("Y-m-d H:i:s",strtotime("$month"."-1 23:59:59"." +1 month")-1); //本月月末时间

$sql		=	"select u.uid,u.username from k_user u,k_user_daili ud where u.uid=ud.uid and u.is_daili=1 and ud.add_time<='$lastTime' order by uid asc"; //取出所有代理用户
$query		=	$mysqli->query($sql);
while($rows = $query->fetch_array()){
	$u_arr[$rows["uid"]]['username']	=	$rows["username"];
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>代理结算</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">

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
a{color:#FFA93E;}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
.STYLE3 {color: #FF0000}
</STYLE>

<script>
function ckall(){
    for (var i=0;i<document.form2.elements.length;i++){
	    var e = document.form2.elements[i];
		if (e.name != 'checkall') e.checked = document.form2.checkall.checked;
	}
}

function check(){
    var len = document.form2.elements.length;
	var num = false;
    for(var i=0;i<len;i++){
		var e = document.form2.elements[i];
        if(e.checked && e.name=='r_id[]'){
			num = true;
			break;
		}
    }
	if(num){
		var action = document.getElementById("s_action").value;
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}else if(action=="2"){
			document.form2.action="re_dailijisuan.php";
		}
		return true;
	}else{
        alert("您未选中任何复选框");
        return false;
    }
}
</script>
</HEAD>
<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">代理月额度：对所有代理会员进行结算</span></font></td>
  </tr>
  <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
      查询月份：<input type="text" value="<?=$month?>" name="month"/>&nbsp;<input type="submit" value="查询"/></td>
  </tr>
  </form>
</table>
<form action="daili_jiesuan_cmd.php" id="form2" name="form2" method="post" style="margin:0 0 0 0;" onSubmit="return check();">
  <table width="100%" border="0">
    <tr>
      <td align="right"><input type="hidden" name="month" value="<?=$month?>"><span class="STYLE3">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="1">结算</option>
        <option value="2" style="color:#FF0000;">重新结算</option>
  </select>
<input type="submit" name="Submit2" value="执行"/></td>
    </tr>
  </table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
    <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" align="center"  >
      <tr style="background-color: #EFE" class="t-title" align="center">
        <td width="21%"   height="20" align="center"><strong>代理账号</strong></td>
        <td width="16%"  ><strong>盈亏</strong></td>
        <td width="10%"  ><strong>提成比例</strong></td>
        <td width="13%"  ><strong>结算结果</strong></td>
        <td width="10%" ><strong>月份</strong></td>
        <td width="15%" ><strong>结算时间</strong></td>
        <td width="10%" ><strong>有效下级</strong></td>
        <td width="5%" ><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/></td>
      </tr>
<?php
$sql	=	"select r_id,uid,shuying,`point`,result,make_date,yxxj from k_user_daili_result where month='".$month."' and `type`=1 order by shuying desc"; //取出所查询的月份所有已结算的代理记录
$query	= $mysqli->query($sql);
while($rows = $query->fetch_array()){
	$color	=	$rows["shuying"]>0 ? '#FF0000' : '#000000';
?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
	          <td height="20"><div style="float:left;"><a href="../hygl/user_show.php?id=<?=$rows["uid"]?>" ><?=$u_arr[$rows["uid"]]['username']?></a></div>
	          <div style="float:right"><a href="../hygl/list.php?top_uid=<?=$rows["uid"]?>&month=<?=$month?>">本月下级</a></div></td>
              <td style="color:<?=$color?>;"><?=$rows["shuying"]?></td>
              <td><?=$rows["point"]?></td>
              <td style="color:<?=$color?>;"><?=$rows["result"]?></td>
              <td><?=$month?></td>
              <td><?=$rows["make_date"]?></td>
              <td><?=$rows["yxxj"]?> 个</td>
              <td><input name="r_id[]" type="checkbox" id="r_id[]" value="<?=$rows["r_id"]?>" /></td>
          </tr>   	
<?php
	unset($u_arr[$rows["uid"]]); //删除已经显示过的已保存代理记录
}
$uid	=	''; //未结算的代理id
foreach($u_arr as $k=>$v){
	$uid	.=	$k.',';
}
if($uid){
	$dled	=	array();
	$temp	=	array();
	$uid	=	rtrim($uid,',');
	$sql	=	"select top_uid,count(top_uid) as s from k_user where top_uid in($uid) and money>0 and reg_date like('$month%') group by top_uid"; //取出该代理本月有效下级个数
	$query	= $mysqli->query($sql);
	while($rows = $query->fetch_array()){
		$dled[$rows["top_uid"]]['yk']		=	getDLED($rows["top_uid"],$month.'-1 00:00:00',$lastTime); //取本月代理盈亏额度
		$dled[$rows["top_uid"]]['bl']		=	get_point($dled[$rows["top_uid"]]['yk']);
		$dled[$rows["top_uid"]]['yxxj']		=	$rows["s"];
		$temp[$rows["top_uid"]]				=	$dled[$rows["top_uid"]]['yk'];
		unset($u_arr[$uid]); //删除已经显示过的已保存代理记	
	}
	foreach($u_arr as $k=>$v){
		$dled[$k]['yk']						=	getDLED($k,$month.'-1 00:00:00',$lastTime); //取本月代理盈亏额度
		$dled[$k]['bl']						=	get_point($dled[$k]['yk']);
		$dled[$k]['yxxj']					=	0;
		$temp[$k]							=	$dled[$k]['yk'];
	}
	arsort($temp);
	foreach($temp as $uid=>$v){
		$color	=	$dled[$uid]['yk']>0 ? '#FF0000' : '#000000';
?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
	          <td height="20">
              <div style="float:left;"><a href="../hygl/user_show.php?id=<?=$uid?>"><?=$u_arr[$uid]['username']?></a></div>
	          <div style="float:right"><a href="../hygl/list.php?top_uid=<?=$uid?>&month=<?=$month?>">本月下级</a></div></td>
              <td style="color:<?=$color?>;"><?=$dled[$uid]['yk']?></td>
              <td><?=$dled[$uid]['bl']?></td>
              <td style="color:<?=$color?>;"><?=round($dled[$uid]['yk']*$dled[$uid]['bl'],2)?></td>
              <td><?=$month?></td>
              <td>未结算</td>
              <td><?=$dled[$uid]['yxxj']?> 个</td>
              <td><input name="r_id[]" type="checkbox" id="r_id[]" value="<?=$uid?>" /></td>
          </tr>   
<?php
	}
}
?>
    </table>
    </td>
  </tr>
  <tr><td >
  </td></tr>
</table>
</form>	
</body>
</html>