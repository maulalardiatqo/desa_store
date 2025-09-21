CREATE TABLE presensi (
    id_presensi INT AUTO_INCREMENT PRIMARY KEY,
    id_siswa INT,
    date DATE NOT NULL,
    time_in TIME,
    time_out TIME,
    status VARCHAR(20),
    keterangan TEXT
);