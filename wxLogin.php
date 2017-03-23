<?php
        #  用户登陆示例代码
        #  用户登陆主要是去微信服务器获取到session_key和用户的openid


include_once('./class/wxLoginClass.php');

$code = $_GET['code'];
$login = new WXLogin();
echo json_encode($login->login($code));