<?php

class Lokasi_model extends CI_Model
{

    public function getAllLokasi()
    {

        return $this->db->get('lokasi')->result_array();
    }

    public function getlokasiById($id_lokasi)
    {

        return $this->db->get_where('lokasi', ['id_lokasi' => $id_lokasi])->row_array();
    }

    public function tambahDataLokasi()
    {

        $data = [
            "urutan" => $this->input->post('urutan', true),
            "nama_lokasi" => $this->input->post('nama_lokasi', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('lokasi', $data);
    }

    public function ubahDataLokasi()
    {

        $data = [
            "id_lokasi" => $this->input->post('id_lokasi', true),
            "urutan" => $this->input->post('urutan', true),
            "nama_lokasi" => $this->input->post('nama_lokasi', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_lokasi', $this->input->post('id_lokasi', true));
        $this->db->update('lokasi', $data);
    }

    public function hapusDataLokasi($id_lokasi)
    {

        //$this->db->where('id_lokasi',$id_lokasi);
        //$this->db->delete('lokasi');
        $this->db->delete('lokasi', ['id_lokasi' => $id_lokasi]);
    }
}
