<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
//get categories from the database
 $hospitals = "SELECT * FROM hospitals";
    $result = mysqli_query($con, $hospitals);
    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode(
            [
                'success' => true,
                'data' => $data,
                'message' => "Hospitals fetched successfully"
            ]
        );
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'Error fetching hospitals'
            ]
        );
    }