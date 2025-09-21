CREATE DATABASE IF NOT EXISTS presensi_db;
USE presensi_db;

CREATE TABLE User (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    role_id INT NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    nama VARCHAR(100),
    date_create DATETIME DEFAULT CURRENT_TIMESTAMP,
    foto VARCHAR(255)
);

CREATE TABLE kelas (
    id_kelas INT AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(100) NOT NULL,
    id_guru INT
);

CREATE TABLE guru (
    id_guru INT AUTO_INCREMENT PRIMARY KEY,
    nama_guru VARCHAR(100) NOT NULL,
    id_kelas INT,
    id_user INT,
    FOREIGN KEY (id_user) REFERENCES User(id_user),
    FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas)
);

CREATE TABLE siswa (
    id_siswa INT AUTO_INCREMENT PRIMARY KEY,
    nama_siswa VARCHAR(100) NOT NULL,
    rfid_code VARCHAR(50) UNIQUE,
    kelas INT,
    FOREIGN KEY (kelas) REFERENCES kelas(id_kelas)
);

CREATE TABLE settings (
    id_setting INT AUTO_INCREMENT PRIMARY KEY,
    day VARCHAR(20) NOT NULL,
    start_time TIME,
    end_time TIME
);

CREATE TABLE presensi (
    id_presensi INT AUTO_INCREMENT PRIMARY KEY,
    id_siswa INT,
    date DATE NOT NULL,
    time_in TIME,
    time_out TIME,
    status VARCHAR(50),
    keterangan TEXT,
    FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa)
);
