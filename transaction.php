<?php
    require "connection.php";

    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:Content-Type"); //GET, POST, PATCH
    header("Content-Type:application/json");
    
    $input = json_decode(file_get_contents("php://input"), true);

    $sellerID = $input['sellerID'];
    // echo json_encode($sellerID);

    $query="SELECT * FROM transaction_tb WHERE seller_id=?";
    $prepare = $connect->prepare($query);
    $prepare->bind_param('i',$sellerID);
    $found = $prepare->execute();
   
    if($found){
        $fetchobj=$prepare->get_result();
        
        if($fetchobj->num_rows>0){
            $user=$fetchobj->fetch_all(MYSQLI_ASSOC);
            $response=[
                'msg'=>" success",
                'status'=>true,
                "msg"=> $user,
            ];
            echo json_encode($response) ;
        }
        else{
            $response=[
                'msg'=>" not found",
                'status'=>false,
            ];
            echo json_encode($response) ;
        }
    }
    else{
        $response=[
            'msg'=>"Seller ID not found",
            'status'=>false,
        ];
        echo json_encode($response) ;
    }

?>