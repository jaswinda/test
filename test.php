
<?php

$name  = isset($_POST['name']) ? $_POST['name'] : 'Raju';
$surname = $_POST['surname'];
$full_name = $name . " " . $surname;


$data = [
    'full_name' => $full_name,
];
echo json_encode($data);


?>
    