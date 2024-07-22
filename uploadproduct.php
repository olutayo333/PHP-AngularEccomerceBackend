<?php
    require 'connection.php';

    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:Content-Type"); //GET, POST, PATCH
    header("Content-Type:application/json");

    $input = json_decode(file_get_contents("php://input"), true);

    $productName = $input['productName'];
    $productPrice=$input['productPrice'];
    $productDescription = $input['productDescription'];
    $productImage= $input['productImage'];
    $productCategory= $input['productCategory'];
    $sellerID= $input['sellerID'];
    $productQuantity=$input['productQuantity'];

    //echo json_encode($productQuantity);
        $query=" INSERT INTO product_tb (`seller_id`, `product_name`, `product_description`, `product_category`, `product_price`, `product_quantity`, `product_image`) 
            VALUES (?,?,?,?,?,?,?)" ;
        $prepare =$connect->prepare($query);
        $prepare->bind_param('isssiis', $sellerID, $productName, $productDescription, $productCategory, $productPrice, $productQuantity, $productImage);
        $dbconnection=$prepare->execute();

    if ($dbconnection)
    {
            $response=[
                'msg'=>'Product Successfully Uploaded',
                'status'=>true,
            ];
             echo json_encode($response);
        
    }
    else{
        $response=[
            'msg'=> "Product Upload Failed",
            'status'=> false,
        ];
        echo json_encode($response);
    }


?>