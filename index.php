<?php
session_start();
$_SESSION['SitePath'] = dirname(__FILE__);
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("include/mobile_detect.php");
include_once("common/logintu.php");
include_once("common/function.php");
include_once("cache/conf.php");
include_once("cache/website.php");

/**
* 地区限制功能
*/
include_once("ip.php");
include_once("cache/dqxz.php");
$address    =    '='.iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"]));   //取出客户端IP所在城市
foreach($dqxz as $k=>$v){
    if(strpos($address,$v)){
        header("location:/");
        exit;
    }
}

function prefix_url(){
         $s = !isset($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';
            
         $protocol = strtolower($_SERVER['SERVER_PROTOCOL']);
         $protocol = substr($protocol,0,strpos($protocol,'/')).$s.'://';
            
         $port     = ($_SERVER['SERVER_PORT']==80) ? '' : ':'.$_SERVER['SERVER_PORT'];
            
         $server_name = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'].$port :
                        getenv('SERVER_NAME').$port;
         return $server_name;
}

if(isset($_GET['f'])){
	$uid= intval($_GET['f'])-100000;
    $sql    =    "select uid from k_user where uid='$uid' and is_daili=1 limit 1";
    $query    =    $mysqli->query($sql); //要是代理
    $rs        =    $query->fetch_array();
    if(intval($rs["uid"])){
        setcookie('f',intval($rs["uid"]));
        setcookie('tum',htmlEncode($_GET['f']));
        $indexurl = "/register";
    }
} else{
	$arr = explode('.',prefix_url()); //用 . 号截取url分割

    $f = $arr[0];


    if($f!='www' && $f!='' && $f!='wap'){
       $sql    =    "select uid from k_user where username='".htmlEncode($f)."' and is_daili=1 limit 1";
        $query    =    $mysqli->query($sql); //要是代理
        $rs        =    $query->fetch_array();
        if(intval($rs["uid"])){
            setcookie('f',intval($rs["uid"]));
            setcookie('tum',htmlEncode($f));
            $indexurl = "/register";
        }
    }
}

$detect = new Mobile_Detect;
?>
<?php include_once('myhome2.php') ?>

<!--script type="text/javascript">
var url = window.location.href;
    
              if (url.indexOf("https") < 0) {
    
                  url = url.replace("http:", "https:");
    
                  window.location.replace(url);
    
              }
</script-->
<script language="JavaScript">

	</script>
<!--弹窗-->
<!--<script type="text/javascript">
    layer.open({
      type: 1,
      title: '<?=$web_site['web_name']?> 官方网址：<?=$web_site['web_www']?>',
      closeBtn: 1, //不显示关闭按钮
      shade: [0],
      area: ['600px', '400px'],
      style:'background-color',
      shade: [0.3, '#000'],
      anim: 2,
      content:'<div class="layerbox01" ><img src="<?=$web_site["web_ggtp"]?>" ondragstart="return false;"></div>',
    });
</script>-->
</head>
<body >
</body>
</html>