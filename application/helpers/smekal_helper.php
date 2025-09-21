<?php
function cek_login($rol_id)
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {

        redirect('auth');
    }
    if ($ci->session->userdata('role_id') !== $rol_id) {
        if ($ci->session->userdata('role_id') == '1') {
            redirect('admin');
        } elseif ($ci->session->userdata('role_id') == '2') {
            redirect('kepsek');
        } elseif ($ci->session->userdata('role_id') == '3') {
            redirect('waka');
        } elseif ($ci->session->userdata('role_id') == '4') {
            redirect('guru');
        } elseif ($ci->session->userdata('role_id') == '5') {
            redirect('siswa');
        } elseif ($ci->session->userdata('role_id') == '6') {
            redirect('ppdb');
        }elseif ($ci->session->userdata('role_id') == '7') {
            redirect('piket');
        }
    }
}
