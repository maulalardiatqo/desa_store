<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // load model, helper, library yang diperlukan
        $this->load->model('SiswaModel'); // kalau ada
        $this->load->helper('url');
        header('Content-Type: application/json');
    }

    public function get_mode()
    {
        // Contoh ambil mode dan id_siswa dari DB atau session
        $data = [
            'mode' => 'register', // atau 'presensi'
            'id_siswa' => null
        ];
        echo json_encode($data);
    }

    public function presensi()
    {
        $uid = $this->input->post('uid');
        if (!$uid) {
            echo json_encode(['status' => 'error', 'message' => 'UID tidak ditemukan']);
            return;
        }

        // Logika presensi: cek UID di DB, simpan presensi, dll
        $response = [
            'status' => 'success',
            'message' => 'Presensi berhasil dengan UID ' . $uid
        ];
        echo json_encode($response);
    }
    public function set_mode()
{
    if ($this->input->method() !== 'post') {
        echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        return;
    }

    $mode = $this->input->post('mode');
    $id_siswa = $this->input->post('id_siswa');

    // Simpan mode dan id_siswa di session atau DB
    $this->session->set_userdata('mode', $mode);
    $this->session->set_userdata('id_siswa', $id_siswa);

    echo json_encode(['status' => 'success']);
}

}
