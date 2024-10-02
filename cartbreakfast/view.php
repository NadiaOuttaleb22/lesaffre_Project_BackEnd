<?php

include "../connect.php";

$usersid = filterRequest('cart_usersid');

$data=getAllData2("cartviewbreakfast","card_usersid = $usersid",null ,false);



$stmt = $con->prepare("SELECT SUM(cartviewbreakfast.itemsprice) as totalprice , SUM(cartviewbreakfast.countitems) as totalcount FROM `cartviewbreakfast` 
WHERE cartviewbreakfast.card_usersid=$usersid
GROUP BY cartviewbreakfast.card_usersid");

$stmt->execute();


$countprice=$stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode(array(
    "status" => "succes",
     "data" => $data,
     "countprice"=> $countprice,
     
    ));


