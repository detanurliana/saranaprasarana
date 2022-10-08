<?php

class Jenisfasilitas_model extends CI_Model
{

    public function getAllJenisfasilitas()
    {

        return $this->db->get('jenisfasilitas')->result_array();
    }

    public function getJenisfasilitasById($id_jenisfasilitas)
    {

        return $this->db->get_where('jenisfasilitas', ['id_jenisfasilitas' => $id_jenisfasilitas])->row_array();
    }

    public function tambahDataJenisfasilitas()
    {

        $data = [
            "urutan" => $this->input->post('urutan', true),
            "nama_jenisfasilitas" => $this->input->post('nama_jenisfasilitas', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('jenisfasilitas', $data);
    }

    public function ubahDataJenisfasilitas()
    {

        $data = [
            "id_jenisfasilitas" => $this->input->post('id_jenisfasilitas', true),
            "urutan" => $this->input->post('urutan', true),
            "nama_jenisfasilitas" => $this->input->post('nama_jenisfasilitas', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_jenisfasilitas', $this->input->post('id_jenisfasilitas', true));
        $this->db->update('jenisfasilitas', $data);
    }

    public function hapusDataJenisfasilitas($id_jenisfasilitas)
    {

        //$this->db->where('id_jenisfasilitas',$id_jenisfasilitas);
        //$this->db->delete('jenisfasilitas');
        $this->db->delete('jenisfasilitas', ['id_jenisfasilitas' => $id_jenisfasilitas]);
    }
}
