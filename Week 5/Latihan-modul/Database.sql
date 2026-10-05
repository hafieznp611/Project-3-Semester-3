CREATE DATABASE db_belajar; 
USE db_belajar; 
  
CREATE TABLE users ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL, 
    nama_lengkap VARCHAR(100) NOT NULL 
); 