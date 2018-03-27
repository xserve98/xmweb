function closeAddHome(){
	document.getElementById('add-home').style.display = 'none';
	document.cookie = "addedHomeScreen=true";
	window.localStorage.setItem("addedHomeScreen", "true")
}
 
function iOS() {
 
	  var iDevices = [
	    'iPad Simulator',
	    'iPhone Simulator',
	    'iPod Simulator',
	    'iPad',
	    'iPhone',
	    'iPod'
	  ];
 
	  if (!!navigator.platform) {
	    while (iDevices.length) {
	      if (navigator.platform === iDevices.pop()){ return true; }
	    }
	  }
 
	  return false;
	}
var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
var is_safari = navigator.userAgent.indexOf("Safari") > -1;
var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
if ((!is_chrome)&&(is_safari)) {is_safari=false;}
if ((!is_chrome)&&(!is_opera)) {is_chrome=false;}