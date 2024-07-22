<?php
    require 'connection.php';

    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:Content-Type"); //GET, POST, PATCH
    header("Content-Type:application/json");
    
    $input = json_decode(file_get_contents("php://input"), true);

    $email = $input['email'];
    $password= $input['password'];

     $query="SELECT * FROM sellers_tb WHERE email=?";
      //$dbcon= $connect->query($query);
        $prepare = $connect->prepare($query);
        $prepare->bind_param('s',$email);
        $found = $prepare->execute();
    
      if($found){
        $fetchobj=$prepare->get_result();
        
        if($fetchobj->num_rows>0){
            $user=$fetchobj->fetch_assoc();
            $hashedPassword= $user['password'];
            $verify=password_verify($password, $hashedPassword);
            if($verify){
                $response=[
                    'msg'=>'Correct Password',
                    'status'=>true,
                    'seller'=>$user,
                ];
                echo json_encode($response) ;   
            }
            else{
                $response=[
                    'msg'=>'Incorrect Password',
                    'status'=>false,
                ];
                echo json_encode($response) ;
            }
        }
        else{
            $response=[
                'msg'=>"Email not found",
                'status'=>false,
            ];
            echo json_encode($response) ;
        }
    }
    else{
        $response=[
            "msg"=> " Request Failed",
            "status"=> false,
        ];
        echo json_encode($response);
    }
    
?>