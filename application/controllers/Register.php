<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('Pemesanan_model');
        $this->load->model('Kegiatan_model');
        $this->load->model('Sewafasilitas_model');
        $this->load->model('Pesankonsumsi_model');
        $this->load->model('Petugaskegiatan_model');
        $this->load->model('Jadwalpetugas_model');
        $this->load->model('Pembayaran_model');
        $this->load->model('Buktipembayaran_model');

        check_login();
        $this->load->helper('string');
    }

    //REGISTER INDEX
    public function index()
    {

        redirect(base_url());
    }
    // pemesanan
    public function pemesanan()
    {

        $data['judul'] = 'Pemesanan';
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

        $data['pemesanan'] = $this->Pemesanan_model->getAllpemesanan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('register/pemesanan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_pemesanan()
    {

        $data['judul'] = 'Pemesanan';
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

        $data['pemesanan'] = $this->Pemesanan_model->getAllpemesanan();
        $data['pemesan'] = $this->db->get('pemesan')->result_array();

        $this->form_validation->set_rules('kode_pemesanan', 'Kode', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('id_pemesan', 'Pemesan', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('register/tambah_pemesanan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Pemesanan_model->tambahDatapemesanan();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('register/pemesanan');
        }
    }

    public function ubah_pemesanan($id_pemesanan)
    {

        $data['judul'] = 'Pemesanan';
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

        $data['pemesanan'] = $this->Pemesanan_model->getpemesananById($id_pemesanan);
        $data['pemesan'] = $this->db->get('pemesan')->result_array();

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('id_pemesan', 'Pemesan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('register/ubah_pemesanan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Pemesanan_model->ubahDatapemesanan();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('register/pemesanan');
        }
    }

    public function hapus_pemesanan($id_pemesanan)
    {

        $this->Pemesanan_model->hapusDatapemesanan($id_pemesanan);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('register/pemesanan');
    }

    public function detail_pemesanan($id_pemesanan)
    {
        $data['judul'] = 'Pemesanan';
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

        $data['pemesanan'] = $this->Pemesanan_model->getpemesananById($id_pemesanan);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('register/detail_pemesanan', $data);
        $this->load->view('templates/footer', $data);
    }
    //kegiatan
    public function kegiatan()
    {

        $data['judul'] = 'Kegiatan';
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

        //$data['kegiatan'] = $this->Kegiatan_model->getAllkegiatan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('register/kegiatan', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_kegiatan($id_pemesanan)
    {

        $data['judul'] = 'Tambah Kegiatan';
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

        $data['kegiatan'] = $this->Kegiatan_model->getAllkegiatan();
        $data['id_pemesanan'] = $id_pemesanan;

        $this->form_validation->set_rules('id_pemesanan', 'Pemesanan', 'required');
        $this->form_validation->set_rules('kode_kegiatan', 'Kode', 'required');
        $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('dari_tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('sampai_tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('jumlah_orang', 'jumlah_orang', 'required');
        $this->form_validation->set_rules('dari_jam', 'Dari Jam', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('register/tambah_kegiatan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_pemesanan = $this->input->post('id_pemesanan', true);
            $this->Kegiatan_model->tambahDatakegiatan();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('register/detail_pemesanan/' . $id_pemesanan);
        }
    }

    public function hapus_kegiatan($id_kegiatan, $id_pemesanan)
    {

        $this->Kegiatan_model->hapusDatakegiatan($id_kegiatan);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('register/detail_pemesanan/' . $id_pemesanan);
    }
    //sewafasilitas
    public function sewafasilitas()
    {

        $data['judul'] = 'Sewa Fasilitas';
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

        //$data['kegiatan'] = $this->Kegiatan_model->getAllkegiatan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('register/sewafasilitas', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_sewafasilitas($id_pemesanan, $id_tipe)
    {

        $data['judul'] = 'Tambah Sewa Fasilitas';
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

        $data['sewafasilitas'] = $this->Sewafasilitas_model->getAllsewafasilitas();
        $data['id_pemesanan'] = $id_pemesanan;
        $data['id_tipe'] = $id_tipe;

        $this->form_validation->set_rules('id_pemesanan', 'Pemesanan', 'required');
        $this->form_validation->set_rules('kode_sewafasilitas', 'Kode', 'required');
        $this->form_validation->set_rules('id_kegiatan', 'Kegiatan', 'required');
        $this->form_validation->set_rules('id_hargafasilitas', 'Fasilitas', 'required');
        $this->form_validation->set_rules('jumlah_orang', 'Jumlah Orang', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('register/tambah_sewafasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_pemesanan = $this->input->post('id_pemesanan', true);
            $this->Sewafasilitas_model->tambahDatasewafasilitas();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('register/detail_pemesanan/' . $id_pemesanan);
        }
    }

    public function hapus_sewafasilitas($id_sewafasilitas, $id_pemesanan)
    {

        $this->Sewafasilitas_model->hapusDatasewafasilitas($id_sewafasilitas);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('register/detail_pemesanan/' . $id_pemesanan);
    }

    //pesankonsumsi
    public function tambah_pesankonsumsi($id_pemesanan)
    {

        $data['judul'] = 'Tambah Pesan Konsumsi';
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

        $data['pesankonsumsi'] = $this->Pesankonsumsi_model->getAllpesankonsumsi();
        $data['id_pemesanan'] = $id_pemesanan;

        $this->form_validation->set_rules('id_pemesanan', 'Pemesanan', 'required');
        $this->form_validation->set_rules('kode_pesankonsumsi', 'Kode', 'required');
        $this->form_validation->set_rules('id_kegiatan', 'Kegiatan', 'required');
        $this->form_validation->set_rules('id_konsumsi', 'Fasilitas', 'required');
        $this->form_validation->set_rules('jumlah_orang', 'Jumlah Orang', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('register/tambah_pesankonsumsi', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_pemesanan = $this->input->post('id_pemesanan', true);
            $this->Pesankonsumsi_model->tambahDatapesankonsumsi();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('register/detail_pemesanan/' . $id_pemesanan);
        }
    }

    public function hapus_pesankonsumsi($id_pesankonsumsi, $id_pemesanan)
    {

        $this->Pesankonsumsi_model->hapusDatapesankonsumsi($id_pesankonsumsi);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('register/detail_pemesanan/' . $id_pemesanan);
    }

    //petugaskegiatan
    public function petugaskegiatan()
    {

        $data['judul'] = 'Petugas Kegiatan';
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

        //$data['kegiatan'] = $this->Kegiatan_model->getAllkegiatan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('register/petugaskegiatan', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_petugaskegiatan($id_pemesanan)
    {

        $data['judul'] = 'Tambah Petugas Kegiatan';
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

        $data['petugaskegiatan'] = $this->Petugaskegiatan_model->getAllpetugaskegiatan();
        $data['id_pemesanan'] = $id_pemesanan;

        $this->form_validation->set_rules('id_pemesanan', 'Pemesanan', 'required');
        $this->form_validation->set_rules('kode_petugaskegiatan', 'Kode', 'required');
        $this->form_validation->set_rules('id_kegiatan', 'Kegiatan', 'required');
        $this->form_validation->set_rules('id_pegawai', 'Petugas', 'required');
        $this->form_validation->set_rules('tupoksi', 'Tupoksi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('register/tambah_petugaskegiatan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_pemesanan = $this->input->post('id_pemesanan', true);
            $this->Petugaskegiatan_model->tambahDatapetugaskegiatan();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('register/detail_pemesanan/' . $id_pemesanan);
        }
    }

    public function hapus_petugaskegiatan($id_petugaskegiatan, $id_pemesanan)
    {

        $this->Petugaskegiatan_model->hapusDatapetugaskegiatan($id_petugaskegiatan);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('register/detail_pemesanan/' . $id_pemesanan);
    }
    //jadwalpetugas
    public function tambah_jadwalpetugas($id_pemesanan)
    {

        $data['judul'] = 'Tambah Petugas Kegiatan';
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

        $data['jadwalpetugas'] = $this->Jadwalpetugas_model->getAlljadwalpetugas();
        $data['id_pemesanan'] = $id_pemesanan;

        $this->form_validation->set_rules('id_pemesanan', 'Pemesanan', 'required');
        $this->form_validation->set_rules('id_kegiatan', 'Kegiatan', 'required');
        $this->form_validation->set_rules('id_pegawai', 'Petugas', 'required');
        $this->form_validation->set_rules('tanggal_jadwal', 'Jadwal', 'required');
        $this->form_validation->set_rules('dari_jam', 'Dari Jam', 'required');
        $this->form_validation->set_rules('sampai_jam', 'Sampai Jam', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('register/tambah_jadwalpetugas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_pemesanan = $this->input->post('id_pemesanan', true);
            $this->Jadwalpetugas_model->tambahDatajadwalpetugas();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('register/detail_pemesanan/' . $id_pemesanan);
        }
    }

    public function hapus_jadwalpetugas($id_jadwalpetugas, $id_pemesanan)
    {

        $this->Jadwalpetugas_model->hapusDatajadwalpetugas($id_jadwalpetugas);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('register/detail_pemesanan/' . $id_pemesanan);
    }
    //pembayaran
    public function tambah_pembayaran($id_pemesanan)
    {

        $data['judul'] = 'Generate Nomor Pembayaran';
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

        $data['pembayaran'] = $this->Pembayaran_model->getAllpembayaran();
        $data['id_pemesanan'] = $id_pemesanan;

        $this->form_validation->set_rules('id_pemesanan', 'Pemesanan', 'required');
        $this->form_validation->set_rules('kode_pembayaran', 'No Pembayaran', 'required');
        $this->form_validation->set_rules('id_bank', 'Bank Tujuan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('register/tambah_pembayaran', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_pemesanan = $this->input->post('id_pemesanan', true);
            $this->Pembayaran_model->tambahDatapembayaran();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('register/detail_pemesanan/' . $id_pemesanan);
        }
    }

    public function hapus_pembayaran($id_pembayaran, $id_pemesanan)
    {

        $this->Pembayaran_model->hapusDatapembayaran($id_pembayaran);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('register/detail_pemesanan/' . $id_pemesanan);
    }
    //buktipembayaran
    public function tambah_buktipembayaran($id_pemesanan, $id_pembayaran)
    {

        $data['judul'] = 'Bukti Pembayaran';
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

        $data['buktipembayaran'] = $this->Buktipembayaran_model->getAllbuktipembayaran();
        $data['id_pemesanan'] = $id_pemesanan;
        $data['id_pembayaran'] = $id_pembayaran;

        $this->form_validation->set_rules('id_pembayaran', 'Pembayaran', 'required');
        $this->form_validation->set_rules('tanggal_pembayaran', 'Tanggal Pembayaran', 'required');
        $this->form_validation->set_rules('bank_pengirim', 'Bank Pengirim', 'required');
        $this->form_validation->set_rules('rekening_pengirim', 'No Rekening Pengirim', 'required');
        $this->form_validation->set_rules('nama_pengirim', 'Nama Pengirim', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('register/tambah_buktipembayaran', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->load->helper('string');
            $uploadbukti = $_FILES['bukti']['name'];
            $acak = random_string('alnum', 16);
            $file_baru = $acak . "." . pathinfo($uploadbukti, PATHINFO_EXTENSION);
            if ($uploadbukti) {
                $config['file_name'] = $file_baru;
                $config['allowed_types'] = 'pdf|gif|jpg|jpeg|png';
                $config['max_size'] = '5000';
                $config['upload_path'] = './documents/';
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('bukti')) {
                $id_pemesanan = $this->input->post('id_pemesanan', true);
                $this->Buktipembayaran_model->tambahDatabuktipembayaran($file_baru);
                $this->session->set_flashdata('flashdata', 'ditambahkan');
                redirect('register/detail_pemesanan/' . $id_pemesanan);
            } else {
                $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-danger role="alert">Gagal melakukan upload!</div>');
                echo "<script>history.go(-1);</script>";
            }
        }
    }

    public function hapus_buktipembayaran($id_buktipembayaran, $id_pemesanan)
    {

        $this->Buktipembayaran_model->hapusDatabuktipembayaran($id_buktipembayaran);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('register/detail_pemesanan/' . $id_pemesanan);
    }
}
