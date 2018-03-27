<?php
#商户编号p1_MerId,以及密钥Key
$p1_MerId = "";
$key = "";

if (isset($_SESSION['bank_interface_u_k'])){
	$arr = explode('|', $_SESSION['bank_interface_u_k']);
	$p1_MerId = $arr[0];
	$key = $arr[1];
}
