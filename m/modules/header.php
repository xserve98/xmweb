<?php
session_start();
include_once("include/mysqli.php");
include_once("include/lottery.inc.php");
include_once("common/function.php");
include_once("cache/website.php");

$uid = $_SESSION["uid"];
$user = $_SESSION['username'];

if(isset($_GET['f'])) {
	$sql    =    "select uid from k_user where username='".htmlEncode($_GET['f'])."' and is_daili=1 limit 1";
    $query    =    $mysqli->query($sql); //要是代理
    $rs        =    $query->fetch_array();
    if(intval($rs["uid"])){
        setcookie('f',intval($rs["uid"]));
        setcookie('tum',htmlEncode($_GET['f']));
        echo '<script>location.href="/myreg.php";</script>';
		exit;
    }
}

$sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 1";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$list = $rs['msg'];

?>
<?php
// strpos: 返回boolean值.FALSE和TRUE不用多说.用“===”进行判断.strpos在执行速度上都比以上两个函数快,
//另外strpos有一个参数指定判断的位置,但是默认为空.意思是判断整个字符串.缺点是对中文的支持不好.
//PHP判断字符串的包含代码如下:
//$user= "guest_";
$needle= "guest_";
$pos = strpos($user, $needle)
?>
<div class="wraper">
		<div class="tit_index">
			<div class="index_logo"><img src="../../images/dy/logo.png"/></div>
		<div class="index_nav">
		     <?php
			 if(!$uid){
				?>
				<a id="bn_loginOut" class="index_nav_a bn_zc_home" href="/user/register"><b>注册</b></a>
				<a id="bn_loginOut" class="index_nav_a bd_dl_home" href="/user/login"><b>登录</b></a> 
				<a id="bn_loginOut" class="index_nav_a" href="/guest.php"><b>试玩</b></a>
				<?php } else { ?>
		     <?php if(empty($_SESSION["uid"]) || empty($_SESSION["username"])) { ?>
             <?php } elseif($_SESSION["username"] == $pos = strpos($user, $needle)) { ?>
			    <a id="bn_loginOut" class="index_nav_a" href="/member/logout"><b>退出</b></a>
				<a class="poit_rl"><img src="../../xmindex/images/userinfo.png" width="19" height="19" style="position:absolute;top:12px;margin-left:-23px;">试玩用户</a>
				<?php } else { ?>
				<a id="bn_loginOut" class="index_nav_a" href="/member/logout"><b>退出</b></a>
				<a href="/member/userinfo" class="poit_rl"><img src="../../xmindex/images/userinfo.png" width="19" height="19" style="position:absolute;top:12px;margin-left:-23px;"><b><?=$_SESSION["username"]?></b></span></a>
            <?php } ?>
			<?php } ?>
		</div>
		</div>
