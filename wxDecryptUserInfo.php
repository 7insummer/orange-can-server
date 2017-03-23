<?php
        #  解密用户非明文数据

include_once('./class/wxBizDataCrypt.php');
include_once('./class/wxLoginClass.php');
$config = include_once('config.php');

$code = $_GET['code'];
$encryptedData = $_GET['encryptedData'];
$iv = $_GET['iv'];
$wxAppID = $config['WXAPPID'];

$login = new WXLogin();
$sessionRes = $login->login($code);

$pc = new WXBizDataCrypt($wxAppID, $sessionRes['session_key']);
$errCode = $pc->decryptData($encryptedData, $iv, $data );

if ($errCode == 0) {
    echo $data;
} else {
    print $errCode;
}
    

