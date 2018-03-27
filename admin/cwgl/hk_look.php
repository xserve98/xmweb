<?php
//ini_set('display_errors','yes');
///include_once("../../include/config.php"); 
include_once("../common/login_check.php"); 
check_quanxian("cwgl");
include_once("../../include/mysqli.php");
if($_GET["action"]){
	$status = $_POST["hf_status"];
	$id		= $_POST["hf_id"];
	$zsjr	= 0;
	$num	= 0;
	if($_POST['is_zsjr']==1){ //赠送1%
		$zsjr	= ($_POST['hf_money']/100*$_POST['rate']);
	}
	//exit($zsjr);
	$msg	=	'失败';
	if($status == "1"){
		include_once("../../class/user.php");
		$ball_sort='充值赠送';
		$jifen=$web_site['jf_tzjf']*$_POST['hf_money'];
		$about="充值:".$_POST['hf_money']." 元<br>[汇款]";
		
		$sql	=	"update k_user,huikuan set k_user.money=k_user.money+huikuan.money+$zsjr,huikuan.status=1,zsjr=$zsjr,huikuan.balance=k_user.money+huikuan.money+$zsjr,huikuan.jifen=$jifen where k_user.uid=huikuan.uid and huikuan.id=$id and huikuan.`status`=0";
		//echo $sql;exit;
		$msg	=	'成功';
		$num	= 	2;
	}else{
		$sql	=	"update huikuan set `status`=2,balance=assets where id=$id and `status`=0";
		$num	= 	1;
	}
	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
	//	echo $sql;
		$q1		=	$mysqli->affected_rows;
		
		
		if($q1 == $num&&$num==2){
			
			
			$sqls	=	"SELECT * FROM `huikuan` WHERE  id=$id";
	
			$querys	=	$mysqli->query($sqls);
			$rss		=	$querys->fetch_array();
					
			
			$re=user::jifen_add($rss['uid'],$rss['lsh'],$about,$jifen,1,$ball_sort);
			$mysqli->commit(); //事务提交
				
			
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"审核了编号为".$id."的汇款单,".$msg);
			
			include_once("../../class/user.php");
			$msg_txt="阁下，您好！你的转账订单已经到账，本次到账金额为".$_POST['hf_money']."元，请查询您的会员账户余额，谢谢！";
			user::msg_add($rss['uid'],$web_site['reg_msg_from'],'汇款到账提示',$msg_txt);
		$sqls2	=	"SELECT money FROM `k_user` WHERE  uid='".$rss['uid']."'";
			$querys2	=	$mysqli->query($sqls2);
			$rss2		=	$querys2->fetch_array();
			
		$pay_value	=	$_POST['hf_money']; //把金额置成带符号数字
		$orderid		=	$rss['uid']."_".date("YmdHis");
		$about =$rss['manner'];
		$assets=$rss2['money'];
	   $sql=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values('".$rss['uid']."',$pay_value,1,'$orderid','$about',".($assets-$pay_value).",'$assets',1)";
	  $mysqli->query($sql);			
			message('操作成功','huikuan.php?status=0');
		}else{	

			message('操作成功','huikuan.php?status=0');
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message('操作失败','huikuan.php?status=0');
	}
}
$id		=	$_GET["id"];
$sql	=	"select hk.*,u.username from `huikuan` hk,`k_user` u where hk.uid=u.uid and hk.id=$id";
$query	=	$mysqli->query($sql);
$rs		=	$query->fetch_array();
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户组编辑页面</TITLE>
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
a{

	color:#F37605;

	text-decoration: none;

}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>
<script type="text/javascript">
function check($v){
	document.getElementById("hf_status").value = $v;
	document.getElementById("form1").submit(); 
}
</script>
<body>
<form name="form1" id="form1" method="post" action="hk_look.php?action=true">
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">汇款管理：查看用户汇款信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="left" nowrap bgcolor="#FFFFFF"><input name="hf_status" type="hidden" id="hf_status">
      <input name="hf_id" type="hidden" id="hf_id" value="<?=$id?>"><input name="hf_money" type="hidden" id="hf_money" value="<?=$rs["money"]?>"></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" valign="top" nowrap bgcolor="#FFFFFF">
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
	        <tr align="center">
	          <td align="right">汇款流水号：</td>
	          <td align="left"><?=$rs["lsh"]?></td>
          </tr>
	        <tr align="center">
	          <td width="22%" align="right">汇款用户：</td>
              <td width="78%" align="left"><?=$rs["username"]?></td>
          </tr>
	        <tr align="center">
	          <td align="right">汇款前余额：</td>
	          <td align="left"><span style="color:#999999;"><?=sprintf("%.2f",$rs["assets"])?></span></td>
          </tr>
	        <tr align="center">
	          <td align="right">汇款金额：</td>
	          <td align="left"><?=sprintf("%.2f",$rs["money"])?></td>
          </tr>
	        <tr align="center">
	          <td align="right">汇款后余额：</td>
	          <td align="left"><span style="color:#999999;"><?=sprintf("%.2f",$rs["balance"])?></span></td>
          </tr>
	        <tr align="center">
	          <td align="right">汇款日期：</td>
	          <td align="left"><?=$rs["date"]?></td>
          </tr>
	        <tr align="center">
	          <td align="right">汇款银行：</td>
	          <td align="left"><?=$rs["bank"]?></td>
          </tr>
	        <tr align="center">
	          <td align="right">汇款方式：</td>
	          <td align="left"><?=$rs["manner"]?></td>
          </tr>
	        <tr align="center">
	          <td align="right">汇款地点：</td>
	          <td align="left"><?=$rs["address"]?></td>
          </tr>
	        <tr align="center">
	          <td align="right">提交时间：</td>
	          <td align="left"><?=$rs["adddate"]?></td>
          </tr>
	        <tr align="center">
	          <td align="right">当前状态：</td>
	          <td align="left"><?php
			  if($rs["status"]==1) echo "汇款成功";
			  else if($rs["status"]==2) echo "汇款失败";
			  else echo "审核中";
			  ?></td>
          </tr>
	        <tr align="center">
	          <td align="right">赠送手续费：</td>
	          <td align="left"><?php
			  if($rs['status']>0){
			  	echo $rs['zsjr'].' 元';
			  }else{
			  ?>
            <select name="rate" id="rate">
                <option value="0.1">0.1%</option>
                <option value="0.2">0.2%</option>
                <option value="0.3">0.3%</option>
                <option value="0.4">0.4%</option>
                <option value="0.5">0.5%</option>
                <option value="0.6">0.6%</option>
                <option value="0.7">0.7%</option>
                <option value="0.8">0.8%</option>
                <option value="0.9">0.9%</option>
                <option value="1.0">1.0%</option>
                <option value="1.1">1.1%</option>
                <option value="1.2">1.2%</option>
                <option value="1.3">1.3%</option>
                <option value="1.4">1.4%</option>
                <option value="1.5">1.5%</option>
                <option value="1.6">1.6%</option>
                <option value="1.7">1.7%</option>
                <option value="1.8">1.8%</option>
                <option value="1.9">1.9%</option>
                <option value="2.0">2.0%</option>
                <option value="2.1">2.1%</option>
                <option value="2.2">2.2%</option>
                <option value="2.3">2.3%</option>
                <option value="2.4">2.4%</option>
                <option value="2.5">2.5%</option>
                <option value="2.6">2.6%</option>
                <option value="2.7">2.7%</option>
                <option value="2.8">2.8%</option>
                <option value="2.9">2.9%</option>
                <option value="3.0">3.0%</option>
            </select>
			  <label>
	            <input name="is_zsjr" type="checkbox" id="is_zsjr" value="1"s>
	          勾选则赠送，不勾则不赠送。同城同行汇款不赠送</label>
			  <?php }?>
			  </td>
          </tr>
	        <tr align="center">
	          <td colspan="2" align="right">&nbsp;</td>
          </tr>
	        <tr align="center">
	          <td colspan="2" align="center">
			  <?php
			  if($rs["status"]==0){
			  ?>
	                <input type="button" name="Submit2" value="充值成功" onClick="check('1');">
	             　    
	             <input type="button" name="Submit3" value="充值失败" onClick="check('2');">　
				 <?php } ?>
	            <input type="button" name="Submit" value="返回" onClick="javascript:window.history.go(-1);">
	          </td>
          </tr>   	
    </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>