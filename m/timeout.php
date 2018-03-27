<?php
@session_start();
$flag = '0';
if(isset($_SESSION['expiretime'])) {
    if($_SESSION['expiretime'] < time()) {
        unset($_SESSION['expiretime']);
        $flag = '1';
    }
}
echo $flag;
exit;
?>