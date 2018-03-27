<?php
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
include_once("../../cache/hlhy.php");

$hl=implode(',',array_keys($hlhy));
//echo json_encode($hl);
if(intval($_GET["action"])!=1)
{
	if (!isset($_GET["s_time"]) || $_GET["s_time"]=="") $_GET["s_time"]=date('Y-m-d',time());
}

session_start();
$suid=$_SESSION["suid"];

$username=	$_GET["username"];
$dlusername=	$_GET["dlusername"];
if($_GET["dlusername"]) {
 $name=$_GET["dlusername"];
 $sql_user	 =	"select * from k_user where username='$name' and concat(',',parents,',') like '%,".intval($suid).",%' limit 1"; //取汇款前会员余额
 $query	 =	$mysqli->query($sql_user);
 $rs	 =	$query->fetch_array();
 $topusername = $rs['username'];
 $topuid=$rs['uid'];

}
       $uid	=	'';
	  if($_GET['username']){
	      $sql		=	"select uid from k_user where username='".$_GET['username']."' and concat(',',parents,',') like '%,".intval($suid).",%' limit 1";
		  $query	=	$mysqli->query($sql);
	      $sum		= $mysqli->affected_rows;
		  if($sum<1){
			  message('没有此会员');
			  
		  }
		  if($rows	=	$query->fetch_array()){
		  		$uid=	$rows['uid'];
		  }
	  }
echo $sql;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
</head>
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script language="JavaScript" src="/js/calendar.js"></script>
<body>
<div id="pageMain">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top">
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
     <form name="form1" method="get" action="allorder.php" onSubmit="return check();">
      <tr>
        <td align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;
            <select name="caizhong" id="caizhong">
            <option value="">全部</option>
            <option value="香港六合彩" <?=$_GET['caizhong']=='香港六合彩' ? 'selected' : ''?>>香港六合彩</option>
            <option value="重庆时时彩" <?=$_GET['caizhong']=='重庆时时彩' ? 'selected' : ''?>>重庆时时彩</option>
            <option value="天津时时彩" <?=$_GET['caizhong']=='天津时时彩' ? 'selected' : ''?>>天津时时彩</option>
             <option value="新疆时时彩" <?=$_GET['caizhong']=='新疆时时彩' ? 'selected' : ''?>>新疆时时彩</option>
               <option value="澳洲两分彩" <?=$_GET['caizhong']=='澳洲两分彩' ? 'selected' : ''?>>澳洲两分彩</option>
               <option value="澳洲分分彩" <?=$_GET['caizhong']=='澳洲分分彩' ? 'selected' : ''?>>澳洲分分彩</option>
            <option value="北京快乐8" <?=$_GET['caizhong']=='北京快乐8' ? 'selected' : ''?>>北京快乐8</option>
            <option value="广东快乐十分" <?=$_GET['caizhong']=='广东快乐十分' ? 'selected' : ''?>>广东快乐十分</option>
            <option value="北京赛车(PK10)" <?=$_GET['caizhong']=='北京赛车(PK10)' ? 'selected' : ''?>>北京赛车(PK10)</option>
                <option value="极速赛车(PK10)" <?=$_GET['caizhong']=='极速赛车(PK10)' ? 'selected' : ''?>>极速赛车(PK10)</option>
            <option value="幸运飞艇" <?=$_GET['caizhong']=='幸运飞艇' ? 'selected' : ''?>>幸运飞艇</option>
            <option value="重庆幸运农场" <?=$_GET['caizhong']=='重庆幸运农场' ? 'selected' : ''?>>重庆幸运农场</option>
            <option value="PC蛋蛋" <?=$_GET['caizhong']=='PC蛋蛋'?'selected' : ''?>>PC蛋蛋</option>
             <option value="极速PC蛋蛋" <?=$_GET['caizhong']=='极速PC蛋蛋'?'selected' : ''?>>极速PC蛋蛋</option>
            <option value="福彩3D" <?=$_GET['caizhong']=='福彩3D' ? 'selected' : ''?>>福彩3D</option>
            <option value="体彩排列三" <?=$_GET['caizhong']=='体彩排列三' ? 'selected' : ''?>>体彩排列三</option>
       <option value="澳洲六合彩" <?=$_GET['caizhong']=='澳洲六合彩' ? 'selected' : ''?>>澳洲六合彩</option>
                  <option value="加拿大28" <?=$_GET['caizhong']=='加拿大28' ? 'selected' : ''?>>加拿大28</option>
          </select>
          &nbsp;&nbsp;会员：<input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="15">
         
				&nbsp;代理名称：
				<input name="dlusername" type="text" id="dlusername" value="<?=$dlusername?>" size="10" maxlength="10"/>
			
            &nbsp;&nbsp;日期：
            <input name="s_time" type="text" id="s_time" value="<?=$_GET['s_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
            ~
            <input name="e_time" type="text" id="e_time" value="<?=$_GET['e_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />&nbsp;&nbsp;
            <input name="action" id="action" type="hidden" value="1">
			<input type="submit" name="Submit" value="搜索"></td>
        </tr>   
      </form>
    </table>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">   
            <tr style="background-color:#3C4D82; color:#FFF">
              <td align="center" rowspan="2"><strong>账号</strong></td>
              <td align="center" rowspan="2"><strong>彩种</strong></td>
              <td align="center" colspan="4"><strong>已结算</strong></td>
              <td height="25" align="center" colspan="3"><strong>未结算</strong></td>
              <td align="center" colspan="2"><strong>合计(已结算+未结算)</strong></td>
        </tr>
        <tr style="background-color:#3C4D82; color:#FFF">
              <td align="center"><strong>注单数</strong></td>
              <td align="center"><strong>下注</strong></td>
              <td align="center"><strong>中奖</strong></td>
              <td align="center"><strong>盈亏</strong></td>
              <td align="center"><strong>注单数</strong></td>
              <td align="center"><strong>下注</strong></td>
              <td height="25" align="center"><strong>可赢</strong></td>
              <td align="center"><strong>注单数</strong></td>
              <td align="center"><strong>下注</strong></td>
        </tr>
      <?php
	
     $e_time	=	date("Y-m-d H:i:s",strtotime($e_time)+0);
	 	
	 $s_time	=	date("Y-m-d H:i:s",strtotime($s_time)+0);
	 $where="where `addtime`>='$s_time' and `addtime`<='$e_time'";
	if($_GET["username"]){
		$where	.=	" and uid='$uid'";
		}
		if($_GET["caizhong"]){
			$caizhong =$_GET["caizhong"];
		$where	.=	" and type='$caizhong'";
		}
	if($_GET["dlusername"]){
			$where	.=	" and concat(',',parents,',') like '%,".intval($topuid).",%'";
			}else{
		
		$where	.=	" and concat(',',parents,',') like '%,".intval($suid).",%'";
		
	}	
					
	 
///echo $id;
//exit;
      ?>
   <?php
			//////////////代理查询//////////i
		
			
			 // echo 'id'.$id;
			///$sql1="SELECT uid,m_make_time,username,money,is_daili,dltype,fandian,fdjishu,parents,top_uid,fxdltype,Sum(m_value) AS money2,type FROM k_money2  WHERE  `m_id` IN ($m_id)  GROUP BY uid,type ";	
	
	
	$sql1 =	"select uid,username,type,sum(if(js='1',summoney,0 )) AS jiesuan,
sum(if(js='0',summoney,0 )) AS wjiesuan,
sum(if(js='1',sumwin,0 )) AS shuyin,
sum(if(js='1',sumshu,0 )) AS shuyin2,
sum(if(js='0',sumwin,0 )) AS keyin,
sum(if(js='1',count,0 )) AS jscount,
sum(if(js='0',count,0 )) AS wjscount
from (SELECT *,
sum(money) as  summoney,
sum(if(win>0,win,0 )) AS sumwin,
sum(if(win>0,win-money,win )) AS sumshu,
count(id) as count
FROM
c_bet2 ".$where." and guest=0 
GROUP BY uid,js,type ) as tempa  GROUP BY uid,type";

	
    $query	=	$mysqli->query($sql1);
    $sum		=	$mysqli->affected_rows; //总页数
    $sum_jszhudan=0;
	$sum_jsjine=0;
	$sum_jsjieguo=0;
	$sum_jsyk=0;
	$sum_wjszhudan=0;
	$sum_wjsjine=0;
	$sum_wjsky=0;
	$sum_count =0;
	$sum_jine=0;
	$userarr=array();
	$listarr=array();
while($row=$query->fetch_array()){
		$listarr[]=$row;
    $sum_t3_value	+=	$row["t3_value"];
	$sum_jszhudan  +=	$row["jscount"];
	$sum_jsjine  +=	$row["jiesuan"];
	$sum_jsjieguo  +=	$row["shuyin"];
	$sum_jsyk  +=	$row["shuyin2"];
	$sum_wjszhudan  +=	$row["wjscount"];
	$sum_wjsjine  +=	$row["wjiesuan"];
	$sum_wjsky  +=	$row["keyin"];
	$sum_coun = $sum_jszhudan+$sum_wjszhudan;
	$sum_jine=$sum_jsjine+$sum_wjsjine ;
    $userstr .= $row["username"].',';
		}
		
		$userarr=array_unique(explode(',',$userstr));
		$userstr=implode(',',$userarr);
		$userstr		=	rtrim($userstr,',');
		$userarr=explode(',',$userstr);


 ?>
 
 
 	<?php 
	// foreach ($userarr as $user){ 
      //echo "This Site url is $user! <br />"; 

	  for($k=0;$k<count($userarr);$k++){  
	 $sumcz_jszhudan=0;
	$sumcz_jsjine=0;
	$sumcz_jsjieguo=0;
	$sumcz_jsyk=0;
	$sumcz_wjszhudan=0;
	$sumcz_wjsjine=0;
	$sumcz_wjsky=0;
	$sumcz_count =0;
	$sumcz_jine=0;
	  for($i=0;$i<count($listarr);$i++){
		  if($userarr[$k]==$listarr[$i]['username']){
	$sumcz_t3_value	+=	$listarr[$i]["t3_value"];
	$sumcz_jszhudan  +=	$listarr[$i]["jscount"];
	$sumcz_jsjine  +=	$listarr[$i]["jiesuan"];
	$sumcz_jsjieguo  +=	$listarr[$i]["shuyin"];
	$sumcz_jsyk +=	$listarr[$i]["shuyin2"];
	$sumcz_wjszhudan  +=	$listarr[$i]["wjscount"];
	$sumcz_wjsjine  +=	$listarr[$i]["wjiesuan"];
	$sumcz_wjsky  +=	$listarr[$i]["keyin"];
	$sumcz_count = $sumcz_jszhudan+$sumcz_wjszhudan;
	$sumcz_jine=$sumcz_jsjine+$sumcz_wjsjine ;
?>

      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" style="line-height: 20px; background-color: rgb(255, 255, 255);">
        <td height="25" align="center" valign="middle"><?=$listarr[$i]['username']?></td>
        <td align="center" valign="middle"><?=$listarr[$i]['type']?></td>
        <td align="center" valign="middle"><?=$listarr[$i]['jscount']?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$listarr[$i]['jiesuan'])?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$listarr[$i]['shuyin'])?></td>
        <td align="center" valign="middle"><span style="color:<?=$rows['shuyin2']>0 ? '#FF0000' : '#009900'?>;"><?=sprintf("%.2f",$listarr[$i]['shuyin2'])?></span></td>
        <td align="center" valign="middle"><?=$listarr[$i]['wjscount']?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$listarr[$i]['wjiesuan'])?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$listarr[$i]['keyin'])?></td>
        <td align="center" valign="middle"><?=$listarr[$i]['jscount']+$listarr[$i]['wjscount']?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$listarr[$i]['jiesuan']+$listarr[$i]['wjiesuan'])?></td>
        </tr>
 <?php } }?>
      <tr align="center" style="background-color:#D9E7F4; line-height:20px;">
        <td height="25" align="center" valign="middle"><?=$username?></td>
        <td align="center" valign="middle">合计</td>
        <td align="center" valign="middle"><?=$sumcz_jszhudan?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$sumcz_jsjine)?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$sumcz_jsjieguo)?></td>
        <td align="center" valign="middle"><span style="color:<?=$sumcz_jsyk>0 ? '#FF0000' : '#009900'?>;"><?=sprintf("%.2f",$sumcz_jsyk)?></span></td>
        <td align="center" valign="middle"><?=$sumcz_wjszhudan?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$sumcz_wjsjine)?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$sumcz_wjsky)?></td>
        <td align="center" valign="middle"><?=$sumcz_count?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$sumcz_jine)?></td>
        </tr>
   <?php } ?>
      <tr align="center" style="background-color:#ffffff; line-height:20px; font-weight: bold;">
        <td height="25" align="center" valign="middle" colspan="2">总合计</td>
        <td align="center" valign="middle"><?=$sum_jszhudan?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$sum_jsjine)?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$sum_jsjieguo)?></td>
        <td align="center" valign="middle"><span style="color:<?=$sum_jsyk>0 ? '#FF0000' : '#009900'?>;"><?=sprintf("%.2f",$sum_jsyk)?></span></td>
        <td align="center" valign="middle"><?=$sum_wjszhudan?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$sum_wjsjine)?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$sum_wjsky)?></td>
        <td align="center" valign="middle"><?=$sum_count?></td>
        <td align="center" valign="middle"><?=sprintf("%.2f",$sum_jine)?></td>
        </tr>
         
    </table></td>
    </tr>

  </table>
    <?php  ?>
</div>
</body>
</html>