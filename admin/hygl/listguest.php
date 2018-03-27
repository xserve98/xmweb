<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");
include_once("../../include/newPage.php");
include_once("../../class/user.php");
if(isset($_GET["top_uid"])) {
 $sql_user	 =	"select * from k_user where uid=".$_GET["top_uid"]." limit 1"; //取汇款前会员余额
 $query	 =	$mysqli->query($sql_user);
 $rs	 =	$query->fetch_array();
 $topjs = $rs['fdjishu'];
 $topusername = $rs['username'];
 $topdltype=$rs['fxdltype'];
 $dltype=$rs['dltype'];
 $topuid=$rs['uid'];
}


$sql	=	"select distinct u.uid,ul.is_login  as ul_type from k_user u left join k_group g on u.gid=g.id left join k_user_login ul on u.uid=ul.uid where u.is_delete=0 ";
if(isset($_GET["likevalue"])){
	if($_GET['selecttype']=="name") $sql .= " and g.name like '%".$_GET['likevalue']."%'";
	if($_GET['selecttype']=="lmoney") $sql .= " and u.money <=".trim($_GET['likevalue'])." and u.money >=".trim($_GET['likevalue2']);
	else $sql.=" and u.".$_GET['selecttype']." like '%".$_GET['likevalue']."%'";
}
if(isset($_GET["is_login"])) $sql.="  and ul.is_login=".$_GET["is_login"];
if(isset($_GET["is_stop"])) $sql.="  and u.is_stop=".$_GET["is_stop"];
if(isset($_GET["is_daili"])) $sql.="  and u.is_daili='".intval($_GET["is_daili"])."'";
if(isset($_GET["dltype"])) $sql.="  and u.dltype='".intval($_GET["dltype"])."'";
////if(isset($_GET["top_uid"])) $sql.="  and u.top_uid=".$_GET["top_uid"];
if(isset($_GET["top_uid"])) $sql.=" and concat(',',u.parents,',') like '%,".intval($_GET["top_uid"]).",%'";
///echo $sql;
if(isset($_GET["money"])) $sql.=" and u.money<0";
if(isset($_GET['month'])) $sql.=" and u.reg_date like('".$_GET['month']."%')";
$order	=	"";
if(isset($_GET["order"])) $order = $_GET["order"];
else $order = "u.uid";
$desc		=	" and  u.username  LIKE 'guest%' order by $order desc";
///echo $sql.$desc;
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
<link rel="stylesheet" href="../images/CssAdmin.css">
 
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
	
		var action = document.getElementById("s_action").value;
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}else{
		
			if(action=="6"){
				if(confirm('确认删除该会员吗？删除后不可恢复，请谨慎操作！')){
					document.form2.action="stopguest.php?go=6&page=<?=$thisPage?>";
				}else{
					return false;
				}
			}
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
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><table width="655">
     
    </table></td>
  </tr>
</table>
<form name="form2" method="post" action="" onSubmit="return check();" style="margin:0 0 0 0;">
<table width="100%">
      <tr>
	
        <td width="365" align="right"><span class="STYLE4">相关操作：</span>
   <select name="s_action" id="s_action">

        <option value="6" selected="selected" style="color:#0000ff;">清理guest账户</option>
      </select>
      <input type="submit" name="Submit2" value="执行"/></td>
      </tr>
  </table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">

  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="3%" height="20" ><strong>ID</strong></td>
		<td width="14%" height="20" ><strong>用户名</strong></td>
        <td width="15%" ><strong>真实姓名/注册时间</strong></td>
        <td width="15%" ><strong><a href="list.php?order=money">余额</a></strong></td>
        <td width="5%" ><strong>返点</strong></td>
        <td width="10%" ><strong>注册/登陆 ip</strong></td>
            <td width="10%" ><strong>上级/上级ID</strong></td>
              <? if( isset($_GET["top_uid"]) ){?>
             <td width="10%" ><strong>所属层数</strong></td> 
              <? } ?>
              
        <td width="10%" ><strong>代理/上级</strong></td>
        <td width="13%" ><strong>手机号码/微信/QQ</strong></td>
        <td style='display:none' width="9%" ><strong>核查/会员组</strong></td>
        <td width="5%" ><strong><a href="list.php?order=ul_type desc,uid">状态</a></strong></td>
        <td width="3%" ><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/>
          </td>
      </tr>
      
      <?php
if($uid){
	$uid	=	rtrim($uid,',');
	$sql	=	"select u.zfb,u.ag_zr_money,u.ag_zr_vipmoney,u.ag_zr_is,u.uid,u.username,u.money,u.reg_ip,u.login_ip,u.is_daili,u.dltype,u.parents,u.fandian,u.top_uid,u.is_stop,g.name,u.pay_name,u.mobile,u.qq,u.email,u.reg_date,u.is_stop,ul.is_login as ul_type,ul.www,u.ag_zr_username,u.agents from k_user u left join k_group g on u.gid=g.id left join k_user_login ul on u.uid=ul.uid where u.uid in ($uid)".$desc;
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
		$parentarr=explode(',',$rows['parents']);
		$wz1=array_search($rows['uid'],$parentarr);
		$wz2=array_search($_GET["top_uid"],$parentarr);
		$wz=$wz1-$wz2;
      	?>
        
        
      <? if( isset($_GET["top_uid"]) ){?>
     <?  if($_GET["dltype"]==0&& $dltype==0&& $topdltype==0){ ?>
 
        <? if($wz<=$topjs ){?>
      
	        <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>">
	          <td><a href="user_show.php?id=<?=$rows["uid"]?>"><?=$rows["uid"]?></a></td>
			  <td>
                <?php
			  	if($rows["agents"]=='' || $rows["agents"]==null){
                ?>
              	<a href="user_show.php?id=<?=$rows["uid"]?>" style="color:#060;"><?=$rows["username"]?></a>
                <?php
				}
				else{
				?>
                <a href="user_show.php?id=<?=$rows["uid"]?>"><?=$rows["username"]?></a>
                <?php
				}
				?>
               </td>
	          <td>
              	<?php
			  	if($rows["agents"]=='' || $rows["agents"]==null){
                ?>
              	<a href="list.php?likevalue=<?=urlencode($rows["pay_name"])?>&selecttype=pay_name" style="color:#060;"><?=$rows["pay_name"]?></a>
                <?php
				}
				else{
				?>
                <a href="list.php?likevalue=<?=urlencode($rows["pay_name"])?>&selecttype=pay_name"><?=$rows["pay_name"]?></a>
                <?php
				}
				?>
                <br/><br/><?=$rows["reg_date"]?></td>
              <td><a href="../cwgl/hccw.php?username=<?=$rows["username"]?>">查看财务</a>&nbsp;|&nbsp;<a href="../cwgl/set_money.php?uid=<?=$rows["uid"]?>&type=add">修改额度</a><br /><font color=blue><b><?=$rows["money"]?></b></font><br /><?=$rows["zfb"]?></td>
			   <td><?=$rows["fandian"]?></td>
	          <td><a href="login_ip.php?ip=<?=$rows["reg_ip"]?>" ><?=$rows["reg_ip"]?></a>
              <br/>
              <a href="login_ip.php?ip=<?=$rows["login_ip"]?>"><?=$rows["login_ip"]?></a></td>
               <td> <? if($rows["top_uid"]>0){?>
             <a href="list.php?top_uid=<?=$rows["top_uid"]?>"><?=user::getusername($rows["top_uid"])?>|<?=$rows["top_uid"]?></a>
              <? }?></td>
	          <td align="left">
              <? if($wz==0){?>
              <span style="color:red"><?=$topusername ?></span>
              <? }else{ ?>
              <span style="color:red"><?=$topusername ?></span>的第<span style="color:blue;"><?= $wz ?></span>层级下级
              <? } ?>
              </td>
              <td align="left">
              &nbsp;
              <? if($rows["is_daili"]==1&&$rows["dltype"]==0){?>
               <a style='color:red' title="单击查看改代理的所有会员" href="list.php?top_uid=<?=$rows["uid"]?>&dltype=<?=$rows["dltype"]?>">分享</a>
              <? }
			  else if($rows["is_daili"]==1&&$rows["dltype"]==1){?>
               <a title="单击查看改代理的所有会员" href="list.php?top_uid=<?=$rows["uid"]?>&dltype=<?=$rows["dltype"]?>">传统</a>
              <? }else {?>
                否
			  <? }?>
			  /
              <a href="edit_daili.php?id=<?=$rows["uid"]?>">修改</a>
              </td>
              
	          <td><a href="list.php?likevalue=<?=$rows["mobile"]?>&selecttype=mobile"><?=$rows["mobile"]?></a><br /><?=$rows["email"]?></td>
	          <td style='display:none' ><a href="../bbgl/report_day.php?username=<?=$rows["username"]?>">核查会员</a><br /><?=$rows["name"]?></td>
	          <td>
			  <?=$rows["ul_type"]>0 ? "<span style=\"color:#FF00FF;\">在线</span>" : "<span style=\"color:#999999;\">离线</span>" ?><br/>
			 <? if($rows["is_stop"]==1){?>
              <span style="color: #FF0000;">停用</span>
              <? }else if($rows["is_stop"]==0){?>
                <span style="color:#006600;">正常</span>
                 <? }else {?>
                      <span style="color:#F1DF12;">异常</span>
			  <? }?>
              
              
              </td>
	          <td><input name="uid[]" type="checkbox" id="uid[]" value="<?=$rows["uid"]?>" /></td>
          </tr> 
              <? }?>
          	  <?php }else{ ?>
                    <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>">
	          <td><a href="user_show.php?id=<?=$rows["uid"]?>"><?=$rows["uid"]?></a></td>
			  <td>
                <?php
			  	if($rows["agents"]=='' || $rows["agents"]==null){
                ?>
              	<a href="user_show.php?id=<?=$rows["uid"]?>" style="color:#060;"><?=$rows["username"]?></a>
                <?php
				}
				else{
				?>
                <a href="user_show.php?id=<?=$rows["uid"]?>"><?=$rows["username"]?></a>
                <?php
				}
				?>
                </td>
	          <td>
              	<?php
			  	if($rows["agents"]=='' || $rows["agents"]==null){
                ?>
              	<a href="list.php?likevalue=<?=urlencode($rows["pay_name"])?>&selecttype=pay_name" style="color:#060;"><?=$rows["pay_name"]?></a>
                <?php
				}
				else{
				?>
                <a href="list.php?likevalue=<?=urlencode($rows["pay_name"])?>&selecttype=pay_name"><?=$rows["pay_name"]?></a>
                <?php
				}
				?>
                <br/><br/><?=$rows["reg_date"]?></td>
              <td><a href="../cwgl/hccw.php?username=<?=$rows["username"]?>">查看财务</a>&nbsp;|&nbsp;<a href="../cwgl/set_money.php?uid=<?=$rows["uid"]?>&type=add">修改额度</a><br /><font color=blue><b><?=$rows["money"]?></b></font><br /><?=$rows["zfb"]?></td>
			    <td><?=$rows["fandian"]?></td>
	          <td><a href="login_ip.php?ip=<?=$rows["reg_ip"]?>" ><?=$rows["reg_ip"]?></a>
              <br/>
              <a href="login_ip.php?ip=<?=$rows["login_ip"]?>"><?=$rows["login_ip"]?></a></td>
	          <td align="left">
              <? if($wz==0){?>
             <span style="color:red"><?=$topusername ?></span>
              <? }else{ ?>
             <span style="color:red"><?=$topusername ?></span>的第<span style="color:blue;"><?= $wz ?></span>层下级
              <? } ?>
              </td>
              <td align="left">
              &nbsp;
              <? if($rows["is_daili"]==1&&$rows["dltype"]==0){?>
               <a style='color:red' title="单击查看改代理的所有会员" href="list.php?top_uid=<?=$rows["uid"]?>&dltype=<?=$rows["dltype"]?>">代理</a>
              <? }
			  else if($rows["is_daili"]==1&&$rows["dltype"]==1){?>
               <a title="单击查看改代理的所有会员" href="list.php?top_uid=<?=$rows["uid"]?>&dltype=<?=$rows["dltype"]?>">传统</a>
              <? }else {?>
                否
			  <? }?>
			  /
              <a href="edit_daili.php?id=<?=$rows["uid"]?>">修改</a>
              </td>
              
	          <td><a href="list.php?likevalue=<?=$rows["mobile"]?>&selecttype=mobile"><?=$rows["mobile"]?></a><br /><?=$rows["email"]?><br /><?=$rows["qq"]?></td>
	          <td style='display:none' ><a href="../bbgl/report_day.php?username=<?=$rows["username"]?>">核查会员</a><br /><?=$rows["name"]?></td>
	          <td>
			  <?=$rows["ul_type"]>0 ? "<span style=\"color:#FF00FF;\">在线</span>" : "<span style=\"color:#999999;\">离线</span>" ?><br/>
			 <? if($rows["is_stop"]==1){?>
              <span style="color: #FF0000;">停用</span>
              <? }else if($rows["is_stop"]==0){?>
                <span style="color:#006600;">正常</span>
                 <? }else {?>
                      <span style="color:#F1DF12;">异常</span>
			  <? }?>
              
              
              </td>
	          <td><input name="uid[]" type="checkbox" id="uid[]" value="<?=$rows["uid"]?>" /></td>
          </tr> 
          
           <? }?>
          
		  
		  
		  
		  
		  <?php }else{ ?>
                
                 
          
      
          
          <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>">
	          <td><a href="user_show.php?id=<?=$rows["uid"]?>"><?=$rows["uid"]?></a></td>
			  <td>
                <?php
			  	if($rows["agents"]=='' || $rows["agents"]==null){
                ?>
              	<a href="user_show.php?id=<?=$rows["uid"]?>" style="color:#060;"><?=$rows["username"]?></a>
                <?php
				}
				else{
				?>
                <a href="user_show.php?id=<?=$rows["uid"]?>"><?=$rows["username"]?></a>
                <?php
				}
				?>
               </td>
	          <td>
              	<?php
			  	if($rows["agents"]=='' || $rows["agents"]==null){
                ?>
              	<a href="list.php?likevalue=<?=urlencode($rows["pay_name"])?>&selecttype=pay_name" style="color:#060;"><?=$rows["pay_name"]?></a>
                <?php
				}
				else{
				?>
                <a href="list.php?likevalue=<?=urlencode($rows["pay_name"])?>&selecttype=pay_name"><?=$rows["pay_name"]?></a>
                <?php
				}
				?>
                <br/><br/><?=$rows["reg_date"]?></td>
              <td><a href="../cwgl/hccw.php?username=<?=$rows["username"]?>">查看财务</a>&nbsp;|&nbsp;<a href="../cwgl/set_money.php?uid=<?=$rows["uid"]?>&type=add">修改额度</a><br /><font color=blue><b><?=$rows["money"]?></b></font><br /><?=$rows["zfb"]?></td>
			<td><?=$rows['fandian']?></td>
	          <td><a href="login_ip.php?ip=<?=$rows["reg_ip"]?>" ><?=$rows["reg_ip"]?></a>
              <br/>
              <a href="login_ip.php?ip=<?=$rows["login_ip"]?>"><?=$rows["login_ip"]?></a></td>
               <td> <? if($rows["top_uid"]>0){?>
             <a href="list.php?top_uid=<?=$rows["top_uid"]?>"><?=user::getusername($rows["top_uid"])?>|<?=$rows["top_uid"]?></a>
              <? }?></td>
	          <td align="left">
              &nbsp;
              <? if($rows["is_daili"]==1&&$rows["dltype"]==0){?>
               <a style='color:red' title="单击查看改代理的所有会员" href="list.php?top_uid=<?=$rows["uid"]?>&dltype=<?=$rows["dltype"]?>">分享</a>
              <? }
			  else if($rows["is_daili"]==1&&$rows["dltype"]==1){?>
               <a title="单击查看改代理的所有会员" href="list.php?top_uid=<?=$rows["uid"]?>&dltype=<?=$rows["dltype"]?>">传统</a>
              <? }else {?>
                否
			  <? }?>
			  /
              <a href="edit_daili.php?id=<?=$rows["uid"]?>">修改</a>
             </td>
	          <td><a href="list.php?likevalue=<?=$rows["mobile"]?>&selecttype=mobile"><?=$rows["mobile"]?></a><br /><?=$rows["email"]?><br /><?=$rows["qq"]?></td>
	          <td style='display:none' ><a href="../bbgl/report_day.php?username=<?=$rows["username"]?>">核查会员</a><br /><?=$rows["name"]?></td>
	          <td>
			  <?=$rows["ul_type"]>0 ? "<span style=\"color:#FF00FF;\">在线</span>" : "<span style=\"color:#999999;\">离线</span>" ?><br/>
			 <? if($rows["is_stop"]==1){?>
              <span style="color: #FF0000;">停用</span>
              <? }else if($rows["is_stop"]==0){?>
                <span style="color:#006600;">正常</span>
                 <? }else {?>
                      <span style="color:#F1DF12;">异常</span>
			  <? }?>
              
              
              </td>
	          <td><input name="uid[]" type="checkbox" id="uid[]" value="<?=$rows["uid"]?>" /></td>
          </tr> 
          
          	   <? }?>
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