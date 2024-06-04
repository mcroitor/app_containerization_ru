-- create database example_cms_db;
create table if not exists config_tbl(
    variable_id int not null auto_increment,
    variable_name varchar(63) unique not null,
    variable_value varchar(63) not null,
    variable_type varchar(63) not null,
    variable_limits text,
    primary key(variable_id)
);

INSERT INTO config_tbl VALUES (null, 'default_theme', 'default', 'enum', 'default');

create table if not exists modules_tbl(
    module_id int not null auto_increment,
    module_name varchar(63) unique not null,
    module_version varchar(15) not null,
    module_enabled int,
    primary key(module_id)
);

insert into modules_tbl values (null, 'users', '20141205', 1);