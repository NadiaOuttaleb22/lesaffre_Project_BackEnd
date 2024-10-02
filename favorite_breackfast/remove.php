<?php

include "../connect.php";

$favoriteusersid = filterRequest('favoriteusersid');
$favoriteitemsid = filterRequest('favoriteitemsid');

deleteData("favorite_breakfast","favorite_usersid= $favoriteusersid AND favorite_itemsid= $favoriteitemsid");
/* 
<?php

include "../connect.php";

$favorite_usersid = filterRequest('favorite_usersid');
$favorite_itemsid = filterRequest('favorite_itemsid');

// Ajoutez ceci pour vérifier les valeurs reçues
error_log("favorite_usersid: " . $favorite_usersid);
error_log("favorite_itemsid: " . $favorite_itemsid);

if ($favorite_usersid && $favorite_itemsid) {
    deleteData(
        "favorite",
        "favorite_usersid = :favorite_usersid AND favorite_itemsid = :favorite_itemsid",
        [
            ':favorite_usersid' => $favorite_usersid,
            ':favorite_itemsid' => $favorite_itemsid
        ]
    );
} else {
    echo json_encode(array("status" => "failure", "message" => "Invalid user or item ID"));
}


 */