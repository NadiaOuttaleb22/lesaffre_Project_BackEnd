<?php

include "../../../../connect.php";


$items_name = filterRequest('items_name');
$items_desc = filterRequest('items_desc');
$items_price = filterRequest('items_price');
$items_discount = filterRequest('items_discount');
$items_cat = filterRequest('items_cat');
$items_create  = date("Y-m-d H:i:s");




// Vérifiez si un fichier est envoyé
if (isset($_FILES['categories_image'])) {
    $items_image = imageUpload("../../../../image_home_breackfast_items",'categories_image');
    if ($items_image != "fail"  || $items_image != "faill") {
        $data = array(
            "items_name" =>  $items_name,
            "items_desc" => $items_desc,
            "items_image" => $items_image,
            "items_active" =>"1",
            "items_price" => $items_price,
            "items_discount" => $items_discount,
            "items_cat" => $items_cat,
            "items_create" => $items_create,
        );
        insertData("items_breakfast", $data, true);
    } else {
        echo json_encode(["status" => "failll", "message" => "Image upload failed"]);
    }
} else {
    echo json_encode(["status" => "fail", "message" => "No image uploaded"]);
}


