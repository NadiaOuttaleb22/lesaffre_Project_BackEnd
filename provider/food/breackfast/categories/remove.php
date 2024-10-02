<?php

include "../../../../connect.php";

$categories_id = filterRequest('categories_id');
$image = filterRequest('categories_image');

deleteFile("../../../../image_home_breackfast",$image);

deleteData("categories_breakfast","categories_id = $categories_id");