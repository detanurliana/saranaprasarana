<?php

class Mutasi_model extends CI_Model
{

    public function getAllMutasi()
    {

        return $this->db->get('mutasi')->result_array();
    }

    public function getMutasiById($id_mutasi)
    {

        return $this->db->get_where('mutasi', ['id_mutasi' => $id_mutasi])->row_array();
    }

    public function tambahDataMutasi()
    {
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $data = [
            "tanggal" => $tanggal,
            "kode_mutasi" => $this->input->post('kode_mutasi', true),
            "id_penempatan" => $this->input->post('id_penempatan', true),
            "id_lokasi" => $this->input->post('id_lokasi', true),
            "jumlah" => $this->input->post('jumlah', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('mutasi', $data);
    }

    public function ubahDataMutasi()
    {
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $data = [
            "id_mutasi" => $this->input->post('id_mutasi', true),
            "tanggal" => $tanggal,
            "id_penempatan" => $this->input->post('id_penempatan', true),
            "id_lokasi" => $this->input->post('id_lokasi', true),
            "jumlah" => $this->input->post('jumlah', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_mutasi', $this->input->post('id_mutasi', true));
        $this->db->update('mutasi', $data);
    }

    public function hapusDataMutasi($id_mutasi)
    {

        //$this->db->where('id_mutasi',$id_mutasi);
        //$this->db->delete('mutasi');
        $this->db->delete('mutasi', ['id_mutasi' => $id_mutasi]);
    }
}
