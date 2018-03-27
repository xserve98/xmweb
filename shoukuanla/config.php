<?php 
//声明：此文件不能用记事本修改否则会出错，请使用Dreamweaver、EditPlus、Notepad++ ...等专业的工具。

//引入网站数据库配置文件
//if(!defined('THINK_PATH')){ define('THINK_PATH',true); }
//$dbCfg=require(SKL_root_PATH.'../config.inc.php');
//$explodeHost=explode(':',$dbCfg['DB_HOST']);
if(empty($dbCfg['DB_CHARSET'])){ $dbCfg['DB_CHARSET']='utf8'; }

return array(
//数据库配置信息
'cfg_DB_HOST'                 =>'127.0.0.1', //服务器地址*
'cfg_DB_PORT'                 =>'3306',//端口号*
'cfg_DB_NAME'                 =>'3dy1_db', // 数据库名*
'cfg_DB_USER'                 =>'root', // 用户名*
'cfg_DB_PWD'                  =>'root', // 密码*
'cfg_DB_CHARSET'              =>'utf8',//编码*
'cfg_DB_PREFIX'               =>'', // 数据库表前缀*

//'cfg_aliUser'               =>'yueruiwupay@163.com',//支付宝收款账号
//'cfg_tenUser'               =>'2323027019',//财付通收款账号
'cfg_sign'                    =>'02f9f8af401b246013dd14e00555f6',//静态秘钥*
'cfg_geTime'                  =>60*10,//间隔时间10分钟*

'cfg_orderTableName'          =>'huikuan',//订单表名(不加表前缀)*
'cfg_uidField'                =>'uid',//会员id字段*
'cfg_orderField'              =>'orderid',//订单号字段*
'cfg_sklOrderField'           =>'skl_order',//扫码备注订单号字段*
'cfg_moneyField'              =>'money',//金额字段*
'cfg_timeField'               =>'adddate',//时间字段*
'cfg_isTimestamp'             =>false,//订单时间是不是时间戳格式(如果不是填false)*
'cfg_stateField'              =>'status',//订单状态字段*
'cfg_stateValue'              =>'1',//支付成功订单用什么值代表*
'cfg_payTypeField'            =>'bank',//支付类型字段(如果没有该字段填skl_paytype系统会自动添加)*
'cfg_aliPayValue'             =>'alipay',//支付宝类型值*
'cfg_wxPayValue'              =>'wxpay',//微信类型值*
'cfg_tenPayValue'             =>'tenpay',//财付通类型值*
'cfg_jiaoyiField'             =>'lsh',//交易号字段(如果没有该字段填skl_jiaoyi系统会自动添加)*
'cfg_userField'               =>'',//付款人姓名字段
'cfg_infoField'               =>'manner',//备注字段

'cfg_k_money'         =>'k_money',//会员表名(不加表前缀)*
'cfg_memberTableName'         =>'k_user',//会员表名(不加表前缀)*
'cfg_memberUidField'          =>'uid',//会员UID字段*
'cfg_memberUserField'         =>'username',//会员用户名字段*
'cfg_memberMoneyField'        =>'money',//会员加金额字段*

'cfg_findOrderUrl'            =>SKL_WEBroot_PATH.'index.php?c=Querystatus',//ajax查询订单状态地址*
'cfg_returnUrl'               =>'/', //付款成功后返回地址*
'cfg_configId'                =>'',//配置文件识别id
'cfg_isWriteNoteAli'          =>'0',//支付宝免输备注和输备注方式切换开关, 0=免输备注 1=输备注
'cfg_isWriteNoteWx'           =>'0',//微信免输金额和输金额方式切换开关, 0=免输金额 1=输金额
'cfg_isOtherMoney'            =>'1',//是否开启其他金额充值，0=关闭 1=开启
'cfg_payTypeOrder'            =>array(1=>'alipay',2=>'wxpay',3=>'tenpay'),//支付类型显示排序,如果去掉某个值则不显示
);

?>