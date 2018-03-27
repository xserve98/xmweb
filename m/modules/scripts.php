<script src="/scripts/base.js"></script>
<!-- <script src="/scripts/carousel.js"></script> -->
<!-- <script src="/scripts/carousel2.js"></script> -->
<script src="/scripts/page-slide.js"></script>
<script src="/scripts/nav.js"></script>
<script src="/scripts/common.js"></script>
<script src="scripts/iframe-menu.js"></script>
<script type="text/javascript">
// document.addEventListener("touchmove",function(e){
// 	e.preventDefault();
// 	e.stopPropagation();
// },false);
$(document).ready(function() {
	$('.page-discount .col-sm-12').click(function(event) {
		event.preventDefault();
		var ec = $('#J_p6carousel ul li').eq($('.page-discount .col-sm-12').index(this));
		console.log(ec.html().replace(/[\r\n]/g,""));
		var d = dialog({
	    	title: '优惠活动',
	    	content: ec.html(),
	    	id:'sdialog'
		});
		d.showModal();
	});
	setInterval(function(){			
		$.ajax({url:"/timeout.php",success:function(data){if(data=='1'){window.location.href='/user/logout.php';}}});
		//console.log($('.page.active').height());
		//$('.page.active').height(2000);
	},60000);
	//$("html").niceScroll();
	//$('.page.active').height(200);
	//alert($(window).height());
});
</script>