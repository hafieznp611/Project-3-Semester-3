CREATE DATABASE IF NOT EXISTS akademik;
USE akademik;
 
CREATE TABLE IF NOT EXISTS mahasiswa (
    NIM  VARCHAR(10) PRIMARY KEY,
    NAMA VARCHAR(100) NOT NULL,
    UMUR INT NOT NULL
);
 
INSERT INTO mahasiswa (NIM, NAMA, UMUR) VALUES
('2024001', 'Andi Pratama', 19),
('2024002', 'Budi Santoso', 20),
('2024003', 'Citra Dewi', 19),
('2024004', 'Dina Marlina', 21),
('2024005', 'Eko Prasetyo', 20);