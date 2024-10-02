<?php

include "../../../../connect.php";


$categories_name = filterRequest('categories_name');

    $categories_image = imageUpload("../../../../image_home_lunch",'categories_image');
    if ($categories_image != "fail") {
        $data = array(
            "categories_name" =>  $categories_name,
            "categories_image" =>  $categories_image,
        );
        insertData("categories_lunch", $data, true);
    } else {
        echo json_encode(["status" => "fail", "message" => "Image upload failed"]);
    }




/* 
include "../../../../connect.php";

$categories_name = filterRequest('categories_name');

    $categories_image = imageUpload("../../../../image_home_lunch",'categories_image');
    
        $data = array(
            "categories_name" =>  $categories_name,
            "categories_image" =>  $categories_image,
        );
        insertData("categories_lunch", $data, true);
    

 */



