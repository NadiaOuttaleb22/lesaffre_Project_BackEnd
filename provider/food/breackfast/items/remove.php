<?php

include "../../../../connect.php";

$items_id = filterRequest('items_id');
$image = filterRequest('items_image');

deleteFile("../../../../image_home_breackfast_items",$image);

deleteData("items_breakfast","items_id = $items_id");