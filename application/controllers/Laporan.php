<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();

        check_login();
    }

    //LAPORAN INDEX
    public function index()
    {

        redirect(base_url());
    }
    // PEGAWAI
    public function pegawai()
    {

        $data['judul'] = 'Laporan Pegawai';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['masterjabatan'] = $this->db->get('jabatan')->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('id_jabatan', 'Filter Jabatan', 'required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/pegawai', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['input_jabatan'] = $this->input->post('id_jabatan', true);
            $data['input_urutan'] = $this->input->post('urutan', true);
            if ($data['input_jabatan'] == 'Semua') {
                $data['filter'] = $this->db->query('SELECT * FROM pegawai ORDER BY id_jabatan ' . $data['input_urutan'])->result_array();
            } else {
                $data['filter'] = $this->db->query('SELECT * FROM pegawai WHERE id_jabatan=' . $data['input_jabatan'] . ' ORDER BY id_jabatan ' . $data['input_urutan'])->result_array();
            }
            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/pegawai', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK PEGAWAI
    public function cetakpegawai()
    {

        $data['judul'] = 'LaporanPegawai';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['input_jabatan'] = $this->input->post('id_jabatan', true);
        $data['input_urutan'] = $this->input->post('urutan', true);
        if ($data['input_jabatan'] == 'Semua') {
            $data['filter'] = $this->db->query('SELECT * FROM pegawai ORDER BY id_jabatan ' . $data['input_urutan'])->result_array();
        } else {
            $data['filter'] = $this->db->query('SELECT * FROM pegawai WHERE id_jabatan=' . $data['input_jabatan'] . ' ORDER BY id_jabatan ' . $data['input_urutan'])->result_array();
        }

        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('id_jabatan', 'Filter Jabatan', 'required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetakpegawai', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/pegawai');
        }
    }
    // pemesan
    public function pemesan()
    {

        $data['judul'] = 'Laporan Pemesan';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('id_jabatan', 'Filter Jabatan', 'required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/pemesan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['input_jabatan'] = $this->input->post('id_jabatan', true);
            $data['input_urutan'] = $this->input->post('urutan', true);
            $data['filter'] = $this->db->query('SELECT * FROM pemesan ORDER BY id_pemesan ' . $data['input_urutan'])->result_array();
            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/pemesan', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK pemesan
    public function cetakpemesan()
    {

        $data['judul'] = 'Laporan Pemesan';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['input_jabatan'] = $this->input->post('id_jabatan', true);
        $data['input_urutan'] = $this->input->post('urutan', true);
        $data['filter'] = $this->db->query('SELECT * FROM pemesan ORDER BY id_pemesan ' . $data['input_urutan'])->result_array();


        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('id_jabatan', 'Filter Jabatan', 'required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetakpemesan', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/pemesan');
        }
    }
    // fasilitas
    public function fasilitas()
    {

        $data['judul'] = 'Laporan Fasilitas';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['jenisfasilitas'] = $this->db->get('jenisfasilitas')->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();

        $this->form_validation->set_rules('id_jenisfasilitas', 'Jenis fasilitas', 'required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/fasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['input_jenisfasilitas'] = $this->input->post('id_jenisfasilitas', true);
            $data['input_urutan'] = $this->input->post('urutan', true);
            if ($data['input_jenisfasilitas'] == 'Semua') {
                $data['filter'] = $this->db->query('SELECT * FROM fasilitas ORDER BY id_jenisfasilitas ' . $data['input_urutan'])->result_array();
            } else {
                $data['filter'] = $this->db->query('SELECT * FROM fasilitas WHERE id_jenisfasilitas=' . $data['input_jenisfasilitas'] . ' ORDER BY id_jenisfasilitas ' . $data['input_urutan'])->result_array();
            }
            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/fasilitas', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK fasilitas
    public function cetakfasilitas()
    {

        $data['judul'] = 'Laporan Fasilitas';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['input_jenisfasilitas'] = $this->input->post('id_jenisfasilitas', true);
        $data['input_urutan'] = $this->input->post('urutan', true);
        if ($data['input_jenisfasilitas'] == 'Semua') {
            $data['filter'] = $this->db->query('SELECT * FROM fasilitas ORDER BY id_jenisfasilitas ' . $data['input_urutan'])->result_array();
        } else {
            $data['filter'] = $this->db->query('SELECT * FROM fasilitas WHERE id_jenisfasilitas=' . $data['input_jenisfasilitas'] . ' ORDER BY id_jenisfasilitas ' . $data['input_urutan'])->result_array();
        }

        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('id_jenisfasilitas', 'Jenis fasilitas', 'required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetakfasilitas', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/fasilitas');
        }
    }
    // hargafasilitas
    public function hargafasilitas()
    {

        $data['judul'] = 'Laporan Harga Fasilitas';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['fasilitas'] = $this->db->get('fasilitas')->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();

        $this->form_validation->set_rules('id_fasilitas', 'Jenis hargafasilitas', 'required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/hargafasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['input_fasilitas'] = $this->input->post('id_fasilitas', true);
            $data['input_urutan'] = $this->input->post('urutan', true);
            if ($data['input_fasilitas'] == 'Semua') {
                $data['filter'] = $this->db->query('SELECT * FROM hargafasilitas ORDER BY id_fasilitas ' . $data['input_urutan'])->result_array();
            } else {
                $data['filter'] = $this->db->query('SELECT * FROM hargafasilitas WHERE id_fasilitas=' . $data['input_fasilitas'] . ' ORDER BY id_fasilitas ' . $data['input_urutan'])->result_array();
            }
            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/hargafasilitas', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK hargafasilitas
    public function cetakhargafasilitas()
    {

        $data['judul'] = 'Laporan Harga Fasilitas';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['input_fasilitas'] = $this->input->post('id_fasilitas', true);
        $data['input_urutan'] = $this->input->post('urutan', true);
        if ($data['input_fasilitas'] == 'Semua') {
            $data['filter'] = $this->db->query('SELECT * FROM hargafasilitas ORDER BY id_fasilitas ' . $data['input_urutan'])->result_array();
        } else {
            $data['filter'] = $this->db->query('SELECT * FROM hargafasilitas WHERE id_fasilitas=' . $data['input_fasilitas'] . ' ORDER BY id_fasilitas ' . $data['input_urutan'])->result_array();
        }

        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('id_fasilitas', 'Jenis hargafasilitas', 'required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetakhargafasilitas', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/hargafasilitas');
        }
    }
    // pemesanan
    public function pemesanan()
    {

        $data['judul'] = 'Laporan Pemesanan';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['pemesanan'] = $this->db->get('pemesanan')->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/pemesanan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['periode'] = $this->input->post('periode', true);
            $split = explode(' - ', $data['periode']);

            #check make sure have 2 elements in array
            $count = count($split);
            if ($count <> 2) {
                #invalid data
            }

            $dariTanggal = $split[0];
            $sampaiTanggal = $split[1];
            $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
            $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));


            $data['filter'] = $this->db->query("SELECT * FROM `pemesanan` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();

            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/pemesanan', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK pemesanan
    public function cetakpemesanan()
    {

        $data['judul'] = 'Laporan Pemesanan';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['periode'] = $this->input->post('periode', true);
        $split = explode(' - ', $data['periode']);

        #check make sure have 2 elements in array
        $count = count($split);
        if ($count <> 2) {
            #invalid data
        }

        $dariTanggal = $split[0];
        $sampaiTanggal = $split[1];
        $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
        $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));

        $data['filter'] = $this->db->query("SELECT * FROM `pemesanan` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetakpemesanan', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/pemesanan');
        }
    }
    // kegiatan
    public function kegiatan()
    {

        $data['judul'] = 'Laporan Kegiatan';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['kegiatan'] = $this->db->get('kegiatan')->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/kegiatan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['periode'] = $this->input->post('periode', true);
            $split = explode(' - ', $data['periode']);

            #check make sure have 2 elements in array
            $count = count($split);
            if ($count <> 2) {
                #invalid data
            }

            $dariTanggal = $split[0];
            $sampaiTanggal = $split[1];
            $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
            $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));


            $data['filter'] = $this->db->query("SELECT * FROM `kegiatan` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();

            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/kegiatan', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK kegiatan
    public function cetakkegiatan()
    {

        $data['judul'] = 'Laporan Kegiatan';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['periode'] = $this->input->post('periode', true);
        $split = explode(' - ', $data['periode']);

        #check make sure have 2 elements in array
        $count = count($split);
        if ($count <> 2) {
            #invalid data
        }

        $dariTanggal = $split[0];
        $sampaiTanggal = $split[1];
        $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
        $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));

        $data['filter'] = $this->db->query("SELECT * FROM `kegiatan` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetakkegiatan', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/kegiatan');
        }
    }
    // sewafasilitas
    public function sewafasilitas()
    {

        $data['judul'] = 'Laporan Sewa Fasilitas';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['sewafasilitas'] = $this->db->get('sewafasilitas')->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/sewafasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['periode'] = $this->input->post('periode', true);
            $split = explode(' - ', $data['periode']);

            #check make sure have 2 elements in array
            $count = count($split);
            if ($count <> 2) {
                #invalid data
            }

            $dariTanggal = $split[0];
            $sampaiTanggal = $split[1];
            $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
            $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));


            $data['filter'] = $this->db->query("SELECT * FROM `sewafasilitas` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();

            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/sewafasilitas', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK sewafasilitas
    public function cetaksewafasilitas()
    {

        $data['judul'] = 'Laporan Sewa Fasilitas';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['periode'] = $this->input->post('periode', true);
        $split = explode(' - ', $data['periode']);

        #check make sure have 2 elements in array
        $count = count($split);
        if ($count <> 2) {
            #invalid data
        }

        $dariTanggal = $split[0];
        $sampaiTanggal = $split[1];
        $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
        $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));

        $data['filter'] = $this->db->query("SELECT * FROM `sewafasilitas` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetaksewafasilitas', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/sewafasilitas');
        }
    }
    // pesankonsumsi
    public function pesankonsumsi()
    {

        $data['judul'] = 'Laporan Pesan Konsumsi';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['pesankonsumsi'] = $this->db->get('pesankonsumsi')->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/pesankonsumsi', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['periode'] = $this->input->post('periode', true);
            $split = explode(' - ', $data['periode']);

            #check make sure have 2 elements in array
            $count = count($split);
            if ($count <> 2) {
                #invalid data
            }

            $dariTanggal = $split[0];
            $sampaiTanggal = $split[1];
            $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
            $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));


            $data['filter'] = $this->db->query("SELECT * FROM `pesankonsumsi` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();

            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/pesankonsumsi', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK pesankonsumsi
    public function cetakpesankonsumsi()
    {

        $data['judul'] = 'Laporan Pesan Konsumsi';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['periode'] = $this->input->post('periode', true);
        $split = explode(' - ', $data['periode']);

        #check make sure have 2 elements in array
        $count = count($split);
        if ($count <> 2) {
            #invalid data
        }

        $dariTanggal = $split[0];
        $sampaiTanggal = $split[1];
        $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
        $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));

        $data['filter'] = $this->db->query("SELECT * FROM `pesankonsumsi` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetakpesankonsumsi', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/pesankonsumsi');
        }
    }
    // petugaskegiatan
    public function petugaskegiatan()
    {

        $data['judul'] = 'Laporan Petugas Kegiatan';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['petugaskegiatan'] = $this->db->get('petugaskegiatan')->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/petugaskegiatan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['periode'] = $this->input->post('periode', true);
            $split = explode(' - ', $data['periode']);

            #check make sure have 2 elements in array
            $count = count($split);
            if ($count <> 2) {
                #invalid data
            }

            $dariTanggal = $split[0];
            $sampaiTanggal = $split[1];
            $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
            $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));


            $data['filter'] = $this->db->query("SELECT * FROM `petugaskegiatan` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();

            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/petugaskegiatan', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK petugaskegiatan
    public function cetakpetugaskegiatan()
    {

        $data['judul'] = 'Laporan Petugas Kegiatan';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['periode'] = $this->input->post('periode', true);
        $split = explode(' - ', $data['periode']);

        #check make sure have 2 elements in array
        $count = count($split);
        if ($count <> 2) {
            #invalid data
        }

        $dariTanggal = $split[0];
        $sampaiTanggal = $split[1];
        $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
        $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));

        $data['filter'] = $this->db->query("SELECT * FROM `petugaskegiatan` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetakpetugaskegiatan', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/petugaskegiatan');
        }
    }
    // jadwalpetugas
    public function jadwalpetugas()
    {

        $data['judul'] = 'Laporan Jadwal Petugas';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['jadwalpetugas'] = $this->db->get('jadwalpetugas')->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/jadwalpetugas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['periode'] = $this->input->post('periode', true);
            $split = explode(' - ', $data['periode']);

            #check make sure have 2 elements in array
            $count = count($split);
            if ($count <> 2) {
                #invalid data
            }

            $dariTanggal = $split[0];
            $sampaiTanggal = $split[1];
            $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
            $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));


            $data['filter'] = $this->db->query("SELECT * FROM `jadwalpetugas` WHERE `tanggal_jadwal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal_jadwal ASC")->result_array();

            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/jadwalpetugas', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK jadwalpetugas
    public function cetakjadwalpetugas()
    {

        $data['judul'] = 'Laporan Jadwal Petugas';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['periode'] = $this->input->post('periode', true);
        $split = explode(' - ', $data['periode']);

        #check make sure have 2 elements in array
        $count = count($split);
        if ($count <> 2) {
            #invalid data
        }

        $dariTanggal = $split[0];
        $sampaiTanggal = $split[1];
        $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
        $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));

        $data['filter'] = $this->db->query("SELECT * FROM `jadwalpetugas` WHERE `tanggal_jadwal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal_jadwal ASC")->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetakjadwalpetugas', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/jadwalpetugas');
        }
    }
    // pembayaran
    public function pembayaran()
    {

        $data['judul'] = 'Laporan Pembayaran';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['pembayaran'] = $this->db->get('pembayaran')->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/pembayaran', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['periode'] = $this->input->post('periode', true);
            $split = explode(' - ', $data['periode']);

            #check make sure have 2 elements in array
            $count = count($split);
            if ($count <> 2) {
                #invalid data
            }

            $dariTanggal = $split[0];
            $sampaiTanggal = $split[1];
            $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
            $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));


            $data['filter'] = $this->db->query("SELECT * FROM `pembayaran` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();

            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/pembayaran', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK pembayaran
    public function cetakpembayaran()
    {

        $data['judul'] = 'Laporan Pembayaran';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['periode'] = $this->input->post('periode', true);
        $split = explode(' - ', $data['periode']);

        #check make sure have 2 elements in array
        $count = count($split);
        if ($count <> 2) {
            #invalid data
        }

        $dariTanggal = $split[0];
        $sampaiTanggal = $split[1];
        $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
        $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));

        $data['filter'] = $this->db->query("SELECT * FROM `pembayaran` WHERE `tanggal` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal ASC")->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetakpembayaran', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/pembayaran');
        }
    }
    // buktipembayaran
    public function buktipembayaran()
    {

        $data['judul'] = 'Laporan Bukti Pembayaran';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['buktipembayaran'] = $this->db->get('buktipembayaran')->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/buktipembayaran', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['periode'] = $this->input->post('periode', true);
            $split = explode(' - ', $data['periode']);

            #check make sure have 2 elements in array
            $count = count($split);
            if ($count <> 2) {
                #invalid data
            }

            $dariTanggal = $split[0];
            $sampaiTanggal = $split[1];
            $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
            $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));


            $data['filter'] = $this->db->query("SELECT * FROM `buktipembayaran` WHERE `tanggal_pembayaran` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal_pembayaran ASC")->result_array();

            $this->session->set_flashdata('flashdata', 'ditampilkan');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/buktipembayaran', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    // CETAK buktipembayaran
    public function cetakbuktipembayaran()
    {

        $data['judul'] = 'Laporan Bukti Pembayaran';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['periode'] = $this->input->post('periode', true);
        $split = explode(' - ', $data['periode']);

        #check make sure have 2 elements in array
        $count = count($split);
        if ($count <> 2) {
            #invalid data
        }

        $dariTanggal = $split[0];
        $sampaiTanggal = $split[1];
        $data['dariTanggal'] = date('Y-m-d', strtotime($dariTanggal));
        $data['sampaiTanggal'] = date('Y-m-d', strtotime($sampaiTanggal));

        $data['filter'] = $this->db->query("SELECT * FROM `buktipembayaran` WHERE `tanggal_pembayaran` BETWEEN '" . $data['dariTanggal'] . "' AND '" . $data['sampaiTanggal'] . "' ORDER BY tanggal_pembayaran ASC")->result_array();
        $data['profil'] = $this->db->get_where('profil')->row_array();


        $this->form_validation->set_rules('periode', 'Periode', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->load->view('templates/laporan_header', $data);
            $this->load->view('laporan/cetakbuktipembayaran', $data);
            $this->load->view('templates/laporan_footer', $data);
        } else {
            redirect('laporan/buktipembayaran');
        }
    }
}
