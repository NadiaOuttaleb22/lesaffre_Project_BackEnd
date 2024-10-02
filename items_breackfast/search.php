<?php

include "../connect.php";
$search=filterRequest('search');

getAllData('itemslunch1viewbreakfast',"items_name like '%$search%'") ;