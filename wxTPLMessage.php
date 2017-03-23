<?php
        #  模板消息示例代码


include_once('./class/http.php');
include_once('./class/wxLoginClass.php');
$config = include_once('config.php');

//接收参数
$data = file_get_contents("php://input"); 
$data = json_decode($data,true);
$code = $_GET['code'];

//获取openid
$login = new WXLogin();
$loginRes = $login->login($code);
$openId = $loginRes['openid'];

//获取access_token
$tokenUrl = $config['TOKENURL'];
$tokenUrl = sprintf($tokenUrl, $config["WXAPPID"], $config["WXAPPSECRET"]);
$access_token = curl_get($tokenUrl);
$access_token = json_decode($access_token,true);

//发送模板消息
$tplMSG = array(
    'touser' => $openId,
    'form_id' => $data['formId'],
    'page' => 'pages/setting/setting',
    // 填入开发者选择的TemplateID
    'template_id' =>'your template_id',
    'data' => array(
        'keyword1'=>array(
            "value" => $data['formData']['place'],
            "color" => '#333'
        ),
           'keyword2'=>array(
            "value" => $data['formData']['date'],
            "color" => '#333'
        ),
           'keyword3'=>array(
            "value" => $data['formData']['name'],
            "color" => '#333'
        ),
           'keyword4'=>array(
            "value" => $data['formData']['id'],
            "color" => '#333'
        )
    ),
    "emphasis_keyword" => "keyword3.DATA" 
);  

$tplMSGUrl = sprintf($config['TPLMSGURL'],$access_token['access_token']);
$msgResult = curl_post($tplMSGUrl, $tplMSG);
echo($msgResult);