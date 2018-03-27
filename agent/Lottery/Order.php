<?php
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
include("../../include/pager.class.php");
$C_Patch=$_SERVER['DOCUMENT_ROOT'];
@include_once($C_Patch."/cache/website.php");	

$type=$_GET['type'];
$type=='' ? $se1 = '#FF0' : $se1 = '#FFF';
$topuid=$_SESSION["suid"];
if($_GET["topuid"]) {
 $name=$_GET["topuid"];
 $sql_user	 =	"select * from k_user where username='$name' limit 1"; //取汇款前会员余额
 $query	 =	$mysqli->query($sql_user);
 $sum		=	$mysqli->affected_rows; //总页	
if($sum>0){
 $rs	 =	$query->fetch_array();
 $topusername = $rs['username'];
 $topuid=$rs['uid'];
$topparentsarr=explode(',',$rs['parents']);
if($_SESSION["suid"] != $topparentsarr[0]){	
	message('不是你的下级');
	exit;
	}
}else{
	message('无此代理或会员');	
	exit;
}
}

if($_GET["username"]) {
 $username=$_GET["username"];
 $sql_user	 =	"select * from k_user where username='$username' limit 1"; //取汇款前会员余额
 $query	 =	$mysqli->query($sql_user);
 $sum		=	$mysqli->affected_rows; //总页	
if($sum>0){
 $rs	 =	$query->fetch_array();
 $topparentsarr=explode(',',$rs['parents']);
if($_SESSION["suid"] != $topparentsarr[0]){	
	message('不是你的下级');
	exit;
	}
}else{
	message('无此代理或会员');	
	exit;
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
           
       </td>
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
      
        <td align="center"><strong>投注时间</strong></td>
        <td align="center"><strong>投注账号</strong></td>

        <td height="25" align="center"><strong>状态</strong></td>


          </td>
        </tr>
<?php
//////////代理查询功能
  
	  $uid	=	'';
	  if($_GET['username']){
	      $sql		=	"select uid from k_user where username='".$_GET['username']."' limit 1";
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
	    $sql.=" where `js` in (".$js.")";
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
	//  echo $sql;
  while($row = $query->fetch_array()){

	 $id .=	$row['id'].',';  
}


	  if($id){
		     $id		=	rtrim($id,',');
	     $sql	=	"select id from c_bet2  where `id` IN ($id) and guest=0 order by id desc " ;   
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
        <td><?=$rows['addtime']?></td>
        <td><?=$rows['username']?></td>      
        <td><?php if($rows['js']==0){?><font color="#0000FF">未结算</font><?php }?>
        <?php if($rows['js']==1){?><font color="#FF0000">已结算</font><?php }?></td>
       
       

        </tr>
<?php
	}
}
?>
	<tr style="background-color:#FFFFFF;">
        <td colspan="15" align="center" valign="middle">本页投注总金额：<?=sprintf("%.2f",$sum_tz)?> 元&nbsp;&nbsp;派彩总金额：<?=sprintf("%.2f",$sum_pc)?> 元&nbsp;&nbsp;赢利总金额：<?=sprintf("%.2f",$sum_tz-$sum_pc)?> 元</td>
	</tr>
	<tr style="background-color:#FFFFFF;">
        <td colspan="15" align="center" valign="middle"><?php echo $pageStr;?></td>
        </tr>
    </table></td>
    </tr>
  </table>

</div>
</body>
</html>