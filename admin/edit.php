<?php

include "../connect.php";

$users_id = filterRequest('users_id');
$users_name = filterRequest('users_name');
$users_login = filterRequest('users_login');
$users_email = filterRequest('users_email');
$users_acces = filterRequest('users_acces');
$users_type = filterRequest("users_type");

// Vérification si l'email ou le login existe déjà pour un autre utilisateur
$stmt = $con->prepare("SELECT * FROM users WHERE users_id != ? AND (users_email = ? OR users_login = ?)");
$stmt->execute(array($users_id, $users_email, $users_login));

$count = $stmt->rowCount();
if ($count > 0) {
    // Échec si un autre utilisateur a déjà cet email ou login
    failurePrint('Email or login already exists');
} else {
    // Prépare la requête de mise à jour
    $stmt_update = $con->prepare("UPDATE users SET 
        users_name = ?, 
        users_login = ?, 
        users_email = ?, 
        users_acces = ?, 
        users_type = ? 
        WHERE users_id = ?");
    
    $update_success = $stmt_update->execute(array(
        $users_name,
        $users_login,
        $users_email,
        $users_acces,
        $users_type,
        $users_id
    ));

    if ($update_success) {
        seccesPrint('User updated successfully');
    } else {
        failurePrint('Failed to update user');
    }
}
