<?php

class Konsumsi_model extends CI_Model
{

    public function getAllkonsumsi()
    {

        return $this->db->get('konsumsi')->result_array();
    }

    public function getkonsumsiById($id_konsumsi)
    {

        return $this->db->get_where('konsumsi', ['id_konsumsi' => $id_konsumsi])->row_array();
    }

    public function tambahDatakonsumsi()
    {

        $data = [
            "urutan" => $this->input->post('urutan', true),
            "nama_konsumsi" => $this->input->post('nama_konsumsi', true),
            "harga" => $this->input->post('harga', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('konsumsi', $data);
    }

    public function ubahDatakonsumsi()
    {

        $data = [
            "urutan" => $this->input->post('urutan', true),
            "nama_konsumsi" => $this->input->post('nama_konsumsi', true),
            "harga" => $this->input->post('harga', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_konsumsi', $this->input->post('id_konsumsi', true));
        $this->db->update('konsumsi', $data);
    }

    public function hapusDatakonsumsi($id_konsumsi)
    {

        //$this->db->where('id_konsumsi',$id_konsumsi);
        //$this->db->delete('konsumsi');
        $this->db->delete('konsumsi', ['id_konsumsi' => $id_konsumsi]);
    }
}
