
<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;

$serviceAccount = __DIR__ . '/config/lesaffre-b1bae-firebase-adminsdk-454oo-13f79cf693.json';
$factory = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://lesaffre-b1bae-default-rtdb.firebaseio.com/');


$auth = $factory->createAuth();
$database = $factory->createDatabase();

$dsn = "mysql:host=localhost;dbname=lesafre";
$user = "root";
$pass = "";
$option = array(
   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
);
$countrowinpage = 9;
try {
   $con = new PDO($dsn, $user, $pass, $option);
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Access-Control-Allow-Origin");
   header("Access-Control-Allow-Methods: POST, OPTIONS , GET");
   include "functions.php";
   if (!isset($notAuth)) {
      // checkAuthenticate();
   }
} catch (PDOException $e) {
   echo $e->getMessage();
}
