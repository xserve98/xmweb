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
////////////获取顶级代理的联系方式///
$parr=explode(',',$rs['parents']);
$parentuid=$parr[0];
$sqlp="select * from k_user where uid = '$parentuid'  limit 1";
$query	 =	$mysqli->query($sqlp);
$prow	 =	$query->fetch_array();


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
      //    top.location = '/main.php';
        }
        var islg = <?= $uid ? 1 : 0 ?>;
    </script>
</head>
<body id="bodyid" class="skin_blue">


<?php include_once("usermenu.php"); ?>
<div class="rightpanel rw">
		<div class="contentcontainer">
			<div >
				<div class="row pagetitle">
					<span class="bluepagetitle">尊敬的会员<?=$rs['pay_name']?>:</span> 
				</div>
				<div class="row">
				  <div >
                   <span >
                   欢迎你来到<?=$web_site['web_name']?>。 <?=$web_site['web_name']?>支持有志人士共同发展，如果您不喜欢玩彩票，我们提供您无需花费一分钱，仅需一点点时间就能轻松月赚万元的方法。<?=$web_site['web_name']?>郑重声明绝对不会让您从您的银行卡转出一分钱。 如您有兴趣，请联系<?=$web_site['web_name']?>的财富顾问，进行一对一的讲解。
                   
                   </span><br>  
                    </div>        
				</div>
			
				  <div class="col2a" style="line-height:20px;float: none;padding-top: 20px;">
                  <?=$web_site['web_name']?>财富顾问联系方式：
				    </div>
             
                    <br>
                    <div class="col2a" style="line-height:20px;float: none; font-size: 16px;color: red;
">
                  微信：<?=$prow['email']?>
				    </div>
                    <br>
                    <div class="col2a" style="line-height: 20px;float: none; font-size: 16px;color: red;
">
                    QQ：<?=$prow['qq']?>
				    </div>
                    <br>
                   <div class="col2a" style="line-height: 20px;float: none; font-size: 16px;color: red;
">
                    电话：<?=$prow['mobile']?>
				    </div>
                    <br>
                     <div class="col2a">
                如有任何疑问，您也可以点击在线客服咨询。<?=$web_site['web_name']?>感谢有您参与。
				    </div>
                
				</div>
			
			</div>
			<div class="maincol">
			</div>
		</div>
	</div>




</body></html>

