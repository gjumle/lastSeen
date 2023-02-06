"C:\Program Files (x86)\EasyPHP-DevServer-14.1VC9\binaries\mysql\bin\mysql.exe" -u lsa -p

CREATE DATABASE ls DEFAULT CHARSET='utf8';

CREATE USER 'lsa'@'localhost' IDENTIFIED BY 'lsa';

GRANT ALL ON ls.* TO 'lsa'@'localhost';

CREATE TABLE users (
    uid INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    admin INT(1) NOT NULL DEFAULT 0,
    city VARCHAR(50) NOT NULL
) DEFAULT CHARACTER SET utf8;

+----------+-------------+------+-----+---------+----------------+
| Field    | Type        | Null | Key | Default | Extra          |
+----------+-------------+------+-----+---------+----------------+
| u_id     | int(11)     | NO   | PRI | NULL    | auto_increment |
| username | varchar(50) | NO   |     | NULL    |                |
| password | varchar(50) | NO   |     | NULL    |                |
| email    | varchar(50) | NO   |     | NULL    |                |
| admin    | int(1)      | NO   |     | 0       |                |
| city     | varchar(50) | NO   |     | NULL    |                |
+----------+-------------+------+-----+---------+----------------+
