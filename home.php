<?php

include "connect.php";
$alldata=array();
$alldata ["status"] = 'succes';

$setting=getAllData("setting", "1=1" , null , false);

$alldata ["setting"]= $setting;

$categories_lunch=getAllData("categories_lunch", null , null , false);
$alldata ["categories_lunch"]= $categories_lunch;

$items_lunch=getAllData("itemslunch1view", "items_discount != 0" , null , false);

$alldata ["items_lunch"]= $items_lunch;




echo json_encode($alldata);

