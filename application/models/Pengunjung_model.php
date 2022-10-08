<?php

class Pengunjung_model extends CI_Model
{

    public function getAllpengunjung()
    {

        return $this->db->get('pengunjung')->result_array();
    }

    public function getpengunjungById($id_pengunjung)
    {

        return $this->db->get_where('pengunjung', ['id_pengunjung' => $id_pengunjung])->row_array();
    }

    public function tambahDatapengunjung()
    {
        $data = [
            "nik" => $this->input->post('nik', true),
            "nama_pengunjung" => $this->input->post('nama_pengunjung', true),
            "id_jeniskelamin" => $this->input->post('id_jeniskelamin', true),
            "email" => $this->input->post('email', true),
            "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            "alamat" => $this->input->post('alamat', true),
            "nohp" => $this->input->post('nohp', true),
            "token" => get_token(10),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('pengunjung', $data);
    }
    public function tambahDatapengunjungUmum()
    {
        $data = [
            "nik" => $this->input->post('nik', true),
            "nama_pengunjung" => $this->input->post('nama_pengunjung', true),
            "id_jeniskelamin" => $this->input->post('id_jeniskelamin', true),
            "email" => $this->input->post('email', true),
            "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            "alamat" => $this->input->post('alamat', true),
            "nohp" => $this->input->post('nohp', true),
            "token" => get_token(10),
            "user_input" => 'registrasi',
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('pengunjung', $data);
    }

    public function ubahDatapengunjung()
    {
        $data = [
            "nik" => $this->input->post('nik', true),
            "nama_pengunjung" => $this->input->post('nama_pengunjung', true),
            "id_jeniskelamin" => $this->input->post('id_jeniskelamin', true),
            "email" => $this->input->post('email', true),
            "password" => $this->input->post('password', true),
            "alamat" => $this->input->post('alamat', true),
            "nohp" => $this->input->post('nohp', true),
            "token" => random_string(50),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_pengunjung', $this->input->post('id_pengunjung', true));
        $this->db->update('pengunjung', $data);
    }

    public function hapusDatapengunjung($id_pengunjung)
    {

        //$this->db->where('id_pengunjung',$id_pengunjung);
        //$this->db->delete('pengunjung');
        $this->db->delete('pengunjung', ['id_pengunjung' => $id_pengunjung]);
    }

    public function ubahDataPassword()
    {

        $data = [
            "id_pengunjung" => $this->input->post('id_pengunjung', true),
            "password" => password_hash($this->input->post('password_baru1'), PASSWORD_DEFAULT)
        ];
        $this->db->where('id_pengunjung', $this->input->post('id_pengunjung', true));
        $this->db->update('pengunjung', $data);
    }

    public function ubahDataFoto($file_baru)
    {

        $data = [
            "id_pengunjung" => $this->input->post('id_pengunjung', true),
            "foto" => $file_baru
        ];
        $this->db->where('id_pengunjung', $this->input->post('id_pengunjung', true));
        $this->db->update('pengunjung', $data);
    }
}
