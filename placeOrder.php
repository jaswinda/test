<?php
include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
    $tokenCheck=checkIdValidUser($_POST['token']??null);
    if(isset($_POST['token']) && $tokenCheck != null){
        //get order items from the request
        $order_items=json_decode($_POST['order_items']);
        $total= $_POST['total'];


        $myOrder=[];
        //for each order item, get the product details and add it to the order
        foreach($order_items as $order_item){
            $item = json_decode($order_item);
            $product=[];
            $product['quantity']=$item -> quantity;
            $product['name']=$item->description;
            $myOrder[]=$product;
        }
        
        $data=[
            'success' => false,
            'message' => 'Error placing order',
            'order_items' => $myOrder,
            'total' => $total
        ];
        echo json_encode($data);
    }else{
        echo json_encode(
            [
                'success' => false,
                'message' =>'Access denied'
            ]
        );
    }
?>





