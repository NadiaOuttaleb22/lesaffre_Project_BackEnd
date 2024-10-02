<?php

include "../connect.php";

$usersid        =filterRequest("usersid");
$pricedelivery  =filterRequest("pricedelivery");
$priceorders    =filterRequest("priceorders");
$couponid       =filterRequest("couponid");
$coupondiscount =filterRequest("coupondiscount");

$totalprice=$priceorders+$pricedelivery;


//check coupon

$now          = date("Y-m-d H:i:s");
$checkcoupon  =getData("coupon","coupon_id = '$couponid' AND coupon_expirate > '$now' AND coupon_count > 0",null,false);

if ($checkcoupon>0) {
    $totalprice   =   $totalprice   -   $priceorders *   $coupondiscount / 100;
    $stmt = $con->prepare("UPDATE `coupon` SET `coupon_count` = `coupon_count`-1 WHERE coupon_id = '$couponid'");
    $stmt->execute();
}




$data=array(

    "orders_usersid"       =>$usersid,
    "orders_pricedelivery" =>$pricedelivery,
    "orders_price"         =>$priceorders,
    "orders_coupon"       =>$couponid,
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




