<?php

include "../connect.php";

$favoritid = filterRequest('id');


deleteData("favorite","favorite_id= $favoritid");