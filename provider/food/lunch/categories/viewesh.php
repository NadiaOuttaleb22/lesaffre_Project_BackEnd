<?php

include "../../../../connect.php";

$categories_id = filterRequest("categories_id");


getAllData("categories_lunch","categories_id=$categories_id");