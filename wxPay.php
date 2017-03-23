<?php
// * 统一下单，WxPayUnifiedOrder中out_trade_no、body、total_fee、trade_type必填

require_once 'wxpay/WXPay.Api.php';
require_once 'wxpay/WXPay.data.php';
require_once 'class/wxLoginClass.php';


$code = $_GET['code'];

//模拟订单信息
$payArray = array(
    'out_trade_no' => (string)time(),
    'trade_type'=>'JSAPI',
    'total_fee' => 1,
    'body' =>'腾讯-红橙黄绿青蓝紫钻',
    'notify_url' => 'localhost:8080'
);

//使用code换取用户的openid
$login = new WXLogin();
$loginRes = $login->login($code);

//构建预支付订单所需要的信息
$payData = new WxPayUnifiedOrder();
$payData->SetOut_trade_no($payArray['out_trade_no']);
$payData->SetTrade_type($payArray['trade_type']);
$payData->SetTotal_fee($payArray['total_fee']);
$payData->SetBody($payArray['body']);
$payData->SetOpenid($loginRes['openid']);
$payData->SetNotify_url($payArray['notify_url']);


//获取预支付订单信息
$orderNo = WxPayApi::unifiedOrder($payData);
$paySignData = prepareSignData($orderNo);
echo(json_encode($paySignData));

function prepareSignData($orderNo){
    $jsApiPayData = new WxPayJsApiPay();

    $config = include 'config.php';
    $jsApiPayData->SetAppid($config['WXAPPID']);
    $jsApiPayData->SetTimeStamp((string)time());

    $rand = md5(time().mt_rand(0,1000));
    $jsApiPayData->SetNonceStr($rand);

    $jsApiPayData->SetPackage('prepay_id='.$orderNo['prepay_id']);
    $jsApiPayData->SetSignType('md5');
    $sign = $jsApiPayData->MakeSign();

    $rawValues = $jsApiPayData->GetValues();
    $rawValues['paySign'] = $sign;
    unset($rawValues['appId']);
    return $rawValues;
};

