<?php
include "../connect.php";

file_put_contents('php://stderr', print_r($_POST, TRUE));

$userLogin = filterRequest("userLogin");
$userPassword = filterRequest("userPassword");


// Debugging: log variables
file_put_contents('php://stderr', "Email: $userLogin\n");
file_put_contents('php://stderr', "Password: $userPassword\n");

$data=array("users_password"=>$userPassword);
updateData("users", $data, "users_login = '$userLogin'",false);

$stmt= $con->prepare("SELECT * FROM users WHERE users_login = '$userLogin'");
$stmt->execute();
$count = $stmt->rowCount();
if ($count > 0) {
    $userData = getUserData($con, $userLogin);
    seccesPrint($userData);
} else {
    failurePrint('not found');
}