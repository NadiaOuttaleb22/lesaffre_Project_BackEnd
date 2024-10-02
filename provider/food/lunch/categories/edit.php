<?php

include "../../../../connect.php";

$categories_name = filterRequest('categories_name');
$categories_id = filterRequest("categories_id");
$imageold = filterRequest("imageold");


$res = imageUpload("../../../../image_home_lunch",'categories_image');
if ($res == "fail") {
    $data=array("categories_name"=>$categories_name);
}else{
    deleteFile("../../../../image_home_lunch",$imageold);
    $data = array(
        "categories_name" =>  $categories_name,
        "categories_image" =>  $res,
    );   
}

updateData("categories_lunch", $data, "categories_id = '$categories_id'");





