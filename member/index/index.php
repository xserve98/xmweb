<?php
include_once("../../cache/website.php");
$indexurl = "/mymain.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?=$web_site['web_title']?></title>
	<link rel="shortcuticon" href="/favicon.ico" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<style> 
		html{width: 100%;height: 100%;}
		body{width: 100%;height: 100%;margin: 0;padding:0;overflow:hidden;overflow-x: auto;*overflow:visible;*overflow-x:visible;_overflow:hidden;_overflow-x:auto;}
		iframe{margin: 0;padding:0}
	</style>
</head>
<body>
    <iframe id="index" name="index" src="<?=$indexurl?>" frameborder="0" width="100%" height="100%" marginheight="0" marginwidth="0" scrolling="auto"></iframe>
</body>
</html>