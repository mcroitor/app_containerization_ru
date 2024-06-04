/* 
 * The MIT License
 *
 * Copyright 2019 Croitor Mihail <mcroitor@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
/**
 * Author:  Croitor Mihail <mcroitor@gmail.com>
 * Created: 31-Oct-2019
 */

create table if not exists config(
    id INTEGER primary key AUTOINCREMENT,
    name text unique not null,
    value text not null,
    type text not null default 'string'
);

/*
 * accepted variable types: integer, float, string
 */

INSERT INTO config (name, value, type) VALUES ('default_theme', 'default', 'string');

create table if not exists module(
    id INTEGER primary key AUTOINCREMENT,
    name text unique not null,
    description text,
    version text not null
);

CREATE TABLE menu_links (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    link TEXT NOT NULL DEFAULT '#',
    level INTEGER  NOT NULL DEFAULT '0',
    weight INTEGER NOT NULL DEFAULT '10'
);

INSERT INTO menu_links (name, link, level, weight) VALUES ('home', './', 0, 1);

-- if module menu is installed
INSERT INTO menu_links (name, link, level, weight) VALUES ('log out', './?q=user/logout', 1, 1000);
INSERT INTO menu_links (name, link, level, weight) VALUES ('manage properties', './?q=properties/manage', 100, 10);
INSERT INTO menu_links (name, link, level, weight) VALUES ('manage modules', './?q=modules/manage', 100, 11);

-- INSERT INTO module (name, version) VALUES('modules', '20180929');