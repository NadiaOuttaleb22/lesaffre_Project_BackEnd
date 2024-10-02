<?php

include "../connect.php";

$id=filterRequest("id");

getAllData("ordersdetailsview","card_orders =$id");