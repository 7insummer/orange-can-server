<?php
return array(
    'WXAPPID' => 'your appid',
    'WXAPPSECRET' => 'your secret',
    'LOGINURL' =>  "https://api.weixin.qq.com/sns/jscode2session?".
                    "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
    'TOKENURL' => "https://api.weixin.qq.com/cgi-bin/token?".
                    "grant_type=client_credential&appid=%s&secret=%s",
    'TPLMSGURL' => "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?".
                    "access_token=%s"
);