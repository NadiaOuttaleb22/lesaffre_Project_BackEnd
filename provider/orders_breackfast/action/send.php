<?php

include "../../../connect.php";


$data=array(
    "orders_status"=> 1
);

updateData("orders_breackfast",$data,"orders_status =0");
