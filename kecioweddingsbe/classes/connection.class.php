<?php

namespace NsDbconnect;
class Dbconnect{
    
    const host         = 'localhost';
    const username     = 'root';
    const password     = '';
    const db           = 'kecioweddings';
    
    
    function dbcon(){
        
        try{
            
          $mysqli = new\mysqli(self::host,self::username,self::password,self::db);
            $mysqli ->set_charset("utf8mb4");
       
           return $mysqli;
            
        } catch (Exception $e){
            
            error_log($e->getmessage());
            exit("connection to database failed");
            
        }
        
        
    }
    
    
    
    
    
    
    
}