<?php

include "../connect.php";

$categories_id = filterRequest("id");



$users_id = filterRequest("iduser");

$stmt =$con->prepare("
SELECT itemslunch1view.*, 1 as favorite 
FROM itemslunch1view
INNER JOIN favorite 
ON favorite.favorite_itemsid = itemslunch1view.items_id 
AND favorite.favorite_usersid = :users_id
WHERE categories_id = :categories_id

UNION ALL 

SELECT *, 0 as favorite 
FROM itemslunch1view
WHERE categories_id = :categories_id 
AND items_id NOT IN (
    SELECT itemslunch1view.items_id 
    FROM itemslunch1view
    INNER JOIN favorite 
    ON favorite.favorite_itemsid = itemslunch1view.items_id 
    AND favorite.favorite_usersid = :users_id
)");

$stmt->bindParam(':categories_id', $categories_id);
$stmt->bindParam(':users_id', $users_id);
$stmt->execute();



$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

if ($count > 0){
    echo json_encode(array("status" => "succes", "data" => $data));
} else {
    echo json_encode(array("status" => "failure"));
}

