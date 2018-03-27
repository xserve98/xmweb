<?php
function open_sql_connection($db_name) {
	$connectionInfo =  array("UID"=>"game","PWD"=>"game123456","Database"=>$db_name,"CharacterSet"=>"UTF-8");
	$conn = sqlsrv_connect("localhost",$connectionInfo);
	return $conn;
}

function close_sql_connection($conn) {
	sqlsrv_close($conn);
}
?>
