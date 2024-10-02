<?php

include "../../../../connect.php";

$items_id = filterRequest('items_id');
$image = filterRequest('items_image');

deleteFile("../../../../image_home_lunch_items",$image);

deleteData("items_lunch","items_id = $items_id");