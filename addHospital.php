<?php
 include 'DatabaseConfig.php';
    // Creating MySQL Connection.
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    if (
        isset($_POST['name']) &&
        isset($_POST['address']) &&
        isset($_POST['city']) &&
        isset($_FILES['image'])) {
       
        //getimage
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $image_path = "images/".$image;

        $name=$_POST['name'];
        $address=$_POST['address'];
        $city=$_POST['city'];

        //upload image
        if ($image_size < 5000000) {
            if ($image_ext == "jpg" || $image_ext == "png" || $image_ext == "jpeg") {
                if (move_uploaded_file($image_tmp, $image_path)) {
                    //inserting data into database
                    $sql = "INSERT INTO hospitals (name, address, city, image) VALUES ('$name', '$address', '$city', '$image_path')";
                    $query = mysqli_query($con, $sql);
                    if ($query) {
                        $data=['success'=>true, 'message'=>'Hospital added successfully.'];
                        echo json_encode($data);
                    } else {
                        $data=['success'=>false, 'message'=>'Something went wrong while adding category. Please try again.'];
                        echo json_encode($data);
                    }
                } else {
                    $data=['success'=>false, 'message'=>'Failed to upload image.', 
                            'error'=> $con->error];
                    echo json_encode($data);
                }
            } else {
                $data=['success'=>false, 
                'message'=>'Image must be jpg, png or jpeg.',

            ];
                echo json_encode($data);
            }
        } else {
            $data=['success'=>false, 'message'=>'Image size must be less than 5MB.'];
            echo json_encode($data);
        }

    }else{
        $data=['success'=>false, 'message'=>'Some fields are missing.'];
        echo json_encode($data);
    }
 ?>