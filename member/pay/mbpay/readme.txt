欢迎您使用Mo宝支付提供的支付接入服务。此目录是PHP样本代码(MD5签名版)。

1)关键文件列表说明
|---Mobaopay.Config.php	    (共通配置文件，正式请求地址在此文件中修改，商家可以在此文件中修改商家的ID和密钥和支付通知地址等信息)
|---lib/MobaoPay.class.php	(共通交易函数文件，做签名和验证签名及交易相关处理)
|---pay.php			        (支付请求处理文件，通过此文件发起支付请求，商家可以在此文件中处理订单信息等，然后把请求提交给Mo宝支付)
|---callback.php	        (支付结果通知处理文件，通过此文件商家判断对应订单的支付成功状态，并且根据结果修改自己数据库中的订单状态)
|---query.php               (订单信息查询接口样例)
|---refund.php   			(退款接口样例)

2)商家测试可以先用Mo宝支付的测试商家测试成功，再在Mobaopay.Config.php文件中修改成自己的商家ID和私钥密码信息
$merchant_acc = "210001110100250";
$platform_id = "MerchTest";
$mbp_key = "22c41d776c24deddca95b1709a88f04b";

3)共通文件采用服务器包含的方式进行处理
如：
	require_once("Mobaopay.Config.php");
	require_once("lib/MobaoPay.class.php");

4) 中文商品名称请注意使用UTF-8编码


集成测试步骤简要说明
1)将Mobaopay.Config.php添加到工程中，并根据注释修改相应设置。
2)将lib/MobaoPay.class.php添加到工程中。
3)设置PHP支持CURL扩展。
4)支付接口调试请参考
	normalPay.php		支付请求订单表单样例
	pay.php			支付请求处理文件
	callback.php		支付结果同步通知及异步通知处理文件
5)支付订单查询接口调试请参考
	queryOrd.php		支付订单查询表单样例
	query.php		支付订单查询处理文件
6)退款接口调试请参考
	refundOrd.php		退款请求表单样例
	refund.php		退款请求处理文件