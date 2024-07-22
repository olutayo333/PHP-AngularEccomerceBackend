<?php
     require 'connection.php';

     header("Access-Control-Allow-Origin:*");
     header("Access-Control-Allow-Headers:Content-Type"); //GET, POST, PATCH
     header("Content-Type:application/json");
 
     $input = json_decode(file_get_contents("php://input"), true);

     $buyerID = $input['buyerID'];
     $sellerID = $input['sellerID'];
     $productID = $input['productID'];
     $productName = $input['productName'];
     $productCategory=$input['productCategory'];
     $productDetails=$input['productDetails'];
     $productPrice=$input['productPrice'];
     $orderQuantity=$input['orderQuantity'];
     
     $response=[
        'BuyerID'=>$buyerID,
        'SellerID'=>$sellerID,
        'productID'=>$productID,
        'productName'=>$productName,
        'productCategory'=>$productCategory,
        'productDetails'=>$productDetails,
        'productPrice'=>$productPrice,
        'orderQuantity'=>$orderQuantity
    ];
     echo json_encode($response);


?>