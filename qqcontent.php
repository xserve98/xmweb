<?php
if($_GET['code']){
    //引入类
    require_once("qqcontent.php");
    $qc = new QC();
    $qc->qq_callback();
        $openid=$qc->get_openid();
    $arr = $qc->get_user_info();
            //代码以XXX注掉 官方认为是sql注入
        $sql = 'SXXXXT user_name,password,aite_id FROM '.$ecs->table('users').' WXXXXE aite_id = \''.$openid.'\'';
        $count = $db->getRow($sql);
                //查询用户是否存在 以openid哈 唯一的
        if(!$count)   // 没有当前数据,没有数据就写入
        {
            
            $name = $arr['nickname'];
            $user_pass = MD5($arr['nickname']);
            if($user->check_user($name))  // 重名处理
            {
                $name = $name.'_'.(rand(1000,9999));
            }
            //写入完毕 代码以XXX注掉 官方认为是sql注入
            $sql = 'INXXXXT INTO '.$ecs->table('users').'(user_name , password, aite_id , sex , reg_time , user_rank , is_validated) VALUES '.
                    "('$name' , '$user_pass' , '$openid' , '$info[sex]' , '".gmtime()."' , '$info[rank_id]' , '1')" ;
            $db->qXXXXy($sql);
        }else{
                        //如果用户存在,也同样把用户数据写入到session
            $name = $count['user_name'];
        }
        //设置session 直接把id啥的写入登陆状态
    $user->set_session($name);
    $user->set_cookie($name);
    update_user_info();
    recalculate_price();
        //跳转到会员中心即可
    header('Location: /user.php');
 }
 //登陆地址是 /xxxx/Connect2.1/example/oauth/index.php
 //或另写
        
    require_once("qqcontent.php");

	?>