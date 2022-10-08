<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        check_login();
    }

    //BERANDA
    public function index()
    {
        $data['judul'] = 'Beranda';
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

        $data['masterpegawai'] = $this->db->get('pegawai');
        $data['masterfasilitas'] = $this->db->get('fasilitas');
        $data['masterhargafasilitas'] = $this->db->get('hargafasilitas');
        $data['masterpemesan'] = $this->db->get('pemesan');
        $data['profil'] = $this->db->get('profil')->row_array();

        $data['pemesanan'] = $this->db->get('pemesanan');
        $data['konsumsi'] = $this->db->get('konsumsi');
        $data['kategorifasilitas'] = $this->db->get('kategorifasilitas');
        $data['jenisfasilitas'] = $this->db->get('jenisfasilitas');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
