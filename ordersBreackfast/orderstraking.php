<?php 

include "../connect.php";

$userid =filterRequest("id");


getAllData("orders_breackfast","`orders_usersid`='$userid' and  orders_status != 2");