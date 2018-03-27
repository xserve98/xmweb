<?php
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
include("../../include/pager.class.php");
$C_Patch=$_SERVER['DOCUMENT_ROOT'];
@include_once($C_Patch."/cache/website.php");	

check_quanxian("ssgl"); 
$type=$_GET['type'];
$type=='' ? $se1 = '#FF0' : $se1 = '#FFF';

if($_GET["topuid"]) {
 $name=$_GET["topuid"];
 $sql_user	 =	"select * from k_user where username='$name' limit 1"; //取汇款前会员余额

 $query	 =	$mysqli->query($sql_user);
 $rs	 =	$query->fetch_array();
 
 $topjs = $rs['fdjishu'];
 $topdltype=$rs['fxdltype'];
 $dltype=$rs['dltype'];
 $topusername = $rs['username'];
 $topuid=$rs['uid'];

}

/////////////设置订单监控状态

$page	=	$_GET["page"];
$go		=	$_GET["go"];
$arr	=	$_POST['id'];
$id1	=	'';
$i		=	0; //会员个数
foreach($arr as $k=>$v){
	$id1 .= $v.',';
	$i++;
}
$id1	=	rtrim($id1,',');

if($_GET["go"]){
	$sql="update c_bet set jkzt=".intval($_GET["go"])." where id in ({$id1})";
	//echo  $sql="update c_bet set jkzt=".$_GET["go"]." where id in ({$id1})";
	$query=$mysqli->query($sql);
	message('操作成功');
	}








/////////////////////





if($_GET['id']>0)
{
	$id=intval($_GET['id']);
}

if($_GET["action"]=="cancel" && $id>0)
{
	//$sql="select * from c_bet2 where   id=$id";
	$sql="select * from c_bet where id=$id";
	
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
		$sql="delete from c_bet where id=$id";
		///echo $sql;
		$mysqli->query($sql);
		/////填写资金变动记录///
		
		
		
		   ///////////资金变动记录变量/////////////////
	
	$money_type	= 100;	
	$about	=	$rs['type']."投注撤单";
	$order	=	$rs['username']."_".date("YmdHis");
	/////////////////////////
	$sql	 =	"select * from k_user where uid=$kuid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$rows	 =	$query->fetch_array();
	$assets	 =	$rows['money'];
	///$assets=$assets+$allmoney-
	$assets2=$assets+$remoney;
	$sql_money	=	"insert into k_money(uid,m_value,status,m_order,about,assets,balance,type) values (".$kuid.",".$remoney.",1,'$order','$about','$assets','$assets2',".$money_type.")";
	//echo $sql;
	//exit;
	$mysqli->query($sql_money) or die ($sql_money);
		
		/////
		
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

<script type="text/javascript"> 
///$(document).ready(function(){
	
var t; 
t=<?=$web_site["refresh"]?>; 
function shua() 
{ 
t=t-1; 
document.getElementById("time").innerHTML="离下次刷新时间还有 "+t+" 秒"; 
if (t==0) 
{ 
document.location.reload(); 
} 
} 
///});
</script> 

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




<script>
function ckall(){
    for (var i=0;i<document.form2.elements.length;i++){
	    var e = document.form2.elements[i];
		if (e.name != 'checkall') e.checked = document.form2.checkall.checked;
	}
}

function check2(){
    var len = document.form2.elements.length;
	var num = false;
    for(var i=0;i<len;i++){
		var e = document.form2.elements[i];
        if(e.checked && e.name=='id[]'){
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
		
			if(action=="1"){
				if(confirm('确认恢复注单状态为"正常"吗？')){
					document.form2.action="order.php?go='0'";
				}else{
					return false;
				}
			}
			
				if(action=="2"){
					
				if(confirm('确认修改注单状态为"必中"吗？')){
					document.form2.action="order.php?go=1";
				}else{
					return false;
				}
			}
				if(action=="3"){
				if(confirm('确认修改注单状态为"必不中"吗？')){
					document.form2.action="order.php?go=2";
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

<body onLoad="window.setInterval(shua,1000);"> 
<div id="pageMain">
 
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top">
      <?php include_once("Menu_Order.php"); ?>
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
     <form name="form1" method="get" action="<?=$_SERVER["REQUEST_URI"]?>" onSubmit="return check();">
     <input type="hidden" name="type" value="<?=$type?>">
      <tr>
        <td align="left" bgcolor="#FFFFFF"><select name="js" id="js">
            <option value="0"  style="color:#FF9900;" <?=$_GET['js']=='0' ? 'selected' : ''?>>未结算注单</option>
            <option value="1" style="color:#FF0000;" <?=$_GET['js']=='1' ? 'selected' : ''?>>已结算注单</option>
            <option value="0,1" <?=$_GET['js']=='0,1' ? 'selected' : ''?>>全部注单</option>
          </select>&nbsp;&nbsp;
          会员：<input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="10">
         
          &nbsp;代理  <input name="topuid" type="text" id="topuid" value="<?=$topusername?>" size="10" maxlength="10"/>
            &nbsp;&nbsp;日期：
            <input name="s_time" type="text" id="s_time" value="<?=$_GET['s_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
            ~
            <input name="e_time" type="text" id="e_time" value="<?=$_GET['e_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />&nbsp;&nbsp;中奖金额：
            <input name="tf_id" type="text" id="tf_id" value="<?=@$_GET['tf_id']?>" size="15">
            &nbsp;&nbsp;
            <input type="submit" name="Submit" value="搜索">
             </form>
             <form name="form2" method="post" action="" id='form2' onSubmit="return check2();" style="margin:0 0 0 0;">
         <span class="STYLE4">注单监控：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="1">恢复正常</option>
        <option value="2">设置必中</option>
        <option value="3">设置必不中</option>
      
      
      </select>
      <input type="submit" name="Submit2" value="执行"/></td>
        </tr>   
     
    </table>
    
    
    
    
     <table width="100%" height="10" border="0" cellspacing="0" cellpadding="5">
   
        <td align="left" bgcolor="#FFFFFF"><div id='time'>离下次刷新时间还有0秒</div></td>
        </tr>   
     
    </table>
    
    
    
        <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">   
            <tr style="background-color:#3C4D82; color:#FFF">
              <td align="center"><strong>订单号</strong></td>
               <td align="center"><strong>采种名称</strong></td>
              <td align="center"><strong>开奖结果</strong></td>
              <td align="center"><strong>彩票期号</strong></td>
              <td align="center"><strong>投注玩法</strong></td>
              <td align="center"><strong>投注内容</strong></td>
              <td align="center"><strong>投注金额</strong></td>
               <td align="center"><strong>赔率</strong></td>
             <td height="25" align="center"><strong>可赢</strong></td>
        <td height="25" align="center"><strong>返水</strong></td>
        <td align="center"><strong>投注时间</strong></td>
        <td align="center"><strong>投注账号</strong></td>
         <td height="25" align="center"><strong>订单监控</strong></td>
        <td height="25" align="center"><strong>状态</strong></td>
        <td height="25" align="center"><strong>操作</strong></td>
         <td ><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/>
          </td>
        </tr>
<?php
//////////代理查询功能
  
	  $uid	=	'';
	  if($_GET['username']){
	      $sql		=	"select uid from k_user where  username='".$_GET['username']."' limit 1";
		  $query	=	$mysqli->query($sql);
		  if($rows	=	$query->fetch_array()){
		  		$uid=	$rows['uid'];
		  }
	  }
	   $js='0,1';
	  if(isset($_GET["js"])){
		  $js=$_GET["js"];
		  }  
	    $sql	=	"select * from c_bet2 " ;
	    $sql.=" where `js` in (".$js.") and type  in ('北京赛车(PK10)','重庆时时彩' ,'极速六合彩','幸运飞艇') ";
      if($type) $sql.=" and type='".$type."'";
	 if($_GET["uid"]) $uid = $_GET["uid"];
	 if($uid != '') $sql.=" and uid=".$uid;
	 if($topuid!=""){
$sql.=	" and concat(',',parents,',') like '%,".intval($topuid).",%'";
}
	 if($_GET["s_time"]) $sql.=" and addtime>='".$_GET["s_time"]." 00:00:00'";
	 if($_GET["e_time"]) $sql.=" and addtime<='".$_GET["e_time"]." 23:59:59'";
	
	 if($_GET['tf_id']) $sql.=" and win > ".$_GET['tf_id']."";
	  $order = 'id';
	 if($_GET['order']) $order = $_GET['order'];
	 $sql.=" order by $order desc "; 
	  $query	=	$mysqli->query($sql);
	  $sum		=	$mysqli->affected_rows; //总页	  
	  //所有该会员的存款取款记录以及加减款
	 /// echo $sql;
  while($row = $query->fetch_array()){
	
   if($_GET["topuid"]){
        $parentarr=explode(',',$row['parents']);
		$wz1=array_search($row['uid'],$parentarr);
		$wz2=array_search($topuid,$parentarr);
		$wz=$wz1-$wz2;
		//echo json_encode( $parentarr);
		//echo 'topdltype:'.$topdltype."|---dltype:".$dltype."|--fxdltype".$row['fxdltype']."|";
  if($topdltype==0&&$row['fxdltype']==0&&$dltype==0){
	 /// echo $wz1.'---'.$topjs.'|';
	    if($wz<=$topjs){
	           $id .=	$row['id'].',';      
	                   }
                   } else{ 
      $id .=	$row['id'].',';  
		                      }
   }else{
	  $id .=	$row['id'].',';  
	}
	
}


	  if($id){
		     $id		=	rtrim($id,',');
	     $sql	=	"select id from c_bet2  where `id` IN ($id) order by id desc " ;   
		   $query	=	$mysqli->query($sql);
	      $sum	=	$mysqli->affected_rows; //总页
	//  echo $sum;
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
	  
	  }
	  if($bid){
	  	$bid	=	rtrim($bid,',');
	  	$sql	=	"select * from c_bet where id in($bid) order by $order desc";
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
        <td height="25" align="center" valign="middle"><?=$rows['id']?></td>  <td align="center" valign="middle"><?=$rows['type']?></td>
        <td align="center" valign="middle"><?=$rows['jieguo']?></td>
        <td align="center" valign="middle"><?=$rows['qishu']?></td>
        <td align="center" valign="middle"><?=$rows['mingxi_1']?></td>
        <td align="center" valign="middle"><?=$rows['mingxi_2']?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['money'])?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['odds'])?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['win'])?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$rows['fs'])?></td>
        <td><?=$rows['addtime']?></td>
        <td><?=$rows['username']?></td>
         <td>
       <? if($rows["jkzt"]==0){?>
              <span style="color: #FF0000;">正常</span>
              <? }else if($rows["jkzt"]==1){?>
                <span style="color:#006600;">必中</span>
                 <? }else {?>
                      <span style="color:#F1DF12;">必不中</span>
			  <? }?>
              
         
         
   
        
        <td><?php if($rows['js']==0){?><font color="#0000FF">未结算</font><?php }?>
        <?php if($rows['js']==1){?><font color="#FF0000">已结算</font><?php }?></td>
       
        <td><a href="javascript:void(0);" onClick="if(confirm('您确定要撤销该注单？撤销后金额将重算并退回！'))location.href='?action=cancel&id=<?=$rows["id"]?>&type=<?=$type?>&page=<?=$_REQUEST["page"]?>';">撤销</a></td>
         <td align="center"><input name="id[]" type="checkbox" id="id[]" value="<?=$rows["id"]?>" /></td>
        </tr>
<?php
	}
}
?>
	<tr style="background-color:#FFFFFF;">
        <td colspan="16" align="center" valign="middle">本页投注总金额：<?=sprintf("%.2f",$sum_tz)?> 元&nbsp;&nbsp;派彩总金额：<?=sprintf("%.2f",$sum_pc)?> 元&nbsp;&nbsp;赢利总金额：<?=sprintf("%.2f",$sum_tz-$sum_pc)?> 元</td>
	</tr>
	<tr style="background-color:#FFFFFF;">
        <td colspan="16" align="center" valign="middle"><?php echo $pageStr;?></td>
        </tr>
    </table></td>
    </tr>
  </table>
  </form>
</div>
</body>
</html>