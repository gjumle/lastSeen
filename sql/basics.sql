C:\Users\Leoš Gjumija>"C:\Program Files (x86)\EasyPHP-DevServer-14.1VC9\binaries\mysql\bin\mysql.exe" -u lastSeenAdmin -p

CREATE DATABASE IF NOT EXISTS lastSeen;

CREATE USER IF NOT EXISTS 'lastSeenAdmin'@'localhost' IDENTIFIED BY 'lsa';

GRANT ALL ON lastSeen.* TO 'lastSeenAdmin'@'localhost';

USE lastSeen;

CREATE TABLE IF NOT EXISTS 'users' (
  'id' int(11) NOT NULL AUTO_INCREMENT,
  'username' varchar(255) NOT NULL,
  'password' varchar(255) NOT NULL,
  'email' varchar(255) NOT NULL,
  'lastSeen' timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=latin1;