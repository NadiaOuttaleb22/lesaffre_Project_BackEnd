<?php
include "../connect.php";

file_put_contents('php://stderr', print_r($_POST, TRUE));

$userEmail = filterRequest("userEmail");
$userPassword = filterRequest("userPassword");


// Debugging: log variables
file_put_contents('php://stderr', "Email: $userEmail\n");
file_put_contents('php://stderr', "Password: $userPassword\n");

$data=array("users_password"=>$userPassword);
updateData("users", $data, "users_email = '$userEmail'");

