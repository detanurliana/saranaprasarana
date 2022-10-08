<?php

class Jabatan_model extends CI_Model
{

    public function getAllJabatan()
    {

        return $this->db->get('jabatan')->result_array();
    }

    public function getJabatanById($id_jabatan)
    {

        return $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();
    }

    public function tambahDataJabatan()
    {

        $data = [
            "urutan" => $this->input->post('urutan', true),
            "nama_jabatan" => $this->input->post('nama_jabatan', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('jabatan', $data);
    }

    public function ubahDataJabatan()
    {

        $data = [
            "id_jabatan" => $this->input->post('id_jabatan', true),
            "urutan" => $this->input->post('urutan', true),
            "nama_jabatan" => $this->input->post('nama_jabatan', true),
            "user_ubah" => $this->session->userdata('username'),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_jabatan', $this->input->post('id_jabatan', true));
        $this->db->update('jabatan', $data);
    }

    public function hapusDataJabatan($id_jabatan)
    {

        //$this->db->where('id_jabatan',$id_jabatan);
        //$this->db->delete('jabatan');
        $this->db->delete('jabatan', ['id_jabatan' => $id_jabatan]);
    }
}
