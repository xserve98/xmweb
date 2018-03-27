<?php

function validateDailiRatio($ratio) {
	global $mysqli;
	$result = null;
	
	if($ratio["validate_type"] == 'default') {
		if(is_numeric($ratio["zc_zd_ty_ratio"])) {
			$zc_zd_ty_ratio = floatval($ratio["zc_zd_ty_ratio"]);
			if($zc_zd_ty_ratio>=1 || $zc_zd_ty_ratio<=0) {
				$result = "占成模式总代理体育分红比例必须为大于0且小于1的数字";
				return $result;
			}
		} else {
			$result = "占成模式总代理体育分红比例必须为数字";
			return $result;
		}
		
		if($ratio["zc_dl_ty_ratio"]!=null) {
			$ty_ratio = array();
			$ty_ratio["name"] = "占成模式代理体育分红比例";
			$ty_ratio["value"] = $ratio["zc_dl_ty_ratio"];
			$parseResult = parseRatioLevel($ty_ratio);
			if($parseResult["error_message"] !=null) {
				$result = $parseResult["error_message"];
				return $result;
			} else {
				$end_ratio = end($parseResult["ratio"]);
				if($end_ratio["ratio"]>$zc_zd_ty_ratio) {
					$result = "占成模式代理体育分红比例最大值不能大于系统总代理设置";
					return $result;
				}
			}
		} else {
			$result = "占成模式代理体育分红比例不能为空";
			return $result;
		}
		
		if(is_numeric($ratio["zc_zd_yx_ratio"])) {
			$zc_zd_yx_ratio = floatval($ratio["zc_zd_yx_ratio"]);
			if($zc_zd_yx_ratio>=1 || $zc_zd_yx_ratio<=0) {
				$result = "占成模式总代理体育有效金额返水比例必须为大于0且小于1的数字";
				return $result;
			}
		} else {
			$result = "占成模式总代理体育有效金额返水比例必须为数字";
			return $result;
		}
		
		if(is_numeric($ratio["zc_dl_yx_ratio"])) {
			$zc_dl_yx_ratio = floatval($ratio["zc_dl_yx_ratio"]);
			if($zc_dl_yx_ratio>=1 || $zc_dl_yx_ratio<=0) {
				$result = "占成模式代理体育有效金额返水比例必须为大于0且小于1的数字";
				return $result;
			}
		} else {
			$result = "占成模式代理体育有效金额返水比例必须为数字";
			return $result;
		}
		
		if($zc_dl_yx_ratio>$zc_zd_yx_ratio) {
			$result = "占成模式代理体育有效金额返水比例不能高于总代理";
			return $result;
		}
		
		if(is_numeric($ratio["zc_zd_fc_ratio"])) {
			$zc_zd_fc_ratio = floatval($ratio["zc_zd_fc_ratio"]);
			if($zc_zd_fc_ratio>=1 || $zc_zd_fc_ratio<=0) {
				$result = "占成模式总代理福彩分红比例必须为大于0且小于1的数字";
				return $result;
			}
		} else {
			$result = "占成模式总代理福彩分红比例必须为数字";
			return $result;
		}
		
		if(is_numeric($ratio["zc_dl_fc_ratio"])) {
			$zc_dl_fc_ratio = floatval($ratio["zc_dl_fc_ratio"]);
			if($zc_dl_fc_ratio>=1 || $zc_dl_fc_ratio<=0) {
				$result = "占成模式代理福彩分红比例必须为大于0且小于1的数字";
				return $result;
			}
		} else {
			$result = "占成模式代理福彩分红比例必须为数字";
			return $result;
		}
		
		if($zc_dl_fc_ratio>$zc_zd_fc_ratio) {
			$result = "占成模式代理福彩分红比例不能高于总代理";
			return $result;
		}
		
		if(is_numeric($ratio["zc_zd_lt_ratio"])) {
			$zc_zd_lt_ratio = floatval($ratio["zc_zd_lt_ratio"]);
			if($zc_zd_lt_ratio>=1 || $zc_zd_lt_ratio<=0) {
				$result = "占成模式总代理乐透分红比例必须为大于0且小于1的数字";
				return $result;
			}
		} else {
			$result = "占成模式总代理乐透分红比例必须为数字";
			return $result;
		}
		
		if(is_numeric($ratio["zc_dl_lt_ratio"])) {
			$zc_dl_lt_ratio = floatval($ratio["zc_dl_lt_ratio"]);
			if($zc_dl_lt_ratio>=1 || $zc_dl_lt_ratio<=0) {
				$result = "占成模式代理乐透分红比例必须为大于0且小于1的数字";
				return $result;
			}
		} else {
			$result = "占成模式代理乐透分红比例必须为数字";
			return $result;
		}
		
		if($zc_dl_lt_ratio>$zc_zd_lt_ratio) {
			$result = "占成模式代理乐透分红比例不能高于总代理";
			return $result;
		}
		
		if(is_numeric($ratio["cs_zd_ratio"])) {
			$cs_zd_ratio = floatval($ratio["cs_zd_ratio"]);
			if($cs_zd_ratio>=1 || $cs_zd_ratio<=0) {
				$result = "返水模式总代理返水比例必须为大于0且小于1的数字";
				return $result;
			}
		} else {
			$result = "返水模式总代理返水比例必须为数字";
			return $result;
		}
		
		if(is_numeric($ratio["cs_dl_ratio"])) {
			$cs_dl_ratio = floatval($ratio["cs_dl_ratio"]);
			if($cs_dl_ratio>=1 || $cs_dl_ratio<=0) {
				$result = "返水模式代理返水比例必须为大于0且小于1的数字";
				return $result;
			}
		} else {
			$result = "返水模式代理返水比例必须为数字";
			return $result;
		}
		
		if($cs_dl_ratio>$cs_zd_ratio) {
			$result = "返水模式代理返水比例不能高于总代理";
			return $result;
		}

	} else {
		$sql = "select * from k_daili_config";
		$query	=	$mysqli->query($sql);
		$default_rows	=	$query->fetch_array();
		if($default_rows) {
			$default_config = array();
			$default_config["zc_zd_ty_ratio"] = $default_rows['zc_zd_ty_ratio'];
			$default_config["zc_dl_ty_ratio"] = $default_rows['zc_dl_ty_ratio'];
			$default_config["zc_zd_yx_ratio"] = $default_rows['zc_zd_yx_ratio'];
			$default_config["zc_dl_yx_ratio"] = $default_rows['zc_dl_yx_ratio'];
			$default_config["zc_zd_fc_ratio"] = $default_rows['zc_zd_fc_ratio'];
			$default_config["zc_dl_fc_ratio"] = $default_rows['zc_dl_fc_ratio'];
			$default_config["zc_zd_lt_ratio"] = $default_rows['zc_zd_lt_ratio'];
			$default_config["zc_dl_lt_ratio"] = $default_rows['zc_dl_lt_ratio'];
			$default_config["cs_zd_ratio"]    = $default_rows['cs_zd_ratio'];
			$default_config["cs_dl_ratio"]    = $default_rows['cs_dl_ratio'];
		
			if(!$ratio["is_zongdaili"] && $ratio["zongdaili_uid"]!=null) {
				$sql	=	"select * from k_daili_user_config where uid=".$ratio["zongdaili_uid"];
				$query	=	$mysqli->query($sql);
				while($rows	=	$query->fetch_array()){
					$zongdali_config = array();
					$zongdali_config["zc_zd_ty_ratio"] = $rows['zc_zd_ty_ratio'];
					$zongdali_config["zc_dl_ty_ratio"]  = $rows['zc_dl_ty_ratio'];
					$zongdali_config["zc_yx_ratio"]  = $rows['zc_yx_ratio'];
					$zongdali_config["zc_fc_ratio"]  = $rows['zc_fc_ratio'];
					$zongdali_config["zc_lt_ratio"]  = $rows['zc_lt_ratio'];
					$zongdali_config["cs_ratio"]  = $rows['cs_ratio'];
				}
			}
			
			if($ratio["validate_type"] == 'zc') {
				if($ratio["is_zongdaili"]) {
					if(is_numeric($ratio["zc_zd_ty_ratio"])) {
						$zc_zd_ty_ratio = floatval($ratio["zc_zd_ty_ratio"]);
						if($zc_zd_ty_ratio>=1 || $zc_zd_ty_ratio<=0) {
							$result = "占成模式总代理体育分红比例必须为大于0且小于1的数字";
							return $result;
						}
					} else {
						$result = "占成模式总代理体育分红比例必须为数字";
						return $result;
					}	
				} else {
					if($ratio["zc_dl_ty_ratio"]!=null) {
						$ty_ratio = array();
						$ty_ratio["name"] = "占成模式代理体育分红比例";
						$ty_ratio["value"] = $ratio["zc_dl_ty_ratio"];
						$parseResult = parseRatioLevel($ty_ratio);
						if($parseResult["error_message"] !=null) {
							$result = $parseResult["error_message"];
							return $result;
						} else {
							$end_ratio = end($parseResult["ratio"]);
							if($zongdali_config != null) {
								if($end_ratio["ratio"]>$zongdali_config["zc_zd_ty_ratio"]) {
									$result = "占成模式代理体育分红比例最大值不能大于总代理";
									return $result;
								}
							} else {
								if($end_ratio["ratio"]>$default_config["zc_zd_ty_ratio"]) {
									$result = "占成模式代理体育分红比例最大值不能大于系统总代理设置";
									return $result;
								}
							}
						}
						
					} else {
						$result = "占成模式代理体育分红比例不能为空";
						return $result;
					}
				}
				
				if(is_numeric($ratio["zc_yx_ratio"])) {
					$zc_yx_ratio = floatval($ratio["zc_yx_ratio"]);
					if($zc_yx_ratio>=1 || $zc_yx_ratio<=0) {
						$result = "占成模式代理体育有效金额返水比例必须为大于0且小于1的数字";
						return $result;
					}
				} else {
					$result = "占成模式代理体育有效金额返水比例必须为数字";
					return $result;
				}
				
				if(!$ratio["is_zongdaili"]) {
					if($zongdali_config!=null) {
						if($zc_yx_ratio>$zongdali_config["zc_yx_ratio"]) {
							$result = "占成模式代理体育有效金额返水比例不能大于总代理";
							return $result;
						}
					} else {
						if($zc_yx_ratio>$default_config["zc_dl_yx_ratio"]) {
							$result = "占成模式代理体育有效金额返水比例不能大于系统设置";
							return $result;
						}
					}
				}
				
				if(is_numeric($ratio["zc_fc_ratio"])) {
					$zc_fc_ratio = floatval($ratio["zc_fc_ratio"]);
					if($zc_fc_ratio>=1 || $zc_fc_ratio<=0) {
						$result = "占成模式代理福彩分红比例必须为大于0且小于1的数字";
						return $result;
					}
				} else {
					$result = "占成模式代理福彩分红比例必须为数字";
					return $result;
				}
				
				if(!$ratio["is_zongdaili"]) {
					if($zongdali_config!=null) {
						if($zc_fc_ratio>$zongdali_config["zc_fc_ratio"]) {
							$result = "占成模式代理福彩分红比例不能大于总代理";
							return $result;
						}
					} else {
						if($zc_fc_ratio>$default_config["zc_dl_fc_ratio"]) {
							$result = "占成模式代理福彩分红比例不能大于系统设置";
							return $result;
						}
					}
				}
				
				if(is_numeric($ratio["zc_lt_ratio"])) {
					$zc_lt_ratio = floatval($ratio["zc_lt_ratio"]);
					if($zc_lt_ratio>=1 || $zc_lt_ratio<=0) {
						$result = "占成模式代理乐透分红比例必须为大于0且小于1的数字";
						return $result;
					}
				} else {
					$result = "占成模式代理乐透分红比例必须为数字";
					return $result;
				}
				
				if(!$ratio["is_zongdaili"]) {
					if($zongdali_config!=null) {
						if($zc_lt_ratio>$zongdali_config["zc_lt_ratio"]) {
							$result = "占成模式代理乐透分红比例不能大于总代理";
							return $result;
						}
					} else {
						if($zc_lt_ratio>$default_config["zc_dl_lt_ratio"]) {
							$result = "占成模式代理乐透分红比例不能大于系统设置";
							return $result;
						}
					}
				}
				
			} else if($ratio["validate_type"] == 'cs') {
				if(is_numeric($ratio["cs_ratio"])) {
					$cs_ratio = floatval($ratio["cs_ratio"]);
					if($cs_ratio>=1 || $cs_ratio<=0) {
						$result = "返水模式代理返水比例必须为大于0且小于1的数字";
						return $result;
					}
				} else {
					$result = "返水模式代理返水比例必须为数字";
					return $result;
				}
				
				if(!$ratio["is_zongdaili"]) {
					if($zongdali_config!=null) {
						if($cs_ratio>$zongdali_config["cs_ratio"]) {
							$result = "返水模式代理返水比例不能大于总代理";
							return $result;
						}
					} else {
						if($cs_ratio>$default_config["cs_zd_ratio"]) {
							$result = "返水模式代理返水比例不能大于系统总代理设置";
							return $result;
						}
					}
				}
			}
			
		} else {
			$result = "系统默认比例没有设置，请先设置系统默认比例";
			return $result;
		}
	}
	
	return $result;
}

function parseRatioLevel($ratio) {
	$result = array();
	$result["error_message"] = null;
	
	$result["ratio"] = array();
	
	$level_array = explode("\n",$ratio["value"]);
	$i = 0;
	foreach($level_array as $level_value){
		$level_value = trim($level_value);
		if($level_value=="") {
			continue;
		} else {
			$level_and_ratio = explode(";",$level_value);
			if(count($level_and_ratio)!=2) {
				$result["error_message"] = $ratio["name"]."数据格式错误，请检查:".$level_value;
				return $result; 
			}else{
				$level_range = $level_and_ratio[0];
				$level_ratio = $level_and_ratio[1];
				
				$ranges = explode("~",trim($level_range));
				
				if(count($ranges) >2) {
					$result["error_message"] = $ratio["name"]."数据格式错误，请检查:".$level_value;
					return $result;
				} else {
					$start_range = $ranges[0];
					$end_range = $ranges[1];
					
					if(is_numeric($start_range)) {
						$start_range = intval($start_range);
						if($start_range<=0 && $i!=0) {
							$result["error_message"] = $ratio["name"]."数据错误，请检查:".$level_value.",金额起始范围必须为大于0的数字";
							return $result;
						}
						$result["ratio"][$i]["start_range"] = $start_range;
					} else {
						$result["error_message"] = $ratio["name"]."数据错误，请检查:".$level_value.",金额起始范围必须为数字";
						return $result;
					}
					
					if($end_range!=null) {
						if(is_numeric($end_range)) {
							$end_range = intval($end_range);
							if($end_range<=0) {
								$result["error_message"] = $ratio["name"]."数据错误，请检查:".$level_value.",金额结束范围必须为大于0的数字";
								return $result;
							} else if($end_range<=$start_range) {
								$result["error_message"] = $ratio["name"]."数据错误，请检查:".$level_value.",金额结束范围必须大于金额起始范围";
								return $result;
							}
							
							$result["ratio"][$i]["end_range"] = $end_range;
						} else {
							$result["error_message"] = $ratio["name"]."数据错误，请检查:".$level_value.",金额结束范围必须为数字";
							return $result;
						}
					}
					
					if($result["ratio"][$i-1]!=null) {
						if($result["ratio"][$i-1]["end_range"]==null && $result["ratio"][$i]["start_range"]!=null) {
							$result["error_message"] = $ratio["name"]."数据错误，请检查:".$level_value.",上一级金额没有结束范围";
							return $result;
						} else if($result["ratio"][$i]["start_range"]<=$result["ratio"][$i-1]["end_range"] || $result["ratio"][$i]["start_range"]!=$result["ratio"][$i-1]["end_range"]+1) {
							$result["error_message"] = $ratio["name"]."数据错误，请检查:".$level_value.",金额起始范围必须为上一级金额结束范围+1,";
							return $result;
						} 
					}
					
					if($i==0 && $result["ratio"][$i]["end_range"]!=null && $result["ratio"][$i]["start_range"]!=0) {
						$result["error_message"] = $ratio["name"]."数据错误，请检查:".$level_value.",第一级金额起始范围必须为0";
						return $result;
					}
					
				}
				
				if(is_numeric($level_ratio)) {
					$level_ratio = floatval($level_ratio);
					if($level_ratio>=1 || $level_ratio<=0) {
						$result["error_message"] = $ratio["name"]."数据错误，请检查:".$level_value.",比例必须为大于0小于1的数字";
						return $result;
					}
				} else {
					$result["error_message"] = $ratio["name"]."数据错误，请检查:".$level_value.",比例必须为数字";
					return $result;
				}
				
				$result["ratio"][$i]["ratio"] = $level_ratio;
				if($result["ratio"][$i-1]!=null && $result["ratio"][$i]["ratio"] <= $result["ratio"][$i-1]["ratio"] ) {
					$result["error_message"] = $ratio["name"]."数据错误，请检查:".$level_value.",比例必须大于上一级金额比例";
					return $result;
				}
			}
		}
		$i++;
	} 
	return $result;
}

function getDailiRatio($uid, $max_ratio = false) {
	global $mysqli;
	$result = array();
	
	$sql	=	"select * from k_user where uid=".$uid." and is_daili=1";
	$query	=	$mysqli->query($sql);
	$rows	=	$query->fetch_array();
	if($rows) {
		$is_zongdaili = $rows["is_zongdaili"];
		$zongdaili_uid = $rows["zongdaili_uid"]==null?0:$rows["zongdaili_uid"];
		$result["is_zongdaili"] = $is_zongdaili;
		$result["daili_mode"] = $rows["daili_mode"];
		if($max_ratio) {
			if($is_zongdaili) {
				return null;
			} else {
				$sql	=	"select * from k_daili_user_config where uid=".$zongdaili_uid ;
				$query	=	$mysqli->query($sql);
				$rows	=	$query->fetch_array();
				if($rows) {
					$result["zc_zd_ty_ratio"] = $rows['zc_zd_ty_ratio'];
					$result["zc_dl_ty_ratio"] = $rows['zc_dl_ty_ratio'];
					$result["zc_yx_ratio"] = $rows['zc_yx_ratio'];
					$result["zc_fc_ratio"] = $rows['zc_fc_ratio'];
					$result["zc_lt_ratio"] = $rows['zc_lt_ratio'];
					$result["cs_ratio"] = $rows['cs_ratio'];
				} else {
					$default_config = getDefaultRatio();
					$result["zc_zd_ty_ratio"] = $default_config['zc_zd_ty_ratio'];
					$result["zc_dl_ty_ratio"] = $default_config['zc_dl_ty_ratio'];
					$result["zc_yx_ratio"] = $default_config['zc_zd_yx_ratio'];
					$result["zc_fc_ratio"] = $default_config['zc_zd_fc_ratio'];
					$result["zc_lt_ratio"] = $default_config['zc_zd_lt_ratio'];
					$result["cs_ratio"] = $default_config['cs_zd_ratio'];
				}
			}
		} else {
			$sql	=	"select * from k_daili_user_config where uid=".$uid;
			$query	=	$mysqli->query($sql);
			$rows	=	$query->fetch_array();
			if($rows) {
				$result["zc_zd_ty_ratio"] = $rows['zc_zd_ty_ratio'];
				$result["zc_dl_ty_ratio"] = $rows['zc_dl_ty_ratio'];
				$result["zc_yx_ratio"] = $rows['zc_yx_ratio'];
				$result["zc_fc_ratio"] = $rows['zc_fc_ratio'];
				$result["zc_lt_ratio"] = $rows['zc_lt_ratio'];
				$result["cs_ratio"] = $rows['cs_ratio'];
			} else {
				$default_config = getDefaultRatio();
				if($is_zongdaili==1) {
					$result["zc_zd_ty_ratio"] = $default_config['zc_zd_ty_ratio'];
					$result["zc_dl_ty_ratio"] = $default_config['zc_dl_ty_ratio'];
					$result["zc_yx_ratio"] = $default_config['zc_zd_yx_ratio'];
					$result["zc_fc_ratio"] = $default_config['zc_zd_fc_ratio'];
					$result["zc_lt_ratio"] = $default_config['zc_zd_lt_ratio'];
					$result["cs_ratio"] = $default_config['cs_zd_ratio'];
				} else {
					$result["zc_zd_ty_ratio"] = $default_config['zc_zd_ty_ratio'];
					$result["zc_dl_ty_ratio"] = $default_config['zc_dl_ty_ratio'];
					$result["zc_yx_ratio"] = $default_config['zc_dl_yx_ratio'];
					$result["zc_fc_ratio"] = $default_config['zc_dl_fc_ratio'];
					$result["zc_lt_ratio"] = $default_config['zc_dl_lt_ratio'];
					$result["cs_ratio"] = $default_config['cs_dl_ratio'];
				}
			}
		}
	} else {
		return null;
	}
	
	return $result;
}

$default_config_645bf0a4m11282283l103365414 = null;

function getDefaultRatio() {
	global $mysqli;
	global $default_config_645bf0a4m11282283l103365414;
	
	if($default_config_645bf0a4m11282283l103365414!=null) {
		return $default_config_645bf0a4m11282283l103365414;
	}
	
	$default_config = null;
	
	$sql = "select * from k_daili_config";
	$query	=	$mysqli->query($sql);
	$default_rows	=	$query->fetch_array();
	if($default_rows) {
		$default_config = array();
		$default_config["zc_zd_ty_ratio"] = $default_rows['zc_zd_ty_ratio'];
		$default_config["zc_dl_ty_ratio"] = $default_rows['zc_dl_ty_ratio'];
		$default_config["zc_zd_yx_ratio"] = $default_rows['zc_zd_yx_ratio'];
		$default_config["zc_dl_yx_ratio"] = $default_rows['zc_dl_yx_ratio'];
		$default_config["zc_zd_fc_ratio"] = $default_rows['zc_zd_fc_ratio'];
		$default_config["zc_dl_fc_ratio"] = $default_rows['zc_dl_fc_ratio'];
		$default_config["zc_zd_lt_ratio"] = $default_rows['zc_zd_lt_ratio'];
		$default_config["zc_dl_lt_ratio"] = $default_rows['zc_dl_lt_ratio'];
		$default_config["cs_zd_ratio"]    = $default_rows['cs_zd_ratio'];
		$default_config["cs_dl_ratio"]    = $default_rows['cs_dl_ratio'];
		
		$default_config_645bf0a4m11282283l103365414 = $default_config;
	}
	
	return $default_config;
}

function getLevelRatio($amount, $ratios) {
	$ratio = 0;
	
	$leve_ratio = array();
	$leve_ratio["name"]="比例";
	$leve_ratio["value"]=$ratios;
	$parsedRatio = parseRatioLevel($leve_ratio);
	if($parsedRatio["error_message"] == null) {
		if($amount>0) {
			foreach($parsedRatio["ratio"] as $level_value){
				if($amount>=$level_value["start_range"]) {
					if($level_value["end_range"] == null) {
						$ratio = $level_value["ratio"];
					} else {
						if($amount<=$level_value["end_range"]) {
							$ratio = $level_value["ratio"];
						}
					}
				}
			}
		} else {
			$ratio = $parsedRatio["ratio"][0]["ratio"];
		}
	}
	
	return $ratio;
}

/**
* 计算会员各项盈亏
* uid 代理编号
* user 代理名称
* month 计算月份
* daili 指定计算代理还是计算会员盈亏
**/
function calculateGainsAndLosses($uid, $user, $month, $daili=false) {
    global $mysqli;
	global $mysqlit;
	
	$gainsAndLosses = array();
	$gainsAndLosses["ty_y"] = 0;
	$gainsAndLosses["ty_s"] = 0;
	$gainsAndLosses["ty_yx"] = 0;
	$gainsAndLosses["fc_y"] = 0;
	$gainsAndLosses["fc_s"] = 0;
	$gainsAndLosses["lotto"] = 0;
	$gainsAndLosses["cj"] = 0;
	$gainsAndLosses["sxf"] = 0;

	$user="'".$user."'";
	if($daili) {
	    $sql = "select uid,username from k_user where top_uid=".$uid." and is_daili=0 and is_zongdaili=0";
		$uid="";
		$user="";
		$query	=	$mysqli->query($sql);
	    while($row = $query->fetch_array()){
		    if($uid=="") {
		        $uid =	$row['uid'];
				$user = "'".$row['username']."'";
			} else {
			    $uid =	$uid.",".$row['uid'];
				$user = $user.",'".$row['username']."'";
			}
        }
	}
	
	if($uid=="") {
	    return $gainsAndLosses;
	}
	//echo $user;exit;
	
	$sql	=	"select bet_money,win,`status`,match_coverdate,fs,bet_point,point_column from k_bet where `status`>0 and uid in ($uid) and match_coverdate like('".$month."%') and (ball_sort!='重庆时时彩' AND ball_sort!='广东快乐十分' AND ball_sort!='北京PK10' AND ball_sort!='福彩3D' AND ball_sort!='体彩排列三' AND ball_sort!='上海时时乐') order by match_coverdate asc"; //单式
	//echo $sql;exit;
	$query	=	$mysqli->query($sql);
	while($rows	=	$query->fetch_array()){
		$ts		=	$rows['fs'];
		if($rows['status']=="1" || $rows['status']=="4"){ //赢和赢一半都算赢
			$gainsAndLosses["ty_y"]+=$rows['win']-$rows['bet_money']+$ts; //净赢金额不包括本金
			if($rows['status']=="1") {
			    $bet_point = $rows['bet_point'];
				if($rows['point_column']=='match_bhdy' || 
				   $rows['point_column']=='match_bzh' || 
				   $rows['point_column']=='match_bgdy' || 
				   $rows['point_column']=='match_bmdy' || 
				   $rows['point_column']=='match_bzg' || 
				   $rows['point_column']=='match_bzm'
				   ) {
				    $bet_point = $bet_point - 1;
				}
			    if($bet_point>1) {
				    $gainsAndLosses["ty_yx"] += $rows['bet_money'];
					//echo $gainsAndLosses["ty_yx"]."赢大于1".$rows['bet_money']."<br/>";
				} else {
				    $gainsAndLosses["ty_yx"] += $rows['bet_money'] * $rows['bet_point'];
					//echo $gainsAndLosses["ty_yx"]."赢小于1".($rows['bet_money']* $rows['bet_point'])."<br/>";
				}
			}else {
				$gainsAndLosses["ty_yx"] += ($rows['bet_money'] * $rows['bet_point'])/2;
				//echo $gainsAndLosses["ty_yx"]."赢一半".(($rows['bet_money']* $rows['bet_point'])/2)."<br/>";
			}
			
		}elseif($rows['status']=="2" || $rows['status']=="5"){ //输和输一半都算输
			$gainsAndLosses["ty_s"]+=abs($rows['win']-$rows['bet_money']+$ts); //净输金额不包括已赢金额
			if($rows['status']=="2") {
				$gainsAndLosses["ty_yx"] += $rows['bet_money'];
				// $gainsAndLosses["ty_yx"]."输".$rows['bet_money']."<br/>";
			} else {
			    $gainsAndLosses["ty_yx"] += $rows['bet_money']/2;
				//echo $gainsAndLosses["ty_yx"]."输一半".($rows['bet_money']/2)."<br/>";
			}
		}
	}
	
	$sql	=	"select bet_money,win,`status`,match_coverdate,fs from k_bet_cg_group where `status`>0 and uid in ($uid) and match_coverdate like('".$month."%') order by match_coverdate asc"; //串关
	//echo $sql;exit;
	$query	=	$mysqli->query($sql);
	while($rows	=	$query->fetch_array()){
		if($rows['status']=="1"){ //输跟赢
			$ts		=	$rows['fs'];
			if($rows['win']>0){ //赢
				$gainsAndLosses["ty_y"]+=$rows['win']-$rows['bet_money']+$ts; //净赢金额不包括本金
			}else{ //输
				$gainsAndLosses["ty_s"]+=$rows['bet_money']-$ts;
			}
			$gainsAndLosses["ty_yx"] += $rows['bet_money'];
		}
	}
	
	$sql	=	"select bet_money,win,`status`,match_coverdate,fs from k_bet where `status`>0 and uid in ($uid) and match_coverdate like('".$month."%') and (ball_sort='重庆时时彩' or ball_sort='广东快乐十分' or ball_sort='北京PK10' or ball_sort='福彩3D' or ball_sort='体彩排列三' or ball_sort='上海时时乐') order by match_coverdate asc"; //单式
	//echo $sql;exit;
	$query	=	$mysqli->query($sql);
	while($rows	=	$query->fetch_array()){
		$ts		=	$rows['fs'];
		if($rows['status']=="1" || $rows['status']=="4"){ //赢和赢一半都算赢
			$gainsAndLosses["fc_y"]+=$rows['win']-$rows['bet_money']+$ts; //净赢金额不包括本金
		}elseif($rows['status']=="2" || $rows['status']=="5"){ //输和输一半都算输
			$gainsAndLosses["fc_s"]+=abs($rows['win']-$rows['bet_money']+$ts); //净输金额不包括已赢金额
		}
	}
	
	$sql	=	"select ka_tan.*,ka_kithe.nd,ka_kithe.nn from ka_tan,ka_kithe where ka_tan.kithe=ka_kithe.nn and ka_kithe.na<>0 and ka_kithe.lx=1 and ka_kithe.nd like('".$month."%')  and ka_tan.username in (".$user.") order by `id` asc"; //汇款，只显示成功和处理中的
	//echo $sql;exit;
	$query	=	$mysqlit->query($sql);
	while($rows	=	$query->fetch_array()){
		if($rows['bm']==1){		//会员中奖
			$z_user=($rows['sum_m']*$rows['rate']-$rows['sum_m']);
			$z_user+=$rows['sum_m']*abs($rows['user_ds'])/100;
		}elseif($rs['bm']==0){					//未中奖退水
			$z_user=-($rows['sum_m']-($rows['sum_m']*abs($rows['user_ds'])/100));
		}
		$gainsAndLosses["lotto"]+=$z_user;
	}
	
	$sql	=	"select m_value,uid,about,sxf,type,jiesuan_type from k_money where `status`=1 and m_make_time like('".$month."%') and uid in(".$uid.")"; //本月会员存款取款总额
	$query	=	$mysqli->query($sql);
	while($row = $query->fetch_array()){
		if($row['m_value'] > 0){ //存款
			if(intval($row['jiesuan_type']) == 1){ //正常存款
				$gainsAndLosses["sxf"]	-=	$row['sxf'];
			}else if(intval($row['jiesuan_type']) == 2){//彩金类型
				$gainsAndLosses["cj"]	-=	$row['m_value'];
			}
		}else{ 
			$gainsAndLosses["sxf"]	-=	$row['sxf'];
		}
	}
	
	$gainsAndLosses["yk"] = 0 - ($gainsAndLosses["ty_y"] - $gainsAndLosses["ty_s"] + $gainsAndLosses["fc_y"] - $gainsAndLosses["fc_s"] + $gainsAndLosses["lotto"] - $gainsAndLosses["sxf"] - $gainsAndLosses["cj"]);
	
	return $gainsAndLosses;
}

$daili_total_5f9f8cfem11282283l103286493 = array();

function calculateDailiTotal($uid, $user, $month) {
    global $mysqli;
	global $daili_total_5f9f8cfem11282283l103286493;
	
	if($daili_total_5f9f8cfem11282283l103286493[$uid]!=null) {
		return $daili_total_5f9f8cfem11282283l103286493[$uid];
	}
	
	$sql = "select * from k_user where uid=".$uid;
	$query	=	$mysqli->query($sql);
	$row = $query->fetch_array();
	if($row==null || $row["is_daili"]!=1) {
		return null;
	} else {
		$daili_total = array();
		$daili_total["uid"] = $row["uid"];
		$daili_total["username"] = $row["username"];
		$daili_total["is_zongdaili"] = $row["is_zongdaili"];
		$daili_total["daili_mode"] = $row["daili_mode"];
		$daili_total["has_yx_fs"] = $row["has_yx_fs"];
	}
	
	$daili_total["ratio"] = getDailiRatio($uid);
	$daili_total["yk"] = calculateGainsAndLosses($uid, $user, $month, true);
	$daili_total["detail"] = array();
	
	$daili_total["detail"]["ty"] = 0;
	$daili_total["detail"]["ty_bl"] = 0;
	$daili_total["detail"]["ty_yx"] = 0;
	$daili_total["detail"]["ty_zc_fs_bl"] = 0;
	$daili_total["detail"]["ty_cs_fs_bl"] = 0;
	$daili_total["detail"]["xj_ty"] = 0;
	$daili_total["detail"]["fc"] = 0;
	$daili_total["detail"]["fc_bl"] = 0;
	$daili_total["detail"]["xj_fc"] = 0;
	$daili_total["detail"]["lotto"] = 0;
	$daili_total["detail"]["lotto_bl"] = 0;
	$daili_total["detail"]["xj_lotto"] = 0;
	$daili_total["detail"]["sxf_cj"] = 0;
	$daili_total["detail"]["total"] = 0;
	
	$daili_total["detail"]["ty"] = 0 - ($daili_total["yk"]["ty_y"] - $daili_total["yk"]["ty_s"]);
	$daili_total["detail"]["ty_yx"] = $daili_total["yk"]["ty_yx"];
	$daili_total["detail"]["fc"] = 0 - ($daili_total["yk"]["fc_y"] - $daili_total["yk"]["fc_s"]);	
	$daili_total["detail"]["lotto"] = $daili_total["yk"]["lotto"];//0 - $daili_total["yk"]["lotto"];
	$daili_total["detail"]["sxf_cj"] = 0 - ($daili_total["yk"]["sxf"]+$daili_total["yk"]["cj"]);
	
	if($daili_total["daili_mode"]==0) {
		if($daili_total["is_zongdaili"]==1) {
			$daili_total["detail"]["ty_bl"] = $daili_total["ratio"]["zc_zd_ty_ratio"];
			$daili_total["detail"]["ty_cs_fs_bl"] = $daili_total["ratio"]["cs_ratio"];
		} else {
			$daili_total["detail"]["ty_bl"] = getLevelRatio($daili_total["detail"]["ty"], $daili_total["ratio"]["zc_dl_ty_ratio"]);
		}
		
		$daili_total["detail"]["fc_bl"] = $daili_total["ratio"]["zc_fc_ratio"];
		$daili_total["detail"]["lotto_bl"] = $daili_total["ratio"]["zc_lt_ratio"];
		
		if($daili_total["has_yx_fs"]) {
			$daili_total["detail"]["ty_zc_fs_bl"] = $daili_total["ratio"]["zc_yx_ratio"];
		}
	} else {
		if($daili_total["is_zongdaili"]==1) {
			$daili_total["detail"]["ty_bl"] = $daili_total["ratio"]["zc_zd_ty_ratio"];
			$daili_total["detail"]["fc_bl"] = $daili_total["ratio"]["zc_fc_ratio"];
			$daili_total["detail"]["lotto_bl"] = $daili_total["ratio"]["zc_lt_ratio"];
			
			if($daili_total["has_yx_fs"]) {
				$daili_total["detail"]["ty_zc_fs_bl"] = $daili_total["ratio"]["zc_yx_ratio"];
			}
		}
		$daili_total["detail"]["ty_cs_fs_bl"] = $daili_total["ratio"]["cs_ratio"];
	}
	
	$xj_total_all = 0;
	if($daili_total["is_zongdaili"]==1) {
		$sql = "select * from k_user where is_daili=1 and zongdaili_uid=".$uid;
		$query		=	$mysqli->query($sql);
		while($row	=	$query->fetch_array()){
			$xj_total = calculateDailiTotal($row["uid"],$row["username"],$month);
			if($xj_total["daili_mode"]==0) {
				$xj_ty = ($xj_total["detail"]["ty"] - $xj_total["detail"]["sxf_cj"])*($daili_total["detail"]["ty_bl"]-$xj_total["detail"]["ty_bl"]);
				$xj_fc = ($xj_total["detail"]["fc"])*($daili_total["detail"]["fc_bl"]-$xj_total["detail"]["fc_bl"]);
				$xj_lotto = ($xj_total["detail"]["lotto"])*($daili_total["detail"]["lotto_bl"]-$xj_total["detail"]["lotto_bl"]);
				$daili_total["detail"]["xj_ty"] += $xj_ty;
				$daili_total["detail"]["xj_fc"] += $xj_fc;
				$daili_total["detail"]["xj_lotto"] += $xj_lotto;
				
				$xj_total_all += ($xj_ty+$xj_fc+$xj_lotto);
			} else {
				$xj_ty = $xj_total["detail"]["ty_yx"] * ($daili_total["detail"]["ty_cs_fs_bl"] - $xj_total["detail"]["ty_cs_fs_bl"]);
				$daili_total["detail"]["xj_ty"] += $xj_ty;
				
				$xj_total_all += $xj_ty;
			}
		}
	}
	
	
	$daili_total["detail"]["total"] = $daili_total["detail"]["ty_yx"] * 
	($daili_total["daili_mode"]==0?$daili_total["detail"]["ty_zc_fs_bl"]:$daili_total["detail"]["ty_cs_fs_bl"]);
	
	if($daili_total["daili_mode"]==0) {
		$daili_total["detail"]["total"] += ($daili_total["detail"]["ty"] - $daili_total["detail"]["sxf_cj"])*$daili_total["detail"]["ty_bl"];
		$daili_total["detail"]["total"] += $daili_total["detail"]["fc"] * $daili_total["detail"]["fc_bl"];
		$daili_total["detail"]["total"] += $daili_total["detail"]["lotto"] * $daili_total["detail"]["lotto_bl"];
	}
	$daili_total["detail"]["total"] += $xj_total_all;
	
	if($daili_total["daili_mode"]==0) {
		if($daili_total["has_yx_fs"]==0) {
			$daili_total["detail"]["ty_zc_fs_bl"] = 0;
			$daili_total["detail"]["ty_fs_bl"] = 0;
		} else {
			$daili_total["detail"]["ty_fs_bl"] = $daili_total["detail"]["ty_zc_fs_bl"];
		}
	} else {
		$daili_total["detail"]["ty_bl"] = 0;
		$daili_total["detail"]["fc_bl"] = 0;
		$daili_total["detail"]["lotto_bl"] = 0;
		$daili_total["detail"]["ty_fs_bl"] = $daili_total["detail"]["ty_cs_fs_bl"];
	}
	
	$daili_total_5f9f8cfem11282283l103286493[$uid] = $daili_total;
	return $daili_total;
}
?>