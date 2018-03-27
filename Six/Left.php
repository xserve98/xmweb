<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link type="text/css" rel="stylesheet" href="css/6hc.css"/>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="layer/layer.min.js" type="text/javascript"></script>
<? include "menu.php";?>
<script type="text/javascript">
function initMenu() {
  $('#menu ul').hide();
  $('#menu ul:first').show();
  $('#menu li a').click(
    function() {
      var checkElement = $(this).next();
      if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
        return false;
        }
      if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
        $('#menu ul:visible').slideUp('normal');
        checkElement.slideDown('normal');
        return false;
        }
      }
    );
  }
$(document).ready(function() {initMenu();});
</script>
</head>
<body>
<div class="left">
<ul id="menu">
    <li>
        <a href="#">特别号</a>
        <ul>
            <li><a href="Six_7_1.php" target="mainFrame">号码 & 两面</a></li>
            <li><a href="Six_7_2.php" target="mainFrame">波色 & 生肖 & 尾数</a></li>
        </ul>
    </li>
    <li>
        <a href="#">正码特</a>
        <ul>
            <li><a href="Six_1.php" target="mainFrame">正码一</a></li>
            <li><a href="Six_2.php" target="mainFrame">正码二</a></li>
            <li><a href="Six_3.php" target="mainFrame">正码三</a></li>
            <li><a href="Six_4.php" target="mainFrame">正码四</a></li>
            <li><a href="Six_5.php" target="mainFrame">正码五</a></li>
            <li><a href="Six_6.php" target="mainFrame">正码六</a></li>
            <li><a href="Six_1_6.php" target="mainFrame">两面盘 & 波色</a></li>
        </ul>
    </li>
    <li>
        <a href="#">正码</a>
        <ul>
            <li><a href="Six_8_1.php" target="mainFrame">号码</a></li>
            <li><a href="Six_8_2.php" target="mainFrame">过关</a></li>
        </ul>
    </li>
    <li>
        <a href="#">总和</a>
        <ul>
            <li><a href="Six_9.php" target="mainFrame">两面</a></li>
        </ul>
    </li>
    <li>
        <a href="#">一肖、尾数</a>
        <ul>
            <li><a href="Six_10.php" target="mainFrame">一肖、尾数</a></li>
        </ul>
    </li>
    <li>
        <a href="#">连码</a>
        <ul>
            <li><a href="Six_11.php" target="mainFrame">连码</a></li>
        </ul>
    </li>
    <li>
        <a href="#">合肖</a>
        <ul>
            <li><a href="Six_12.php" target="mainFrame">合肖</a></li>
        </ul>
    </li>
    <li>
        <a href="#">生肖连</a>
        <ul>
            <li><a href="Six_13.php" target="mainFrame">生肖连</a></li>
        </ul>
    </li>
    <li>
        <a href="#">尾数连</a>
        <ul>
            <li><a href="Six_14.php" target="mainFrame">尾数连</a></li>
        </ul>
    </li>
    <li>
        <a href="#">全不中</a>
        <ul>
            <li><a href="Six_15.php" target="mainFrame">全不中</a></li>
        </ul>
    </li>
    <li><a href="Auto.php" target="mainFrame">开奖号码</a></li>
</ul>
</div>
</body>
</html>