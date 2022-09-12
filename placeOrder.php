<?php
include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
$tokenCheck = checkIdValidUser($_POST['token'] ?? null);
if (isset($_POST['token']) && $tokenCheck != null) {
    //get order items from the request
    $order_items = json_decode($_POST['order_items']);
    $total = $_POST['total'];

    //insert into orders table
    $sql = "INSERT INTO orders (user_id, total_price) VALUES ('" . $tokenCheck . "', '" . $total . "')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        //get the row id
        $order_id = mysqli_insert_id($con);
        
        foreach ($order_items as $order_item) {
            $item = json_decode($order_item);
            $quantity = $item->quantity;
            $product_id= $item->product_id;
            $sql = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('" . $order_id . "', '" . $product_id . "', '" . $quantity . "')";
            $result = mysqli_query($con, $sql);
        }
        echo json_encode(
            [
                'success' => true,
                'message' => 'Order placed successfully',
                'order_id' => $order_id
            ]
        );
    } else {
        $data = [
            'success' => false,
            'message' => 'Error placing order',
        ];
        echo json_encode($data);
    }
} else {
    echo json_encode(
        [
            'success' => false,
            'message' => 'Access denied'
        ]
    );
}
