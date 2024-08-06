<?php
/* include "connect.php";
sendemail("nadiamajdi665@gmail.com", "Hi", "Here is your code");
 */


include "connect.php";

// Exemple d'appel de la fonction
// Format du tableau $where: ['champ' => 'condition']
// Format du tableau $values: ['champ' => 'valeur']

/* 
$table = 'your/firebase/path';
$where = ['name' => '=', 'age' => '>='];
$values = ['name' => 'John', 'age' => 25]; */

//getFirebaseData('users', '1=1');




$dsn = "mysql:host=localhost;dbname=lesafre";
$user = "root";
$pass = "";

//migrateData($dsn, $user, $pass);
getFirebaseData('users', '1=1');