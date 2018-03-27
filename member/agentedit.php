<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$xjusername='';
$sql_user	 =	"select * from k_user where uid='$uid' limit 1"; //取汇款前会员余
$query	 =	$mysqli->query($sql_user);
	       $rs	 =	$query->fetch_array();
		   $fandian = $editfandian=sprintf("%.2f", $rs['fandian']);
if($_GET["xjname"]){
$xjname= $_GET["xjname"];
}
if($_GET["xjfandian"]){
$xjfandian= $_GET["xjfandian"];
}
if($_GET["xjuid"]){
$xjuid= $_GET["xjuid"];

$sql_user	 =	"select * from k_user where uid='$xjuid' limit 1"; //取汇款前会员余
$query	 =	$mysqli->query($sql_user);
$rs	 =	$query->fetch_array();
$parents = $rs['parents'];
$top_uid = $rs['top_uid'];
$ylfandian = sprintf("%.2f", $rs['fandian']);
$parentsarr =explode(",",$parents);
//echo $uid; echo $parents;
if(intval($uid) != intval($top_uid)){
	///echo $uid; echo $top_uid;
 ///if(!in_array($uid,$parentsarr)){
 message($xjname.'不是你的下级！', "agent_user.php");
 exit;
	};
if( $_GET["editfandian"]){
	$editfandian=sprintf("%.2f", $_GET["editfandian"]);
	//echo $editfandian.'--'.$fandian;
	if($editfandian>$fandian){
		 message($xjname.'的返点不能高于您的返点！');
           exit;
		}
		if($editfandian<$ylfandian){
		 message($xjname.'的返点不低于之前的返点！');
           exit;
		}
   $sql_user	 =	"update k_user set fandian='$editfandian' where uid='$xjuid' limit 1"; //取汇款前会员余
   $mysqli->query($sql_user) or die ( message($xjname.'修改失败！', "agent_user.php"));
    message($xjname.'返点修改成功！', "agent_user.php");
	  }

}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html class="no-js" lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">




<link rel="stylesheet" href="/newdsn/css/jquery-ui.css">

<link rel="stylesheet" href="/newdsn/css/admin.css">

<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>

</head>


<body id="bodyid" class="">
<?php include_once("agentmenu.php"); ?>
<div class="rightpanel rw" style="
margin-left: 400px;">
		<div class="contentcontainer">
			<div class="maincol">
				<div class="row pagetitle" >
<div class="row pagetitle" style="margin-left: 100px;">
<span class="bluepagetitle" >修改下级返点</span> <br>
</div><div style="font-size: 12px;">     
温馨提示：下级返点不可以超过您本身的返点: <span style="color:red"><?=$fandian?></span>。<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;本次修改的返点不能比下级本身的返点低
</div>
                <div class="row">
                   <form name="form1" method="GET" action="agentedit.php" >
					<div class="col1">下级会员 :</div>
					<div class="col2a">
 <input type="text" name='xjname' id="xjname"  value="<?=$xjname?>" class="textbox2 ml5"   readonly="readonly" > 
 <input type="hidden" name='xjuid' id="xjuid"  value="<?=$xjuid?>" class="textbox2 ml5"   > 

					</div>
				</div>
				<div class="row">
                  
					<div class="col1">下级返点 :</div>
					<div class="col2a">
 <input type="text" name='editfandian' id="editfandian" value="<?=$xjfandian?>" class="textbox2 ml5"> 
					</div>
				</div>
				
				
				<div class="row">
					<div class="col1">&nbsp;</div>
					<div class="col2a">
					
                        <input  class="btnsubmit ml5" type="submit" value="保存"/>
                      
					</div>
				</div>
			</div>
			  <form>
		</div>
	</div>
	



</body>



</html>
