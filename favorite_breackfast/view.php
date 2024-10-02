<?php

include "../connect.php";
$id=filterRequest("id");

getAllData("myfavoritebreakfast ","favorite_usersid = ? ",array($id));