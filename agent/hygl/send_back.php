<?php
header('Content-Type:text/html; charset=utf-8');
include_once("../common/login_check.php");
///check_quanxian("xtgl");
include("../../include/mysqli.php");
$save=$_GET["save"];
$uid=$_REQUEST["uid"];
$username=$_REQUEST["username"];
session_start();
$suid=$_SESSION["suid"];
$sql="select top_uid from k_user where uid='$uid'";

$query	=$mysqli->query($sql);
$rs = $query->fetch_array();	


if($rs['top_uid'] != $suid ){
	message('只允许修改直属下级的返水');
	exit ;
	
	
}



if($save=='ok'){
	
	$arr =array(0,1,2,3,4,7,8,9,10,11,12,13,14,20,21,22,24,26);
$uid=$_REQUEST["uid"];
$username=$_REQUEST["username"];
$url='send_back.php?uid='.$uid.'&username='.$username;
	foreach ($arr as $value) {
		
		
		
		
		
		if($value==0||$value==22){
	
			for($i=1;$i<10;$i++){
				
			$sql="select * from k_send_back where uid='$suid' and k_type=".$value."  and k_wftype=".$i;"";	
			$query	=$mysqli->query($sql);
            $rows = $query->fetch_array();	
				
				
    $k_a_limit=$_POST[$value."_".$i.'_a_limit'];
	 $k_b_limit=$_POST[$value."_".$i.'_b_limit'];
	  $k_c_limit=$_POST[$value."_".$i.'_c_limit'];
	   $k_d_limit=$_POST[$value."_".$i.'_d_limit'];
	    $k_e_limit=$_POST[$value."_".$i.'_e_limit'];
				
			if($k_a_limit>$rows['k_a_limit']||$k_b_limit>$rows['k_b_limit']||$k_c_limit>$rows['k_c_limit']||$k_e_limit>$rows['k_e_limit']||$k_a_limit<0||$k_b_limit<0|$k_c_limit<0||$k_d_limit<0|$k_e_limit<0){
				$typename=$rows['k_typename'].'超出可设置范围';
			
				echo "<script>alert('$typename');window.location.href='$url';</script>";
				exit ;
			}	
				
				
				
				
		$sql="update k_send_back set k_a_limit='".$k_a_limit."',k_b_limit='".$k_b_limit."',k_c_limit='".$k_c_limit."',k_d_limit='".$k_d_limit."',k_e_limit='".$k_e_limit."' where k_type=".$value." and uid=". $uid." and k_wftype=".$i;
	///	echo $sql;
		$mysqli->query($sql);
				
			}
			}else{
			
	  $k_a_limit=$_POST[$value.'_0_a_limit'];
	  $k_b_limit=$_POST[$value.'_0_b_limit'];
	  $k_c_limit=$_POST[$value.'_0_c_limit'];
	  $k_d_limit=$_POST[$value.'_0_d_limit'];
	  $k_e_limit=$_POST[$value.'_0_e_limit'];
			$sql="select * from k_send_back where uid='$suid' and k_type=".$value." ";	
			$query	=$mysqli->query($sql);
            $rows = $query->fetch_array();	
				if($k_a_limit>$rows['k_a_limit']||$k_b_limit>$rows['k_b_limit']||$k_c_limit>$rows['k_c_limit']||$k_e_limit>$rows['k_e_limit']||$k_a_limit<0||$k_b_limit<0|$k_c_limit<0||$k_d_limit<0|$k_e_limit<0){
				
				$typename=$rows['k_typename'].'超出可设置范围';
				echo "<script>alert('$typename');window.location.href='$url';</script>";
				exit ;
			}	
				
		
			
	  $sql="update k_send_back set k_a_limit='".$k_a_limit."',k_b_limit='".$k_b_limit."',k_c_limit='".$k_c_limit."',k_d_limit='".$k_d_limit."',k_e_limit='".$k_e_limit."' where k_type=".$value." and uid=". $uid;

		$mysqli->query($sql);
			
			
		}

}
	/*for($i=1;$i<=$nums;$i++)
	{
		$kaipan=$_POST['kaipan_'.$i];
		$fengpan=$_POST['fengpan_'.$i];
		$kaijiang=$_POST['kaijiang_'.$i];
		
	}
	
	
	
*/
	
	
	
	echo "<script>alert('设置成功');window.location.href='$url';</script>";
	
	//message('设置成功','send_back.php?uid='.$uid.'&username='.$username);
}
?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
</head>
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script>
	var kj=0;
	function inputkj(){  
	kj=$('#kuaijie').val();
		alert('快捷输入设置成功');
 }
	
	$(document).ready(function(){
	$("input").click(function(){
    $(this).val(kj);

	});
		
	});

</script>

<body>
<div id="pageMain">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top">
  
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
      <tr>
        <td align="center" bgcolor="#3C4D82" style="color:#FFF">
        <?=$username?>回水设置
		</td>
        </tr>   
    </table>
     
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
      <tr>
        <td align="center" >
       快捷设置： <input maxlength="6" size="4" value=""  name="kuaijie" id="kuaijie"  />
			<button id='kjsz' name='kjsz'   onclick="inputkj()">确认</button>
		</td>
        </tr>   
    </table>
      
                    <table border="0"align="center" cellspacing="1" cellpadding="2" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>彩种</strong></td>
                          <td align="center"><strong>回水设置</strong></td>     
 <td align="center"><strong>下注限额</strong></td>  						  
                        </tr>
					 <?php
	$list=array();$sjlist=array();
     $sql = "select * from k_send_back where uid='$uid'  ORDER BY `k_type` ASC, `k_wftype` ASC ";
	  //echo $sql;
	  $query	=	$mysqli->query($sql);
 
      while ($rows = $query->fetch_array()) {	
		$list[]=$rows;  
	  }
			
		$sql2 = "select * from k_send_back where uid='$suid' ORDER BY `k_type` ASC, `k_wftype` ASC ";

	  $query2	=	$mysqli->query($sql2);
 
      while ($rows2 = $query2->fetch_array()) {	
		$sjlist[]=$rows2;  
	  }
			
			
			for($i=0;$i<count($list);$i++){
				
				
				
		
			
?>	  
						
						
						
						
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><?=$list[$i]['k_typename']?></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                               <td align="center">
							   <sapn class="pankou">A盘:</span>
							   <input class="input1" maxlength="6" size="4" value="<?=$list[$i]['k_a_limit']?>" name="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_a_limit" id="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_a_limit" />
							    <i style="color:red"><<?=$sjlist[$i]['k_a_limit']?>></i>
							    
							   <sapn class="pankou">B盘:</span>
							   <input class="input1" maxlength="6" size="4" value="<?=$list[$i]['k_b_limit']?>"  name="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_b_limit" id="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_b_limit" />
							   <i style="color:red"><<?=$sjlist[$i]['k_b_limit']?>></i>
							   <sapn class="pankou">C盘:</span>
							    <input class="input1" maxlength="6" size="4" value="<?=$list[$i]['k_c_limit']?>" name="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_c_limit" id="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_c_limit" />
							     <i style="color:red"><<?=$sjlist[$i]['k_c_limit']?>></i>
							   </td> 							   
                            </tr>
                          </table></td>  
    <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>        
                               <td align="center">
							   <sapn class="pankou">最低:</span>
							   <input class="input1" maxlength="6" size="4" value="<?=$list[$i]['k_d_limit']?>" name="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_d_limit" id="<?=$list[$i]['k_type']?>_d_limit" />
							   <i style="color:red"><<?=$sjlist[$i]['k_d_limit']?>></i>
							   <sapn class="pankou">最高</span>
							   <input class="input1" maxlength="6" size="4" value="<?=$list[$i]['k_e_limit']?>" name="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_e_limit" id="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_e_limit" />
							   <input class="input1"  type="hidden" maxlength="6" size="4" value="<?=$list[$i]['k_wftype']?>" name="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_wftype" id="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_wftype" />
							     <i style="color:red"><<?=$sjlist[$i]['k_e_limit']?>></i>
							   </td>  							   
                            </tr>
                          </table></td> 


						  
                        </tr>

	  <? }?>
                       
                        <tr>
                         <input class="input1"  type="hidden" maxlength="6" size="4" value="<?=$username?>" name="username" id="username" />
                          <input class="input1"  type="hidden" maxlength="6" size="4" value="<?=$uid?>" name="uid" id="uid" />
                    
                          <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" />
                         <input type="button" class="submit80" name="Submit" value="返回上一页" onclick="javascript:history.back(-1);">*设置下级回水不能超出您本身的上限</td>
                        </tr></form>
                </table>
			</td>
    </tr>
  </table>
</div>

</body>
</html>