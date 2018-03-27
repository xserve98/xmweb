// 
// Here is how to define your module 
// has dependent on mobile-angular-ui
// 
var app = angular.module('MobileAngularUi', [
  'ngRoute',
  'mobile-angular-ui',
  'mobile-angular-ui.core.fastclick', 
  'mobile-angular-ui.components.scrollable',
  'mobile-angular-ui.gestures'
]);

// 
// You can configure ngRoute as always, but to take advantage of SharedState location
// feature (i.e. close sidebar on backbutton) you should setup 'reloadOnSearch: false' 
// in order to avoid unwanted routing.
// 
app.config(function($routeProvider) {
  $routeProvider.when('/', {templateUrl: '/mobile/member/main', reloadOnSearch: false});
  $routeProvider.when('/center/index/:page', {templateUrl:  function(params){ return '/mobile/member/center/index'+'?r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/center/address', {templateUrl:  function(params){ return '/mobile/member/center/address'+'?r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/center/notices', {templateUrl:  function(params){ return '/mobile/member/center/notices'+'?r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/center/notices/:page', {templateUrl:  function(params){ return '/mobile/member/center/notices?page='+ params.page +'&r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/payment/deposit/:page', {templateUrl:  function(params){ return '/mobile/member/payment/deposit'+'?r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/payment/deposit/transtips/:id', {templateUrl:  function(params){ return '/mobile/member/payment/transtips?amount='+ params.id +'&r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/payment/deposit/safetips/:id', {templateUrl:  function(params){ return '/mobile/member/payment/safetips?cardid='+ params.id +'&r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/payment/deposit/atmtips/:id', {templateUrl:  function(params){ return '/mobile/member/payment/atmtips?cardid='+ params.id +'&r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/payment/withdrawal', {templateUrl:  function(params){ return '/mobile/member/payment/withdrawal'+'?r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/payment/transfer', {templateUrl:  function(params){ return '/mobile/member/payment/transfer'+'?r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/payment/transfer/:transtype/:accept/:begin/:end/:page', {templateUrl:  function(params){ return '/mobile/member/payment/transfer?transtype='+params.transtype+'&accept='+params.accept+'&begin='+params.begin+'&end='+params.end+'&page='+params.page+'&r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/payment/detailtrans/:id', {templateUrl:  function(params){ return '/mobile/member/payment/detailtrans?id='+ params.id +'&r='+ Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/info/:lottery', {templateUrl:  function(params){  return (params.lottery) ?  '/mobile/member/info?lottery=' + params.lottery +'&r='+ Math.random() : '/mobile/member/info?r=' + Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/password', {templateUrl: '/mobile/member/password', reloadOnSearch: false});
  $routeProvider.when('/bets', {templateUrl: function(params){  return '/mobile/member/bets?r='+ Math.random()}, reloadOnSearch: false});
  $routeProvider.when('/bets/:page', {templateUrl: function(params){  return '/mobile/member/bets?page=' + params.page + '&r='+ Math.random() }, reloadOnSearch: false});
  $routeProvider.when('/bets_settled', {templateUrl: function(params){  return '/mobile/member/bets?settled=true&r='+ Math.random()}, reloadOnSearch: false});
  $routeProvider.when('/bets_settled/:page', {templateUrl: function(params){  return '/mobile/member/bets?settled=true&page=' + params.page + '&r='+ Math.random() }, reloadOnSearch: false});
  $routeProvider.when('/bets_history/:date', {templateUrl: function(params){  return '/mobile/member/bets?date=' + params.date + '&r='+ Math.random() }, reloadOnSearch: false});
  $routeProvider.when('/bets_history/:date/:page', {templateUrl: function(params){  return '/mobile/member/bets?date=' + params.date + '&page=' + params.page + '&r='+ Math.random() }, reloadOnSearch: false});
  $routeProvider.when('/history/:begin/:end/:page', {templateUrl: function(params){ return '/mobile/member/history?begin=' + params.begin + '&end=' + params.end + '&page=' + params.page + '&r='+ Math.random() }, reloadOnSearch: false});
  $routeProvider.when('/history', {templateUrl: '/mobile/member/history', reloadOnSearch: false});
  $routeProvider.when('/dresult/:lottery/:date', {templateUrl:  function(params){  window.hasBack =  false; return (params.lottery) ?  '/mobile/member/dresult?lottery=' + params.lottery + '&date=' + params.date +'&r='+ Math.random() : '/mobile/member/dresult?r=' + Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/dresult/:lottery/:date/:table', {templateUrl:  function(params){  window.hasBack =  false; return (params.lottery) ?  '/mobile/member/dresult?lottery=' + params.lottery + '&date=' + params.date + '&table=' + params.table +'&r='+ Math.random() : '/mobile/member/dresult?r=' + Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/dresult/single/:lottery/:date', {templateUrl:  function(params){  return (params.lottery) ?  '/mobile/member/dresult?lottery=' + params.lottery + '&date=' + params.date +'&r='+ Math.random() : '/mobile/member/dresult?r=' + Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/rule/:lottery', {templateUrl:  function(params){  return (params.lottery) ?  '/mobile/member/rule?lottery=' + params.lottery +'&r='+ Math.random() : '/mobile/member/rule?r=' + Math.random();}, reloadOnSearch: false});
  $routeProvider.when('/logout', {templateUrl: '/mobile/member/logout', reloadOnSearch: false});
  $routeProvider.when('/load/HK6/HK6/', {templateUrl: function(params){ return '/mobile/member/load?lottery=HK6&page=tm&index=A';}, reloadOnSearch: false}); 
  $routeProvider.when('/load/HK6/HK6/tm', {templateUrl: function(params){ return '/mobile/member/load?lottery=HK6&page=tm&index=A';}, reloadOnSearch: false});
  $routeProvider.when('/load/:lottery/:template', {templateUrl: function(params){ return '/mobile/member/load?lottery=' + params.lottery + '&page=' + pageMap[params.template][""] }, reloadOnSearch: false}); 
  $routeProvider.when('/load/:lottery/:template/:page', {templateUrl: function(params){ return '/mobile/member/load?lottery=' + params.lottery + '&page=' + params.page }, reloadOnSearch: false}); 
  $routeProvider.when('/load/:lottery/:template/:page/:index', {templateUrl: function(params){ return '/mobile/member/load?lottery=' + params.lottery + '&page=' + params.page + '&index=' + params.index;}, reloadOnSearch: false}); 
  
});

app.run(function($rootScope, $location) {
    $rootScope.$on( "$routeChangeStart", function(event, next, current) {
      if (typeof window.PeriodPanel !== 'undefined') {
        clearTimeout(accountTimer);
        clearTimeout(PeriodPanel.accountTimer);
        clearTimeout(PeriodPanel.resultTimer);
        clearTimeout(PeriodPanel.timer);
        clearTimeout(_lastBetsTimer);
        clearTimeout(_resultTimer);
        delete PeriodPanel;
      }
      if($location.$$path.substring(1,8) == "dresult") {
        $('#placeBetBtn').show()
      } else {
        $('#placeBetBtn').hide()
      }
    });
});

// //
// // `$drag` example: drag to dismiss
// //
// app.directive('dragToDismiss', function($drag, $parse, $timeout){
//   return {
//     restrict: 'A',
//     compile: function(elem, attrs) {
//       var dismissFn = $parse(attrs.dragToDismiss);
//       return function(scope, elem, attrs){
//         var dismiss = false;

//         $drag.bind(elem, {
//           constraint: {
//             minX: 0, 
//             minY: 0, 
//             maxY: 0 
//           },
//           move: function(c) {
//             if( c.left >= c.width / 4) {
//               dismiss = true;
//               elem.addClass('dismiss');
//             } else {
//               dismiss = false;
//               elem.removeClass('dismiss');
//             }
//           },
//           cancel: function(){
//             elem.removeClass('dismiss');
//           },
//           end: function(c, undo, reset) {
//             if (dismiss) {
//               elem.addClass('dismitted');
//               $timeout(function() { 
//                 scope.$apply(function() {
//                   dismissFn(scope);  
//                 });
//               }, 400);
//             } else {
//               reset();
//             }
//           }
//         });
//       };
//     }
//   };
// });

// //
// // Another `$drag` usage example: this is how you could create 
// // a touch enabled "deck of cards" carousel. See `carousel.html` for markup.
// //
// app.directive('carousel', function(){
//   return {
//     restrict: 'C',
//     scope: {},
//     controller: function($scope) {
//       this.itemCount = 0;
//       this.activeItem = null;

//       this.addItem = function(){
//         var newId = this.itemCount++;
//         this.activeItem = this.itemCount == 1 ? newId : this.activeItem;
//         return newId;
//       };

//       this.next = function(){
//         this.activeItem = this.activeItem || 0;
//         this.activeItem = this.activeItem == this.itemCount - 1 ? 0 : this.activeItem + 1;
//       };

//       this.prev = function(){
//         this.activeItem = this.activeItem || 0;
//         this.activeItem = this.activeItem === 0 ? this.itemCount - 1 : this.activeItem - 1;
//       };
//     }
//   };
// });

// app.directive('carouselItem', function($drag) {
//   return {
//     restrict: 'C',
//     require: '^carousel',
//     scope: {},
//     transclude: true,
//     template: '<div class="item"><div ng-transclude></div></div>',
//     link: function(scope, elem, attrs, carousel) {
//       scope.carousel = carousel;
//       var id = carousel.addItem();
      
//       var zIndex = function(){
//         var res = 0;
//         if (id == carousel.activeItem){
//           res = 2000;
//         } else if (carousel.activeItem < id) {
//           res = 2000 - (id - carousel.activeItem);
//         } else {
//           res = 2000 - (carousel.itemCount - 1 - carousel.activeItem + id);
//         }
//         return res;
//       };

//       scope.$watch(function(){
//         return carousel.activeItem;
//       }, function(n, o){
//         elem[0].style['z-index']=zIndex();
//       });
      

//       $drag.bind(elem, {
//         constraint: { minY: 0, maxY: 0 },
//         adaptTransform: function(t, dx, dy, x, y, x0, y0) {
//           var maxAngle = 15;
//           var velocity = 0.02;
//           var r = t.getRotation();
//           var newRot = r + Math.round(dx * velocity);
//           newRot = Math.min(newRot, maxAngle);
//           newRot = Math.max(newRot, -maxAngle);
//           t.rotate(-r);
//           t.rotate(newRot);
//         },
//         move: function(c){
//           if(c.left >= c.width / 4 || c.left <= -(c.width / 4)) {
//             elem.addClass('dismiss');  
//           } else {
//             elem.removeClass('dismiss');  
//           }          
//         },
//         cancel: function(){
//           elem.removeClass('dismiss');
//         },
//         end: function(c, undo, reset) {
//           elem.removeClass('dismiss');
//           if(c.left >= c.width / 4) {
//             scope.$apply(function() {
//               carousel.next();
//             });
//           } else if (c.left <= -(c.width / 4)) {
//             scope.$apply(function() {
//               carousel.next();
//             });
//           }
//           reset();
//         }
//       });
//     }
//   };
// });


//
// For this trivial demo we have just a unique MainController 
// for everything
//
app.controller('MainController', function($rootScope, $scope){

  // User agent displayed in home page
  $scope.userAgent = navigator.userAgent;
  
  // Needed for the loading screen
  $rootScope.$on('$routeChangeStart', function(){
    $rootScope.loading = true;
  });

  $rootScope.$on('$routeChangeSuccess', function(){
    $rootScope.loading = false;
  });

  // // Fake text i used here and there.
  // $scope.lorem = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel explicabo, aliquid eaque soluta nihil eligendi adipisci error, illum corrupti nam fuga omnis quod quaerat mollitia expedita impedit dolores ipsam. Obcaecati.';

  // // 
  // // 'Scroll' screen
  // // 
  // var scrollItems = [];

  // for (var i=1; i<=100; i++) {
  //   scrollItems.push('Item ' + i);
  // }

  // $scope.scrollItems = scrollItems;

  // $scope.bottomReached = function() {
  //   alert('Congrats you scrolled to the end of the list!');
  // }

 
  // //
  // // 'Forms' screen
  // //  
  // $scope.rememberMe = true;
  // $scope.email = 'me@example.com';
  
  // $scope.login = function() {
  //   alert('You submitted the login form');
  // };

  // // 
  // // 'Drag' screen
  // // 
  // $scope.notices = [];
  
  // for (var j = 0; j < 10; j++) {
  //   $scope.notices.push({icon: 'envelope', message: 'Notice ' + (j + 1) });
  // }

  // $scope.deleteNotice = function(notice) {
  //   var index = $scope.notices.indexOf(notice);
  //   if (index > -1) {
  //     $scope.notices.splice(index, 1);
  //   }
  // };
});

pageMap = {
  'SSC' : {
    '整合' : 'lm',
    '第一球': 'ball/1',
  '第二球' : 'ball/2',
  '第三球' : 'ball/3',
  '第四球' : 'ball/4',
  '第五球' : 'ball/5',
  '': 'lm'
  },
  'KLSF' : {
    '整合' : 'lm',
    '单球1～8' : 'balls',
    '第一球' : 'ball/1',
  '第二球' : 'ball/2',
  '第三球' : 'ball/3',
  '第四球' : 'ball/4',
  '第五球' : 'ball/5',
  '第六球' : 'ball/6',
  '第七球' : 'ball/7',
  '第八球' : 'ball/8',
  '正码' : 'zm',
  '连码' : 'mp',
  '' : 'lm'
  },
  'PK10' : {
    '两面盘' : 'lm',
    '单号1 ~ 10': '110',
  '冠亚军组合' : 'gy',
  '': 'lm'
  },
  'K3' : {
    '大小骰宝' : 'all',
    '鱼虾蟹骰宝': 'yxx',
  '': 'all'
  },
  'CQSSC' : {
    '整合' : 'lm',
    '第一球': 'ball/1',
  '第二球' : 'ball/2',
  '第三球' : 'ball/3',
  '第四球' : 'ball/4',
  '第五球' : 'ball/5',
  '': 'lm'
  },
  'GXKLSF' : {
    '两面' : 'lm',
    '单号1~5' : '15',
    '第一球' : 'ball/1',
    '第二球' : 'ball/2',
    '第三球' : 'ball/3',
    '第四球' : 'ball/4',
    '第五球' : 'ball/5',
    '' : 'lm'
  },
  '11X5' : {
    '两面' : 'lm',
    '单号' : 'dh',
    '连码' : 'mp',
    '直选' : 'zx/2',
    '' : 'lm'
  },
  'KL8' : {
    '整合' : 'all',
    '正码' : 'balls',
    '' : 'all'
  },
  '3D' : {
    '主势盘' : 'lm',
    '一字组合' : '1z',
    '二字组合' : '2z',
    '三字组合' : '3z',
    '一字定位' : '1zdw',
    '二字定位' : '2zdw/0',
    '三字定位' : '3zdw', //TODO
    '二字和数' : '2zhs/12', //TODO
    '三字和数' : '3zhs',
    '组选三' : 'zx3', //TODO
    '组选六' : 'zx6', //TODO
    '跨度' : 'kd',
    '' : 'lm'
  },
  'HK6' : {
    '特码' : 'tm', //TODO
    '两面' : 'lm/0',
    '色波' : 'sb/0',
    '十二生肖' : '12sx',
    '合肖' : 'hx', //TODO
    '头尾数' : 'tws', 
    '正码' : 'zma/A',
    '正码特' : 'zmt/1', //TODO
    '正码1-6' : 'zm16',
    '五行' : 'wx',
    '一肖尾数' : 'yx', //TODO
    '正肖' : 'zx', 
    '7色波' : '7sb',
    '总肖' : 'zsx',
    '自选不中' : 'zxbz',  //TODO
    '对碰' : 'dpelx/2',  //TODO
    '连码' : 'mp',  //TODO
    '' : 'tm'
  },
  'PCEGG' : {
	    '主势盘' : 'lm',
	    '特码包三' : 'tmbs',
	    '': 'lm'
  }
};