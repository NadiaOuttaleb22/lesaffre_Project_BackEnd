<?php

include "../connect.php";

$categories_id = filterRequest("id");
$users_id = filterRequest("iduser");

$stmt = $con->prepare("
SELECT DISTINCT itemslunch1viewbreakfast.*, 1 as favorite
FROM itemslunch1viewbreakfast
INNER JOIN favorite_breakfast
ON favorite_breakfast.favorite_itemsid = itemslunch1viewbreakfast.items_id 
AND favorite_breakfast.favorite_usersid = :users_id
WHERE categories_id = :categories_id

UNION ALL 

SELECT DISTINCT itemslunch1viewbreakfast.*, 0 as favorite
FROM itemslunch1viewbreakfast
WHERE categories_id = :categories_id 
AND items_id NOT IN (
    SELECT favorite_breakfast.favorite_itemsid 
    FROM favorite_breakfast 
    WHERE favorite_breakfast.favorite_usersid = :users_id
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

