angular.module('ionicz.lottery')

.filter('tick', function() {
	return function(value, text) {
		if(value <= 0) {
			return text;
		}
		
		var text = moment('00:00:00', 'HH:mm:ss').add(value, 's').format('mm:ss');
		if(value >= 3600) {
			var hh = Math.floor(value / 3600);
			if(hh < 10) {
				hh = '0' + hh;
			}
			text = hh + ':' + text;
		}
		return text;
	}
})

.filter('codeHtml', function($filter, Lottery) {
	return function(nums, gameId, type) {
		if(!nums) {
			return;
		}
		
		if(!angular.isArray(nums)) {
			nums = nums.split(',');
		}
		
		var style = Lottery.getNumStyle(gameId, type);
		var group = Lottery.getGroup(gameId);
		
		var html = '';
		
		if(group == 'group5') {
			var nums1 = [];
			var nums2 = [];
			for(var i=0; i<nums.length; i++) {
				if(i < 10) {
					nums1.push(nums[i]);
				}
				else {
					nums2.push(nums[i]);
				}
			}
			html += $filter('lotteryNum')(nums1, style);
			html += $filter('lotteryNum')(nums2, style);
		}
		else if(group == 'group7') {
			html += $filter('lotteryLhcNum')(nums);
		}
		else if(group == 'group8') {
			html += $filter('lotteryPcddNum')(nums, style);
			html += $filter('lotteryResult')(nums, group);
		}
		else {
			html += $filter('lotteryNum')(nums, style);
			html += $filter('lotteryResult')(nums, group);
		}
		
		html += '</div>';
		return html;
	}
})

.filter('lotteryNum', function($interpolate) {
	return function(nums, style) {
		var tmp = null;
		
		switch (style) {
		case 6:
			tmp = $interpolate('<span class="round-6 data-{{num}}">{{num}}</span>');
			break;
		case 8:
			tmp = $interpolate('<span class="round-8 data-{{num}}">{{num}}</span>');
			break;
		case 9:
			tmp = $interpolate('<span class="round-9 data-{{num}}">{{num}}</span>');
			break;
		case 10:
			tmp = $interpolate('<span class="round-10 data-{{num}}">{{num}}</span>');
			break;
		default:
			tmp = $interpolate('<span class="round">{{num}}</span>');
			break;
		}
		
		var html = '<div class="nums-wrap">';
		for(var i=0; i<nums.length; i++) {
			html += tmp({num: nums[i] * 1});
		}
		html += '</div>';
		return html;
	}
})

.filter('lotteryPcddNum', function($interpolate) {
	return function(nums) {
		if(nums.length != 3) {
			return;
		}
		
		var tmp = $interpolate('<span class="round">{{num}}</span>');

		var total = 0;
		var html = '<div class="nums-wrap">';
		for(var i=0; i<nums.length; i++) {
			html += tmp({num: nums[i]});
			total += parseInt(nums[i]);
		}
		
		html += '<span class="equal icon icon-dengyu"></span>';
		html += tmp({num: total});
		
		html += '</div>';
		return html;
	}
})

.filter('lotteryLhcNum', function($interpolate) {
	return function(nums) {
		if(nums.length != 7) {
			return;
		}
		
		var tmp = $interpolate('<span class="round-4 {{num|lhcColor}}">{{num}}</span>');
		
		var html = '<div class="nums-wrap">';
		for(var i=0; i<6; i++) {
			html += tmp({num: nums[i]});
		}
		
		html += '<span class="round-4 transparent icon icon-jiahao"></span>';
		html += tmp({num: nums[6]});
		
		html += '</div>';
		return html;
	}
})

.filter('lotteryResult', function($interpolate) {
	return function(nums, group) {
		var results = [];
		
		var total = 0;
		for(var i=0; i<nums.length; i++) {
			nums[i] = parseInt(nums[i]);
			total += nums[i];
		}
		
		if(group == 'group1') {
			results.push(nums[0] + nums[1]);	// 1
			results.push((nums[0] + nums[1] > 11) ? '大' : '小');//2
			results.push(((nums[0] + nums[1]) % 2 == 1) ? '单' : '双');// 3
			results.push(nums[0] > nums[9] ? '龙' : '虎'); // 4
			results.push(nums[1] > nums[8] ? '龙' : '虎'); // 5
			results.push(nums[2] > nums[7] ? '龙' : '虎'); // 6
			results.push(nums[3] > nums[6] ? '龙' : '虎'); // 7
			results.push(nums[4] > nums[5] ? '龙' : '虎'); // 8
		}
		else if(group == 'group2') {
			results.push(total);// 1
			results.push((total >= 23) ? '大' : '小');// 2
			results.push((total % 2 == 1) ? '单' : '双');// 3
			if(nums[0] > nums[4]) {
				results.push('龙'); // 4
			}
			else if(nums[0] == nums[4]) {
				results.push('和');// 4
			}
			else {
				results.push('虎');// 4
			}
		}
		else if(group == 'group3') {
			results.push(total);// 1
			
			if(total > 84) {
				results.push('大');// 2
			}
			else if(total == 84) {
				results.push('和');// 2
			}
			else {
				results.push('小');// 2
			}
			
			results.push((total % 2 == 1) ? '单' : '双');// 3
			
			results.push((total % 10 >= 5) ? '大' : '小');// 4
			/*
			results.push(nums[0] > nums[7] ? '龙' : '虎');// 5
			results.push(nums[1] > nums[6] ? '龙' : '虎');// 6
			results.push(nums[2] > nums[5] ? '龙' : '虎');// 7
			results.push(nums[3] > nums[4] ? '龙' : '虎');// 8
			*/
		}
		else if(group == 'group4') {
			results.push(total);// 1
			
			if(total > 30) {
				results.push('大');// 2
			}
			else if(total == 30) {
				results.push('和');// 2
			}
			else {
				results.push('小');// 2
			}
			
			results.push((total % 2 == 1) ? '单' : '双');// 3
			results.push((total % 10 >= 5) ? '大' : '小');// 4
			
			results.push(nums[0] > nums[4] ? '龙' : '虎');// 5
			
			/*if (nums[0] == 11) {
				results.push('和');// 6
			} else if (nums[0] > 5) {
				results.push('大');// 6
			}
			else {
				results.push('小');// 6
			}
			
			if (nums[1] == 11) {
				results.push('和');// 7
			} else if (nums[1] > 5) {
				results.push('大');// 7
			}
			else {
				results.push('小');// 7
			}
			
			if (nums[2] == 11) {
				results.push('和');// 8
			} else if (nums[2] > 5) {
				results.push('大');// 8
			}
			else {
				results.push('小');// 8
			}
			
			if (nums[3] == 11) {
				results.push('和');// 9
			} else if (nums[3] > 5) {
				results.push('大');// 9
			}
			else {
				results.push('小');// 9
			}
			
			if (nums[4] == 11) {
				results.push('和');// 10
			} else if (nums[4] > 5) {
				results.push('大');// 10
			}
			else {
				results.push('小');// 10
			}*/
		}
		else if(group == 'group6') {
			results.push(total);// 1
			results.push((total >= 11) ? '大' : '小');// 2
		}
		else if(group == 'group8') {
			results.push(total);// 1
			results.push((total > 13) ? '大' : '小');// 2
			results.push((total % 2 == 1) ? '单' : '双');// 3
		}
		
		var tmp = $interpolate('<span class="resultData">{{result}}</span>');
		
		var html = '<div class="result-wrap">';
		for(var i=0; i<results.length; i++) {
			html += tmp({result: results[i]});
		}
		html += '</div>';
		return html;
	}
})

.filter('lhcColor', function() {
	var red = [1, 2, 7, 8, 12, 13, 18, 19, 23, 24, 29, 30, 34, 35, 40, 45, 46];
	var blue = [3, 4, 9, 10, 14, 15, 20, 25, 26, 31, 36, 37, 41, 42, 47, 48];
	var green = [5, 6, 11, 16, 17, 21, 22, 27, 28, 32, 33, 38, 39, 43, 44, 49];
	
	return function(num) {
		num = parseInt(num);
		if(red.indexOf(num) > -1) {
			return 'red';
		}
		else if(blue.indexOf(num) > -1) {
			return 'blue';
		}
		else {
			return 'green';
		}
	}
})

.filter('playCate', function(Lottery) {
	return function(play) {
		var playCate = Lottery.getPlayCate(play.playCateId);
		return playCate.isShow == 1 ? '' : (playCate.name + ' - ');
	}
});