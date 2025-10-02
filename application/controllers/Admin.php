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
    public function profileDesa()
    {
        $data['judul'] = 'Profil Desa';

        $tentang = $this->db->get('tentang')->row();
        $contact = $this->db->get('contact')->row();

        $data['tentang'] = $tentang ? $tentang->isi_tentang : '';
        $data['whatsapp'] = $contact ? $contact->whatsapp : '';
        $data['instagram'] = $contact ? $contact->instagram : '';
        $data['facebook'] = $contact ? $contact->facebook : '';
        $data['email'] = $contact ? $contact->email : '';

        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/profileDesa', $data);
        $this->load->view('template_admin/footer');
    }
   
    public function fotoWebsite()
    {
        $data['judul'] = 'Foto Website';
        $data['foto_desa'] = $this->db->get('foto_desa')->result_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/fotoWebsite', $data);
        $this->load->view('template_admin/footer');
    }
    public function addFotoDesa()
    {
        $config['upload_path']   = './assets/foto_desa/'; 
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 5048;
        $config['encrypt_name']  = TRUE;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $config);

        $fileName = null;

        if (!empty($_FILES['fotoDesa']['name'])) {
            if ($this->upload->do_upload('fotoDesa')) {
                $uploadData = $this->upload->data();
                $fileName   = $uploadData['file_name'];
            } else {
                $this->session->set_flashdata('flash', 'Upload foto gagal: ' . $this->upload->display_errors('', ''));
                $this->session->set_flashdata('flashtype', 'danger');
                redirect('admin/fotoWebsite');
                return;
            }
        } else {
            $this->session->set_flashdata('flash', 'Silakan pilih foto terlebih dahulu');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('admin/fotoWebsite');
            return;
        }

        $data = [
            'foto' => $fileName
        ];

        $this->db->insert('foto_desa', $data);

        $this->session->set_flashdata('flash', 'Foto berhasil diupload');
        $this->session->set_flashdata('flashtype', 'success');
        redirect('admin/fotoWebsite');
    }
    public function deleteFotoDesa($id)
    {
        $foto = $this->db->get_where('foto_desa', ['id_foto' => $id])->row();

        if ($foto) {
            $filePath = './assets/foto_desa/' . $foto->foto;

            if (file_exists($filePath) && is_file($filePath)) {
                unlink($filePath);
            }

            $this->db->delete('foto_desa', ['id_foto' => $id]);

            $this->session->set_flashdata('flash', 'Foto berhasil dihapus');
            $this->session->set_flashdata('flashtype', 'success');
        } else {
            $this->session->set_flashdata('flash', 'Foto tidak ditemukan');
            $this->session->set_flashdata('flashtype', 'danger');
        }

        redirect('admin/fotoWebsite');
    }



   public function produk()
    {
        $data['judul'] = 'Produk';

        $data['produk'] = $this->db->query("
            SELECT p.*, s.* 
            FROM product p 
            LEFT JOIN stock s ON p.id_product = s.id_product
        ")->result_array();

        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/produk', $data);
        $this->load->view('template_admin/footer');
    }

    public function addProduct()
    {
        $product_code = $this->input->post('product_code');
        $price = $this->input->post('price');
        function currencyToDecimal($value) {
            $clean = str_replace(['Rp', 'rp', '.', ' '], '', $value);
            $clean = str_replace(',', '.', $clean);
            return (float) $clean;
        }
        $decimalPrice = currencyToDecimal($price);

        if ($product_code) {
            // Cek apakah product_code sudah ada
            $query = $this->db->get_where('product', ['product_code' => $product_code]);

            if ($query->num_rows() > 0) {
                $this->session->set_flashdata('flash', 'Kode produk sudah terdaftar!');
                $this->session->set_flashdata('flashtype', 'danger');
                redirect('admin/produk');
                return;
            } else {
                // Konfigurasi upload
                $config['upload_path']   = './assets/products/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']      = 2048; // 2MB
                $config['encrypt_name']  = TRUE;

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                $this->load->library('upload', $config);

                $fileName = null;

                if (!empty($_FILES['product_image']['name'])) {
                    if ($this->upload->do_upload('product_image')) {
                        $uploadData = $this->upload->data();
                        $fileName   = $uploadData['file_name'];
                    } else {
                        $this->session->set_flashdata('flash', 'Upload gambar gagal: ' . $this->upload->display_errors('', ''));
                        $this->session->set_flashdata('flashtype', 'danger');
                        redirect('admin/produk');
                        return;
                    }
                }

                // Data untuk tabel product
                $dataProduct = [
                    'product_code' => $product_code,
                    'product_name' => $this->input->post('product_name'),
                    'price'        => $decimalPrice,
                    'desc_product'  => $this->input->post('desc'),
                    'product_picture'        => $fileName
                ];

                // Insert ke tabel product
                $this->db->insert('product', $dataProduct);
                $idProduct = $this->db->insert_id(); // ambil id_product baru

                // Data untuk tabel stock
                $dataStock = [
                    'id_product' => $idProduct,
                    'jumlah'     => $this->input->post('stok')
                ];

                $this->db->insert('stock', $dataStock);

                $this->session->set_flashdata('flash', 'Data Produk & Stok Berhasil Ditambahkan');
                $this->session->set_flashdata('flashtype', 'success');
                redirect('admin/produk');
            }
        } else {
            $this->session->set_flashdata('flash', 'Semua field wajib diisi!');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('admin/produk');
        }
    }
    public function hapusProduct($id_product)
    {
        // 1. Ambil data produk dulu (untuk cek apakah ada dan ambil nama file gambar)
        $produk = $this->db->get_where('product', ['id_product' => $id_product])->row_array();

        if ($produk) {
            // 2. Hapus data di tabel stock
            $this->db->delete('stock', ['id_product' => $id_product]);

            // 3. Hapus data di tabel product
            $this->db->delete('product', ['id_product' => $id_product]);

            // 4. Hapus file gambar produk (jika file ada)
            $file_path = FCPATH . 'assets/products/' . $produk['product_picture'];
            if (!empty($produk['product_picture']) && file_exists($file_path)) {
                unlink($file_path);
            }

        
            $this->session->set_flashdata('flash', 'Data Dihapus');
            $this->session->set_flashdata('flashtype', 'success');;
        } else {
            
            $this->session->set_flashdata('flash', 'Gagal Hapus');
            $this->session->set_flashdata('flashtype', 'danger');
        }

        redirect('admin/produk'); 
    }
    public function updateProduct($id_product)
    {
        $price = $this->input->post('price');
        function currencyToDecimal($value) {
            $clean = str_replace(['Rp', 'rp', '.', ' '], '', $value);
            $clean = str_replace(',', '.', $clean);
            return (float) $clean;
        }
        $decimalPrice = currencyToDecimal($price);

        // Ambil data lama
        $oldProduct = $this->db->get_where('product', ['id_product' => $id_product])->row_array();

        if (!$oldProduct) {
            $this->session->set_flashdata('flash', 'Produk tidak ditemukan!');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('admin/produk');
            return;
        }

        // Konfigurasi upload
        $config['upload_path']   = './assets/products/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // 2MB
        $config['encrypt_name']  = TRUE;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $config);

        $fileName = $oldProduct['product_picture']; // default pakai gambar lama

        if (!empty($_FILES['product_picture']['name'])) {
            if ($this->upload->do_upload('product_picture')) {
                $uploadData = $this->upload->data();
                $fileName   = $uploadData['file_name'];

                // Hapus gambar lama jika ada
                if (!empty($oldProduct['product_picture']) && file_exists($config['upload_path'] . $oldProduct['product_picture'])) {
                    unlink($config['upload_path'] . $oldProduct['product_picture']);
                }
            } else {
                $this->session->set_flashdata('flash', 'Upload gambar gagal: ' . $this->upload->display_errors('', ''));
                $this->session->set_flashdata('flashtype', 'danger');
                redirect('admin/produk');
                return;
            }
        }

        // Data untuk tabel product
        $dataProduct = [
            // 'product_code' => tidak diupdate
            'product_name'     => $this->input->post('product_name'),
            'price'            => $decimalPrice,
            'desc'             => $this->input->post('desc'),
            'product_picture'  => $fileName
        ];

        $this->db->where('id_product', $id_product);
        $this->db->update('product', $dataProduct);

        // Update stok di tabel stock
        $dataStock = [
            'jumlah' => $this->input->post('jumlah')
        ];
        $this->db->where('id_product', $id_product);
        $this->db->update('stock', $dataStock);

        $this->session->set_flashdata('flash', 'Data Produk & Stok Berhasil Diperbarui');
        $this->session->set_flashdata('flashtype', 'success');
        redirect('admin/produk');
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
