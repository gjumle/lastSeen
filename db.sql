"C:\Program Files (x86)\EasyPHP-Devserver-17\eds-binaries\dbserver\mysql5717x86x230223082020\bin\mysql.exe" -u lsa -p

CREATE DATABASE ls DEFAULT CHARSET='utf8';

CREATE USER 'lsa'@'localhost' IDENTIFIED BY 'lsa';

CREATE USER 'lsa'@'127.0.0.1' IDENTIFIED BY 'lsa';

GRANT ALL ON ls.* TO 'lsa'@'localhost';

GRANT ALL ON ls.* TO 'lsa'@'127.0.0.1';

CREATE TABLE users (
    uid INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    admin INT(1) NOT NULL DEFAULT 0,
    email VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL
) DEFAULT CHARACTER SET utf8;

CREATE TABLE meetings (
    mid INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    date DATETIME NOT NULL,
    location VARCHAR(50) NOT NULL,
    uid INT NOT NULL,
    FOREIGN KEY (uid) REFERENCES users(uid)
) DEFAULT CHARACTER SET utf8;

CREATE TABLE contacts (
    cid INT NOT NULL AUTO_INCREMENT,
    f_name VARCHAR(50) NOT NULL,
    l_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL
)