		

		/*电子游戏*/
		function pageShow() {
			$("#page-3").show();
			$("#eleGamePageingThere1").attr("class","focusOne");
			$("#page3").attr("class","focusOne");
			gamePaging($("tbody[id = 'page3Tbody'] tr"),8,0);
			$("#page1").click(function(){
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").show();
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").attr("class","c");
				});
			$("#page2").click(function(){
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").show();
				$("#page-1").hide();
				$("#eleGamePageingTwo1").attr("class","focusOne");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").attr("class","c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page2Tbody'] tr"),8,0);
				});
			$("#page3").click(function(){
				$("#page-4").hide();
				$("#page-3").show();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingThere1").attr("class","focusOne");
				$("#page4").removeClass("c");
				$("#page3").attr("class","c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				});
			$("#page4").click(function(){
				$("#page-4").show();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingThere1").attr("class","focusOne");
				$("#page4").attr("class","c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				});
		}

		function gamePaging(trAts,trNum,ksNum) {
			trAts.each(function() {
				$(this).hide();
			});
			for (var i = ksNum; i < trNum; i++) {
				trAts.eq(i).show();
			}
		}
		

		/*第一个厅第一页*/
		function pageTherepagingGameOne () {
			$("#eleGamePageingThere1").attr("class","focusOne");
			$("#eleGamePageingThere2").removeClass("focusOne");
			$("#eleGamePageingThere3").removeClass("focusOne");
			$("#eleGamePageingThere4").removeClass("focusOne");
			window.location.hash = "#page3";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),8,0);
		}

		/*第一个厅第二页*/
		function pageTherepagingGameTwo () {
			$("#eleGamePageingThere2").attr("class","focusOne");
			$("#eleGamePageingThere1").removeClass("focusOne");
			$("#eleGamePageingThere3").removeClass("focusOne");
			$("#eleGamePageingThere4").removeClass("focusOne");
			window.location.hash = "#page3";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),16,8);
		}

		/*第一个厅第三页*/
		function pageTherepagingGameThere () {
			$("#eleGamePageingThere3").attr("class","focusOne");
			$("#eleGamePageingThere1").removeClass("focusOne");
			$("#eleGamePageingThere2").removeClass("focusOne");
			$("#eleGamePageingThere4").removeClass("focusOne");
			window.location.hash = "#page3";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),24,16);
		}

		/*第一个厅第四页*/
		function pageTherepagingGameFour () {
			$("#eleGamePageingThere4").attr("class","focusOne");
			$("#eleGamePageingThere2").removeClass("focusOne");
			$("#eleGamePageingThere3").removeClass("focusOne");
			$("#eleGamePageingThere1").removeClass("focusOne");
			window.location.hash = "#page3";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),25,24);
		}

		/*第二个厅第一页*/
		function pageTwopagingGameOne () {
			$("#eleGamePageingTwo1").attr("class","focusOne");
			$("#eleGamePageingTwo2").removeClass("focusOne");
			window.location.hash = "#page3";
			gamePaging($("tbody[id = 'page2Tbody'] tr"),8,0);
		}
		/*第二个厅第二页*/
		function pageTwopagingGameTwo () {
			$("#eleGamePageingTwo2").attr("class","focusOne");
			$("#eleGamePageingTwo1").removeClass("focusOne");
			window.location.hash = "#page3";
			gamePaging($("tbody[id = 'page2Tbody'] tr"),15,8);
		}


		function pageNumberOne() {
			$(".electroncGamePageingOneClass").attr("class","focusOne");
		}
		function pageNumberTwo () {
			$(".electroncGamePageingTwoClass").attr("class","focusOne");
		}
		function pageNumberThere () {
			$("#page3").attr("class","focusOne");
		}
		function pageNumberFour () {
			$("#page3").attr("class","focusOne");
		}

		/*AG电子游戏*/
		function pageShowAG() {
			$("#AGpage-1").show();
			$("#AGeleGamePageingOne1").attr("class","focusOne");
			$("#AGpage1").attr("class","c");
			gamePaging($("tbody[id = 'AGpage1Tbody'] tr"),8,0);
			$("#AGpage1").click(function(){
				$("#AGpage-3").hide();
				$("#AGpage-2").hide();
				$("#AGpage-1").show();
				$("#AGeleGamePageingThere1").attr("class","focusOne");
				$("#AGpage3").removeClass("c");
				$("#AGpage2").removeClass("c");
				$("#AGpage1").attr("class","c");
				});
			$("#AGpage2").click(function(){
				$("#AGpage-3").hide();
				$("#AGpage-2").show();
				$("#AGpage-1").hide();
				$("#AGeleGamePageingTwo1").attr("class","focusOne");
				$("#AGpage3").removeClass("c");
				$("#AGpage2").attr("class","c");
				$("#AGpage1").removeClass("c");
				gamePaging($("tbody[id = 'AGpage2Tbody'] tr"),8,0);
				});
			$("#AGpage3").click(function(){
				$("#AGpage-3").show();
				$("#AGpage-2").hide();
				$("#AGpage-1").hide();
				$("#AGeleGamePageingThere1").attr("class","focusOne");
				$("#AGpage3").attr("class","c");
				$("#AGpage2").removeClass("c");
				$("#AGpage1").removeClass("c");
				});
		}

		/*第一个厅第一页*/
		function AGpageOnepagingGameOne () {
			$("#AGeleGamePageingOne1").attr("class","focusOne");
			$("#AGeleGamePageingOne2").removeClass("focusOne");
			$("#AGeleGamePageingOne3").removeClass("focusOne");
			window.location.hash = "#AGpage1";
			gamePaging($("tbody[id = 'AGpage1Tbody'] tr"),8,0);
		}

		/*第一个厅第二页*/
		function AGpageOnepagingGameTwo () {
			$("#AGeleGamePageingOne2").attr("class","focusOne");
			$("#AGeleGamePageingOne1").removeClass("focusOne");
			$("#AGeleGamePageingOne3").removeClass("focusOne");
			window.location.hash = "#AGpage1";
			gamePaging($("tbody[id = 'AGpage1Tbody'] tr"),16,8);
		}

		/*第一个厅第三页*/
		function AGpageOnepagingGameThere () {
			$("#AGeleGamePageingOne3").attr("class","focusOne");
			$("#AGeleGamePageingOne1").removeClass("focusOne");
			$("#AGeleGamePageingOne2").removeClass("focusOne");
			window.location.hash = "#AGpage1";
			gamePaging($("tbody[id = 'AGpage1Tbody'] tr"),24,16);
		}

		/*第二个厅第一页*/
		function AGpageTwopagingGameOne () {
			$("#AGeleGamePageingTwo1").attr("class","focusOne");
			$("#AGeleGamePageingTwo2").removeClass("focusOne");
			$("#AGeleGamePageingTwo3").removeClass("focusOne");
			window.location.hash = "#AGpage2";
			gamePaging($("tbody[id = 'AGpage2Tbody'] tr"),8,0);
		}

		/*第二个厅第二页*/
		function AGpageTwopagingGameTwo () {
			$("#AGeleGamePageingTwo2").attr("class","focusOne");
			$("#AGeleGamePageingTwo1").removeClass("focusOne");
			$("#AGeleGamePageingTwo3").removeClass("focusOne");
			window.location.hash = "#AGpage2";
			gamePaging($("tbody[id = 'AGpage2Tbody'] tr"),16,8);
		}

		/*第二个厅第三页*/
		function AGpageTwopagingGameThere () {
			$("#AGeleGamePageingTwo3").attr("class","focusOne");
			$("#AGeleGamePageingTwo1").removeClass("focusOne");
			$("#AGeleGamePageingTwo2").removeClass("focusOne");
			window.location.hash = "#AGpage2";
			gamePaging($("tbody[id = 'AGpage2Tbody'] tr"),24,16);
		}

		/*BBIN电子游戏*/
		function pageShowBBIN() {
			$("#page-1").show();
			$("#eleGamePageingOne1").attr("class","focusOne");
			$("#page1").attr("class","c");
			gamePaging($("tbody[id = 'page1Tbody'] tr"),8,0);
			$("#page1").click(function(){
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").show();
				$("#eleGamePageingThere1").attr("class","focusOne");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").attr("class","c");
				});
			$("#page2").click(function(){
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").show();
				$("#page-1").hide();
				$("#eleGamePageingTwo1").attr("class","focusOne");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").attr("class","c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page2Tbody'] tr"),8,0);
				});
			$("#page3").click(function(){
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").show();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingThree1").attr("class","focusOne");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").attr("class","c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page3Tbody'] tr"),8,0);
				});
			$("#page4").click(function(){
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").show();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFour1").attr("class","focusOne");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").attr("class","c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page4Tbody'] tr"),8,0);
				});
			$("#page5").click(function(){
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").show();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFives1").attr("class","focusOne");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").attr("class","c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page5Tbody'] tr"),8,0);
				});
			$("#page6").click(function(){
				$("#page-7").hide();
				$("#page-6").show();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingSix1").attr("class","focusOne");
				$("#page7").removeClass("c");
				$("#page6").attr("class","c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page6Tbody'] tr"),8,0);
				});
			$("#page7").click(function(){
				$("#page-7").show();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingSeven1").attr("class","focusOne");
				$("#page7").attr("class","c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page7Tbody'] tr"),8,0);
				});
		}

		/*BBIN第一个厅第一页*/
		function BBINpageOnepagingGameOne () {
			$("#eleGamePageingOne1").attr("class","focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),8,0);
		}
		/*BBIN第一个厅第二页*/
		function BBINpageOnepagingGameTwo () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").attr("class","focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),16,8);
		}
		/*BBIN第一个厅第三页*/
		function BBINpageOnepagingGameThere () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").attr("class","focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),24,16);
		}
		/*BBIN第一个厅第四页*/
		function BBINpageOnepagingGameFour () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").attr("class","focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),32,24);
		}
		/*BBIN第一个厅第五页*/
		function BBINpageOnepagingGameFives () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").attr("class","focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),40,32);
		}
		/*BBIN第一个厅第六页*/
		function BBINpageOnepagingGameSix () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").attr("class","focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),46,40);
		}

		/*BBIN第三个厅第一页*/
		function BBINpageThreepagingGameOne () {
			$("#eleGamePageingThree1").attr("class","focusOne");
			$("#eleGamePageingThree2").removeClass("focusOne");
			window.location.hash = "#page3";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),8,0);
		}
		/*BBIN第三个厅第二页*/
		function BBINpageThreepagingGameTwo () {
			$("#eleGamePageingThree1").removeClass("focusOne");
			$("#eleGamePageingThree2").attr("class","focusOne");
			window.location.hash = "#page3";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),16,8);
		}

		/*BBIN第4个厅第一页*/
		function BBINpageFourpagingGameOne () {
			$("#eleGamePageingFour1").attr("class","focusOne");
			$("#eleGamePageingFour2").removeClass("focusOne");
			$("#eleGamePageingFour3").removeClass("focusOne");
			$("#eleGamePageingFour4").removeClass("focusOne");
			window.location.hash = "#page4";
			gamePaging($("tbody[id = 'page4Tbody'] tr"),8,0);
		}
		/*BBIN第4个厅第二页*/
		function BBINpageFourpagingGameTwo () {
			$("#eleGamePageingFour1").removeClass("focusOne");
			$("#eleGamePageingFour2").attr("class","focusOne");
			$("#eleGamePageingFour3").removeClass("focusOne");
			$("#eleGamePageingFour4").removeClass("focusOne");
			window.location.hash = "#page4";
			gamePaging($("tbody[id = 'page4Tbody'] tr"),16,8);
		}
		/*BBIN第4个厅第三页*/
		function BBINpageFourpagingGameThree () {
			$("#eleGamePageingFour1").removeClass("focusOne");
			$("#eleGamePageingFour2").removeClass("focusOne");
			$("#eleGamePageingFour3").attr("class","focusOne");
			$("#eleGamePageingFour4").removeClass("focusOne");
			window.location.hash = "#page4";
			gamePaging($("tbody[id = 'page4Tbody'] tr"),24,16);
		}
		/*BBIN第4个厅第四页*/
		function BBINpageFourpagingGameFour () {
			$("#eleGamePageingFour1").removeClass("focusOne");
			$("#eleGamePageingFour2").removeClass("focusOne");
			$("#eleGamePageingFour3").removeClass("focusOne");
			$("#eleGamePageingFour4").attr("class","focusOne");
			window.location.hash = "#page4";
			gamePaging($("tbody[id = 'page4Tbody'] tr"),32,24);
		}
		/*BBIN第4个厅第五页
		function BBINpageFourpagingGameFives () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),40,32);
		}
		BBIN第4个厅第六页
		function BBINpageFourpagingGameSix () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").attr("class","focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),46,40);
		}*/

		/*YY电子游戏*/
		function pageShowYY() {
			$("#page-1").show();
			$("#eleGamePageingOne1").attr("class","focusOne");
			$("#page1").attr("class","c");
			gamePaging($("tbody[id = 'page1Tbody'] tr"),8,0);
			$("#page1").click(function(){
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").show();
				$("#eleGamePageingThere1").attr("class","focusOne");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").attr("class","c");
				});
			$("#page2").click(function(){
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").show();
				$("#page-1").hide();
				$("#eleGamePageingTwo1").attr("class","focusOne");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").attr("class","c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page2Tbody'] tr"),8,0);
				});
			$("#page3").click(function(){
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").show();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingThree1").attr("class","focusOne");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").attr("class","c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page3Tbody'] tr"),8,0);
				});
			$("#page4").click(function(){
				$("#page-5").hide();
				$("#page-4").show();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFour1").attr("class","focusOne");
				$("#page5").removeClass("c");
				$("#page4").attr("class","c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page4Tbody'] tr"),8,0);
				});
			$("#page5").click(function(){
				$("#page-5").show();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFives1").attr("class","focusOne");
				$("#page5").attr("class","c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page5Tbody'] tr"),8,0);
				});
		}

		/*YY第一个厅第一页*/
		function YYpageOnepagingGameOne () {
			$("#eleGamePageingOne1").attr("class","focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),8,0);
		}
		/*YY第一个厅第二页*/
		function YYpageOnepagingGameTwo () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").attr("class","focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),16,8);
		}
		/*YY第一个厅第三页*/
		function YYpageOnepagingGameThere () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").attr("class","focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),24,16);
		}
		/*YY第一个厅第四页*/
		function YYpageOnepagingGameFour () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").attr("class","focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),32,24);
		}

		/*YY第2个厅第一页*/
		function YYpageTwopagingGameOne () {
			$("#eleGamePageingTwo1").attr("class","focusOne");
			$("#eleGamePageingTwo2").removeClass("focusOne");
			window.location.hash = "#page2";
			gamePaging($("tbody[id = 'page2Tbody'] tr"),8,0);
		}
		/*YY第2个厅第二页*/
		function YYpageTwopagingGameTwo () {
			$("#eleGamePageingTwo1").removeClass("focusOne");
			$("#eleGamePageingTwo2").attr("class","focusOne");
			window.location.hash = "#page2";
			gamePaging($("tbody[id = 'page2Tbody'] tr"),16,8);
		}
		
		
		
		

		/*PT电子游戏*/
		function pageShowAll() {
			$("#page-1").show();
			$("#eleGamePageingOne1").attr("class","focusOne");
			$("#page1").attr("class","c");
			gamePaging($("tbody[id = 'page1Tbody'] tr"),8,0);
			$("#page1").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").show();
				$("#eleGamePageingThere1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").attr("class","c");
				});
			$("#page2").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").show();
				$("#page-1").hide();
				$("#eleGamePageingTwo1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").attr("class","c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page2Tbody'] tr"),8,0);
				});
			$("#page3").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").show();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingThree1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").attr("class","c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page3Tbody'] tr"),8,0);
				});
			$("#page4").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").show();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFour1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").attr("class","c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page4Tbody'] tr"),8,0);
				});
			$("#page5").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").show();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFives1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").attr("class","c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page5Tbody'] tr"),8,0);
				});
			$("#page5").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").show();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFive1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").attr("class","c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page5Tbody'] tr"),8,0);
				});
			$("#page6").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").show();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingSix1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").attr("class","c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page6Tbody'] tr"),8,0);
				});
			$("#page7").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").show();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingSeven1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").attr("class","c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page7Tbody'] tr"),8,0);
				});
			$("#page8").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").show();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingEight1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").attr("class","c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page8Tbody'] tr"),8,0);
				});
			$("#page9").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").show();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingNine1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").attr("class","c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page9Tbody'] tr"),8,0);
				});
			$("#page10").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-11").hide();
				$("#page-10").show();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingTen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").attr("class","c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page10Tbody'] tr"),8,0);
				});
			$("#page11").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").show();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingEleven1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").attr("class","c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page12").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").show();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingTwelve1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").attr("class","c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page13").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").show();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingThirteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").attr("class","c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page14").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").show();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page15").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-14").hide();
				$("#page-15").show();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page14").removeClass("c");
				$("#page15").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page16").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-15").hide();
				$("#page-149").hide();
				$("#page-16").show();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page16").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page17").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-17").show();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page17").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page18").click(function(){
				$("#page-19").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-18").show();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page18").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page19").click(function(){
				$("#page-19").show();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-18").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page19").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
		}
		

		/*PT第一个厅第一页*/
		function pageOnepagingGameOne () {
			$("#eleGamePageingOne1").attr("class","focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),8,0);
		}
		/*第一个厅第二页*/
		function pageOnepagingGameTwo () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").attr("class","focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),16,8);
		}
		/*第一个厅第三页*/
		function pageOnepagingGameThere () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").attr("class","focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),24,16);
		}
		/*第一个厅第四页*/
		function pageOnepagingGameFour () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").attr("class","focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),32,24);
		}
		/*第一个厅第五页*/
		function pageOnepagingGameFives () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").attr("class","focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),40,32);
		}
		/*第一个厅第六页*/
		function pageOnepagingGameSix () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").attr("class","focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),48,40);
		}
		/*第一个厅第七页*/
		function pageOnepagingGameSeven () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").attr("class","focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),56,48);
		}
		/*第一个厅第八页*/
		function pageOnepagingGameEight () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").attr("class","focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),64,56);
		}
		/*第一个厅第九页*/
		function pageOnepagingGameNine () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").attr("class","focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),72,64);
		}
		/*第一个厅第十页*/
		function pageOnepagingGameTen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").attr("class","focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),80,72);
		}
		/*第一个厅第十一页*/
		function pageOnepagingGameEleven () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").attr("class","focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),88,80);
		}
		function pageOnepagingGameTwelve () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").attr("class","focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),96,88);
		}
		function pageOnepagingGameThirteen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").attr("class","focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),104,96);
		}
		function pageOnepagingGameFourteen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").attr("class","focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),112,104);
		}
		function pageOnepagingGameFifteen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").attr("class","focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),120,112);
		}
		function pageOnepagingGameSixteen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne16").attr("class","focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),128,120);
		}
		function pageOnepagingGameSeventeen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne17").attr("class","focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),136,128);
		}
		function pageOnepagingGameEighteenth () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne18").attr("class","focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),144,136);
		}
		function pageOnepagingGameNineteenth () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne19").attr("class","focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),152,144);
		}
		/*卡牌游戏*/
		function pageTwopagingGameOne () {
			$("#eleGamePageingTwo4").removeClass("focusOne");
			$("#eleGamePageingTwo1").attr("class","focusOne");
			$("#eleGamePageingTwo2").removeClass("focusOne");
			$("#eleGamePageingTwo3").removeClass("focusOne");
			window.location.hash = "#page2";
			gamePaging($("tbody[id = 'page2Tbody'] tr"),8,0);
		}
		function pageTwopagingGameTwo () {
			$("#eleGamePageingTwo4").removeClass("focusOne");
			$("#eleGamePageingTwo2").attr("class","focusOne");
			$("#eleGamePageingTwo1").removeClass("focusOne");
			$("#eleGamePageingTwo3").removeClass("focusOne");
			window.location.hash = "#page2";
			gamePaging($("tbody[id = 'page2Tbody'] tr"),16,8);
		}
		function pageTwopagingGameThree () {
			$("#eleGamePageingTwo4").removeClass("focusOne");
			$("#eleGamePageingTwo3").attr("class","focusOne");
			$("#eleGamePageingTwo2").removeClass("focusOne");
			$("#eleGamePageingTwo1").removeClass("focusOne");
			window.location.hash = "#page2";
			gamePaging($("tbody[id = 'page2Tbody'] tr"),24,16);
		}
		function pageTwopagingGameFour () {
			$("#eleGamePageingTwo4").attr("class","focusOne");
			$("#eleGamePageingTwo3").removeClass("focusOne");
			$("#eleGamePageingTwo2").removeClass("focusOne");
			$("#eleGamePageingTwo1").removeClass("focusOne");
			window.location.hash = "#page2";
			gamePaging($("tbody[id = 'page2Tbody'] tr"),32,24);
		}
		/*刮刮乐*/
		function pageThreepagingGameOne () {
			$("#eleGamePageingThree1").attr("class","focusOne");
			$("#eleGamePageingThree2").removeClass("focusOne");
			$("#eleGamePageingThree3").removeClass("focusOne");
			$("#eleGamePageingThree4").removeClass("focusOne");
			$("#eleGamePageingThree5").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),8,0);
		}
		/*第二个厅第二页*/
		function pageThreepagingGameTwo () {
			$("#eleGamePageingThree1").removeClass("focusOne");
			$("#eleGamePageingThree2").attr("class","focusOne");
			$("#eleGamePageingThree3").removeClass("focusOne");
			$("#eleGamePageingThree4").removeClass("focusOne");

			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),16,8);
		}
		
		function pageFourpagingGameOne () {
			$("#eleGamePageingFour1").attr("class","focusOne");

			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page4Tbody'] tr"),8,0);
		}
		
		
		
		function pageFivepagingGameOne () {
			$("#eleGamePageingFive1").attr("class","focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),8,0);
		}
		/*第一个厅第二页*/
		function pageFivepagingGameTwo () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").attr("class","focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),16,8);
		}
		/*第一个厅第三页*/
		function pageFivepagingGameThere () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").attr("class","focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),24,16);
		}
		/*第一个厅第四页*/
		function pageFivepagingGameFour () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").attr("class","focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),32,24);
		}
		/*第一个厅第五页*/
		function pageFivepagingGameFives () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").attr("class","focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
		    $("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),40,32);
		}
		/*第一个厅第六页*/
		function pageFivepagingGameSix () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").attr("class","focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),48,40);
		}
		/*第一个厅第七页*/
		function pageFivepagingGameSeven () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").attr("class","focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),56,48);
		}
		/*第一个厅第八页*/
		function pageFivepagingGameEight () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").attr("class","focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),64,56);
		}
		/*第一个厅第九页*/
		function pageFivepagingGameNine () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").attr("class","focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),72,64);
		}
		/*第一个厅第十页*/
		function pageFivepagingGameTen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").attr("class","focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),80,72);
		}
		/*第一个厅第十一页*/
		function pageFivepagingGameEleven () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").attr("class","focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),88,80);
		}
		function pageFivepagingGameTwelve () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").attr("class","focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),96,88);
		}
		function pageFivepagingGameThirteen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").attr("class","focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),104,96);
		}
		function pageFivepagingGameFourteen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").attr("class","focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),112,104);
		}
		function pageFivepagingGameFifteen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").attr("class","focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),120,112);
		}
		function pageFivepagingGameSixteen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive16").attr("class","focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),128,120);
		}
		function pageFivepagingGameSeventeen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive17").attr("class","focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),136,128);
		}
		
		/*第三个厅第三页*/
/*		function pageThreepagingGameThree () {
			$("#eleGamePageingThree1").removeClass("focusOne");
			$("#eleGamePageingThree2").removeClass("focusOne");
			$("#eleGamePageingThree3").attr("class","focusOne");
			$("#eleGamePageingThree4").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),24,16);
		}
		第三个厅第四页
		function pageThreepagingGameFour () {
			$("#eleGamePageingThree1").removeClass("focusOne");
			$("#eleGamePageingThree2").removeClass("focusOne");
			$("#eleGamePageingThree3").removeClass("focusOne");
			$("#eleGamePageingThree4").attr("class","focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),32,24);
		}*/
		
		function pageSixpagingGameOne () {
			$("#eleGamePageingSix1").attr("class","focusOne");
			$("#eleGamePageingSix2").removeClass("focusOne");
			$("#eleGamePageingSix3").removeClass("focusOne");
			$("#eleGamePageingSix4").removeClass("focusOne");
			$("#eleGamePageingSix").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page6Tbody'] tr"),8,0);
		}
		
		function pageSixpagingGameTwo () {
			$("#eleGamePageingSix2").attr("class","focusOne");
			$("#eleGamePageingSix1").removeClass("focusOne");
			$("#eleGamePageingSix3").removeClass("focusOne");
			$("#eleGamePageingSix4").removeClass("focusOne");
			$("#eleGamePageingSix").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page6Tbody'] tr"),16,8);
		}
		
		function pageSixpagingGameThree () {
			$("#eleGamePageingSix3").attr("class","focusOne");
			$("#eleGamePageingSix2").removeClass("focusOne");
			$("#eleGamePageingSix1").removeClass("focusOne");
			$("#eleGamePageingSix4").removeClass("focusOne");
			$("#eleGamePageingSix").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page6Tbody'] tr"),24,16);
		}
		
		
		function pageSevenpagingGameOne () {
			$("#eleGamePageingSeven1").attr("class","focusOne");
			$("#eleGamePageingSeven2").removeClass("focusOne");
			$("#eleGamePageingSeven3").removeClass("focusOne");
			$("#eleGamePageingSeven4").removeClass("focusOne");
			$("#eleGamePageingSeven").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page7Tbody'] tr"),8,0);
		}
		
		function pageSevenpagingGameTwo () {
			$("#eleGamePageingSeven2").attr("class","focusOne");
			$("#eleGamePageingSeven1").removeClass("focusOne");
			$("#eleGamePageingSeven3").removeClass("focusOne");
			$("#eleGamePageingSeven4").removeClass("focusOne");
			$("#eleGamePageingSeven").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page7Tbody'] tr"),16,8);
		}
		
		function pageSevenpagingGameThree () {
			$("#eleGamePageingSeven3").attr("class","focusOne");
			$("#eleGamePageingSeven2").removeClass("focusOne");
			$("#eleGamePageingSeven1").removeClass("focusOne");
			$("#eleGamePageingSeven4").removeClass("focusOne");
			$("#eleGamePageingSeven").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page7Tbody'] tr"),24,16);
		}
		
		

		

		/*PT电子游戏*/
		function pageShowPT() {
			$("#page-1").show();
			$("#eleGamePageingOne1").attr("class","focusOne");
			$("#page1").attr("class","c");
			gamePaging($("tbody[id = 'page1Tbody'] tr"),8,0);
			$("#page1").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").show();
				$("#eleGamePageingThere1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").attr("class","c");
				});
			$("#page2").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").show();
				$("#page-1").hide();
				$("#eleGamePageingTwo1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").attr("class","c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page2Tbody'] tr"),8,0);
				});
			$("#page3").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").show();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingThree1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").attr("class","c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page3Tbody'] tr"),8,0);
				});
			$("#page4").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").show();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFour1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").attr("class","c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page4Tbody'] tr"),8,0);
				});
			$("#page5").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").show();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFives1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").attr("class","c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page5Tbody'] tr"),8,0);
				});
			$("#page5").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").show();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFive1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").attr("class","c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page5Tbody'] tr"),8,0);
				});
			$("#page6").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").show();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingSix1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").attr("class","c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page6Tbody'] tr"),8,0);
				});
			$("#page7").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").show();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingSeven1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").attr("class","c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page7Tbody'] tr"),8,0);
				});
			$("#page8").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").show();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingEight1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").attr("class","c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page8Tbody'] tr"),8,0);
				});
			$("#page9").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").show();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingNine1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").attr("class","c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page9Tbody'] tr"),8,0);
				});
			$("#page10").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-11").hide();
				$("#page-10").show();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingTen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").attr("class","c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page10Tbody'] tr"),8,0);
				});
			$("#page11").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").show();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingEleven1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").attr("class","c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page12").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").hide();
				$("#page-12").show();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingTwelve1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").removeClass("c");
				$("#page12").attr("class","c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page13").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-13").show();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingThirteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page13").attr("class","c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page14").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").show();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page15").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-14").hide();
				$("#page-15").show();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page14").removeClass("c");
				$("#page15").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page16").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-17").hide();
				$("#page-15").hide();
				$("#page-149").hide();
				$("#page-16").show();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page16").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page17").click(function(){
				$("#page-19").hide();
				$("#page-18").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-17").show();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page18").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page17").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page18").click(function(){
				$("#page-19").hide();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-18").show();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page19").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page18").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
			$("#page19").click(function(){
				$("#page-19").show();
				$("#page-17").hide();
				$("#page-16").hide();
				$("#page-15").hide();
				$("#page-14").hide();
				$("#page-18").hide();
				$("#page-13").hide();
				$("#page-12").hide();
				$("#page-11").hide();
				$("#page-10").hide();
				$("#page-9").hide();
				$("#page-8").hide();
				$("#page-7").hide();
				$("#page-6").hide();
				$("#page-5").hide();
				$("#page-4").hide();
				$("#page-3").hide();
				$("#page-2").hide();
				$("#page-1").hide();
				$("#eleGamePageingFourteen1").attr("class","focusOne");
				$("#page18").removeClass("c");
				$("#page17").removeClass("c");
				$("#page16").removeClass("c");
				$("#page15").removeClass("c");
				$("#page14").removeClass("c");
				$("#page19").attr("class","c");
				$("#page13").removeClass("c");
				$("#page12").removeClass("c");
				$("#page11").removeClass("c");
				$("#page10").removeClass("c");
				$("#page9").removeClass("c");
				$("#page8").removeClass("c");
				$("#page7").removeClass("c");
				$("#page6").removeClass("c");
				$("#page5").removeClass("c");
				$("#page4").removeClass("c");
				$("#page3").removeClass("c");
				$("#page2").removeClass("c");
				$("#page1").removeClass("c");
				gamePaging($("tbody[id = 'page11Tbody'] tr"),8,0);
				});
		}
		

		/*PT第一个厅第一页*/
		function PTpageOnepagingGameOne () {
			$("#eleGamePageingOne1").attr("class","focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),8,0);
		}
		/*PT第一个厅第二页*/
		function PTpageOnepagingGameTwo () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").attr("class","focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),16,8);
		}
		/*PT第一个厅第三页*/
		function PTpageOnepagingGameThere () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").attr("class","focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),24,16);
		}
		/*PT第一个厅第四页*/
		function PTpageOnepagingGameFour () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").attr("class","focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),32,24);
		}
		/*PT第一个厅第五页*/
		function PTpageOnepagingGameFives () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").attr("class","focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),40,32);
		}
		/*PT第一个厅第六页*/
		function PTpageOnepagingGameSix () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").attr("class","focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),48,40);
		}
		/*PT第一个厅第七页*/
		function PTpageOnepagingGameSeven () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").attr("class","focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),56,48);
		}
		/*PT第一个厅第八页*/
		function PTpageOnepagingGameEight () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").attr("class","focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),64,56);
		}
		/*PT第一个厅第九页*/
		function PTpageOnepagingGameNine () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").attr("class","focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),72,64);
		}
		/*PT第一个厅第十页*/
		function PTpageOnepagingGameTen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").attr("class","focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),80,72);
		}
		/*PT第一个厅第十一页*/
		function PTpageOnepagingGameEleven () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").attr("class","focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),88,80);
		}
		function PTpageOnepagingGameTwelve () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").attr("class","focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),96,88);
		}
		function PTpageOnepagingGameThirteen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").attr("class","focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),104,96);
		}
		function PTpageOnepagingGameFourteen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").attr("class","focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),112,104);
		}
		function PTpageOnepagingGameFifteen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").attr("class","focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),120,112);
		}
		function PTpageOnepagingGameSixteen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne16").attr("class","focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),128,120);
		}
		function PTpageOnepagingGameSeventeen () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne17").attr("class","focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),136,128);
		}
		function PTpageOnepagingGameEighteenth () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne18").attr("class","focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),144,136);
		}
		function PTpageOnepagingGameNineteenth () {
			$("#eleGamePageingOne1").removeClass("focusOne");
			$("#eleGamePageingOne2").removeClass("focusOne");
			$("#eleGamePageingOne3").removeClass("focusOne");
			$("#eleGamePageingOne4").removeClass("focusOne");
			$("#eleGamePageingOne5").removeClass("focusOne");
			$("#eleGamePageingOne6").removeClass("focusOne");
			$("#eleGamePageingOne7").removeClass("focusOne");
			$("#eleGamePageingOne8").removeClass("focusOne");
			$("#eleGamePageingOne9").removeClass("focusOne");
			$("#eleGamePageingOne10").removeClass("focusOne");
			$("#eleGamePageingOne11").removeClass("focusOne");
			$("#eleGamePageingOne12").removeClass("focusOne");
			$("#eleGamePageingOne13").removeClass("focusOne");
			$("#eleGamePageingOne19").attr("class","focusOne");
			$("#eleGamePageingOne14").removeClass("focusOne");
			$("#eleGamePageingOne15").removeClass("focusOne");
			$("#eleGamePageingOne16").removeClass("focusOne");
			$("#eleGamePageingOne17").removeClass("focusOne");
			$("#eleGamePageingOne18").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page1Tbody'] tr"),152,144);
		}
		/*PT卡牌游戏*/
		function PTpageTwopagingGameOne () {
			$("#eleGamePageingTwo1").attr("class","focusOne");
			window.location.hash = "#page2";
			gamePaging($("tbody[id = 'page2Tbody'] tr"),8,0);
		}
		/*PT刮刮乐*/
		function PTpageThreepagingGameOne () {
			$("#eleGamePageingThree1").attr("class","focusOne");
			$("#eleGamePageingThree2").removeClass("focusOne");
			$("#eleGamePageingThree3").removeClass("focusOne");
			$("#eleGamePageingThree4").removeClass("focusOne");
			$("#eleGamePageingThree5").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),8,0);
		}
		/*PT第二个厅第二页*/
		function PTpageThreepagingGameTwo () {
			$("#eleGamePageingThree1").removeClass("focusOne");
			$("#eleGamePageingThree2").attr("class","focusOne");
			$("#eleGamePageingThree3").removeClass("focusOne");
			$("#eleGamePageingThree4").removeClass("focusOne");

			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),16,8);
		}
		
		function PTpageFourpagingGameOne () {
			$("#eleGamePageingFour1").attr("class","focusOne");

			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page4Tbody'] tr"),8,0);
		}
		
		
		
		function PTpageFivepagingGameOne () {
			$("#eleGamePageingFive1").attr("class","focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),8,0);
		}
		/*PT第一个厅第二页*/
		function PTpageFivepagingGameTwo () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").attr("class","focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),16,8);
		}
		/*PT第一个厅第三页*/
		function PTpageFivepagingGameThere () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").attr("class","focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),24,16);
		}
		/*PT第一个厅第四页*/
		function PTpageFivepagingGameFour () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").attr("class","focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),32,24);
		}
		/*PT第一个厅第五页*/
		function PTpageFivepagingGameFives () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").attr("class","focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
		    $("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),40,32);
		}
		/*PT第一个厅第六页*/
		function PTpageFivepagingGameSix () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").attr("class","focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),48,40);
		}
		/*PT第一个厅第七页*/
		function PTpageFivepagingGameSeven () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").attr("class","focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),56,48);
		}
		/*PT第一个厅第八页*/
		function PTpageFivepagingGameEight () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").attr("class","focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),64,56);
		}
		/*PT第一个厅第九页*/
		function PTpageFivepagingGameNine () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").attr("class","focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),72,64);
		}
		/*PT第一个厅第十页*/
		function PTpageFivepagingGameTen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").attr("class","focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),80,72);
		}
		/*PT第一个厅第十一页*/
		function PTpageFivepagingGameEleven () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").attr("class","focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),88,80);
		}
		function PTpageFivepagingGameTwelve () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").attr("class","focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),96,88);
		}
		function PTpageFivepagingGameThirteen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").attr("class","focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),104,96);
		}
		function PTpageFivepagingGameFourteen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").attr("class","focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),112,104);
		}
		function PTpageFivepagingGameFifteen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").attr("class","focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),120,112);
		}
		function PTpageFivepagingGameSixteen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive16").attr("class","focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive17").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),128,120);
		}
		function PTpageFivepagingGameSeventeen () {
			$("#eleGamePageingFive1").removeClass("focusOne");
			$("#eleGamePageingFive2").removeClass("focusOne");
			$("#eleGamePageingFive3").removeClass("focusOne");
			$("#eleGamePageingFive4").removeClass("focusOne");
			$("#eleGamePageingFive5").removeClass("focusOne");
			$("#eleGamePageingFive6").removeClass("focusOne");
			$("#eleGamePageingFive7").removeClass("focusOne");
			$("#eleGamePageingFive8").removeClass("focusOne");
			$("#eleGamePageingFive9").removeClass("focusOne");
			$("#eleGamePageingFive10").removeClass("focusOne");
			$("#eleGamePageingFive11").removeClass("focusOne");
			$("#eleGamePageingFive12").removeClass("focusOne");
			$("#eleGamePageingFive13").removeClass("focusOne");
			$("#eleGamePageingFive17").attr("class","focusOne");
			$("#eleGamePageingFive15").removeClass("focusOne");
			$("#eleGamePageingFive16").removeClass("focusOne");
			$("#eleGamePageingFive19").removeClass("focusOne");
			$("#eleGamePageingFive18").removeClass("focusOne");
			$("#eleGamePageingFive14").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page5Tbody'] tr"),136,128);
		}
		
		/*PT第三个厅第三页*/
/*		function PTpageThreepagingGameThree () {
			$("#eleGamePageingThree1").removeClass("focusOne");
			$("#eleGamePageingThree2").removeClass("focusOne");
			$("#eleGamePageingThree3").attr("class","focusOne");
			$("#eleGamePageingThree4").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),24,16);
		}
		PT第三个厅第四页
		function PTpageThreepagingGameFour () {
			$("#eleGamePageingThree1").removeClass("focusOne");
			$("#eleGamePageingThree2").removeClass("focusOne");
			$("#eleGamePageingThree3").removeClass("focusOne");
			$("#eleGamePageingThree4").attr("class","focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page3Tbody'] tr"),32,24);
		}*/
		
		function PTpageSixpagingGameOne () {
			$("#eleGamePageingSix1").attr("class","focusOne");
			$("#eleGamePageingSix2").removeClass("focusOne");
			$("#eleGamePageingSix3").removeClass("focusOne");
			$("#eleGamePageingSix4").removeClass("focusOne");
			$("#eleGamePageingSix").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page6Tbody'] tr"),8,0);
		}
		
		function PTpageSixpagingGameTwo () {
			$("#eleGamePageingSix2").attr("class","focusOne");
			$("#eleGamePageingSix1").removeClass("focusOne");
			$("#eleGamePageingSix3").removeClass("focusOne");
			$("#eleGamePageingSix4").removeClass("focusOne");
			$("#eleGamePageingSix").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page6Tbody'] tr"),16,8);
		}
		
		function PTpageSixpagingGameThree () {
			$("#eleGamePageingSix3").attr("class","focusOne");
			$("#eleGamePageingSix2").removeClass("focusOne");
			$("#eleGamePageingSix1").removeClass("focusOne");
			$("#eleGamePageingSix4").removeClass("focusOne");
			$("#eleGamePageingSix").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page6Tbody'] tr"),24,16);
		}
		
		
		function PTpageSevenpagingGameOne () {
			$("#eleGamePageingSeven1").attr("class","focusOne");
			$("#eleGamePageingSeven2").removeClass("focusOne");
			$("#eleGamePageingSeven3").removeClass("focusOne");
			$("#eleGamePageingSeven4").removeClass("focusOne");
			$("#eleGamePageingSeven").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page7Tbody'] tr"),8,0);
		}
		
		function PTpageSevenpagingGameTwo () {
			$("#eleGamePageingSeven2").attr("class","focusOne");
			$("#eleGamePageingSeven1").removeClass("focusOne");
			$("#eleGamePageingSeven3").removeClass("focusOne");
			$("#eleGamePageingSeven4").removeClass("focusOne");
			$("#eleGamePageingSeven").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page7Tbody'] tr"),16,8);
		}
		
		function PTpageSevenpagingGameThree () {
			$("#eleGamePageingSeven3").attr("class","focusOne");
			$("#eleGamePageingSeven2").removeClass("focusOne");
			$("#eleGamePageingSeven1").removeClass("focusOne");
			$("#eleGamePageingSeven4").removeClass("focusOne");
			$("#eleGamePageingSeven").removeClass("focusOne");
			window.location.hash = "#page1";
			gamePaging($("tbody[id = 'page7Tbody'] tr"),24,16);
		}

		
		function gamePagingShow(buttonId) {
			var pageDiv = "page1_div";
			$("#" + pageDiv).show();
			$("#" + buttonId + " a").each(function() {
//				this.onclick = function(){
//					$("#" + buttonId + " a").each(function() {
//						$(this).removeClass("c");
//					});
//					$(this).attr("class","c");
//					$("#page_div").children("div").each(function() {
//						$(this).hide();
//					});
//					$("#" + this.id + "_div").show();
//					pageDiv = "#" + this.id + "_div";
//				}
				pageNumberAClickBind(this.id,buttonId,8,0);
			});
			pageNumberClass(pageDiv + " table tbody tr","page1_Number",8,0);
		}

		function pageNumberAClickBind(pageId,buttonId,trNum,ksNum) {
				$body = $(document.body)
				$body.on('click', '#' + pageId, function () {
					$("#" + buttonId + " a").each(function() {
						$(this).removeClass("c");
					});
					$(this).attr("class","c");
					$("#page_div").children("div").each(function() {
						$(this).hide();
					});
					$("#" + pageId + "_div").show();
					
					pageNumberClass(pageId + "_div table tbody tr", pageId + "_Number",8,0);
			});
			
		}
		
		function pageNumberClass(trAts,pageNumber,trNum,ksNum) {
			$("#" + pageNumber + " ul li").each(function() {
				this.onclick = function(){
					$("#" + pageNumber + " ul li").each(function() {
						$(this).removeClass("focusOne");
					});
					$(this).attr("class","focusOne");
				}
			});
			pageNumberButton(trAts,1);
			$("#" + pageNumber + " ul li").each(function() {
				pageClickBind(trAts,this.id);
			});
		}
		
		function pageClickBind(trAts,page) {
			$body = $(document.body)
			$body.on('click', '#' + page, function () {
				pageNumberButton(trAts,page.substring(page.indexOf("_")+1,page.indexOf("_")+2));
			})

//			$body.on('click', '#' + page, function () {
//				pageNumberButton(trAts,page.substring(page.indexOf("_")+1,page.indexOf("_")+2));
//			})
		}

		function pageNumberButton(trAts,page) {
			$("#" + trAts).each(function() {
				$(this).hide();
			});
			for (var i = 8*(page-1); i < 8*page; i++) {
				$("#" + trAts).eq(i).show();
			}
		}
		
