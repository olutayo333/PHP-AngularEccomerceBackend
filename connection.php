<?php
    $host = 'localhost';
    $username= 'root';
    $password = '';
    $db='angular_ecommerce';

   // CONNECTING USING OOP
    $connect=new mysqli($host, $username, $password, $db);
    
    if($connect){
         //echo' connected';
    }
    else{
        // echo 'not connected'.$connect->connect_error;

    }
?>