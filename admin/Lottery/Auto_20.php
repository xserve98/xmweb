<?php
include("../common/login_check.php");ini_set('display_errors','yes');
check_quanxian("ssgl");   
include("../../include/mysqli.php");
include("../../include/pager.class.php");
include("auto_class.php");
include ("../../Lottery/include/order_info.php");



if(is_numeric($_REQUEST['type'])){
	$gameId=intval($_REQUEST['type']);
}else{
	$gameId=get_gameType_self();
}
if(!$gameId) $gameId=2;
$gameName=get_gameName($gameId);
//echo $gameId;
//获取彩票期数
////////////获取本期期号时间///
$type = $gameId;
   $lottery_time=time();
	if($type==8 && date('H',$lottery_time)<5){
		$lottery_time=strtotime('-1 day',$lottery_time);
	}
	
	$sql	=	"select * from c_opentime_".$type." where kaipan<='".date("H:i:s",$lottery_time)."' and fengpan>='".date("H:i:s",$lottery_time)."' limit 1";
	$query	=	$mysqli->query($sql);
	$qs		=	$query->fetch_array();
	
	if($qs) {
		if($type==14){
				if(date('H',$lottery_time)<10){
					$lottery_time=strtotime('-1 day',$lottery_time);
					}
			
			}
		$xqishu= date("Ymd",$lottery_time).BuLings($qs['qishu']);
		$xtime =date("Ymd",$lottery_time)." ".$qs['kaijiang'];
	} else {
        $day = $lottery_time;
		if($type == 2) {
			$sql = "select * from c_opentime_".$type." where qishu=25";
		} elseif($type == 7 || $type == 3) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=1";
			if(date('H', $lottery_time) >= 22) {
                $day = strtotime('+1 day', $lottery_time);
            }
		} elseif($type == 9 || $type == 10) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=1";
			if(date('H', $lottery_time) >= 20) {
                $day = strtotime('+1 day', $lottery_time);
            }
		} elseif($type == 8) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=132";
		} elseif($type == 11) {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=14";
		} else {
			$sql = "select kaijiang from c_opentime_" . $type . " where qishu=1";
		}
		$query	=	$mysqli->query($sql);
		$qs		=	$query->fetch_array();
		
  	$xqishu=	date("Ymd", $day) . BuLings($qs['qishu']);
	$xtime =date("Ymd",$lottery_time)." ".$qs['kaijiang'];
		
	}
	



$id	=	0;
if($_GET['id'] > 0){
	$id	=	intval($_GET['id']);
}
if($_REQUEST['page']==''){
	$_REQUEST['page']=1;
}
if($_GET["action"]=="add" && $id==0){ 
	$qishu		=	$_POST["qishu"];
	$datetime	=	$_POST["datetime"];
	$ball_1		=	$_POST["ball_1"];
	$ball_2		=	$_POST["ball_2"];
	$ball_3		=	$_POST["ball_3"];
	$ball_4		=	$_POST["ball_4"];
	$ball_5		=	$_POST["ball_5"];
	$sql		=	"insert into c_auto_$gameId(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values (".$qishu.",'".$datetime."',".$ball_1.",".$ball_2.",".$ball_3.",".$ball_4.",".$ball_5.")";
	$mysqli->query($sql);
	message('添加成功');
	
}elseif($_GET["action"]=="edit" && $id>0){
	$qishu		=	$_POST["qishu"];
	$datetime	=	$_POST["datetime"];
	$ball_1		=	$_POST["ball_1"];
	$ball_2		=	$_POST["ball_2"];
	$ball_3		=	$_POST["ball_3"];
	$ball_4		=	$_POST["ball_4"];
	$ball_5		=	$_POST["ball_5"];
	$sql		=	"update c_auto_$gameId set qishu=".$qishu.",datetime='".$datetime."',ball_1=".$ball_1.",ball_2=".$ball_2.",ball_3=".$ball_3.",ball_4=".$ball_4.",ball_5=".$ball_5." where id=".$id."";
	$mysqli->query($sql);
		message('添加成功');
}

$orderno=trim($_GET["orderno"]);



?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
<script language="javascript" src="/js/jquery.js"></script>
<script language="javascript">
	
	function inputsr(){  
		
   $('#qishu').val('<?=$xqishu?>');
   $('#datetime').val('<?=$xtime?>');
 }  
	
	
	
	function js(){  
    if(confirm("确认结算吗？请保证开奖号无误之后再确认结算")){  
        return true;  
    }  
    return false;  
 }  
function check_submit(){
	if($("#qishu").val()==""){
		alert("请填写开奖期数");
		$("#qishu").focus();
		return false;
	}
	if($("#datetime").val()==""){
		alert("请填写开奖时间");
		$("#datetime").focus();
		return false;
	}
	if($("#ball_1").val()==""){
		alert("请选择第一球开奖号码");
		$("#ball_1").focus();
		return false;
	}
	if($("#ball_2").val()==""){
		alert("请选择第二球开奖号码");
		$("#ball_2").focus();
		return false;
	}
	if($("#ball_3").val()==""){
		alert("请选择第三球开奖号码");
		$("#ball_3").focus();
		return false;
	}
	if($("#ball_4").val()==""){
		alert("请选择第四球开奖号码");
		$("#ball_4").focus();
		return false;
	}
	if($("#ball_5").val()==""){
		alert("请选择第五球开奖号码");
		$("#ball_5").focus();
		return false;
	}
	return true;
}
</script>
</head>
<body>
<div id="pageMain">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top">
        <?php include_once("Menu_Auto.php"); ?>
        <form name="form1" onSubmit="return check_submit();" method="post" action="?id=<?=$id?>&type=<?=$gameId?>&action=<?=$id>0 ? 'edit' : 'add'?>&page=<?=$_REQUEST['page']?>&orderno=<?=$orderno?>">
<?php
if($id>0 && !isset($_GET['action'])){
	$sql	=	"select * from c_auto_$gameId where id=$id limit 1";
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
}
?>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
  <tr>
    <td  align="left" bgcolor="#F0FFFF">彩票类别：</td>
    <td  align="left" bgcolor="#FFFFFF"><?=$gameName?>【<a href="Uptime_2.php?type=<?=$gameId?>" style="color:#ff0000;">点击进入盘口管理</a>】</td>
  </tr>
  <tr>
    <td width="60"  align="left" bgcolor="#F0FFFF">开奖期号：</td>
    <td  align="left" bgcolor="#FFFFFF"><input name="qishu" type="text" id="qishu" value="<?=$rs['qishu']?>" onclick="return inputsr();"   size="20" maxlength="20"/></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#F0FFFF">开奖时间：</td>
    <td align="left" bgcolor="#FFFFFF"><input name="datetime" type="text" id="datetime" value="<?=$rs['datetime']?>" size="20" maxlength="19"/></td>
    </tr>
  <tr>
    <td align="left" bgcolor="#F0FFFF">开奖号码：</td>
    <td align="left" bgcolor="#FFFFFF"><select name="ball_1" id="ball_1">
        <option value="0" <?=$rs['ball_1']==0 ? 'selected' : ''?>>0</option>
        <option value="1" <?=$rs['ball_1']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_1']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_1']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_1']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_1']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_1']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_1']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_1']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_1']==9 ? 'selected' : ''?>>9</option>
        <option value="" <?=$rs['ball_1']=='' ? 'selected' : ''?>>第一球</option>
      </select>
      <select name="ball_2" id="ball_2">
        <option value="0" <?=$rs['ball_2']==0 ? 'selected' : ''?>>0</option>
        <option value="1" <?=$rs['ball_2']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_2']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_2']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_2']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_2']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_2']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_2']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_2']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_2']==9 ? 'selected' : ''?>>9</option>
        <option value="" <?=$rs['ball_2']=='' ? 'selected' : ''?>>第二球</option>
      </select>
      <select name="ball_3" id="ball_3">
        <option value="0" <?=$rs['ball_3']==0 ? 'selected' : ''?>>0</option>
        <option value="1" <?=$rs['ball_3']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_3']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_3']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_3']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_3']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_3']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_3']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_3']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_3']==9 ? 'selected' : ''?>>9</option>
        <option value="" <?=$rs['ball_3']=='' ? 'selected' : ''?>>第三球</option>
      </select>
      <select name="ball_4" id="ball_4">
        <option value="0" <?=$rs['ball_4']==0 ? 'selected' : ''?>>0</option>
        <option value="1" <?=$rs['ball_4']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_4']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_4']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_4']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_4']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_4']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_4']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_4']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_4']==9 ? 'selected' : ''?>>9</option>
        <option value="" <?=$rs['ball_4']=='' ? 'selected' : ''?>>第四球</option>
      </select>
      <select name="ball_5" id="ball_5">
        <option value="0" <?=$rs['ball_5']==0 ? 'selected' : ''?>>0</option>
        <option value="1" <?=$rs['ball_5']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_5']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_5']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_5']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_5']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_5']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_5']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_5']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_5']==9 ? 'selected' : ''?>>9</option>
        <option value="" <?=$rs['ball_5']=='' ? 'selected' : ''?>>第五球</option>
      </select></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="left" bgcolor="#FFFFFF"><input name="submit" type="submit" class="submit80" value="确认发布"/></td>
  </tr>
</table>  
    </form>
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9" style="margin-top:5px;">
     <form name="form1" method="get" action="?id=<?=$id?>&type=<?=$gameId?>&action=<?=$id>0 ? 'edit' : 'add'?>&page=<?=$_REQUEST['page']?>&orderno=<?=$orderno?>">
      <tr>
        <td align="center" bgcolor="#FFFFFF">
			彩票期号
            <input name="orderno" type="text" id="orderno" value="<?=$orderno?>" size="22" maxlength="20"/>
            <input name="type" type="hidden" id="type" value="<?=$gameId?>" size="22" maxlength="20"/>
            &nbsp;<input type="submit" name="Submit" value="搜索"></td>
        </tr>   
      </form>
    </table>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">   
            <tr style="background-color:#3C4D82; color:#FFF">
              <td align="center"><strong>彩票类别</strong></td>
              <td align="center"><strong>彩票期号</strong></td>
              <td align="center"><strong>开奖时间</strong></td>
              <td align="center"><strong>第一球</strong></td>
              <td align="center"><strong>第二球</strong></td>
              <td align="center"><strong>第三球</strong></td>
              <td align="center"><strong>第四球</strong></td>
        <td height="25" align="center"><strong>第五球</strong></td>
        <td align="center"><strong>总和</strong></td>
        <td align="center"><strong>龙虎</strong></td>
        <td height="25" align="center"><strong>前三/中三/后三</strong></td>
        <td align="center">结算</td>
        <td align="center"><strong>操作</strong></td>
          </tr>
<?php
if($orderno!=""){
	$sqlwhere	=	" where qishu='$orderno'";
}else{
	$sqlwhere	=	"";
}
$sql		=	"select id from c_auto_$gameId ".$sqlwhere." order by qishu desc";
	
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
$pagenum	=	50;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$CurrentPage=isset($_GET['page'])?$_GET['page']:1;
$myPage=new pager($sum,intval($CurrentPage),$pagenum);
$pageStr= $myPage->GetPagerContent();

$id		=	'';
$i			=	1; //记录 uid 数
$start	=	($CurrentPage-1)*$pagenum+1;
$end	=	$CurrentPage*$pagenum;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$id .=	$row['id'].',';
  }
  if($i > $end) break;
  $i++;
}
if($id){
	$id	=	rtrim($id,',');
	$sql	=	"select * from c_auto_$gameId where id in($id) order by qishu desc";
	$query	=	$mysqli->query($sql);
	$time	=	time();
	while($rows = $query->fetch_array()){
		$color = "#FFFFFF";
	  	$over	 = "#EBEBEB";
	 	$out	 = "#ffffff";
		$hm 		= array();
		$hm[]		= $rows['ball_1'];
		$hm[]		= $rows['ball_2'];
		$hm[]		= $rows['ball_3'];
		$hm[]		= $rows['ball_4'];
		$hm[]		= $rows['ball_5'];
		if($rows['ok']==1){
			$ok = '<a href="../cj/lottery/js_'.$gameId.'.php?qi='.$rows['qishu'].'&t=1"><font color="#FF0000">已结算</font></a>';
		}else{
			$ok = '<a href="../cj/lottery/js_'.$gameId.'.php?qi='.$rows['qishu'].'&t=1"  onclick="return js();" ><font color="#0000FF">未结算</font></a>';
		}
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>; line-height:20px;">
        <td height="25" align="center" valign="middle"><?=$gameName?></td>
        <td align="center" valign="middle"><?=$rows['qishu']?></td>
        <td align="center" valign="middle"><?=$rows['datetime']?></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_1']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_2']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_3']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_4']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_5']?>.png"></td>
        <td><?=Ssc_Auto($hm,1)?> / <?=Ssc_Auto($hm,2)?> / <?=Ssc_Auto($hm,3)?></td>
        <td><?=Ssc_Auto($hm,4)?></td>
        <td><?=Ssc_Auto($hm,5)?> / <?=Ssc_Auto($hm,6)?> / <?=Ssc_Auto($hm,7)?></td>
        <td><?=$ok?></td>
        <td><a href="?id=<?=$rows["id"]?>&type=<?=$gameId?>&page=<?=$_REQUEST['page']?>&orderno=<?=$orderno?>">编辑</a></td>
        </tr>
<?php
	}
}
?>
	<tr style="background-color:#FFFFFF;">
        <td colspan="13" align="center" valign="middle"><?php echo $pageStr;?></td>
        </tr>
    </table></td>
    </tr>
  </table>
</div>
</body>
</html>