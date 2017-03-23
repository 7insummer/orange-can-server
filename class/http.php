 <?php

   function curl_post($url,array $params = array()){
            $data_string = json_encode($params);
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, 1);
            
            // 设置为false仅用于测试，生产环境请设置为true
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, 
                array(
                'Content-Type: application/json'
                )
            );
            $data = curl_exec($ch);
            curl_close($ch);
            return($data);    
  }

   function curl_get($url){
            $ch = curl_init(); 
            curl_setopt ($ch, CURLOPT_URL, $url);            
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);     
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);       
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);             
            $file_contents = curl_exec($ch);             
            curl_close($ch);
            return $file_contents;      
    }