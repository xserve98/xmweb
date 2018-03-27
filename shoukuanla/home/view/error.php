<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>错误信息</title>

<style type="text/css">
.contens{
	width: 350px;
	background-color: #FFF;
	box-shadow: 0px 3px 10px #0070A6;
	margin-right: auto;
	margin-left: auto;
	margin-top: 200px;
	height: auto;
	border-radius: 6px;
	font-family: "微软雅黑";
	margin-bottom: 50px;
	padding-top: 10px;
	padding-right: 20px;
	padding-bottom: 20px;
	padding-left: 20px;
	text-align: center;
}
		
p{
	font-size: 24px;	
}		

		</style>
</head>

<body>
<div class="contens">
<p><?php echo $title; ?></p>

</div>

<script type="text/javascript">
//跳转
function jump(){
  
  <?php    
   if(empty($returnPath)){
	  echo 'window.history.back(-1);';
   }else{
	  echo "window.location.href='$returnPath';"; 
	   
	}
  ?>
}
window.setTimeout("jump()",1000*<?php echo $returnTime; ?>);

</script>
</body>
</html>
