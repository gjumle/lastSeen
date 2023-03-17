"C:\Program Files (x86)\EasyPHP-Devserver-17\eds-binaries\dbserver\mysql5717x86x230317185938\bin\mysql.exe" -u lsa -p

CREATE DATABASE ls DEFAULT CHARSET='utf8';

CREATE USER 'lsa'@'localhost' IDENTIFIED BY 'lsa';

GRANT ALL ON ls.* TO 'lsa'@'localhost';

CREATE TABLE users (
    uid INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
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
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    location VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    PRIMARY KEY (mid),
    FOREIGN KEY (user_id) REFERENCES users(uid),
    FOREIGN KEY (contact_id) REFERENCES contacts(cid)
) DEFAULT CHARACTER SET utf8;

DELIMITER $$
CREATE TRIGGER t_contact_duration_insert
AFTER INSERT ON meetings
FOR EACH ROW
BEGIN
    DECLARE total_duration INT;
    DECLARE last_meeting datetime;
    SELECT SUM(TIMESTAMPDIFF(MINUTE,start_time,end_time)) INTO total_duration FROM meetings WHERE contact_id = NEW.contact_id;
    SELECT MAX(end_time) INTO last_meeting FROM meetings WHERE contact_id = NEW.contact_id;
    UPDATE contacts SET duration_seen = total_duration, last_seen = last_meeting WHERE cid = NEW.contact_id;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER t_contact_duration_update
AFTER UPDATE ON meetings
FOR EACH ROW
BEGIN
    DECLARE total_duration INT;
    DECLARE last_meeting datetime;
    SELECT SUM(TIMESTAMPDIFF(MINUTE,start_time,end_time)) INTO total_duration FROM meetings WHERE contact_id = NEW.contact_id;
    SELECT MAX(end_time) INTO last_meeting FROM meetings WHERE contact_id = NEW.contact_id;
    UPDATE contacts SET duration_seen = total_duration, last_seen = last_meeting WHERE cid = NEW.contact_id;
END $$
DELIMITER ;


