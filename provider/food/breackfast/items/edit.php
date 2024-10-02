<?php

include "../../../../connect.php";

$items_id = filterRequest("items_id");
$imageold = filterRequest("imageold");

$items_name = filterRequest('items_name');
$items_desc = filterRequest('items_desc');
$items_active = filterRequest('items_active');
$items_price = filterRequest('items_price');
$items_discount = filterRequest('items_discount');
$items_cat = filterRequest('items_cat');
$items_create  = date("Y-m-d H:i:s");


$res = imageUpload("../../../../image_home_breackfast_items",'categories_image');
if ($res == "fail") {
    $data = array(
        "items_name" =>  $items_name,
        "items_desc" => $items_desc,
        "items_active" => $items_active,
        "items_price" => $items_price,
        "items_discount" => $items_discount,
        "items_cat" => $items_cat,
        "items_create" => $items_create,
    );
}else{
    deleteFile("../../../../image_home_breackfast_items",$imageold);
    $data = array(
        "items_name" =>  $items_name,
        "items_desc" => $items_desc,
        "items_image" => $res,
        "items_active" => $items_active,
        "items_price" => $items_price,
        "items_discount" => $items_discount,
        "items_cat" => $items_cat,
        "items_create" => $items_create,
    );
}

updateData("items_breakfast", $data, "items_id = '$items_id'");





