<?php
include_once("../common/login_check.php");
include_once("../include/mysqli.php");
include_once("../include/function_daili.php");

if($_GET['uid'] != null) {
	$sql	=	"select * from k_user where uid=".$_GET['uid'];
	$query	=	$mysqli->query($sql);
	while($rows	=	$query->fetch_array()){
		if($rows['is_daili']==1) {
			$username	=	$rows['username'];
			$uid = $rows['uid'];
			$daili_type = $rows['is_zongdaili'] == 1?"总代理":"代理";
			$is_zongdaili = $rows['is_zongdaili'] == 1;
			$zongdaili_uid = ($rows['zongdaili_uid']==null || $rows['zongdaili_uid']<=0)?null:$rows['zongdaili_uid'];
			$daili_mode = $rows['daili_mode'];
			
			if($_SESSION["uid"] != $zongdaili_uid) {
				$msg = "<script>alert('该代理不属于你的线下代理');location.href='cha_xiaji_dynamic.php';</script>";
			}
		} else {
			$msg = "<script>alert('用户不是代理');location.href='cha_xiaji_dynamic.php';</script>";
		}
	}

	if($username!=null) {
		$sql	=	"select * from k_daili_user_config where uid=".$uid;
		$query	=	$mysqli->query($sql);
		while($rows	=	$query->fetch_array()){
			$has_config = true;
			$zc_zd_ty_ratio = $rows['zc_zd_ty_ratio'];
			$zc_dl_ty_ratio = $rows['zc_dl_ty_ratio'];
			$zc_yx_ratio = $rows['zc_yx_ratio'];
			$zc_fc_ratio = $rows['zc_fc_ratio'];
			$zc_lt_ratio = $rows['zc_lt_ratio'];
			$cs_ratio = $rows['cs_ratio'];
		}
		
		if($_POST["mode"] != null) {
			$daili_mode = $_POST['mode'];
			$use_default = $_POST['use_default'];
			$zc_zd_ty_ratio = $_POST['zc_zd_ty_ratio'];
			$zc_dl_ty_ratio = $_POST['zc_dl_ty_ratio'];
			$zc_yx_ratio = $_POST['zc_yx_ratio'];
			$zc_fc_ratio = $_POST['zc_fc_ratio'];
			$zc_lt_ratio = $_POST['zc_lt_ratio'];
			$cs_ratio = $_POST['cs_ratio'];
			
			$ratio = array();
			$ratio["zc_zd_ty_ratio"] = $_POST['zc_zd_ty_ratio'];
			$ratio["zc_dl_ty_ratio"] = $_POST['zc_dl_ty_ratio'];
			$ratio["zc_yx_ratio"] = $_POST['zc_yx_ratio'];
			$ratio["zc_fc_ratio"] = $_POST['zc_fc_ratio'];
			$ratio["zc_lt_ratio"] = $_POST['zc_lt_ratio'];
			$ratio["cs_ratio"] = $_POST['cs_ratio'];
			
			if($_POST["mode"]==0) {
				$ratio["validate_type"] = "zc";
				$cs_ratio = 0;
				$zc_zd_ty_ratio = 0;
			} else {
				$ratio["validate_type"] = "cs";
				$zc_zd_ty_ratio = 0;
				$zc_dl_ty_ratio = "";
				$zc_yx_ratio = 0;
				$zc_fc_ratio = 0;
				$zc_lt_ratio = 0;
			}
			
			$date_time_array = getdate (time());
			if($date_time_array[ "mday"]>2) {
				echo "<script>alert('只能在一个月的前三天内进行修改');location.href=location.href;</script>";
				exit;
			}
			
			$thisMonth	=	date('Y-m',time());
			$sql	=	"select * from k_daili_user_config_history where uid=".$uid." and month='".$thisMonth."'";
			$query	=	$mysqli->query($sql);
			$rows	=	$query->fetch_array();
			if($rows) {
				echo "<script>alert('本月已经设置过该代理的相关参数，一个月只允许设置一次');location.href=location.href;</script>";
				exit;
			}
			
			/*
			$upMonth	=	date('Y-m',strtotime("$thisMonth -1 month"));
			$sql	=	"select * from k_daili_jiesuan_month where uid=".$uid." and month='".$thisMonth."'";
			$query	=	$mysqli->query($sql);
			$rows	=	$query->fetch_array();
			if(!$rows) {
				echo "<script>alert('上月还没结算，不能设置代理相关参数，请等结算完成后再设置');location.href=location.href;</script>";
				exit;
			}
			*/
			
			if($use_default==null) {
				$msg = validateDailiRatio($ratio);
			}
			if($msg == null) {
				if($use_default==null) {
					$sql    =   "INSERT INTO `k_daili_user_config_history`(`uid`,month,daili_mode, use_default, `zc_zd_ty_ratio`, `zc_dl_ty_ratio`, `zc_yx_ratio`, `zc_fc_ratio`, `zc_lt_ratio`, `cs_ratio`, created_time) VALUES (".$uid.",'".$thisMonth."',".$daili_mode.",0,".$zc_zd_ty_ratio.",'".$zc_dl_ty_ratio."',".$zc_yx_ratio.",".$zc_fc_ratio.",".$zc_lt_ratio.",".$cs_ratio.",now())";
				} else {
					$sql    =   "INSERT INTO `k_daili_user_config_history`(`uid`,month,daili_mode, use_default, created_time) VALUES (".$uid.",'".$thisMonth."',".$daili_mode.",1,now())";
				}
				$query	=	$mysqli->query($sql);
			}

			if($msg == null) {
				$msg = "<script>alert('代理模式和分红比例设置成功');location.href=location.href;</script>";
			}
		}
	}
} else {
	$msg = "<script>alert('参数错误');location.href='cha_xiaji_dynamic.php';</script>";
}

if($username==null && $msg==null) {
	$msg = "<script>alert('用户不存在');location.href='cha_xiaji_dynamic.php';</script>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>万丰国际</title>
<link href="../css/tikuan2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<script language="javascript">
if(self==top){
	//top.location='/index.php';
}

function switchUserConfig(){
	$("#user_config").toggle();
	switchMode();
}

function switchMode(){
	if(!$('#use_default').is(':checked')){
		if($('#zc_mode').is(':checked'))
		{
			$('#zc_config').show();
			$('#cs_config').hide();
			$("#zd_ty").hide();
			$("#dl_ty").show();
		} else {
			$('#zc_config').hide();
			$('#cs_config').show();
		}
	}
}
</script>
</head>
<body>
<div id="top_lishi" style="text-align:center" >
<br>
<span style="color:red"><?=$msg?></span>
<br>
<?=$username?>代理类型: <?=$daili_type?><br><br>
<?php $max_ratio=getDailiRatio($uid, true); ?>
代理设置说明:<br><br>
<div style="text-align:center">
<div style="text-align:left;width:500px">
1. 每个月只允许修改一次代理模式和比例<br/>
2. 每次修改时间限定于每个月的前三天<br/>
3. 修改之后为了避免对上个月的报表产生影响，修改生效日为每个月的第七天<br/>
4. 修改生效后，下级的计算方式会发生相应改变，会在查下级明细中体现<br/>
5. 因模式改变会导致有效金额返水计算方式的变化，每个月的第七天后才能提取有效金额返水<br><br>
</div>
</div>
<form action="?<?php echo "uid=".$uid;?>" method="post">
	代理模式设置:
	<input type="radio" name="mode" id="zc_mode" <?php if($daili_mode==0){echo 'checked="checked" ';} ?> onclick="switchMode()" value="0">占成模式 &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="mode" <?php if($daili_mode!=0){echo 'checked="checked" ';} ?> onclick="switchMode()"  value="1">返水模式&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" name="use_default" id="use_default" <? if(($_POST['mode']!=null && $use_default != null) || ($_POST['mode']==null &&!$has_config)) { echo 'checked="checked" ';} ?> value="1" onclick="switchUserConfig()">使用系统默认比例
	<br><br>
	<div id="user_config" <? if(($_POST['mode']!=null && $use_default != null) || ($_POST['mode']==null &&!$has_config)) {echo "style='display:none'"; }?>>
	<table id="zc_config" <?php if($daili_mode!=0){echo "style='display:none'";} ?>  cellspacing="8" cellpadding="8" border="0" 	>
	  <tr <?php if($is_zongdaili){echo "style='display:none'";} ?>>
		<td align="left" >体育分红比例<br><br>格式(开始范围~结束范围;比例):<br><span style="color:red">
		0~150000;0.3<br>
		150001~350000;0.35<br>
		350001;0.4<br>
		</span><br>请拷贝后修改，不要直接键入以免错误</td>
		<td><textarea name="zc_dl_ty_ratio" rows="6"><?=$zc_dl_ty_ratio?></textarea></td>
		<td style="color:red;" align="left"><?php if(!$is_zongdaili){ echo "额度:".(floatval($max_ratio["zc_zd_ty_ratio"])*100)."%";} ?></td>
	  </tr>
	  <tr style="display:none">
		<td align="left">体育有效金额返水比例</td>
		<td><input type="text" name="zc_yx_ratio" value="<?=$max_ratio["zc_yx_ratio"]?>"></td>
		<td style="color:red;" align="left"><?php if(!$is_zongdaili){ echo "额度:".(floatval($max_ratio["zc_yx_ratio"])*100)."%";} ?></td>
	  </tr>
	   <tr>
		<td align="left">福彩分红比例(填写小数，例:10%小数为0.1)</td>
		<td><input type="text" name="zc_fc_ratio" value="<?=$zc_fc_ratio?>"></td>
		<td style="color:red;" align="left"><?php if(!$is_zongdaili){ echo "额度:".(floatval($max_ratio["zc_fc_ratio"])*100)."%";} ?></td>
	  </tr>
	   <tr>
		<td align="left">乐透分红比例(填写小数，例:10%小数为0.1)</td>
		<td><input type="text" name="zc_lt_ratio" value="<?=$zc_lt_ratio?>"></td>
		<td style="color:red;" align="left"><?php if(!$is_zongdaili){ echo "额度:".(floatval($max_ratio["zc_lt_ratio"])*100)."%";} ?></td>
	  </tr>
	</table>
	<table id="cs_config" <?php if($daili_mode==0){echo "style='display:none'";} ?> cellspacing="8" cellpadding="8" border="0" 	>
	  <tr>
		<td width="250" align="left">返水分红比例(填写小数，例:10%小数为0.1)</td>
		<td width="100"><input type="text" name="cs_ratio" value="<?=$cs_ratio?>"></td>
		<td style="color:red;" align="left"><?php if(!$is_zongdaili){ echo "额度:".(floatval($max_ratio["cs_ratio"])*100)."%";} ?></td>
	  </tr>
	</table>
	</div>
	<input type="submit" value="提交">
</form>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
<script type="text/javascript" language="javascript" src="../js/left_mouse.js"></script>
</body>
</html>