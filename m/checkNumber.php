<?
session_start();
if($_SESSION['randcode']==$_GET['number']){
	echo "yes";
}else{
	echo "no";	
}

?>