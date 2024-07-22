<?php
        require 'connection.php';

        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Headers:Content-Type"); //GET, POST, PATCH
        header("Content-Type:application/json");
        
        $input = json_decode(file_get_contents("php://input"), true);

        $query="SELECT * FROM product_tb";

        $products = $connect->query($query);
        $contacts = $products->fetch_all(MYSQLI_ASSOC);

        if ($contacts){
            $response=[
                'msg'=>" success",
                'status'=>true,
                "msg"=> $contacts,
            ];
            echo json_encode($response) ;
        }
        else{
            $response=[
                'msg'=>" failed",
                'status'=>false,
                
            ];
            echo json_encode($response) ;
        }
    
        
?>