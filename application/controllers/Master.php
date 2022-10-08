<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Bank_model');
        $this->load->model('Mitra_model');
        $this->load->model('Submenu_model');
        $this->load->model('Level_model');
        $this->load->model('Aksesmenu_model');
        $this->load->model('Pengguna_model');
        $this->load->model('Jabatan_model');
        $this->load->model('JenisFasilitas_model');
        $this->load->model('Kategorifasilitas_model');
        $this->load->model('Fasilitas_model');
        $this->load->model('Fotofasilitas_model');
        $this->load->model('Hargafasilitas_model');
        $this->load->model('Pemesan_model');
        $this->load->model('Konsumsi_model');

        $this->load->helper('string');

        $this->load->model('Pegawai_model');

        check_login();
    }

    //MASTER INDEX
    public function index()
    {

        redirect(base_url());
    }
    //MENU
    public function menu()
    {

        $data['judul'] = 'Menu';
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

        $data['menu'] = $this->Menu_model->getAllMenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/menu', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_menu()
    {

        $data['judul'] = 'Menu';
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

        $data['menu'] = $this->Menu_model->getAllMenu();

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_menu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Menu_model->tambahDataMenu();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/menu');
        }
    }

    public function ubah_menu($id_menu)
    {

        $data['judul'] = 'Menu';
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

        $data['menu'] = $this->Menu_model->getMenuById($id_menu);

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_menu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Menu_model->ubahDataMenu();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/menu');
        }
    }

    public function hapus_menu($id_menu)
    {

        $this->Menu_model->hapusDataMenu($id_menu);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/menu');
    }

    public function detail_menu($id_menu)
    {
        $data['judul'] = 'Menu';
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

        $data['menu'] = $this->Menu_model->getMenuById($id_menu);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_menu', $data);
        $this->load->view('templates/footer', $data);
    }

    // SUB MENU
    public function submenu()
    {

        $data['judul'] = 'Sub Menu';
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

        $data['submenu'] = $this->Submenu_model->getAllsubmenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/submenu', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_submenu()
    {

        $data['judul'] = 'Sub Menu';
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

        $data['submenu'] = $this->Submenu_model->getAllsubmenu();
        $data['menu'] = $this->db->get('menu')->result_array();


        $this->form_validation->set_rules('id_menu', 'Menu', 'required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_submenu', 'Nama Submenu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_submenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Submenu_model->tambahDataSubmenu();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/submenu');
        }
    }

    public function ubah_submenu($id_submenu)
    {

        $data['judul'] = 'Sub Menu';
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

        $data['submenu'] = $this->Submenu_model->getSubmenuById($id_submenu);
        $data['menu'] = $this->db->get('menu')->result_array();

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_submenu', 'Nama Submenu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_submenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Submenu_model->ubahDataSubmenu();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/submenu');
        }
    }

    public function hapus_submenu($id_submenu)
    {

        $this->Submenu_model->hapusDataSubmenu($id_submenu);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/submenu');
    }

    public function detail_submenu($id_submenu)
    {
        $data['judul'] = 'Sub Menu';
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

        $data['submenu'] = $this->Submenu_model->getSubmenuById($id_submenu);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_submenu', $data);
        $this->load->view('templates/footer', $data);
    }

    //LEVEL
    public function level()
    {

        $data['judul'] = 'Level';
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

        $data['levelakses'] = $this->Level_model->getAllLevel();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/level', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_level()
    {

        $data['judul'] = 'Level';
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

        $data['levelakses'] = $this->Level_model->getAllLevel();

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_level', 'Nama Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_level', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Level_model->tambahDataLevel();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/level');
        }
    }

    public function ubah_level($id_level)
    {

        $data['judul'] = 'Level';
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

        $data['levelakses'] = $this->Level_model->getLevelById($id_level);

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_level', 'Nama Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_level', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Level_model->ubahDataLevel();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/level');
        }
    }

    public function hapus_level($id_level)
    {

        $this->Level_model->hapusDataLevel($id_level);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/level');
    }

    public function detail_level($id_level)
    {
        $data['judul'] = 'Akses Menu';
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

        $data['levelakses'] = $this->db->get_where('level', ['id_level' => $id_level])->row_array();

        $data['menu'] = $this->Menu_model->getAllMenu();

        $this->form_validation->set_rules('id_level', 'Id Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/detail_level', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Aksesmenu_model->SimpanAksesMenu();
            $this->session->set_flashdata('flashdata', 'diperbaharui');
            redirect('master/level');
        }
    }
    // PENGGUNA
    public function pengguna()
    {

        $data['judul'] = 'Pengguna';
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

        $data['masterpengguna'] = $this->Pengguna_model->getAllPengguna();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/pengguna', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_pengguna()
    {

        $data['judul'] = 'Pengguna';
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

        $data['masterpengguna'] = $this->Pengguna_model->getAllPengguna();
        $data['masterlevel'] = $this->db->get('level')->result_array();
        $data['masterpegawai'] = $this->db->get('pegawai')->result_array();


        $this->form_validation->set_rules('id_level', 'Level', 'required');
        $this->form_validation->set_rules('id_pegawai', 'Pegawai', 'required');
        $this->form_validation->set_rules('nama_pengguna', 'Nama pengguna', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_pengguna', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Pengguna_model->tambahDataPengguna();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/pengguna');
        }
    }

    public function ubah_pengguna($id_pengguna)
    {

        $data['judul'] = 'Pengguna';
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

        $data['masterpengguna'] = $this->Pengguna_model->getPenggunaById($id_pengguna);
        $data['masterlevel'] = $this->db->get('level')->result_array();

        $this->form_validation->set_rules('id_level', 'Level', 'required');
        $this->form_validation->set_rules('nama_pengguna', 'Nama pengguna', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_pengguna', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Pengguna_model->ubahDataPengguna();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/pengguna');
        }
    }

    public function hapus_pengguna($id_pengguna)
    {

        $this->Pengguna_model->hapusDataPengguna($id_pengguna);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/pengguna');
    }

    public function detail_pengguna($id_pengguna)
    {
        $data['judul'] = 'Pengguna';
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

        $data['masterpengguna'] = $this->Pengguna_model->getPenggunaById($id_pengguna);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_pengguna', $data);
        $this->load->view('templates/footer', $data);
    }

    //JABATAN
    public function jabatan()
    {

        $data['judul'] = 'Jabatan';
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

        $data['masterjabatan'] = $this->Jabatan_model->getAllJabatan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/jabatan', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_jabatan()
    {

        $data['judul'] = 'Jabatan';
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

        $data['masterjabatan'] = $this->Jabatan_model->getAllJabatan();

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_jabatan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Jabatan_model->tambahDataJabatan();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/jabatan');
        }
    }

    public function ubah_jabatan($id_jabatan)
    {

        $data['judul'] = 'Jabatan';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_pegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
        $masterid_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $masterid_jabatan])->row_array();

        $data['masterjabatan'] = $this->Jabatan_model->getjabatanById($id_jabatan);

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_jabatan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Jabatan_model->ubahDataJabatan();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/jabatan');
        }
    }
    public function hapus_jabatan($id_jabatan)
    {

        $this->Jabatan_model->hapusDataJabatan($id_jabatan);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/jabatan');
    }

    public function detail_jabatan($id_jabatan)
    {
        $data['judul'] = 'Jabatan';
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

        $data['masterjabatan'] = $this->Jabatan_model->getjabatanById($id_jabatan);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_jabatan', $data);
        $this->load->view('templates/footer', $data);
    }

    //jenisfasilitas
    public function jenisfasilitas()
    {

        $data['judul'] = 'Jenis Fasiltias';
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

        $data['jenisfasilitas'] = $this->JenisFasilitas_model->getAlljenisfasilitas();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/jenisfasilitas', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_jenisfasilitas()
    {

        $data['judul'] = 'Jenis Fasiltias';
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

        $data['jenisfasilitas'] = $this->JenisFasilitas_model->getAlljenisfasilitas();

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_jenisfasilitas', 'Nama Jenis fasilitas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_jenisfasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->JenisFasilitas_model->tambahDatajenisfasilitas();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/jenisfasilitas');
        }
    }

    public function ubah_jenisfasilitas($id_jenisfasilitas)
    {

        $data['judul'] = 'Jenis Fasiltias';
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

        $data['jenisfasilitas'] = $this->JenisFasilitas_model->getjenisfasilitasById($id_jenisfasilitas);

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_jenisfasilitas', 'Nama Jenis fasilitas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_jenisfasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->JenisFasilitas_model->ubahDatajenisfasilitas();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/jenisfasilitas');
        }
    }

    public function hapus_jenisfasilitas($id_jenisfasilitas)
    {

        $this->JenisFasilitas_model->hapusDatajenisfasilitas($id_jenisfasilitas);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/jenisfasilitas');
    }

    public function detail_jenisfasilitas($id_jenisfasilitas)
    {
        $data['judul'] = 'Jenis Fasiltias';
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

        $data['jenisfasilitas'] = $this->JenisFasilitas_model->getjenisfasilitasById($id_jenisfasilitas);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_jenisfasilitas', $data);
        $this->load->view('templates/footer', $data);
    }
    // fasilitas
    public function fasilitas()
    {

        $data['judul'] = 'Fasilitas';
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

        $data['fasilitas'] = $this->Fasilitas_model->getAllfasilitas();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/fasilitas', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_fasilitas()
    {

        $data['judul'] = 'Fasilitas';
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

        $data['fasilitas'] = $this->Fasilitas_model->getAllfasilitas();
        $data['jenisfasilitas'] = $this->db->get('jenisfasilitas')->result_array();

        $this->form_validation->set_rules('kode_fasilitas', 'Kode fasilitas', 'required');
        $this->form_validation->set_rules('nama_fasilitas', 'Nama fasilitas', 'required');
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required');
        $this->form_validation->set_rules('id_jenisfasilitas', 'Jenis fasilitas', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_fasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Fasilitas_model->tambahDatafasilitas();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/fasilitas');
        }
    }

    public function ubah_fasilitas($id_fasilitas)
    {

        $data['judul'] = 'Fasilitas';
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

        $data['fasilitas'] = $this->Fasilitas_model->getfasilitasById($id_fasilitas);
        $data['jenisfasilitas'] = $this->db->get('jenisfasilitas')->result_array();

        $this->form_validation->set_rules('nama_fasilitas', 'Nama fasilitas', 'required');
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required');
        $this->form_validation->set_rules('id_jenisfasilitas', 'Jenis fasilitas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_fasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Fasilitas_model->ubahDatafasilitas();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/fasilitas');
        }
    }

    public function hapus_fasilitas($id_fasilitas)
    {

        $this->Fasilitas_model->hapusDatafasilitas($id_fasilitas);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/fasilitas');
    }

    public function detail_fasilitas($id_fasilitas)
    {
        $data['judul'] = 'Fasilitas';
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

        $data['fasilitas'] = $this->Fasilitas_model->getfasilitasById($id_fasilitas);
        $data['fotofasilitas'] = $this->Fotofasilitas_model->getfotofasilitasByIdFasilitas($id_fasilitas);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_fasilitas', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_fotofasilitas($id_fasilitas)
    {

        $data['judul'] = 'Fasilitas';
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

        $data['fasilitas'] = $this->Fasilitas_model->getfasilitasById($id_fasilitas);

        $this->form_validation->set_rules('id_fasilitas', 'Id Fasilitas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_fotofasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $uploadFoto = $_FILES['foto']['name'];
            $acak = random_string('alnum', 16);
            $file_baru = $acak . "." . pathinfo($uploadFoto, PATHINFO_EXTENSION);
            if ($uploadFoto) {
                $config['file_name'] = $file_baru;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '3000';
                $config['upload_path'] = './assets/dist/img/';
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $this->Fotofasilitas_model->tambahDatafotofasilitas($file_baru);
                $this->session->set_flashdata('flashdata', 'ditambahkan');
                redirect('master/detail_fasilitas/' . $id_fasilitas);
            } else {
                $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-danger role="alert">Gagal melakukan upload foto!</div>');
                echo "<script>history.go(-1);</script>";
            }
        }
    }
    public function hapus_fotofasilitas($id_fotofasilitas)
    {
        $fotofasilitas = $this->db->get_where('fotofasilitas', ['id_fotofasilitas' => $id_fotofasilitas])->row_array();
        $id_fasilitas = $fotofasilitas['id_fasilitas'];
        $foto_lama = $fotofasilitas['foto'];
        unlink(FCPATH . './assets/dist/img/' . $foto_lama);
        $this->Fotofasilitas_model->hapusDatafotofasilitas($id_fotofasilitas);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/detail_fasilitas/' . $id_fasilitas);
    }
    // harga fasilitas
    public function hargafasilitas()
    {

        $data['judul'] = 'Harga Fasilitas';
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

        $data['hargafasilitas'] = $this->Hargafasilitas_model->getAllhargafasilitas();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/hargafasilitas', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_hargafasilitas()
    {

        $data['judul'] = 'Harga Fasilitas';
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

        $data['hargafasilitas'] = $this->Hargafasilitas_model->getAllhargafasilitas();
        $data['fasilitas'] = $this->db->get('fasilitas')->result_array();
        $data['kategorifasilitas'] = $this->db->get('kategorifasilitas')->result_array();

        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('id_fasilitas', 'Fasilitas', 'required');
        $this->form_validation->set_rules('id_kategorifasilitas', 'Pengguna Fasilitas', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_hargafasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Hargafasilitas_model->tambahDatahargafasilitas();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/hargafasilitas');
        }
    }

    public function ubah_hargafasilitas($id_hargafasilitas)
    {

        $data['judul'] = 'Harga Fasilitas';
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

        $data['hargafasilitas'] = $this->Hargafasilitas_model->gethargafasilitasById($id_hargafasilitas);
        $data['fasilitas'] = $this->db->get('fasilitas')->result_array();
        $data['kategorifasilitas'] = $this->db->get('kategorifasilitas')->result_array();

        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('id_fasilitas', 'Fasilitas', 'required');
        $this->form_validation->set_rules('id_kategorifasilitas', 'Pengguna Fasilitas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_hargafasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Hargafasilitas_model->ubahDatahargafasilitas();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/hargafasilitas');
        }
    }

    public function hapus_hargafasilitas($id_hargafasilitas)
    {

        $this->Hargafasilitas_model->hapusDatahargafasilitas($id_hargafasilitas);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/hargafasilitas');
    }

    public function detail_hargafasilitas($id_hargafasilitas)
    {
        $data['judul'] = 'Harga Fasilitas';
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

        $data['hargafasilitas'] = $this->Hargafasilitas_model->gethargafasilitasById($id_hargafasilitas);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_hargafasilitas', $data);
        $this->load->view('templates/footer', $data);
    }
    //pengguna fasilitas
    public function kategorifasilitas()
    {

        $data['judul'] = 'Kategori Fasilitas';
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

        $data['kategorifasilitas'] = $this->Kategorifasilitas_model->getAllkategorifasilitas();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/kategorifasilitas', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_kategorifasilitas()
    {

        $data['judul'] = 'Kategori Fasilitas';
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

        $data['kategorifasilitas'] = $this->Kategorifasilitas_model->getAllkategorifasilitas();

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_kategorifasilitas', 'Nama kategorifasilitas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_kategorifasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Kategorifasilitas_model->tambahDatakategorifasilitas();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/kategorifasilitas');
        }
    }

    public function ubah_kategorifasilitas($id_kategorifasilitas)
    {

        $data['judul'] = 'Kategori Fasilitas';
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

        $data['kategorifasilitas'] = $this->Kategorifasilitas_model->getkategorifasilitasById($id_kategorifasilitas);

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_kategorifasilitas', 'Nama kategorifasilitas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_kategorifasilitas', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Kategorifasilitas_model->ubahDatakategorifasilitas();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/kategorifasilitas');
        }
    }

    public function hapus_kategorifasilitas($id_kategorifasilitas)
    {

        $this->Kategorifasilitas_model->hapusDatakategorifasilitas($id_kategorifasilitas);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/kategorifasilitas');
    }

    public function detail_kategorifasilitas($id_kategorifasilitas)
    {
        $data['judul'] = 'Pengguna Fasilitas';
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

        $data['kategorifasilitas'] = $this->Kategorifasilitas_model->getkategorifasilitasById($id_kategorifasilitas);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_kategorifasilitas', $data);
        $this->load->view('templates/footer', $data);
    }
    //PEGAWAI
    public function pegawai()
    {

        $data['judul'] = 'Pegawai';
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

        $data['masterpegawai'] = $this->Pegawai_model->getAllPegawai();
        $data['masterjabatan'] = $this->db->get('jabatan')->result_array();
        $data['mastergolpangkat'] = $this->db->get('golpangkat')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/pegawai', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_pegawai()
    {

        $data['judul'] = 'Pegawai';
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

        $data['masterpegawai'] = $this->Pegawai_model->getAllPegawai();
        $data['masterjabatan'] = $this->db->get('jabatan')->result_array();
        $data['mastergolpangkat'] = $this->db->get('golpangkat')->result_array();

        $this->form_validation->set_rules('nama_pegawai', 'Nama pegawai', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_pegawai', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Pegawai_model->tambahDataPegawai();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/pegawai');
        }
    }

    public function ubah_pegawai($id_pegawai)
    {

        $data['judul'] = 'Pegawai';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_masterpegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_masterpegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['masterpegawai'] = $this->Pegawai_model->getPegawaiById($id_pegawai);
        $data['masterjabatan'] = $this->db->get('jabatan')->result_array();
        $data['mastergolpangkat'] = $this->db->get('golpangkat')->result_array();

        $this->form_validation->set_rules('nama_pegawai', 'Nama pegawai', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_pegawai', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Pegawai_model->ubahDataPegawai();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/pegawai');
        }
    }

    public function hapus_pegawai($id_pegawai)
    {

        $this->Pegawai_model->hapusDataPegawai($id_pegawai);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/pegawai');
    }

    public function detail_pegawai($id_pegawai)
    {
        $data['judul'] = 'Pegawai';
        $data['pengguna'] = $this->db->get_where('pengguna', ['token' => $this->session->userdata('token')])->row_array();
        $data['nama_pengguna'] = $data['pengguna']['nama_pengguna'];
        $data['username'] = $data['pengguna']['username'];
        $data['id_level'] = $data['pengguna']['id_level'];
        $data['level'] = $this->db->get_where('level', ['id_level' => $data['id_level']])->row_array();
        $data['nama_level'] = $data['level']['nama_level'];
        $id_masterpegawai = $data['pengguna']['id_pegawai'];
        $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id_masterpegawai])->row_array();
        $id_jabatan = $data['pegawai']['id_jabatan'];
        $data['jabatan'] = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();

        $data['masterpegawai'] = $this->Pegawai_model->getPegawaiById($id_pegawai);
        $data['masterjabatan'] = $this->db->get('jabatan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_pegawai', $data);
        $this->load->view('templates/footer', $data);
    }

    //Pemesan
    public function pemesan()
    {

        $data['judul'] = 'Pemesan';
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

        $data['pemesan'] = $this->Pemesan_model->getAllpemesan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/pemesan', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_pemesan()
    {

        $data['judul'] = 'Pemesan';
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

        $data['pemesan'] = $this->Pemesan_model->getAllpemesan();

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama_pemesan', 'Nama pemesan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_pemesan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Pemesan_model->tambahDatapemesan();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/pemesan');
        }
    }

    public function ubah_pemesan($id_pemesan)
    {

        $data['judul'] = 'Pemesan';
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

        $data['pemesan'] = $this->Pemesan_model->getpemesanById($id_pemesan);

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama_pemesan', 'Nama pemesan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_pemesan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Pemesan_model->ubahDatapemesan();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/pemesan');
        }
    }

    public function hapus_pemesan($id_pemesan)
    {

        $this->Pemesan_model->hapusDatapemesan($id_pemesan);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/pemesan');
    }

    public function detail_pemesan($id_pemesan)
    {
        $data['judul'] = 'Pemesan';
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

        $data['pemesan'] = $this->Pemesan_model->getpemesanById($id_pemesan);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_pemesan', $data);
        $this->load->view('templates/footer', $data);
    }
    //konsumsi
    public function konsumsi()
    {

        $data['judul'] = 'Konsumsi';
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

        $data['konsumsi'] = $this->Konsumsi_model->getAllkonsumsi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/konsumsi', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_konsumsi()
    {

        $data['judul'] = 'Konsumsi';
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

        $data['konsumsi'] = $this->Konsumsi_model->getAllkonsumsi();

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_konsumsi', 'Nama konsumsi', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_konsumsi', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Konsumsi_model->tambahDatakonsumsi();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/konsumsi');
        }
    }

    public function ubah_konsumsi($id_konsumsi)
    {

        $data['judul'] = 'Konsumsi';
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

        $data['konsumsi'] = $this->Konsumsi_model->getkonsumsiById($id_konsumsi);

        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('nama_konsumsi', 'Nama konsumsi', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_konsumsi', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Konsumsi_model->ubahDatakonsumsi();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/konsumsi');
        }
    }

    public function hapus_konsumsi($id_konsumsi)
    {

        $this->Konsumsi_model->hapusDatakonsumsi($id_konsumsi);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/konsumsi');
    }

    public function detail_konsumsi($id_konsumsi)
    {
        $data['judul'] = 'Konsumsi';
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

        $data['konsumsi'] = $this->Konsumsi_model->getkonsumsiById($id_konsumsi);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_konsumsi', $data);
        $this->load->view('templates/footer', $data);
    }
    //bank
    public function bank()
    {

        $data['judul'] = 'Bank';
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

        $data['bank'] = $this->Bank_model->getAllbank();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/bank', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_bank()
    {

        $data['judul'] = 'Bank';
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

        $data['bank'] = $this->Bank_model->getAllbank();

        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
        $this->form_validation->set_rules('no_rek', 'No Rekening', 'required');
        $this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_bank', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Bank_model->tambahDatabank();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/bank');
        }
    }
    public function ubah_bank($id_bank)
    {

        $data['judul'] = 'Bank';
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

        $data['bank'] = $this->Bank_model->getbankById($id_bank);

        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
        $this->form_validation->set_rules('no_rek', 'No Rekening', 'required');
        $this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_bank', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Bank_model->ubahDatabank();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/bank');
        }
    }
    public function hapus_bank($id_bank)
    {

        $this->Bank_model->hapusDatabank($id_bank);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/bank');
    }

    public function detail_bank($id_bank)
    {
        $data['judul'] = 'Bank';
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

        $data['bank'] = $this->Bank_model->getbankById($id_bank);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_bank', $data);
        $this->load->view('templates/footer', $data);
    }
    //mitra
    public function mitra()
    {

        $data['judul'] = 'Mitra';
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

        $data['mitra'] = $this->Mitra_model->getAllmitra();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/mitra', $data);
        $this->load->view('templates/footer', $data);
    }
    public function tambah_mitra()
    {

        $data['judul'] = 'Mitra';
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

        $data['mitra'] = $this->Mitra_model->getAllmitra();

        $this->form_validation->set_rules('nama_mitra', 'Nama mitra', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nohp', 'No HP', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/tambah_mitra', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Mitra_model->tambahDatamitra();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('master/mitra');
        }
    }
    public function ubah_mitra($id_mitra)
    {

        $data['judul'] = 'Mitra';
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

        $data['mitra'] = $this->Mitra_model->getmitraById($id_mitra);

        $this->form_validation->set_rules('nama_mitra', 'Nama mitra', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nohp', 'No HP', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/ubah_mitra', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Mitra_model->ubahDatamitra();
            $this->session->set_flashdata('flashdata', 'diubah');
            redirect('master/mitra');
        }
    }
    public function hapus_mitra($id_mitra)
    {

        $this->Mitra_model->hapusDatamitra($id_mitra);
        $this->session->set_flashdata('flashdata', 'dihapus');
        redirect('master/mitra');
    }

    public function detail_mitra($id_mitra)
    {
        $data['judul'] = 'Mitra';
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

        $data['mitra'] = $this->Mitra_model->getmitraById($id_mitra);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/detail_mitra', $data);
        $this->load->view('templates/footer', $data);
    }
}
