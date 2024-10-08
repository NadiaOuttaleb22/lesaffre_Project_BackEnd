<?php

define("MB", 1048576);



date_default_timezone_set('Africa/Casablanca');

require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Database;

function getFirebaseData($table, $where = null, $values = null)
{
    $serviceAccount = __DIR__ . '/config/lesaffre-b1bae-firebase-adminsdk-454oo-13f79cf693.json';
    $factory = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://lesaffre-b1bae-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();

    try {
        $reference = $database->getReference($table);

        // Appliquer les conditions "where" si elles existent
        if ($where && $values) {
            $query = $reference;

            // Firebase ne supporte pas les conditions complexes comme SQL,
            // donc nous devons appliquer des filtres basés sur les clés et les valeurs.
            foreach ($where as $key => $condition) {
                $value = $values[$key];
                if ($condition == '=') {
                    $query = $query->orderByChild($key)->equalTo($value);
                } else if ($condition == '>=') {
                    $query = $query->orderByChild($key)->startAt($value);
                } else if ($condition == '<=') {
                    $query = $query->orderByChild($key)->endAt($value);
                }
                // Ajoutez d'autres conditions si nécessaire
            }
            
            $snapshot = $query->getSnapshot();
        } else {
            $snapshot = $reference->getSnapshot();
        }

        $data = $snapshot->getValue();

        if (!empty($data)) {
            echo json_encode(array("status" => "succes", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
        echo json_encode(array("status" => "failure", "message" => $e->getMessage()));
    }
}




// Ajoutez cette ligne au début de votre script PHP pour voir les données reçues


// Puis continuez avec votre code
function insertData($table, $data, $json = true) {
    global $con;

    // Debugging: log the data array
    file_put_contents('php://stderr', print_r($data, TRUE));

    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "succes"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    return $count;
}




function updateData($table, $data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
    if ($count > 0) {
        echo json_encode(array("status" => "succes"));
    } else {
        echo json_encode(array("status" => "failure"));
    }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "succes"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
    
}
function deleteDataa($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE c FROM $table c WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => "succes"));
        } else {
            echo json_encode(array("status" => "failure"));
        }
    }
}


function imageUpload($dir,$imageRequest)
{
  global $msgError;
  if (isset($_FILES[$imageRequest])) {
    $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
  $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
  $imagesize  = $_FILES[$imageRequest]['size'];
  $allowExt   = array("jpg", "png", "gif", "mp3", "pdf","svg");
  $strToArray = explode(".", $imagename);
  $ext        = end($strToArray);
  $ext        = strtolower($ext);

  if (!empty($imagename) && !in_array($ext, $allowExt)) {
    $msgError = "EXT";
  }
  if ($imagesize > 2 * MB) {
    $msgError = "size";
  }
  if (empty($msgError)) {
    move_uploaded_file($imagetmp,  $dir."/" . $imagename);
    return $imagename;
  } else {
    return "faill";
  }
  }else{
    return "fail";


  }
  
}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir . "/" . $imagename)) {
        unlink($dir . "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "wael" ||  $_SERVER['PHP_AUTH_PW'] != "wael12345") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }

    // End 
}

function getUserData($con, $usersLogin) {
    $stmt = $con->prepare("SELECT * FROM users WHERE users_login = ?");
    $stmt->execute(array($usersLogin));
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    return $userData;
}

function seccesPrint($data) {
    echo json_encode(array("status" => "succes", "data" => $data));
}

function failurePrint($message) {
    echo json_encode(array("status" => "failure", "message" => $message));
}

/* 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail($to, $title, $body) {
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nadiaouttaleb3@gmail.com'; // Votre adresse e-mail
        $mail->Password   = 'pkws ltwz tqca ypoh';    // Mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // STARTTLS
        $mail->Port       = 587; // Port pour STARTTLS

        // Expéditeur et destinataire
        $mail->setFrom('support@nadiaouttaleb.com', 'Support');
        $mail->addAddress($to);

        // Contenu du message
        $mail->isHTML(false);
        $mail->Subject = $title;
        $mail->Body    = $body;

        $mail->send();
        echo "Success: Mail sent";
    } catch (Exception $e) {
        echo "Error: Mail could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
 */
function sendemail($to, $title, $body) {
    $from = "support@nadiaouttaleb.com";
    $headers = "From: $from\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    mail($to, $title, $body, $headers);
}

function insertIntoFirebase($collection, $data) {
    global $database;
    $newData = $database->getReference($collection)->push($data);
    return $newData->getKey();
}

require 'vendor/autoload.php';

function getAllLocalData($con) {
    $allData = [];
    $tables = $con->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        $stmt = $con->query("SELECT * FROM $table");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $allData[$table] = $data;
    }
    return $allData;
}
function getData($table, $where = null, $values = null,$json=true)
{
    global $con;
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if ($json==true){
        if ($count > 0){
            echo json_encode(array("status" => "succes", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }

    }else{
        return $count;


    }
    
}
function getAllData($table, $where = null, $values = null,$json= true)
{
    global $con;
    $data = array();
    if ($where == null) { // Si $where est nul, on récupère toutes les données
        $stmt = $con->prepare("SELECT * FROM $table");
        $stmt->execute();
    } else { // Sinon, on utilise $where dans la clause WHERE
        $stmt = $con->prepare("SELECT * FROM $table WHERE $where");
        $stmt->execute($values);
    }
    
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($json == true){
        if ($count > 0){
            echo json_encode(array("status" => "succes", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
            return $count;

    }else{
        if ($count > 0){
            return $data;

        }else{
            return json_encode(array("status" => "failure"));

        }

    }

}

function getAllData2($table, $where = null, $values = null,$json= true)
{
    global $con;
    $data = array();
    if ($where == null) { // Si $where est nul, on récupère toutes les données
        $stmt = $con->prepare("SELECT * FROM $table");
        $stmt->execute();
    } else { // Sinon, on utilise $where dans la clause WHERE
        $stmt = $con->prepare("SELECT * FROM $table WHERE $where");
        $stmt->execute($values);
    }
    
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($json == true){
        if ($count > 0){
            echo json_encode(array("status" => "succes", "data" => $data));
        } else {
            echo json_encode(array("status" => "failure"));
        }
            return $count;

    }else{
        if ($count > 0){
            return array("status" => "succes","data"=> $data);


        }else{
            return array("status" => "failure");

        }

    }

}


function loadToFirebase($data) {
    $serviceAccount = __DIR__ . '/config/lesaffre-b1bae-firebase-adminsdk-454oo-13f79cf693.json';
    $factory = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://lesaffre-b1bae-default-rtdb.firebaseio.com/');

    $database = $factory->createDatabase();

    try {
        foreach ($data as $table => $rows) {
            $ref = $database->getReference($table);
            $ref->set($rows);
        }
        echo json_encode(array("status" => "success"));
    } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
        echo json_encode(array("status" => "failure", "message" => $e->getMessage()));
    }
}

function migrateData($dsn, $user, $pass) {
    try {
        $con = new PDO($dsn, $user, $pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $localData = getAllLocalData($con);
        loadToFirebase($localData);
    } catch (PDOException $e) {
        //echo json_encode(array("status" => "failure", "message" => $e->getMessage()));
    }
}


function filterRequest($field) {
    return isset($_POST[$field]) ? htmlspecialchars(strip_tags($_POST[$field])) : null;
}


/* 
function sendGCM($title, $message, $topic, $pageid, $pagename)
{


    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array(
        "to" => '/topics/' . $topic,
        'priority' => 'high',
        'content_available' => true,

        'notification' => array(
            "body" =>  $message,
            "title" =>  $title,
            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            "sound" => "default"

        ),
        'data' => array(
            "pageid" => $pageid,
            "pagename" => $pagename
        )

    );


    $fields = json_encode($fields);
    $headers = array(
        'Authorization: key=' . "",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);
    return $result;
    curl_close($ch);
} */