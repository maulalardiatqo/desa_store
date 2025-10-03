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
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $tentang = $this->db->get('tentang')->row();
        $data['isi_tentang'] = $tentang ? $tentang->isi_tentang : '';
        $data['foto_desa'] = $this->db->get('foto_desa')->result_array();
        $foot['contact'] = $this->db->get('contact')->row();
        $this->load->view('auth/template header');
        $this->load->view('auth/website', $data);
        $this->load->view('auth/template footer', $foot);
    }

        public function catalog()
    {
        $contact = $this->db->get('contact')->row();
        $data['whatsapp'] = $contact ? $contact->whatsapp : '';
       $data['produk'] = $this->db->query("
        SELECT p.*, s.* 
        FROM product p 
        LEFT JOIN stock s ON p.id_product = s.id_product
    ")->result_array();
    $foot['contact'] = $this->db->get('contact')->row();
        $this->load->view('auth/template header');
        $this->load->view('auth/catalog',$data);
        $this->load->view('auth/template footer', $foot);
    }

    public function loginadmin(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required' => 'Username harus diisi'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password harus diisi',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }
    public function registrasi()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]', [
            'required' => 'Username harus diisi',
            'is_unique' => 'Username sudah ada'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/registrasi');
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'foto' => 'user_default.png',
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 1,
                'date_create' => time()
            ];
            $this->db->insert('user', $data);
            redirect('auth');
        }
    }
    public function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if($username === 'Admin@kwtdesakajen' ){
            if($password === 'Kwtdesakajen@123_admin'){
                redirect('admin');
            }else{
                $this->session->set_flashdata('flash', 'Password salah');
                $this->session->set_flashdata('flashtype', 'danger');
                redirect('auth/loginadmin');
            }
        }else{
            $this->session->set_flashdata('flash', 'Password salah');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('auth/loginadmin');
        }

       
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('flash', 'Anda telah keluar');
        $this->session->set_flashdata('flashtype', 'success');
        redirect('auth/loginadmin');
    }
}
