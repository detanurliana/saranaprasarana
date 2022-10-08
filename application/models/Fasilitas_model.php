<?php

class Fasilitas_model extends CI_Model
{

    public function getAllfasilitas()
    {

        return $this->db->get('fasilitas')->result_array();
    }

    public function getfasilitasById($id_fasilitas)
    {

        return $this->db->get_where('fasilitas', ['id_fasilitas' => $id_fasilitas])->row_array();
    }

    public function tambahDatafasilitas()
    {

        $data = [
            "id_tipe" => $this->input->post('id_tipe', true),
            "kode_fasilitas" => $this->input->post('kode_fasilitas', true),
            "nama_fasilitas" => $this->input->post('nama_fasilitas', true),
            "kapasitas" => $this->input->post('kapasitas', true),
            "keterangan" => $this->input->post('keterangan', true),
            "id_jenisfasilitas" => $this->input->post('id_jenisfasilitas', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('fasilitas', $data);
    }

    public function ubahDatafasilitas()
    {

        $data = [
            "id_tipe" => $this->input->post('id_tipe', true),
            "nama_fasilitas" => $this->input->post('nama_fasilitas', true),
            "kapasitas" => $this->input->post('kapasitas', true),
            "keterangan" => $this->input->post('keterangan', true),
            "id_jenisfasilitas" => $this->input->post('id_jenisfasilitas', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_fasilitas', $this->input->post('id_fasilitas', true));
        $this->db->update('fasilitas', $data);
    }

    public function hapusDatafasilitas($id_fasilitas)
    {

        //$this->db->where('id_fasilitas',$id_fasilitas);
        //$this->db->delete('fasilitas');
        $this->db->delete('fasilitas', ['id_fasilitas' => $id_fasilitas]);
    }
}
