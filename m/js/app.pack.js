window.onerror = function(errorMessage, scriptURI, lineNumber) {
    if(errorMessage.indexOf('srcEvent') > -1 || errorMessage == 'Script error.') {
    	return true;
    }
};

var domainConfig = getDomainConfig(appConfig.isLocal);

var ioniczApp = angular.module('ionicz', [ 
    'ionic', 
    'oc.lazyLoad',
    'ngSanitize',
    'ionicz.config', 
    'ionicz.providers', 
    'ionicz.filters', 
    'ionicz.directives', 
    'ionicz.controllers',  
    'ionicz.services', 
    'ionicz.lottery', 
    'ionicz.bank', 
    'angular-md5',
    'ngCookies'
])

.run(function($ionicPlatform, $rootScope, $log, PATH, ROUTE_ACCESS, Tools) {
	$ionicPlatform.ready(function() {
		$log.debug("===================ready=======================");
		// Hide the accessory bar by default (remove this to show the accessory
		// bar above the keyboard for form inputs)
		if (window.cordova && window.cordova.plugins.Keyboard) {
			cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
			cordova.plugins.Keyboard.disableScroll(true);
			console.info("window.cordova.plugins.Keyboard");
		}
		if (window.StatusBar) {
			// org.apache.cordova.statusbar required
			StatusBar.styleDefault();
			console.info("StatusBar.styleDefault");
		}
	});

	// 路由切换监听，如果路由必须登陆才可以访问，则判断登陆状态，如果未登录则跳转到登陆页面
	$rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams) {
		if(!$rootScope.inited) {
			return;
		}
		//Backdrop.show();
		var data = toState.data || {};
		if(data.access !== ROUTE_ACCESS.PUBLIC) {
			if(!$rootScope.isLogin) {
				//console.info('未登录，跳转到登陆页');
				window.location.href = '#' + PATH.loginPath;
			}
			
			// 不允许访客访问的路由需要验证是否是访客
			if(data.access == ROUTE_ACCESS.CHECK_TEST) {
				if($rootScope.isTestAccount) {
					Tools.tip('试玩帐号无权访问，请先注册');
					event.preventDefault();
				}
			}
		}
	});
	
	/*$rootScope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams) {
		if($rootScope.inited) {
			Backdrop.hide(500);
		}
	});*/
	
	Backdrop.hide(500);
});

angular.module('ionicz.lottery', []);
angular.module('ionicz.bank', []);
angular.module('ionicz.config', [])

.constant('ENV', {
	'moduleName': 'ionicz',
	'version' : '1.0.1'
})

.constant('PATH', {
	'loginPath' : '/login',
	'regPath' : '/reg',
	'homePath' : '/home'
})

.constant('ROUTE_ACCESS', {
	'PUBLIC' : 'public',
	'CHECK_TEST' : 'check_test'
})

.config(['$logProvider', function($logProvider) {
    $logProvider.debugEnabled(false);
}])

.config(function($ionicConfigProvider) {
	var configProperties = {
		views: {
			maxCache: 5,
			forwardCache: true,
			transition: 'ios'
		},
		
		navBar: {
			alignTitle: 'center'
		},
		
		backButton: {
			icon: 'ion-chevron-left',
			text: ' ',
			previousTitleText: false
		}
	};
	
	$ionicConfigProvider.setPlatformConfig('android', configProperties);
	$ionicConfigProvider.setPlatformConfig('ios', configProperties);
})

.config([ '$httpProvider', function httpProvider($httpProvider) {
	//$httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
	//$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
	
	$httpProvider.defaults.headers.post['Accept'] = '*/*';

	$httpProvider.defaults.transformRequest = [ function(data) {
		var param = function(obj) {
			var query = '';
			var name, value, fullSubName, subName, subValue, innerObj, i;

			for (name in obj) {
				value = obj[name];

				if (value instanceof Array) {
					for (i = 0; i < value.length; ++i) {
						subValue = value[i];
						fullSubName = name + '[' + i + ']';
						innerObj = {};
						innerObj[fullSubName] = subValue;
						query += param(innerObj) + '&';
					}
				} else if (value instanceof Object) {
					for (subName in value) {
						subValue = value[subName];
						fullSubName = name + '[' + subName + ']';
						innerObj = {};
						innerObj[fullSubName] = subValue;
						query += param(innerObj) + '&';
					}
				} else if (value !== undefined && value !== null) {
					query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
				}
			}

			return query.length ? query.substr(0, query.length - 1) : query;
		};

		return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
	} ];

	$httpProvider.interceptors.push(function($rootScope, $location, $q, PATH) {
		return {
			request : function(config) {
				return config || $q.when(config);
			}/*,
			responseError: function(response) {
				console.info('responseError');
				console.info(response);
				if(response.status == 403) {
					var My = $injector.get('My');
					My.clearMsgTimer();
					$location.path(PATH.loginPath);
				}
				if (response.status === 401 || response.status === 403) {
					alert('登录超时，点击确定回到登录页面');
					window.location.href = '/login.html';
				} else if (response.status === 500) {
					//$location.path('/error');
				}
				
				return $q.reject(response);
			}*/
		};
	});
} ]);
angular.module('ionicz.controllers', [])

.controller('AppCtrl', function($scope, $rootScope, $location, $ionicHistory, $log, Tools, PATH, My, md5) {
	$scope.My = My;
	
	$log.debug('AppCtrl');
	
	Tools.lazyLoad([Tools.staticPath() + "data/configjs.js?_" + Math.random()], function() {
		$rootScope.appConfig = angular.extend(CONFIG_MAP, appConfig);
		My.init();
		
		Tools.lazyLoad([Tools.staticPath() + "data/gamedatas.js"]);
	});
	
	$scope.staticPath = Tools.staticPath();
	$scope.webUrl = domainConfig.webUrl;
	
	// 如果是在子页面刷新，跳转回顶级页面
	/*var paths = $location.path().split('/');
	if (paths.length > 3) {
		$location.path('/' + paths[1] + '/' + paths[2]);
	}*/
	
	/*$scope.$on('$ionicView.afterEnter', function(event, viewData) {
		$log.debug('AppCtrl afterEnter');
		Backdrop.hide(500);
	});*/
	
	$scope.back = function() {
		$ionicHistory.backView() ? $ionicHistory.goBack() : $location.path(PATH.homePath);
	};
	
	$scope.logout = function() {
		Tools.confirm('确认要退出该帐号？', function() {
			var token = My.getToken();
			if(!token) {
				window.location.reload();
				$location.path(PATH.loginPath);
				return;
			}
			
			Tools.ajax({
				method: 'GET',
				url: '/user/logout',
				//params: {token: token},
				success: function(data) {
					location.href='/#/login';
				//	$location.path(PATH.loginPath);
					$rootScope.isLogin = false;
				}
			});
			My.clear();
			location.href='/#/login';
		});
	};
	
	$scope.guestLogin = function() {
		Tools.ajax({
			method: 'POST',
			url: '/api/guestLogin.do',
			backdrop: true,
			params: {
				username: '!guest!', 
				password: '!guest!'
			},
			success: function(data) {
				if(data && data.token) {
					Tools.tip('登陆成功');
					My.loginSuccess(data);
					$location.path(PATH.homePath);
				}
				else {
					Tools.alert(data.message);
				}
			},
			error: function(data) {
				Tools.alert(data.message || '登录失败');
			}
		});
	};
	
	$scope.refreshMoney = function() {
		My.refreshMoney();
	};
	
	$rootScope.debugMsgList = [];
	$scope.addDebugMsg = function(msg) {
		var lastMsg = $rootScope.debugMsgList[$rootScope.debugMsgList.length - 1];
		if(lastMsg && msg == lastMsg.msg) {
			$rootScope.debugMsgList[$rootScope.debugMsgList.length - 1] = {time: moment().format('HH:mm:ss SSS'), msg: msg, count: lastMsg.count + 1};
		}
		else {
			$rootScope.debugMsgList.push({time: moment().format('HH:mm:ss SSS'), msg: msg, count: 1});
		}
	};
	$scope.showTestModal = function() {
		Tools.modal({
			 templateUrl: 'test-template',
	         title: '调试数据'
		});
	};
})

.controller('LoginCtrl', function($scope, $location, $log, Tools, PATH, $cookies, My, md5) {
	$scope.$on('$ionicView.beforeEnter', function(event, viewData) {
		$scope.$broadcast('validateCodeChange');
		$scope.loginData.username = $cookies.get('username');
		//$scope.loginData.password = $cookies.get('password');
	});
	
	$scope.loginData = {};
	
	$scope.login = function() {
		$scope.msg = '';

		Tools.ajax({
			method: 'POST',
			url: '/user/loginedto',
			backdrop: true,
			params: {
				username: $scope.loginData.username, 
				password: $scope.loginData.password, 
				pwdtext: $scope.loginData.password,
				vcode: $scope.loginData.vcode
			},
			success: function(data) {
				if(data && data.token) {
					Tools.tip('登录成功');
					$cookies.put('token', data.token);
					var expireDate = new Date();
					expireDate.setDate(expireDate.getDate() + 30);//设置cookie保存30天
					$cookies.put('username', $scope.loginData.username, {'expires': expireDate});
					My.init();
					My.loginSuccess(data);
					$location.path(PATH.homePath);
				}
				else {
					Tools.alert(data.message);
				}

			},
			error: function(data) {
				$scope.msg = data.message;
				// 发送广播消息，刷新验证码
				Tools.alert(data.message);
				$scope.step = 1;
				$scope.$broadcast('validateCodeChange');
			}
		});
	};
	
	$scope.checkUserName = function() {
		// 处理苹果手机中文输入状态下输入用户名可能带有空格而造成登录按钮禁用的问题
		$scope.loginData.username = $scope.loginData.username.replace(/\s+/g, "");
	};
})


.controller('RegCtrl', function($scope, $rootScope, $location, $log, $timeout, Tools, My, PATH, $cookies, md5, $ionicScrollDelegate) {
	$scope.$on('$ionicView.beforeEnter', function(event, viewData) {
		$scope.$broadcast('validateCodeChange');
		$scope.regData = {};
		$scope.setStep(1);
	});
	$scope.checkUserName = function(username) {
		if(!username) {
			return;
		}
		Tools.ajax({
			method: 'POST',
			url: '/user/checkUserNameExist.do',
			params: {username: username},
			success: function(data) {
				$scope.usernameExist = !data.success;
			},
			error: function(data) {
				$scope.usernameExist = true;
			}
		});
	};
	$scope.resetCheck = function() {
		console.info("resetCheck");
		$scope.usernameExist = false;
	};
	$scope.checkFullName = function(fullName) {
		if (!fullName) {
			$scope.fullNameIsOk = false;
			return false;
		}
//		$scope.fullNameIsOk = /^[a-zA-Z ]{1,20}$/.test(fullName) || /^[\u4e00-\u9fa5]{1,10}$/.test(fullName);
		$scope.fullNameIsOk = /^[\u4e00-\u9fa5]{2,5}$/.test(fullName);
		return $scope.fullNameIsOk;
	};
	$scope.setStep = function(step) {
		$ionicScrollDelegate.$getByHandle('regScroll').scrollTop();
		$scope.step = step;
		if (step == 2) {
			$scope.regData.fundPwd1 = "0";
			$scope.regData.fundPwd2 = "0";
			$scope.regData.fundPwd3 = "0";
			$scope.regData.fundPwd4 = "0";
		}
	};
	$scope.reg = function() {
		Tools.ajax({
			method: 'POST',
			url: '/index.php/user/registered',
			params: {
				username: $scope.regData.username, 
				password: $scope.regData.password,
				password1: $scope.regData.password1,
				qq: $scope.regData.qq, 
				vcode: $scope.regData.vcode,
			},
			success: function(data) {
				if(data && data.token) {
					Tools.tip('注册成功', 2000);
					$cookies.put('token', data.token);
					var expireDate = new Date();
					expireDate.setDate(expireDate.getDate() + 30);//设置cookie保存30天
					$cookies.put('username', $scope.regData.username, {'expires': expireDate});
					My.init();
				
					$timeout(function() {
						$location.path(PATH.homePath);
					}, 2000);
				}
				else {
					Tools.alert(data.message);
				}
			},
			error: function(data) {
				Tools.alert(data.message);
				$scope.step = 1;
				
				$scope.$broadcast('validateCodeChange');
			}
		});
	};
});
angular.module('ionicz.directives', [])

.directive('validcodeField', function($compile, $timeout, Tools) {
	return {
		restrict: 'C',
		require: 'ngModel',
		scope: true,
		link: function(scope, element, attrs, ngModel) {
			if('INPUT' !== element[0].nodeName || attrs.type !== 'text') {
				throw new Error('Invalid input type for resetField: ' + attrs.type);
			}
			
			function getUrl() {
				console.log(Tools.apiPath());
				return Tools.apiPath() + '/user/vcode/'+(new Date()).getTime();
			}
			
			var dom = $compile('<img class="valid-img" src="' + getUrl() + '">')(scope);
			element.addClass('reset-field');
			element.after(dom);
			
			dom.bind('click', function() {
				dom.attr('src', getUrl());
			});
			
			scope.$on('validateCodeChange', function() {
				dom.attr('src', getUrl());
    			ngModel.$setViewValue(null);
				ngModel.$render();
    		});
		}
	}
})

.directive('passwordEye', ['$compile', function($compile) {
	return {
		restrict: 'C',
		scope: true,
		link: function(scope, element, attrs) {
			var types = ['password', 'text'];
			if('INPUT' === element[0].nodeName && types.indexOf(attrs.type) == -1) {
				throw new Error('Invalid input type for resetField: ' + attrs.type);
			}
			
			scope.enabled = false;
			var i = $compile('<i ng-click="showPwd()" class="icon icon-eye" ng-class="{\'icon-eyes\':enabled,\'icon-eye\':!enabled}"></i>')(scope);
			element.after(i);
			element.parent().addClass('input-icon');
			
			scope.showPwd = function() {
				if(scope.enabled) {
					scope.enabled = false;
					element.attr('type', 'password');
				}
				else {
					scope.enabled = true;
					element.attr('type', 'text');
				}
			}
		}
	}
}])

.directive('resetField', ['$compile', '$timeout', function($compile, $timeout) {
	return {
		restrict: 'C',
		require: 'ngModel',
		scope: true,
		link: function(scope, element, attrs, ngModel) {
			var s = /text|search|tel|url|email|password|number/g;
			if('INPUT' === element[0].nodeName) {
				if(!s.test(attrs.type)) {
					throw new Error('Invalid input type for resetField: ' + attrs.type)
				}
			}
			else if('TEXTAREA' !== element[0].nodeName) {
				throw new Error('resetField is limited to input and textarea elements');
			}
			var dom = $compile('<i ng-show="enabled" ng-click="reset();" class="icon icon-close"></i>')(scope);
			element.addClass('reset-field');
			element.after(dom);
			
			scope.reset = function() {
				ngModel.$setViewValue(null);
				ngModel.$render();
				scope.enabled = true;
			};
			
			element.bind('focus keyup', function() {
				$timeout(function() {
					scope.enabled = !ngModel.$isEmpty(element.val());
					scope.$apply()
				}, 0, false);
			}).bind('blur', function() {
				$timeout(function() {
					scope.enabled = false;
					scope.$apply();
				}, 0, false);
			});
		}
	}
}])

.directive('dateSelect', ['$compile', '$timeout', '$interpolate', function($compile, $timeout, $interpolate) {
	return {
		restrict: 'C',
		require: 'ngModel',
		template: function(element, attrs) {
			var tmp = $interpolate('<option value="{{value}}" label="{{text}}">{{text}}</option>');
			
			for(var i=0; i<7; i++) {
				var m = moment().subtract(i, 'd');
				element.append(tmp({value: m.format('YYYYMMDD'), text: m.format('YYYY-MM-DD')}));
			}
		},
		link: function(scope, element, attrs, ngModel) {
			$timeout(function() {
				// 如果没有设置默认值，则默认选中当天
				if(!ngModel.$viewValue) {
					ngModel.$setViewValue(moment().format('YYYYMMDD'));
					ngModel.$render();
				}
			}, 100, false);
		}
	}
}])

.directive('datetimeLocal', ['$compile', '$timeout', '$interpolate', function($compile, $timeout, $interpolate) {
	return {
		restrict: 'C',
		require: 'ngModel',
		link: function(scope, element, attrs, ngModel) {
			var nowTime = moment().format('YYYY-MM-DDTHH:mm');
			ngModel.$setViewValue(nowTime);
			element.attr('value', nowTime);
			element.attr('type', 'datetime-local');
		}
	}
}])

.directive('zlNotice', function(Tools) {
	return {
		restrict: 'EC',
		scope: true,
		template: '<marquee scrollamount="3" style="height:35px" ng-click="showNoticeInfo();">{{title}}</marquee>',
		replace: true,
		link: function(scope, element, attrs) {
			var message = '';
			scope.showNoticeInfo = function () {
				Tools.modal({
					title: '公告',
					template: message,
					callback: function(scope, popup) {
						popup.close();
					}
				});
			}
			
			Tools.lazyLoad([Tools.staticPath() + "data/messages.js?_" + Math.random()], function() {
				var messageList = MESSAGES.type_1 || [];
				if(messageList.length > 0) {
					message = messageList[0].message;
					scope.title = messageList[0].title;
				}
			});
		}
	}
})
;
angular.module('ionicz.filters', [])

.filter('money', function() {
	return function(value) {
		if(angular.isUndefined(value)) {
			return;
		}
		var num = new Number(value);
		return num.toFixed(2);
	}
})

.filter('number', [function() {
    return function(input) {
        return parseInt(input, 10);
    };
}])

.filter('stime', [function() {
    return function(text, format) {
    	if(!format) {
    		format = 'MM/DD HH:mm:ss';
    	}
    	return moment(text).format(format);
    };
}]);
angular.module('ionicz.providers', [])

.provider('Storage', function() {
	this.$get = function() {
		return {
			set : function(key, data) {
				return window.localStorage.setItem(key, window.JSON.stringify(data));
			},
			get : function(key) {
				return window.JSON.parse(window.localStorage.getItem(key));
			},
			remove : function(key) {
				return window.localStorage.removeItem(key);
			},
			
			session: {
				set : function(key, data) {
					return window.sessionStorage.setItem(key, window.JSON.stringify(data));
				},
				get : function(key) {
					return window.JSON.parse(window.sessionStorage.getItem(key));
				},
				remove : function(key) {
					return window.sessionStorage.removeItem(key);
				}
			}
		};
	}
})

.provider('Tools', function() {
	var staticPath = function() {
		return domainConfig['staticPath'];
	};
	
	var apiPath = function() {
		return domainConfig['apiPath'];
	};
	
	return {
		staticPath: staticPath,
		apiPath: apiPath,
		
		$get: function(ENV, $rootScope, $http, $state, $injector, $location, $log, $ionicPopup, $ocLazyLoad, $ionicLoading, PATH, $cookies) {
			var self = this;
			
			var ajax = function(opts) {
				var params = opts.params || {};
				var method = opts.method || 'POST';
				var req = {method: method, url: apiPath() + opts.url, headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}};
				
				var token = $cookies.get('token');
				if(token) {
					params['x-session-token'] = token;
				}
				
				if(method.toLocaleUpperCase() == 'POST') {
					req['data'] = params;
				}
				else {
					req['params'] = params;
				}
				
				if(opts.backdrop === true) {
					Backdrop.show();
				}
				
				$http(req).success(function(data) {
					opts.success(data);
					if(opts.backdrop === true) {
						Backdrop.hide();
					}
				}).error(function(data, status, header, config) {
					if(status == 403) {
						var My = $injector.get('My');
						My.clearMsgTimer();
						$location.path(PATH.loginPath);
					}
					else if(angular.isFunction(opts.error)) {
						opts.error(data);
					}
					else {
						$ionicLoading.show({template: data.msg || '系统繁忙，请稍候重试', duration: 2000});
					}
					
					if(opts.backdrop === true) {
						Backdrop.hide(500);
					}
				});
			};
			
			var tip = function(content, duration) {
				$ionicLoading.show({
					template: content,
					duration: duration || 1000
				});
			};
			
			var alert = function(msg, callback) {
				var alertPopup = $ionicPopup.alert({title: msg});
				
				if(angular.isFunction(callback)) {
					alertPopup.then(function(res) {
						callback();
					});
				}
			};
			
			var confirm = function(msg, callback) {
				var confirmPopup = $ionicPopup.confirm({
					title: msg,
					cancelText: '取消',
					okText: '确认'
				});
				
				var submitFlag = false;
				confirmPopup.then(function(res) {
					// 防止重复提交
                	if(submitFlag) {
    					return;
    				}
    				submitFlag = true;
					if(res) {
						callback();
					}
				});
			};
			
			var modal = function(opts) {
				if(!opts.templateUrl && !opts.template) {
					return;
				}
				
				var scope = opts.scope;
				if(!scope) {
					scope = $rootScope.$new();
				}
				
				scope.modalData = {};
				var submitFlag = false;
				
				// 自定义弹窗
		        var popup = $ionicPopup.show({
		        	templateUrl: opts.templateUrl,
		        	template: opts.template,
		        	title: opts.title || '消息',
		        	scope: scope,
		        	cssClass: opts.css || "info-mdf",
		        	buttons: [
		        	    {text: '取消'}, 
		                {text: '确定', type: 'button-positive', onTap: function(e) {
		                	// 防止重复提交
		                	if(submitFlag) {
		    					return;
		    				}
		    				submitFlag = true;
		                	if(angular.isFunction(opts.callback)) {
		                		opts.callback(scope, popup);
		                		e.preventDefault();
		                	}
		                }}
		        	]
		        });
			};
			
			var lazyLoad = function(files, callback) {
				$ocLazyLoad.load({
					name : ENV.moduleName,
					files : files
				}).then(function() {
					if(angular.isFunction(callback)) {
						callback();
					}
				});
			};
			
			var isPublicPage =  function() {
				if($state.current.name === "") {
					return true;
				}
				else if(!$state.current.data || $state.current.data.access != 'public') {
					return false;
				}
				else {
					return true;
				}
			};
			
			var isHomePage =  function() {
				if($location.path() == PATH.homePath) {
					return true;
				}
				else {
					return false;
				}
			};
			
			return {
				ajax: ajax,
				tip: tip,
				alert: alert,
				confirm: confirm,
				modal: modal,
				lazyLoad: lazyLoad,
				isPublicPage: isPublicPage,
				isHomePage: isHomePage,
				staticPath: staticPath,
				apiPath: apiPath,
				rootDomain: getRootDomain
			};
		}
	}
});
angular.module('ionicz')

.config(function($stateProvider, $urlRouterProvider, ROUTE_ACCESS) {
	$stateProvider
	
	.state('login', {
    	url: '/login',
    	data : {access : ROUTE_ACCESS.PUBLIC},
    	templateUrl: 'views/login/login.html',
    	controller: 'LoginCtrl'
    })
    
    .state('reg', {
    	url: '/reg',
    	data : {access : ROUTE_ACCESS.PUBLIC},
    	templateUrl: 'views/login/reg.html',
    	controller: 'RegCtrl'
    })
	
	.state('home', {
		url: '/home',
    	data : {access : ROUTE_ACCESS.PUBLIC},
    	templateUrl: 'views/home/index.html',
		controller: 'HomeCtrl'
	})
	
	.state('ucenter', {
    	url: '/ucenter',
    	abstract: true,
    	template: '<ion-nav-view name="ucenter-view"></ion-nav-view>'
    })
    
    .state('ucenter.index', {
    	url: '/index',
    	cache: false,
		views: {
    		'ucenter-view': {
    			templateUrl: 'views/ucenter/index.html',
    			controller: 'UCenterCtrl'
    		}
    	}
    })
    
    .state('ucenter.myinfo', {
    	url: '/myinfo',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'ucenter-view': {
    			templateUrl: 'views/ucenter/myinfo.html',
    			controller: 'UCenterCtrl'
    		}
    	}
    })
    
    .state('ucenter.myfpwd', {
    	url: '/myfpwd',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'ucenter-view': {
    			templateUrl: 'views/ucenter/mymdfpwd.html',
    			controller: 'UCenterCtrl'
    		}
    	}
    })
    
    .state('ucenter.notice', {
    	url: '/notice',
    	views: {
    		'ucenter-view': {
    			templateUrl: 'views/ucenter/notice.html',
    			controller: 'NoticeCtroller'
    		}
    	}
    })
    
    .state('ucenter.fundpwd', {
    	url: '/fundpwd',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'ucenter-view': {
    			templateUrl: 'views/ucenter/fundpwd.html',
    			controller: 'UCenterCtrl'
    		}
    	}
    });
    
	$urlRouterProvider.otherwise('/home');
});
angular.module('ionicz')

.config(function($stateProvider, $urlRouterProvider, ToolsProvider, ROUTE_ACCESS) {
	$stateProvider
	
	// 游戏父级路由，子级路由都会加载父级路由
	.state('lottery', {
		url: '/lottery',
		abstract: true,
		cache: false,
		template: '<ion-nav-view name="lottery-view" class="lottery"></ion-nav-view>',
		controller: 'BaseCtrl',
		resolve : {
			deps : [ "$ocLazyLoad", function($ocLazyLoad) {
				return $ocLazyLoad.load([{
					name : "ionicz.lottery",
					files : [
						'views/lottery/js/config.js',
					    'views/lottery/js/controllers.js', 
					    'views/lottery/js/services.js', 
					    'views/lottery/js/filters.js', 
					    'views/lottery/js/directives.js'
					]
				}]);
			} ],
			init: ['$q', 'Tools', function ($q, Tools) {
				// 首次加载游戏配置数据弹出加载层，等加载完毕后关闭加载层
				Backdrop.show();
		        var deferred = $q.defer();
		        Tools.lazyLoad([Tools.staticPath() + "data/gamedatas.js"], function() {
					Backdrop.hide(500);
					deferred.resolve();
				});
		        return deferred.promise;
		    }]
		}
	})
	
	.state('lottery.list', {
    	url: '/list',
    	cache: false,
		views: {
			'lottery-view': {
				templateUrl: 'views/lottery/list.html',
				controller: 'ListCtrl'
			}
		}
    })
    
    .state('lottery.index', {
    	url: '/index/:gameId',
		cache: false,
		views: {
			'lottery-view': {
				templateUrl: 'views/lottery/lottery.html',
				controller: 'LotteryCtrl'
			}
		}
    })
    
    .state('lottery.history', {
    	url: '/history/:gameId',
		cache: false,
		views: {
			'lottery-view': {
				templateUrl: 'views/lottery/history.html',
				controller: 'HistoryCtrl'
			}
		}
    })
    
    .state('lottery.notcount', {
    	url: '/notcount',
		views: {
			'lottery-view': {
				templateUrl: 'views/lottery/notcount.html',
				controller: 'NotcountCtrl'
			}
		}
    })
    
    .state('lottery.detail', {
    	url: '/notcount/detail/:gameId/:gameName',
    	cache: false,
		views: {
			'lottery-view': {
				templateUrl: 'views/lottery/notcount_detail.html',
				controller: 'NotcountDetailCtrl'
			}
		}
    })
    
    .state('lottery.settled', {
    	url: '/settled',
    	cache: false,
		views: {
			'lottery-view': {
				templateUrl: 'views/lottery/settled.html',
				controller: 'SettledCtrl'
			}
		}
    })
    
    
    .state('lottery.changLong', {
    	url: '/changLong/:gameId',
    	cache: false,
    	views: {
    		'lottery-view': {
    			templateUrl: 'views/lottery/changLong.html',
    			controller: 'ChangLongCtrl'
    		}
    	}
    })
    
    .state('lottery.luZhu', {
    	url: '/luZhu/:gameId',
    	cache: false,
    	views: {
    		'lottery-view': {
    			templateUrl: 'views/lottery/luZhu.html',
    			controller: 'LuZhuCtrl'
    		}
    	}
    })
    
    .state('lottery.week', {
    	url: '/week',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'lottery-view': {
    			templateUrl: 'views/lottery/week.html',
    			controller: 'WeekRecordCtrl'
    		}
    	}
    })
    
    .state('lottery.day', {
    	url: '/day/:statDate',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'lottery-view': {
    			templateUrl: 'views/lottery/day.html',
    			controller: 'DayRecordCtrl'
    		}
    	}
    })
    
    .state('lottery.day_detail', {
    	url: '/day_detail/:gameId/:statDate',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'lottery-view': {
    			templateUrl: 'views/lottery/day_detail.html',
    			controller: 'DayDetailCtrl'
    		}
    	}
    })
    
    ;
});
angular.module('ionicz')

.config(function($stateProvider, $urlRouterProvider, ToolsProvider, ROUTE_ACCESS) {
	$stateProvider
	
	// 父级路由，子级路由都会加载父级路由
	.state('bank', {
		url: '/bank',
		abstract: true,
		template: '<ion-nav-view name="bank-view"></ion-nav-view>',
		controller: 'BankBaseCtrl',
		data : {access : ROUTE_ACCESS.CHECK_TEST},
		resolve : {
			deps : [ "$ocLazyLoad", function($ocLazyLoad) {
				return $ocLazyLoad.load([{
					name : "ionicz.bank",
					files : [ 
					    'views/bank/config.js',
					    'views/bank/bank.js',
					    ToolsProvider.staticPath() + 'data/paramcfg.js'
					]
				}]);
			} ]
		}
	})
	
	 .state('bank.bank', {
    	url: '/bank',
    	views: {
    		'bank-view': {
    			templateUrl: 'views/bank/bank.html',
    			controller: 'BankController'
    		}
    	}
    })
	
	.state('bank.deposit', {
    	url: '/deposit',
		views: {
			'bank-view': {
				templateUrl: 'views/bank/deposit.html',
				controller: 'DepositController'
			}
		}
    })
    
    .state('bank.withdraw', {
    	url: '/withdraw',
		views: {
			'bank-view': {
				templateUrl: 'views/bank/withdraw.html',
				controller: 'WithdrawController'
			}
		}
    })
    .state('bank.trans', {
    	url: '/trans/:type',
		cache: false,
    	views: {
    		'bank-view': {
    			templateUrl: 'views/bank/trans.html',
    			controller:'TransController'
    		}
    	}
    })
    .state('bank.bankpay', {
    	url: '/bankpay',
    	data: {rechType: 'bankTransfer'},
		cache: false,
    	views: {
    		'bank-view': {
    			templateUrl: 'views/bank/bankpay.html',
    			controller:'OfflinePayController'
    		}
    	}
    })
    .state('bank.onlinepay', {
    	url: '/onlinepay',
    	data: {rechType: 'bankOnline'},
		cache: false,
    	views: {
    		'bank-view': {
    			templateUrl: 'views/bank/onlinepay.html',
    			controller:'OnlinePayController'
    		}
    	}
    })
    .state('bank.cftpay', {
    	url: '/cftpay',
    	data: {rechType: 'cft'},
		cache: false,
    	views: {
    		'bank-view': {
    			templateUrl: 'views/bank/cftpay.html',
    			controller:'OfflinePayController'
    		}
    	}
    })
    .state('bank.alipay', {
    	url: '/alipay',
    	data: {rechType: 'alipay'},
		cache: false,
    	views: {
    		'bank-view': {
    			templateUrl: 'views/bank/alipay.html',
    			controller:'OfflinePayController'
    		}
    	}
    }).state('bank.weixinOnline', {
    	url: '/weixinOnline',
    	data: {rechType: 'weixinOnline'},
		cache: false,
    	views: {
    		'bank-view': {
    			templateUrl: 'views/bank/wechatpayonline.html',
    			controller:'OnlinePayController'
    		}
    	}
    }).state('bank.wechatpay', {
    	url: '/wechatpay',
    	data: {rechType: 'weixin'},
		cache: false,
    	views: {
    		'bank-view': {
    			templateUrl: 'views/bank/wechatpay.html',
    			controller:'OfflinePayController'
    		}
    	}
    }).state('bank.alipayOnline', {
    	url: '/alipayOnline',
    	data: {rechType: 'alipayOnline'},
		cache: false,
    	views: {
    		'bank-view': {
    			templateUrl: 'views/bank/alipayonline.html',
    			controller:'OnlinePayController'
    		}
    	}
    })
    
    ;
});
angular.module('ionicz.services', [])

.service('My', function($rootScope, $location, $interval, $log, $filter, $cookies, Tools, PATH) {
	var self = this;
	
	this.info = {};
	var bank = {};
	var msgTimer = null;
	
	var startMsgTimer = function() {
		msgTimer = $interval(function() {
			Tools.ajax({
				url: '/game/getUserMsg.do',
				success: function(data) {
					if(data.balance) {
						self.info.money = data.balance;
					}
					if(data.message && data.message.channel) {
						if (data.message.channel != 8 && data.message.message) {
							Tools.tip('你有新消息');
						} else {
							Tools.modal({template:data.message.message});
						}
					}
				},
				error: function() {
				}
			});
			if(!$cookies.get('token')){
				alert("您已经退出登录，请重新登录");
				window.location.href = "/#/home";
			}
		}, 10000);
	};
	
	var checkUpdatePw = function() {
		// 需要更新密码
		if(self.info.updatePw === 1) {
			$location.path('/ucenter/myfpwd').search({t:1});
		}
	};
	
	this.getInfo = function() {
		return this.info;
	};
	this.getUserId = function() {
		return this.info.userId;
	};
	this.getToken = function() {
		return self.info.token;
	};
	
	this.getUserName = function() {
		return self.info.username;
	};
	this.getUserName = function() {
		return self.info.username;
	};
	this.getFullName = function() {
		return self.info.fullName;
	};
	this.setFullName = function(fullName) {
		self.info.fullName = fullName;
	};
	this.getMoney = function() {
		return $filter('money')(self.info.money);
	};
	this.getOriginalMoney = function() {
		return self.info.money;
	};
	this.addMoney = function(money) {
		self.info.money += money;
	};
	this.getEmail = function() {
		return self.info.email;
	};
	this.setEmail = function(email) {
		self.info.email = email;
	};
	this.setBank = function(data) {
		bank = data;
	};
	this.setBandDesc = function(bankName, subAddress, cardNo) {
		bank.bankName = bankName;
		bank.subAddress = subAddress;
		if (cardNo.length > 4) {
			bank.cardNo = "尾号" + cardNo.substring(cardNo.length-4, cardNo.length);
		}
	};
	this.getBank = function() {
		return bank;
	};
	this.hasBankMsg = function() {
		if (bank.bankName && bank.cardNo) return true;
		return false;
	};
	this.hasFundPwd = function() {
		return self.info.hasFundPwd;
	};
	this.setHasFundPwd = function(hasFundPwd) {
		self.info.hasFundPwd = hasFundPwd;
	};
	this.init = function() {
		var token = $cookies.get('token');
		if(!token) {
			self.loginFail();
			return;
		}
		
		Tools.ajax({
			url: '/api/init.do',
			success: function(data) {
				if(data.token) {
					self.loginSuccess(data);
				}
				else {
					self.loginFail();
				}
				
				$rootScope.inited = true;
			}
		});
	};
	this.ymg6islogin = function() {
		var token = $cookies.get('token');
		if(!token) {
			if(!Tools.isPublicPage()) {
				$location.path(PATH.loginPath);
			}
			return;
		}

	};	
	this.loginFail = function() {
		if(!Tools.isPublicPage()) {
			$location.path(PATH.loginPath);
		}
		$rootScope.inited = true;
	};
	
	this.loginSuccess = function(data) {
		$cookies.put('token', data.token);
		// 如果是试玩帐号，修改显示的用户名为“游客”
		if(data.testFlag == 1) {
			data['username'] = '游客';
			$rootScope.isTestAccount = true;
		}
		else {
			$rootScope.isTestAccount = false;
		}
		
		self.info = data;
		//console.log(self.info);
		$rootScope.diffTime = moment(data.serverTime).diff(moment(), 's');
		$rootScope.isLogin = true;
		startMsgTimer();
		checkUpdatePw();
	};
	
	this.clear = function() {
		$cookies.remove('token');
		self.info = {};
		self.clearMsgTimer();
	};
	
	this.clearMsgTimer = function() {
		$interval.cancel(msgTimer);
	};
	
	this.refreshMoney = function(backdrop) {
		backdrop = backdrop === false ? false : true;
		Tools.ajax({
			url: '/game/getMoney.do',
			backdrop: backdrop,
			success: function(data) {
				if(data) {
					self.info.money = data;
				}
			}
		});
	};
});
