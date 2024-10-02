<?php

include "../connect.php";

$usersid = filterRequest('cart_usersid');
$itemsid = filterRequest('card_itemsid');

deleteDataa("card_breackfast", "card_id IN  (
    SELECT card_id FROM (
        SELECT card_id FROM card_breackfast WHERE card_usersid = $usersid AND card_itemsid = $itemsid AND card_orders = 0 LIMIT 1 
    ) AS subquery
)");