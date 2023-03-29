INSERT INTO users (username, f_name, l_name, password, admin, email)
VALUES
('johnsmith', 'John', 'Smith', 'password123', 1, 'johnsmith@example.com'),
('janedoe', 'Jane', 'Doe', 'securepassword', 0, 'janedoe@example.com'),
('mikewilliams', 'Mike', 'Williams', 'password456', 0, 'mikewilliams@example.com');

INSERT INTO contacts (user_id, f_name, l_name, email, status, last_seen, count_seen, duration_seen)
VALUES
(1, 'Bob', 'Johnson', 'bob.johnson@example.com', 1, '2023-03-28 09:30:00', 1, 60),
(1, 'Sarah', 'Lee', 'sarah.lee@example.com', 0, '2023-03-25 14:45:00', 3, 180),
(2, 'Tom', 'Davis', 'tom.davis@example.com', 1, '2023-03-29 11:15:00', 2, 120);

INSERT INTO meetings (user_id, contact_id, start_time, end_time, location, description)
VALUES 
(1, 1, '2023-04-01 10:00:00', '2023-04-01 11:00:00', 'Office', 'Discuss project'),
(1, 2, '2023-04-02 14:00:00', '2023-04-02 15:00:00', 'Zoom', 'Check-in meeting'),
(2, 3, '2023-04-03 09:30:00', '2023-04-03 10:30:00', 'Coffee shop', 'Networking');