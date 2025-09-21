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

    // Jika method bukan public, cek login
    if (!in_array($current_method, $public_methods)) {
        cek_login('1');
    }

    $this->load->library('form_validation');
    // $this->load->model('SiswaModel');
    $this->load->helper('date');
}

    public function index()
    {

        $data['judul'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template_admin/footer');
    }
    public function resetPassword($id)
    {
        $this->db->set('password', password_hash('Smekal123', PASSWORD_DEFAULT));
        $this->db->where('id', $id);
        $this->db->update('user');
        $this->session->set_flashdata('flash', 'Password berhasil di reset');
        $this->session->set_flashdata('flashtype', 'success');
        redirect('admin/pengguna');
    }
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

    public function guru()
    {
        $data['judul'] = 'Guru';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->select('guru.*');
        $this->db->from('guru');
        $data['guru'] = $this->db->get()->result_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/guru', $data);
        $this->load->view('template_admin/footer');
    }
    public function settings()
    {
        $data['judul'] = 'Settings';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->db->select('settings.*');
        $this->db->from('settings');
        $data['settings'] = $this->db->get()->result_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/settings', $data);
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
    public function libur()
    {
        $data['judul'] = 'Setting Hari Libur';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['holiday'] = $this->db->get('holiday')->result_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/holiday', $data);
        $this->load->view('template_admin/footer');
    }
    public function tambahHoliday()
    {
        $nama_event = $this->input->post('nama_event');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $keterangan = $this->input->post('keterangan');
        $data = [
            'nama_event' => $nama_event,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'keterangan' => $keterangan
        ];
        $this->db->insert('holiday', $data);

            $this->session->set_flashdata('flash', 'Data Berhasil Di Input');
            $this->session->set_flashdata('flashtype', 'success');
            redirect('admin/libur');
    }
    public function updateHoliday()
    {
        $id = $this->input->post('id_libur');
        $data = [
            'nama_event' => $this->input->post('nama_event'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'keterangan' => $this->input->post('keterangan'),
        ];

        $this->db->where('id_libur', $id);
        $this->db->update('holiday', $data);
        $this->session->set_flashdata('flash', 'Data Berhasil Di Update');
        $this->session->set_flashdata('flashtype', 'success');

        redirect('admin/libur');
    }

    public function hapusHoliday($id_libur)
    {
        $this->db->where('id_libur', $id_libur);
        $this->db->delete('holiday');
        $this->session->set_flashdata('flash', 'Data dihapus');
        $this->session->set_flashdata('flashtype', 'success');

        redirect('admin/libur');
    }
    public function liburTetap()
    {
        $data['judul'] = 'Libur Tetap';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['libur_tetap'] = $this->db->get('libur_tetap')->result_array();

        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/libur_tetap', $data);
        $this->load->view('template_admin/footer');
    }
    public function updateLiburTetap()
{
    $data = $this->input->post('libur');

    foreach ($data as $row) {
        $this->db->where('id_libur_tetap', $row['id']);
        $this->db->update('libur_tetap', [
            'hari' => $row['hari'],
            'is_active' => $row['is_active']
        ]);
    }

    $this->session->set_flashdata('flash', 'Data Berhasil Di Update');
    $this->session->set_flashdata('flashtype', 'success');
    redirect('admin/liburTetap');
}

    public function kelas()
    {
        $data['judul'] = 'Kelas';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['guru'] = $this->db->get('guru')->result_array();
        $data['kelas'] = $this->db->select('kelas.*, guru.nama_guru')
                            ->from('kelas')
                            ->join('guru', 'guru.id_guru = kelas.id_guru', 'left')
                            ->get()
                            ->result_array();

        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/kelas', $data);
        $this->load->view('template_admin/footer');
    }
    public function tambahKelas(){
        $id_guru = $this->input->post('id_guru');
        $nama_kelas = $this->input->post('nama_kelas');
        $cek = $this->db->get_where('kelas', ['id_guru' => $id_guru])->num_rows();
        if($cek > 0){
            $this->session->set_flashdata('flash', 'Guru Tersebut Sudah Menjadi Walikelas Lain');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('admin/kelas');
        }else{
            $data = [
                'id_guru' => $id_guru,
                'nama_kelas' => $nama_kelas
            ];
            $this->db->insert('kelas', $data);

            $this->session->set_flashdata('flash', 'Data Berhasil Di Input');
            $this->session->set_flashdata('flashtype', 'success');
            redirect('admin/kelas');

        }
    }
    public function editKelas($id_kelas){
        $data['judul'] = 'Edit Kelas';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['guru'] = $this->db->get('guru')->result_array();
        $data['kelas'] = $this->db->get_where('kelas', ['id_kelas' => $id_kelas])->result_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/editKelas', $data);
        $this->load->view('template_admin/footer');

    }
    public function updateKelas($id_kelas)
    {
        $id_guru = $this->input->post('id_guru');
        $nama_kelas = $this->input->post('nama_kelas');
        $data = [
            'nama_kelas' => $this->input->post('nama_kelas'),
            'id_guru' => $this->input->post('id_guru')
        ];
        $cek = $this->db->get_where('kelas', ['id_guru' => $id_guru])->num_rows();
        if($cek > 0){
            $this->session->set_flashdata('flash', 'Guru Tersebut Sudah Menjadi Walikelas Lain');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('admin/editKelas/' . $id_kelas);
        }else{
            $this->db->update('kelas', $data, ['id_kelas' => $id_kelas]);
            $this->session->set_flashdata('flash', 'Update Berhasil');
            $this->session->set_flashdata('flashtype', 'success');
            redirect('admin/kelas');
        }
    }
    public function hapusKelas($id)
    {
         $sql = "DELETE FROM kelas  WHERE id_kelas = $id";
        $this->db->query($sql, [$id]);

        $this->session->set_flashdata('flash', 'Data dihapus');
        $this->session->set_flashdata('flashtype', 'success');

        redirect('admin/kelas');
    }
    public function tambahGuru()
    {
        $kode_guru = $this->input->post('kode_guru');
        $nama_guru = $this->input->post('nama_guru');

        $cek = $this->db->get_where('guru', ['kode_guru' => $kode_guru])->num_rows();

        if ($cek > 0) {
            $this->session->set_flashdata('flash', 'Duplikat Kode');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('admin/guru');
        } else {
            $data = [
                'kode_guru' => $kode_guru,
                'nama_guru' => $nama_guru,
            ];
            $password = password_hash('guru12345', PASSWORD_DEFAULT);

            $this->db->insert('guru', $data);
            $this->db->query("INSERT INTO user (username, password, role_id, is_active, nama, date_create, foto) 
                                VALUES ('$kode_guru', '$password', 2, 1, '$nama_guru', NOW(), 'user_default.png')");

            $this->session->set_flashdata('flash', 'Data Berhasil Di Input');
            $this->session->set_flashdata('flashtype', 'success');
            redirect('admin/guru');
        }
    }

    public function hapusGuru($kode)
    {
        
        $dataGuru = $this->db->get_where('guru',['id_guru' => $kode])->result_array();
        $kodeGuru = $dataGuru[0]['kode_guru'];
        $sql = "DELETE g.*, u.* FROM guru g, user u WHERE g.id_guru = '$kode' AND u.username = '$kodeGuru'";
        $this->db->query($sql, [$kode]);
        $cekKelas = $this->db->get_where('kelas', ['id_guru' => $kode])->num_rows();
        if ($cekKelas > 0) {
            $this->db->where('id_guru', $kode);
            $this->db->update('kelas', ['id_guru' => '']);
        }

        $this->session->set_flashdata('flash', 'Data dihapus');
        $this->session->set_flashdata('flashtype', 'success');

        redirect('admin/guru');
    }
    public function editGuru($kode)
    {
        $data['judul'] = 'Edit Guru';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['guru'] = $this->db->get_where('guru', ['id_guru' => $kode])->result_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/editGuru', $data);
        $this->load->view('template_admin/footer');
    }
    public function updateGuru($kode)
    {
        $data = [
            'kode' => $this->input->post('kode'),
            'nama' => $this->input->post('nama'),
            'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
            'gender' => $this->input->post('gender'),
            'jabatan' => $this->input->post('jabatan'),
            'kontak' => $this->input->post('kontak'),
            'tahun_masuk' => $this->input->post('tahun_masuk'),
            'salary_per_hour' => $this->input->post('salary_per_hour'),
            'jam_kerja' => $this->input->post('jam_kerja'),
        ];
        $this->db->update('guru', $data, ['kode' => $kode]);
        $this->session->set_flashdata('flash', 'Update Berhasil');
        $this->session->set_flashdata('flashtype', 'success');
        redirect('admin/guru');
    }
    public function siswa()
    {
        $data['judul'] = 'Siswa';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->db->select('siswa.*, kelas.nama_kelas')
                            ->from('siswa')
                            ->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left')
                            ->get()
                            ->result_array();
        $data['kelas'] = $this->db->get('kelas')->result_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/siswa', $data);
        $this->load->view('template_admin/footer');
    }
    public function tambahSiswa()
    {
        $nis = $this->input->post('nis');
        $nama_siswa = $this->input->post('nama_siswa');
        $id_kelas = $this->input->post('id_kelas');
        $jenis_kelamin = $this->input->post('jenis_kelamin');

        $cek = $this->db->get_where('siswa', ['nis' => $nis])->num_rows();

        if ($cek > 0) {
            $this->session->set_flashdata('flash', 'Duplikat NIS');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('admin/siswa');
        } else {
            $data = [
                'nis' => $nis,
                'nama_siswa' => $nama_siswa,
                'id_kelas' => $id_kelas,
                'jenis_kelamin' => $jenis_kelamin
            ];
            $this->db->insert('siswa', $data);
            $this->session->set_flashdata('flash', 'Data Berhasil Di Tambah');
            $this->session->set_flashdata('flashtype', 'success');
        }
        redirect('admin/siswa');
    }
    public function hapusSiswa($nis)
    {
        $sql = "DELETE FROM siswa  WHERE id_siswa = $nis";
        $this->db->query($sql, [$nis]);

        $this->session->set_flashdata('flash', 'Data dihapus');
        $this->session->set_flashdata('flashtype', 'success');

        redirect('admin/siswa');
    }
    public function editSiswa($nis)
    {
        $data['judul'] = 'Edit Siswa';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->db->get_where('siswa', ['id_siswa' => $nis])->result_array();
        $data['kelas'] = $this->db->get('kelas')->result_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/editSiswa', $data);
        $this->load->view('template_admin/footer');
    }
    public function updateSiswa($id_siswa)
    {
        $dataSiswa = $this->db->get_where('siswa', ['id_siswa' => $id_siswa])->result_array();
        $kelasSiswa = $dataSiswa[0]['id_kelas'];
        $kelasToset = '';
        $cekKelas = $this->input->post('id_kelas');
        if($cekKelas){
            $kelasToset = $cekKelas;
        }else{
            $kelasToset = $kelasSiswa;
        }

        $data = [
            'nama_siswa' => $this->input->post('nama_siswa'),
            'nis' => $this->input->post('nis'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'id_kelas' => $kelasToset,
        ];
        $this->db->update('siswa', $data, ['id_siswa' => $id_siswa]);
        $this->session->set_flashdata('flash', 'Update Berhasil');
        $this->session->set_flashdata('flashtype', 'success');
        redirect('admin/siswa');
    }
    public function registerRfid($id_siswa)
    {
        $data['judul'] = 'Register RFID';
        $this->db->update('status_rfid', ['status' => 'registrasi'], ['id' => 1]);
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->db->get_where('siswa', ['id_siswa' => $id_siswa])->result_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/registerrfid', $data);
        $this->load->view('template_admin/footer');
    }
    public function set_latest_uid()
    {
        $uid = $this->input->post('uid');

        if (empty($uid)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'UID kosong.'
            ]);
            return;
        }
        $status = $this->db->get_where('status_rfid', ['id' => 1])->row();

        if (!$status) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Status sistem tidak ditemukan.'
            ]);
            return;
        }

        if ($status->status == 'registrasi') {
            $path = FCPATH . 'latest_uid.txt';
            $write = file_put_contents($path, $uid);

            echo json_encode([
                'status' => 'registrasi',
                'message' => $write ? 'UID disimpan untuk registrasi.' : 'Gagal simpan UID.',
                'received_uid' => $uid
            ]);
        } elseif ($status->status == 'presensi') {
    $siswa = $this->db->get_where('siswa', ['rfid_code' => $uid])->row();

    if ($siswa) {
        date_default_timezone_set('Asia/Jakarta');

        $tanggal = date('Y-m-d');
        $waktu   = date('H:i:s');
        $hariInggris = date('l');
        $namaHari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => "Jum'at",
            'Saturday'  => 'Sabtu'
        ];
        $hari = $namaHari[$hariInggris];

        $setting = $this->db->get_where('settings', ['day' => $hari])->row();

        if (!$setting) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Setting jadwal untuk hari ini belum diatur.' . $hari
            ]);
            return;
        }

        $startTime = strtotime($setting->start_time); // Misal: 07:00:00
        $rangeStart = $startTime - 3600; // 1 jam sebelum
        $rangeEnd = $startTime + (3 * 3600); // 2 jam setelah
        $now = strtotime($waktu);

        $presensi = $this->db->where('id_siswa', $siswa->id_siswa)
                            ->where('date', $tanggal)
                            ->get('presensi')
                            ->row();

        if ($now >= $rangeStart && $now <= $rangeEnd) {
            // Masuk dalam range absen masuk

            $statusPresensi = ($now > $startTime) ? 'Telat' : 'Tepat Waktu';

            if (!$presensi) {
                // Insert time_in baru
                $data = [
                    'id_siswa' => $siswa->id_siswa,
                    'date' => $tanggal,
                    'time_in' => $waktu,
                    'status' => 'Hadir',
                    'keterangan' => $statusPresensi
                ];
                $this->db->insert('presensi', $data);

                echo json_encode([
                    'status' => 'presensi',
                    'message' => 'Presensi masuk dicatat.',
                    'siswa' => $siswa->nama_siswa,
                    'waktu' => $waktu,
                    'status_presensi' => $statusPresensi
                ]);
            } else {
                // Update time_in jika presensi sudah ada
                $this->db->where('id_presensi', $presensi->id_presensi)
                         ->update('presensi', [
                            'time_in' => $waktu,
                            'keterangan' => $statusPresensi
                         ]);

                echo json_encode([
                    'status' => 'presensi',
                    'message' => 'Presensi masuk diperbarui.',
                    'siswa' => $siswa->nama_siswa,
                    'waktu' => $waktu,
                    'status_presensi' => $statusPresensi
                ]);
            }

        } else {
            // Di luar range jam masuk, dianggap sebagai jam pulang
            if ($presensi) {
                $statusPresensi = $presensi->status;
                if ($now < strtotime($setting->end_time)) {
                    $statusPresensi = 'Pulang Lebih Awal';
                }

                $this->db->where('id_presensi', $presensi->id_presensi)
                         ->update('presensi', [
                             'time_out' => $waktu,
                             'status' => $statusPresensi
                         ]);

                echo json_encode([
                    'status' => 'presensi',
                    'message' => 'Presensi pulang dicatat.',
                    'siswa' => $siswa->nama_siswa,
                    'waktu' => $waktu,
                    'status_presensi' => $statusPresensi
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Tidak bisa presensi pulang tanpa presensi masuk.'
                ]);
            }
        }

    } else {
        echo json_encode([
            'status' => 'tidak_terdaftar',
            'message' => 'UID tidak terdaftar.'
        ]);
    }
}

    }


    public function generate_absen_tidak_hadir_otomatis()
    {
        date_default_timezone_set('Asia/Jakarta');

        $hariInggris = date('l');
        $tanggalHariIni = date('Y-m-d');
        $waktuSekarang = date('H:i:s');

        // Konversi hari Inggris ke Bahasa
        $namaHari = [
            'Sunday' => "Minggu",
            'Monday' => "Senin",
            'Tuesday' => "Selasa",
            'Wednesday' => "Rabu",
            'Thursday' => "Kamis",
            'Friday' => "Jum'at",
            'Saturday' => "Sabtu"
        ];
        $hariIni = $namaHari[$hariInggris];
        $setting = $this->db->get_where('settings', ['day' => $hariIni])->row();
        if (!$setting) {
            echo "Jadwal belum diatur untuk hari: $hariIni";
            return;
        }

        $startTime = $setting->start_time;
        $batasWaktu = date('H:i:s', strtotime($startTime . ' +1 hour'));
        $liburTetap = $this->db->get_where('libur_tetap', ['hari' => $hariIni])->row();
        if ($liburTetap && $liburTetap->is_active == 1) {
            echo "Hari ini libur tetap ($hariIni).";
            return;
        }
        $this->db->where('start_date <=', $tanggalHariIni);
        $this->db->where('end_date >=', $tanggalHariIni);
        $liburEvent = $this->db->get('holiday')->row();

        if ($liburEvent) {
            echo "Hari ini libur karena: " . $liburEvent->nama_event;
            return;
        }
        if (strtotime($waktuSekarang) < strtotime($batasWaktu)) {
            echo "Masih dalam rentang waktu presensi. Tidak ada aksi dilakukan.";
            return;
        }
        $siswaAll = $this->db->get('siswa')->result();

        foreach ($siswaAll as $siswa) {
            $cekPresensi = $this->db->get_where('presensi', [
                'id_siswa' => $siswa->id_siswa,
                'date' => $tanggalHariIni
            ])->row();

            if (!$cekPresensi) {
                // Belum presensi, catat sebagai Tidak Hadir
                $this->db->insert('presensi', [
                    'id_siswa' => $siswa->id_siswa,
                    'date' => $tanggalHariIni,
                    'status' => 'Tidak Hadir',
                    'keterangan' => 'Tidak Hadir'
                ]);
            }
        }

        echo "Presensi otomatis selesai. Siswa yang tidak hadir sudah dicatat.";
    }

    public function get_latest_uid()
    {
        $path = FCPATH . 'latest_uid.txt';
        $uid = file_exists($path) ? trim(file_get_contents($path)) : '';
        echo json_encode(['uid' => $uid]);
    }

    public function reset_status()
    {
        $this->db->update('status_rfid', ['status' => 'presensi'], ['id' => 1]);
    }
    public function updateRfid($id_siswa){
        $uid = $this->input->post('rfid_number');
        $cek = $this->db->get_where('siswa', ['rfid_code' => $uid])->num_rows();
        if($cek > 0){
            $this->session->set_flashdata('flash', 'RFID Number sudah di gunakan');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('admin/registerRfid/' . $id_siswa);
        }else{
            $data = [
            'rfid_code' => $uid,
            ];
            $this->db->update('siswa', $data, ['id_siswa' => $id_siswa]);
            $this->session->set_flashdata('flash', 'Update Berhasil');
            $this->session->set_flashdata('flashtype', 'success');
            redirect('admin/siswa');
        }
        
    }

    // Report
    public function report()
    {
        $data['judul'] = 'Report Presensi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kelas'] = $this->db->get('kelas')->result_array();
        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/report', $data);
        $this->load->view('template_admin/footer');
    }
    public function lihatReport()
    {
        $id_kelas = $this->input->post('id_kelas');
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');

        // Ambil data siswa
        $this->db->where('id_kelas', $id_kelas);
        $siswa = $this->db->get('siswa')->result();

        // Ambil data presensi
        $this->db->select('presensi.*, siswa.nama_siswa')
                ->from('presensi')
                ->join('siswa', 'presensi.id_siswa = siswa.id_siswa')
                ->where('siswa.id_kelas', $id_kelas)
                ->where('presensi.date >=', $dari)
                ->where('presensi.date <=', $sampai);
        $presensi = $this->db->get()->result();

        // Ambil data libur tetap
        $libur_tetap = $this->db->get_where('libur_tetap', ['is_active' => 1])->result_array();
        $hari_libur = array_column($libur_tetap, 'hari'); // array: ['Minggu', 'Sabtu', ...]

        // Ambil data holiday (libur event)
        $holiday = $this->db->get('holiday')->result_array();

        // Siapkan array tanggal
        $tanggal = [];
        $period = new DatePeriod(
            new DateTime($dari),
            new DateInterval('P1D'),
            (new DateTime($sampai))->modify('+1 day')
        );
        foreach ($period as $dt) {
            $tanggal[] = $dt->format('m/d/Y');
        }

        // Konversi nama hari Inggris ke Indonesia
        $hariInggrisKeIndonesia = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => "Jum'at",
            'Saturday' => 'Sabtu'
        ];

        // Siapkan data presensi awal
        $data_presensi = [];
        foreach ($siswa as $s) {
            foreach ($tanggal as $tgl) {
                $datetime = DateTime::createFromFormat('m/d/Y', $tgl);
                $hari_en = $datetime->format('l');
                $hari = $hariInggrisKeIndonesia[$hari_en] ?? $hari_en;

                // Cek apakah libur tetap
                $is_libur_tetap = in_array($hari, $hari_libur);

                // Cek apakah libur event
                $is_libur_event = false;
                foreach ($holiday as $event) {
                    $start = new DateTime($event['start_date']);
                    $end = new DateTime($event['end_date']);
                    if ($datetime >= $start && $datetime <= $end) {
                        $is_libur_event = true;
                        break;
                    }
                }

                // Set status awal
                if ($is_libur_tetap || $is_libur_event) {
                    $data_presensi[$s->id_siswa]['presensi'][$tgl] = 'Libur';
                } else {
                    $data_presensi[$s->id_siswa]['presensi'][$tgl] = '-';
                }

                $data_presensi[$s->id_siswa]['nama_siswa'] = $s->nama_siswa;
            }
        }

        // Isi data presensi sebenarnya
        foreach ($presensi as $p) {
            $tgl = date('m/d/Y', strtotime($p->date));
            $data_presensi[$p->id_siswa]['presensi'][$tgl] = $p->status;
        }

        $data['tanggal'] = $tanggal;
        $data['data_presensi'] = $data_presensi;
        $data['judul'] = 'Report Presensi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kelas'] = $this->db->get('kelas')->result_array();

        $this->load->view('template_admin/topbar', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/report_perkelas', $data);
        $this->load->view('template_admin/footer');
    }


}
