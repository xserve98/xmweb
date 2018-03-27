<?
include_once("cache/website.php");
if($web_site['close']==0){
//header("Location:index.php");
}
$v=explode("|||",$web_site['why']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>万丰国际系统维护页面</title>
<link type="text/css" rel="stylesheet" href="css/close.css" />
</head>

<body class="c_kefubg">

<div class="c_footer">
 <div class="config">
  <p>
  <?=$v[0] ?>
  </p>
 
 </div>
</div>
</body>
</html>
