<?php


include "../connect.php";

$usersid = filterRequest('cart_usersid');
$itemsid = filterRequest('card_itemsid');
$dicount= filterRequest('dicount');



$count=getData('card',"card_itemsid = $itemsid AND card_usersid =$usersid AND card_orders = 0",null,false);

    $data=array(
        "card_usersid" =>  $usersid,
        "card_itemsid" =>  $itemsid,
        "dicount"=> $dicount
    );
    insertData("card",$data,true);
