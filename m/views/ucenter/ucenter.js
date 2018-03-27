angular.module('ionicz.controllers')

.controller('UCenterCtrl', function($rootScope, $scope, $timeout, $state, $ionicPopup, Tools, md5, My, UCenter, $location) {
	$scope.$on('$ionicView.beforeEnter', function(event, viewData) {
		// 强制显示后退按钮
		// viewData.enableBack = true;
	});
	$scope.goPageCheckFundPwd = function(pageModel) {
		//console.log($scope.checkFundPwd());
		if ($scope.checkFundPwd()) {
			$state.go(pageModel);
		}
	};
	$scope.checkFundPwd = function() {
		return UCenter.checkFundPwd()
	};
	
	// 个人资料
	$scope.addRealName = function(title, callback) {
		UCenter.addRealName('添加姓名', function() {});
	};
	
	$scope.showEmailModel = function() {
		UCenter.addEmail();
	};
	
	var t = $location.search().t;
	//console.info($location.search());
  //  登录密码
  $scope.mdfLoginPwdData = {t:t};
	$scope.updatePwd = function() {
		if($scope.mdfLoginPwdData.OldLoginPwd == $scope.mdfLoginPwdData.NewLoginPwdRpt) {
			Tools.tip("新密码与旧密码不能相同");
			return;
		}
		Tools.ajax({
			method: 'POST',
			params:{
				oldPwd : $scope.mdfLoginPwdData.OldLoginPwd,
				newPwd : $scope.mdfLoginPwdData.NewLoginPwdRpt
			},
			url: '/safe/setPasswd.do',
			success: function(data) {
				if(data=='ok') {
					Tools.tip('修改密码成功');
					$state.go("ucenter.index");
				}else{
					Tools.tip(data);
					return false;
				}
			}
		});
	};
	// 取款密码
	$scope.fundPwdFormData={};
	$scope.setFundPwd = function() {
		if(My.hasFundPwd()) {
			$scope.updateFundPwd();
		} else {
			$scope.saveFundPwd();
		}
	};
	$scope.saveFundPwd = function() {
		Tools.ajax({
			method: 'POST',
			params:{
				loginpwd : md5.createHash($scope.fundPwdFormData.loginPwd),
				coinpwd : md5.createHash($scope.fundPwdFormData.newFundPwd)
			},
			url: '/user/setFundPwd.do',
			success: function(data) {
				if(data == "ok") {
					My.setHasFundPwd(true);
					$scope.fundPwdFormData={};
					Tools.tip("保存取款密码成功！");
					$state.go("ucenter.index");
				}else{
					Tools.tip(data);
					return false;
				}
			}
		});
	};
	$scope.updateFundPwd = function() {
		Tools.ajax({
			method: 'POST',
			params:{
				oldPwd : $scope.fundPwdFormData.oldFundPwd,
				newPwd : $scope.fundPwdFormData.newFundPwd
				//oldFundPwd : md5.createHash($scope.fundPwdFormData.oldFundPwd),
				//newFundPwd : md5.createHash($scope.fundPwdFormData.newFundPwd)
			},
			url: '/safe/setCoinPwd.do',
			success: function(data) {
				if(data == "ok") {
					$scope.fundPwdFormData={};
					Tools.tip("修改取款密码成功！");
					$state.go("ucenter.index");
				}else{
					Tools.tip(data);
				}
			}
		});
	};
	$scope.sayhello = function() {
		now = new Date(),hour = now.getHours();
		if(hour < 6){return "凌晨好！"}
		else if (hour < 9){return "早上好！"}
		else if (hour < 12){return "上午好！"}
		else if (hour < 14){return "中午好！"}
		else if (hour < 17){return "下午好！"}
		else if (hour < 19){return "傍晚好！"}
		else if (hour < 22){return "晚上好！"}
		else {return "夜里好！"} 
	}
})
.controller('NoticeCtroller', function($rootScope, $scope, $timeout, $ionicModal, Tools) {
	// 消息中心
	$scope.noticeList = null;
	$scope.isMore = true;
	var page = 1;
	var rows = 10;
	$scope.loadMore = function() {
		if (!$scope.isMore) {
			return;
		}
		$scope.isMore = false;
		Tools.ajax({
			method: 'GET',
			params: {page: page, rows: rows},
			url: '/userrech/getNotices.do',
			success: function(result) {
				 if(result && result.totalCount>0 ){
					 $scope.noticeList = $scope.noticeList || [];
					 $scope.noticeList = $scope.noticeList.concat(result.data);
					 if (rows * page < result.totalCount) {
						 page++;
						 $timeout(function(){$scope.isMore = true;}, 1500);
					 }
				 }
				 else {
					 $scope.noticeList = [];
				 }
				 $scope.$broadcast('scroll.infiniteScrollComplete');
			}
		});
		$scope.$broadcast('scroll.infiniteScrollComplete');
	};
	// 消息详情页
	$scope.showNotice = {};
	$scope.showDetail = function(notice) {
		$scope.showNotice = notice;
		Tools.modal({
			scope:$scope,
			title: notice.title,
			template: notice.content,
			callback: function(scope, popup) {
				popup.close();
			}
		});
	};
})


.service('UCenter', ['$log', '$state', 'My', 'Tools', function($log, $state, My, Tools) {
	var info = My.getInfo();
	
	this.addRealName = function(title, callback) {
		Tools.modal({
			 templateUrl: 'realname-template',
	         title: title,
	         callback: function(scope, popup) {
	        	 var realname = scope.modalData.realname;
	        	 if(!realname) {
	        		 Tools.tip('请输入真实姓名');
	        		 return;
	        	}
//	        	var bl = /^[a-zA-Z ]{1,20}$/.test(realname) || /^[\u4e00-\u9fa5]{1,10}$/.test(realname);
	        	 var bl =/^[\u4e00-\u9fa5]{2,5}$/.test(realname);
	        	if(!bl) {
	        		Tools.tip('请输入真实姓名[2~5个汉字]');
	        		return;
    			}
	        	Tools.ajax({
	     			method: 'POST',
	     			params: {fullName: realname},
	     			url: '/user/setFullName.do',
	     			success: function(data) {
						if(data=='ok'){
							My.setFullName(realname.substr(0, 1) + "**");
							Tools.tip("保存成功!");
							if (angular.isFunction(callback)) {
								callback();
							}
							
							popup.close();
						}else{
							Tools.tip(data);
						return false
						}
	     			}
	        	 });
	         }
		});
	};
	
	this.addEmail = function(callback) {
		Tools.modal({
			 templateUrl: 'email-template',
	         title: '添加邮箱',
	         callback: function(scope, popup) {
	        	 if(!scope.modalData.email) {
	        		 Tools.tip('请输入邮箱');
	        		 return;
	        	 }
	        	 
	        	 Tools.ajax({
	     			method: 'POST',
	     			params: {email: scope.modalData.email},
	     			url: '/user/setEmail.do',
	     			success: function(data) {
	     				My.setEmail(scope.modalData.email);
    					Tools.tip("添加成功");
	     				popup.close();
	     			}
	     		});
	         }
		});
	};
	
	this.checkFundPwd = function() {
		//console.log(My.hasFundPwd());
		if (!My.hasFundPwd()) {
			Tools.tip("请先设置取款密码！");
			$state.go("ucenter.fundpwd"); // 需要设置取款密码
			return false;
		} else {
			return true;
		}
	};
}])
;