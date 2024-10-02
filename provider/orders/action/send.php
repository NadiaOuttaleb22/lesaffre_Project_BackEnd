<?php

include "../../../connect.php";


$data=array(
    "orders_status"=> 1
);

updateData("orders",$data,"orders_status =0");
