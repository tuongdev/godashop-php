CREATE VIEW view_product AS 
SELECT product.*,
ROUND(
	IF(discount_percentage IS NULL || 
	discount_from_date > CURRENT_DATE || 
	discount_to_date < CURRENT_DATE , 
	
	price, 
	-- giá giảm
	price * (1-discount_percentage/100)
	), -3) AS sale_price 
FROM product;