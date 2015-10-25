use databaseappdev;
DROP TABLE IF EXISTS user;
CREATE TABLE user (
	uID int,
	fName varchar(50) NOT NULL,
	lName varchar(50) NOT NULL,
	email varchar(50) NOT NULL,
	city  varchar(50) NOT NULL,
	state varchar(50) NOT NULL,
	PRIMARY KEY (uID)
);
LOAD DATA LOCAL INFILE 'C:/Users/Alex/Downloads/MOCK_DATA.csv'
INTO TABLE user 
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n';

