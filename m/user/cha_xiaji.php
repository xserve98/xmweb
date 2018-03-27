<?php
include_once("../common/login_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看下级明细</title>
<noframes><body>
</body></noframes>
</html>
<frameset rows="20,*" frameborder="no" border="0" framespacing="0">
	<frame src="dl_xjmx_title.php" name="xjmx_titleFrame" scrolling="no" id="xjmx_titleFrame" title="xjmx_titleFrame" style="overflow-x:hidden;" />
	<frame src="dl_xjmx.php?month=<?=date("Y-m")?>" name="xjmxFrame" scrolling="yes" id="xjmxFrame" title="xjmxFrame" style="overflow-x:hidden;" />
</frameset>