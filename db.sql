CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(50) UNIQUE,
    password_hashed VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    subject_id INT,
    grade FLOAT,
    coef FLOAT
);

CREATE TABLE IF NOT EXISTS enrollements (
    user_id INT,
    subject_id INT
);