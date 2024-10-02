<?php

include "../../../../connect.php";

$id=filterRequest("id");

getAllData("items_lunch","items_cat = $id");