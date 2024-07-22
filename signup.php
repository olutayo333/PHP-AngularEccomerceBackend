<?php
    require "connection.php";

    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:Content-Type"); //GET, POST, PATCH
    header("Content-Type:application/json");
    
    $input = json_decode(file_get_contents("php://input"), true);

    $name = $input['name'];
    $businessname=$input['businessname'];
    $email = $input['email'];
    $password= $input['password'];

     //echo json_encode($name);

    $query= "SELECT * FROM  sellers_tb WHERE email= '$email' ";
    $dbcon= $connect->query($query);

    if($dbcon)
   {        
        if($dbcon->num_rows>0){
            $response=['msg' => 'Email Exist'];
            echo json_encode($response);
        }
           
        else{
            $hashp= password_hash($password, PASSWORD_DEFAULT);
            $query=" INSERT INTO sellers_tb (`name`, `business_name`, `email`, `password`) VALUES (?,?,?,?)" ;
            $prepare =$connect->prepare($query);
            $prepare->bind_param('ssss', $name, $businessname, $email, $hashp);
            $dbconnection=$prepare->execute();

            if($dbconnection){
                $response=[
                    'msg'=>'Signed up Successfully',
                    'status'=>true,
                ];
                echo json_encode($response);
            }
            else{
                $response=[
                    'msg'=>'Sign up failed',
                    'status'=>false,
                ];
                echo json_encode($response);
            }
        }
    }
    else{
        echo json_encode("Connection failed");
    }


    ?>