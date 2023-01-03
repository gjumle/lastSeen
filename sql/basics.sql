"C:\Program Files (x86)\EasyPHP-DevServer-14.1VC9\binaries\mysql\bin\mysql.exe" -u lastSeenAdmin -p

CREATE DATABASE IF NOT EXISTS lastSeen;

CREATE USER IF NOT EXISTS 'lastSeenAdmin'@'localhost' IDENTIFIED BY 'lsa';

GRANT ALL ON lastSeen.* TO 'lastSeenAdmin'@'localhost';

USE lastSeen;

SHOW TABLES;

CREATE TABLE IF NOT EXISTS users (
    u_id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    join_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_seen DATETIME NOT NULL
) DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS meetings (
    m_id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    date_of_event DATE NOT NULL,
    place VARCHAR(50) NOT NULL,
    duration TIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(u_id)
) DEFAULT CHARSET=latin1;