<?php

class Pemesan_model extends CI_Model
{

    public function getAllpemesan()
    {

        return $this->db->get('pemesan')->result_array();
    }

    public function getpemesanById($id_pemesan)
    {

        return $this->db->get_where('pemesan', ['id_pemesan' => $id_pemesan])->row_array();
    }

    public function tambahDatapemesan()
    {
        $data = [
            "nik" => $this->input->post('nik', true),
            "nama_pemesan" => $this->input->post('nama_pemesan', true),
            "id_jeniskelamin" => $this->input->post('id_jeniskelamin', true),
            "email" => $this->input->post('email', true),
            "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            "alamat" => $this->input->post('alamat', true),
            "nohp" => $this->input->post('nohp', true),
            "token" => get_token(10),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('pemesan', $data);
    }
    public function tambahDatapemesanUmum()
    {
        $data = [
            "nik" => $this->input->post('nik', true),
            "nama_pemesan" => $this->input->post('nama_pemesan', true),
            "id_jeniskelamin" => $this->input->post('id_jeniskelamin', true),
            "email" => $this->input->post('email', true),
            "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            "alamat" => $this->input->post('alamat', true),
            "nohp" => $this->input->post('nohp', true),
            "token" => get_token(10),
            "user_input" => 'registrasi',
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('pemesan', $data);
    }

    public function ubahDatapemesan()
    {
        $data = [
            "nik" => $this->input->post('nik', true),
            "nama_pemesan" => $this->input->post('nama_pemesan', true),
            "id_jeniskelamin" => $this->input->post('id_jeniskelamin', true),
            "email" => $this->input->post('email', true),
            "password" => $this->input->post('password', true),
            "alamat" => $this->input->post('alamat', true),
            "nohp" => $this->input->post('nohp', true),
            "token" => random_string(50),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_pemesan', $this->input->post('id_pemesan', true));
        $this->db->update('pemesan', $data);
    }

    public function hapusDatapemesan($id_pemesan)
    {

        //$this->db->where('id_pemesan',$id_pemesan);
        //$this->db->delete('pemesan');
        $this->db->delete('pemesan', ['id_pemesan' => $id_pemesan]);
    }

    public function ubahDataPassword()
    {

        $data = [
            "id_pemesan" => $this->input->post('id_pemesan', true),
            "password" => password_hash($this->input->post('password_baru1'), PASSWORD_DEFAULT)
        ];
        $this->db->where('id_pemesan', $this->input->post('id_pemesan', true));
        $this->db->update('pemesan', $data);
    }

    public function ubahDataFoto($file_baru)
    {

        $data = [
            "id_pemesan" => $this->input->post('id_pemesan', true),
            "foto" => $file_baru
        ];
        $this->db->where('id_pemesan', $this->input->post('id_pemesan', true));
        $this->db->update('pemesan', $data);
    }
}
