<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<title></title>
<body onLoad="document.paymm.submit()">

<form name="paymm" id="paymm" action="https://pay.ecpss.com/sslpayment" method="post" target="_top">
<?php
foreach(array('_POST', '_GET') as $_request) {
   foreach($$_request as $_key => $_value) {   
    // echo $_key;
	// echo "-".$_value."<br>";
  ?>
<input type="hidden" name="<?php echo $_key;?>" value="<?php echo $_value;?>">
<?php }}?>
</form>
</body>
</html>