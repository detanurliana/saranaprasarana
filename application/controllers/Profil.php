<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        check_login();
        check_jeniskelamin();
        $this->load->model('Profil_model');
        $this->load->helper('string');
    }

    public function index()
    {

        $data['judul'] = 'Profil';
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
        $id_golpangkat = $data['pegawai']['id_golpangkat'];
        $data['golpangkat'] = $this->db->get_where('golpangkat', ['id_golpangkat' => $id_golpangkat])->row_array();
        $data['jeniskelamin'] = $data['pegawai']['id_jeniskelamin'];

        $this->form_validation->set_rules('id_pegawai', 'id_pegawai', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('profil/index', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $uploadFoto = $_FILES['foto']['name'];
            $acak = random_string('alnum', 16);
            $file_baru = $acak . "." . pathinfo($uploadFoto, PATHINFO_EXTENSION);
            if ($uploadFoto) {
                $config['file_name'] = $file_baru;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '200';
                $config['upload_path'] = './assets/dist/img/';
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $foto_lama = $data['pegawai']['foto'];
                if ($foto_lama != 'default.jpg') {
                    unlink(FCPATH . './assets/dist/img/' . $foto_lama);
                }
                $this->Profil_model->ubahDataFoto($file_baru);
                $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-success role="alert">Berhasil mengubah foto</div>');
                redirect('profil');
            } else {
                $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-danger role="alert">Gagal melakukan upload!</div>');
                redirect('profil');
            }
        }
    }
    public function ubah_password()
    {

        $data['judul'] = 'Ubah Password';
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


        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required');
        $this->form_validation->set_rules('password_baru2', 'Konfirmasi Password Baru', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('profil/ubah_password', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $id_pengguna = $this->input->post('id_pengguna');
            $password_lama = $this->input->post('password_lama');
            $password_baru1 = $this->input->post('password_baru1');
            $password_baru2 = $this->input->post('password_baru2');

            $pengguna = $this->db->get_where('pengguna', ['id_pengguna' => $id_pengguna])->row_array();
            //periksa password lama
            if (password_verify($password_lama, $pengguna['password'])) {
                if ($password_baru1 == $password_baru2) {
                    $this->Profil_model->ubahDataPassword();
                    $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-success role="alert">Berhasil mengubah password lama</div>');
                    redirect('profil/ubah_password');
                } else {
                    $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-danger role="alert">Konfirmasi Password Baru tidak sama!</div>');
                    redirect('profil/ubah_password');
                }
            } else {
                //$this->Profil_model->ubahDataPassword();
                $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-danger role="alert">Password Lama salah!</div>');
                redirect('profil/ubah_password');
            }
        }
    }
}
