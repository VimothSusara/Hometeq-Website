CREATE TABLE Product(

	prodId INT(4) IDE,
	
	prodName VARCHAR(30) NOT NULL, 
	
	prodPicNameSmall VARCHAR(100) NOT NULL,
	
	prodPicNameLarge VARCHAR(100) NOT NULL,
	
	prodDescripShort VARCHAR(1000) NOT NULL,
	
	prodDescripLong VARCHAR(3000)NOT NULL,
	
	prodPrice DECIMAL(6,2) NOT NULL,
	
	prodQuantity INT(4) NOT NULL,
	
	PRIMARY KEY(prodId)
);