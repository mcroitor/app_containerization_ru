CREATE TABLE district (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

INSERT INTO district VALUES 
(1, "Anenii Noi"), (2, "Balti"), (3, "Basarabeasca"),
(4, "Briceni"), (5, "Cahul"), (6, "Calarasi"),
(7, "Cantemir"), (8, "Causeni"), (9, "Chisinau"),
(10, "Cimislia"), (11, "Criuleni"), (12, "Donduseni"),
(13, "Drochia"), (14, "Dubasari"), (15, "Edinet"),
(16, "Falesti"), (17, "Floresti"), (18, "Glodeni"),
(19, "Hincesti"), (20, "Ialoveni"), (21, "Leova"),
(22, "Nisporeni"), (23, "Ocnita"), (24, "Orhei"),
(25, "Rezina"), (26, "Riscani"), (27, "Singerei"),
(28, "Soldanesti"), (29, "Soroca"), (30, "Stefan-Voda"),
(31, "Straseni"), (32, "Taraclia"), (33, "Telenesti"),
(34, "Ungheni"), (35, "UTA Gagauzia");

CREATE TABLE locality (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    type TEXT NOT NULL,
    district_id INTEGER
);

CREATE TABLE institution (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    locality_id INTEGER,
    address TEXT,
    sime TEXT,
    language TEXT NOT NULL,
    type TEXT NOT NULL,
    isced TEXT NOT NULL
);

CREATE TABLE pisa_data (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    institution_id INTEGER,
    year INTEGER,
    nr_students INTEGER,
    nr_students_ro INTEGER,
    nr_students_ru INTEGER
);

CREATE TABLE student (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    institution_id INTEGER,
    firstname TEXT NOT NULL,
    lastname TEXT NOT NULL,
    sex TEXT NOT NULL,
    birth_day INTEGER,
    birth_month INTEGER,
    birth_year INTEGER,
    grade INTEGER,
    language TEXT NOT NULL,
    sen INTEGER
);