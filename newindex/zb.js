function cancelMouse(){return false;}
  document.oncontextmenu = cancelMouse; 
  
function mover(o){
    o.style.backgroundPosition='0 bottom';
}

function mout(o){
    o.style.backgroundPosition='0 top';
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function subWin(swf){
  window.open(swf,"gameOpen","width=1040,height=768");
}
function subWinRule(swf){
  window.open(swf,"gameOpenRule","width=1040,height=768,scrollbars=yes");
}

//透明按鈕效果(漸變)~
function over_o(o){
	$(o).stop().animate({'opacity': 0}, 650);
}
function out_o(o){
	$(o).stop().animate({'opacity': 1}, 650);
}

// 設為首頁
function setfirst(url) {
   if(document.all){
		document.body.style.behavior = 'url(#default#homepage)';
		document.body.setHomePage(url);
   }else{
	   alert("您的浏览器目前不支援此功能！");
	}
}

// 加入最愛
function bookmarksite(url,title) {
	if (window.sidebar||window.opera) {
		// for firfox
		window.sidebar.addPanel(title, url,"");
	}else if(document.all){
		// for IE
		window.external.AddFavorite( url, title);
	}else{
		alert("您的浏览器目前不支援此功能！");
	}
}