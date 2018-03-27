<script src="/js/common/popup.js"></script>
<body scroll="no"> 
</body>
<style>
        * { margin: 0; padding: 0; }
        body { font-family: "Microsoft Yahei"; font-size: 12px; }

        .result_frame {
            width: 100%;
            height: 100%;
            #bottom: 0px;
        }
        #mask_shadow {
            display: none;
            opacity: 0;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, .5);
        }
        #popup {
            display: none;
            #opacity: 0;
            position: absolute;
            z-index: 2;
            top: 200px;
            width: 490px;
            height: 490px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            overflow:auto;
        }
        #popup .title {
            position: relative;
            width: 100%;
            height: 45px;
            background-color: #2061b3;
            cursor: move;
        }
        #popup .title p {
            padding-left: 14px;
            line-height: 45px;
            color: #fff;
        }
        #popup .title span {
            position: absolute;
            top: 7px;
            right: 20px;
            width: 30px;
            height: 30px;
            color: white;
            opacity: .2;
            font-size: 13px;
            cursor: pointer;
            text-align: center;
            border: 1px solid #333;
        }
        #popup .title span:hover {
            opacity: .8;
        }
        #popup .cont {
            width: 100%;
            height: 445px;
            overflow: auto;
            #background-color: #EDEDED;
        }
    </style>
<script type="text/javascript">
var GameCode=160;
var TypeCode=0;
var CloseTimeSet=10;
var Round='';
var Endtime=0;
var Closetime=0;
var Isopen=false;
var myTimeout="";
var LastResult="";
var LastNumber="";
var RateTimeOut="";
</script>

<script>
    $(function () {
        /**
         ifDrag: 是否拖拽
         dragLimit: 拖拽限制范围
         */
        $('#popup').popup({ifDrag: true, dragLimit: false});
    });
</script>
	<div id='left' class="gm_left" style="overflow-x: hidden;">
    <div id="info">
<div id="popup" style="left: 397.5px; opacity: 0; top: 0px; display: none;">
    <div class="title">
        <p data-title="结果走势" style="font-size:15px"><b><span id="gm_name"></span>结果走势</b></p>
        <span>x</span>
    </div>
    <div class="cont" >
        <iframe id="resultFrame" name="resultFrame" class="result_frame" src="/result.php" scrolling="no" frameborder="0"></iframe>
    </div>
</div>
                </tr>
    </div>
    <div id="user_order"></div>
</div>
<div id="mask_shadow" style="display: none; opacity: 0;"></div>
