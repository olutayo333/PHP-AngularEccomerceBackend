<?php
    require 'connection.php';

    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:Content-Type"); //GET, POST, PATCH
    header("Content-Type:application/json");
    
    $input = json_decode(file_get_contents("php://input"), true);

    $productID = $input['productID'];

    //  echo json_encode($productID);

    $query = "DELETE FROM product_tb WHERE product_id = ?";
    $prepare = $connect->prepare($query);
    $prepare->bind_param('i', $productID);
    $found = $prepare->execute();

    if($found){
        $response=[
                    'msg'=> "Deleted Successfully",
                    'status'=> true,
                ];
                echo json_encode($response);
    }
    else{
            $response=[
                'msg'=> "Unable to delete",
                'status'=> false,
            ];
            echo json_encode($response);
    }
?>