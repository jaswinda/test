<?php
 include 'DatabaseConfig.php';
 include 'helper_functions/authentication_functions.php';
 $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 if( isset($_POST['order_items']) &&  isset($_POST['token']) && isset($_POST['amount']) && isset($_POST['payment_token'])) //check is details sent by the user
 {
    $order_items =json_decode($_POST['order_items']);
    $access_token = $_POST['token'];
    $order_method ="khalti";
    $amount = $_POST['amount'];
    $payment_token=$_POST['payment_token'];
    

    $user_id=checkIdValidUser($access_token??null);

    if ($user_id!=null) {
        createOrder($user_id,$amount);
    } else {
        $data=[
            'success'=>false,
            'message'=>'UnAuthenticated'
        ];
        echo json_encode($data);
        
    }
 }else{
    $data=['success'=>false, 'message'=>'Unable to process the request due to incomplete details.'];
    
    echo json_encode($data);
 }

 function insertOrderItem($proid,$qty, $order_id){

    global $con;
    $insert = "INSERT INTO order_items (product_id,quantity,order_id)VALUES('$proid','$qty','$order_id')";
    mysqli_query($con, $insert);
 }
 function makeANewOrder($uid,$amount, $method,$transaction_token){

    global $con;
    $insert = "INSERT INTO orders (user_id,total_price, payment_method,payment_token)VALUES('$uid','$amount','$method','$transaction_token')";
    return mysqli_query($con, $insert);
 }

 function createOrder($uid,$amount){
    global $order_items;
    global $order_method;
    global $payment_token;
    global $con;

        $qurey=makeANewOrder($uid,$amount, "khalti", $payment_token);
        if($qurey){
            $order_id = $con->insert_id;
        
            $decodedOrderItems= $order_items;
            foreach ($decodedOrderItems as $order_item) {
                $item = json_decode($order_item, true);
                insertOrderItem($item["product_id"],$item["quantity"], $order_id);
            }
         
            $data=['success'=>true, 'message'=>'Order Succesfully Submitted.'];
            echo json_encode($data);
        }else{
            $data=['success'=>false, 'message'=>'Something went wrong.'];
            echo json_encode($data);
        }
    }

?>
      

