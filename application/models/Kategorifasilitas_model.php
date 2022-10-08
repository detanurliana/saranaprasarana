<?php

class Kategorifasilitas_model extends CI_Model
{

    public function getAllkategorifasilitas()
    {

        return $this->db->get('kategorifasilitas')->result_array();
    }

    public function getkategorifasilitasById($id_kategorifasilitas)
    {

        return $this->db->get_where('kategorifasilitas', ['id_kategorifasilitas' => $id_kategorifasilitas])->row_array();
    }

    public function tambahDatakategorifasilitas()
    {

        $data = [
            "urutan" => $this->input->post('urutan', true),
            "nama_kategorifasilitas" => $this->input->post('nama_kategorifasilitas', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('kategorifasilitas', $data);
    }

    public function ubahDatakategorifasilitas()
    {

        $data = [
            "id_kategorifasilitas" => $this->input->post('id_kategorifasilitas', true),
            "urutan" => $this->input->post('urutan', true),
            "nama_kategorifasilitas" => $this->input->post('nama_kategorifasilitas', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_kategorifasilitas', $this->input->post('id_kategorifasilitas', true));
        $this->db->update('kategorifasilitas', $data);
    }

    public function hapusDatakategorifasilitas($id_kategorifasilitas)
    {

        //$this->db->where('id_kategorifasilitas',$id_kategorifasilitas);
        //$this->db->delete('kategorifasilitas');
        $this->db->delete('kategorifasilitas', ['id_kategorifasilitas' => $id_kategorifasilitas]);
    }
}
