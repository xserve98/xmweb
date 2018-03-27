    function ShowMessage1(strMessage) {
        JqueryShowMessage(strMessage);
    }

    function ShowMessage2(strMessage, strUrl) {
        JqueryShowMessageWithRedirect(strMessage, strUrl);
    }

    function ShowMessage3(strMessage, strMessageTitle, strUrl) {
        JqueryShowMessageWithRedirect(strMessage, strUrl);
    }

    function ShowMessage4(strMessage, strMessageTitle, strUrl, intActiveTabIndex) {
        JqueryShowMessageWithTabRedirect(strMessage, strUrl, intActiveTabIndex);
    }

    function ShowLoading() {
        document.getElementById('ProgressTemplate').style.display = 'block';
    }

    function CloseLoading() {
        document.getElementById('ProgressTemplate').style.display = 'none';
    }
    
     function JqueryShowMessageHome(strMessage) {
    	 art.dialog({  
     		title: l_artDialog["title"],
     		content: strMessage,
//     		icon: 'face-sad',
     		button: [{name: l_artDialog["confirm"],callback: function () { window.location = "http://juyou1989.com/cscpLoginWeb/scripts/home?l=0";}}],
     		lock: true,
     	    background: '#000000', // 背景色
     	    opacity: 0.6,	// 透明度
     	    width: '260px',
     	    drag: false,
     	    resize: false
     		});
    }
    
     function JqueryShowMessageReload(strMessage) {
        art.dialog({  
        	title: l_artDialog["title"],
     		content: strMessage,
//     		icon: 'succeed',
     		button: [{name: l_artDialog["confirm"],callback: function () {  window.location.reload();}}],
     		lock: true,
     	    background: '#000000', // 背景色
     	    opacity: 0.6,	// 透明度
     	    width: '260px',
     	    drag: false,
     	    resize: false
     		});
    }
     
     function JqueryShowMessageReloadandOK(strMessage) {
         art.dialog({  
         	title: l_artDialog["title"],
      		content: strMessage,
//      		icon: 'succeed',
      		button: [{name: l_artDialog["confirm"],callback: function () { location.reload();}}],
      		lock: true,
      	    background: '#000000', // 背景色
      	    opacity: 0.6,	// 透明度
      	    width: '260px',
      	    drag: false,
      	    resize: false
      		});
     }
     
     function JqueryShowMessageCloseWindow(strMessage) {
         art.dialog({  
         	title: l_artDialog["title"],
      		content: strMessage,
//      		icon: 'succeed',
      		button: [{name: l_artDialog["confirm"],callback: function () { window.close();}}],
      		lock: true,
      	    background: '#000000', // 背景色
      	    opacity: 0.6,	// 透明度
      	    width: '260px',
      	    drag: false,
      	    resize: false
      		});
     }
     
     function JqueryShowMessageAgreement(){
       	 art.dialog({  
             	title: l_Agreement["msg3"],
          		content: l_Agreement["msg1"],
//          		icon: 'succeed',
    			cancelVal:l_Agreement["msg2"],
    			cancel: true,
          		lock: true,
          	    background: '#000000', // 背景色
          	    opacity: 0.6,	// 透明度
          	    width: '650px',
          	    drag: false,
          	    resize: false
          		});
       	 $(".aui_border").addClass("aui_border_add");
    	}
     
     function JqueryShowMessageJustClose(strMessage){
    	 art.dialog({  
    		 title: l_artDialog["title"],
    		 content: strMessage,
    		 cancelVal:l_artDialog["confirm"],
    		 cancel: true,
    		 lock: true,
    		 background: '#000000', // 背景色
    		 opacity: 0.6,	// 透明度
    		 width: '260px',
    		 drag: false,
    		 resize: false
    	 });
     }
     
     function JqueryShowMessageJustCloseMarquee(strMessage){
    	 art.dialog({  
    		 title: l_artDialog["title"],
    		 content: strMessage,
    		 cancelVal:l_artDialog["confirm"],
    		 cancel: true,
    		 lock: true,
    		 background: '#000000', // 背景色
    		 opacity: 0.6,	// 透明度
    		 width: '40%',
    		 drag: false,
    		 resize: false
    	 });
     }
     
     function JqueryShowMessageWindowClose(strMessage) {
         $.prompt(strMessage, { persistent: true, timeout: 0, buttons: { 确定: true },submit: function(e,v,m,f){
        	 window.close();
 				},
 				overlayspeed: 5 }, 250);
     }
    // New added
    function JqueryShowMessage(strMessage) {
    	art.dialog({  
    		title: l_artDialog["title"],
    		content: strMessage,
//    		icon: 'error',
    		button: [{name: l_artDialog["confirm"],callback: function () { this.time(0);}}],
    		lock: true,
    	    background: '#000000', // 背景色
    	    opacity: 0.6,	// 透明度
    	    width: '260px',
    	    drag: false,
    	    resize: false
    		});
    }
    
    function JqueryShowMessageParent(strMessage) {
        parent.jQuery.prompt(strMessage, { persistent: true, timeout: 0, buttons: { 确定: true }, overlayspeed: 5 }, 250);
    }

    function JqueryShowMessageWithRedirect(strMessage, strURL) { art.dialog({  
 		title: l_artDialog["title"],
 		content: strMessage,
// 		icon: 'succeed',
 		button: [{name: l_artDialog["confirm"],callback: function () { window.location = strURL;}}],
 		lock: true,
 	    background: '#000000', // 背景色
 	    opacity: 0.6,	// 透明度
 	    width: '260px',
 	    drag: false,
 	    resize: false,
 	    close: function(){ window.location = strURL; }
 		});}

    function JqueryShowMessageWithTabRedirect(strMessage, strURL, intActiveTabIndex) {
        $.prompt(strMessage, { persistent: true, timeout: 0, buttons: { 确定: true }, overlayspeed: 5, callback: function () { if (strURL != '') { SetActiveTabWithUrl(intActiveTabIndex, strURL); } else { SetActiveTab(intActiveTabIndex); } } }, 250);
    }
  
    function JqueryShowMessageForFancyBox(strMessage, intTop) {
        $.prompt(strMessage, { persistent: true, timeout: 0, buttons: { 确定: true }, overlayspeed: 5 }, intTop);
    }