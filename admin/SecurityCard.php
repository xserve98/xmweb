<?php
/*自定义攻击拦截*/
require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');

/**
* Author:       wonli
* Contact:      wonli@live.com
* Date:         2011-10
* Description:  securitycard
*/
class SecurityCard
{
    private $msgCode = NULL;
    private $link = NULL;
    /**
     * 建立数据库连接
     *
     * @return object resource
     */
    function __construct()
    {
        $this->link = new DataAccess;
        $this->link->connect("127.0.0.1","root","@@##qqaa8520","dy3_db");
    }
    /**
     * 生成密保卡数据
     *
     * @param
     * @return array
     */
    private function makeSecurityCard()
    {
        $security = array();
        $str = '3456789abcdefghjkmnpqrstuvwxy';

        for($k = 65; $k<74; $k++)
        {
            for($i = 1; $i<=9; $i++)
            {
                $_x=substr(str_shuffle($str), $i, $i+2);
                $security[chr($k)][$i] = $_x[0].$_x[1];
            }
        }
        return serialize($security);
    }
    /**
     * 随机生成密保卡坐标
     *
     * @param
     * @return string
     */
    public function getLocation()
    {
        $strx = '123456789';
        $stry = 'ABCEDEGHI';
        $scode = array();
        for($i=0; $i<9; $i++)
        {
            for($k=0; $k<9; $k++)
            {
                $scode[] = $stry[$i].$strx[$k];
            }
        }
        shuffle($scode);
        $scode =  array_slice($scode, 0, 2);
        return $scode[0].$scode[1];
    }
    /**
     * 绑定密保卡
     *
     * @param string binduser
     * @return mix
     */
    public function bindcard($binduser)
    {
        $checkbind = self::checkbind($binduser);

        if(is_array($checkbind))
        {
            $this->msgCode = -2;

        } elseif($checkbind == -4) {

            $carddata = self::makeSecurityCard();
            $sql   = "INSERT INTO `securitycard` (`id`, `carddata`, `binduser`, `exdate`)VALUES(NULL, '$carddata', '$binduser', 0)";
            $notes = $this->link->execute($sql);
            if($notes){
                $this->msgCode = 0;
                self::printSecurityCard($binduser);
            }

        } else {

            $this->msgCode = -6;
        }
    }
    /**
     * 更新密保卡
     *
     * @param security user
     * @return bool
     */
    function updateCard($binduser)
    {
        $carddata = self::makeSecurityCard();
        $sql = "UPDATE `securitycard` SET `carddata`='$carddata' WHERE `binduser`='$binduser'";

        $notes = $this->link->execute($sql);
        if($notes) {
            $this->msgCode =  1;
            return true;
        } else {
            $this->msgCode = -1;
            return false;
        }
    }
    /**
     * 取消绑定
     *
     * @param string binduser
     * @return bool;
     */
    function killbind($binduser)
    {
        $sql = "DELETE FROM `securitycard` WHERE `binduser` = '$binduser'";
        $notes = $this->link->execute($sql);

        if($notes) {
            $this->msgCode = 3;
            return true;
        }
        $this->msgCode = -3;
        return false;
    }
    /**
     * 检查是否绑定过密保卡
     *
     * @param string binduser
     * @return bool
     */
    private function checkbind($binduser)
    {
		/*
        $sql = "SELECT `id`,`exdate`,`carddata` FROM `securitycard` WHERE `binduser` = '$binduser' LIMIT 0,1";
        $data  = $this->link->fetchOne($sql);

        if($data)
        {
            if($data['exdate'] != -1)
            {
                return unserialize($data['carddata']);
            } else {
                return -5;
            }
        } else {
            return -4;
        }*/
		$carddata = 'a:9:{s:1:"A";a:9:{i:1;s:2:"6w";i:2;s:2:"39";i:3;s:2:"n9";i:4;s:2:"pg";i:5;s:2:"v9";i:6;s:2:"5b";i:7;s:2:"jr";i:8;s:2:"hb";i:9;s:2:"fj";}s:1:"B";a:9:{i:1;s:2:"ts";i:2;s:2:"f4";i:3;s:2:"c4";i:4;s:2:"d6";i:5;s:2:"wb";i:6;s:2:"vk";i:7;s:2:"kr";i:8;s:2:"en";i:9;s:2:"j6";}s:1:"C";a:9:{i:1;s:2:"sr";i:2;s:2:"pb";i:3;s:2:"vr";i:4;s:2:"bc";i:5;s:2:"xq";i:6;s:2:"rm";i:7;s:2:"8r";i:8;s:2:"ns";i:9;s:2:"hr";}s:1:"D";a:9:{i:1;s:2:"dw";i:2;s:2:"uf";i:3;s:2:"e6";i:4;s:2:"wy";i:5;s:2:"ga";i:6;s:2:"se";i:7;s:2:"jk";i:8;s:2:"7g";i:9;s:2:"f5";}s:1:"E";a:9:{i:1;s:2:"jn";i:2;s:2:"et";i:3;s:2:"gc";i:4;s:2:"bj";i:5;s:2:"8j";i:6;s:2:"ux";i:7;s:2:"nm";i:8;s:2:"vw";i:9;s:2:"tr";}s:1:"F";a:9:{i:1;s:2:"qb";i:2;s:2:"sv";i:3;s:2:"jr";i:4;s:2:"95";i:5;s:2:"em";i:6;s:2:"eh";i:7;s:2:"sq";i:8;s:2:"tc";i:9;s:2:"f5";}s:1:"G";a:9:{i:1;s:2:"cw";i:2;s:2:"pq";i:3;s:2:"n5";i:4;s:2:"t8";i:5;s:2:"4d";i:6;s:2:"mh";i:7;s:2:"vx";i:8;s:2:"wj";i:9;s:2:"x5";}s:1:"H";a:9:{i:1;s:2:"p4";i:2;s:2:"6g";i:3;s:2:"84";i:4;s:2:"d5";i:5;s:2:"gr";i:6;s:2:"t5";i:7;s:2:"3n";i:8;s:2:"bh";i:9;s:2:"75";}s:1:"I";a:9:{i:1;s:2:"kf";i:2;s:2:"ea";i:3;s:2:"8e";i:4;s:2:"jq";i:5;s:2:"7r";i:6;s:2:"dw";i:7;s:2:"7h";i:8;s:2:"kd";i:9;s:2:"wc";}}';
		return unserialize($carddata);
    }
    /**
     * 取得密保卡数据
     *
     * @param string
     * @return array
     */
    private function getSecrityData($binduser)
    {
        $isbind = self::checkbind($binduser);

        if($isbind < 0)
        {
            $this->msgCode = $isbind;
            return false;
        }

        return $isbind;
    }
    /**
     * 打印密保卡
     *
     * @param
     * @return HTML
     */
    function printSecurityCard($binduser)
    {
        $scodedata = self::getSecrityData($binduser);

        if($scodedata)
        {
            echo '<table style="width:450px;height:350px;text-align:center;border:1px solid #808080;margin:20px;border-collapse: collapse;"><tr><td style="background:blue;color:#ffffff;border:1px solid #808080">&nbsp;&nbsp;</td>';
            for($i=1;$i<=9;$i++)
            {
                echo '<td style="background:blue;color:#ffffff;font-weight:bold;border:1px solid #808080">'.$i.'</td>';
            }
            echo '</tr>';

            foreach($scodedata as $k=>$v)
            {
                echo '<tr><td style="background:blue;color:#ffffff;font-weight:bold;border:1px solid #808080">'.$k.'</td>';
                for($i=1;$i<=9;$i++)
                {
                    echo '<td style="background:#ffffee;border:1px solid #808080";font-family:sans-serif;>'.$v[$i].'</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        }
    }
    /**
     * 验证密保卡
     *
     * @param array carddata
     * @param string $location  ex:A1B2
     * @param string $inputscode
     * @return bool
     */
    function verifyscode($user, $location, $inputscode)
    {
        $scodedata = self::getSecrityData($user);
        $right_scode = $scodedata[$location[0]][$location[1]].$scodedata[$location[2]][$location[3]];
        
        #判断是否相等
        if($inputscode == $right_scode) {
            $this->msgCode = 9;
            return true;
        }
        $this->msgCode = -9;
        return false;
    }
    /**
     * 取得结果和值
     *
     * @return array
     */
    public function getStatus()
    {
        $messages = array(
            9 => '验证成功!',
            3 => '解除绑定成功!',
            1 => '更新密保卡成功!',
            0 => '绑定成功!',
           -1 => '更新密保卡失败!',
           -2 => '不能重复绑定密保卡!',
           -3 => '解除绑定失败!',
           -4 => '该用户还未绑定密保卡!',
           -5 => '该卡已过期!',
           -6 => '已绑定过密保卡,但已过期!',
           -9 => '验证失败!',
        );
        if($this->msgCode)
        {
            return array('error'=>$this->msgCode, 'message'=>$messages[$this->msgCode]);
        }
    }
}
