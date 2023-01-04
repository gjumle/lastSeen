"C:\Program Files (x86)\EasyPHP-DevServer-14.1VC9\binaries\mysql\bin\mysql.exe"

CREATE DATABASE last_seen DEFAULT CHARSET='latin1';

CREATE USER last_seen_admin IDENTIFIED BY 'lsa';

GRANT ALL ON last_seen.* TO  'last_seen_admin'@'localhost';

CREATE TABLE users (
    u_id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    admin INT(1) NOT NULL DEFAULT 0,
    city VARCHAR(50) NOT NULL
) DEFAULT CHARSET='latin1';

CREATE TABLE meetings (
    m_id INT NOT NULL AUTO_INCREMENT,
    user_id_a INT NOT NULL,
    user_id_b INT NOT NULL,
    place VARCHAR(50) NOT NULL,
    datetime DATETIME NOT NULL,
    duration TIME NOT NULL,
    FOREIGN KEY (user_id_a) REFERENCES users(u_id),
    FOREIGN KEY (user_id_b) REFERENCES users(u_id)
) DEFAULT CHARSET='latin1';