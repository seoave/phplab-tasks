SELECT DISTINCT price FROM products
WHERE price > 1000 AND price < 1200

SELECT name, price,width,height FROM products
ORDER BY width DESC

SELECT name, price,width,height FROM products
ORDER BY width DESC
LIMIT 3

SELECT products.name, products.price,products.width, products.height, colors.color AS color
FROM products
JOIN colors ON products.color_id = colors.id
ORDER BY color ASC

SELECT products.name, products.price,products.width, products.height, colors.color AS color
FROM products
JOIN colors ON products.color_id = colors.id
HAVING height = 500
ORDER BY price ASC

SELECT AVG(price)
FROM products

SELECT SUM(price)
FROM products

SELECT name,price
FROM products
GROUP BY price

SELECT name FROM products
UNION
SELECT color FROM colors
ORDER BY NAME ASC