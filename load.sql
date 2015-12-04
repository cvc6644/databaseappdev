use databaseappdev;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS cars;
CREATE TABLE user (
	uID varchar(25) NOT NULL,
	password varchar(25) NOT NULL,
	fName varchar(50) NOT NULL,
	lName varchar(50) NOT NULL,
	email varchar(50) NOT NULL,
	city  varchar(50),
	state varchar(50),
	gender char(1) NOT NULL,	
	PRIMARY KEY (uID)
);
LOAD DATA LOCAL INFILE 'C:/Users/Alex/Downloads/MOCK_DATA.csv'
INTO TABLE user 
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n';

/* CREATE TABLE car_reservation(
	date,
	time, 
	cost int,
	origin varchar(60),
	destination varchar(60),
	user_ID FOREIGN KEY REFERENCES user(uID);
); */


