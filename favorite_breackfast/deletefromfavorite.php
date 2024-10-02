<?php

include "../connect.php";

$favoritid = filterRequest('id');


deleteData("favorite_breakfast","favorite_id= $favoritid");