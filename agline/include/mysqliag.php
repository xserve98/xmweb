<?php
unset($mysqliag);
$mysqliag = new MySQLi("db1.aglivegame.com","agdbuser","aglivegame","agxmldown");
$mysqliag->query("set names utf8");
?>