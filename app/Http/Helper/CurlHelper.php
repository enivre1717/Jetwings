<?php

namespace App\Http\Helper;

class CurlHelper
{
    public static function post($url, $data, $header = ""){
        
        $apiUrl = config("app.base_api_url").$url;
        
        $ch = curl_init($apiUrl);
            
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        if(isset($header) && !empty($header)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: '.$header,
            ));
        }
        
        $result = curl_exec($ch);
        
        curl_close($ch);
        
        return $result;
    }
    
    public static function get($url, $header = ""){
        
        $apiUrl = config("app.base_api_url").$url;
        
        $ch = curl_init($apiUrl);
            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        
        if(isset($header) && !empty($header)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: '.$header,
            ));
        }

        $result = curl_exec($ch);

        curl_close($ch);
        
        return $result;
    }
}
