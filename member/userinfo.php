<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$sqla="select * from k_user where uid = '$uid'  limit 1";
$query	 =	$mysqli->query($sqla);
$rs	 =	$query->fetch_array();
$zjpwd=$rs['qk_pwd'];
$zjpassword='';
if($_GET["zjpassword"]){
$zjpassword= $_GET["zjpassword"];
}	
$newmobile='';

if($_GET["newmobile"]){
$newmobile= $_GET["newmobile"];

	if($zjpwd==''){
		  message($rs['username'].'您还未设置取款密码！', "userinfo.php");
		  exit;
		}
			
		if($zjpwd != md5($zjpassword)){
			  message($rs['username'].'您输入的取款密码不对', "userinfo.php");
		       exit;
	
			}
				
		
	$sql_user	 =	"update k_user set mobile='$newmobile' where uid='$uid' limit 1"; //取汇款前会员余   
    $mysqli->query($sql_user) or die ( message('修改失败！', "userinfo.php"));
	
    message('修改成功！', "userinfo.php");
		
	
}
if($_GET["newwechat"]){
$newwechat= $_GET["newwechat"];

	if($zjpwd==''){
		  message($rs['username'].'您还未设置取款密码！', "userinfo.php");
		  exit;
		}
			
		if($zjpwd != md5($zjpassword)){
			  message($rs['username'].'您输入的取款密码不对', "userinfo.php");
		       exit;
	
			}
				
		
	$sql_user	 =	"update k_user set email='$newwechat' where uid='$uid' limit 1"; //取汇款前会员余   
    $mysqli->query($sql_user) or die ( message('修改失败！', "userinfo.php"));
	///echo $sql_user;
    message('修改成功！', "userinfo.php");
		
	
}

?>
<html class="no-js" lang=""><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/newdsn/css/jquery-ui.css">
<link rel="stylesheet" href="/newdsn/css/cash/popup.css">
<link rel="stylesheet" href="/newdsn/css/admin.css">
<link rel="stylesheet" href="/newdsn/css/stepitm.css">
<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="/js/laydate/laydate.min.js"></script>
<link type="text/css" rel="stylesheet" href="/js/laydate/need/laydate.css">
<link type="text/css" rel="stylesheet" href="/js/laydate/skins/default/laydate.css" id="LayDateSkin">
<script type="text/javascript" src="/newdsn/js/cash/admin_content.js"></script>
<script type="text/javascript" src="/js/dialog.js"></script>
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/common.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/index.js"></script>
<script type="text/javascript" src="/newdsn/js/cash/home.js"></script>
   <script type="text/javascript">

        if (self == top) {
          top.location = '/main.php';
        }
        var islg = <?= $uid ? 1 : 0 ?>;
    </script>
</head>
<body id="bodyid" class="skin_blue">


<?php include_once("usermenu.php"); ?>
<!--主内容开始-->
<div class="rightpanel rw">
		<div class="contentcontainer">
			<div class="maincol innerline">
				<div class="row pagetitle">
					<span class="bluepagetitle">个人资料</span>  绑定真实姓名可提高帐号的安全性 
				</div>
				<div class="row">
					<div class="col1">姓名 :</div>
					<div class="col2a">
 <?php if($rs['pay_name']){?>

   <input type="text" id="userName" class="textbox2 ml5" value="<?=$rs['pay_name']?>" readonly>
 <?php  }else{?>
 <input type="text" id="userName" class="textbox2 ml5"  >
  <?php  } ?>
					</div>
				</div>
				<div class="row">
					<div class="col1">性别 :</div>
					<div class="col2a">
 <select name="sex" id="sex" class="ml5">
      <?php if($rs['sex']==0){ ?>
							<option selected="selected" value="0">女</option>
							<option value="1">男</option>
                            <?php }else{?>
                            <option selected="selected" value="1">男</option>
							<option value="0">女</option>
                            <? } ?>
						</select> 
					</div>
				</div>
				<div class="row">
					<div class="col1">出生年月 :</div>
					<div class="col2a">
						<div class="textcontainer">
                        
                        <?php if($rs['birthday']){?>
    <input type="text" id="birthDay" class="textbox2 laydate-icon ml5" value="<?=$rs['birthday']?>" onClick="laydate()" readonly>
   
 <?php  }else{?>
   <input type="text" id="birthDay" class="textbox2 laydate-icon ml5" value="" onClick="laydate()" >
  <?php  } ?> 
		</div>
					</div>
				</div>
				<div class="row">
					<div class="col1">&nbsp;</div>
					<div class="col2a">
						<button class="btnsubmit ml5" type="submit" onClick="bandName()">保存</button>
					</div>
				</div>
			</div>
			<div class="maincol">
	
				<div class="row pagetitle">
					<span class="bluepagetitle">安全设置</span> 绑定多种帐号，增强安全保障。
				</div>
				<div class="row" id="row-item">
				
					<div class="maincol bind">
						<div class="moneybtn" id="editmobile">
							<div class="mt2 ml55">
								<img src="/newdsn/images/simcardicon.jpg" width="23" height="17" alt="">
							</div>
							<div>修改手机号</div>
							<div class="iconmoney"></div>
						</div>
					</div>
					
					<div class="maincol bind">
						<div class="moneybtn" id="editwechat">
							<div class="mt2 ml55">
								<img src="/newdsn/images/wechat.png" width="23" height="17" alt="">
							</div>
							<div>修改微信号</div>
							<div class="iconmoney"></div>
						</div>
					</div>					
					
				</div>
				<div id="row-info">温馨提示：没有绑定手机或邮箱的会员请及时完善资料，否则会影响修改银行卡和姓名或其他资料。</div>
			</div>
		</div>
	</div>
<!--主内容结束-->

<!--修改手机-->
	<div id="popup-verifyeditmobile" style="display: none">
		<div class="popupinternal">
			<div class="steps">
				<div class="row clearfix mt30 ml33">
					<div class="stepitm" style="z-index: 3;">
						<div class="stepnotxt">输入手机号码</div>
						<div class="hlfcircle"></div>
					</div>
					<div class="stepitm stepactive" style="z-index: 2;">
						<div class="stepnotxt">验证取款密码</div>
						<div class="hlfcircle hlfcircleactive"></div>
					</div>
					<div class="stepitm" style="z-index: 1;">
						<div class="stepnotxt">完成</div>
					</div>
				</div>
				<table class="table">
					<tbody>
                        <form name="form1" method="GET" action="userinfo.php" >
						<tr>
							<td style="width: 17%;">手机号码：</td>
							<td> <input type="text" type="hidden" value="<?=$rs['mobile']?>" class="form-control textbox2" id="mobile" name="mobile"  readonly="readonly"></td>
							<td></td>
						</tr>
						<tr>
							<td style="width: 17%;">取款密码：</td> 
							<td><input type="password" class="form-control textbox2" id="zjpassword" name="zjpassword"></td>
						
						</tr>
                        	<tr>
							<td style="width: 17%;">新号码：</td>
							<td><input type="password" class="form-control textbox2" id="newmobile"  name="newmobile"></td>
					
						</tr>
                        
						<tr>
							<td colspan="3" class="merged-cell">我们不会泄漏任何用户信息，以及发送骚扰短信。</td>
						</tr>

						<tr>
							<td colspan="3" class="merged-cell">
                      
                             <input  class="btnsubmit ml5" type="submit" class="btnsubmit" value="下一步"/>

                            </td>
						</tr>

					</tbody>
                    </form>
				</table>
			</div>
		</div>
	</div>
<!--修改手机-->

<!--修改微信-->
	<div id="popup-verifywechat" style="display: none">
		<div class="popupinternal">
			<div class="steps">
				<div class="row clearfix mt30 ml33">
					<div class="stepitm" style="z-index: 1;">
						<div class="stepnotxt">修改微信号</div>
						<div class="hlfcircle"></div>
					</div>
					<div class="stepitm stepactive" style="z-index: 2;">
						<div class="stepnotxt">验证取款密码</div>
						<div class="hlfcircle hlfcircleactive"></div>
					</div>
					<div class="stepitm" style="z-index: 1;">
						<div class="stepnotxt">完成</div>
					</div>
				</div>
				<table class="table">
                  <form name="form1" method="GET" action="userinfo.php" >
					<tbody>
					<tr>
							<td style="width: 30%;">原微信号：</td>
							<td colspan="3" class="merged-cell"><input type="text" type="hidden" value="<?=$rs['email']?>" class="form-control textbox2" id="wechat" name="wechat"  readonly="readonly"></td>
							<td></td>
						</tr>
						<tr>
							<td style="width: 17%;">取款密码：</td> 
							<td><input type="password" class="form-control textbox2" id="zjpassword" name="zjpassword"></td>
						
						</tr>
                        	<tr>
							<td style="width: 17%;">新微信：</td>
							<td><input type="text" class="form-control textbox2" id="newwechat"  name="newwechat"></td>
					
						</tr>
	<tr>
							<td colspan="3" class="merged-cell">
                      
                             <input  class="btnsubmit ml5" type="submit" class="btnsubmit" value="下一步"/>

                            </td>
						</tr>
					</tbody>
                    </form>
				</table>
			</div>
		</div>
	</div>
<!--修改微信-->
	<div id="popup-verifyeditwechat" style="display: none">
		<div class="popupinternal">
			<div class="steps">
				<div class="row clearfix mt30 ml33">
					<div class="stepitm" style="z-index: 1;">
						<div class="stepnotxt">修改微信号</div>
					</div>
				</div>
				<table class="table">
					<tbody>
						<tr>
							<td style="width: 17%;">：</td>
							<td> 13107992708</td>
							<td></td>
						</tr>
						<tr>
							<td style="width: 17%;">验证码：</td>
							<td><input type="text" class="form-control textbox2" id="txtMobileCode1"></td>
							<td><input type="button" class="get_unbindmobile btnsubmit" style="width: 160px;" value="点击获取"></td>
						</tr>
						<tr>
							<td colspan="3" class="merged-cell">我们不会泄漏任何用户信息，以及发送骚扰短信。</td>
						</tr>

						<tr>
							<td colspan="3" class="merged-cell"><button id="btnEditMobile" class="btnsubmit" onClick="editMobile();">下一步</button> </td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/newdsn/js/cash/bindmail.js"></script>
	<script type="text/javascript" src="/newdsn/js/cash/bindmobile.js"></script>
	<script type="text/javascript" src="/newdsn/js/cash/bindwechat.js"></script>


</body></html>

