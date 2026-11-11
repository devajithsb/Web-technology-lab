-- Computer Science Department Database Setup
-- Run these SQL commands in phpMyAdmin to create the database and tables

-- Create Database
CREATE DATABASE IF NOT EXISTS department_db;
USE department_db;

-- Create Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE
);

-- Create Courses Table (Optional - for future enhancement)
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    course_code VARCHAR(20) UNIQUE NOT NULL,
    description TEXT,
    credits INT,
    instructor VARCHAR(100),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Student Enrollments Table (Optional - for future enhancement)
CREATE TABLE IF NOT EXISTS enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'completed', 'dropped') DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Create indexes for better performance
CREATE INDEX idx_username ON users(username);
CREATE INDEX idx_email ON users(email);

-- Sample data (optional - you can delete this if not needed)
INSERT INTO users (name, email, username, password, registration_date) VALUES
('Admin User', 'admin@university.edu', 'admin', 'admin123', NOW()),
('Student One', 'student1@university.edu', 'student1', 'pass1234', NOW()),
('Student Two', 'student2@university.edu', 'student2', 'pass1234', NOW());

-- Sample courses (optional)
INSERT INTO courses (course_name, course_code, description, credits, instructor) VALUES
('Introduction to Web Development', 'CS101', 'Learn HTML, CSS, and JavaScript', 3, 'Dr. Rajesh Kumar'),
('Object Oriented Programming', 'CS102', 'C++ and Java Programming', 4, 'Prof. Priya Singh'),
('Database Management Systems', 'CS103', 'SQL and Database Design', 3, 'Dr. Amit Patel'),
('Data Structures and Algorithms', 'CS104', 'DSA using C and Java', 4, 'Prof. Neha Sharma');

-- Display all tables and data
SELECT 'Users Table:' as '';
SELECT * FROM users;

SELECT 'Courses Table:' as '';
SELECT * FROM courses;
