<?php
//幸运28开奖函数
function Ssc_Auto($num , $type){
    $dx_num=13;
    $zh = $num[3];
    if($type==1){
        return $zh;
    }
    if($type==2){
        if($zh>$dx_num){
            return '大';
        }else{
            return '小';
        }
    }
    if($type==3){
        if($zh%2==0){
            return '双';
        }else{
            return '单';
        }
    }
    if($type==4){
        if($zh>$dx_num){
            if($zh%2==0){
                return '大双';
            }else{
                return '大单';
            }
        }else{
            if($zh%2==0){
                return '小双';
            }else{
                return '小单';
            }
        }
    }
    if($type==5){
        if($zh==0 || $zh==1 || $zh==2 || $zh==3 || $zh==4){
            return '极小';
        }elseif($zh==23 || $zh==24 || $zh==25 || $zh==26 || $zh==27){
            return '极大';
        }else{
            return '非极值';
        }
    }
    if($type==6){
        if($zh==0 || $zh==13 || $zh==14 || $zh==27){
            return '白';
        }elseif($zh==1 || $zh==4 || $zh==7 || $zh==10 || $zh==16|| $zh==19|| $zh==22|| $zh==25){
            return '绿';
        }elseif($zh==2 || $zh==5 || $zh==8 || $zh==11 || $zh==17|| $zh==20|| $zh==23|| $zh==26){
            return '蓝';
        }else{
            return '红';
        }
    }
    if($type==7){
        if($num[0]==$num[1] && $num[1]==$num[2]){
            return '豹子';
        }else{
            return '非豹子';
        }
    }
}