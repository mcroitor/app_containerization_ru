CREATE TABLE endgame_authors_tbl (
    author_id INT NOT NULL AUTO_INCREMENT,
    author_firstname VARCHAR(63) NOT NULL,
    author_lastname VARCHAR(63) NOT NULL,
    author_birthdate INT,
    author_deathdate INT,
    author_country VARCHAR(63),
    PRIMARY KEY(author_id)
);

CREATE TABLE endgame_positions_tbl (
    position_id INT NOT NULL AUTO_INCREMENT,
    position_fen VARCHAR(127) NOT NULL DEFAULT '8/8/8/8/8/8/8/8 w - - 0 1',
    position_pub_date INT,
    position_stipulation CHAR(1),
    position_source VARCHAR(127),
    PRIMARY KEY(position_id)
);

CREATE TABLE endgame_authority_tbl (
    authority_id INT NOT NULL AUTO_INCREMENT,
    position_id INT NOT NULL,
    author_id INT NOT NULL,
    PRIMARY KEY(authority_id)
);

CREATE TABLE endgame_comments_tbl (
    comment_id INT NOT NULL AUTO_INCREMENT,
    position_id INT NOT NULL,
    comment TEXT NOT NULL,
    PRIMARY KEY(comment_id)
);