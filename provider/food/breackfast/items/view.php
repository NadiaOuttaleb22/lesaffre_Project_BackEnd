<?php

include "../../../../connect.php";

$id=filterRequest("id");

getAllData("items_breakfast","items_cat = $id");