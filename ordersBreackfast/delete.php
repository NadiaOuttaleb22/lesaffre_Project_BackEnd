<?php

include "../connect.php";

$ordersid=filterRequest("ordersid");

deleteData("orders_breackfast","orders_id=$ordersid AND orders_status = 0");