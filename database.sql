CREATE DATABASE students_api
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;


use student_api;


CREATE TABLE students (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE,
	course VARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- pass is admin123

INSERT INTO students(name, email, course, password)
VALUES 
('AHMAD' , 'ahmad1@gmail.com','php','$2y$12$T7C/MbTV9o348vJqs2PAW.P1LBnsgBLHyvPJQOx71hXXegQy2FJCO'),
('AHMAD' , 'ahmad2@gmail.com','C#','$2y$12$T7C/MbTV9o348vJqs2PAW.P1LBnsgBLHyvPJQOx71hXXegQy2FJCO'),
('AHMAD' , 'ahmad3@gmail.com','C++','$2y$12$T7C/MbTV9o348vJqs2PAW.P1LBnsgBLHyvPJQOx71hXXegQy2FJCO');
-- ('AHMAD','ahmad@gmail.com', 'php', '$2y$10$e.w3z.4N1g5x7z8vB9w2e.5O5Z1y8X2w3v4b5n6m7l8k9j0h1g2f3')