<?
include_once("include/mysqli.php");
$sql		= "select * from webinfo";	
//开始读取赔率

$query = $mysqli->query($sql);
$web_site			=	array();

while ($rows = $query->fetch_array()) {
	

   $web_site[$rows['code']]	= $rows['content']	;

}