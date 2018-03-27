$(document).ready(function(){
/*tips*/
$("#header a").hover(function(e){
	if(this.title!=""||this.mytitle!=null){
		if(this.mytitle==null){this.mytitle=this.title;}
		this.title="";
		var tip="<div id='tip'>"+this.mytitle+"</div>"
		var x=e.clientX+20;
		var y=e.clientY+20;
		if(x+230>document.getElementsByTagName("body")[0].scrollWidth){x=x-230;};
		$('body').append(tip);
		$("#tip").css({
			'top':y,'left':x,'opacity':'0.7','display':'none'
			}).fadeIn('fast');
		};
	},function(){$('#tip').remove();});

/*random*/
var wiw = 1181;
var wih = 338;
var root= "/new/img/pics/";
var pos = [
	{x:112,y:136,a:98,b:120,c:78,z:20,srca:'zq.png',srcb:'pics_bg.png',srcc:'zq.gif',hrf:'#'},
	{x:159,y:20,a:79,b:79,c:65,z:19,srca:'grfq.png',srcb:'grfq.png',srcc:'grfq.png',hrf:'#'},
	{x:77,y:241,a:75,b:91,c:62,z:18,srca:'lq.png',srcb:'pics_bg.png',srcc:'basketball.gif',hrf:'#'},
	{x:220,y:233,a:67,b:80,c:54,z:17,srca:'bq.png',srcb:'pics_bg.png',srcc:'baseball.gif',hrf:'#'},
	{x:74,y:77,a:75,b:75,c:62,z:16,srca:'pq.png',srcb:'pq.png',srcc:'zq.gif',hrf:'#'},
	{x:231,y:91,a:56,b:66,c:44,z:15,srca:'tq.png',srcb:'pics_bg.png',srcc:'tq.gif',hrf:'#'},
	{x:309,y:154,a:50,b:60,c:40,z:13,srca:'tenis.png',srcb:'pics_bg.png',srcc:'tenis.gif',hrf:'#'},
	{x:218,y:154,a:52,b:52,c:40,z:14,srca:'empty.png',srcb:'empty.png',srcc:'zq.gif',hrf:'#'},
	{x:310,y:58,a:52,b:52,c:40,z:12,srca:'empty.png',srcb:'empty.png',srcc:'zq.gif',hrf:'#'},
	{x:297,y:99,a:115,ah:72,b:115,c:76,z:11,srca:'more1.png',srcb:'more1.png',srcc:'zq.gif',hrf:'#'},
	
	{x:112,y:136,a:98,b:120,c:80,z:20,srca:'car.png',srcb:'pics_bg.png',srcc:'car.gif',hrf:'#'},
	{x:159,y:20,a:79,b:79,c:65,z:19,srca:'glq.png',srcb:'glq.png',srcc:'zq.gif',hrf:'#'},
	{x:77,y:241,a:75,b:75,c:62,z:18,srca:'blq.png',srcb:'blq.png',srcc:'zq.gif',hrf:'#'},
	{x:220,y:233,a:67,b:80,c:54,z:17,srca:'ts.png',srcb:'ts.png',srcc:'zq.gif',hrf:'#'},
	{x:74,y:77,a:76,b:76,c:62,z:16,srca:'ymq.png',srcb:'ymq.png',srcc:'zq.gif',hrf:'#'},
	{x:231,y:91,a:56,b:68,c:44,z:15,srca:'tb.png',srcb:'pics_bg.png',srcc:'tb.gif',hrf:'#'},
	{x:309,y:154,a:50,b:60,c:40,z:13,srca:'boxing.png',srcb:'boxing.png',srcc:'zq.gif',hrf:'#'},
	{x:218,y:154,a:50,b:60,c:40,z:14,srca:'empty.png',srcb:'pics_bg.png',srcc:'zq.gif',hrf:'#'},
	{x:310,y:58,a:50,b:60,c:40,z:12,srca:'empty.png',srcb:'pics_bg.png',srcc:'zq.gif',hrf:'#'},
	{x:297,y:99,a:115,ah:72,b:115,c:76,z:11,srca:'more2.png',srcb:'more2.png',srcc:'zq.gif',hrf:'#'}	
];

for(var i=0;i<pos.length/2;i++) {
	pos[i+pos.length/2].x=wiw-pos[i].x-pos[i].a;
}

function appHtm(i){
	var ah=(pos[i].ah=="undefined")?'auto':pos[i].ah+'px';
	$('#flash').append('<img src="'+root+pos[i].srca+'" onclick="window.open(\''+pos[i].hrf+'\',\'_self\')"; style="width:'+pos[i].a+'px; height:'+ah+'; left:'+pos[i].x+'px; top:'+pos[i].y+'px; z-index:'+pos[i].z+';"/>');
}

for(var i=0;i<pos.length;i++) {
	appHtm(i);
}

$("#flash>img").each(function (i) {
	switch(i){
		case 7:
		case 8:
		case 9:
		case 17:
		case 18:
		case 19:break;
		default:imgZoom(i);
	}
	
});

function imgZoom (i){
	var xiup =8*pos[i].a/(2*98);
	var xiuc =Math.ceil((78/120)*pos[i].b);
		pos[i].c=pos[i].c > xiuc ? pos[i].c : xiuc;
	var oposX=pos[i].x+'px'
	var zposX=pos[i].x+(pos[i].a-pos[i].b)/2-xiup+'px'
	var cposX=pos[i].x+(pos[i].a-pos[i].c)/2-xiup+'px'
	var oposY=pos[i].y+'px';
	var zposY=pos[i].y+(pos[i].a-pos[i].b)/2-xiup+'px';
	var cposY=pos[i].y+(pos[i].a-pos[i].c)/2-xiup+'px';
	var owid =pos[i].a +'px'; 
	var zwid =pos[i].b +'px'; 
	var cwid =pos[i].c+1 +'px';
	
	var zcss = {'z-index':200,'left': zposX,'top': zposY,'width': zwid,'cursor':'pointer'};
	var ocss = {'z-index':pos[i].z,'left': oposX,'top': oposY,'width': owid,'cursor':'default'};
	var ccss = {'z-index':199,'width': cwid,'display':'block', 'position':'relative'};
	var divcss = {'z-index':199,'left': cposX,'top': cposY,'width': cwid,'display':'block', 'position':'absolute'};
	$('#flash>img').eq(i).hover(function(e){
		hoverSty(i);
	},function(e){
		$(this).attr('src',root+pos[i].srca);
		$(this).css(ocss);
		$('#imggif').attr('src','');
		$('#imggif').css({'width':'0px'});
		$('#imgdiv').css({'display':'none'});
	});	

	function hoverSty(i) {
		$('#flash>img').eq(i).css(zcss);
		$('#flash>img').eq(i).attr('src',root+pos[i].srcb);
		$('#imggif').attr('src',root+pos[i].srcc);
		$('#imgdiv').css(divcss);
		$('#imggif').css(ccss);
	}
}
});

function preloader() {  
	if (document.images) {  
		new Image().src = "/new/img/pics/pics_bg.png"; 
		new Image().src = "/new/img/pics/zq.gif";  
		new Image().src = "/new/img/pics/basketball.gif";  
		new Image().src = "/new/img/pics/baseball.gif";  
		new Image().src = "/new/img/pics/tenis.gif";  
		new Image().src = "/new/img/pics/tq.gif";  
		new Image().src = "/new/img/pics/car.gif";  
		new Image().src = "/new/img/pics/tb.gif"; 
		new Image().src = "/images/logo.gif"; 
		new Image().src = "/img/download.png"; 
		new Image().src = "/images/SurferServer.gif"; 
		new Image().src = "/img/hsbbet.png"; 
		new Image().src = "/img/scj.png"; 
		new Image().src = "/images/r_1.gif"; 
		new Image().src = "/images/r_t_1.gif"; 
		new Image().src = "/images/r_t_2.gif"; 
		new Image().src = "/images/button1.gif"; 
		new Image().src = "/images/button001.gif"; 
		new Image().src = "/images/ico.gif"; 
		new Image().src = "/images/record.jpg"; 
		new Image().src = "/images/bg.gif"; 
		new Image().src = "/images/button02.png"; 
		new Image().src = "/images/t_3.gif"; 
		new Image().src = "/images/nav06.gif"; 
		new Image().src = "/images/nav07.gif"; 
		new Image().src = "/images/leftbg.gif"; 
		new Image().src = "/images/leftbg01.gif"; 
		new Image().src = "/images/navbg.gif"; 
		new Image().src = "/img/phone2.png"; 
		new Image().src = "/img/qq.png"; 
		new Image().src = "/img/skype.png"; 
		new Image().src = "/images/nav09.gif"; 
		new Image().src = "/images/left_bg.jpg";
		new Image().src = "/jsc/images/jsc.jpg";
		new Image().src = "/jsc/images/tybc.jpg";
		new Image().src = "/jsc/images/jishiqi.png";
		new Image().src = "/jsc/images/lhj.gif";
	}  
}  
function addLoadEvent(func) {  
	var oldonload = window.onload;  
	if (typeof window.onload != 'function') {  
		window.onload = func;  
	} else {  
		window.onload = function() {  
			if (oldonload) {  
				oldonload();  
			}  
			func();
		}  
	}  
}
addLoadEvent(preloader); 
/*
sym = "❄"; speed=50; drops=30; movex = -speed/20; movey = speed; count = 0;
drop = new Array(); xx = new Array(); yy = new Array(); mv = new Array();
for(make = 0; make < drops; make++){
	document.write('<div id="drop'+make+'" class=drop>'+sym+'</div>');
	drop[make] = document.getElementById("drop"+make).style;
	maxx = document.body.clientWidth-40;
	maxy = document.body.clientHeight-40;
	xx[make] = Math.random()*maxx;
	yy[make] = -100-Math.random()*maxy;
	drop[make].left = xx[make]+"px";
	drop[make].top = yy[make]+"px";
	mv[make] = (Math.random()*5)+speed/16;
	drop[make].fontSize = ((Math.random()*10)+20)+"px";
	drop[make].color = 'white';
}

function moverain(){
	for(move = 0; move < drops; move++){
		xx[move]+=movex;  yy[move]+=mv[move];
		hmm = Math.round(Math.random()*1);
		if(xx[move] < 0){xx[move] = maxx+10;}
		if(yy[move] > maxy){yy[move] = 10;}
		drop[move].left = xx[move]+"px";
		drop[move].top = (yy[move]+document.body.scrollTop)+"px";
	}
	setTimeout('moverain()','100');
}
moverain();
*/