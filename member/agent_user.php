<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);

$sub = 2;

if(!user::is_daili($uid)) {
    message('你还不是代理，请先申请！', "agent_reg.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="/newdsn/css/table.css" />
<link rel="stylesheet" href="/newdsn/css/admin.css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/default/js/skin.js"></script>
<script type="text/javascript" src="images/member.js"></script>
<script language="JavaScript" src="/js/calendar.js"></script>
</head>
<body class="skin_blue">
<?php include_once("agentmenu.php"); ?>
<div class="main report">
<div class="search">
 <form name="form1" method="GET" action="agent_user.php" > 
           <tr>
              
     
                   <td colspan="12">
           
                        &nbsp;&nbsp;类型：
            <select name="selecttype" id="selecttype">
            <option value="myxj" <?php if(@$_GET["selecttype"]=='myxj') {?> selected <?php }?> >直属下线</option>
            <option value="allxj" <?php if(@$_GET["selecttype"]=='allxj') {?> selected <?php }?> >所有下线</option>
            
        

            </select>
            &nbsp;
          <input type="submit" value="查找"/>
                    </td>
             
     
           </tr>
              </form>

</div> 
<table class="list table">

<thead><tr>
<th>登陆名</th>
<th>会员姓名</th>
<th>下级返点</th>
<th>注册时间</th>
<th>最近登陆</th>
<th>当前余额</th>
<th>在线</th>
<th>状态</th>
<th>下线级别</th>
<th>下级</th>
</tr></thead>
<tbody>
   <?php
			//////////////
			if(isset($_GET["top_uid"])) {
 $sql_user	 =	"select * from k_user where uid=".$_GET["top_uid"]." limit 1"; //取汇款前会员余额
 $query	 =	$mysqli->query($sql_user);
 $rs	 =	$query->fetch_array();
 $topjs = $rs['fdjishu'];
 $topusername = $rs['username'];
 $topdltype=$rs['fxdltype'];
 $dltype=$rs['dltype'];
 $topuid=$rs['uid'];
}

			///////////////
			
			
			
		   $sql_user	 =	"select * from k_user where uid=$uid limit 1"; //取汇款前会员余额
	       $query	 =	$mysqli->query($sql_user);
	       $rs	 =	$query->fetch_array();
		   $xtjs = $rs['fdjishu'];
		   $fxdltype=$rs['fxdltype'];
		   $dltype =$rs['dltype'];
		 
		///  echo  'fxdltype'. $fxdltype. 'dltype'. $dltype;
			$xjuid ='';		
			$a=$_GET['selecttype'];
			$jishu=1;
			if($_GET['js']){
				$jishu=$_GET['js']+1;
				}
				
			if($_GET['uid']){
				$xjuid= $_GET['uid'];
				}else{
						$xjuid= $uid;
					
					}
			
            $sql	=	"select * from k_user where";
			
			if($a=='allxj'){
				$sql.=" concat(',',parents,',') like '%,$uid,%' and uid!=$xjuid";
				}
				else{
			$sql.=" top_uid=$xjuid";
				}
		//	echo $sql ;
			////$sql.=" concat(',',parents,',') like '%,$uid,%' and uid!=$uid";////// 所有下线
			//echo $a;
            $query	=	$mysqli->query($sql);
            $sum	=	$mysqli->affected_rows; //总页数
        /*    $thisPage	=	1;
            if(@$_GET['page']){
                $thisPage	=	$_GET['page'];
            }
            $page		=	new newPage();
            $perpage	= 	15;
            $thisPage	=	$page->check_Page($thisPage,$sum,$perpage);
            $id		=	'';
            $i		=	1; //记录 uid 数
            $start	=	($thisPage-1)*$perpage+1;
            $end	=	$thisPage*$perpage;*/
            while($row = $query->fetch_array()){
		   $parentarr=explode(',',$row['parents']);
		   $wz1=array_search($row['uid'],$parentarr);
		   $wz2=array_search($uid,$parentarr);
		   $wz=$wz1-$wz2;
		///  echo $wz1."|";
		   // echo $wz2."--";
	if($dltype==0&&$fxdltype==0){
	    if($wz<=$xtjs){
	       $id .=	$row['uid'].',';      
	                   }
         } else{
	 
   $id .=	$row['uid'].',';  
		       }

			}
?>
 <?php
    if($id) {
                $id		=	rtrim($id,',');
                $sql	=	"select u.*,l.is_login from k_user u left outer join k_user_login l on u.uid=l.uid where u.uid in($id) order by u.uid desc";
              //  echo $sql;
				$query	=	$mysqli->query($sql);
                $sum_money	=	0;
                $sum_sxf	=	0;
                while($rows = $query->fetch_array()) {
                    ?>
                     <?php 
					
					//echo json_encode($parentarr);
					  $parentarr=explode(',',$rows['parents']);
		             $wz1=array_search($rows['uid'],$parentarr);
		             $wz2=array_search($uid,$parentarr);
		             $jishu=$wz1-$wz2;
					///$jishu = array_keys($parr,$uid,true) ;
					///$jishu=count($parr)-1;
					$jishu=$wz1-$wz2;
					 if($fxdltype==0&&$dltype==0&&$jishu<=$xtjs){ 
						 ?>  
                       
                    <tr class="list">
                        <td><?=$rows["username"]?></td>
                        <td><?=$rows["pay_name"]?></td>
                        <td><?=$rows["fandian"]?>%
                        <? if($rows["top_uid"]==$uid&&$rows["dltype"]==1){?>
                        <a href="agentedit.php?xjuid=<?=$rows['uid']?>&xjname=<?=$rows['username']?>&xjfandian=<?=$rows['fandian']?>">修改</a>
                        <? } ?>
                        </td>
                        <td><?=date("Y-m-d H:i:s",strtotime($rows["reg_date"]))?></td>
                        <td><?=date("Y-m-d H:i:s",strtotime($rows["login_time"]))?></td>
                        <td><?=sprintf("%.2f",$rows["money"])?></td>
                        <td><?=$rows["is_login"]==1?"<span class='c_red'>在线</span>":"离线"?></td>
                        <td><?=$rows["is_stop"]==0?"<span class='c_red'>启用</span>":"停用"?></td>
                         <td><?=$jishu?>级下线</td>      
                     <?php if($fxdltype==0&&$dltype==0){ 
					 if($jishu<$xtjs){ ?>  <td><a href="agent_user.php?uid=<?=$rows["uid"]?>&js=<?=$jishu?>">查看下级</a></td>
                  <?php }else { ?> <td></td>  <?php }
				  } ?> 
                    </tr>
                    <?php }  
					
					
					else { ?>
                
              
                 <tr class="list">
                        <td><?=$rows["username"]?></td>
                        <td><?=$rows["pay_name"]?></td>
                         <td><?=$rows["fandian"]?>%
                        <? if($rows["top_uid"]==$uid&&$rows["dltype"]==1){?>
                        <a href="agentedit.php?xjuid=<?=$rows['uid']?>&xjname=<?=$rows['username']?>&xjfandian=<?=$rows['fandian']?>">修改</a>
                        <? } ?>
                        </td>
                        <td><?=date("Y-m-d H:i:s",strtotime($rows["reg_date"]))?></td>
                        <td><?=date("Y-m-d H:i:s",strtotime($rows["login_time"]))?></td>
                        <td><?=sprintf("%.2f",$rows["money"])?></td>
                        <td><?=$rows["is_login"]==1?"<span class='c_red'>在线</span>":"离线"?></td>
                        <td><?=$rows["is_stop"]==0?"<span class='c_red'>启用</span>":"停用"?></td>
                         <td><?=$jishu?>级下线</td>      
                  
                          <td><a href="agent_user.php?uid=<?=$rows["uid"]?>&js=<?=$jishu?>">查看下级</a></td>
               
                    </tr>
                  
                      <?php } ?>
             
                     <?php } ?>
                     
                     
                    <?php } else { ?>
             <tr><td>暂无下级会员</td></tr>
                  <?php } ?>
			
			
    
</tbody>
<tfoot>
<tr><td></td><td></td><th>下级会员总数</th><td><?=$sum?> </td><td></td><td></td><td></td><td></td><td class="result color"></td><td></td></tr>
</tfoot>
</table>
<?=$page->get_htmlPage('agent_user.php?');?>
<div class="page_info">
</div>
</div>
<p>&nbsp;</p>
</body>
</html>