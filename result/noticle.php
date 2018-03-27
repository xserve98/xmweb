<?php
session_start();
include_once("../include/config.php");
include_once("../include/mysqli.php");

$sql = "select add_time,msg from k_notice where is_show=1 order by `sort` desc,nid desc limit 0,15";
$query = $mysqli->query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>系统公告</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-size: 12px;
            margin: 0px;
            color: #000;
        }

        .td_2 {
            border-bottom: 1px solid #B63220;
            border-right: 1px solid #B63220;
            border-left: 1px solid #B63220;
        }

        .td_3 {
            border-bottom: 1px solid #B63220;
            border-right: 1px solid #B63220;
            overflow: auto;
            line-height: 20px;
        }

        .td_1 {
            border-right: 1px solid #fff;
        }
    </style>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="0" class="memberdiv" width="720px" style="background-color: #fff">
    <tr>
        <td valign="middle" height="30" bgcolor="#b63220" align="center" class="td_1"><font color="#fcf9f9">日 期</font></td>
        <td valign="middle" bgcolor="#b63220" align="center" class="font-blackmid"><font color="#fcf9f9">公告内容</font></td>
    </tr>

    <?php
    $i = 0;
    while ($row = $query->fetch_array()) {
        ?>
        <tr>
            <td class="td_2" valign="middle" height="20" align="center"><?= date("m-d", strtotime($row["add_time"])) ?></td>
            <td class="td_3" valign="middle" height="20" align="left" width="660"><?= $row["msg"] ?></td>
        </tr>
    <?php
    }
    ?>

</table>
</body>
</html>