"C:\Program Files (x86)\EasyPHP-DevServer-14.1VC9\binaries\mysql\bin\mysql.exe" -u lastSeenAdmin -p

CREATE DATABASE IF NOT EXISTS lastSeen;

CREATE USER IF NOT EXISTS 'lastSeenAdmin'@'localhost' IDENTIFIED BY 'lsa';

GRANT ALL ON lastSeen.* TO 'lastSeenAdmin'@'localhost';

USE lastSeen;

SHOW TABLES;

CREATE TABLE IF NOT EXISTS users (
  u_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  lastSeen varchar(255) NOT NULL
) DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS contacts (
  c_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  phone varchar(255) NOT NULL,
  f_name varchar(255) NOT NULL,
  s_name varchar(255) NOT NULL
) DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS meetings (
  m_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id int(11) NOT NULL, FOREIGN KEY (user_id) REFERENCES users(u_id),
  contact_id int(11) NOT NULL, FOREIGN KEY (contact_id) REFERENCES contacts(c_id),
  date date NOT NULL,
  time time NOT NULL,
  location varchar(255) NOT NULL,
  lastSeen timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) DEFAULT CHARSET=latin1;

mysql> describe users;
+----------+--------------+------+-----+---------+----------------+
| Field    | Type         | Null | Key | Default | Extra          |
+----------+--------------+------+-----+---------+----------------+
| u_id     | int(11)      | NO   | PRI | NULL    | auto_increment |
| username | varchar(255) | NO   |     | NULL    |                |
| password | varchar(255) | NO   |     | NULL    |                |
| lastSeen | varchar(255) | NO   |     | NULL    |                |
+----------+--------------+------+-----+---------+----------------+
4 rows in set (0.01 sec)

mysql> describe contacts;
+----------+--------------+------+-----+---------+----------------+
| Field    | Type         | Null | Key | Default | Extra          |
+----------+--------------+------+-----+---------+----------------+
| c_id     | int(11)      | NO   | PRI | NULL    | auto_increment |
| username | varchar(255) | NO   |     | NULL    |                |
| name     | varchar(255) | NO   |     | NULL    |                |
| email    | varchar(255) | NO   |     | NULL    |                |
| phone    | varchar(255) | NO   |     | NULL    |                |
| f_name   | varchar(255) | NO   |     | NULL    |                |
| s_name   | varchar(255) | NO   |     | NULL    |                |
+----------+--------------+------+-----+---------+----------------+
7 rows in set (0.01 sec)

mysql> describe meetings;
+------------+--------------+------+-----+-------------------+-----------------------------+
| Field      | Type         | Null | Key | Default           | Extra                       |
+------------+--------------+------+-----+-------------------+-----------------------------+
| m_id       | int(11)      | NO   | PRI | NULL              | auto_increment              |
| user_id    | int(11)      | NO   | MUL | NULL              |                             |
| contact_id | int(11)      | NO   | MUL | NULL              |                             |
| date       | date         | NO   |     | NULL              |                             |
| time       | time         | NO   |     | NULL              |                             |
| location   | varchar(255) | NO   |     | NULL              |                             |
| lastSeen   | timestamp    | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
+------------+--------------+------+-----+-------------------+-----------------------------+
7 rows in set (0.01 sec)
