<?php

class Hargafasilitas_model extends CI_Model
{

    public function getAllHargafasilitas()
    {

        return $this->db->get('hargafasilitas')->result_array();
    }

    public function getHargafasilitasById($id_hargafasilitas)
    {

        return $this->db->get_where('hargafasilitas', ['id_hargafasilitas' => $id_hargafasilitas])->row_array();
    }

    public function tambahDataHargafasilitas()
    {

        $data = [
            "harga" => $this->input->post('harga', true),
            "id_fasilitas" => $this->input->post('id_fasilitas', true),
            "id_kategorifasilitas" => $this->input->post('id_kategorifasilitas', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('hargafasilitas', $data);
    }

    public function ubahDataHargafasilitas()
    {

        $data = [
            "harga" => $this->input->post('harga', true),
            "id_fasilitas" => $this->input->post('id_fasilitas', true),
            "id_kategorifasilitas" => $this->input->post('id_kategorifasilitas', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_hargafasilitas', $this->input->post('id_hargafasilitas', true));
        $this->db->update('hargafasilitas', $data);
    }

    public function hapusDataHargafasilitas($id_hargafasilitas)
    {

        //$this->db->where('id_hargafasilitas',$id_hargafasilitas);
        //$this->db->delete('hargafasilitas');
        $this->db->delete('hargafasilitas', ['id_hargafasilitas' => $id_hargafasilitas]);
    }
}
