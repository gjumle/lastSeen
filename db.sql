C:\Users\Leoš Gjumija>"C:\Program Files (x86)\EasyPHP-DevServer-14.1VC9\binaries\mysql\bin\mysql.exe" -u lsa -p

CREATE DATABASE ls DEFAULT CHARSET='utf8';

CREATE USER 'lsa'@'localhost' IDENTIFIED BY 'lsa';

GRANT ALL ON ls.* TO 'lsa'@'localhost';

 // TABLES

CREATE TABLE users (
  uid INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  city VARCHAR(100),
  admin TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE activities (
  aid INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  category VARCHAR(100)
);

CREATE TABLE schedules (
  sid INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  uid INT(11) NOT NULL,
  aid INT(11) NOT NULL,
  start_time DATETIME NOT NULL,
  end_time DATETIME NOT NULL,
  FOREIGN KEY (uid) REFERENCES users(uid),
  FOREIGN KEY (aid) REFERENCES activities(aid)
);

// STATS

CREATE VIEW user_activity_stats AS
SELECT 
  users.user_id, 
  users.username, 
  COUNT(activity_log.activity_id) AS total_activities, 
  SUM(activity_log.duration) AS total_duration
FROM 
  users 
  LEFT JOIN activity_log ON users.user_id = activity_log.user_id
GROUP BY 
  users.user_id, 
  users.username;

CREATE TRIGGER update_user_activity_stats 
AFTER INSERT OR UPDATE OR DELETE ON activity_log 
FOR EACH ROW 
BEGIN 
  REFRESH MATERIALIZED VIEW user_activity_stats; 
END;

// LOGING

CREATE TABLE logs (
  lid INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  timestamp DATETIME NOT NULL,
  type VARCHAR(100) NOT NULL,
  table_name VARCHAR(100) NOT NULL,
  details TEXT
);

DELIMITER $$

CREATE TRIGGER logs_insert_users
AFTER INSERT ON users
FOR EACH ROW
BEGIN
  INSERT INTO logs (timestamp, type, table_name, details)
  VALUES (NOW(), 'insert', 'users',
    CONCAT('uid: ', NEW.uid, ', username: ', NEW.username, ', email: ', NEW.email, ', city: ', NEW.city, ', admin: ', NEW.admin));
END$$

CREATE TRIGGER logs_update_users
AFTER UPDATE ON users
FOR EACH ROW
BEGIN
  INSERT INTO logs (timestamp, type, table_name, details)
  VALUES (NOW(), 'update', 'users',
    CONCAT('uid: ', NEW.uid, ', username: ', NEW.username, ', email: ', NEW.email, ', city: ', NEW.city, ', admin: ', NEW.admin));
END$$

CREATE TRIGGER logs_delete_users
AFTER DELETE ON users
FOR EACH ROW
BEGIN
  INSERT INTO logs (timestamp, type, table_name, details)
  VALUES (NOW(), 'delete', 'users',
    CONCAT('uid: ', OLD.uid, ', username: ', OLD.username, ', email: ', OLD.email, ', city: ', OLD.city, ', admin: ', OLD.admin));
END$$

CREATE TRIGGER logs_insert_activities
AFTER INSERT ON activities
FOR EACH ROW
BEGIN
  INSERT INTO logs (timestamp, type, table_name, details)
  VALUES (NOW(), 'insert', 'activities',
    CONCAT('aid: ', NEW.aid, ', name: ', NEW.name, ', description: ', NEW.description, ', category: ', NEW.category));
END$$

CREATE TRIGGER logs_update_activities
AFTER UPDATE ON activities
FOR EACH ROW
BEGIN
  INSERT INTO logs (timestamp, type, table_name, details)
  VALUES (NOW(), 'update', 'activities',
    CONCAT('aid: ', NEW.aid, ', name: ', NEW.name, ', description: ', NEW.description, ', category: ', NEW.category));
END$$

CREATE TRIGGER logs_delete_activities
AFTER DELETE ON activities

