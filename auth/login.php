<?php
include "../connect.php";

// Debugging: log incoming data
file_put_contents('php://stderr', print_r($_POST, TRUE));

$usersLogin = filterRequest("usersLogin");
$userPassword = filterRequest("userPassword");

// Debugging: log variables
file_put_contents('php://stderr', "Login: $usersLogin\n");
file_put_contents('php://stderr', "Password: $userPassword\n");

// Vérification si l'utilisateur existe déjà dans MySQL
$stmt = $con->prepare("SELECT * FROM users WHERE users_login = ? AND users_password = ?");
$stmt->execute(array($usersLogin, $userPassword));

$count = $stmt->rowCount();
if ($count > 0) {
    seccesPrint('yes');
} else {
    failurePrint('not found');
}

