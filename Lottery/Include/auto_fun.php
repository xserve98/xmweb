<?php
//单个数字变汉字
function n2c($x) {
    $arr_n = array("零","一","二","三","四","五","六","七","八","九","十");
    return $arr_n[$x];
}

function sum_int($result, $index) {
    if ((2 <= $index) && ($index <= 7)) {
        $num = $result[0] + $result[1] + $result[2] + $result[3] + $result[4] + $result[5] + $result[6] + $result[7];
    } else {
        if (($index == 0) || ($index == 1)) {
            $num = array(0, 0);
            $num[0] = $result[0];
            $num[1] = $result[7];
        } else {
            $num = NULL;
        }
    }

    return $num;
}

function sum_int_pk($result, $index) {
    if ((2 <= $index) && ($index <= 7)) {
        $num = $result[0] + $result[1];
    } else {
        if (($index == 0) || ($index == 1)) {
            $num = array(0, 0);
            $num[0] = $result[0];
            $num[1] = $result[7];
        } else {
            $num = NULL;
        }
    }

    return $num;
}

function sum_ball_string($ball, $index, $p = 1) {
    $number = $ball;
    if (($index == 0) || ($index == 1)) {
        if (($number % 2) == 0) {
            return "双";
        } else {
            return "单";
        }
    } else {
        if (($index == 2) || ($index == 3)) {
            if ($number <= 10) {
                return "小";
            } else {
                return "大";
            }
        } else {
            if (($index == 4) || ($index == 5)) {
                $i = mb_strlen($number);
                if (1 < $i) {
                    $number = substr($number, -1);
                }

                if (5 <= $number) {
                    return $p == 1 ? "尾大" : "大";
                } else {
                    return $p == 1 ? "尾小" : "小";
                }
            } else {
                if (($index == 6) || ($index == 7)) {
                    if (($number == 1) || ($number == 3) || ($number == 5) || ($number == 7) || ($number == 9) || ($number == 10) || ($number == 12) || ($number == 14) || ($number == 16) || ($number == 18)) {
                        return $p == 1 ? "合数单" : "单";
                    } else {
                        return $p == 1 ? "合数双" : "双";
                    }
                } else if ($index == 8) {
                    if (($number == 1) || ($number == 5) || ($number == 9) || ($number == 13) || ($number == 17)) {
                        return "东";
                    } else {
                        if (($number == 2) || ($number == 6) || ($number == 10) || ($number == 14) || ($number == 18)) {
                            return "南";
                        } else {
                            if (($number == 3) || ($number == 7) || ($number == 11) || ($number == 15) || ($number == 19)) {
                                return "西";
                            } else {
                                return "北";
                            }
                        }
                    }
                } else if ($index == 9) {
                    if (($number == 1) || ($number == 2) || ($number == 3) || ($number == 4) || ($number == 5) || ($number == 6) || ($number == 7)) {
                        return "中";
                    } else {
                        if (($number == 8) || ($number == 9) || ($number == 10) || ($number == 11) || ($number == 12) || ($number == 13) || ($number == 14)) {
                            return "发";
                        } else {
                            return "白";
                        }
                    }
                }
            }
        }
    }
}

function sum_ball_string_pk($ball, $index, $ball2 = NULL, $p = 1) {
    $number = $ball;

    if (($index == 0) || ($index == 1)) {
        if (($number % 2) == 0) {
            return "双";
        } else {
            return "单";
        }
    } else {
        if (($index == 2) || ($index == 3)) {
            if ($number <= 5) {
                return "小";
            } else {
                return "大";
            }
        } else {
            if (($index == 4) || ($index == 5)) {
                if (($ball2 != NULL) || ($ball2 != "")) {
                    if ($ball2 < $ball) {
                        return "龙";
                    } else {
                        return "虎";
                    }
                }
            }
        }
    }
}

function sum_ball_str_a($ball, $index, $p = 1) {
    if (($index == 0) || ($index == 1)) {
        if ($ball[1] < $ball[0]) {
            return "龙";
        } else {
            return "虎";
        }
    } else {
        if (($index == 2) || ($index == 3)) {
            if ($ball == 84) {
                return "和";
            } else {
                if (85 <= $ball) {
                    return $p == 1 ? "总和大" : "大";
                } else {
                    return $p == 1 ? "总和小" : "小";
                }
            }
        } else {
            if (($index == 4) || ($index == 5)) {
                if (($ball % 2) == 0) {
                    return $p == 1 ? "总和双" : "双";
                } else {
                    return $p == 1 ? "总和单" : "单";
                }
            } else {
                if (($index == 6) || ($index == 7)) {
                    $ball = substr($ball, -1);
                    if (5 <= $ball) {
                        return $p == 1 ? "总和尾大" : "大";
                    } else {
                        return $p == 1 ? "总和尾小" : "小";
                    }
                }
            }
        }
    }
}

function sum_ball_str_a_smpk($ball, $index, $p = 1) {
    if (($index == 2) || ($index == 3)) {
        if (11 < $ball) {
            return "冠亚和大";
        } else {
            return "冠亚和小";
        }
    } else {
        if (($index == 4) || ($index == 5)) {
            if (($ball % 2) == 0) {
                return "冠亚和双";
            } else {
                return "冠亚和单";
            }
        }
    }
}

function _getBallString($resultArray, $BallArray, $index = 0, $bool = false) {
    $countArray = array();

    for ($i = 0; $i < count($BallArray); $i++) {
        if ($bool == false) {
            $numStrng = sum_ball_string($resultArray, $i);

            if ($numStrng == $BallArray[$i]) {
                $countArray["第" . n2c($index) . "球-" . $BallArray[$i]] = 1;
            } else {
                $countArray["第" . n2c($index) . "球-" . $BallArray[$i]] = 0;
            }
        } else {
            $nString = sum_ball_str_a(sum_int($resultArray, $i), $i);

            if ($nString == $BallArray[$i]) {
                $countArray[$BallArray[$i]] = 1;
            } else {
                $countArray[$BallArray[$i]] = 0;
            }
        }
    }

    return $countArray;
}

function _getBallStringpk($resultArray, $BallArray, $index = 0, $bool = false, $resultArray1 = NULL) {
    $countArray = array();

    for ($i = 0; $i < count($BallArray); $i++) {
        if ($bool == false) {
            if ($resultArray1 == NULL) {
                $numStrng = sum_ball_string_pk($resultArray, $i);
            } else {
                $numStrng = sum_ball_string_pk($resultArray, $i, $resultArray1);
            }

            if ($numStrng == $BallArray[$i]) {
                switch ($index) {
                    case 1:
                        $countArray["冠军-" . $BallArray[$i]] = 1;
                        break;
                    case 2:
                        $countArray["亚军-" . $BallArray[$i]] = 1;
                        break;
                    default:
                        $countArray["第" . n2c($index) . "名-" . $BallArray[$i]] = 1;
                        break;
                }
            } else {
                switch ($index) {
                    case 1:
                        $countArray["冠军-" . $BallArray[$i]] = 0;
                        break;
                    case 2:
                        $countArray["亚军-" . $BallArray[$i]] = 0;
                        break;
                    default:
                        $countArray["第" . n2c($index) . "名-" . $BallArray[$i]] = 0;
                        break;
                }
            }
        } else {
            $nString = sum_ball_str_a_smpk(sum_int_pk($resultArray, $i), $i);

            if ($nString == $BallArray[$i]) {
                $countArray[$BallArray[$i]] = 1;
            } else {
                $countArray[$BallArray[$i]] = 0;
            }
        }
    }

    return $countArray;
}

function sum_ball_count($result, $gid) {
    $count = array(0, 0);
    $ballArr = array();

    for ($i = 1; $i < 21; $i++) {
        for ($n = 0; $n < count($result); $n++) {
            if ($i == $result[$n][$gid]) {
                $count[0]++;
                $count[1] = 0;
            } else {
                $count[1]++;
            }
        }

        $ballArr["row_1"][$i] = $count[0];
        $ballArr["row_2"][$i] = $count[1];
        $count[0] = 0;
        $count[1] = 0;
    }

    return $ballArr;
}

function sum_ball_count_1($BallString, $BallString_a, $result, $sMax = 2) {

    $numArray1 = array();
    $numArray2 = array();
    $countArray1 = array();
    $countArray2 = array();

    for ($i = 0; $i < count($result); $i++) {
        for ($n = 0; $n < count($result[$i]); $n++) {
            $s = $n + 1;
            $countArray1 += _getballstring($result[$i][$n], $BallString, $s);
        }

        $countArray2 += _getballstring($result[$i], $BallString_a, 0, true);

        foreach ($countArray1 as $key => $value ) {
            if ($value != 0) {
                $numArray1[$key] += $value;
            } else {
                $numArray1[$key] = 0;
            }
        }

        $countArray1 = array();

        foreach ($countArray2 as $key => $value ) {
            if ($value != 0) {
                $numArray2[$key] += $value;
            } else {
                $numArray2[$key] = 0;
            }
        }

        $countArray2 = array();
    }

    $numArray1 = array_merge($numArray1, $numArray2);
    $numArr = array();
    $count = 0;

    foreach ($numArray1 as $key => $value ) {
        if ($sMax <= $value) {
            $count++;
            $numArr[$key] = $value;
        }
    }

    arsort($numArr);
    return $numArr;
}

function sum_ball_count_1_pk($BallString, $BallString_a, $result, $sMax = 2) {

    $numArray1 = array();
    $numArray2 = array();
    $countArray1 = array();
    $countArray2 = array();

    for ($i = 0; $i < count($result); $i++) {
        for ($n = 0; $n < count($result[$i]); $n++) {
            $s = $n + 1;
            if (4 < $n) {
                $countArray1 += _getballstringpk($result[$i][$n], $BallString, $s, false);
            } else {
                $countArray1 += _getballstringpk($result[$i][$n], $BallString, $s, false, $result[$i][9 - $n]);
            }
        }

        $countArray2 += _getballstringpk($result[$i], $BallString_a, 0, true);

        foreach ($countArray1 as $key => $value ) {
            if ($value != 0) {
                @$numArray1[$key] += $value;
            } else {
                $numArray1[$key] = 0;
            }
        }

        $countArray1 = array();

        foreach ($countArray2 as $key => $value ) {
            if ($value != 0) {
                @$numArray2[$key] += $value;
            } else {
                $numArray2[$key] = 0;
            }
        }

        $countArray2 = array();
    }

    $numArray1 = array_merge($numArray1, $numArray2);
    $numArr = array();
    $count = 0;

    foreach ($numArray1 as $key => $value ) {
        if ($sMax <= $value) {
            $count++;
            $numArr[$key] = $value;
        }
    }

    return $numArr;
}

function sum_str_s_pk($result, $index, $int = 25, $bool = false, $num = NULL, $count = NULL, $p = 1) {
    $k = NULL;
    $ball = NULL;
    $stratTd = '<td class="z_cl">';
    $topTd = '</td>,<td class="z_cl">';
    $td = array();
    $ar = array();
    $str = '';

    for ($i = 0; $i < count($result); $i++) {
        $ball = @$result[$i][$index];
        if ($bool) {
            $ar[0] = $result[$i][0];
            $ar[1] = $result[$i][7];
            $ball = sum_ball_str_a($ar, 0, $p);
        } else if ($num) {
            $ball = sum_ball_string($ball, $num, $p);
        } else if ($count) {
            $v = $result[$i][0] + $result[$i][1];
            if ($count == 6) {
                $ball = $v;
            } else {
                $ball = sum_ball_str_a_smpk($v, $count, $p);
                $ball = str_replace("冠亚和", "", $ball);
            }
        }

        if ($k != $ball) {
            $str .= ($i == 0 ? $stratTd . $ball : $topTd . $ball);
        } else {
            $str .= "<br />" . $ball;
        }

        $k = $ball;
    }

    $str .= "</td>";
    $arr = explode(",", $str);

    for ($i = 0; $i < $int; $i++) {
        $td[] = '<td class="z_cl"></td>';
    }

    $arr = array_merge($td, $arr);
    $arr = array_slice($arr, -25);
    return $arr;
}

function sum_str_s($result, $index, $int = 25, $bool = false, $num = NULL, $count = NULL, $p = 1) {
    $k = NULL;
    $ball = NULL;
    $stratTd = "<td class=\"z_cl\">";
    $topTd = "</td>,<td class=\"z_cl\">";
    $td = array();
    $ar = array();
    $str = '';

    for ($i = 0; $i < count($result); $i++) {
        $ball = $result[$i][$index];
        if ($bool) {
            $ar[0] = $result[$i][0];
            $ar[1] = $result[$i][7];
            $ball = sum_ball_str_a($ar, 0, $p);
        } else if ($num) {
            $ball = sum_ball_string($ball, $num, $p);
        } else if ($count) {
            $v = $result[$i][0] + $result[$i][1] + $result[$i][2] + $result[$i][3] + $result[$i][4] + $result[$i][5] + $result[$i][6] + $result[$i][7];
            $ball = sum_ball_str_a($v, $count, $p);
        }

        if ($k != $ball) {
            $str .= ($i == 0 ? $stratTd . $ball : $topTd . $ball);
        } else {
            $str .= "<br />" . $ball;
        }

        $k = $ball;
    }

    $str .= "</td>";
    $arr = explode(",", $str);

    for ($i = 0; $i < $int; $i++) {
        $td[] = "<td class=\"z_cl\"></td>";
    }

    $arr = array_merge($td, $arr);
    $arr = array_slice($arr, -25);
    return $arr;
}

function OpenNumberCount($result, $id, $p = false) {
    $count = 0;
    $ballArr = array();
    $id--;

    for ($i = 0; $i < 10; $i++) {
        for ($n = 0; $n < count($result); $n++) {
            if ($p == true) {
                if ($i != $result[$n][0] && $i != $result[$n][1] && $i != $result[$n][2] && $i != $result[$n][3] && $i != $result[$n][4]) {
                    $count++;
                } else {
                    $count = 0;
                }
            } else {
                if ($i == $result[$n][$id]) {
                    $count++;
                }
            }
        }
        $ballArr[$i] = $count;
        $count = 0;
    }
    return $ballArr;
}

function OpenNumberLuZhu($result, $id, $index = 0, $num = 0) {
    $k = -1;
    $stratTd = "<td class=\"z_cl\">";
    $topTd = "</td>,<td class=\"z_cl\">";
    $td = array();
    $id--;
    $str = '';

    for ($i = 0; $i < count($result); $i++) {
        $ball = $result[$i][$id];
        if ($num == 0) {
            $ball = cqNumber($index, $ball, 1);
        } else {
            if ($num == 1) {
                $ball = cqNumber($index, $result[$i][0] + $result[$i][1] + $result[$i][2] + $result[$i][3] + $result[$i][4], 1);
            } else {
                if ($num == 2) {
                    $ball = cqNumber($index, array($result[$i][0], $result[$i][4]), 1);
                }
            }
        }
        if ($k != $ball) {
            $str .= ($i == 0 ? $stratTd . $ball : $topTd . $ball);
        } else {
            $str .= "<br />" . $ball;
        }
        $k = $ball;
    }
    $str .= "</td>";
    $arr = explode(",", $str);
    for ($i = 0; $i < 25; $i++) {
        $td[] = "<td class=\"z_cl\"></td>";
    }
    $arr = array_merge($td, $arr);
    $arr = array_slice($arr, -25);
    return $arr;
}

function cqNumber($num, $ball, $p = 0) {
    switch ($num) {
        case 0:
            if (23 <= $ball) {
                return $p == 0 ? "大" : "总和大";
            } else {
                return $p == 0 ? "小" : "总和小";
            }
        case 1:
            if (($ball % 2) == 0) {
                return $p == 0 ? "双" : "总和双";
            } else {
                return $p == 0 ? "单" : "总和单";
            }
        case 2:
            if ($ball[0] == $ball[1]) {
                return "和";
            } else if ($ball[1] < $ball[0]) {
                return "龙";
            } else {
                return "虎";
            }
        case 3:
            if (5 <= $ball) {
                return "大";
            } else {
                return "小";
            }
        case 4:
            if (($ball % 2) == 0) {
                return "双";
            } else {
                return "单";
            }
        case 5:
            if (23 <= $ball) {
                return "大";
            } else {
                return "小";
            }
        case 6:
            if (($ball % 2) == 0) {
                return "双";
            } else {
                return "单";
            }
    }
}

function OpenNumberChangLong($BallStringcq, $BallString_acq, $result, $openMax = 2) {
    $numArray1 = array();
    $numArray2 = array();
    $countArray1 = array();
    $countArray2 = array();

    for ($i = 0; $i < count($result); $i++) {
        for ($n = 0; $n < count($result[$i]); $n++) {
            $s = $n + 1;
            $countArray1 += GetBallString($result[$i][$n], $BallStringcq, $s);
        }
        $countArray2 += GetBallString($result[$i], $BallString_acq, 0, true);

        foreach ($countArray1 as $key => $value) {
            if ($value != 0) {
                $numArray1[$key] += $value;
            } else {
                $numArray1[$key] = 0;
            }
        }

        $countArray1 = array();

        foreach ($countArray2 as $key => $value) {
            if ($value != 0) {
                $numArray2[$key] += $value;
            } else {
                $numArray2[$key] = 0;
            }
        }

        $countArray2 = array();
    }

    $numArray1 = array_merge($numArray1, $numArray2);
    $numArr = array();

    foreach ($numArray1 as $key => $value) {
        if ($openMax <= $value) {
            $numArr[$key] = $value;
        }
    }

    arsort($numArr);
    return $numArr;
}

function GetBallString($result, $BallArray, $index = 0, $bool = false) {
    $countArray = array();

    for ($i = 0; $i < count($BallArray); $i++) {
        if ($bool == false) {
            $numStrng = Getcqa($result, $i);
            if ($numStrng == $BallArray[$i]) {
                $countArray["第" . n2c($index) . "球-" . $BallArray[$i]] = 1;
            } else {
                $countArray["第" . n2c($index) . "球-" . $BallArray[$i]] = 0;
            }
        } else {
            $nString = Getcqc(SumCount($result, $i), $i);
            if ($nString == $BallArray[$i]) {
                $countArray[$BallArray[$i]] = 1;
            } else {
                $countArray[$BallArray[$i]] = 0;
            }
        }
    }

    return $countArray;
}

function Getcqa($result, $num) {
    if (($num == 0) || ($num == 1)) {
        if (($result % 2) == 0) {
            return "双";
        } else {
            return "单";
        }
    } else {
        if (($num == 2) || ($num == 3)) {
            if (5 <= $result) {
                return "大";
            } else {
                return "小";
            }
        }
    }
}

function Getcqc($result, $num) {
    if (($num == 0) || ($num == 1)) {
        if (($result % 2) == 0) {
            return "总和双";
        } else {
            return "总和单";
        }
    } else {
        if (($num == 2) || ($num == 3)) {
            if (23 <= $result) {
                return "总和大";
            } else {
                return "总和小";
            }
        } else {
            if (($num == 4) || ($num == 5) || ($num == 6)) {
                if ($result[0] == $result[1]) {
                    return "和";
                } else {
                    if ($result[1] < $result[0]) {
                        return "龙";
                    } else {
                        return "虎";
                    }
                }
            }
        }
    }
}

function SumCount($result, $index) {
    if ((0 <= $index) && ($index <= 3)) {
        $num = $result[0] + $result[1] + $result[2] + $result[3] + $result[4];
    } else {
        $num = array(0, 0);
        $num[0] = $result[0];
        $num[1] = $result[4];
    }
    return $num;
}