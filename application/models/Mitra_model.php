<?php

class Mitra_model extends CI_Model
{

    public function getAllmitra()
    {

        return $this->db->get('mitra')->result_array();
    }

    public function getmitraById($id_mitra)
    {

        return $this->db->get_where('mitra', ['id_mitra' => $id_mitra])->row_array();
    }

    public function tambahDatamitra()
    {

        $data = [
            "nama_mitra" => $this->input->post('nama_mitra', true),
            "alamat" => $this->input->post('alamat', true),
            "nohp" => $this->input->post('nohp', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('mitra', $data);
    }

    public function ubahDatamitra()
    {

        $data = [
            "nama_mitra" => $this->input->post('nama_mitra', true),
            "alamat" => $this->input->post('alamat', true),
            "nohp" => $this->input->post('nohp', true),
            "user_ubah" => $this->session->userdata('username'),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_mitra', $this->input->post('id_mitra', true));
        $this->db->update('mitra', $data);
    }

    public function hapusDatamitra($id_mitra)
    {

        //$this->db->where('id_mitra',$id_mitra);
        //$this->db->delete('mitra');
        $this->db->delete('mitra', ['id_mitra' => $id_mitra]);
    }
}
