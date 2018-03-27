var __groupCfg = {
	"group1": [
	    {"name": "两面", "code": "LM", "tpl": "lm.html"},
	    {"name": "冠亚和", "code": "HE", "tpl": "he.html"},
	    {"name": "1-5名", "code": "1-5", "tpl": "1-5.html"},
	    {"name": "6-10名", "code": "6-10", "tpl": "6-10.html"}/*,
	    {"name": "冠军", "code": "Q1", "tpl": "1.html"},
	    {"name": "亚军", "code": "Q2", "tpl": "2.html"},
	    {"name": "第三名", "code": "Q3", "tpl": "3.html"},
	    {"name": "第四名", "code": "Q4", "tpl": "4.html"},
	    {"name": "第五名", "code": "Q5", "tpl": "5.html"},
	    {"name": "第六名", "code": "Q6", "tpl": "6.html"},
	    {"name": "第七名", "code": "Q7", "tpl": "7.html"},
	    {"name": "第八名", "code": "Q8", "tpl": "8.html"},
	    {"name": "第九名", "code": "Q9", "tpl": "9.html"},
	    {"name": "第十名", "code": "Q10", "tpl": "10.html"}*/
	],
	
	"group2": [
	    {"name": "两面", "code": "LM", "tpl": "lm.html"},
	    {"name": "1-5球", "code": "ALL", "tpl": "all.html"},
	    /*{"name": "第一球", "code": "HE", "tpl": "1.html"},
	    {"name": "第二球", "code": "Q1", "tpl": "2.html"},
	    {"name": "第三球", "code": "Q3", "tpl": "3.html"},
	    {"name": "第四球", "code": "Q4", "tpl": "4.html"},
	    {"name": "第五球", "code": "Q5", "tpl": "5.html"},*/
	    {"name": "前中后", "code": "QZH", "tpl": "qzh.html"}
	],
	
	"group3": [
	    {"name": "两面", "code": "LM", "tpl": "lm.html"},
	    {"name": "第一球", "code": "Q1", "tpl": "1.html"},
	    {"name": "第二球", "code": "Q2", "tpl": "2.html"},
	    {"name": "第三球", "code": "Q3", "tpl": "3.html"},
	    {"name": "第四球", "code": "Q4", "tpl": "4.html"},
	    {"name": "第五球", "code": "Q5", "tpl": "5.html"},
	    {"name": "第六球", "code": "Q6", "tpl": "6.html"},
	    {"name": "第七球", "code": "Q7", "tpl": "7.html"},
	    {"name": "第八球", "code": "Q8", "tpl": "8.html"},
	    {"name": "连码", "code": "LMA", "tpl": "lma.html", "multiple": false}
	],
	
	"group4": [
	    {"name": "两面", "code": "LM", "tpl": "lm.html"},
	    {"name": "第一球", "code": "HE", "tpl": "1.html"},
	    {"name": "第二球", "code": "Q1", "tpl": "2.html"},
	    {"name": "第三球", "code": "Q3", "tpl": "3.html"},
	    {"name": "第四球", "code": "Q4", "tpl": "4.html"},
	    {"name": "第五球", "code": "Q5", "tpl": "5.html"},
	    {"name": "连码", "code": "LMA", "tpl": "lma.html", "multiple": false}
	],
	
	"group5": [
	    {"name": "两面", "code": "LM", "tpl": "lm.html"},
	    {"name": "五行", "code": "WX", "tpl": "wx.html"},
	    {"name": "正码", "code": "ZM", "tpl": "zm.html"}
	],
	
	"group6": [
	    {"name": "三军", "code": "SJ", "tpl": "sj.html"},
	    {"name": "围骰", "code": "WS", "tpl": "ws.html"},
	    {"name": "点数", "code": "DS", "tpl": "ds.html"},
	    {"name": "长牌", "code": "CP", "tpl": "cp.html"},
	    {"name": "短牌", "code": "DP", "tpl": "dp.html"}
	],
	
	"group7": [
	    {"name": "特码", "code": "TM", "tpl": "tm.html", "multiple": false},
	    {"name": "两面", "code": "LM", "tpl": "lm.html", "multiple": false},
	    {"name": "正码", "code": "ZM", "tpl": "zm.html", "multiple": false},
	    {"name": "正码1-6", "code": "ZM1-6", "tpl": "zm1-6.html"},
	    {"name": "正特", "code": "ZT", "tpl": "zt.html", "multiple": false},
	    {"name": "连码", "code": "LMA", "tpl": "lma.html", "multiple": false},
	    {"name": "色波", "code": "SB", "tpl": "sb.html", "multiple": false},
	    {"name": "头尾数", "code": "TWS", "tpl": "tws.html", "multiple": false},
	    {"name": "总肖", "code": "ZOX", "tpl": "zox.html", "multiple": false},
	    {"name": "一肖", "code": "YX", "tpl": "yx.html", "multiple": false},
	    {"name": "特肖", "code": "TX", "tpl": "tx.html", "multiple": false},
	    {"name": "连肖", "code": "LX", "tpl": "lx.html", "multiple": false},
	    {"name": "合肖", "code": "HX", "tpl": "hx.html", "multiple": false},
	    {"name": "连尾", "code": "LW", "tpl": "lw.html", "multiple": false},
	    {"name": "正肖", "code": "ZX", "tpl": "zx.html", "multiple": false},
	    {"name": "五行", "code": "WX", "tpl": "wx.html", "multiple": false},
	    {"name": "自选不中", "code": "ZXBZ", "tpl": "zxbz.html", "multiple": false}
	],
	
	"group8": [
	    {"name": "混合", "code": "HH", "tpl": "hh.html"},
	    {"name": "特码", "code": "TM", "tpl": "tm.html"}
	]
};

var __lotteryCfg = {
	"50": {
		"name": "北京赛车", 
		"template": "views/lottery/templates/pk10/", 
		"numStyle": {
			"lottery": 6,
			"history": 8
		},
		"group": "group1"
	},
	"55": {
		"name": "幸运飞艇", 
		"template": "views/lottery/templates/xyft/", 
		"numStyle": {
			"lottery": 9,
			"history": 9
		},
		"group": "group1"
	},
	"1": {
		"name": "重庆时时彩", 
		"template": "views/lottery/templates/cqssc/", 
		"group": "group2"
	},
	"61": {
		"name": "重庆幸运农场", 
		"template": "views/lottery/templates/xync/",
		"group": "group3"
	},
	"21": {
		"name": "广东11选5", 
		"template": "views/lottery/templates/gd11x5/", 
		"group": "group4"
	},
	"60": {
		"name": "广东快乐十分", 
		"template": "views/lottery/templates/gdklsf/",
		"group": "group3"
	},
	"65": {
		"name": "北京快乐8", 
		"template": "views/lottery/templates/bjkl8/",
		"group": "group5"
	},
	"10": {
		"name": "江苏快3", 
		"template": "views/lottery/templates/jsk3/",
		"numStyle": {
			"lottery": 10,
			"history": 10
		},
		"group": "group6"
	},
	"70": {
		"name": "香港六合彩", 
		"template": "views/lottery/templates/lhc/",
		"numStyle": {
			"lottery": 4,
			"history": 4
		},
		"group": "group7"
	},
	"66": {
		"name": "PC蛋蛋", 
		"template": "views/lottery/templates/pcdd/",
		"group": "group8"
	}
};
function dxds(name, code){
	return {'name':name, "datas" : [{"name":"大小", "code":"size_1"},{"name":"单双", "code":"firstsd_1"}]} 
}
//{"name":"第一球" , "code":"size_1#firstsd_1", }
var __luzhuCfg = {
		"50" : {
			"row1":[{"name":"冠亚和" , "code" : "gy_nums"},{"name":"冠亚和大小" , "code" : "gy_size"},{"name":"冠亚和单双" , "code" : "gy_firstsd"}]
		},
		"55" : {
			"row1":[{"name":"冠亚和" , "code" : "gy_nums"},{"name":"冠亚和大小" , "code" : "gy_size"},{"name":"冠亚和单双" , "code" : "gy_firstsd"}]
		},
		"1" : {
			"row1":[{"name":"总和大小" , "code" : "total_size"},{"name":"总和单双 " , "code" : "total_firstsd"},{"name":"龙虎" , "code" : "lhh"}],
			"row2":[
		        	 {"name":"第一球" , "code":"size_1#firstsd_1", "datas" : [{"name":"大小", "code":"size_1"},{"name":"单双", "code":"firstsd_1"}]}
		        	,{"name":"第二球" , "code":"size_2#firstsd_2", "datas" : [{"name":"大小", "code":"size_2"},{"name":"单双", "code":"firstsd_2"}]}
		        	,{"name":"第三球" , "code":"size_3#firstsd_3", "datas" : [{"name":"大小", "code":"size_3"},{"name":"单双", "code":"firstsd_3"}]}
		        	,{"name":"第四球" , "code":"size_4#firstsd_4", "datas" : [{"name":"大小", "code":"size_4"},{"name":"单双", "code":"firstsd_4"}]}
		        	,{"name":"第五球" , "code":"size_5#firstsd_5", "datas" : [{"name":"大小", "code":"size_5"},{"name":"单双", "code":"firstsd_5"}]}
				]
		},
		"65" : {
			"row1":[{"name":"总和数" , "code" : "total"},{"name":"总和大小" , "code" : "total_size"},{"name":"总和单双 " , "code" : "total_firstsd"}]
		},
		"60" : {
			"row1":[{"name":"总和大小" , "code" : "total_size"},{"name":"总和单双" , "code" : "total_firstsd"},{"name":"总和尾大小 " , "code" : "total_zwsdx"}],
			"row2":[
			       // dxds( '第一球', 'size_1#firstsd_1'),
		        	 {"name":"第一球" , "code":"size_1#firstsd_1", "datas" : [{"name":"大小", "code":"size_1"},{"name":"单双", "code":"firstsd_1"}]}
		        	,{"name":"第二球" , "code":"size_2#firstsd_2", "datas" : [{"name":"大小", "code":"size_2"},{"name":"单双", "code":"firstsd_2"}]}
		        	,{"name":"第三球" , "code":"size_3#firstsd_3", "datas" : [{"name":"大小", "code":"size_3"},{"name":"单双", "code":"firstsd_3"}]}
		        	,{"name":"第四球" , "code":"size_4#firstsd_4", "datas" : [{"name":"大小", "code":"size_4"},{"name":"单双", "code":"firstsd_4"}]}
		        	,{"name":"第五球" , "code":"size_5#firstsd_5", "datas" : [{"name":"大小", "code":"size_5"},{"name":"单双", "code":"firstsd_5"}]}
				]
		},
		"61" : {
			"row1":[{"name":"总和大小" , "code" : "total_size"},{"name":"总和单双" , "code" : "total_firstsd"},{"name":"总和尾大小 " , "code" : "total_zwsdx"}],
			"row2":[
		        	 {"name":"第一球" , "code":"size_1#firstsd_1", "datas" : [{"name":"大小", "code":"size_1"},{"name":"单双", "code":"firstsd_1"}]}
		        	,{"name":"第二球" , "code":"size_2#firstsd_2", "datas" : [{"name":"大小", "code":"size_2"},{"name":"单双", "code":"firstsd_2"}]}
		        	,{"name":"第三球" , "code":"size_3#firstsd_3", "datas" : [{"name":"大小", "code":"size_3"},{"name":"单双", "code":"firstsd_3"}]}
		        	,{"name":"第四球" , "code":"size_4#firstsd_4", "datas" : [{"name":"大小", "code":"size_4"},{"name":"单双", "code":"firstsd_4"}]}
		        	,{"name":"第五球" , "code":"size_5#firstsd_5", "datas" : [{"name":"大小", "code":"size_5"},{"name":"单双", "code":"firstsd_5"}]}
				]
		},
		"21" : {
			"row1":[{"name":"总和大小" , "code" : "total_size"},{"name":"总和单双" , "code" : "total_firstsd"},{"name":"龙虎 " , "code" : "lh"}],
			"row2":[
		        	 {"name":"第一球" , "code":"size_1#firstsd_1", "datas" : [{"name":"大小", "code":"size_1"},{"name":"单双", "code":"firstsd_1"}]}
		        	,{"name":"第二球" , "code":"size_2#firstsd_2", "datas" : [{"name":"大小", "code":"size_2"},{"name":"单双", "code":"firstsd_2"}]}
		        	,{"name":"第三球" , "code":"size_3#firstsd_3", "datas" : [{"name":"大小", "code":"size_3"},{"name":"单双", "code":"firstsd_3"}]}
		        	,{"name":"第四球" , "code":"size_4#firstsd_4", "datas" : [{"name":"大小", "code":"size_4"},{"name":"单双", "code":"firstsd_4"}]}
		        	,{"name":"第五球" , "code":"size_5#firstsd_5", "datas" : [{"name":"大小", "code":"size_5"},{"name":"单双", "code":"firstsd_5"}]}
				]
		}
};

var jsonpNextIssueCallback = function(data) {
	
};

var jsonpCallback = function(data) {
	
}

var jsonpStatCallback = function(data) {
	
}