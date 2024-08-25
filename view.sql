CREATE or REPLACE VIEW itemslunch1view as
SELECT items_lunch.* , categories_lunch.* FROM items_lunch
INNER JOIN categories_lunch ON categories_lunch.categories_id = items_lunch.items_cat


SELECT itemslunch1view.*, 1 as favorite FROM itemslunch1view
INNER JOIN favorite on favorite.favorite_itemsid=itemslunch1view.items_id AND favorite.favorite_usersid=24
UNION ALL 
SELECT *,0 as favorite FROM itemslunch1view
WHERE items_id != (SELECT itemslunch1view.items_id FROM itemslunch1view
INNER JOIN favorite on favorite.favorite_itemsid=itemslunch1view.items_id AND favorite.favorite_usersid=24)


CREATE or REPLACE VIEW myfavorite as
SELECT favorite.*,items_lunch.*,users.users_id FROM favorite
INNER JOIN users on users.users_id =favorite.favorite_usersid 
INNER JOIN items_lunch on items_lunch.items_id = favorite.favorite_itemsid;



,(items_price - (items_price * items_discount / 100)) as itemspricediscount

CREATE or REPLACE VIEW cartview as
SELECT SUM(items_lunch.items_price - items_lunch.items_price * items_lunch.items_discount / 100) as itemsprice, count(cart.card_itemsid) as countitems , cart.* , items_lunch.* FROM cart 
INNER JOIN items_lunch ON items_lunch.items_id = cart.card_itemsid 
GROUP BY cart.card_itemsid,cart.card_usersid



CREATE or REPLACE VIEW cartview AS
SELECT 
    SUM(
        IF(cart.dicount = 1, 
            items_lunch.items_price - items_lunch.items_price * items_lunch.items_discount / 100, 
            items_lunch.items_price
        )
    ) AS itemsprice, 
    COUNT(cart.card_itemsid) AS countitems, 
    cart.*, 
    items_lunch.* 
FROM cart 
INNER JOIN items_lunch 
    ON items_lunch.items_id = cart.card_itemsid 
GROUP BY cart.card_itemsid, cart.card_usersid;
