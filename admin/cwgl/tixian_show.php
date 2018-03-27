<?php
//include_once("../../include/config.php"); 
include_once("../common/login_check.php");
check_quanxian("cwgl");
include_once("../../include/mysqli.php");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户提现处理</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE1 {font-size: 10px}
.STYLE2 {font-size: 12px}
body {	margin: 0px;}
td{font:13px/120% "宋体";padding:3px;}
a{color:#FFA93E;}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
<script language="JavaScript" src="../../js/jquery.js"></script>
<script language="javascript">   
function chang(){
	var type	=	$("input[name='status']:checked").val();
	if(type == 1){
		$("#d_txt").html('请填写本次汇款的实际手续费');
		$("#d_text").html("<input name=\"sxf\" type=\"text\" id=\"sxf\" size=\"20\" maxlength=\"20\">&nbsp;元");
	}else if(type == 0){
		$("#d_txt").html('请填写未支付原因');
		$("#d_text").html("<textarea name=\"about\" id=\"about\" cols=\"45\" rows=\"5\"><?=$rows["about"]?></textarea>");
	}else{
		$("#d_txt").html('&nbsp;');
		$("#d_text").html('&nbsp;');
	}
}

function check(){
	var type	=	$("input[name='status']:checked").val();
	if(type == 1){
		if($("#sxf").val().length < 1){
			alert('请您填写本次汇款的实际手续费');
			$("#sxf").focus();
			return false;
		}else{
			var sxf = $("#sxf").val()*1;
			if(sxf>2000 || sxf<0){
				alert('请输入正确的手续费');
				$("#sxf").select();
				return false;
			}
		}
	}else{
		
	}
	return true;
}
</script>
</HEAD>

<body>
<?php
if($_GET["action"]=="save"){
	$m_id	=	intval($_GET["m_id"]);
	$msg	=	'';
	$num	=	0;
	
	if($_POST["status"] == 1){
		$sxf	=	trim($_POST["sxf"]);
    	$sql	=	"update k_money set `status`=1,update_time=now(),sxf=$sxf where `status`=2 and m_id=$m_id";
		$msg	=	"审核了编号为".$m_id."的提款单,已支付";
		$num	=	1;
	}elseif($_POST["status"]==0){
		if(strpos($_POST['m_order'],'代理额度')){ //代理申请额度失败，要把申请额度记录删除
			$sql	=	"update k_money set `status`=0,update_time=now(),about='".$_POST["about"]."' where `status`=2 and m_id=$m_id";
			$num	=	1;
		}else{ //会员正常取款失败，得还款到账户上
			$sql	=	"update k_money,k_user set k_money.status=0,k_money.update_time=now(),k_money.about='".$_POST["about"]."',k_user.money=k_user.money-k_money.m_value,k_money.balance=k_user.money-k_money.m_value where k_user.uid=k_money.uid and k_money.status=2 and k_money.m_id=$m_id";
			$num	=	2;
			$msg	=	"审核了编号为".$m_id."的提款单,未支付,原因".$_POST["about"];
		}
	}else{
		message('操作无效');
	}
	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$bool	=	true; //默认删除代理提款申请成功
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		if($_POST["status"] == 0){ //得判断一下
			if(strpos($_POST['m_order'],'代理额度')){ //代理申请额度失败，要把申请额度记录删除
				$sql	=	"delete from k_user_daili_result where uid=".$_POST['uid']." and `type`=2 and month like('".date("Y-m",time())."%')";
				$mysqli->query($sql);
				$q2		=	$mysqli->affected_rows;
				if($q2 != 1) $bool	=	false; //删除失败
			}
		}
		if($q1 == $num && $bool){
			$mysqli->commit(); //事务提交
			
			if($num==2 && $_POST["about"]!=""){
				include_once("../../class/user.php");
				user::msg_add($_POST['uid'],$web_site['reg_msg_from'],$_POST['title'],$_POST["about"]);
			}
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],$msg);
			
			message('操作成功','tixian.php?status=2');
		}else{
			$mysqli->rollback(); //数据回滚
			message('操作失败');
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message('操作失败');
	}
}
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;账单详细查看</font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
<br>
<?
$sql	=	"select k_money.*,k_user.username,k_user.pay_name from k_money left join k_user on k_money.uid=k_user.uid  where  k_money.m_id=".intval($_GET["id"]);
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
?>
<form action="<?=$_SERVER['PHP_SELF']?>?action=save&m_id=<?=$rows["m_id"]?>" method="post" name="form1" id="form1" onSubmit="return check();">
<table width="90%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" align="center">
  <tr>
    <td bgcolor="#F0FFFF">用户名</td>
    <td><a href="../hygl/user_show.php?id=<?=$rows['uid']?>"><?=$rows["username"]?>
      <input name="uid" type="hidden" id="uid" value="<?=$rows['uid']?>">
    </a></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">订单号</td>
    <td> 
      <?=$rows["m_order"]?>
      <input name="m_order" type="hidden" id="m_order" value="<?=$rows["m_order"]?>"></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">开户行</td>
    <td><?=$rows["pay_card"]?></td>
  </tr>
  <tr>
    <td width="172" bgcolor="#F0FFFF">卡号</td>
    <td width="473"><?=$rows["pay_num"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">开户姓名</td>
    <td><?=$rows["pay_name"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">开户地址</td>
    <td><?=$rows["pay_address"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">取款前余额</td>
    <td><span style="color:#999999;"><?=sprintf("%.2f",$rows["assets"])?></span></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">金额</td>
    <td><?=sprintf("%.2f",abs($rows["m_value"]))?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">取款后余额</td>
    <td><span style="color:#999999;"><?=sprintf("%.2f",$rows["balance"])?></span></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">申请时间</td>
    <td><?=$rows["m_make_time"]?></td>
  </tr>
 <? if($rows["status"]==2){ ?> 
  <tr>
    <td bgcolor="#F0FFFF">操作</td>
    <td>
      <input name="status" type="radio" id="status" onClick="chang()" value="1" checked><span style="color:#009900">已支付</span>
	  &nbsp;
	  <input type="radio" name="status" id="radio" onClick="chang()" value="0"><span style="color:#FF0000">未支付</span></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF"><div id="d_txt">请填写本次汇款的实际手续费</div></td>
    <td><div id="d_text"><input name="sxf" type="text" id="sxf" value=0 size="20" maxlength="20">
    &nbsp;元</div></td>
  </tr>
  <?
  }
  if($rows["status"]==2){
  ?>
  <tr>
    <td bgcolor="#F0FFFF">操作</td>
    <td><input type="submit" value="提交"/></td>
  </tr>
<? } else { ?>
  <tr>
    <td bgcolor="#F0FFFF">状态</td>
    <td><? if($rows["status"]==1) echo '<span style="color:#006600;">成功</span>'; else echo '<span style="color:#FF0000;">失败</span>';?></td>
  </tr>
    <tr>
    <td bgcolor="#F0FFFF">处理时间</td>
    <td><?=$rows["update_time"]?></td>
  </tr>
<tr>
    <td bgcolor="#F0FFFF">原因</td>
    <td><?=$rows["about"]?></td>
  </tr>
<? } ?>
</table>
</form>
</td>
  </tr>
</table>
</body>
</html>