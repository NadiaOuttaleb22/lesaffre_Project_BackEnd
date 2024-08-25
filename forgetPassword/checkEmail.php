<?php
include "../connect.php";

// Debugging: log incoming data
file_put_contents('php://stderr', print_r($_POST, TRUE));

$userEmail = filterRequest("userEmail");
$verifyCode= rand(10000 , 99999);

// Debugging: log variables
file_put_contents('php://stderr', "Email: $userEmail\n");


// Vérification si l'utilisateur existe déjà dans MySQL
$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ?");
$stmt->execute(array($userEmail));

$count = $stmt->rowCount();
if ($count > 0) {
    seccesPrint('yes');
    $data=array("users_verifycode"=>$verifyCode);
    updateData("users", $data,"users_email = '$userEmail'",false);
    sendemail($userEmail,'here is your Verify code ',"Verify code : $verifyCode");
} else {
    failurePrint('not found');
}

