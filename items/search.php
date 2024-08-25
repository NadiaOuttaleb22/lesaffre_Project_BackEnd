<?php

include "../connect.php";
$search=filterRequest('search');

getAllData('itemslunch1view',"items_name like '%$search%'") ;