<?php

include "../connect.php";

$users_id = filterRequest('users_id');

deleteData("users","users_id = $users_id");