<?php

class Bank_model extends CI_Model
{

    public function getAllbank()
    {

        return $this->db->get('bank')->result_array();
    }

    public function getbankById($id_bank)
    {

        return $this->db->get_where('bank', ['id_bank' => $id_bank])->row_array();
    }

    public function tambahDatabank()
    {

        $data = [
            "no_rek" => $this->input->post('no_rek', true),
            "atas_nama" => $this->input->post('atas_nama', true),
            "nama_bank" => $this->input->post('nama_bank', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('bank', $data);
    }

    public function ubahDatabank()
    {

        $data = [
            "no_rek" => $this->input->post('no_rek', true),
            "atas_nama" => $this->input->post('atas_nama', true),
            "nama_bank" => $this->input->post('nama_bank', true),
            "user_ubah" => $this->session->userdata('username'),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_bank', $this->input->post('id_bank', true));
        $this->db->update('bank', $data);
    }

    public function hapusDatabank($id_bank)
    {

        //$this->db->where('id_bank',$id_bank);
        //$this->db->delete('bank');
        $this->db->delete('bank', ['id_bank' => $id_bank]);
    }
}
