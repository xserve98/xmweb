<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>


<?php 
echo '<form action="'.$actionUrl.'" method="post" name="myform" >';

foreach($arr as $k=>$v){
echo '<input name="'.$k.'" value="'.$v.'" type="hidden">';

}

echo '</form>';

?>

<script type="text/javascript">
history.go(1);
document.myform.submit();
  
</script>
</body>
</html>
