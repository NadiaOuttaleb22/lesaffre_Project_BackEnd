CREATE or REPLACE VIEW itemslunch1view as
SELECT items_lunch.* , categories_lunch.* FROM items_lunch
INNER JOIN categories_lunch ON categories_lunch.categories_id = items_lunch.items_cat
//

SELECT itemslunch1view.*, 1 as favorite FROM itemslunch1view
INNER JOIN favorite on favorite.favorite_itemsid=itemslunch1view.items_id AND favorite.favorite_usersid=24
UNION ALL 
SELECT *,0 as favorite FROM itemslunch1view
WHERE items_id != (SELECT itemslunch1view.items_id FROM itemslunch1view
INNER JOIN favorite on favorite.favorite_itemsid=itemslunch1view.items_id AND favorite.favorite_usersid=24)
//

CREATE or REPLACE VIEW myfavorite as
SELECT favorite.*,items_lunch.*,users.users_id FROM favorite
INNER JOIN users on users.users_id =favorite.favorite_usersid 
INNER JOIN items_lunch on items_lunch.items_id = favorite.favorite_itemsid;

//

,(items_price - (items_price * items_discount / 100)) as itemspricediscount

CREATE or REPLACE VIEW cartview as
SELECT SUM(items_lunch.items_price - items_lunch.items_price * items_lunch.items_discount / 100) as itemsprice, count(cart.card_itemsid) as countitems , cart.* , items_lunch.* FROM cart 
INNER JOIN items_lunch ON items_lunch.items_id = cart.card_itemsid 
GROUP BY cart.card_itemsid,cart.card_usersid



/* CREATE or REPLACE VIEW cartview AS
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
WHERE card_orders =0 
GROUP BY cart.card_itemsid, cart.card_usersid; */


CREATE OR REPLACE VIEW cartview AS
SELECT 
    SUM(
        IF(card.dicount = 1, 
           items_lunch.items_price - items_lunch.items_price * items_lunch.items_discount / 100, 
           items_lunch.items_price
        )
    ) AS itemsprice,
    COUNT(card.card_itemsid) AS countitems,
    card.card_itemsid, 
    card.card_usersid,
    card.card_orders,
    items_lunch.items_id,
    items_lunch.items_name, 
    items_lunch.items_price,
    items_lunch.items_discount,
    items_lunch.items_image
FROM card
INNER JOIN items_lunch ON items_lunch.items_id = card.card_itemsid
WHERE card_orders =0 
GROUP BY 
    card.card_itemsid, 
    card.card_usersid,
    card.card_orders,
    items_lunch.items_id,
    items_lunch.items_name, 
    items_lunch.items_price,
    items_lunch.items_discount,
    items_lunch.items_image;

//


CREATE OR REPLACE VIEW ordersdetailsview AS
SELECT 
    SUM(
        IF(card.dicount = 1, 
           items_lunch.items_price - items_lunch.items_price * items_lunch.items_discount / 100, 
           items_lunch.items_price
        )
    ) AS itemsprice,
    COUNT(card.card_itemsid) AS countitems,
    card.card_itemsid, 
    card.card_usersid,
    card.card_orders,

    items_lunch.items_id,
    items_lunch.items_name, 
    items_lunch.items_price,
    items_lunch.items_discount,
    items_lunch.items_image
FROM card
INNER JOIN items_lunch ON items_lunch.items_id = card.card_itemsid
WHERE card_orders !=0 
GROUP BY 
    card.card_itemsid, 
    card.card_usersid, 
    card.card_orders,

    items_lunch.items_id,
    items_lunch.items_name, 
    items_lunch.items_price,
    items_lunch.items_discount,
    items_lunch.items_image;



    
CREATE OR REPLACE VIEW ordersdetailsview AS
SELECT 
    SUM(
        IF(card.dicount = 1, 
           items_lunch.items_price - items_lunch.items_price * items_lunch.items_discount/100, 
           items_lunch.items_price
        )
    ) AS itemsprice,
    COUNT(card.card_itemsid) AS countitems,
    card.card_itemsid, 
    card.card_usersid,
    card.card_orders,

    items_lunch.items_id,
    items_lunch.items_name, 
    items_lunch.items_price,
    items_lunch.items_discount,
    items_lunch.items_image,

    users.users_name 
FROM card
INNER JOIN items_lunch ON items_lunch.items_id = card.card_itemsid
INNER JOIN users ON users.users_id = card.card_usersid  -- Jointure avec la table users

WHERE card_orders != 0 
GROUP BY 
    card.card_itemsid, 
    card.card_usersid, 
    card.card_orders,

    items_lunch.items_id,
    items_lunch.items_name, 
    items_lunch.items_price,
    items_lunch.items_discount,
    items_lunch.items_image,
    users.users_name  

//


CREATE OR REPLACE VIEW items_in_pending_orders AS
SELECT 
    items_lunch.items_id,
    items_lunch.items_name,
    IF(
        card.dicount = 1, 
        items_lunch.items_price - items_lunch.items_price * items_lunch.items_discount / 100, 
        items_lunch.items_price
    ) AS items_price_calculated,
    items_lunch.items_discount,
    items_lunch.items_image,
    orders.orders_id,
    orders.orders_status
FROM 
    items_lunch
INNER JOIN 
    card ON items_lunch.items_id = card.card_itemsid
INNER JOIN 
    orders ON orders.orders_id = card.card_orders
WHERE 
    orders.orders_status = 0;


//

CREATE OR REPLACE VIEW items_summary_in_pending_orders AS
SELECT
    items_lunch.items_name,
    COUNT(items_lunch.items_id) AS total_orders, 
    SUM(
        IF(
            card.dicount = 1, 
            items_lunch.items_price - items_lunch.items_price * items_lunch.items_discount / 100, 
            items_lunch.items_price
        )
    ) AS total_price
FROM 
    items_lunch
INNER JOIN 
    card ON items_lunch.items_id = card.card_itemsid
INNER JOIN 
    orders ON orders.orders_id = card.card_orders
WHERE 
    orders.orders_status = 0
GROUP BY 
    items_lunch.items_name;





CREATE OR REPLACE VIEW user_orders_summary AS
SELECT 
    users.users_id,
    users.users_name,
    SUM(
        IF(
            card.dicount = 1, 
            items_lunch.items_price - items_lunch.items_price * items_lunch.items_discount / 100, 
            items_lunch.items_price
        )
    ) AS total_price,
    COUNT(DISTINCT orders.orders_id) AS total_orders
FROM 
    items_lunch
INNER JOIN 
    card ON items_lunch.items_id = card.card_itemsid
INNER JOIN 
    orders ON orders.orders_id = card.card_orders
INNER JOIN 
    users ON users.users_id = card.card_usersid
WHERE 
    orders.orders_status = 2
    AND orders.orders_pass = 0
GROUP BY 
    users.users_id,
    users.users_name;



//breackfast 
CREATE OR REPLACE VIEW ordersdetailsviewbreakfast AS
SELECT 
    SUM(
        IF(card_breackfast.dicount = 1, 
           items_breakfast.items_price - items_breakfast.items_price * items_breakfast.items_discount/100, 
           items_breakfast.items_price
        )
    ) AS itemsprice,
    COUNT(card_breackfast.card_itemsid) AS countitems,
    card_breackfast.card_itemsid, 
    card_breackfast.card_usersid,
    card_breackfast.card_orders,

    items_breakfast.items_id,
    items_breakfast.items_name, 
    items_breakfast.items_price,
    items_breakfast.items_discount,
    items_breakfast.items_image,

    users.users_name 
FROM card_breackfast
INNER JOIN items_breakfast ON items_breakfast.items_id = card_breackfast.card_itemsid
INNER JOIN users ON users.users_id = card_breackfast.card_usersid  -- Jointure avec la table users

WHERE card_orders != 0 
GROUP BY 
    card_breackfast.card_itemsid, 
    card_breackfast.card_usersid, 
    card_breackfast.card_orders,

    items_breakfast.items_id,
    items_breakfast.items_name, 
    items_breakfast.items_price,
    items_breakfast.items_discount,
    items_breakfast.items_image,
    users.users_name  



CREATE OR REPLACE VIEW user_orders_summary_breakfast AS SELECT users.users_id, users.users_name, SUM( IF( card_breackfast.dicount = 1, items_breakfast.items_price - items_breakfast.items_price * items_breakfast.items_discount / 100, items_breakfast.items_price ) ) AS total_price, COUNT(DISTINCT orders_breackfast.orders_id) AS total_orders FROM items_breakfast INNER JOIN card_breackfast ON items_breakfast.items_id = card_breackfast.card_itemsid INNER JOIN orders_breackfast ON orders_breackfast.orders_id = card_breackfast.card_orders INNER JOIN users ON users.users_id = card_breackfast.card_usersid WHERE orders_breackfast.orders_status = 2 AND orders_breackfast.orders_pass = 0 GROUP BY users.users_id, users.users_name;


CREATE OR REPLACE VIEW items_summary_in_pending_orders_breackfast AS SELECT items_breakfast.items_name, COUNT(items_breakfast.items_id) AS total_orders, SUM( IF( card_breackfast.dicount = 1, items_breakfast.items_price - items_breakfast.items_price * items_breakfast.items_discount / 100, items_breakfast.items_price ) ) AS total_price FROM items_breakfast INNER JOIN card_breackfast ON items_breakfast.items_id = card_breackfast.card_itemsid INNER JOIN orders_breackfast ON orders_breackfast.orders_id = card_breackfast.card_orders WHERE orders_breackfast.orders_status = 0 GROUP BY items_breakfast.items_name;