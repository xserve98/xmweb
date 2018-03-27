<?php
include("../common/login_check.php");ini_set('display_errors','yes');
check_quanxian("ssgl");   
include("../../include/mysqli.php");
include("../cj/Lottery/auto_class24.php");
include("../../include/pager.class.php");
include("auto_class.php");
include ("../../Lottery/include/order_info.php");
if(is_numeric($_REQUEST['type'])){
	$gameId=intval($_REQUEST['type']);
}else{
	$gameId=get_gameType_self();
}
if(!$gameId) $gameId=25;
$gameName=get_gameName(25);
//echo $gameId;
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
	$sql		=	"insert into c_auto_$gameId(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values (".$qishu.",'".$datetime."','$ball_1','$ball_2','$ball_3','$ball_4','$ball_5')";
	$mysqli->query($sql);
	//echo $sql;
		message('添加成功');
}elseif($_GET["action"]=="edit" && $id>0){
	$qishu		=	$_POST["qishu"];
	$datetime	=	$_POST["datetime"];
	$ball_1		=	$_POST["ball_1"];
	$ball_2		=	$_POST["ball_2"];
	$ball_3		=	$_POST["ball_3"];
	$ball_4		=	$_POST["ball_4"];
	$ball_5		=	$_POST["ball_5"];
	$sql	="update c_auto_$gameId set qishu=".$qishu.",datetime='".$datetime."',ball_1='$ball_1',ball_2='$ball_2',ball_3='$ball_3',ball_4='$ball_4',ball_5='$ball_5' where id=".$id."";
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
    <td  align="left" bgcolor="#FFFFFF"><input name="qishu" type="text" id="qishu" value="<?=$rs['qishu']?>" size="20" maxlength="11"/></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#F0FFFF">开奖时间：</td>
    <td align="left" bgcolor="#FFFFFF"><input name="datetime" type="text" id="datetime" value="<?=$rs['datetime']?>" size="20" maxlength="19"/> <span>0-51代表梅花A到黑心K：</span><a style="color:red" target="_blank" href='/images/niuniu_poker.png'>点击查看数字对应的牌型</a></td>
    </tr>
  <tr>
    <td align="left" bgcolor="#F0FFFF">开奖号码：</td>
    <td align="left" bgcolor="#FFFFFF">
       庄：<input  name="ball_1" id="ball_1" type="text"  value="<?=$rs['ball_1']?>" size="20" maxlength="50"/>&nbsp;&nbsp;
       天：<input  name="ball_2" id="ball_2" type="text"  value="<?=$rs['ball_2']?>" size="20" maxlength="50"/>&nbsp;&nbsp;
       地：<input  name="ball_3" id="ball_3" type="text"  value="<?=$rs['ball_3']?>" size="20" maxlength="50"/>&nbsp;&nbsp;
       玄：<input  name="ball_4" id="ball_4" type="text"  value="<?=$rs['ball_4']?>" size="20" maxlength="50"/>&nbsp;&nbsp;
       黄：<input  name="ball_5" id="ball_5" type="text"  value="<?=$rs['ball_5']?>" size="20" maxlength="50"/>&nbsp;&nbsp;
       
     
      </select></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="left" bgcolor="#FFFFFF"><input name="submit" type="submit" class="submit80" value="确认发布"/></td>
  </tr>
</table>  
    </form>
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9" style="margin-top:5px;">
     <form name="form1" method="get" action="">
      <tr>
        <td align="center" bgcolor="#FFFFFF">
			彩票期号
            <input name="orderno" type="text" id="orderno" value="<?=$orderno?>" size="22" maxlength="20"/>
            &nbsp;<input type="submit" name="Submit" value="搜索"></td>
        </tr>   
      </form>
    </table>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">   
            <tr style="background-color:#3C4D82; color:#FFF">
              <td align="center"><strong>彩票类别</strong></td>
              <td align="center"><strong>彩票期号</strong></td>
              <td align="center"><strong>开奖时间</strong></td>
              <td align="center"><strong>庄家</strong></td>
              <td align="center"><strong>天</strong></td>
              <td align="center"><strong>地</strong></td>
              <td align="center"><strong>玄</strong></td>
        <td height="25" align="center"><strong>黄</strong></td>
      
        <td height="25" align="center"><strong>庄家/天/地/玄/黄</strong></td>
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
		
		
$zhm	= niuniu($rows['ball_1']);
$thm	= niuniu($rows['ball_2']);
$dhm	= niuniu($rows['ball_3']);
$xhm	= niuniu($rows['ball_4']);
$hhm	= niuniu($rows['ball_5']);
$zarr=explode('-',$zhm);
$tarr=explode('-',$thm);
$darr=explode('-',$dhm);
$xarr=explode('-',$xhm);
$harr=explode('-',$hhm);
$zmingcheng=mingcheng(intval($zarr[0]));	
	$tmingcheng=mingcheng(intval($tarr[0]));
		$dmingcheng=mingcheng(intval($darr[0]));	
	      $xmingcheng=mingcheng(intval($xarr[0]));	
		    $hmingcheng=mingcheng(intval($harr[0]));			
		
		
		
		if($rows['ok']==1){
			$ok = '<a href="../cj/lottery/js_25.php?qi='.$rows['qishu'].'&t=1"><font color="#FF0000">已结算</font></a>';
		}else{
			$ok = '<a href="../cj/lottery/js_25.php?qi='.$rows['qishu'].'&t=1" onclick="return js();" ><font color="#0000FF">未结算</font></a>';
		}
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>; line-height:20px;">
        <td height="25" align="center" valign="middle"><?=$gameName?></td>
        <td align="center" valign="middle"><?=$rows['qishu']?></td>
        <td align="center" valign="middle"><?=$rows['datetime']?></td>
        <td align="center" valign="middle"><?=$rows['ball_1']?></td>
        <td align="center" valign="middle"><?=$rows['ball_2']?></td>
        <td align="center" valign="middle"><?=$rows['ball_3']?></td>
        <td align="center" valign="middle"><?=$rows['ball_4']?></td>
        <td align="center" valign="middle"><?=$rows['ball_5']?></td>
        <td> 庄：<?=$zmingcheng?> &nbsp;天：<?=$tmingcheng?> &nbsp;地：<?=$dmingcheng?> &nbsp;玄：<?=$xmingcheng?> &nbsp;黄：<?=$hmingcheng?></td>
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