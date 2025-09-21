<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

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

class Admin extends CI_Controller
{
   public function __construct()
{
    parent::__construct();

    // List method yang tidak butuh login
    $public_methods = ['get_mode', 'register_uid', 'presensi', 'set_latest_uid', 'get_latest_uid', 'generate_absen_tidak_hadir_otomatis'];  // tambahkan di sini

    // Ambil method yang dipanggil sekarang
    $current_method = $this->router->fetch_method();


    $this->load->library('form_validation');
    // $this->load->model('SiswaModel');
    $this->load->helper('date');
}

    public function index()
    {

        $data['judul'] = 'Dashboard';
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template_admin/footer');
    }
    public function kegiatanDesa()
    {
        $data['judul'] = 'Kegiatan Desa';
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/kegiatanDesa', $data);
        $this->load->view('template_admin/footer');
    }
    public function berita()
    {
        $data['judul'] = 'Berita';
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/berita', $data);
        $this->load->view('template_admin/footer');
    }
    public function fotoWebsite()
    {
        $data['judul'] = 'Foto Website';
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/fotoWebsite', $data);
        $this->load->view('template_admin/footer');
    }
    public function produk()
    {
        $data['judul'] = 'Produk';
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/produk', $data);
        $this->load->view('template_admin/footer');
    }
    // sample
    public function editUser($id)
    {
        $data['judul'] = 'Edit User';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['userS'] = $this->db->get_where('user', ['id' => $id])->result_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/editUser', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambahSetting(){
        $day = $this->input->post('day');
        $strTIme = $this->input->post('start_time');
        $endTime = $this->input->post('end_time');
        
        if ($day == '' || $day == null || $strTIme == '' || $strTIme == null || $endTime == '' || $endTime == null) {
            $this->session->set_flashdata('flash', 'Semua field wajib diisi!');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('admin/settings');
            return;
        }
        $cekDay = $this->db->get_where('settings', ['day' => $day])->num_rows();
        
        if($cekDay > 0){
            $this->session->set_flashdata('flash', 'Hari Sudah Ada');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('admin/settings');
        }else{
            $data = [
                'day' => $day,
                'start_time' => $strTIme,
                'end_time' => $endTime
            ];
            $this->db->insert('settings', $data);

            $this->session->set_flashdata('flash', 'Data Berhasil Di Input');
            $this->session->set_flashdata('flashtype', 'success');
            redirect('admin/settings');

        }
    }
    public function updateSetting()
    {
        $id = $this->input->post('id_setting');
        $day = $this->input->post('day');
        $start = $this->input->post('start_time');
        $end = $this->input->post('end_time');

        $this->db->where('id_setting', $id);
        $this->db->update('settings', [
            'day' => $day,
            'start_time' => $start,
            'end_time' => $end
        ]);

         $this->session->set_flashdata('flash', 'Data Berhasil Di Update');
            $this->session->set_flashdata('flashtype', 'success');
        redirect('admin/settings');
    }
    public function haspusSettings($id_setting){
        $this->db->delete('settings', ['id_setting' => $id_setting]);
        $this->session->set_flashdata('flash', 'Surat Dihapus');
        $this->session->set_flashdata('flashtype', 'success');
        redirect('admin/settings');
    }


}
