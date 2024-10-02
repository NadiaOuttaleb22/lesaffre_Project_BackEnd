<?php 

include "../connect.php";

$userid =filterRequest("id");


getAllData("orders","`orders_usersid`='$userid' AND orders_status=2");