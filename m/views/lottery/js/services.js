angular.module('ionicz.lottery')


.service('Lottery', function(Tools, $log, $state, $timeout, My) {
	var self = this;
	
	var lotteryData = {
		game: {
			list: [], // 游戏列表静态文件数据
			map: {} // 游戏Map静态文件数据
		},
		cate: {},
		play: {
			all: {}, // 所有的游戏玩法数据
			map: {} // 当前游戏的玩法数据
		}
	};
	
	var userId = null;
	var dataInited = false;
	// 模版配置文件，只加载一次
	var lotteryCfg = null;
	// 模板组配置文件
	var groupCfg = null;
	// 当前游戏配置模板，每次切换游戏会更新tpl
	var tpl = {};
	// 当前游戏ID
	var currGameId = null;
	// 路珠配置文件，只加载一次
	var luzhuCfg = null;
	
	this.init = function() {
		$log.debug('--------init-------');
		
		var gameList = [];
		for(var i=0; i<games.length; i++) {
			var g = games[i];
			if(g.open === 0) {
				gameList.push({id: g.id, name: g.name, cate: g.cate});
			}
		}
		
		lotteryData.game.list = gameList;
		lotteryData.game.map = gameMap;
		lotteryData.cate = playCates;
		lotteryData.play.all = plays;
		
		lotteryCfg = __lotteryCfg || {};
		groupCfg = __groupCfg || [];
		luzhuCfg = __luzhuCfg || {};
	};
	
	/**
	 * 初始化游戏模板数据
	 */
	this.initGame = function(gameId, callback) {
		currGameId = gameId;
		
		tpl = lotteryCfg[currGameId];
		if(!tpl) {
			Tools.alert('游戏配置缺失', function() {
				$state.go('lottery.list');
			});
			return;
		}
		
		// 处理切换用户后，游戏数据不加载的问题
		if(userId != My.getUserId()) {
			dataInited = false;
			userId = My.getUserId();
		}
		
		initPlayData(callback);
	};
	
	// 初始化游戏赔率等数据
	var initPlayData = function(callback) {
		if(dataInited) {
			if(angular.isFunction(callback)) {
				callback();
			}
		}
		else {
			$log.debug('初始化游戏赔率等数据');
			
			Tools.ajax({
				url: 'game/getServerData.do',
				backdrop: true,
				success: function(data) {
					var userPlayConfig = data.playConfig;
					var userQuotaConfig = data.quotaConfig;
					var all = lotteryData.play.all;
					var map = {};
					var playMap = {};
					for(var key in all) {
						var obj = all[key];
						playMap = map[obj.gameId] || {};
						// 获取用户单独设定的玩法赔率
						var userPlay = userPlayConfig[userId + '_' + key];
						if(userPlay) {
							if(userPlay.odds) {
								obj.odds = userPlay.odds;
							}
							if(userPlay.rebate) {
								obj.rebate = userPlay.rebate;
							}
						}
						// 获取用户单独设定的交易设定
						var userQuota = userQuotaConfig[userId + '_' + key];
						if(userQuota) {
							obj.minMoney = userQuota.minMoney;
							obj.maxMoney = userQuota.maxMoney;
							obj.maxTurnMoney = userQuota.maxTurnMoney;
						}
						playMap[key] = obj;
						map[obj.gameId] = playMap;
					}
					lotteryData.play.map = map;
					dataInited = true;
					if(angular.isFunction(callback)) {
						callback();
					}
				}
			});
		}
	};
	
	this.getGameId = function() {
		return currGameId;
	};
	
	this.getFirstGameId = function() {
		return lotteryData.game.list[0].id;
	};
	
	/**
	 * 获取游戏
	 */
	this.getGame = function(gameId) {
		return lotteryData.game.map[gameId];
	};
	
	/**
	 * 获取游戏列表
	 */
	this.getGameList = function() {
		return lotteryData.game.list;
	};
	
	/**
	 * 获取游戏MAP
	 */
	this.getGameMap = function() {
		return lotteryData.game.map;
	};
	
	/**
	 * 获取玩法大类
	 */
	this.getPlayCate = function(cateId) {
		//console.info(lotteryData.cate);
		return lotteryData.cate[cateId];
	};
	
	/**
	 * 获取游戏玩法
	 */
	this.getPlayMap = function() {
		return lotteryData.play.map[currGameId];
	};
	
	/**
	 * 获取玩法复杂名称（大类名称和玩法名称）
	 */
	this.getPlayName = function(play) {
		var playCate = lotteryData.cate[play.playCateId];
		var cateName = playCate.isShow == 1 ? '' : (playCate.name + ' - ');
		return cateName + play.name;
	};
	
	/**
	 * 获取游戏玩法
	 */
	this.getPlayMapByGameId = function(gameId) {
		var all = lotteryData.play.all;
		var map = {};
		for(var key in all) {
			var obj = all[key];
			if(obj.gameId == gameId) {
				map[key] = obj;
			}
		}
		return map;
	};
	
	/**
	 * 根据当前游戏玩法类别ID获取玩法对象
	 */
	this.getPlay = function(playId) {
		if(!lotteryData.play.map[currGameId]) {
			return null;
		}
		
		return lotteryData.play.map[currGameId][playId];
	};
	
	/**
	 * 根据玩法类别ID获取玩法对象
	 */
	this.getPlayByAll = function(playId) {
		if(!lotteryData.play.all) {
			return null;
		}
		
		return lotteryData.play.all[playId];
	};
	
	/**
	 * 获取号码风格类型
	 */
	this.getNumStyle = function(gameId, type) {
		var style = lotteryCfg[gameId].numStyle || {};
		return style[type];
	};
	
	/**
	 * 获取游戏模板配置
	 */
	this.getTpl = function(gameId) {
		return lotteryCfg[gameId];
	};
	
	/**
	 * 获取游戏分组
	 */
	this.getGroup = function(gameId) {
		return lotteryCfg[gameId].group;
	};
	
	/**
	 * 获取所有模板对象集合
	 */
	this.getPanes = function() {
		return groupCfg[tpl.group];
	};
	
	/**
	 * 获取默认显示的玩法类别模板对象
	 */
	this.getDefaultPane = function() {
		var panes = this.getPanes();
		if(!panes || panes.length == 0) {
			throw new Error("游戏配置缺失");
		}
		return panes[0];
	};
	
	/**
	 * 获取内容区模板目录文件
	 */
	this.getContentTpl = function(pane) {
		return tpl.template + pane.tpl;
	};
	
	this.getLuZhuCfg = function(gameId){
		return luzhuCfg[gameId];
	};
	
	this.getLotteryData = function(callback) {
		Tools.ajax({
			url: 'game/getLotteryData.do',
			params: {gameId: currGameId},
			success: function(data) {
				callback(data);
			}
		});
	};
});