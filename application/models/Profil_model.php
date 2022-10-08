<?php

class Profil_model extends CI_Model
{


    public function getPenggunaById($id_pengguna)
    {

        return $this->db->get_where('pengguna', ['id_pengguna' => $id_pengguna])->row_array();
    }

    public function ubahDataPassword()
    {

        $data = [
            "id_pengguna" => $this->input->post('id_pengguna', true),
            "password" => password_hash($this->input->post('password_baru1'), PASSWORD_DEFAULT)
        ];
        $this->db->where('id_pengguna', $this->input->post('id_pengguna', true));
        $this->db->update('pengguna', $data);
    }

    public function ubahDataFoto($file_baru)
    {

        $data = [
            "id_pegawai" => $this->input->post('id_pegawai', true),
            "foto" => $file_baru
        ];
        $this->db->where('id_pegawai', $this->input->post('id_pegawai', true));
        $this->db->update('pegawai', $data);
    }
}
