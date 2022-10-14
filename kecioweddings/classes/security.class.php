<?php
namespace NsSecurity;

class Security{
  
    function sane_inputs($fieldname,$method){
        
        if($method == "POST"){
        
        return filter_input(INPUT_POST, $fieldname, FILTER_SANITIZE_STRING);
        
    }else if($method == "GET"){
        
         return filter_input(INPUT_GET, $fieldname, FILTER_SANITIZE_STRING);
        
    }
      
  }
}



