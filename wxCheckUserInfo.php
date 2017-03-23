<?php
        #  用户信息校验

include_once('./class/wxLoginClass.php');

$code = $_GET['code'];
$signature = $_GET['signature'];
$rawData = $_GET['rawData'];

$login = new WXLogin();
$sessionRes = $login->login($code);

$valid = checkUserInfo($signature, $rawData, $sessionRes['session_key']);
echo $valid;

function checkUserInfo($signatureOri, $rawData, $session_key){
    $signatureSha1 = sha1($rawData.$session_key);
    if($signatureOri==$signatureSha1){
        return "校验通过";
    }
    else{
        return "校验不通过";
    }
}
    

