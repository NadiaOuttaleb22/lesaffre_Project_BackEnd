<?php

include "../../../connect.php";

$ordersid=filterRequest('ordersid');

$data=array(
    "orders_status"=> 2
);

updateData("orders_breackfast",$data,"orders_id = $ordersid AND orders_status =1");
