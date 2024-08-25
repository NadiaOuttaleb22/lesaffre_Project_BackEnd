<?php

include "../connect.php";

$favorite_usersid = filterRequest('favorite_usersid');
$favorite_itemsid = filterRequest('favorite_itemsid');


$data=array(
    "favorite_usersid" =>  $favorite_usersid,
    "favorite_itemsid" =>  $favorite_itemsid,
);

insertData("favorite",$data,true);

