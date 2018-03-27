/***********幻灯*****************/
auto=null;
timer=null;
var focus=new Function();
focus.prototype={
	init:function(){
		//默认动画频率
		this.aTime=this.aTime || 10;
		//默认间隔
		this.sTime=this.sTime || 5000;
		//图片容器
		this.oImg=document.getElementById('focus_m').getElementsByTagName("ul")[0];
		this.oImgLi=this.oImg.getElementsByTagName("li");
		//左右按钮
		this.oL=document.getElementById('focus_l');
		this.oR=document.getElementById('focus_r');
		//创建文字容器
		this.createTextDom();
		//默认第一帧
		this.target=0;
		//开始动画
		this.autoMove();
		//鼠标
		this.oAction();
	},
	createTextDom:function(){
		var that=this;
		//创建文字容器
		this.oText=document.createElement("div");
		this.oText.className="focus_s";
		var ul=document.createElement('ul');
		var frag=document.createDocumentFragment();
		for (var i=0;i<this.oImgLi.length;i++) {
			var li=document.createElement("li");
			li.innerHTML='<b></b>';
			if (i==0) {
				li.className="active";
			};
			frag.appendChild(li);
		};
		ul.appendChild(frag);
		this.oText.appendChild(ul);
		this.o.insertBefore(this.oText,this.o.firstChild);
		//文字容器绑定动作
		this.oTextLi=this.oText.getElementsByTagName("li");		
	},
	autoMove:function(){
		var that = this;   
		auto=setInterval(function(){that.goNext()},that.sTime);
	},
	goNext:function() {
		this.target=this.nowIndex();
		this.target==this.oTextLi.length-1 ? this.target=0:this.target++;
		this.aStep=(this.target-this.nowIndex())*this.step;
		this.removeClassName();
		this.oTextLi[this.target].className="active";
		this.startMove();
	},
	goPrev:function() {
		this.target=this.nowIndex();
		this.target==0 ? this.target=this.oTextLi.length-1 : this.target--;
		this.aStep=(this.target-this.nowIndex())*this.step;
		this.removeClassName();
		this.oTextLi[this.target].className="active";
		this.startMove();
	},
	startMove:function (){
		var that=this;
		var t=0;
		this.timer='';
		function set(){
			if (t>100) {
				clearInterval(that.timer);
			}else {
				for (var i=0;i<that.oImgLi.length;i++) {
					that.oImgLi[i].style.display='none';
				};
				that.oImgLi[that.target].style.display='block';
				that.setOpacity(that.oImg,t);
				t+=5;
			};
		};
		timer=setInterval(set,that.aTime);
	},
	setOpacity:function(elem,level){
		if(elem.filters){
			elem.style.filter = 'alpha(opacity=' + level + ')';
			elem.style.zoom = 1;
		} else {
			elem.style.opacity = level / 100;
		};
	},
	nowIndex:function(){
		for (var i=0;i<this.oTextLi.length;i++) {
			if (this.oTextLi[i].className=='active') {
				return i;
				break;
			}
		};
	},
	oAction:function(){
		var that=this;
		for (var i=0;i<this.oTextLi.length;i++) {
			this.oTextLi[i].index=i;
			this.oTextLi[i].onclick=function(){
				clearInterval(auto);
				clearInterval(timer);
				that.setOpacity(that.oImg,100);
				that.target=this.index;
				that.removeClassName();
				this.className='active';
				that.startMove();
			}
		};
		/*
		mouseEnter (that.o,'mouseenter',function(e){
				clearInterval(auto);
			}
		);
		*/
		mouseEnter (that.o,'mouseleave',function(e){
				clearInterval(auto);
				that.autoMove();
			}
		);
		this.oL.onclick=function(){
			that.goPrev();
		};
		this.oR.onclick=function(){
			that.goNext();
		};
	},
	removeClassName:function(){
		for (var i=0;i<this.oTextLi.length;i++) {
			this.oTextLi[i].className=""
		};
	}
};
var focusRun=new focus();
focusRun.o=document.getElementById("focus");
function mouseEnter(ele,type,func){
	if(window.document.all)	
		ele.attachEvent('on'+type,func);
	else{//ff
		if(type==='mouseenter')
			ele.addEventListener('mouseover',this.withoutChildFunction(func),false);
		else if(type==='mouseleave')
			ele.addEventListener('mouseout',this.withoutChildFunction(func),false);
		else
			ele.addEventListener(type,func,false);		
	};
};
function withoutChildFunction(func){
	return function(e){
		var parent=e.relatedTarget;
		while(parent!=this&&parent){
			try{
				parent=parent.parentNode;}
			catch(e){
				break;
			}
		}
		if(parent!=this)
		func(e);
	};
};
/***********marquee*****************/
marqueeTime=null;
var marquee=function(){
	var o=document.getElementById('marquee').getElementsByTagName('ul')[0];
	var li=o.getElementsByTagName('li');
	var l=document.getElementById('marquee_l');
	var r=document.getElementById('marquee_r');
	var m=li.length-1;
	var w=135;
	var aTime=10;
	
	function goPrev(){
		clearTimeout(marqueeTime);
		startMove(false);
	};
	function goNext(){
		clearTimeout(marqueeTime);
		startMove(true);
	};
	function startMove(type){
		if (type) {
			var tt=0;	
		}else {
			var tt=w;
			var t1=document.createElement('li');
			var t2=o.getElementsByTagName('li')[m];
			t1.innerHTML=t2.innerHTML;
			o.insertBefore(t1,o.firstChild);
			o.removeChild(t2);
			o.style.marginLeft='-'+tt+'px';
		};
		function set(){
			if (type) {
				if (tt>=w) {
					clearInterval(marqueeTime);
					var t1=document.createElement('li');
					var t2=o.getElementsByTagName('li')[0];
					t1.innerHTML=t2.innerHTML;
					o.appendChild(t1);
					o.removeChild(t2);
					o.style.marginLeft=0;
				}else {
					o.style.marginLeft='-'+tt+'px';
					tt+=Math.ceil((w-tt)*0.1);
				};
			}else {
				if (tt<=0) {
					clearInterval(marqueeTime);
					o.style.marginLeft=0;
				}else {
					o.style.marginLeft='-'+tt+'px';
					tt=Math.floor(0.9*tt);
				};
			}
		};
		marqueeTime=setInterval(set,aTime);
	};
	if (li.length<7) {
		l.style.display=r.style.display='none'
	}else {
		r.onclick=function(){
			goNext();
		};
		l.onclick=function(){
			goPrev();
		};
	};
};
window.onload=function(){
	focusRun.init();
	marquee();
};