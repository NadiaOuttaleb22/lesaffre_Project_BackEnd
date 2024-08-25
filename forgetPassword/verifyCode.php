<?php

include "../connect.php";

// Debugging: log incoming data
file_put_contents('php://stderr', print_r($_POST, TRUE));


$userEmail = filterRequest("userEmail");
$verifyCode=filterRequest("verifyCode");

file_put_contents('php://stderr', "Email: $userEmail\n");
file_put_contents('php://stderr', "verifyCode: $verifyCode\n");

$stmt= $con->prepare("SELECT * FROM users WHERE users_email = '$userEmail' AND users_verifycode = '$verifyCode'");
$stmt->execute();
$count = $stmt->rowCount();
if($count > 0){
    seccesPrint('yes');

}else{
    failurePrint('not correct');
}




