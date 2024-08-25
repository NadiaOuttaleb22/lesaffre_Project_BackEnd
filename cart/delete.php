<?php

include "../connect.php";

$usersid = filterRequest('cart_usersid');
$itemsid = filterRequest('card_itemsid');


deleteData("card","card_id = (SELECT card_id FROM card WHERE `card_usersid` = $usersid AND `card_itemsid` = $itemsid LIMIT 1)");