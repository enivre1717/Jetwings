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
        
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        //return $result;
        //return response()->json(json_decode($result), $statusCode);
        return response($result, $statusCode);
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
        //die(print_r($result));
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        return response()->json(json_decode($result), $statusCode);
    }
}