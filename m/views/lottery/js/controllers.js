angular.module('ionicz.lottery')

.controller('BaseCtrl', ['$scope', 'Lottery', function($scope, Lottery) {
	Lottery.init();	

	$scope.gameList = Lottery.getGameList();

	$scope.open = function(path) {
		$window.location.href = path;
	};
}])

.controller('ListCtrl', function($scope, $window, $log, Lottery, $ionicPopover) {
	$log.debug("ListCtrl...");

	$ionicPopover.fromTemplateUrl('views/lottery/templates/list-poper.html', {
		scope: $scope
	}).then(function(popover) {
        $scope.popover = popover;
	});
	
	$scope.showPoper = function($event) {
		$scope.countMoneyState = 0;
		Lottery.getLotteryData(function(data) {
			$scope.unbalancedMoney = data.unbalancedMoney;
			$scope.countMoneyState = 1;
		});
		$scope.popover.show($event);
	};
	
	/*var mainTimer = $interval(function() {
		$scope.$broadcast('lotteryListTimer');
	}, 10000);*/
	
	$scope.$on('$destroy', function() {
		$log.debug('游戏大厅Ctrl销毁，发送广播消息，用于触发销毁定时器');
		// 游戏Ctrl销毁，发送广播消息，用于触发销毁定时器
	    $scope.$broadcast('lotteryListDestroy');
	});
	
})

.controller('LotteryCtrl', function($scope, $timeout, $log, $filter, $stateParams, $ionicPopover, Lottery, Tools, My, $ionicScrollDelegate) {
	$log.debug("LotteryCtrl...");
	
	$scope.gameId = $stateParams.gameId;
	var tpl = {};
	
	$scope.$on('$destroy', function() {
		$log.debug('游戏Ctrl销毁，发送广播消息，用于触发销毁定时器');
		// 游戏Ctrl销毁，发送广播消息，用于触发销毁定时器
	    $scope.$broadcast('lotteryDestroy');
	});
	
	Lottery.initGame($scope.gameId, function() {
		$log.debug('--------------init---------------');
		$scope.game = Lottery.getGame($scope.gameId);
		
		tpl = Lottery.getTpl($scope.gameId);
		$scope.panes = Lottery.getPanes();
		$scope.currPane = Lottery.getDefaultPane();
		$scope.contentTpl = Lottery.getContentTpl($scope.currPane);
		
		$timeout(function() {
			$scope.$broadcast('lotteryInited');
		}, 100, false);
	});
	
	/**
	 * 用于存放与下级作用域共享数据的对象
	 */
	$scope.shareData = {
		betCount: 0 // 当前下注总数
	};
	
	// 当前游戏选中的下注信息，保存的格式：{"LM": [1001,1003], "Q1": [2001,2002]}
	$scope.betData = {};
	
	$ionicPopover.fromTemplateUrl('views/lottery/templates/lottery-poper.html', {
		scope: $scope
	}).then(function(popover) {
        $scope.popover = popover;
	});
	
	$scope.showPoper = function($event) {
		$scope.countMoneyState = 0;
		Lottery.getLotteryData(function(data) {
			$scope.unbalancedMoney = data.unbalancedMoney;
			$scope.totalTotalMoney = data.totalTotalMoney;
			$scope.countMoneyState = 1;
		});
		$scope.popover.show($event);
	};
	
	$scope.showRole = function() {
		Tools.modal({
			title: $scope.game.name,
			templateUrl: "/views/lottery/templates/role/role_" + $scope.gameId + ".html",
			css: 'role-poput',
			callback: function(scope, popup) {
				popup.close();
			}
		});
	};
	
	$scope.selectCate = function(pane) {
		$scope.contentTpl = Lottery.getContentTpl(pane);
		
		if($scope.currPane.multiple === false || pane.multiple === false) {
			$scope.reset();
		}

		$scope.selectSub = null;
		$scope.currPane = pane;
	};
	
	/**
	 * 判断玩法ID是否已经选中
	 */
	$scope.isExist = function(dataId) {
		var dataList = $scope.betData[$scope.currPane.code] || [];
		return dataList.indexOf(dataId) > -1;
	};
	
	/**
	 * 选中
	 */
	$scope.addDataId = function(dataId) {
		var paneCode = $scope.currPane.code;
		if(!paneCode || !dataId) {
			return;
		}
		
		var dataList = $scope.betData[paneCode] || [];
		dataList.push(dataId);
		$scope.betData[paneCode] = dataList;
		calcCount();
	};
	
	/**
	 * 取消选中
	 */
	$scope.removeDataId = function(dataId) {
		var paneCode = $scope.currPane.code;
		if(!paneCode || !dataId) {
			return;
		}
		
		var dataList = $scope.betData[paneCode] || [];
		var index = dataList.indexOf(dataId);
		if(index > -1) {
			dataList.splice(index, 1);
		}
		$scope.betData[paneCode] = dataList;
		calcCount();
	};
	
	/**
	 * 计算注数
	 */
	var calcCount = function() {
		var betCount = 0;
		for(var code in $scope.betData) {
			if($scope.betData[code]) {
				betCount += $scope.betData[code].length;
			}
		}
		
		$scope.shareData.betCount = betCount;
	};
	
	/**
	 * 保存特殊玩法选中的号码
	 */
	$scope.addNum = function(num) {
		var paneCode = $scope.currPane.code;
		
		var dataList = $scope.betData[paneCode] || [];
		if(dataList.indexOf(num) > -1) {
			return true;
		}
		
		if(dataList.length >= $scope.selectSub.max) {
			Tools.tip('不允许超过' + $scope.selectSub.max + '个选项');
			return false;
		}
		
		dataList.push(num);
		$scope.betData[paneCode] = dataList;
		calcSubCount();
		return true;
	};
	
	/**
	 * 移除特殊玩法选中号码
	 */
	$scope.removeNum = function(num) {
		var paneCode = $scope.currPane.code;
		var dataList = $scope.betData[paneCode] || [];
		var index = dataList.indexOf(num);
		if(index > -1) {
			dataList.splice(index, 1);
		}
		$scope.betData[paneCode] = dataList;
		calcSubCount();
		return true;
	};
	
	var getComs = function(min, len) {
		return choose(len, min);
	};
	
	/**
	 * 计算注数
	 */
	var calcSubCount = function() {
		var paneCode = $scope.currPane.code;
		var dataList = $scope.betData[paneCode] || [];
		
		// 合肖特殊处理
		if($scope.selectSub.type == 'HX') {
			if(dataList.length < $scope.selectSub.min) {
				$scope.shareData.odds = [];
				$scope.shareData.betCount = 0;
			}
			else {
				var startPlayId = parseInt($scope.selectSub.id);
				var playId = startPlayId + dataList.length;
				var play = Lottery.getPlay(playId);
				$scope.shareData.odds = [play.odds];
				$scope.shareData.betCount = 1;
			}
		}
		else {
			var coms = getComs($scope.selectSub.min, dataList.length);
			if(!coms) {
				$scope.shareData.betCount = 0;
				return;
			}
			
			$scope.betSubArray = [];
			for(var i=0; i<coms.length; i++) {
				var childs = coms[i];
				var nums = [];
				for(var j=0; j<childs.length; j++) {
					nums.push(dataList[childs[j]]);
				}
				$scope.betSubArray.push(nums);
			}
			
			$scope.shareData.betCount = $scope.betSubArray.length;
		}
	};
	
	$scope.getPlayIdArray = function() {
		var playIdArray = [];
		for(var key in $scope.betData) {
			var betData = $scope.betData[key] || [];
			playIdArray = playIdArray.concat(betData);
		}
		
		return playIdArray;
	};
	
	/**
	 * 重置下注区域
	 */
	$scope.reset = function() {
		$scope.betData = {};
		$scope.shareData.odds = [];
		$scope.shareData.betCount = 0;
		$('.bet-view').find('.bet-choose').removeClass('bet-choose');
	};
	
	/**
	 * 选中第一个玩法子类型
	 */
	$scope.selectFirstSub = function($event) {
		var navItems = $('#sub-navs').find('.nav-item');
		if(navItems.length > 0) {
			subInit(angular.element(navItems[0]));
		}
	};
	
	/**
	 * 玩法子类选中
	 */
	$scope.selectSubnav = function(index, $event) {
		$scope.reset();
		$scope.shareData.subIndex = index;
		$ionicScrollDelegate.$getByHandle('sub-navs').scrollTo(45 * (index - 1) * 1.3, 0, true);
		if($event) {
			var element = angular.element($event.target);
			subInit(element);
		}
	};
	
	var subInit = function(element) {
		var dataId = element.attr('data-id');
		if(!dataId) {
			return;
		}
		
		$scope.shareData.odds = [];
		
		var ids = dataId.split('|');
		$scope.selectSub = {id: ids[0], min: element.attr('min-size'), max: element.attr('max-size'), text: element.html(), type: element.attr('play-type')};
		if(ids.length == 1) {
			var play = Lottery.getPlay(ids[0]);
			if(play) {
				$scope.shareData.odds.push(play.odds);
			}
		}
		else {
			// 六合彩连码，三全中和二中特会出现2种赔率的情况
			for(var i=0; i<ids.length; i++) {
				var play = Lottery.getPlay(ids[i]);
				if(play) {
					$scope.shareData.odds.push(play.odds);
				}
			}
		}
	};
	
	var checkPlayMoney = function(play, betMoney, totalMoney) {
		var minMoney = play.minMoney;
		var maxMoney = play.maxMoney;
		var maxTurnMoney = play.maxTurnMoney;
		
		if (betMoney < minMoney) {
			Tools.tip('最小投注金额为：' + minMoney);
			return false;
		}
		
		if (betMoney > maxMoney) { 
			Tools.tip('最大投注金额为：' + maxMoney);
			return false;
		}
		
		if (totalMoney > maxTurnMoney) {
			Tools.tip('当前期设定的最大投注金额为：' + maxTurnMoney);
			return false;
		}
		
		return true;
	};
	
	$scope.bet = function() {
		if(!$scope.shareData.betMoney) {
			Tools.tip('请输入投注金额');
			return;
		}
		
		if(!$scope.shareData.betCount) {
			Tools.tip('请选择玩法');
			return;
		}
		
		var confirmHtml = '<ion-scroll direction="y">';
		var betCount = parseInt($scope.shareData.betCount);
		var betMoney = parseInt($scope.shareData.betMoney);
		var totalMoney = betCount * betMoney;
		var betParams = {};
		var postcodeendtime = lt_timer2(nextIssueData.endtime);
		//console.log(nextIssueData.endtime);
		betParams["gameId"] = $scope.gameId;
		betParams["turnNum"] = $scope.shareData.curIssue;
		betParams["totalNums"] = betCount;
		betParams["totalMoney"] = totalMoney;
		betParams["betSrc"] = 0;
		betParams["ftime"] = postcodeendtime;
		
		// 特殊玩法
		if($scope.selectSub) {
			if($scope.selectSub.type == 'LXLW') {
				var betSubArray = $scope.betSubArray;
				for(var i in betSubArray) {
					var playIdArray = betSubArray[i];
					
					var odds = 0;
					var betInfo = [];
					var playIds = [];
					var playId = 0; // 赔率最小的ID
					for(var j in playIdArray) {
						var play = Lottery.getPlay(playIdArray[j]);
						if(odds == 0) {
							odds = play.odds;
							playId = play.id;
						}
						else if(play.odds < odds) {
							odds = play.odds;
							playId = play.id;
						}
						betInfo.push(play.alias);
						playIds.push(play.id);
					}
					
					betParams["betBean[" + i + "][playId]"] = playId;
					betParams["betBean[" + i + "][money]"] = betMoney;
					betParams["betBean[" + i + "][betInfo]"] = betInfo.join(',');
					betParams["betBean[" + i + "][playIds]"] = playIds.join(',');
					confirmHtml += '<div>【' + $scope.selectSub.text + ' ' + betInfo.join(',') + '】 @' + odds + ' x ' + betMoney + '</div>';
				}
				
				confirmHtml += '<div class="split-line"></div>';
				confirmHtml += '<div>【合计】组数：<span class="t-blue" style="margin-right:15px">' + betCount + '</span>总金额：<span class="t-blue">' + totalMoney + '</span></div>';
			}
			else if($scope.selectSub.type == 'HX') {
				var paneCode = $scope.currPane.code;
				var dataList = $scope.betData[paneCode] || [];
				if(dataList.length == 0) {
					Tools.tip('下注内容为空');
					return;
				}
				
				var playId = parseInt($scope.selectSub.id) + dataList.length;
				var play = Lottery.getPlay(playId);
				if(!checkPlayMoney(play, betMoney, totalMoney)) {
					return;
				}
				
				var betInfo = dataList.join(',');
				
				betParams["betBean[0][playId]"] = playId;
				betParams["betBean[0][odds]"] = play.odds;
				betParams["betBean[0][rebate]"] = play.rebate;
				betParams["betBean[0][money]"] = betMoney;
				betParams["betBean[0][betInfo]"] = betInfo;
				
				var playCate = Lottery.getPlayCate(play.playCateId);
				
				confirmHtml += '<div>' + playCate.name + ' - ' + play.name + '【' + betInfo + '】</div><div>组合数：' + betCount + '</div><div>单注金额：' + betMoney + '</div><div>总金额：' + totalMoney + '</div>';
			}
			else {
				var playId = $scope.selectSub.id;
				var play = Lottery.getPlay(playId);
				
				if(!checkPlayMoney(play, betMoney, totalMoney)) {
					return;
				}
				
				var paneCode = $scope.currPane.code;
				var dataList = $scope.betData[paneCode] || [];
				var betInfo = dataList.join(',');
				
				betParams["betBean[0][playId]"] = playId;
				betParams["betBean[0][odds]"] = play.odds;
				betParams["betBean[0][rebate]"] = play.rebate;
				betParams["betBean[0][money]"] = betMoney;
				betParams["betBean[0][betInfo]"] = betInfo;
				
				confirmHtml += '<div>' + play.name + '【' + betInfo + '】</div><div>组合数：' + betCount + '</div><div>单注金额：' + betMoney + '</div><div>总金额：' + totalMoney + '</div>';
			}
		}
		else {
			var playIdArray = $scope.getPlayIdArray();
			var dataList = $scope.betData[paneCode] || [];
			
			var index = 0;
			for(var i=0; i<playIdArray.length; i++) {
				var playId = playIdArray[i];
				var play = Lottery.getPlay(playId);
				if(!play) {
					continue;
				}
				var minMoney = play.minMoney;
				var maxMoney = play.maxMoney;
				
				if(!checkPlayMoney(play, betMoney, totalMoney)) {
					return;
				}
				
				betParams["betBean[" + index + "][playId]"] = playId;
				betParams["betBean[" + index + "][odds]"] = play.odds;
				betParams["betBean[" + index + "][rebate]"] = play.rebate;
				betParams["betBean[" + index + "][money]"] = betMoney;
				confirmHtml += '<div>【' + $filter('playCate')(play) + play.name + '】 @' + play.odds + ' x ' + betMoney + '</div>';
				index++;
			}
			
			confirmHtml += '<div class="split-line"></div>';
			confirmHtml += '<div>【合计】总注数：<span class="t-blue" style="margin-right:15px">' + betCount + '</span>总金额：<span class="t-blue">' + totalMoney + '</span></div>';
		}
		
		confirmHtml += '</ion-scroll>';
		
		Tools.modal({
			title: '下注清单',
			template: confirmHtml,
			css: 'lotter-popup',
			callback: function(scope, popup) {
				popup.close();
				
				Tools.ajax({
					url: 'Data/postCode?t=' + Date.parse(new Date()),
					params: betParams,
					backdrop: true,
					dataType: "json",
					success: function(g) {
						Tools.tip(g.msg);
						//Tools.tip('下注成功');
						$scope.reset();
						//My.addMoney(-totalMoney);
						My.refreshMoney(false);
					}
				});
			}
		});
	};
})

.controller('NotcountCtrl', function($scope, $log, Tools, Lottery, $state) {
	$scope.$on('$ionicView.afterEnter', function(event, viewData) {
		$scope.onQuery();
	});
	
	$scope.doRefresh = function() {
		$scope.onQuery();
		$scope.$broadcast('scroll.refreshComplete');
	};
	
	$scope.onQuery = function() {
		Tools.ajax({
			url: 'game/getNotcount.do',
			success: function(data) {
				data = data || [];
				
				var dataMap = {};
				for(var i in data) {
					dataMap[data[i].gameId] = data[i];
				}
				
				var gameList = Lottery.getGameList();
				var dataList = [];
				for(var i in gameList) {
					var game = gameList[i];
					var map = dataMap[game.id] || {};
					dataList.push({
						id: game.id, 
						name: game.name, 
						count: map.totalNums || 0, 
						money: map.totalMoney || 0
					});
				}
				$scope.dataList = dataList;
			}
		});
	};
	
	$scope.detail = function(gameId, gameName, count) {
		if(count > 0) {
			$state.go('lottery.detail', {gameId: gameId, gameName: gameName});
		}
	};
})

.controller('NotcountDetailCtrl', function($scope, $log, $stateParams, Tools, Lottery, $state) {
	$scope.gameId = $stateParams.gameId;
	$scope.gameName = $stateParams.gameName;
	$scope.playMap = Lottery.getPlayMapByGameId($scope.gameId);
	
	
	$scope.$on('$ionicView.afterEnter', function(event, viewData) {
		$scope.onQuery();
	});
	
	$scope.doRefresh = function() {
		$scope.onQuery();
		$scope.$broadcast('scroll.refreshComplete');
	};
	
	$scope.onQuery = function() {
		Tools.ajax({
			url: 'game/getNotcountDetail.do',
			backdorp: true,
			params: {gameId: $stateParams.gameId, rows: 100},
			success: function(rsp) {
				var data = rsp.data;
				if(!data || data.length == 0) {
					$scope.dataList = [];
					return;
				}
				
				$scope.dataList = data;
				$scope.totalBetMoney = rsp.otherData.totalBetMoney;
				
				$scope.$broadcast('scroll.refreshComplete');
			}
		});
	};
})

.controller('SettledCtrl', function($scope, $log, Tools, Lottery, $state, $filter, $timeout) {
	$scope.$on('$ionicView.afterEnter', function(event, viewData) {
		$scope.onQuery();
	});
	
	$scope.doRefresh = function() {
		$scope.dataList = null;
		$scope.page = 1;
		$scope.isMore = true;
		$scope.onQuery();
	};
	
	$scope.isMore = true;
	$scope.page = 1;
	$scope.rows = 30;
	$scope.onQuery = function() {
		if (!$scope.isMore) {
			return;
		}
		$scope.isMore = false;
		Tools.ajax({
			url: 'report/getBetBills.do',
			backdorp: true,
			params: {page:$scope.page, rows:$scope.rows},
			success: function(result) {
				$scope.totalBetMoney = result.otherData.totalBetMoney;
				$scope.totalResultMoney = result.otherData.totalResultMoney;
				
				if(result && result.totalCount>0 ) {
					var data = result.data;
					
					var dataList = [];
					for(var i=0; i<data.length; i++) {
						var play = Lottery.getPlayByAll(data[i].playId);
						if(!play) {
							continue;
						}
						var game = Lottery.getGame(data[i].gameId);
						dataList.push({turnNum: game.name + '</br>' + data[i].turnNum, money: data[i].money, resultMoney: data[i].resultMoney, detail: $filter('playCate')(play) + play.name + '</br>@' + play.odds + '</br>#' + data[i].rebate, rebate: data[i].rebate});
					}
					
					$scope.dataList = $scope.dataList || [];
					$scope.dataList = $scope.dataList.concat(dataList);
					
					if ($scope.rows * $scope.page < result.totalCount) {
						 $scope.page++;
						 $timeout(function() {
							 $scope.isMore = true;
						 }, 3000, false);
					}
				}
				else {
					$scope.dataList = [];
				}
				
				$scope.$broadcast('scroll.refreshComplete');
			}
		});
		$scope.$broadcast('scroll.infiniteScrollComplete');
	};
})

.controller('HistoryCtrl', function($scope, $log, $stateParams, $state, Tools, Lottery) {
	$scope.queryData = {};
	$scope.queryData.gameId = parseInt($stateParams.gameId || Lottery.getFirstGameId());
	
	var getHistoryUrl = function(gameId, date) {
		if(!$scope.showDate) {
			date = '';
		}
		
		return Tools.staticPath() + 'data/HistoryLottery.js?dateStr=' + date + '&gameId=' + gameId + '&_' + Math.random();
	};
	
	$scope.onChange = function() {
		$state.go($state.current.name, {gameId: $scope.queryData.gameId});
	};
	
	$scope.doRefresh = function() {
		$scope.onQuery();
		$scope.$broadcast('scroll.refreshComplete');
	};
	
	$scope.onQuery = function() {
		if(!$scope.queryData.gameId) {
			//Tools.tip('请选择游戏');
			return;
		}
		
		$scope.numStyle = Lottery.getNumStyle($scope.queryData.gameId);
		$scope.tpl = Lottery.getTpl($scope.queryData.gameId);
		
		Tools.lazyLoad([getHistoryUrl($scope.queryData.gameId, $scope.queryData.date)], function() {
			$scope.dataList = historyData;
		});
	};
	
	// 如果是六合彩，没有日期下拉框，由代码触发onQuery
	if($scope.queryData.gameId == 70) {
		$scope.showDate = false;
		$scope.queryData.date = moment().year();
		$scope.onQuery();
	}
	else {
		// 其他游戏有日期下拉框，由下拉框的下拉框的ng-change触发onQuery
		$scope.showDate = true;
	}
	
	// 幸运飞艇单独处理，如果是凌晨5点前，默认查询前一天的日期
	if($scope.queryData.gameId == 55 && moment().hour() < 5) {
		$scope.queryData.date = moment().subtract(1, 'd').format('YYYYMMDD');
		$scope.onQuery();
	}
})


.controller('ChangLongCtrl', function($scope, $log, $stateParams, Tools, Lottery, $state) {
	$scope.queryData = {};
	$scope.queryData.gameId = parseInt($stateParams.gameId || Lottery.getFirstGameId());
	
	$scope.onQuery = function() {
		var url = Tools.staticPath() + 'data/stat.js?gameId=' + $scope.queryData.gameId + '&_' + Math.random();
		Tools.lazyLoad([url], function() {
			$scope.curStatList = curStatList;
		});
	};
	$scope.doRefresh = function() {
		$scope.onQuery();
		$scope.$broadcast('scroll.refreshComplete');
	}
	$scope.onQuery();
})

.controller('LuZhuCtrl', function($scope, $log, $stateParams, Tools, Lottery, $state) {
	$scope.luZhuGameList=[];
	var gameList = Lottery.getGameList();
	for(var g in gameList){
		var game = gameList[g];
		if(game.id==10 || game.id==70){//去除江苏快3 、 香港六合彩
			continue;
		}
		$scope.luZhuGameList.push(game);
	}
	$scope.queryData = {};
	$scope.queryData.gameId = parseInt($stateParams.gameId || Lottery.getFirstGameId());
	if($scope.queryData.gameId==10 || $scope.queryData.gameId==70){
		Tools.tip('无此类游戏路珠');
		$scope.queryData.gameId=Lottery.getFirstGameId();
	}
	
	loadData = function() {
		var url = Tools.staticPath() + 'data/stat_game.js?gameId=' + $scope.queryData.gameId + '&_' + Math.random();
		Tools.lazyLoad([url], function() {
			$log.debug('luZhuCurData success');
			$scope.luZhuCurData=luZhuData;
			$scope.loadData1();
			$scope.loadData2();
		});
	};
	
	$scope.reLoadCfg = function(){
		$scope.luZhuCfgs = Lottery.getLuZhuCfg($scope.queryData.gameId);
		$scope.luZhuRow1 = $scope.luZhuCfgs["row1"];
		$scope.curCode1 = $scope.luZhuRow1[0].code;
		
		$scope.luZhuRow2 = $scope.luZhuCfgs["row2"];
		
		if($scope.luZhuRow2){
			$scope.curCode2 = $scope.luZhuRow2[0].code;
		}
		loadData();
	}
	
	$scope.reLoadCfg();
	
	$scope.htmlData1={};
	$scope.loadData1=function(code){
		if(code){
			$scope.curCode1=code;
		}
		$scope.htmlData1=dataReverse($scope.luZhuCurData[$scope.curCode1]);
	}
	
	
	$scope.htmlData2=[];
	$scope.loadData2=function(code){
		$scope.htmlData2=[];
		if(code){
			$scope.curCode2=code;
		}
		if(!$scope.curCode2){
			return;
		}
		
		var cfgs = $scope.luZhuRow2;
		for(var c in cfgs){
			var cfg = cfgs[c];
			if(cfg.code == $scope.curCode2){//获取对应的配置
				var cfgDatas = cfg.datas;
				for(var cd in cfgDatas){
					var cfgData = cfgDatas[cd];
					var htmlData={};
					htmlData.name = cfgData.name;
					htmlData.data = dataReverse($scope.luZhuCurData[cfgData.code]);//获取数据
					$scope.htmlData2.push(htmlData);
				}
				return;
			}
		}
	}
	
	//倒序
	function dataReverse(items){
		return items.slice().reverse();
	}
	
})

.controller('WeekRecordCtrl', function($rootScope, $scope, $state, Tools, My) {
	$scope.$on('$ionicView.beforeEnter', function(event, viewData) {
		onQuery();
	});
	
	// 需要提前的天数
	var diffDay = 0;
	// 报表是凌晨4点统计，如果当前小时数是5点前，需要额外再提前一天
	if(moment().hours() < 5) {
		diffDay++;
	}
	var startDate = moment().subtract(6 + diffDay, 'd').format('YYYY-MM-DD');
	var endDate = moment().subtract(diffDay, 'd').format('YYYY-MM-DD');
	
	$scope.doRefresh = function() {
		onQuery();
		$scope.$broadcast('scroll.refreshComplete');
	};
	
	var onQuery = function() {
		Tools.ajax({
			method: 'GET',
			params: {startDate: startDate, endDate: endDate},
			url: '/userrech/getStatBets.do',
			success: function(result) {
				 if(!result) {
					 return;
				 }
				 
				 var data = result.data;
				 
				 var dataMap = {};
				 for(var i = 0; i < data.length; i++) {
					 var date = data[i].statDate.split(' ')[0];
					 dataMap[date] = data[i];
				 }
				 
				 var dataList = [];
				 var allBetCount = 0;
				 var allRewardRebate = 0.0;
				 var now = moment().subtract(diffDay - 1, 'd');
				 for (var i = 0; i < 7; i++) {
					 var subDate = now.subtract(1, 'd');
					 var date = subDate.format('YYYY-MM-DD');
					 var obj = dataMap[date];
					 if(obj) {
						 allBetCount += obj.betCount;
						 allRewardRebate += obj.rewardRebate;
						 dataList.push({statDate: date, week: subDate.format('dddd'), betCount: obj.betCount, rewardRebate: obj.rewardRebate});
					 }
					 else {
						 dataList.push({statDate: date, week: subDate.format('dddd'), betCount: 0, rewardRebate: 0});
					 }
				 }
				 $scope.allBetCount = allBetCount;
				 $scope.allRewardRebate = allRewardRebate.toFixed(2);
				 $scope.weekRecordList = dataList;
			}
		});
	};
	
	$scope.detail = function(statDate, betCount) {
		if(betCount > 0) {
			$state.go('lottery.day', {statDate: statDate});
		}
	};
})


.controller('DayRecordCtrl', function($scope, $log, Tools, Lottery, $state, $stateParams) {
	$scope.statDate = $stateParams.statDate;
	
	$scope.$on('$ionicView.afterEnter', function(event, viewData) {
		$scope.onQuery();
	});
	
	$scope.doRefresh = function() {
		$scope.onQuery();
		$scope.$broadcast('scroll.refreshComplete');
	};
	
	$scope.onQuery = function() {
		Tools.ajax({
			url: 'userrech/getTotalStatBets.do',
			params: {date: $scope.statDate},
			success: function(data) {
				data = data || [];
				
				var dataMap = {};
				for(var i in data) {
					dataMap[data[i].gameId] = data[i];
				}
				
				var gameList = Lottery.getGameList();
				var dataList = [];
				for(var i in gameList) {
					var game = gameList[i];
					var map = dataMap[game.id] || {};
					dataList.push({
						id: game.id, 
						name: game.name, 
						count: map.betCount || 0, 
						money: map.betMoney || 0, 
						win: map.rewardRebate || 0
					});
				}
				$scope.dataList = dataList;
			}
		});
	};
	
	$scope.toWeek = function() {
		$state.go('lottery.week');
	};
	
	$scope.detail = function(gameId, count) {
		if(count > 0) {
			$state.go('lottery.day_detail', {gameId: gameId, statDate: $scope.statDate});
		}
	};
})

.controller('DayDetailCtrl', function($scope, $log, $state, $stateParams, Tools, Lottery) {
	var gameId = $stateParams.gameId;
	$scope.statDate = $stateParams.statDate;
	$scope.game = Lottery.getGame(gameId);
	$scope.playMap = Lottery.getPlayMapByGameId(gameId);
	
	$scope.$on('$ionicView.afterEnter', function(event, viewData) {
		$scope.onQuery();
	});
	
	$scope.doRefresh = function() {
		$scope.onQuery();
		$scope.$broadcast('scroll.refreshComplete');
	};
	
	$scope.onQuery = function() {
		Tools.ajax({
			url: 'report/getUserBets.do',
			backdorp: true,
			params: {gameId: gameId, date: $scope.statDate, rows: 100},
			success: function(rsp) {
				var data = rsp.data;
				if(!data || data.length == 0) {
					$scope.dataList = [];
					return;
				}
				
				$scope.dataList = data;
				$scope.totalBetMoney = rsp.otherData.totalBetMoney;
				$scope.totalResultMoney = rsp.otherData.totalResultMoney;
				
				$scope.$broadcast('scroll.refreshComplete');
			}
		});
	};
	
	$scope.toWeek = function() {
		$state.go('lottery.week');
	};
	
	$scope.toDay = function() {
		$state.go('lottery.day', {statDate: $scope.statDate});
	};
});

/**
 * 组合数算法
 * @param len
 * @param size
 * @returns {Array}
 */
function choose(len, size) {
	var allResult = [];
	var arr = [];
	for (var i = 0; i < len; i++) {
		arr[i] = i;
	}

	(function(arr, size, result) {
		var arrLen = arr.length;
		if (size > arrLen) {
			return;
		}
		if (size == arrLen) {
			allResult.push([].concat(result, arr))
		} else {
			for (var i = 0; i < arrLen; i++) {
				var newResult = [].concat(result);
				newResult.push(arr[i]);

				if (size == 1) {
					allResult.push(newResult);
				} else {
					var newArr = [].concat(arr);
					newArr.splice(0, i + 1);
					arguments.callee(newArr, size - 1, newResult);
				}
			}
		}
	})(arr, size, []);

	return allResult;
}

function lt_timer2(a) {
    var b = -1;
    if (a) {
        b = (format(a).getTime()) / 1000
    }
    return b
}

function format(a) {
    return new Date(a.replace(/[\-\u4e00-\u9fa5]/g, "/"))
}