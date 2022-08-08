<?php
function signUp($email, $password)
{
    //insert the user into the database
    global $con;
    $insert_user = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    $result = mysqli_query($con, $insert_user);
    if ($result) {
        echo json_encode([
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
