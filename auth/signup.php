<?php
include "../connect.php";


$username = filterRequest("username");
$usersLogin = filterRequest("usersLogin");
$userEmail = filterRequest("userEmail");
$userPassword = filterRequest("userPassword");
//$userPassword = sha1($_POST["userPassword"]); 
$userAcces = filterRequest("userAcces");
$userType = filterRequest("userType");

// Vérification si l'email existe déjà dans MySQL
$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ? Or users_login=?");
$stmt->execute(array($userEmail,$usersLogin));

$count = $stmt->rowCount();
if ($count > 0) {
    failurePrint('email or login already exists');
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
    } else {
        failurePrint('email or login already exists');
    }
}
