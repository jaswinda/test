<?php
function signUp($email, $password)
{
    //insert the user into the database
    global $con;
    $encrypted_password=password_hash($password, PASSWORD_DEFAULT);
    $insert_user = "INSERT INTO users (email, password) VALUES ('$email', '$encrypted_password')";
    $result = mysqli_query($con, $insert_user);
    if ($result) {
        echo json_encode(
            [
                'success' => true,
                'message' => 'User created successfully'
            ]
        );
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'User creation failed'
            ]
        );
    }
}
function login($password, $databasePassword)
{
    //insert the user into the database
    
    if(password_verify($password, $databasePassword)){
      //login the user
      echo json_encode(
          [
              'success' => true,
              'message' => 'User logged in successfully'
          ]
      );
    }else{
       echo json_encode(
          [
              'success' => false,
              'message' => 'Password is incorrect'
          ]
      );
    }
}
