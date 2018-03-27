<html><head>
<title></title>

<style type="text/css">
body {
  margin: 0;
  padding: 0;
  background:#E6F5FC;
  cursor: E-resize;
}
</style>
<script language="JavaScript" type="text/javascript">
<!--
var pic = new Image();
pic.src = "images/arrow_right.gif";

function toggleMenu()
{
  frmBody = parent.document.getElementById('bodyFrame');
  imgArrow = document.getElementById('img');

  if (frmBody.cols == "0,10,*")
  {
    frmBody.cols = "190,10,*";
    imgArrow.src = "images/arrow_left.gif";
	imgArrow.title = "关闭左边";
  }
  else
  {
    frmBody.cols = "0,10,*";
    imgArrow.src = "images/arrow_right.gif";
	imgArrow.title = "打开左边";
  }
}

var orgX = 0;
document.onmousedown = function(e)
{
  var evt = Utils.fixEvent(e);
  orgX = evt.clientX;

  if (Browser.isIE) document.getElementById('tbl').setCapture();
}

document.onmouseup = function(e)
{
  var evt = Utils.fixEvent(e);

  frmBody = parent.document.getElementById('bodyFrame');
  frmWidth = frmBody.cols.substr(0, frmBody.cols.indexOf(','));
  frmWidth = (parseInt(frmWidth) + (evt.clientX - orgX));

  frmBody.cols = frmWidth + ",10,*";

  if (Browser.isIE) document.releaseCapture();
}

var Browser = new Object();

Browser.isMozilla = (typeof document.implementation != 'undefined') && (typeof document.implementation.createDocument != 'undefined') && (typeof HTMLDocument != 'undefined');
Browser.isIE = window.ActiveXObject ? true : false;
Browser.isFirefox = (navigator.userAgent.toLowerCase().indexOf("firefox") != - 1);
Browser.isSafari = (navigator.userAgent.toLowerCase().indexOf("safari") != - 1);
Browser.isOpera = (navigator.userAgent.toLowerCase().indexOf("opera") != - 1);

var Utils = new Object();

Utils.fixEvent = function(e)
{
  var evt = (typeof e == "undefined") ? window.event : e;
  return evt;
}
//-->
</script>

</head>
<body onselect="return false;">
<table height="100%" cellspacing="0" cellpadding="0" id="tbl">
  <tbody><tr><td><a href="javascript:toggleMenu();"><img width="10" height="30" border="0" id="img" title="关闭左边" src="images/arrow_left.gif"></a></td></tr>
</tbody></table>

</body></html>