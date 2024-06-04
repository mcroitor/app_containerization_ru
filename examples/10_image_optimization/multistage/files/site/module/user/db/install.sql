CREATE TABLE user(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    firstname TEXT NOT NULL,
    lastname TEXT NOT NULL DEFAULT 'Doe',
    email TEXT NOT NULL,
    registration INTEGER NOT NULL
);

CREATE TABLE role(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT UNIQUE NOT NULL,
    description TEXT DEFAULT NULL
);

CREATE TABLE capability(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT UNIQUE NOT NULL,
    descritption TEXT DEFAULT NULL
);

CREATE TABLE role_capability(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    role_id INTEGER NOT NULL,
    capability_id INTEGER NOT NULL
);

CREATE TABLE user_role(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER UNIQUE NOT NULL,
    role_id INTEGER NOT NULL
);

-- login: admin, password: password
INSERT INTO user (login, password, firstname, lastname, email, registration)
VALUES('guest', '', 'Guest', 'Guest', 'guest@localhost', '0'),
    ('admin', 'paseG/9DiG.QM', 'Admin', 'Super', 'admin@localhost', '0');

INSERT INTO role (name) VALUES ('guest'), ('user'), ('administrator');

INSERT INTO capability (name) VALUES ('user_authenticated');

INSERT INTO role_capability (role_id, capability_id) VALUES (2, 1), (3, 1);

INSERT INTO user_role (user_id, role_id)
VALUES (2, 3);
