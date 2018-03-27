<?php 
include_once("myhead2.php");

$sql = "select msg from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc limit 1";

$query = $mysqli->query($sql);
			
$rs = $query->fetch_array() ;

$msg=$rs['msg'];
?>

</body>
</html>