<?php

class Satuan_model extends CI_Model
{

    public function getAllSatuan()
    {

        return $this->db->get('satuan')->result_array();
    }

    public function getSatuanById($id_satuan)
    {

        return $this->db->get_where('satuan', ['id_satuan' => $id_satuan])->row_array();
    }

    public function tambahDataSatuan()
    {

        $data = [
            "urutan" => $this->input->post('urutan', true),
            "nama_satuan" => $this->input->post('nama_satuan', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('satuan', $data);
    }

    public function ubahDataSatuan()
    {

        $data = [
            "id_satuan" => $this->input->post('id_satuan', true),
            "urutan" => $this->input->post('urutan', true),
            "nama_satuan" => $this->input->post('nama_satuan', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_satuan', $this->input->post('id_satuan', true));
        $this->db->update('satuan', $data);
    }

    public function hapusDataSatuan($id_satuan)
    {

        //$this->db->where('id_satuan',$id_satuan);
        //$this->db->delete('satuan');
        $this->db->delete('satuan', ['id_satuan' => $id_satuan]);
    }
}
