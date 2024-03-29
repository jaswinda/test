<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
// Creating MySQL Connection.

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    //check if the email is already in the database
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $check_email);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
      //check if the password is correct
      $data=mysqli_fetch_assoc($result);
      $databasePassword= $data['password'];
      $userId= $data['id'];
      $role= $data['role'];
      $data= [
        'id'=>$data['id'],
        'name'=>$data['name'],
        'email'=>$data['email'],
        'phone'=>$data['phone'],
        'role'=>$data['role'],
      ];

      try {
        login($password, $databasePassword, $userId, $role, $data);
      } catch (\Throwable $th) {
        echo json_encode([
            'success'=>false,
            'message'=>"User login failed",
            'error'=>$th->getMessage()
        
        ]);
      }
      
     
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'User Not Found'
            ]
        );
    }
} else {
    echo json_encode(
        [
            'message' => 'Please fill all the fields.',
            'success' => false
        ]
    );
}


