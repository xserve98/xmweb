!function(){
    function formatMoney(num){num=num.toString();if(num == ''){num = '0';}var num = num.replace(/,/g, ''),num = parseFloat(num),re = /(-?\d+)(\d{3})/;if(Number.prototype.toFixed){num = (num).toFixed(2);}else{num = Math.round(num*100)/100;}num  =  '' + num;while(re.test(num)){num = num.replace(re,"$1,$2");}return num;}
    $.myAjax.get('money').bind(function(data){
        if(data.status=='ok'){
            $('#balance').text('余额 : '+data.money+'元');
        }
        $('#balance-loader').removeClass().addClass('reload');
    });

    $('#balance-loader').on('click',function(){
        if(!$(this).hasClass('reload')){
            return false;
        }
        $('#balance-loader').removeClass().addClass('loading');
        $.myAjax.get('money').load();
    });

    var LeftTimes = [],Dones=[],jCountdown = null,config,
        LastTimeId=0,
        cardTimeId=0,
        cardTimeId2=0,
        $betarea,
        $betrows,
  
        $curissue,
        $lastissue,
        $money;

    function isDone(num){
        for(var i = Dones.length-1;i>=0;--i){if(Dones[i]==num){return true;}}return false;
    }

    var fn_countdown = function(){
        if(LeftTimes[1]){
            if(!isDone(LeftTimes[0].num)){
                Dones.push(LeftTimes[0].num);
                Dones.length>10&&Dones.shift();
            }
            LeftTimes.splice(0,1);
        }
        $curissue.text(LeftTimes[0].num);
        jCountdown&&jCountdown.time(LeftTimes[0].time*1000);
     
        backCard(LeftTimes[0].time);
        frontCard((config.delay+8)*1000);
    }

    $.myAjax.get('getcodemoney',{
        data:{cid:36} , url: '/glpage/cj/lottery/niuniukj.php'
    }).bind(function(data){
        if(!data.status||data.status!='ok'){return false;}
      
    }).loop(10000);

    $.myAjax.get('getnowtime',{
        data:{cid:36} , url: '/lottery/class/Odds_25.php'
    }).bind(function(data){
        if(!data.status||data.status!='ok'){return false;}
        for(var i=data.data.length-1;i>=0;--i){
            if(isDone(data.data[i])){data.data.splice(i,1);}
        }
        LeftTimes = data.data;
        if(LeftTimes.time<=0){
            LeftTimes.time = LeftTimes.time + LeftTimes.time;
            fn_countdown();
            return false;
        }
        jCountdown&&jCountdown.time(LeftTimes[0].time*1000);
        $curissue&&$curissue.text(LeftTimes[0].num);
    }).loop(60000);

    function getStatusTxt(codes){
        var ret = getStatus(codes);
        if(ret>=800){
            return '同花顺';
        }
        if(ret>=700){
            return '五小牛';
        }
      
        if(ret>=600){
            return '炸弹 ';
        }
    if(ret>=500){
            return '金牛';
        }
        if(ret>=100){
            var names = ['牛','一','二','三','四','五','六','七','八','九'];
            return '牛'+names[ret%10];
        }
        return '无牛';
    }


    function codesort(arr,n,m){
        var i,r=0,_vn = arr[n],_vm = arr[m];
        _vn
        for(var i=0;i<5;++i){
            n!=i&&m!=i&&(arr[r++]=arr[i]);
        }
        arr[3] = _vn;
        arr[4] = _vm;
    }
    function getStatus($codes){
        var fn_sort = function compare(v1,v2){
            if((v1*1)>(v2*1)){
                return 1;
            }else if(v1 == v2){
                return 0;
            }
            return -1;
        } 
        $codes.sort(fn_sort);
        $codes[0] *= 1,$codes[1] *= 1,$codes[2] *= 1,$codes[3] *= 1,$codes[4] *= 1;
        var $a1 = [],$b1 = [],$isTH,$isSZ;
        for(var i in $codes){
            $a1.push(Math.floor($codes[i]/4)+1);
            $b1.push($codes[i]%4);
        }
       // $isTH = ( $b1[4]==$b1[3]&&$b1[3]==$b1[2]&&$b1[2]==$b1[1]&&$b1[1]==$b1[0]);
        //$isSZ = (($a1[4]-$a1[3])==1&&($a1[3]-$a1[2])==1&&($a1[2]-$a1[1])==1&&($a1[1]-$a1[0])==1);
        //同花顺
        if($isTH&&$isSZ)return 800+$codes[4];
        //小小牛 总点不超过10
        if(($a1[0]+$a1[1]+$a1[2]+$a1[3]+$a1[4])<10)return 700+$codes[4];
        //金牛 五张花牌
      
        var $testNum = {},$max = 0,$maxCode = 0,$v,n=0;
        for(i in $a1){
            $v = $a1[i];
            if(!$testNum[$v]){
                $testNum[$v] = 1;
                ++n;
            }else{
                ++$testNum[$v];
            }
            if($testNum[$v]>$max){
                $maxCode = $v;
                $max = $testNum[$v];
            }
        }
        //炸弹
        if($max==4)return 600+$maxCode;
	   if($a1[0]>10&&$a1[1]>10&&$a1[2]>10&&$a1[3]>10&&$a1[4]>10) return 500+$codes[4];
     
        //同花
        if($isTH)return 300+$codes[4];
        //顺子
        if($isSZ)return 200+$codes[4];
        //牛
        for(i in $a1){
            $v = $a1[i];
            $a1[i]=$v>10?10:$v;
        }
        $ret = 0;
        if(($a1[0]+$a1[1]+$a1[2])%10==0){
            $ret = $a1[3]+$a1[4];
        }else if(($a1[0]+$a1[1]+$a1[3])%10==0){
            codesort($codes,2,4);
            $ret = $a1[2]+$a1[4];
        }else if(($a1[0]+$a1[2]+$a1[3])%10==0){
            codesort($codes,1,4);
            $ret = $a1[1]+$a1[4];
        }else if(($a1[1]+$a1[2]+$a1[3])%10==0){
            codesort($codes,0,4);
            $ret = $a1[0]+$a1[4];
        }else if(($a1[0]+$a1[1]+$a1[4])%10==0){
            codesort($codes,2,3);
            $ret = $a1[2]+$a1[3];
        }else if(($a1[0]+$a1[2]+$a1[4])%10==0){
            codesort($codes,1,3);
            $ret = $a1[1]+$a1[3];
        }else if(($a1[1]+$a1[2]+$a1[4])%10==0){
            codesort($codes,0,3);
            $ret = $a1[0]+$a1[3];
        }else if(($a1[0]+$a1[3]+$a1[4])%10==0){
            codesort($codes,1,2);
            $ret = $a1[1]+$a1[2];
        }else if(($a1[1]+$a1[3]+$a1[4])%10==0){
            codesort($codes,0,2);
            $ret = $a1[0]+$a1[2];
        }else if(($a1[2]+$a1[3]+$a1[4])%10==0){
            codesort($codes,0,1);
            $ret = $a1[0]+$a1[1];
        }
        if(!$ret){
            //无牛
            $ret = $codes[4];
        }else{
            //有牛
            $ret = $ret%10;
            //牛牛
            if($ret==0){$ret = 10;}
            $ret += 100;
        }
        return $ret;
    }

    function backCard(n){
        cardTimeId&&clearTimeout(cardTimeId);
        cardTimeId = setTimeout(function(){
            cardTimeId = 0;
            $betarea.removeClass('card-on');
        },n);
    }

    function frontCard(n){
        cardTimeId2&&clearTimeout(cardTimeId2);
        cardTimeId2 = setTimeout(function(){
            cardTimeId2 = 0;
            $.myAjax.get('getresult').load();
        },n);
    }

    $.myAjax.get('getresult',{
        data:{cid:36} , url: '/glpage/cj/lottery/niuniukj.php'
    }).bind(function(data){
        if(!data.status||data.status!='ok'){return false;}
        if(data.issue==$lastissue.text()){
            frontCard(10000);
            return false;
        }
        $lastissue.text(data.issue);
        var codes = data.code.split(';'),codestr=[],$txtStatus = $betarea.find('.betrow .status span'),i;
        for (i in codes) {
            codes[i] = codes[i].split(',');
            codestr[i] = getStatusTxt(codes[i]);
        }
        LastTimeId&&clearTimeout(LastTimeId);
        $txtStatus.text('');
        i=0;
        $betarea.find('.cardrow').each(function(){
            $(this).find('.front').each(function(n,elem){
                this.className = 'front poker_'+codes[i][n];
            });
            ++i;
        });
        $betarea.addClass('card-on');
        LastTimeId = setTimeout(function(){
            $('#last-code-zj').text('庄：'+codestr[0]);
            $('#last-code').text('天：'+codestr[1]+'  地：'+codestr[2]+'  玄：'+codestr[3]+'  黄：'+codestr[4]+'');
            $txtStatus.eq(0).text(codestr[0]);
            $txtStatus.eq(1).text(codestr[1]);
            $txtStatus.eq(2).text(codestr[2]);
            $txtStatus.eq(3).text(codestr[3]);
            $txtStatus.eq(4).text(codestr[4]);
        },1200);
        if(Dones[Dones.length-1]>data.issue){
            backCard(5000);
            frontCard(10000);
        }
    });

    $(function(){
        config = $.pagedata;
        $.pagedata = null;
        config.delay = (parseInt(config.delay)||0);

        $curissue = $('#curissue');
        $lastissue = $('#last-issue');
        $betarea  = $('#betarea');
        $betrows  = $betarea.children();

        jCountdown = $('#countdown').jCountdown({
            time: 0,
            style: "flip",
            color: "white",
            width: 0,
            textGroupSpace: 15,
            textSpace: 0,
            reflection: false,      //倒影
            reflectionOpacity: 0,
            reflectionBlur: 0,
            dayTextNumber: 0,
            displayDay: false,
            displayHour: true,
            displayMinute: true,
            displaySecond: true,
            displayLabel: false,
            onFinish:fn_countdown
        })[0].jCountdown;
        $.myAjax.get('getnowtime').load();
        $.myAjax.get('getresult').load();
        $.myAjax.get('getcodemoney').load();

        $('#game-help').html('<i class="help-close"></i><div class="helpwrap"> <h3>游戏用牌:</h3> <p>一副扑克牌,去除大、小王,52张牌。</p> <h3>游戏说明:</h3> <p>牌局开始每个人手中都有五张牌，牌面点数J、Q、K都是10点，然后A是当1点，其它的牌型当自身点数。然后玩家需要将手中任意三张牌凑成10点或者20点或者30点都可以，这样是被称为“牛”。接下来在将其余的两张点数相加得出几点。去掉是位数，只留个位数进行比较，如果接下来两张相加点数也正好是整数的话，那就是很大的牌型：“金牛”“牛牛”等。</p> <h3>牌型说明:</h3> <table><thead><tr> <th style="width: 88px;">牌型</th> <th>组合方式</th> <th style="width: 40px;">倍率</th> </tr> </thead><tbody> <tr> <td>五小牛</td><td class="desc">五张牌点数五张牌的牌点数加起来不超过10，不含10</td><td>7</td> </tr> <tr> <td>炸弹</td><td class="desc">四张点数相同的牌</td><td>6</td> </tr><tr> <td>金牛</td><td class="desc">五张花牌为金牛,J、Q、K是花牌</td><td>5</td> </tr><tr> <td>牛牛</td><td class="desc">任意三张牌和为10的整数倍，另外两张牌之和为10的整数倍</td><td>4</td></tr><tr> <td>牛九</td><td class="desc">任意三张牌和为10的整数倍，另外两张牌之和为尾数为8</td><td>3</td> </tr> <tr> <td>牛八</td><td class="desc">任意三张牌和为10的整数倍，另外两张牌之和为尾数为8</td><td>2</td> </tr><tr> <td>有牛</td><td class="desc">任意三张牌和为10的整数倍，如果另外两张牌之和不为10的整数倍，则根据这两张牌的个数位为该副牌的分数，为有牛牌</td><td>1</td> </tr> <tr> <td>无牛</td><td class="desc">任意三张牌之和为10的整数倍，则判定该牌为无牛</td><td>1</td> </tr> </tbody> </table><h3>牌型大小:</h3> <p>五小牛&gt;炸弹&gt;金牛&gt;牛牛&gt;牛九&gt;牛八&gt;牛七&gt;牛六&gt;牛五&gt;牛四&gt;牛三&gt;牛二&gt;牛一&gt;无牛<br>当玩家同时出现相同点数（或者相同类型的特殊牌）时，系统自动将两家手中牌的最大一张进行比较，谁大就由谁获得胜利。如果出现牌也相同大的话，就按花色来进行比较。其中，同是炸弹，比炸弹谁大（55551 >44441）;同时五小牛，庄家胜。。</p> </div>').css({top:($('.help-more').offset().top+56)+'px'}).on('click','.help-close',function(){$(this).parent().hide()});

        // $('#game-help-zj').html('<i class="help-close"></i><div class="helpwrap"> <h3>庄家说明:</h3> <p>玩家可以扣除一定押金成为本房间庄家,上庄后自行承担所有亏盈,并且每期需要向平台支付 收单总金额 0.5% 的手续费用。</p> <h3>上庄条件:</h3> <p>1.当前没有玩家做庄家。<br/>2.账号余额不低余 10000 元(押金保障)。</p> <h3>关于上庄押金:</h3> <p>押金用于支付其他玩家的下注奖金,每期开奖后自动结算,下庄结算后自动返回账户余额。<br/>押金金额决定庄家收单额度,计算方式为 金额/10/4:<br/>&nbsp;&nbsp;&nbsp;&nbsp;如 当前押金为10000,则可以对玩家收单  10000/10/4 = 250元,即牛牛天、地、玄、黄最多只能分别收单 250元,玩家下注超过部分自动改为向平台投注。</p> <h3>上庄细则:</h3> <p>1.本房间没有庄家的情况下,庄家为本官方平台,符合上庄条件可以申请上庄。<br/>2.上庄后会自动扣除押金金额,押金金额每期结算一次,押金不满足条件则系统自动下庄。</p></div>').css({'left':'50%',top:($('.help-zj').offset().top+38)+'px','margin-left':'-470px'}).find('.help-close').on('click',function(){$(this).parent().hide()});

        $('.reload').on('click',function(){$('#game-help').show().next().hide();});
        // $('.help-zj').on('click',function(){$('#game-help-zj').show().prev().hide();});
        
        $('#betarea').on('click','.selrow',function(){
            var par = $(this).parent();
            if(par.index()>0){
                if(par.hasClass('selected')){
                    par.removeClass('selected');
                }else{
                    $(this).parent().addClass('selected')/*.siblings().removeClass('selected')*/;
                }
            }
            return false;
        });

        $('#btn-submit').on('click',function(){
            var me = $(this),layer=window.layer,postdata={},postiss,postmoney,pos,total=0;
            if(me.hasClass('disabled')){
                return false;
            }
            postmoney = parseInt($money.val());
		
            if(isNaN(postmoney)||postmoney<1){
             layer.alert('请先输入下单金额!',{move:false,icon:2,btn:['知道了']});
			      /// layer.msg("请先输入下单金额！");
				 //showMsg("请先输入下单金额！！")
                return false;
            }
            postiss = $betarea.children('.selected');
            if(!postiss.length){
                layer.alert('请先选择投注内容!',{move:false,icon:2,btn:['知道了']});
                return false;
            }
			
            var rows = [['庄','z'],['天','t'],['地','d'],['玄','x'],['黄','h']],fn_submit = function(){
                layer.alert('<div style="text-align:center;"><img src="/newdsn/images/loadding.gif" border="0"></div>',{move:false,area:'400px',title:'正在提交投注...',closeBtn :0,btn:false});
                $.ajax({
                    url:'/Lottery/Order/Order6.php?type=25',data:{
                        cid:config.cid,
                        issue:postiss,
                        types:config.types,
                        moneys:total,
                        data:postdata
                    },
                    type:'POST',dataType:'json',timeout:8000,
                    success:function(data){
                        me.removeClass('disabled');
						
                        if(data.status=='ok'){
                            $('.betitem .chip').remove();
							   var html = getOrdersHtml(data);
					///console.log(html);
                       $(window.parent.document).find("#info").hide();
                $(window.parent.document).find("#user_order").html(html).show();
				  $(window.parent.document).find('#balance').html(data.balance);
                            layer.alert('投注成功',{icon:1});
                        }else{
                            layer.alert(data.info,{icon:2});
                        }
						
						/// var data = eval( "(" + data + ")" );
		   //  ///console.log(data);
		     // ///console.log('data.code='+data.code);
               /* if(data.code == 0) {
                 
                    formReset();
                } else if(data.code == 1) {
                    layer.msg(data.info);
                } else if(data.code == 2) {
                    layer.msg(data.info);
                 ///   location.replace(location.href);
                } else {
                  //  window.top.location = "/";
                }*/
          
						
						
						
                    },error:function(){
                        me.removeClass('disabled');
                        window.layer.alert('投注失败,网络连接出错!');
                    }
                });
            }
            var htmls='',mnTxt = formatMoney(postmoney);
            htmls='</td><tr class="issdetail"><td>详情 :</td><td><div class="issuelist"><table>';

            postiss.each(function(){
                htmls+='<tr><td class="type">[ '+this.getAttribute('rowText')+' ]</td><td class="codes">'+mnTxt+'</td></tr>';
                ;
                postdata[this.getAttribute('rowKey')] = postmoney;
                total += postmoney;
            });

            postiss = LeftTimes[0].num;
            htmls='第 <b class="red">'+postiss+'</b> 期'+htmls;
            htmls+='</table></div></td><tr><td>&nbsp;&nbsp;投注金额 :</td><td>共 ￥ '+formatMoney(total)+' 元</td></tr><tr><td>&nbsp;&nbsp;担保金额 :</td><td>共 ￥ '+formatMoney(total*6)+' 元</td></tr><tr><td>&nbsp;&nbsp;总计 :</td><td>共 ￥<b> '+formatMoney(total*7)+'</b> 元</td></tr></tbody></table></div>';
            htmls='<div class="betConfirm"><table class="cfmtable"><tbody><tr><td>游戏 :</td><td><b class="red">'+config.lottery+'</b></td></tr><tr><td>期号 :</td><td>'+htmls;

            layer.alert(htmls,{skin:'betConfirm-layer',area: '412px',move:false,yes:fn_submit,title:'投注确认',btn:['确认投注','取&nbsp;&nbsp;消']});
        });

        $money = $('#money');
        $money.focus(function(){
            if(this.value==this.getAttribute('ip-placehold')){
                this.value = '';
            }
            $(this).removeClass('placeholder');
        }).blur(function(){
            if(this.value == ''){
                this.value = this.getAttribute('ip-placehold');
                $(this).addClass('placeholder');
            }
        }).val($money[0].getAttribute('ip-placehold')).addClass('placeholder').on('keyup',function(){var v = parseInt(this.value);this.value =isNaN(v)?'':v;});
    })
}();