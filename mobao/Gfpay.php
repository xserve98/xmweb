<?php
include_once("../include/mysqli.php");
require_once("Gfpay.config.php");

/*
 * 获取表单数据
 * */
$order_id = (string) date("YmdHis"); //您的订单Id号，你必须自己保证订单号的唯一性，国易付不会限制该值的唯一性
$payType = $_POST['payType'];  //充值方式：bank为网银，card为卡类支付
$account = $_POST['account'];  //充值的账号
$amount = $_POST['amount'];   //充值的金额
//网银支付
if ('bank' == $payType) {
    $bankType = $_POST['bankType'];   //银行类型


    /*
     * 提交数据
     * */
    include_once("./mnouvw/class.bankpay.php");
    $bankpay = new bankpay();
    $bankpay->parter = $mnouvw_merchant_id;  //商家Id
    $bankpay->key = $mnouvw_merchant_key; //商家密钥
    $bankpay->type = $bankType;   //商家密钥
    $bankpay->value = $amount;    //提交金额
    $bankpay->orderid = $order_id;   //订单Id号
    $bankpay->callbackurl = $mnouvw_callback_url; //下行url地址
    $bankpay->hrefbackurl = $mnouvw_bank_hrefbackurl; //下行url地址
    //发送
    $bankpay->send();
}
//卡类支付
else if ('card' == $payType) {
    $cardType = $_POST['cardType'];   //卡类型
    $card_number = $_POST['card_number'];  //卡号
    $card_password = $_POST['card_password'];  //卡密
    /*
     * 提交数据
     * */
    include_once("mnouvw/class.mnouvwpay.php");
    $mnouvw = new mnouvw();
    $mnouvw->type = $cardType;   //卡类型	
    $mnouvw->cardno = $card_number;   //卡号
    $mnouvw->cardpwd = $card_password;  //卡密
    $mnouvw->value = $amount;    //提交金额
    $mnouvw->restrict = $mnouvw_restrict;  //地区限制, 0表示全国范围
    $mnouvw->orderid = $order_id;   //订单号
    $mnouvw->callbackurl = $mnouvw_callback_url; //下行url地址
    $mnouvw->parter = $mnouvw_merchant_id;  //商家Id
    $mnouvw->key = $mnouvw_merchant_key; //商家密钥
    //发送
    $result = $mnouvw->send();

    /*
     * 处理结果
     * */
    switch ($result) {
        case '0':
            header("location: pay_card_finish.php?order_id=$order_id");
            break;
        case '-1':
            header("location: pay_card_finish.php?order_id=$order_id");
            break;
        case '-2':
            print('签名错误');
            break;
        case '-3':
            print('<script language="javascript">alert("对不起，您填写的卡号卡密有误！"); history.go(-1);</script>');
            break;
        case '-999':
            print('<script language="javascript">alert("对不起，接口维护中，请选择其他的充值方式！"); history.go(-1);</script>');
            break;
        default:
            print('未知的返回值, 请联系国易付官方！');
            break;
    }
} else if ('card_muti' == $payType) {
    include_once("mnouvw/class.mnouvw.muti.php");

    $cardType_muti = $_POST['cardType_muti'];

    $card_number = $_POST['card_number'];
    $card_password = $_POST['card_password'];
    $card_value = $_POST['card_value'];
    $restrict = $_POST['restrict'];
    $attach = $_POST['attach'];

    $mnouvw = new mnouvw();

    $mnouvw->type = $cardType_muti;
    $mnouvw->parter = $mnouvw_merchant_id;
    $mnouvw->cardno = implode(",", $card_number);
    $mnouvw->cardpwd = implode(",", $card_password);
    $mnouvw->value = implode(",", $card_value);
    $mnouvw->restrict = implode(",", $restrict);
    $mnouvw->orderid = $order_id;
    $mnouvw->attach = $attach;
    $mnouvw->callbackurl = $mnouvw_callback_url_muti;
    $mnouvw->key = $mnouvw_merchant_key;

    $result = $mnouvw->send();

    switch ($result) {
        case '0':
            header("location: pay_card_finish.php?order_id=$order_id");
            break;
        case '-1':
            print("请求参数无效");
            break;
        case '-2':
            print('签名错误');
            break;
        case '-3':
            print('<script language="javascript">alert("卡密为重复提交，国易付系统不进行消耗且不进入下行流程。"); history.go(-1);</script>');
            break;
        case '-4':
            print("卡密不符合国易付定义的卡号密码面值规则，国易付系统不进行消耗且不进入下行流程。");
            break;
        case '-999':
            print('<script language="javascript">alert("对不起，国易付付接口维护中，请选择其他的充值方式！"); history.go(-1);</script>');
            break;
        default:
            print('未知的返回值, 请联系国易付官方！');
            break;
    }
}
?>