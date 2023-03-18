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
CREATE TRIGGER t_meeting_insert
AFTER INSERT ON meetings
FOR EACH ROW
BEGIN
  DECLARE total_duration TIME;
  DECLARE total_minutes INT;
  DECLARE last_time_seen DATETIME;
  DECLARE total_count_seen INT;

  SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time)))) INTO total_duration
  FROM meetings
  WHERE contact_id = NEW.contact_id;

  SELECT TIMESTAMPDIFF(MINUTE, '2000-01-01', total_duration) INTO total_minutes;

  SELECT MAX(end_time) INTO last_time_seen
  FROM meetings
  WHERE contact_id = NEW.contact_id;

  SELECT COUNT(*) INTO total_count_seen
  FROM meetings
  WHERE contact_id = NEW.contact_id;

  UPDATE contacts
  SET duration_seen = total_minutes,
      last_seen = last_time_seen,
      count_seen = total_count_seen
  WHERE cid = NEW.contact_id;
END;

DELIMITER $$

CREATE TRIGGER insert_meeting_trigger
AFTER INSERT ON meetings
FOR EACH ROW
BEGIN
    UPDATE contacts
    SET count_seen = count_seen + 1,
        last_seen = NEW.end_time,
        duration_seen = TIMESTAMPDIFF(MINUTE, start_time, end_time) + duration_seen
    WHERE cid = NEW.contact_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER update_meeting_trigger
AFTER UPDATE ON meetings
FOR EACH ROW
BEGIN
    UPDATE contacts
    SET duration_seen = duration_seen - TIMESTAMPDIFF(MINUTE, old.start_time, old.end_time) + TIMESTAMPDIFF(MINUTE, new.start_time, new.end_time)
    WHERE cid = NEW.contact_id;
    
    IF NOT (OLD.contact_id <=> NEW.contact_id) THEN
        UPDATE contacts
        SET count_seen = count_seen + 1,
            last_seen = NEW.end_time
        WHERE cid = NEW.contact_id;
        
        UPDATE contacts
        SET count_seen = count_seen - 1
        WHERE cid = OLD.contact_id;
    ELSEIF NOT (OLD.end_time <=> NEW.end_time) THEN
        UPDATE contacts
        SET last_seen = NEW.end_time
        WHERE cid = NEW.contact_id;
    END IF;
END$$
DELIMITER ;

CREATE TRIGGER delete_meeting_trigger
AFTER DELETE ON meetings
FOR EACH ROW
BEGIN
  UPDATE contacts SET duration_seen = (
    SELECT COALESCE(SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time))) / 60, 0) AS duration
    FROM meetings
    WHERE contact_id = OLD.contact_id
  ) WHERE cid = OLD.contact_id;
  
  UPDATE contacts SET count_seen = (
    SELECT COUNT(*) AS count
    FROM meetings
    WHERE contact_id = OLD.contact_id
  ) WHERE cid = OLD.contact_id;
  
  UPDATE contacts SET last_seen = (
    SELECT MAX(end_time) AS last_time
    FROM meetings
    WHERE contact_id = OLD.contact_id
  ) WHERE cid = OLD.contact_id;

  UPDATE contacts SET duration_seen = 0 WHERE duration_seen < 0;
  UPDATE contacts SET count_seen = 0 WHERE count_seen < 0;
END$$

DELIMITER ;

