<?php
include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
    $tokenCheck=checkIdValidUser($_POST['token']??null);
    if(isset($_POST['token']) && $tokenCheck != null){
         $payment_token=$_POST['payment_token'];
         $order_id=$_POST['order_id'];
            $sql = "UPDATE orders SET payment_token = '$payment_token', is_paid = '1', payment_method='khalti' WHERE id = '$order_id'"; 
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo json_encode(
                    [
                        'success' => true,
                        'message' => "Order updated successfully"
                    ]
                );
            } else {
                echo json_encode(
                    [
                        'success' => false,
                        'message' => 'Error updating order'
                    ]
                );
            }
    }else{
        echo json_encode(
            [
                'success' => false,
                'message' =>'Access denied'
            ]
        );
    }
