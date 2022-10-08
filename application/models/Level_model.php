<?php

class Level_model extends CI_Model
{

    public function getAllLevel()
    {

        return $this->db->get('level')->result_array();
    }

    public function getLevelById($id_level)
    {

        return $this->db->get_where('level', ['id_level' => $id_level])->row_array();
    }

    public function tambahDataLevel()
    {

        $data = [
            "urutan" => $this->input->post('urutan', true),
            "nama_level" => $this->input->post('nama_level', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')

        ];
        $this->db->insert('level', $data);
    }

    public function ubahDataLevel()
    {

        $data = [
            "id_level" => $this->input->post('id_level', true),
            "urutan" => $this->input->post('urutan', true),
            "nama_level" => $this->input->post('nama_level', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_level', $this->input->post('id_level', true));
        $this->db->update('level', $data);
    }

    public function hapusDataLevel($id_level)
    {

        //$this->db->where('id_level',$id_level);
        //$this->db->delete('level');
        $this->db->delete('level', ['id_level' => $id_level]);
    }
}
