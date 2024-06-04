CREATE TABLE users_tbl(
    user_id INT NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(63) NOT NULL UNIQUE,
    user_password VARCHAR(255) NOT NULL,
    user_email VARCHAR(127) NOT NULL,
    user_registration VARCHAR(31) NOT NULL,
    PRIMARY KEY(user_id)
);

INSERT INTO users_tbl VALUES(null, 'root', '', 'root@localhost', '0');