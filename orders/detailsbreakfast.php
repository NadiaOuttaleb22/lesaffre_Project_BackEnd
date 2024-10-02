<?php

include "../connect.php";

$id=filterRequest("id");

getAllData("ordersdetailsviewbreakfast","card_orders =$id");