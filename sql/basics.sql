"C:\Program Files (x86)\EasyPHP-DevServer-14.1VC9\binaries\mysql\bin\mysql.exe" -u lastSeenAdmin -p

CREATE DATABASE IF NOT EXISTS lastSeen;

CREATE USER IF NOT EXISTS 'lastSeenAdmin'@'localhost' IDENTIFIED BY 'lsa';

GRANT ALL ON lastSeen.* TO 'lastSeenAdmin'@'localhost';

USE lastSeen;

SHOW TABLES;

CREATE TABLE IF NOT EXISTS 'users' (
  'u_id' int(11) NOT NULL AUTO_INCREMENT,
  'username' varchar(255) NOT NULL,
  'password' varchar(255) NOT NULL,
  'email' varchar(255) NOT NULL,
  'contact_id' int(11) NOT NULL, FOREIGN KEY (contact_id) REFERENCES contacts(c_id),
  'lastSeen' timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS 'contacts' (
  'c_id' int(11) NOT NULL AUTO_INCREMENT,
  'username' varchar(255) NOT NULL,
  'name' varchar(255) NOT NULL,
  'email' varchar(255) NOT NULL,
  'phone' varchar(255) NOT NULL,
  'f_name' varchar(255) NOT NULL,
  's_name' varchar(255) NOT NULL,
  'lastSeen' timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS 'meet' (
  'm_id' int(11) NOT NULL AUTO_INCREMENT,
  'u_id' int(11) NOT NULL, FOREIGN KEY (u_id) REFERENCES users(u_id),
  'c_id' int(11) NOT NULL, FOREIGN KEY (c_id) REFERENCES contacts(c_id),
  'date' date NOT NULL,
  'time' time NOT NULL,
  'location' varchar(255) NOT NULL,
  'lastSeen' timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=latin1;