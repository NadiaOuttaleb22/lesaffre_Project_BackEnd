<?php

include "connect.php";
$alldata=array();
$alldata ["status"] = 'succes';

//$setting=getAllData("setting", "1=1" , null , false);

//$alldata ["setting"]= $setting;

$categories_breakfast=getAllData("categories_breakfast", null , null , false);
$alldata ["categories_breakfast"]= $categories_breakfast;

$items_breakfast=getAllData("itemslunch1viewbreakfast", "items_discount != 0" , null , false);

$alldata ["items_breakfast"]= $items_breakfast;




echo json_encode($alldata);

