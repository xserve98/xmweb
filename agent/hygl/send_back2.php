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
        <?=$username?>回水
		</td>
        </tr>   
    </table>
     
   
      
                    <table border="0"align="center" cellspacing="1" cellpadding="2" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                 
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>彩种</strong></td>
                          <td align="center"><strong>回水</strong></td>     
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
						
							    
							   <sapn class="pankou">B盘:</span>
							   <input class="input1" maxlength="6" size="4" value="<?=$list[$i]['k_b_limit']?>"  name="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_b_limit" id="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_b_limit" />
						
							   <sapn class="pankou">C盘:</span>
							    <input class="input1" maxlength="6" size="4" value="<?=$list[$i]['k_c_limit']?>" name="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_c_limit" id="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_c_limit" />
							   
							   </td> 							   
                            </tr>
                          </table></td>  
    <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>        
                               <td align="center">
							   <sapn class="pankou">最低:</span>
							   <input class="input1" maxlength="6" size="4" value="<?=$list[$i]['k_d_limit']?>" name="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_d_limit" id="<?=$list[$i]['k_type']?>_d_limit" />
							
							   <sapn class="pankou">最高</span>
							   <input class="input1" maxlength="6" size="4" value="<?=$list[$i]['k_e_limit']?>" name="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_e_limit" id="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_e_limit" />
							   <input class="input1"  type="hidden" maxlength="6" size="4" value="<?=$list[$i]['k_wftype']?>" name="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_wftype" id="<?=$list[$i]['k_type']?>_<?=$list[$i]['k_wftype']?>_wftype" />
							  
							   </td>  							   
                            </tr>
                          </table></td> 


						  
                        </tr>

	  <? }?>
                    
                </table>
			</td>
    </tr>
  </table>
</div>

</body>
</html>