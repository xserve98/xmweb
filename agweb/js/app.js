// scroll to target div
jQuery.fn.extend(
{
  scrollToDiv : function(speed, easing)
  {
    return this.each(function()
    {
      var targetOffset = $(this).offset().top;
      $('html,body').animate({scrollTop: targetOffset}, speed, easing);
    });
  }
});

$(function(){
	"use strict"; 

	$('.btn-open-video').on('click', function(e){
		$('#box-video').addClass('show-video');
	});

	$('.btn-scroll').on('click', function(e){
		var self = $(this);
		$(self.data('target')).scrollToDiv(self.data('speed'));
	});

	$('#back-to-top').css({top: $(window).height() + $(window).scrollTop() - 150 + 'px'}).show();
	$('#float-qrcode').css({top: $(window).height() + $(window).scrollTop() - 300 + 'px'}).show();
	//Check to see if the window is top if not then display button
	$(window).scroll(function () {
		var win = $(this);
		var backToTopBox = $('#back-to-top');
		var floatQrcode = $('#float-qrcode');
		var winHeight = win.height();
		var scrollTop = win.scrollTop();
		backToTopBox.stop();
		floatQrcode.stop();
		/*
		if (scrollTop > 0) {
			backToTopBox.fadeIn();
		} else {
			backToTopBox.fadeOut();
		}
		*/
		backToTopBox.delay( 500 ).finish().animate({top: winHeight + scrollTop - 150 + 'px'}, 800);
		floatQrcode.delay( 500 ).finish().animate({top: winHeight + scrollTop - 300 + 'px'}, 800);
	});
	//Click event to scroll to top
	$('#back-to-top').on('click', function(e){
		$('html, body').animate({ scrollTop: 0 }, 800);
		return false;
	});
});