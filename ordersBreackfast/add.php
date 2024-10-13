<?php

include "../connect.php";

$usersid        =filterRequest("usersid");
$pricedelivery  =filterRequest("pricedelivery");
$priceorders    =filterRequest("priceorders");

$totalprice=$priceorders+$pricedelivery;





$data=array(

    "orders_usersid"       =>$usersid,
    "orders_pricedelivery" =>$pricedelivery,
    "orders_price"         =>$priceorders,
    "orders_totalprice"   =>$totalprice,

);


$count=insertData("orders_breackfast",$data,false);

if ($count > 0) {
    $stmt =$con ->prepare("SELECT MAX(orders_id) FROM `orders_breackfast`");
    $stmt ->execute();
    $maxid=$stmt->fetchColumn();

    $data=array(

        "card_orders" => $maxid
    );


    updateData("card_breackfast",$data,"card_usersid = '$usersid' AND card_orders = 0");
}




