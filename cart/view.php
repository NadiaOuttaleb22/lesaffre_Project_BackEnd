<?php

include "../connect.php";

$usersid = filterRequest('cart_usersid');

$data=getAllData2("cartview","card_usersid = $usersid",null ,false);



$stmt = $con->prepare("SELECT SUM(cartview.itemsprice) as totalprice , SUM(cartview.countitems) as totalcount FROM `cartview` 
WHERE cartview.card_usersid=$usersid
GROUP BY cartview.card_usersid");

$stmt->execute();


$countprice=$stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode(array(
    "status" => "succes",
     "data" => $data,
     "countprice"=> $countprice,
     
    ));


