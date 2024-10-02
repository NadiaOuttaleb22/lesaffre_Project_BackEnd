<?php

include "../../../connect.php";


$data=array(
    "orders_pass"=> 1
);

updateData("orders",$data,"orders_status =2");
