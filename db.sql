"C:\Program Files (x86)\EasyPHP-Devserver-17\eds-binaries\dbserver\mysql5717x86x230304150727\bin\mysql.exe" -u lsa -p

CREATE DATABASE ls DEFAULT CHARSET='utf8';

CREATE USER 'lsa'@'localhost' IDENTIFIED BY 'lsa';

GRANT ALL ON ls.* TO 'lsa'@'localhost';

CREATE TABLE users (
    uid INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    f_name VARCHAR(50) NOT NULL,
    l_name VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    admin INT(1) NOT NULL DEFAULT 0,
    email VARCHAR(50) NOT NULL,
    PRIMARY KEY (uid)
) DEFAULT CHARACTER SET utf8;

CREATE TABLE contacts (
    cid INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    f_name VARCHAR(50) NOT NULL,
    l_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    status INT NOT NULL DEFAULT 0,
    last_seen DATETIME NOT NULL,
    count_seen INT NOT NULL DEFAULT 0,
    duration_seen INT NOT NULL DEFAULT 0,
    PRIMARY KEY (cid),
    FOREIGN KEY (user_id) REFERENCES users(uid)
) DEFAULT CHARACTER SET utf8;

CREATE TABLE meetings (
    mid INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    contact_id INT NOT NULL,
    location VARCHAR(50) NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    PRIMARY KEY (mid)
) DEFAULT CHARACTER SET utf8;