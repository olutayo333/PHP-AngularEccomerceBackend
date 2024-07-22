<?php
    require "connection.php";

    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:Content-Type"); //GET, POST, PATCH
    header("Content-Type:application/json");
    
    $input = json_decode(file_get_contents("php://input"), true);
    
    $productName=$input['productName'];
    $productPrice=$input['productPrice'];
    $productDescription=$input['productDescription'];
    $productImage= $input['productImage'];
    $productCategory= $input['productCategory'];
    // $sellerID= $input['sellerID'];
    $productQuantity=$input['productQuantity'];
    $productID=$input['productID'];

    //echo json_encode($productDescription);
    
    $query = " UPDATE `product_tb` SET `product_price` = '$productPrice', `product_name`='$productName', `product_category`='$productCategory',
    `product_quantity`='$productQuantity', `product_image`='$productImage',  `product_description`='$productDescription' WHERE `product_id` = $productID ";

    // $query = "UPDATE product_tb SET product_name=$productName, product_price=$productPrice, 
    //             product_description=$productDescription, product_image=$productImage, product_category=$productCategory,
    //             product_quantity=$productCategory WHERE product_id = $productID ";

    $dbcon= $connect->query($query);

    if($dbcon){
        $response=[
                    'msg'=> "Product Updated Successfully",
                    'status'=> true,
                    'success'=>$dbcon,
                ];
                echo json_encode($response);
    }
    else{
            $response=[
                'msg'=> "Product Update Failed",
                'status'=> false,
                'success'=>$dbcon,
            ];
            echo json_encode($response);
    }



?>