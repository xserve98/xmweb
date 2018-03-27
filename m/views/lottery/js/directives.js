angular.module('ionicz.lottery')

.directive('myPopover', function() {
	return {
		restrict: 'C',
		scope: true,
		link: function(scope, element, attrs) {
			element.find('a').bind('click', function() {
				scope.popover.hide();
			});
		}
	}
})

.directive('scrollbarX', function() {
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			if(element.attr('scrollbar-x') == 'false') {
				element.removeClass('scroll-x');
			}
		}
	}
})

/**
 * 下注项指令
 * 该指令实现以下功能：
 * 1：根据元素上填写的data-id填充该玩法的赔率显示在页面；
 * 2：记忆选中状态，如果之前是选中状态，切换回来默认选中；
 * 3：点击事件，点击切换选中和未选中
 */
.directive('bet', function(Lottery) {
	return {
		restrict: 'C',
		scope: true,
		link: function(scope, element, attrs) {
			var dataId = element.attr('data-id');
			var oddsElement = angular.element(element[0].querySelector('.bet-item'));
			var play = Lottery.getPlay(dataId);
			if(!play) {
				oddsElement.html('--');
			}
			else {
				if(scope.isExist(dataId)) {
					element.addClass('bet-choose');
				}
				
				oddsElement.html(play.odds);
				
				element.bind('click', function() {
					if(scope.shareData.lotteryState != 1) {
						return;
					}
					var selected = element.hasClass('bet-choose');
					// 如果已经是选中状态，移除
					if(selected) {
						scope.removeDataId(dataId);
					}
					else {
						scope.addDataId(dataId);
					}
					
					element.toggleClass('bet-choose');
				});
			}
		}
	}
})

.directive('subBet', function(Lottery) {
	return {
		restrict: 'C',
		scope: false,
		link: function(scope, element, attrs) {
			var dataId = element.attr('data-id');
			
			var play = Lottery.getPlay(dataId);
			if(play) {
				var oddsElement = angular.element(element[0].querySelector('.bet-item'));
				oddsElement.html(play.odds);
			}
			
			element.bind('click', function() {
				if(scope.shareData.lotteryState != 1) {
					return;
				}
				var selected = element.hasClass('bet-choose');
				var flag = false;
				// 如果已经是选中状态，移除
				if(selected) {
					flag = scope.removeNum(dataId);
				}
				else {
					flag = scope.addNum(dataId);
				}
				
				if(flag) {
					element.toggleClass('bet-choose');
				}
			});
		}
	}
})

.directive('perio', function($rootScope, $filter, $timeout, $interval, $log, Tools, Lottery) {
	var diffTime = $rootScope.diffTime;
	var lotteryStyle = {};
	var tpl = {};
	var getNextIssueUrl = function(gameId) {
		return Tools.staticPath() + 'data/NextIssue.js?gameId=' + gameId + '&_' + Math.random();
	};
	
	var getCurIssueUrl = function(gameId) {
		return Tools.staticPath() + 'data/CurIssue.js?gameId=' + gameId + '&_' + Math.random();
	};
	
	return {
		restrict: 'C',
		scope: true,
		template: 
		'<div>' +
			'<div class="pre-perio">' +
				'<div class="col item" ng-show="codeHtml.length > 0">' +
					'<span class="span-fl span-pt">{{preIssue}}期</span>' +
					'<div class="lottery-nums" ng-bind-html="codeHtml"></div>' +
		   		'</div>' +
			'</div>' +
			
			'<div class="cur-perio" ng-show="curIssue">' +
				'<div class="col item">' +
					'<span>{{curIssue}}期 封盘:</span><span class="time">{{endTimeHtml}}</span><span>开奖:</span> <span class="time">{{lotteryTimeHtml}}</span>' +
				'</div>' +
			'</div>' +
		'</div>',
		replace: true,
		link: function(scope, element, attrs) {
			$log.debug('---------perio link-----------, ' + scope.gameId);
			
			var mainTimer = null;
			var nextIssueTimer = null;
			var curIssueTimer = null;

			scope.curIssue = null;
			scope.preIssue = null;
			//scope.timer = 10;
			
			var gameId = scope.gameId;
			
			var filterEndHtml = function(endDiffSecond) {
				if(endDiffSecond < 0) {
					endDiffSecond = 0;
				}
				scope.endTimeHtml = $filter('tick')(endDiffSecond, '已封盘');
			};
			
			var filterLotteryHtml = function(lotteryDiffSecond) {
				if(lotteryDiffSecond < 0) {
					lotteryDiffSecond = 0;
				}
				scope.lotteryTimeHtml = $filter('tick')(lotteryDiffSecond, '开奖中');
			};
			
			var processCode = function (scope, nums) {
				$log.debug('processCode, ' + nums);
				if(!nums) {
					return;
				}
				
				if(!angular.isArray(nums)) {
					nums = nums.split(',');
				}
				
				if(nums.length < 3) {
					return;
				}
				
				scope.codeHtml = $filter('codeHtml')(nums, gameId, 'lottery');
			};
			
			function stop() {
				scope.shareData.lotteryState = 0;
				scope.reset();
			}
			
			function startNextTimer() {
				$interval.cancel(nextIssueTimer);
				
				Tools.lazyLoad([getNextIssueUrl(gameId)], function() {
					if(!nextIssueData) {
						return;
					}
					
					var curIssue = parseInt(nextIssueData.issue);
					scope.shareData.curIssue = curIssue;
					scope.curIssue = curIssue;
					scope.preIssue = parseInt(nextIssueData.preIssue);
					
                	var nowTime = moment().add(diffTime, 's');
                	var lotteryTime = moment(nextIssueData.lotteryTime);
                	var endTime = moment(nextIssueData.endtime);
                	var endDiffSecond = endTime.diff(nowTime, 's'); // 封盘倒计时
                	var lotteryDiffSecond = lotteryTime.diff(nowTime, 's'); // 开奖倒计时
                	
                	// 如果半小时都还没有获取到下一期数据，则算做是未开盘状态
                	if(endDiffSecond < -60 * 30) {
                		$interval.cancel(nextIssueTimer);
                		scope.endTimeHtml = $filter('tick')(endDiffSecond, '未开盘');
                		scope.lotteryTimeHtml = $filter('tick')(endDiffSecond, '未开盘');
                		scope.shareData.lotteryState = -1;
                		return;
                	}
                	
                	// 如果当前时间距离封盘时间大于10分钟且不是六合彩，则当作封盘处理
                	if(endDiffSecond > 60 * 10 && gameId != 70) {
                		scope.shareData.lotteryState = 0;
                	}
                	else if(endDiffSecond <= 0) {
            			stop();
            		}
                	else {
                		scope.shareData.lotteryState = 1;
                	}
                	
                	/*if(lotteryDiffSecond == 0) {
                		startCurIssueTimer();
            		}*/
                	
                	filterEndHtml(endDiffSecond);
                	filterLotteryHtml(lotteryDiffSecond);

                	/**
                	 * 开始倒计时
                	 */
                	nextIssueTimer = $interval(function() {
                		lotteryDiffSecond--;
                		$log.debug('-----------next $interval----------');
                		//scope.timer--;
                		if(endDiffSecond <= 0) {
                			stop();
                		}
                		else {
                			endDiffSecond--;
                			filterEndHtml(endDiffSecond);
                		}
                		
                		filterLotteryHtml(lotteryDiffSecond);
                		
                		if(lotteryDiffSecond <= 0) {
                    		startNextTimer();
                		}
                	}, 1000);
				});
			};
			
			function getCurIssue() {
				$log.debug('获取下一期的开奖数据');
				
				Tools.lazyLoad([getCurIssueUrl(gameId)], function() {
					if(!curIssueData) {
						return;
					}
					
					processCode(scope, curIssueData.nums);
					$log.debug('scope.curIssue: ' + scope.curIssue + ', curIssueData.issue: ' + curIssueData.issue);
					
					if(scope.curIssue - curIssueData.issue <= 1) {
						$log.debug('获取到开奖数据，清除定时器');
						scope.preIssue = curIssueData.issue;
						$interval.cancel(curIssueTimer);
					}
					else {
						$log.debug('未获取到开奖数据');
					}
				});
			};
			
			function startMainTimer() {
				mainTimer = $interval(function() {
					$log.debug('-----------mainTimer----------');
					//scope.timer = 10;
					startNextTimer();
				}, 10000);
			};
			
			/**
			 * 开启获取开奖数据定时器
			 */
			function startCurIssueTimer() {
				$log.debug('开启获取开奖数据定时器');
				$interval.cancel(curIssueTimer);
				curIssueTimer = $interval(function() {
					$log.debug('-----------cur $interval----------');
					getCurIssue();
				}, 2000, 60);
			};
			
			scope.$watch('curIssue', function(newValue) {
				if(!newValue) {
					return;
				}
				$log.debug('$watch curIssue, newValue: ' + newValue + ', scope.preIssue: ' + scope.preIssue);
				if(newValue - scope.preIssue >= 2) {
					$log.debug('下一期数据已经生成，30秒后获取这期的开奖结果');
					$timeout(startCurIssueTimer, 30000, false);
				}
			});
			
			scope.$on('lotteryInited', function($scope) {
				$log.debug('------------lotteryInited------------');
				numStyle = Lottery.getNumStyle(gameId, 'lottery');
				tpl = Lottery.getTpl(gameId);
				element.parent().addClass(tpl.group);
				scope.shareData.lotteryState = 1;
				
				// 开启获取下一期倒计时
				startNextTimer();
				// 先获取一次当前期开奖号码
				getCurIssue();
				// 开启总计时器，10秒刷新一次
				startMainTimer();
			});
			
			scope.$on('lotteryDestroy', function($scope) {
				$log.debug('------------lotteryDestroy------------');
				$interval.cancel(mainTimer);
				$interval.cancel(nextIssueTimer);
				$interval.cancel(curIssueTimer);
			});
		}
	}
})

.directive('lotteryTimer', function($rootScope, $filter, $interval, $log, Tools) {
	var diffTime = $rootScope.diffTime;
	var mainTimer = null;
	var allIssueTimer = null;
	var timeMap = {};
	return {
		restrict: 'EC',
		scope: false,
		template: '<div class="item" ng-repeat="game in gameList track by game.id"><a href="#/lottery/index/{{game.id}}"><h3>{{game.name}}</h3><span>{{texts[game.id]}}<ion-spinner ng-show="!texts[game.id]" class="spinner spinner-ios"></ion-spinner></span></a></div>',
		replace: true,
		link: function(scope, element, attrs) {
			scope.texts = {};
			
			var startTimer = function() {
				$interval.cancel(allIssueTimer);
				
				Tools.lazyLoad([Tools.staticPath() + 'data/' + 'allNextIssue.js?_' + Math.random()], function() {
					if(!allNextIssueData) {
						return;
					}
					
					for(var gameId in allNextIssueData) {
						var issueDate = allNextIssueData[gameId];
						var nowTime = moment().add(diffTime, 's');
	                	var lotteryTime = moment(issueDate.lotteryTime);
	                	var lotteryDiffSecond = lotteryTime.diff(nowTime, 's'); // 开奖倒计时
	                	timeMap[gameId] = lotteryDiffSecond;
					}
					
					allIssueTimer = $interval(function() {
						var isRestart = false;
                		for(var gameId in timeMap) {
                			var lotteryDiffSecond = timeMap[gameId];
                			if(lotteryDiffSecond < -60 * 30) {
                				scope.texts[gameId] = '未开盘';
                			}
                			else {
                				scope.texts[gameId] = $filter('tick')(lotteryDiffSecond, '开奖中');
                			}
                			lotteryDiffSecond--;
                			timeMap[gameId] = lotteryDiffSecond;
                			if(lotteryDiffSecond == 0) {
                				isRestart = true;
    	                	}
                		}
                		if(isRestart) {
                			startTimer();
                		}
                	}, 1000);
				});
			}
			
			startTimer();
			
			mainTimer = $interval(function() {
				startTimer();
        	}, 10000);
			
			scope.$on('lotteryListDestroy', function($scope) {
				$log.debug('------------lotteryListDestroy------------');
				$interval.cancel(mainTimer);
				$interval.cancel(allIssueTimer);
			});
		}
	}
})

.directive('zodiac', function($interpolate) {
	// 所有生肖集合
	var zodiacs = ['鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪'];
	// 当前年份，后续应该是从后端获取
	var animalsYear = '鸡';
	
	return {
		restrict: 'A',
		scope: true,
		link: function(scope, element, attrs) {
			var text = attrs['zodiac'];
			var max = attrs['max'] || 49;
			var zodiacIndex = zodiacs.indexOf(animalsYear); // 8
			var index = zodiacs.indexOf(text); // 10
			if(zodiacIndex < index) {
				zodiacIndex += 12;
			}
			
			var tmp = $interpolate('<span class="round-3 {{num|lhcColor}}">{{num}}</span>');
			var html = '';
			var m = (zodiacIndex - index) + 1;
			var num = m;
			while(num <= max) {
				html += tmp({num: num});;
				num += 12;
			}
			element.append(html);
		}
	}
})
;