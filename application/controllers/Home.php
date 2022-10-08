<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->model('Pemesan_model');
    }

    //BERANDA
    public function index()
    {
        $data['judul'] = 'Lembaga Penjaminan Mutu Pendidikan Kalimantan Selatan';
        $data['aktif'] = '1';
        $this->load->view('home/header', $data);
        $this->load->view('home/menu', $data);
        $this->load->view('home/index', $data);
        $this->load->view('home/footer', $data);
    }
    //FASILITAS
    public function fasilitas()
    {
        $data['judul'] = 'Fasilitas dan Sarana';
        $data['aktif'] = '2';
        $this->load->view('home/header', $data);
        $this->load->view('home/menu', $data);
        $this->load->view('home/fasilitas', $data);
        $this->load->view('home/footer', $data);
    }
    //FASILITAS
    public function daftar()
    {
        $data['judul'] = 'Pendaftaran';
        $data['aktif'] = '3';

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('nama_pemesan', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nohp', 'No HP', 'required');
        $this->form_validation->set_rules('id_jeniskelamin', 'Jenis Kelamin', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/header', $data);
            $this->load->view('home/menu', $data);
            $this->load->view('home/daftar', $data);
            $this->load->view('home/footer', $data);
        } else {
            $this->Pemesan_model->tambahDatapemesanUmum();
            $this->session->set_flashdata('flashdata', 'ditambahkan');
            redirect('home/login');
        }
    }
    public function login()
    {

        if ($this->session->userdata('email')) {
            redirect('pemesan');
        } else {
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == false) {
                $data['judul'] = 'Halaman Login';
                $data['aktif'] = '4';
                $this->load->view('home/header', $data);
                $this->load->view('home/menu', $data);
                $this->load->view('home/login', $data);
                $this->load->view('home/footer', $data);
            } else {
                //validasi sukses
                $this->_login();
            }
        }
    }

    private function _login()
    {

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $pengguna = $this->db->get_where('pengguna', ['username' => $email])->row_array();
        $pemesan = $this->db->get_where('pemesan', ['email' => $email])->row_array();

        
        //pengguna ada
        if ($pengguna) {
            //jika user aktif
            if ($pengguna['aktif'] == 1) {

                //periksa Password
                if (password_verify($password, $pengguna['password'])) {

                    $data = [
                        'token' => $pengguna['token'],
                        'id_level' => $pengguna['id_level']
                    ];

                    //simpan data sesi login
                    $this->session->set_userdata($data);
                    if ($pengguna['id_level'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('pengguna');
                    }
                } else {
                    $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-danger role="alert">Password salah.</div>');
                    redirect('home/login');
                }
            } else {

                $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-danger role="alert">Maaf akun ini belum diaktivasi.</div>');
                redirect('home/login');
            }
        } else if ($pemesan) {
            //jika user aktif
            if ($pemesan['aktif'] == 1) {

                //periksa Password
                if (password_verify($password, $pemesan['password'])) {

                    $data = [
                        'token' => $pemesan['token'],
                        'id_level' => '3'
                    ];

                    //simpan data sesi login
                    $this->session->set_userdata($data);
                    redirect('pemesan');
                } else {
                    $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-danger role="alert">Password salah.</div>');
                    redirect('home/login');
                }
            } else {

                $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-danger role="alert">Maaf akun ini belum diaktivasi.</div>');
                redirect('home/login');
            }
        } else {

            //pemesan tidak ada
            $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-danger role="alert">Maaf email belum terdaftar.</div>');
            redirect('home/login');
        }
    }

    public function logout()
    {

        $this->session->unset_userdata('token');
        $this->session->unset_userdata('id_level');
        $this->session->set_flashdata('pesan_notifikasi', '<div class="alert alert-success role="alert">Selamat!, anda berhasil keluar</div>');
        redirect('home');
    }
}
