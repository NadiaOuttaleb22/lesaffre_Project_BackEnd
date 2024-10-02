<?php

include "../../../../connect.php";

$categories_id = filterRequest('categories_id');
$image = filterRequest('categories_image');

deleteFile("../../../../image_home_lunch",$image);

deleteData("categories_lunch","categories_id = $categories_id");