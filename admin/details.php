<?php

include "../connect.php";

$id=filterRequest("id");

getAllData("users","users_id = $id");