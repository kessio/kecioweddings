<?php

namespace NsLittle;
 
 class Little{
    
    const ROUTE = "http://localhost/kecioweddingsbe";
    
    public static function shaz_curl($post_data, $url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json; charset=utf-8'
			));    
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    
    
    
    
    
    
   /* function shaz_curl($params,$url){
        
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
        $result    = curl_exec($ch);
        curl_close($ch);
        
        return $result;
        
    } */
    
   
    
    }
    
