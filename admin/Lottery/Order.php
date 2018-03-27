<?php
include_once("../common/login_check.php");
check_quanxian("ssgl"); 
$type=$_GET['type'];
if(!$type) $type='重庆时时彩';
$type=='' ? $se1 = '#FF0' : $se1 = '#FFF';
$type=='重庆时时彩' ? $se4 = '#FF0' : $se4 = '#FFF';
$bet_tab='c_bet';
if($type=='北京赛车PK拾' || $type=='幸运飞艇' || $type=='广东快乐10分' || $type=='幸运农场'){$bet_tab='c_bet';}
include_once("../../include/mysqli.php");
include("../../include/pager.class.php");

if($_GET['id']>0)
{
	$id=intval($_GET['id']);
}

if($_GET["action"]=="cancel" && $id>0)
{
	$sql="select * from $bet_tab where type='$type' and id=$id";
	$query=$mysqli->query($sql);
	$rs=$query->fetch_array();
	if($rs)
	{
		$kuid=$rs['uid'];
		$kusername=$rs['username'];
		$money=$rs['money'];
		$win=$rs['win'];
		$js=$rs['js'];
		$fs=$rs['fs']? $rs['fs'] : 0;
		$remoney=$money-$fs;
		if($js==1 && $win>0) $remoney=$remoney-$win;
		
		//删除订单
		$sql="delete from $bet_tab where type='$type' and id=$id";
		$mysqli->query($sql);
		
		//退回金额
		$sql="update k_user set money=money+$remoney where uid=$kuid";
		$mysqli->query($sql);
		
		//写日志
		include_once("../../class/admin.php");
		$message="撤销[".$kusername."]".$type."注单[".$id."],[注单金额:".$money.",可赢金额:".$win.",结算状态:".$js."],退回金额:".$remoney;
		admin::insert_log($_SESSION["adminid"],$message);
		message('操作成功');
	}
}
?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
</head>
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script language="javascript">
function go(value){
	if(value != "") location.href=value;
	else return false;
}

function check(){
	if($("#tf_id").val().length > 5){
		$("#status").val("0,1");
	}
	return true;
}
</script>
<script language="JavaScript" src="/js/calendar.js"></script>
<body>
<div id="pageMain">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top">
      <?php include_once("Menu_Order.php"); ?>
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
     <form name="form1" method="get" action="<?=$_SERVER["REQUEST_URI"]?>" onSubmit="return check();">
     <input type="hidden" name="type" value="<?=$type?>">
      <tr>
        <td align="center" bgcolor="#FFFFFF"><select name="js" id="js">
            <option value="0" style="color:#FF9900;" <?=$_GET['js']=='0' ? 'selected' : ''?>>未结算注单</option>
            <option value="1" style="color:#FF0000;" <?=$_GET['js']=='1' ? 'selected' : ''?>>已结算注单</option>
            <option value="0,1" <?=$_GET['js']=='0,1' ? 'selected' : ''?>>全部注单</option>
          </select>&nbsp;&nbsp;
          会员：<input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="15">
            &nbsp;&nbsp;日期：
            <input name="s_time" type="text" id="s_time" value="<?=$_GET['s_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
            ~
            <input name="e_time" type="text" id="e_time" value="<?=$_GET['e_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />&nbsp;&nbsp;注单号：
            <input name="tf_id" type="text" id="tf_id" value="<?=@$_GET['tf_id']?>" size="22">
            &nbsp;&nbsp;
            <input type="submit" name="Submit" value="搜索"></td>
        </tr>   
      </form>
    </table>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">   
            <tr style="background-color:#3C4D82; color:#FFF">
              <td align="center"><strong>订单号</strong></td>
              <td align="center"><strong>开奖结果</strong></td>
              <td align="center"><strong>彩票期号</strong></td>
              <td align="center"><strong>投注玩法</strong></td>
              <td align="center"><strong>投注内容</strong></td>
              <td align="center"><strong>投注金额</strong></td>
              <td align="center"><strong>赔率</strong></td>
        <td height="25" align="center"><strong>派彩</strong></td>
        <td height="25" align="center"><strong>返水</strong></td>
        <td align="center"><strong>投注时间</strong></td>
        <td align="center"><strong>投注账号</strong></td>
        <td height="25" align="center"><strong>状态</strong></td>
        <td height="25" align="center"><strong>操作</strong></td>
        </tr>
<?php
	  
	  $uid	=	'';
	  if($_GET['username']){
	      $sql		=	"select uid from k_user where username='".$_GET['username']."' limit 1";
		  $query	=	$mysqli->query($sql);
		  if($rows	=	$query->fetch_array()){
		  		$uid=	$rows['uid'];
		  }
	  }
 
      $sql	=	"select id from $bet_tab where type='$type' and money>0 ";
	  if($type) $sql.=" and type='".$type."'";
	  if($_GET["uid"]) $uid = $_GET["uid"];
	  if($uid != '') $sql.=" and uid=".$uid;
	  if($_GET["s_time"]) $sql.=" and addtime>='".$_GET["s_time"]." 00:00:00'";
	  if($_GET["e_time"]) $sql.=" and addtime<='".$_GET["e_time"]." 23:59:59'";
	  if(isset($_GET["js"]))  $sql.=" and `js` in (".$_GET["js"].")";
	  if($_GET['tf_id']) $sql.=" and id=".$_GET['tf_id']."";
	  $order = 'id';
	  if($_GET['order']) $order = $_GET['order'];
	  $sql.=" order by $order desc ";
	  
	  $query	=	$mysqli->query($sql);
	  $sum		=	$mysqli->affected_rows; //总页数
	  $thisPage	=	1;
	  $pagenum	=	50;
	  if($_GET['page']){
	  	  $thisPage	=	$_GET['page'];
	  }
      $CurrentPage=isset($_GET['page'])?$_GET['page']:1;
	  $myPage=new pager($sum,intval($CurrentPage),$pagenum);
	  $pageStr= $myPage->GetPagerContent();
	  
	  $bid		=	'';
	  $i		=	1; //记录 bid 数
	  $start	=	($thisPage-1)*$pagenum+1;
	  $end		=	$thisPage*$pagenum;
	  while($row = $query->fetch_array()){
	  	  if($i >= $start && $i <= $end){
	  	  	$bid .=	$row['id'].',';
		  }
		  if($i > $end) break;
		  $i++;
	  }
	  if($bid){
	  	$bid	=	rtrim($bid,',');
	  	$sql	=	"select * from $bet_tab where id in($bid) order by $order desc";
	  	$query	=	$mysqli->query($sql);
		
		$paicai	=	0;
		$sum_tz	=	0;
		$sum_pc	=	0;
		
      	while ($rows = $query->fetch_array()) {	  
		  $color = "#FFFFFF";
		  $over	 = "#EBEBEB";
		  $out	 = "#ffffff";
		  
		  if($rows['js']==0){
			$paicai	=	0;
		  }else{
			if($rows['win']==0){
				$paicai	=	$rows['money'];
			}else if($rows['win']<0){
				$paicai	=	0;
			}else{
				$paicai	=	$rows['win'];
			}
		  }
		  $sum_tz	+=	$rows['money'];
		  $sum_pc	+=	$paicai;
      	?>
      <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>; line-height:20px;">
        <td height="25" align="center" valign="middle"><?=$rows['id']?></td>
        <td align="center" valign="middle"><?=$rows['jieguo']?></td>
        <td align="center" valign="middle"><?=$rows['qishu']?></td>
        <td align="center" valign="middle"><?=$rows['mingxi_1']?></td>
        <td align="center" valign="middle"><?=$rows['mingxi_2']?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['money'])?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['odds'])?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$paicai)?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['fs'])?></td>
        <td><?=$rows['addtime']?></td>
        <td><?=$rows['username']?></td>
        <td><?php if($rows['js']==0){?><font color="#0000FF">未结算</font><?php }?>
        <?php if($rows['js']==1){?><font color="#FF0000">已结算</font><?php }?></td>
        <td><a href="javascript:void(0);" onClick="if(confirm('您确定要撤销该注单？撤销后金额将重算并退回！'))location.href='?action=cancel&id=<?=$rows["id"]?>&type=<?=$type?>&page=<?=$_REQUEST["page"]?>';">撤销</a></td>
        </tr>
<?php
	}
}
?>
	<tr style="background-color:#FFFFFF;">
        <td colspan="13" align="center" valign="middle">本页投注总金额：<?=sprintf("%.2f",$sum_tz)?> 元&nbsp;&nbsp;派彩总金额：<?=sprintf("%.2f",$sum_pc)?> 元&nbsp;&nbsp;赢利总金额：<?=sprintf("%.2f",$sum_tz-$sum_pc)?> 元</td>
	</tr>
	<tr style="background-color:#FFFFFF;">
        <td colspan="13" align="center" valign="middle"><?php echo $pageStr;?></td>
        </tr>
    </table></td>
    </tr>
  </table>
</div>
</body>
</html>