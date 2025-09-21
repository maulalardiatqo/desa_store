<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Form_validation $form_validation
 * @property CI_Load $load
 * @property CI_URI $uri
 * @property CI_Router $router
 * @property CI_Output $output
 * @property CI_Security $security
 * @property CI_Benchmark $benchmark
 * @property CI_Config $config
 * @property CI_Lang $lang
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Upload $upload
 */

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        //  $this->load->model('SiswaModel');
        $this->load->helper('date');
    }
    public function index()
    {

        $data['judul'] = 'Dashboard Guru';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('template_guru/topbar', $data);
        $this->load->view('template_guru/header', $data);
        $this->load->view('template_guru/sidebar', $data);
        $this->load->view('guru/index', $data);
        $this->load->view('template_guru/footer');
    }
    public function kelolaPresensi(){
        $data['judul'] = 'Kelola Presensi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['guru'] = $this->db->get_where('guru', ['kode_guru' => $this->session->userdata('username')])->row_array();
        $idGuru = $data['guru']['id_guru'];
        $data['kelas'] = $this->db->get_where('kelas', ['id_guru' => $idGuru])->row_array();
        $data['siswa'] = $this->db->get_where('siswa', ['id_kelas' => $data['kelas']['id_kelas']])->result_array();
        $this->load->view('template_guru/topbar', $data);
        $this->load->view('template_guru/header', $data);
        $this->load->view('template_guru/sidebar', $data);
        $this->load->view('guru/kelolaPresensi', $data);
        $this->load->view('template_guru/footer');
    }
    public function inputPresensi()
    {
        $this->load->helper('date');

        $date = $this->input->post('date'); 
        $id_siswa = $this->input->post('id_siswa');
        $status = $this->input->post('status');
        if (empty($date) || empty($id_siswa) || empty($status)) {
        $this->session->set_flashdata('flash', 'Tanggal, Siswa, dan Status wajib diisi');
        $this->session->set_flashdata('flashtype', 'danger');
        redirect('guru/kelolaPresensi');
        }
        $keterangan = $this->input->post('keterangan');
        $this->db->where('start_date <=', $date);
        $this->db->where('end_date >=', $date);
        $holiday = $this->db->get('holiday')->row();

        if ($holiday) {
            $this->session->set_flashdata('flash', 'Tanggal Tersebut Adalah Hari Libur');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('guru/kelolaPresensi');
        }

        $namaHari = $this->getHariIndonesia(date('N', strtotime($date))); 
        $this->db->where('hari', $namaHari);
        $this->db->where('is_active', 1);
        $liburTetap = $this->db->get('libur_tetap')->row();

        if ($liburTetap) {
            $this->session->set_flashdata('flash', 'Tanggal Tersebut Adalah Hari Libur');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('guru/kelolaPresensi');
        }

        $this->db->where('date', $date);
        $this->db->where('id_siswa', $id_siswa);
        $presensi = $this->db->get('presensi')->row();

        if ($presensi) {
            $this->session->set_flashdata('flash', 'Siswa Tersebut Sudah Melakukan Absen');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('guru/kelolaPresensi');
        }
        $this->db->where('day', $namaHari);
        $setting = $this->db->get('settings')->row();

        if ($setting) {
            $start_time = $setting->start_time;
            $end_time   = $setting->end_time;

             $data = [
                    'id_siswa' => $id_siswa,
                    'date' => $date,
                    'time_in' => $start_time,
                    'status' => $status,
                    'keterangan' => $keterangan
                ];
                $this->db->insert('presensi', $data);
                $data2 = [
                    'id_siswa' => $id_siswa,
                    'date' => $date,
                    'time_out' => $end_time,
                    'status' => $status,
                    'keterangan' => $keterangan
                ];
                $this->db->insert('presensi', $data2);
                $this->session->set_flashdata('flash', 'Berhasil input absen manual');
                $this->session->set_flashdata('flashtype', 'danger');
                redirect('guru/kelolaPresensi');
        } else {
             $this->session->set_flashdata('flash', 'Pengaturan Presensi Belum tersedia');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('guru/kelolaPresensi');
        }
    }

    // Fungsi bantu untuk konversi hari ke Bahasa Indonesia
    private function getHariIndonesia($dayNumber)
    {
        $hari = [
            1 => "Senin",
            2 => "Selasa",
            3 => "Rabu",
            4 => "Kamis",
            5 => "Jum'at",
            6 => "Sabtu",
            7 => "Minggu"
        ];
        return $hari[$dayNumber] ?? 'Tidak diketahui';
    }
    public function detailReport()
    {
        $data['judul'] = 'Detail Raport';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('template_guru/topbar', $data);
        $this->load->view('template_guru/header', $data);
        $this->load->view('template_guru/sidebar', $data);
        $this->load->view('guru/detailReport', $data);
        $this->load->view('template_guru/footer');
    }
    public function tampilDetail()
    {
        $data['judul'] = 'Detail Raport';
        $date = $this->input->post('date');
        if (empty($date)) {
            $this->session->set_flashdata('flash', 'Tanggal wajib diisi');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('guru/detailReport');
        }
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['guru'] = $this->db->get_where('guru', ['kode_guru' => $this->session->userdata('username')])->row_array();
        $idGuru = $data['guru']['id_guru'];
        $data['kelas'] = $this->db->get_where('kelas', ['id_guru' => $idGuru])->row_array();
        $siswaList = $this->db->get_where('siswa', ['id_kelas' => $data['kelas']['id_kelas']])->result_array();

        $idSiswaArray = array_column($siswaList, 'id_siswa');
        $data['date'] = $date;
        $presensiList = [];
        if (!empty($idSiswaArray)) {
            $this->db->where('date', $date);
            $this->db->where_in('id_siswa', $idSiswaArray);
            $result = $this->db->get('presensi')->result_array();

            foreach ($result as $p) {
                $presensiList[$p['id_siswa']] = $p;
            }
        }

        foreach ($siswaList as &$siswa) {
            $id = $siswa['id_siswa'];
            $siswa['presensi'] = isset($presensiList[$id]) ? $presensiList[$id] : null;
        }

        $data['siswa'] = $siswaList;
        $this->load->view('template_guru/topbar', $data);
        $this->load->view('template_guru/header', $data);
        $this->load->view('template_guru/sidebar', $data);
        $this->load->view('guru/tampilDetailReport', $data);
        $this->load->view('template_guru/footer');
       
    }
    public function updatePresensi()
    {
        $id_presensi = $this->input->post('id_presensi');

        if (!$id_presensi) {
            echo 'tidak ada presensi';
            return;
        }

        // Ambil semua field dari input
        $data = [];

        $time_in = $this->input->post('time_in');
        if (!empty($time_in)) {
            $data['time_in'] = $time_in;
        }

        $time_out = $this->input->post('time_out');
        if (!empty($time_out)) {
            $data['time_out'] = $time_out;
        }

        $status = $this->input->post('status');
        if (!empty($status)) {
            $data['status'] = $status;
        }

        $keterangan = $this->input->post('keterangan');
        if (!empty($keterangan)) {
            $data['keterangan'] = $keterangan;
        }

        if (!empty($data)) {
            $this->db->where('id_presensi', $id_presensi);
            $this->db->update('presensi', $data);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('flash', 'Berhasil Update');
                $this->session->set_flashdata('flashtype', 'success');
                redirect('guru/detailReport');
            } else {
                $this->session->set_flashdata('flash', 'Tidak Ada Data Update');
                $this->session->set_flashdata('flashtype', 'danger');
                redirect('guru/detailReport');
            }
        } else {
            $this->session->set_flashdata('flash', 'Tidak Ada Data Update');
                $this->session->set_flashdata('flashtype', 'danger');
                redirect('guru/detailReport');
        }
    }


    public function summaryReport()
    {
        $data['judul'] = 'Detail Raport';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('template_guru/topbar', $data);
        $this->load->view('template_guru/header', $data);
        $this->load->view('template_guru/sidebar', $data);
        $this->load->view('guru/summaryReport', $data);
        $this->load->view('template_guru/footer');
    }
    public function filterReport()
    {

    }
   

}
