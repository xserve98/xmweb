<?php
include_once("../common/login_check.php");
include_once("../include/mysqli.php");
include_once("../include/mysqlit.php");
include_once("../include/mysqlio.php");
include_once("../include/config.php");
include_once("../common/function.php");
include_once("../include/sqlservergame.php");
?>
<?php
$sql="select * from qipai_config";
$query=$mysqlio->query($sql);
$rows	=	$query->fetch_array();
$enable_exchange = $rows["enable_exchange"];
$game_rate_money = $rows["game_rate_money"];
$game_rate_chip = $rows["game_rate_chip"];
$game_minimum = (int)$rows["game_minimum"];
$money_rate_money = $rows["money_rate_money"];
$money_rate_chip = $rows["money_rate_chip"];
$money_minimum = (int)$rows["money_minimum"];
$daily_activity = $rows["daily_activity"]==null?0:($rows["daily_activity"]=="1"?1:0);
$daily_chip = $rows["daily_chip"];

if($daily_activity !=1) {
	echo 3;
	exit;
}

$uid		=	$_SESSION["uid"];
$sql	=	"select * from k_user where uid=".$uid;
$query	=	$mysqli->query($sql);
while($rows	=	$query->fetch_array()){
	$username	=	$rows['username'];
	$v8money	=	$rows['money'];
}

$conn = open_sql_connection("QPAccountsDB");
if( $conn != false) {
	$sql = "select userid from AccountsInfo where accounts='".$username."'";
	$result = sqlsrv_query( $conn, $sql, null);
	$game_user = null;
	while($row = sqlsrv_fetch_array($result)) {
		$game_user = $row["userid"];
	}
	close_sql_connection($conn);
	if($game_user != null) {
		$conn = open_sql_connection("QPTreasureDB");
		if( $conn != false) {
			$sql = "select DrawDate from GameDailyActivity where DATEDIFF(day,DrawDate,getdate())=0 and userid=".$game_user;
			$result = sqlsrv_query( $conn, $sql, null);
			while($row = sqlsrv_fetch_array($result)) {
				$already_get = $row["DrawDate"];
			}
			if($already_get == null) {
				$sql = "update GameScoreInfo set score=score+".$daily_chip." where userid=".$game_user;
				sqlsrv_query( $conn, $sql, null);
				$sql = "insert into GameDailyActivity(UserID,Amount,UserName) Values(".$game_user.", ".$daily_chip.",'".$username."')";
				sqlsrv_query( $conn, $sql, null);
				echo 1;
			} else {
				echo 2;
				exit;
			}
			close_sql_connection($conn);
		}
	} 
}

?>