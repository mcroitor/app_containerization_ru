CREATE DATABASE IF NOT EXISTS hack_db;

USE hack_db;

CREATE TABLE news (
	news_id INT NOT NULL AUTO_INCREMENT,
	news_title VARCHAR(255) NOT NULL,
	news_body TEXT NOT NULL,
	PRIMARY KEY(news_id)
);

INSERT INTO news VALUES 
(NULL, 'first message', 'this is a first message'),
(NULL, 'anounce', '<h2>try to hack me</h2>');

CREATE TABLE users (
	user_id INT NOT NULL AUTO_INCREMENT,
	user_name VARCHAR(255) NOT NULL,
	user_password VARCHAR(255) NOT NULL,
	PRIMARY KEY(user_id)
);

INSERT INTO users VALUES
(NULL, 'root', 'Pa$$w0rd'),
(NULL, 'lamer', '123qwe');