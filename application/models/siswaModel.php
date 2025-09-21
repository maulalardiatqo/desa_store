<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SiswaModel extends CI_Model
{
    public function import_data($dataSiswa, $dataUser)
    {
        $jumlah = count($dataSiswa);
        if ($jumlah > 0) {
            $this->db->replace('siswa', $dataSiswa);
            $this->db->replace('user', $dataUser);
        }
    }
}
