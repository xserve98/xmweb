angular.module('ionicz.controllers')

.controller('HomeCtrl', function($scope, $log, $timeout, Tools, $ionicSlideBoxDelegate) {
	$log.debug("HomeCtrl...");
	
	$scope.slideList = slideList;
	
	$scope.$on('$ionicView.afterEnter', function() {
		$log.debug("HomeCtrl $ionicView.afterEnter");
	});
});