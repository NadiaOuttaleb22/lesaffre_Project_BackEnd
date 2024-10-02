<?php

include "../../../connect.php";


$data=array(
    "orders_status"=> 2
);

updateData("orders",$data,"orders_status =1");
