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

        // query builder CI = select * from ... where
        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        // cek data user
        if ($user) {
            // cek aktivasi akun
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id_user']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 2) {
                        redirect('guru');
                    } 
                } else {
                    $this->session->set_flashdata('flash', 'Password salah');
                    $this->session->set_flashdata('flashtype', 'danger');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('flash', 'Akun Tidak Aktif');
                $this->session->set_flashdata('flashtype', 'danger');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('flash', 'Username tidak ditemukan');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('flash', 'Anda telah keluar');
        $this->session->set_flashdata('flashtype', 'success');
        redirect('auth');
    }
}
