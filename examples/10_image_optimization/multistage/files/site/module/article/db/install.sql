CREATE TABLE article(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title text NOT NULL,
    body text NOT NULL,
    created text NOT NULL
);

INSERT INTO article (title, body, created) VALUES ('Welcome!', 'Very first article.', CURRENT_TIMESTAMP);
