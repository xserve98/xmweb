<?php
include_once("../common/login_check.php"); 
check_quanxian("bbgl");

$today	=	date("Y-m-d",strtotime("-1 day"));
if($_GET['date']) $today	=	$_GET['date'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员历史银行信息</title>
</head>

<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
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
<body>
<script language="JavaScript" src="../../js/calendar.js"></script>
<table width="100%" border="0">
<form id="form1" name="form1" method="get" action="yecx.php">
  <tr>
    <td width="15%">请输入会员名称：<br />为空查询所有会员</td>
    <td><textarea name="username" cols="80" rows="3" id="username"><?=$_GET['username']?></textarea> 
    多个会员用 , 隔开</td>
    </tr>
  <tr>
    <td>请选择余额日期：</td>
    <td><input name="date" type="text" id="date" value="<?=$today?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="查找" />
      <input name="action" type="hidden" id="action" value="1" /></td>
  </tr>
    </form>
</table>
<br />
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
    <td width="25%"><strong>会员名称</strong></td>
    <td width="25%"><strong>会员余额</strong></td>
    <td width="25%"><strong>添加时间</strong></td>
    <td width="25%"><strong>未结算注单</strong></td>
    </tr>
<?php
if($_GET['action'] == 1 && $today){
	$username	=	trim($_GET['username']);
	$where		=	'';
	if($username == ''){ //查询所有会员余额
	}else{
		$arr_un		=	explode(',',$username);
		foreach($arr_un as $k=>$v){
			$where	.= "'".$v."',";
		}
		if($where){
			$where	=	rtrim($where,",");
			$where	=	" and username in ($where)";
		}
	}
	
	$sql		=	"SELECT uid,username,money,addtime,bid_gid FROM save_user where addtime like('$today%')$where order by uid asc,id desc";
	$query		=	$mysqlio->query($sql);
	$user		=	array();
	while($row	=	$query->fetch_array()){
		$user[$row['uid']]['money']		=	$row['money'];
		$user[$row['uid']]['username']	=	$row['username'];
		$user[$row['uid']]['addtime']	=	$row['addtime'];
		$user[$row['uid']]['bid_gid']	=	$row['bid_gid'];
	}
	if($where){
		foreach($user as $uid=>$row){
			$cz		=	explode('#',$row['bid_gid']);
			for($i=0;$i<count($cz);$i++){
				$tempcz	=	rtrim($cz[$i],',');
				if($tempcz!=""){
					$count[$i]	=	count(explode(',',$tempcz));
				}
				else{
					$count[$i]=0;
				}
			}
?>
  <tr onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
    <td height="30" align="center"><a href="../hygl/user_show.php?id=<?=$uid?>" target="_blank"><?=$row['username']?></a></td>
    <td align="center"><?=$row['money']?></td>
    <td align="center"><?=$row['addtime']?></td>
    <td align="center">
		<a href="../zdgl/check_zd.php?action=1&id=<?=$cz[0]?>" target="_blank"><?=$count[0]>=1 ? '共有体育：'.$count[0].' 条未结算注单' : ''?></a>
		<?=$count[1]>=1 ? '<br>共有六合：'.$count[1].' 条未结算注单' : ''?>
		<?=$count[2]>=1 ? '<br>共有重庆时时彩：'.$count[2].' 条未结算注单' : ''?>
		<?=$count[3]>=1 ? '<br>共有其他时时彩：'.$count[3].' 条未结算注单' : ''?>
		<?=$count[4]>=1 ? '<br>共有普通彩票：'.$count[4].' 条未结算注单' : ''?>
	</td>
  </tr>
<?php
		}
	}else{
		$money		=	0;
		$addtime	=	'暂无记录';
		$bid_gid	=	'';
		foreach($user as $uid=>$row){
			$money		+=	$row['money'];
			$addtime	=	$row['addtime'];
			if($row['bid_gid']){
				$cz		=	explode('#',$row['bid_gid']);
				for($i=0;$i<count($cz);$i++){
					$temp[$i]	.=	$cz[$i].",";
				}
			}
		}
		for($i=0;$i<count($temp);$i++){
			$temp[$i]	=	rtrim($temp[$i],',');
			if($temp[$i]!=""){
				$count[$i]	=	count(explode(',',$temp[$i]));
			}
			else{
				$count[$i]=0;
			}
		}
?>
  <tr onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
    <td height="30" align="center">所有会员</td>
    <td align="center"><?=$money?></td>
    <td align="center"><?=$addtime?></td>
    <td align="center">
		<a href="../zdgl/check_zd.php?action=1&id=<?=$temp[0]?>" target="_blank"><?=$count[0]>=1 ? '共有体育：'.$count[0].' 条未结算注单' : ''?></a>
		<?=$count[1]>=1 ? '<br>共有六合：'.$count[1].' 条未结算注单' : ''?>
		<?=$count[2]>=1 ? '<br>共有重庆时时彩：'.$count[2].' 条未结算注单' : ''?>
		<?=$count[3]>=1 ? '<br>共有其他时时彩：'.$count[3].' 条未结算注单' : ''?>
		<?=$count[4]>=1 ? '<br>共有普通彩票：'.$count[4].' 条未结算注单' : ''?>
	</td>
  </tr>
<?php
	}
}
?>
</table>
</body>
</html>