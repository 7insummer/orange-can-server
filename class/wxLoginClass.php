<?php

class WXLogin{
    private $loginUrl;
    private $wxAppID;
    private $wxAppSecret;

    function WXLogin(){
        $config = include('./config.php');
        $this->loginUrl = $config['LOGINURL'];
        $this->wxAppID = $config['WXAPPID'];
        $this->wxAppSecret = $config['WXAPPSECRET'];
    }

    public function login($code){
        $loginUrl = sprintf($this->loginUrl, $this->wxAppID, $this->wxAppSecret,$code);
        $ch = curl_init();
        $timeout = 10;
        try{
            curl_setopt ($ch, CURLOPT_URL, $loginUrl);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

             // 设置为false仅用于测试，生产环境请设置为true
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $res = curl_exec($ch);
            curl_close($ch);
            $resArray = json_decode($res,true);
            return $resArray;
        }
        catch (Excetption $e){
            return $e;
        }
    }
}