CREATE TABLE mode (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mode VARCHAR(20),          -- misal: 'register' atau 'scan'
    id_siswa INT,              -- id dari siswa yang sedang diproses
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
