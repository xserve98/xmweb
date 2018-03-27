(function($){
    $.fn.dialog=function(flag,options){
        var opts = $.extend({}, $.fn.dialog.options, options);
        var popDiv = this; 
         if(flag=="close" && popDiv.is(":visible")){
            if(popDiv.data("popWarp")){
                popDiv.data("popWarp").remove();
            }
            popDiv.hide();
            return;
        }
        var maxH = $(document).height()+"px";
        var maxW = $(window).width()+"px";
        var winX = ($(window).width()- popDiv.width())/2 + "px";
        var winY = ($(window).height()- popDiv.height())/2 + $(window).scrollTop() + "px";
        var popWarp=$("<div/>").addClass(opts.popWarp);
        if(flag=="open" && popDiv.is(":hidden")){
            popDiv.data("popWarp",popWarp);
            popDiv.after(popWarp);
            popWarp.css({width:maxW,height:maxH,left:"0px",top:"0px","z-index":opts.zindex});
            popDiv.css({left:winX,top:winY,"z-index":(opts.zindex+1)});
            popDiv.show();
        
        }
        $(window).resize(function(){
            var maxH = $(document).height()+"px";
            var maxW = $(window).width()+"px";
            var winX = ($(window).width()- popDiv.width())/2 + "px";
            var winY = ($(window).height()- popDiv.height())/2 + $(window).scrollTop() + "px";
            popDiv.css({left:winX,top:winY});
            popWarp.css({width:maxW,height:maxH,left:"0px",top:"0px"});
        });
        $(opts.closeWin).click(function(){
            if(popDiv.data("popWarp")){
                popDiv.data("popWarp").remove();
            }
            popDiv.hide();
            try{
            if (objfocus) {
                objfocus.focus();
            }
            }catch (e){
            }
        });
        // 判断是否需要滚动;
        var con={
            scrol:function(kg){
                if(kg!="off"){
                    $(window).bind("scroll.popWin"+popDiv.attr("id"),function (){
                            var offsetTop = ($(window).height()- popDiv.height())/2 + $(window).scrollTop() +"px"; 
                            popDiv.animate({top : offsetTop },{duration:380 , queue:false });  
                    });
                }else{
                    $(window).unbind("scroll.popWin"+popDiv.attr("id"));
                }
            }
        };
        con.scrol("");
        return con;
    };
    $.fn.dialog.options={
        closeWin:".closeWin",
        popWarp:"popWarp",
        zindex:999
    };
    $.fn.popWin=function(closeId,scrolls){
        var popDiv = this; 
        var maxH = $(document).height()+"px";
        var maxW = $(window).width()+"px";
        var winX = ($(window).width()- popDiv.width())/2 + "px";
        var winY = ($(window).height()- popDiv.height())/2 + $(window).scrollTop() + "px";
        this.after("<div class='popWarp'></div>");
        $(".popWarp").css({width:maxW,height:maxH,left:"0px",top:"0px"});
        popDiv.css({left:winX,top:winY});
        popDiv.show();
        $(window).resize(function(){
            var maxH = $(document).height()+"px";
            var maxW = $(window).width()+"px";
            var winX = ($(window).width()- popDiv.width())/2 + "px";
            var winY = ($(window).height()- popDiv.height())/2 + $(window).scrollTop() + "px";
            popDiv.css({left:winX,top:winY});
            $(".popWarp").css({width:maxW,height:maxH,left:"0px",top:"0px"});
        });
        popDiv.find(closeId).click(function(){
            $('#dialog1').dialog('close');
            $(".popWarp").remove();
            popDiv.hide();
        });
    // 判断是否需要滚动;
    if(scrolls){
        var menuYloc = popDiv.offset().top;
        $(window).scroll(function (){
            var offsetTop = ($(window).height()- popDiv.height())/2 + $(window).scrollTop() +"px"; 
            popDiv.animate({top : offsetTop },{duration:380 , queue:false });  
        });
    }
    };
    
    $.fn.fileLoad=function(flag,options){
        var opts = $.extend({}, $.fn.dialog.options, options);
        var popDiv = this; 
         if(flag=="close" && popDiv.is(":visible")){
            if(popDiv.data("popWarp")){
                popDiv.data("popWarp").remove();
            }
            var div = document.getElementById("fileLoad");
            div.style.display = "none";
            popDiv.hide();
            $(".popWarp").hide();
            return;
        }
        if(flag=="open"){
            popDiv.show();
        }
        $(window).resize(function(){
            var maxH = $(document).height()+"px";
            var maxW = $(window).width()+"px";
            var winX = ($(window).width()- popDiv.width())/2 + "px";
            var winY = ($(window).height()- popDiv.height())/2 + $(window).scrollTop() + "px";
            popDiv.css({left:winX,top:winY});
            popWarp.css({width:maxW,height:maxH,left:"0px",top:"0px"});
        });
        $(opts.closeWin).click(function(){
            if(popDiv.data("popWarp")){
                popDiv.data("popWarp").remove();
            }
            popDiv.hide();
            try{
            if (objfocus) {
                objfocus.focus();
            }
            }catch (e){
            }
        });
        // 判断是否需要滚动;
        var con={
            scrol:function(kg){
                if(kg!="off"){
                    $(window).bind("scroll.popWin"+popDiv.attr("id"),function (){
                            var offsetTop = ($(window).height()- popDiv.height())/2 + $(window).scrollTop() +"px"; 
                            popDiv.animate({top : offsetTop },{duration:380 , queue:false });  
                    });
                }else{
                    $(window).unbind("scroll.popWin"+popDiv.attr("id"));
                }
            }
        };
        con.scrol("");
        return con;
    };
    

})(jQuery);