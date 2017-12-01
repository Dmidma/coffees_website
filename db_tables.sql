-- Change the sql mode for handling times
-- from NO_ZERO_DATE or NO_ZERO_IN_DATE to ''
SET sql_mode = '';

-- Disable FOREIGN KEY CHECK
SET FOREIGN_KEY_CHECKS = 0;

/*
-- 
-- Table structure for table `email_domains`
--
*/
DROP TABLE IF EXISTS email_domains;

CREATE TABLE email_domains (
    id INT(11) NOT NULL AUTO_INCREMENT,
    domain_name VARCHAR(50) NOT NULL,
    domain_tld VARCHAR(6) NOT NULL,
    UNIQUE (domain_name, domain_tld),
    PRIMARY KEY (id)
);
/*
-- @domain_name: email domain name [gmail, hotmail, ...]
-- @domain_tld: top level domain [com, fr, org, ...]
*/

--
-- Dumping data for table `email_domains`
--

LOCK TABLES email_domains WRITE;

INSERT INTO email_domains (domain_name, domain_tld) VALUES ('gmail', 'com');
INSERT INTO email_domains (domain_name, domain_tld) VALUES ('hotmail', 'com');
INSERT INTO email_domains (domain_name, domain_tld) VALUES ('hotmail', 'fr');

UNLOCK TABLES;

--
-- End of dumping into table `email_domains`
--



--
-- Table structure for table `email`
--

-- Development Only!
DROP TABLE IF EXISTS email;

CREATE TABLE email (
    id INT(11) NOT NULL AUTO_INCREMENT,
    local_part VARCHAR(64) NOT NULL,
    domain_id INT(20) NOT NULL,
    UNIQUE (domain_id, local_part),
    PRIMARY KEY (id),
    FOREIGN KEY (domain_id) REFERENCES email_domains(id)
);

--
-- Dumping data for tale `email`
--

/*LOCK TABLES email WRITE;*/

INSERT INTO email (local_part, domain_id) VALUES (
    'd.oussema.d',
    (SELECT id FROM email_domains WHERE domain_name='gmail' AND domain_tld='com'));

/*
-- You can also use this method to insert with a select query
INSERT INTO email VALUES (local_part, domain_id)
    SELECT id, 'd.oussema.d' FROM email_domains WHERE domain_name='gmail' AND domain_tld='com';
*/

UNLOCK TABLES;

--
-- End of dumping into table `email`
--

--
-- Table structure for table `user_registery`
--

-- authority column is used to check if it is an admin or a regular user
DROP TABLE IF EXISTS user_registery;

CREATE TABLE user_registery (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    last_name varchar(100) NOT NULL,
    birthday date,
    username varchar(100) NOT NULL,
    password varchar(64) NOT NULL,
    melh varchar(20) NOT NULL,
    email INT(11) NOT NULL,
    sub_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    verified TINYINT(1) NOT NULL DEFAULT 0,
    authority TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    UNIQUE (username),
    FOREIGN KEY (email) REFERENCES email(id)
);


-- image table schema

DROP TABLE IF EXISTS image;

CREATE TABLE image (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name varchar(100) NOT NULL, 
	width INT(11) NOT NULL,
	type varchar(50) NOT NULL DEFAULT "normal",
	PRIMARY KEY (id)
);


-- coffee_shop table schema

DROP TABLE IF EXISTS coffee_shop;

CREATE TABLE coffee_shop (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name varchar(50) NOT NULL,
	description varchar(200) NOT NULL,
	latitude FLOAT(9, 6) NOT NULL,
	longitude FLOAT(9, 6) NOT NULL,
	image_path varchar(100) NOT NULL,
	street_address varchar(100) DEFAULT "N/A",
	phone varchar(12) DEFAULT "N/A",
	PRIMARY KEY (id)
);

-- Dumping Values in coffee_shop

LOCK TABLES coffee_shop WRITE;

INSERT INTO coffee_shop 
(name, description, image_path, latitude, longitude, street_address, phone) 
VALUES 
("Factory Lounge", "Factory is nice coffee shop located in Sousse. You can go there with friends, family or colleagues. Big space, nice decorations and quick service.", "/factory/factory.jpg", 35.834077, 10.591116, "Yasser Arafat, Sahloul", "+21673000000");

UNLOCK TABLES;


-- coffee_images table schema

DROP TABLE IF EXISTS coffee_images;

CREATE TABLE coffee_images (
	id INT(11) NOT NULL AUTO_INCREMENT,
	coffee INT(11) NOT NULL,
	image INT(11) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (coffee) REFERENCES coffee_shop (id),
	FOREIGN KEY (image) REFERENCES image (id)
);


--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS comments;

CREATE TABLE comments (
    id int(11) NOT NULL AUTO_INCREMENT,
    commenter int(11) NOT NULL,
    comment varchar(500) NOT NULL,
    comment_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY (commenter) REFERENCES user_registery(id)
);

--
-- Table structure for `coffee_shop_comments`
--

DROP TABLE IF EXISTS coffee_shop_comments;

CREATE TABLE coffee_shop_comments (
    coffee_shop INT(11) NOT NULL,
    comment int(11) NOT NULL,
    FOREIGN KEY (coffee_shop) REFERENCES coffee_shop(id),
    FOREIGN KEY (comment) REFERENCES comments(id),
    PRIMARY KEY(coffee_shop, comment)
);