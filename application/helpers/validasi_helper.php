<?php
function check_login()
{
    $ini = get_instance();
    if (!$ini->session->userdata('token')) {
        show_404();
    } else {
        $id_level = $ini->session->userdata('id_level');
        $url = $ini->uri->segment(1);

        $queryMenu = $ini->db->get_where('menu', ['url' => $url])->row_array();
        $id_menu = $queryMenu['id_menu'];

        $queryAksesMenu = $ini->db->get_where('aksesmenu', [
            'id_level' => $id_level,
            'id_menu' => $id_menu
        ]);

        if ($queryAksesMenu->num_rows() < 1) {
            show_404();
        }
    }
}
function check_username()
{
    $ini = get_instance();
    $token = $ini->session->userdata('token');
    $queryUsername = $ini->db->get_where('pengguna', ['token' => $token]);
    $queryEmail = $ini->db->get_where('pemesan', ['token' => $token]);
    if ($queryUsername->num_rows() == 1) {
        $queryUsername = $ini->db->get_where('pengguna', ['token' => $token])->row_array();
        $username = $queryUsername['username'];
    } else if ($queryEmail->num_rows() == 1) {
        $queryEmail = $ini->db->get_where('pemesan', ['token' => $token])->row_array();
        $username = $queryEmail['email'];
    }

    return $username;
}


function check_jeniskelamin($id_jeniskelamin = '1')
{
    if ($id_jeniskelamin == '1') {
        return 'Laki-laki';
    } else {
        return 'Perempuan';
    }
}

function tanggal_indo($tanggal, $cetak_hari = false)
{
    $hari = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split       = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}


function get_token($panjang)
{
    $randomkode = array(
        range(1, 9),
        range('a', 'z'),
        range('A', 'Z')
    );
    $karakter = array();
    foreach ($randomkode as $key => $val) {
        foreach ($val as $k => $v) {
            $karakter[] = $v;
        }
    }
    $randomkode = null;
    for ($i = 1; $i <= $panjang; $i++) {
        // mengambil array secara acak
        $randomkode .= $karakter[rand($i, count($karakter) - 1)];
    }
    return $randomkode;
}
function rupiah($harga)
{

    $hasil_rupiah = "Rp " . number_format($harga, 2, ',', '.');
    return $hasil_rupiah;
}
function tipe($id_tipe = '1')
{
    if ($id_tipe == '1') {
        return "Fasilitas Kegiatan";
    } else {
        return "Fasilitas Penginapan";
    }
}
function check_loginpemesan()
{
    $ini = get_instance();
    if (!$ini->session->userdata('token')) {
        show_404();
    } else {
        $id_level = $ini->session->userdata('id_level');
        $url = $ini->uri->segment(1);

        $queryMenu = $ini->db->get_where('menu', ['url' => $url])->row_array();
        $id_menu = $queryMenu['id_menu'];

        $queryAksesMenu = $ini->db->get_where('aksesmenu', [
            'id_level' => $id_level,
            'id_menu' => $id_menu
        ]);

        if ($queryAksesMenu->num_rows() < 1) {
            show_404();
        }
    }
}
function check_email()
{
    $ini = get_instance();
    $token = $ini->session->userdata('token');
    $queryUsername = $ini->db->get_where('pemesan', ['token' => $token])->row_array();
    $email = $queryUsername['email'];

    return $email;
}
