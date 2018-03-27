<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");
include_once("../../include/newPage.php");
include_once("../../class/user.php");

$sql	=	"select distinct u.uid,ul.is_login as ul_type from k_user u left join k_group g on u.gid=g.id left join k_user_login ul on u.uid=ul.uid where u.is_delete=0 ";
if(isset($_GET["likevalue"])){
	if($_GET['selecttype']=="name") $sql .= " and g.name like '%".$_GET['likevalue']."%'";
	else $sql.=" and u.".$_GET['selecttype']." like '%".$_GET['likevalue']."%'";
}
if(isset($_GET["is_login"])) $sql.="  and ul.is_login=".$_GET["is_login"];
if(isset($_GET["is_stop"])) $sql.="  and u.is_stop=".$_GET["is_stop"];
if(isset($_GET["is_daili"])) $sql.="  and u.is_daili='".intval($_GET["is_daili"])."'";
if(isset($_GET["top_uid"])) $sql.="  and u.top_uid=".$_GET["top_uid"];
if(isset($_GET["money"])) $sql.=" and u.money<0";
if(isset($_GET['month'])) $sql.=" and u.reg_date like('".$_GET['month']."%')";
$order	=	"";
if(isset($_GET["order"])) $order = $_GET["order"];
else $order = "u.uid";
$desc		=	" order by $order desc";
$query		=	$mysqli->query($sql.$desc);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);

$uid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
if($i >= $start && $i <= $end){
	$uid .=	$row['uid'].',';
}
if($i > $end) break;
	$i++;
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户列表</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
 
<style type="text/css">
.STYLE2 {font-size: 12px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td{font:13px/120% "宋体";padding:3px;}
a{

	color:#F37605;

	text-decoration: none;

}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
.STYLE4 {
	color: #FF0000;
	font-size: 12px;
}
</STYLE>
</HEAD>
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
        if(e.checked && e.name=='uid[]'){
			num = true;
			break;
		}
    }
	if(num){
		var action = document.getElementById("s_action").value;
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}else{
			if(action=="2") document.form2.action="stopuser.php?go=0&page=<?=$thisPage?>";
			if(action=="1") document.form2.action="stopuser.php?go=1&page=<?=$thisPage?>";
			if(action=="3") document.form2.action="stopuser.php?go=3&page=<?=$thisPage?>";
			if(action=="5") document.form2.action="set_pwd.php";
			if(action=="4"){
				if(confirm('确认取消该会员代理资格？取消后此代理的所有下级会员都不再属于该代理！')){
					document.form2.action="stopuser.php?go=4&page=<?=$thisPage?>";
				}else{
					return false;
				}
			}
			if(action=="6"){
				if(confirm('确认删除该会员吗？删除后不可恢复，请谨慎操作！')){
					document.form2.action="stopuser.php?go=6&page=<?=$thisPage?>";
				}else{
					return false;
				}
			}
		}
	}else{
        alert("您未选中任何复选框");
        return false;
    }
}
</script>
<script type="text/javascript" src="../../skin/js/jquery-1.7.2.min.js"></script>
<script language="javascript">
	function reflivemoney(uid) {
		$("#tz_money_"+uid).html('<img src="../../Box/skins/icons/loading.gif" />');
		$.post("../../agline/live_money_admin.php?uid="+uid,function (data) {
			var strs = new Array(); 
			var strs = data.split("|");
			$("#tz_money_"+uid).html(strs[0]);
		});
	}
</script>
<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">用户管理：查看用户的信息</span></font></td>
  </tr>
    <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><table width="455">
     <form name="form1" method="GET" action="list.php" >
      <tr>
        <td>内容：
          <input type="text" name="likevalue" value="<?=@$_GET['likevalue']?>"/>
            &nbsp;&nbsp;类型：
            <select name="selecttype" id="selecttype">
            <option value="username" <?php if(@$_GET["selecttype"]=='username') {?> selected <?php }?> >用户名</option>
            <option value="pay_name" <?php if(@$_GET["selecttype"]=='pay_name') {?> selected <?php }?> >真实姓名</option>
             <option value="reg_ip" <?php if(@$_GET["selecttype"]=='reg_ip') {?> selected <?php }?>>注册IP</option>
              <option value="login_ip" <?php if(@$_GET["selecttype"]=='login_ip') {?> selected <?php }?>>登录ip</option>
              <option value="name" <?php if(@$_GET["selecttype"]=='name') {?> selected <?php }?>>会员组</option>
              <option value="reg_address" <?php if(@$_GET["selecttype"]=='reg_address') {?> selected <?php }?>>省份</option>
              <option value="mobile" <?php if(@$_GET["selecttype"]=='mobile') {?> selected <?php }?>>手机号码</option>

            </select>
            &nbsp;
          <input type="submit" value="查找"/>
        </td>
        </tr>   </form>
    </table></td>
  </tr>
</table>
<form name="form2" method="post" action="" onSubmit="return check();" style="margin:0 0 0 0;">
<table width="100%">
      <tr>
		<td width="104" align="center"><a href="?is_login=1">在线会员</a></td>
        <td width="104" align="center"><a href="?money=1&is_stop=0">异常会员</a></td>
        <td width="104" align="center"><a href="?is_stop=1">停用会员</a></td>
        <td width="104" align="center"><a href="?1=1">全部会员</a></td>
        <td width="104" align="center"><a href="?is_daili=1">代理</a></td>
        <td width="104" align="center"><a href="?is_daili=0">普通会员</a></td>
        <td width="104" align="center"><a href="group.php">会员组管理</a></td>
        <td width="104" align="center"><a href="mobile.php">危险手机号码</a></td>
        <td width="365" align="right"><span class="STYLE4">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="2">启用会员</option>
        <option value="1">停用会员</option>
        <option value="5">修改密码</option>
        <option value="3">踢线</option>
        <option value="4" style="color:#FF0000;">取消代理</option>
        <option value="6" style="color:#0000ff;">删除会员</option>
      </select>
      <input type="submit" name="Submit2" value="执行"/></td>
      </tr>
  </table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="3%" height="20" ><strong>ID</strong></td>
		<td width="14%" height="20" ><strong>用户名/真人账号</strong></td>
        <td width="15%" ><strong>真实姓名/注册时间</strong></td>
        <td width="12%" ><strong>财务/<a href="list.php?order=money">余额</a>/支付宝</strong></td>
        <td width="6%" ><strong>真人余额</strong></td>
        <td width="10%" ><strong>注册/登陆 ip</strong></td>
        <td width="10%" ><strong>代理/上级</strong></td>
        <td width="13%" ><strong>手机号码/邮箱</strong></td>
        <td width="9%" ><strong>核查/会员组</strong></td>
        <td width="5%" ><strong><a href="list.php?order=ul_type desc,uid">状态</a></strong></td>
        <td width="3%" ><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/>
          </td>
      </tr>
      <?php
if($uid){
	$uid	=	rtrim($uid,',');
	$sql	=	"select u.zfb,u.ag_zr_money,u.ag_zr_vipmoney,u.ag_zr_is,u.uid,u.username,u.money,u.reg_ip,u.login_ip,u.is_daili,u.top_uid,u.is_stop,g.name,u.pay_name,u.mobile,u.email,u.reg_date,u.is_stop,ul.is_login as ul_type,ul.www,u.ag_zr_username,u.agents from k_user u left join k_group g on u.gid=g.id left join k_user_login ul on u.uid=ul.uid where u.uid in ($uid)".$desc;
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
	  	$over	= "#EBEBEB";
		$out	= "#ffffff";
		$color	= "#FFFFFF";
		if($rows["is_stop"]==1){ //停用和删除会员都是灰色
			$color = $over = $out = "#EBEBEB";
		}
	  	if($rows["money"] < 0){
			$color = $over = $out = "#FF9999";
		}
      	?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>">
	          <td><a href="user_show.php?id=<?=$rows["uid"]?>"><?=$rows["uid"]?></a></td>
			  <td><a href="user_show.php?id=<?=$rows["uid"]?>"><?=$rows["username"]?></a><br><?=$rows["ag_zr_username"]?><br /><span style="color:#999999;"><?=$rows['www']?></span></td>
	          <td><a href="list.php?likevalue=<?=urlencode($rows["pay_name"])?>&selecttype=pay_name"><?=$rows["pay_name"]?></a><br/><?=$rows["reg_date"]?></td>
              <td><a href="../cwgl/hccw.php?username=<?=$rows["username"]?>">查看财务</a>&nbsp;|&nbsp;<a href="../cwgl/man_money.php?username=<?=$rows["username"]?>">修改额度</a><br /><font color=blue><b><?=$rows["money"]?></b></font><br /><?=$rows["zfb"]?></td>
			  <td><span id="tz_money_<?=$rows["uid"]?>"><?=$rows["ag_zr_money"]+$rows["ag_zr_vipmoney"]?></span><br>
				<?php if($rows["ag_zr_is"]=="1"){?><a href="javascript:void(0);" onClick="reflivemoney(<?=$rows["uid"]?>)">刷新</a><?php } ?></td>
	          <td><a href="login_ip.php?ip=<?=$rows["reg_ip"]?>" ><?=$rows["reg_ip"]?></a>
              <br/>
              <a href="login_ip.php?ip=<?=$rows["login_ip"]?>"><?=$rows["login_ip"]?></a></td>
	          <td align="left">
              &nbsp;
              <? if($rows["is_daili"]==1){?>
               <a title="单击查看改代理的所有会员" href="list.php?top_uid=<?=$rows["uid"]?>">是</a>
              <? }else{?>
              否
			  <? }?>
			  /
              <a href="edit_daili.php?id=<?=$rows["uid"]?>">修改</a>
              /
			  <?=$rows["agents"]?>
              <br/>
            <? if($rows["top_uid"]>0){?>
             <a href="list.php?top_uid=<?=$rows["top_uid"]?>"><?=user::getusername($rows["top_uid"])?></a>
              <? }?></td>
	          <td><a href="list.php?likevalue=<?=$rows["mobile"]?>&selecttype=mobile"><?=$rows["mobile"]?></a><br /><?=$rows["email"]?></td>
	          <td><a href="../bbgl/report_day.php?username=<?=$rows["username"]?>">核查会员</a><br /><?=$rows["name"]?></td>
	          <td><?=$rows["ul_type"]>0 ? "<span style=\"color:#FF00FF;\">在线</span>" : "<span style=\"color:#999999;\">离线</span>" ?><br/><?=$rows["is_stop"]==1 ? "<span style=\"color: #FF0000;\">停用</span>" : "<span style=\"color:#006600;\">正常</span>"?></td>
	          <td><input name="uid[]" type="checkbox" id="uid[]" value="<?=$rows["uid"]?>" /></td>
          </tr> 	
      	<?
      }
}
      ?>
    </table>
    </td>
  </tr>
  <tr><td ><div style="float:left;"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></div></td></tr>
</table>
</form>
</body>
</html>