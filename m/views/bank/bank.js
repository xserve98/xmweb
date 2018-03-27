angular.module('ionicz.bank')

.controller('BankBaseCtrl', function($scope, $log, Tools, My, $ionicHistory, $location, PATH) {
	$log.debug("BankBaseCtrl...");
	
	$scope.back = function() {
		var backView = $ionicHistory.viewHistory().backView;
		if(!backView) {
			$location.path('/ucenter/index');
		}
		else {
			$location.path(backView.url);
		}
	};
	
	$scope.getBank = function(callback) {
		Tools.ajax({
			method: 'GET',
			url: '/userrech/detail.do',
			success: function(data) {
				if (data) {
					My.setBank(data);
				}
				if (angular.isFunction(callback)) {
					callback();
				}
			}
		});
	};
	$scope.parseIntMoney = function(t) {
		t.target.value = parseInt(t.target.value);
		if ("NaN" == t.target.value) {
			t.target.value="";
		}
		return t.target.value;
	};

	$scope.parseFloatMoneyInDepositPage = function(t) {
		t.target.value = t.target.value.replace(/[^0-9.]/g, "");
		if (!(parseFloat(t.target.value) > 0 &&  (/^\d+\.?\d{0,2}$/.test(t.target.value)) ) ) {
			t.target.value = parseFloat(t.target.value).toFixed(2);
		}
		if ("NaN" == t.target.value) {
			t.target.value="";
		} 
	};
	
	$scope.checkDepositMoney = function(data, rechType) {
		var s = data.depositMoney.charAt(data.depositMoney.length-1);
	    if(s=="."){
	    	data.depositMoney = data.depositMoney.substring(0, data.depositMoney.length-1);
	    }
	    var money = parseFloat(data.depositMoney);
	    var mixMoney = $scope.getMixMoney(rechType);
	    var maxMoney = $scope.getMaxMoney(rechType);
	    if (money<mixMoney) {
	    	Tools.tip("存款金额不能小于"+mixMoney);
	    	return false;
	    }
	    if (money>maxMoney) {
	    	Tools.tip("存款金额不能大于"+maxMoney);
	    	return false;
	    }
	    return true;
	};
	$scope.getMixMoney = function(rechType) {
		if (rechType && rechMoneyLimit[rechType] && rechMoneyLimit[rechType].mix) {
			return rechMoneyLimit[rechType].mix;
		}
		return rechMoneyLimit.defaultMoney.mix;
	};
	$scope.getMaxMoney = function(rechType) {
		if (rechType && rechMoneyLimit[rechType] && rechMoneyLimit[rechType].max) {
			return rechMoneyLimit[rechType].max;
		}
		return rechMoneyLimit.defaultMoney.max;
	};
	
})

.controller('BankController', function($scope, $log, Tools, My, UCenter) {
	$log.debug("银行账号: BankController..." );
	$scope.bankIcon = bankIcon;
	$scope.$on('$ionicView.beforeEnter', function(event, viewData) {
		$scope.bankInit();
	});
	
	$scope.bankInit = function() {
		if (UCenter.checkFundPwd()) {
			if (My.hasBankMsg()) {
				$scope.setStep(1); // 可以展示银行卡信息
				return;
			}
			$scope.getBank($scope.bankPageGetBankCallback);
		}
	};
	$scope.bankPageGetBankCallback = function() {
		if (My.hasBankMsg()) {
			$scope.setStep(1);
		} else {
			$scope.setStep(0);
		}
	};
	
	$scope.addBank = function() {
		if (!My.getFullName()) {
			UCenter.addRealName('完善个人信息');
			return;
		}
		$scope.setStep(2);
	};
	$scope.mdfBankData = {};
	$scope.bindBank = function() {
		Tools.ajax({
			method: 'POST',
			url: '/user/bindBank.do',
			params: {
				bankId : $scope.mdfBankData.bankId,
				cardNo : $scope.mdfBankData.cardNo,
				subAddress : $scope.mdfBankData.address
			},
			success : function(data) {
				var tip = '成功添加银行信息';
				if ($scope.step == 3) {
					tip = '成功修改银行信息';
				}
				if(data=='ok'){
				Tools.tip(tip);
				My.setBandDesc($scope.mdfBankData.bankName, $scope.mdfBankData.address, $scope.mdfBankData.cardNo);
				$scope.setStep(1);
				$scope.mdfBankData = {};
				}else{
				Tools.tip(data);
				return false;
				}
			}
		});
	};
	$scope.setStep = function(step) {
		$scope.step = step;
		if (step == 3) {
			$scope.mdfBankData.bankName = My.getBank().bankName;
			$scope.mdfBankData.addressTip = My.getBank().subAddress;
//			$scope.mdfBankData.address = My.getBank().subAddress;
			$scope.mdfBankData.cardNoTip = "旧卡"+My.getBank().cardNo;
//			$scope.mdfBankData.cardNo = My.getBank().cardNo;
		}
	};
})

.controller('WithdrawController', function($scope, $log, $state, My, Tools, UCenter, md5) {
	$log.debug("WithdrawCtrl...");
	
	$scope.$on('$ionicView.beforeEnter', function(event, viewData) {
		$scope.withdrawInit();
	});
	
	$scope.showRealNameModal = function(title, callback) {
		UCenter.addRealName(title, callback);
	};
	
	$scope.withdrawInit = function() {
		if (UCenter.checkFundPwd()) { // 取款密码
			if (!My.hasBankMsg()) {
				$scope.getBank($scope.withdrawPageGetBankCallback);
			} else {
				$scope.withdrawPageGetBankCallback();
			}
		}
	};
	$scope.withdrawPageGetBankCallback = function() {
		if (!My.getFullName()) {
			$scope.withdrawStep = 1; // 需要完善用户信息-真实姓名
		}
		if (My.getFullName() && !My.hasBankMsg()) {
			$scope.withdrawStep = 2; // 需要绑定银行卡
		}
		if (My.getFullName() && My.hasFundPwd() && My.hasBankMsg()) {
			$scope.withdrawStep = 3; // 可以取款，展示取款页面
		}
	}
	$scope.withdrawData = {};
	$scope.withdrawSubmit = function() {
		var amount = $scope.withdrawData.applyMoney;
		if (!amount) {
			Tools.tip("请输入提款金额！");
			return false;
		}
		amount = parseInt(amount);
		if (amount < 100) {
			Tools.tip('提现金额不能小于100元');
			return false;
		}
		var drawcode = $scope.withdrawData.withdrawPwd;
		if (!drawcode) {
			Tools.tip('请输入提款密码');
			return false;
		}
		if (amount > My.getMoney()) {
			Tools.tip('余额不足');
			return false;
		}
		Tools.ajax({
			method: 'POST',
			params: {
				coinpwd : drawcode,
				coinpwdmd5 : md5.createHash(drawcode),
				amount : amount
			},//{amount : amount, fundPwd: md5.createHash(drawcode), fundPwdText:drawcode},
			url: '/withdraw/submit.do',
			success: function(g) {
				if(g=='ok'){
				Tools.tip('申请提现成功，请等待客服人员审核');
				My.addMoney(-amount);
				$state.go("bank.trans", {type: 2});
				}else{
				Tools.tip(g);
				return false;
				}
			}
		});
	};
	$scope.parseIntMoneyInWithdrawPage = function(t) {
		$scope.withdrawData.applyMoney = $scope.parseIntMoney(t);
	};
})

.controller('TransController', function($rootScope, $scope, $stateParams, $timeout, $ionicModal, Tools, My, $interval) {
	$scope.type = $stateParams.type;
$scope.CHECK_STATUS = {
	0 : '提现成功',
	1 : '申请中',
	2 : '提现失败',
	3 : '提现成功',
	4 : '提现失败',
	5 : '撤销'
};

$scope.RECH_STATUS = {
	0 : '处理中',
	1 : '充值成功',
	2 : '充值成功',
	3 : '充值失败',
	4 : '充值失败',
	9 : '充值成功'
};	
	$scope.RECH_TYPE = {"onlinePayment" : '在线充值', "weixin" : '微信转账', "alipay" : '支付宝转账', "cft" : '财付通转账', "bankTransfer" : '银行卡转账'};
	$scope.ThirdChannels = bank1;
	
	$scope.isMore = true;
	$scope.dataList = null;
	var rows = 10;
	
	var getPage = function() {
		if(!$scope.dataList) {
			return 1;
		}
		var length = $scope.dataList.length;
		if (length < rows) {
			return 1;
		} else {
			return parseInt(length / rows + 1);
		}
	};
	
	$scope.queryData = function() {
		if (!$scope.isMore) {
			return;
		}
		
		$scope.isMore = false;
		
		var url = $scope.type == 1 ? '/userrech/getRechList.do' : '/withdraw/getWithDrawList.do';
		var page = getPage();
		
		Tools.ajax({
			method: 'GET',
			params: {page: page, rows: rows},
			url: url,
			success: function(result) {
				 if(result && result.totalCount > 0) {
					 $scope.dataList = $scope.dataList || [];
					 $scope.dataList = $scope.dataList.concat(result.data);
					 if (rows * page < result.totalCount) {
						 $timeout(function(){$scope.isMore = true;}, 1500);
					 }
				 }
				 else {
					 $scope.dataList = [];
				 }
			}
		});
			$scope.$broadcast('scroll.infiniteScrollComplete');
	};
	
	$scope.rechDescData = {};
	$scope.showDetail = function(item) {
		$scope.item = item;
		var templateUrl = $scope.type == 1 ? 'rech-detail.html' : 'withdraw-detail.html';
		Tools.modal({
			scope: $scope,
			title: '查看详情',
			templateUrl: templateUrl,
			callback: function(scope, popup) {
				popup.close();
			}
		});
	};
})


.controller('DepositController', function($scope, $log, $state, $filter, ENV, Tools, UCenter, BankService) {
	$log.debug("DepositController...");
	BankService.init(function(rechTypeMap) {
		UCenter.checkFundPwd();
		$scope.rechTypeMap = rechTypeMap;
	});
})

.controller('OnlinePayController', function($scope, $log, $state, $cookies, $filter, ENV, Tools, UCenter, BankService) {
	$scope.bankMap = bankMap;
	$scope.xSessionToken = $cookies.get('token');
	
	var rechType = $state.current.data.rechType;
	
	$scope.$on('$ionicView.beforeEnter', function(event, viewData) {
		$scope.onlinepayData = {};
		
		BankService.init(function(rechTypeMap) {
			UCenter.checkFundPwd();
			$scope.rechTypeList = rechTypeMap[rechType] || [];
			if($scope.rechTypeList.length == 0) {
				return;
			}
			$scope.onlinepayData.payWay = $scope.rechTypeList[0];
		});
	});
	$scope.onlinePay = function(formObj) {
		if (!$scope.checkDepositMoney($scope.onlinepayData, rechType)) {
			return false;
		}
		
		$scope.setFormAction($scope.onlinepayData);
		$scope.showSubmitData();
		document.getElementById("onlinepay-form").submit()
		return true;
	};
	$scope.setFormAction = function(onlinepayData) {
		var formUrl = "/userrech/onlinePay.do";
		//console.log(onlinepayData.payWay.domain);
		if (onlinepayData && onlinepayData.payWay && onlinepayData.payWay.domain) {
			formUrl = onlinepayData.payWay.domain + "/userrech/onlinePay.do";
		}
		document.getElementById("onlinepay-form").setAttribute("action", formUrl);
	};
	$scope.showSubmitData = function() {
		Tools.modal({
			scope:$scope,
			title: '支付信息',
			templateUrl: 'submitData-template',
			callback: function(scope, popup) {
				$state.go("bank.trans", {type: 1});
				popup.close();
			}
		});
	};
})

.controller('OfflinePayController', function($scope, $log, $state, $filter, ENV, Tools, UCenter, BankService) {
	var rechType = $state.current.data.rechType;
	
	$scope.$on('$ionicView.beforeEnter', function(event, viewData) {
		$scope.bankStep = 1;
		$scope.depositData = {};
		
		BankService.init(function(rechTypeMap) {
			UCenter.checkFundPwd();
			$scope.rechTypeList = rechTypeMap[rechType];
			$scope.depositData.bankObj = $scope.rechTypeList[0];
			var now = new Date();
			$scope.depositData.depositDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), now.getHours(), now.getMinutes());
		});
	});
	$scope.isDoPay = false;
	$scope.bankNextStep = function(data) {
		if (!$scope.checkDepositMoney(data, rechType)) {
			return;
		}
		$scope.setBankStep(3);
		$scope.isDoPay = true;
	};
	$scope.setBankStep = function(step) {
		$scope.bankStep = step;
	};
	$scope.doPay = function(data) {
		if (!$scope.isDoPay) {
			return;
		}
		$scope.isDoPay = false;
		var date = $filter('date')(data.depositDate, 'yyyy-MM-dd HH:mm:ss');
		Tools.ajax({
			method: 'POST',
			params: {
				cfgId: data.bankObj.id, 
				amount: data.depositMoney, 
				username: data.depositUsername, 
				depositTime: date
			},
			url: '/Userrech/save.do',
			success: function(result) {
				Tools.tip(result);
				location.href='#/bank/trans/1';
				//$state.go("bank.trans", {type: 1});
			}
		});
	};
})

.service('BankService', ['$log', 'Tools', function($log, Tools) {
	var rechTypeCfgArray = [];
	var rechTypeMap = {};
	var inited = false;
	
	var initBaseRechType = function() {
		var rechTypeList = PARAM_CFG["rech_type"];
		if (!rechTypeList || rechTypeList.length == 0) {
			Tools.alert('配置缺失');
			return;
		}
		for (var i in rechTypeList) {
			if (rechTypeList[i].open == 0) { // 0-开， 1-关
				rechTypeCfgArray.push(rechTypeList[i].value);
			}
		}
	};
	
	var initUserRechType = function(callback) {
		// 先初始化基础充值配置
		initBaseRechType();
		
		Tools.ajax({
			method: 'GET',
			url: '/Userrech/getUserRechCfg.do',
			success: function(result) {
				if (!result) {
					return;
				}
				var onlineData = []; // 在线充值源数据
				var otherData = []; // 非在线充值源数据
				
				for(var i in result) {
					var obj = result[i]; 
//					console.log(obj);
					// 如果充值大类已经关闭
					if(rechTypeCfgArray.indexOf(obj.rechType) == -1) {
						continue;
					}
					if (obj.rechType == "onlinePayment") {
						onlineData.push(obj);
					} else {
						otherData.push(obj);
					}
				}
				
				/** 处理在线充值数据 start bf[1], sf[2], ht[3/5], htwx[4] */
				var sort = [1, 3, 5, 4, 2, 6]; // 显示顺序：宝付[1]/汇通[3/5]/微信汇通[4]/闪付[2]/支付宝-闪付[6]
				onlineData.sort(function(a, b) {
					return sort.indexOf(a.onlineType) > sort.indexOf(b.onlineType);
				});
				
				var bankOnlinePayList = [];
				var weixinOnlinePayList = [];
				var alipayOnlineList = [];
				for(var i in onlineData) {
					var obj = onlineData[i];
					// 闪付,银行在线支付
					if(obj.onlineType == 2) {
						bankOnlinePayList.push({id: obj.id, order: (bankOnlinePayList.length + 1), onlineType: obj.onlineType, domain:obj.domain});
					}
					else if(obj.onlineType == 4) {
						weixinOnlinePayList.push({id: obj.id, order: (weixinOnlinePayList.length + 1), onlineType: obj.onlineType, payCode: 'WEIXIN', domain:obj.domain});
					}
					else if (obj.onlineType == 6) {
						alipayOnlineList.push({id: obj.id, order: (alipayOnlineList.length + 1), onlineType: obj.onlineType, payCode: '758', domain:obj.domain});
					}
					else if (obj.onlineType == 7) {// 微信在线支付 - 闪付
						weixinOnlinePayList.push({id: obj.id, order: (weixinOnlinePayList.length + 1), onlineType: obj.onlineType, payCode: '57', domain:obj.domain});
					}
					else if (obj.onlineType == 9) { // 智付微信
						weixinOnlinePayList.push({id: obj.id, order: (weixinOnlinePayList.length + 1), onlineType: obj.onlineType, payCode: '2', domain:obj.domain});
					}
					else if (obj.onlineType == 12) { // 乐盈微信
						weixinOnlinePayList.push({id: obj.id, order: (weixinOnlinePayList.length + 1), onlineType: obj.onlineType, payCode: 'wx', domain:obj.domain});
					}
					else if (obj.onlineType == 14) { // 久付微信
						weixinOnlinePayList.push({id: obj.id, order: (weixinOnlinePayList.length + 1), onlineType: obj.onlineType, payCode: 'wx', domain:obj.domain});
					}
					else if (obj.onlineType == 16) {
						alipayOnlineList.push({id: obj.id, order: (alipayOnlineList.length + 1), onlineType: obj.onlineType, payCode: '992', domain:obj.domain});
					}
					else if (obj.onlineType == 10) {
						alipayOnlineList.push({id: obj.id, order: (alipayOnlineList.length + 1), onlineType: obj.onlineType, payCode: 'ZHIFUBAO', domain:obj.domain});
					}
					else {
						bankOnlinePayList.push({id: obj.id, order: (bankOnlinePayList.length + 1), onlineType: obj.onlineType, domain:obj.domain});
					}
				}
				
				rechTypeMap['bankOnline'] = bankOnlinePayList;
				rechTypeMap['weixinOnline'] = weixinOnlinePayList;
				rechTypeMap['alipayOnline'] = alipayOnlineList;
				
				/** 处理在线充值数据 end */
				
				
				/** 处理非在线充值数据 start */
				for(var i in otherData) {
					var obj = otherData[i];
					var list = rechTypeMap[obj.rechType] || [];
					list.push(obj);
					rechTypeMap[obj.rechType] = list;
				}
				/** 处理非在线充值数据 end */
				
				if(angular.isFunction(callback)) {
					callback(rechTypeMap);
				}
			}
		});
	};
	
	this.init = function(callback) {
		if(!inited) {
			initBaseRechType();
			initUserRechType(callback);
			inited = true;
		}
		else {
			if(angular.isFunction(callback)) {
				callback(rechTypeMap);
			}
		}
	};
}])

;