jQuery.fn.isChildAndSelfOf = function(b){return(this.closest(b).length>0);};
jQuery.myAjax = (function($){
    var objs={},_Evs={},_retryTimes=3;
    function LoopClass(name,opts){
        if(!name||Object.prototype.toString.call(name) !== "[object String]"){
            return false;
        }

        _Evs[name]=[];

        var me=this;
        //最后一次获取的结果数据
        me._data=null;
        //当前是否处于获取状态
        me._loading=false;
        //已经重新尝试次数
        me._trytimes=0;
        //重试轮询时间
        me._retrytime=0;
        //定时循环ID Timeout
        me._id=0;
        //最后一次ajax参数
        me._loadopt;
        //一次性处理函数
        me._fns=[];
        //当前是否处于循环状态
        me._isloop=false;
        //循环获取时间
        me._loosec=0;
        //标示
        me.name=name;
        //提交参数
        me._ajax={};

        //操作成功劫持函数
        me._success=function(data){
            data=data||{};
            me.fire(data);
            me._loading=false;
            me._loadopt=null;
            me._trytimes=0;
            me._loop();
        };

        me._load=function(opt){
            if(me._id){
                clearTimeout(me._id);
                me._id=0;
            }
            if(opt){
                me._loadopt=opt;
            }else{
                opt=me._loadopt;
            }
            if(!opt){
                opt=me._ajax;
            }
            if(!opt.url){
                // alert("参数出错,获取数据失败!");
                // throw "参数出错,获取数据失败!";
                return;
            }
            $.ajax(opt);
        };

        me._loop=function(){
            if(!me._isloop||me._loading){return false;}
            me._id=setTimeout(function(){
                me._load();
            },me._loosec);
        };

        //操作错误劫持函数
        me._error=function(data){
            ++me._trytimes;
            if(me._trytimes>=_retryTimes){
                //超出次数
                // console.log(me._loadopt);
                // alert("操作出错,获取数据失败!");
                return;
            }
            setTimeout(function(){
                me._load();
            },me._retrytime);
        };

        me.setOpt(opts);
        opts=null;
    }

    LoopClass.prototype = {
        setOpt:function(opt){
            if(!opt)return false;
            var me=this;
            opt=opt||{};
            if(opt.retrytime){
                me._retrytime=parseInt(opt.retrytime);
                opt.retrytime=null;
            }
            if(isNaN(me._retrytime)||me._retrytime<1){
                me._retrytime=12000;
            }
            me._ajax=$.extend({
                type: 'post',
                dataType: 'json',
                timeout: 9000,
                cache: false
            },opt);
            me._ajax.success=me._success;
            me._ajax.error=me._error;
            return this;
        },get:function(){
            return this._data;
        },load:function(_opt){
            //加载
            var me=this;

            _opt=_opt||{};
            if(_opt.success&&Object.prototype.toString.call(_opt.success) === "[object Function]"){
                me._fns.push(_opt.success);
            }
            me._loading=true;
            me._loadopt=$.extend({},me._ajax);
            me._loadopt=$.extend(me._loadopt,_opt);
            me._loadopt.success=me._success;
            me._loadopt.error=me._error;
            me._load(me._loadopt);
            
            return this;
        },bind:function(fn,isFire){
            //绑定事件
            var me=this;
            if(!fn||Object.prototype.toString.call(fn) !== "[object Function]"){
                return false;
            }

            //避免重复绑定
            var fns = _Evs[me.name], i = fns.length;
            while(i){
                i--;
                if(fns[i] === fn){
                    i=-1;break;
                }
            }
            if(i===0){
                _Evs[me.name].push(fn);
            }
            if(isFire){
                if(!me._loading&&me._data===null){
                    me._load();
                }else{
                    fn.call(me,me._data);
                }
            }
            return me;
        },remove:function(fn){
            //移除事件
            var fns = _Evs[this.name], i = fns.length;
            while(i){
                i--;
                if(fns[i] === fn){
                    fns.splice(i, 1);
                }
            }
            return this;
        },fire:function(data){
            //强制触发事件
            var me=this,evs,i;

            evs=me._fns;
            if(evs&&evs.length){
                for (i = evs.length - 1; i >= 0; i--) {
                    evs[i].call(me,data);
                }
                evs=[];
            }
            evs=_Evs[me.name];
            if(evs&&evs.length){
                for (i = 0; i < evs.length; i++) {
                    evs[i].call(me,data);
                }
            }
            return this;
        },loop:function(sec){
            sec=parseInt(sec);
            sec=isNaN(sec)?0:sec;
            if(sec&&(this._loosec>sec||!this._loosec)){
                this._loosec=sec>0?sec:0;
            }
            if(this._loosec&&!this._isloop){
                this._isloop=true;
                this._loop();
            }
            return this;
        },stop:function(){
            var me=this;
            if(me._id){
                clearTimeout(me._id);
                me._id=0;
            }
            me._isloop=false;
            return me;
        }
    };
    var Top={
        get:function(name,opt){
            if(!objs[name]){
                objs[name]=new LoopClass(name,opt);
            }else if(opt){
                objs[name].setOpt(opt);
            }
            return objs[name];
        }
    };
    return Top;
})(jQuery);