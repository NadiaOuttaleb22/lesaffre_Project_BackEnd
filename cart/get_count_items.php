<?php

include "../connect.php";
$usersid = filterRequest('cart_usersid');
$itemsid = filterRequest('card_itemsid');

$stmt =$con->prepare("SELECT COUNT(card.card_id) as countitems FROM `card` WHERE card_usersid=$usersid and card_itemsid =$itemsid AND card_orders = 0");
$stmt->execute();

$count = $stmt->rowCount();

$data =$stmt->fetchColumn();


if ($count > 0){
    echo json_encode(array("status" => "succes", "data" => $data));
} else {
    echo json_encode(array("status" => "succes", "data" => 0));
}