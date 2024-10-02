<?php

include "../../../../connect.php";

$categories_id = filterRequest("categories_id");


getAllData("categories_breakfast","categories_id=$categories_id");