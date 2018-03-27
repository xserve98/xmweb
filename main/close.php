<?php
include_once("../cache/website.php");
include_once("../cache/conf.php");

if($web_site['close'] == 1) {
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	echo '<html xmlns="http://www.w3.org/1999/xhtml">';
	echo '<head>';
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	echo '<style>
html,body,h1,h2,h3,h4,h5,ul,ul li,div,form,dl,dd,dt,blockquote,p,fieldset,span,legend,label,img,q {margin:0;padding:0;border:0;}
ul,ul li {list-style:none;}
input,select{font-size:12px}
table{border-collapse:collapse;border:0}
body{color:#474747;font:12px/180% Arial,"微软雅黑","Microsoft Sans Serif","宋体";text-align:left;}
em,i{font-size:12px;font-style:normal;}
.close-bg{ border:#FF0 solid 5px;width:680px;height:250px;margin:150px auto;background:url(/img/close-bg.png) no-repeat;color:#fff; font-size:24px; font-family:"Microsoft YaHei","黑体";}
.cont{ padding:30px;padding-left:240px;line-height:42px;}
.cont a{color:#fff; text-decoration:none}
.cont a:hover{color:#f00;}
</style>';
	echo '<title>';
	echo $web_site['web_title'];
	echo '</title>';
	echo '</head>';
	echo '<body>';
	echo '<div>';
	echo '<div class="close-bg">';
	echo '<div class="cont">';
	echo $web_site['why'];
	echo '</div></div>';
	echo '</div>';
	echo '</body>';
	echo '</html>';
  
    exit();
} else {
	header("Location: /");
}
?>