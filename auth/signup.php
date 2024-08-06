<?php
include "../connect.php";

// Debugging: log incoming data
file_put_contents('php://stderr', print_r($_POST, TRUE));

$username = filterRequest("username");
$usersLogin = filterRequest("usersLogin");
$userEmail = filterRequest("userEmail");
$userPassword = filterRequest("userPassword");
$userAcces = filterRequest("userAcces");
$userType = filterRequest("userType");

// Debugging: log variables
file_put_contents('php://stderr', "Username: $username\n");
file_put_contents('php://stderr', "Login: $usersLogin\n");
file_put_contents('php://stderr', "Email: $userEmail\n");
file_put_contents('php://stderr', "Password: $userPassword\n");
file_put_contents('php://stderr', "Acces: $userAcces\n");
file_put_contents('php://stderr', "Type: $userType\n");

// Vérification si l'email existe déjà dans MySQL
$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ?");
$stmt->execute(array($userEmail));

$count = $stmt->rowCount();
if ($count > 0) {
    failurePrint();
} else {
    $data = array(
        "users_name" => $username,
        "users_login" => $usersLogin,
        "users_email" => $userEmail,
        "users_password" => $userPassword,
        "users_acces" => $userAcces,
        "users_type" => $userType,
    );
    $insertedRows = insertData("users", $data);
   
    if ($insertedRows > 0) {
        sendemail($userEmail,'here is your code and login',"code : $userPassword"."\n"."login : $usersLogin");
        //echo json_encode(array("status" => "success"));
    } else {
        failurePrint();
    }
}
